<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    private $perPage = 25;

    public function index(Request $request)
    {
        return Inertia::render('Publications/PublicationsIndex',[
            'publications' => Publication::query()
                ->when($request->input('search'), function ($query, $search){
                    $query->where('title', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage)
                ->withQueryString()
                ->through(fn($publication)=>[
                    'id' => $publication->id,
                    'title' => $publication->title,
                    'description' => $publication->description,
                    'created_at' => $publication->created_at->format('d.m.Y.'),
                    'cover_image' => $this->coverImageUrl($publication->cover_image_path, $publication->id),
                ]),
            'filters' => $request->only(['search']),
        ]);
    }
    public function list(Request $request)
    {
        return Inertia::render('Publications/PublicationsList',[
            'publications' => Publication::query()
                ->when($request->input('search'), function ($query, $search){
                    $query->where('title', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->withQueryString()
                ->through(fn($publication)=>[
                    'id' => $publication->id,
                    'title' => $publication->title,
                    'description' => $publication->description,
                    'created_at' => $publication->created_at->format('d.m.Y.'),
                    'cover_image' => $this->coverImageUrl($publication->cover_image_path, $publication->id),
                ]),
            'filters' => $request->only(['search']),
            'pdf_icon' => asset('images/histmuz-pdf-bg.png'),
        ]);
    }

    public function landing()
    {
        $latest['data'] = Publication::latest()->take(4)->get(['id','title', 'description', 'cover_image_path'])
            ->map(fn ($publication) => [
                'id' => $publication->id,
                'title' => $publication->title,
                'description' => $publication->description,
                'cover_image' => $this->coverImageUrl($publication->cover_image_path, $publication->id),
            ]);
        $latest['image_path'] = asset('images/histmuz-pdf-bg.png');
        return response()->json($latest);
    }
    
    public function show($id)
    {
        return Inertia::render('Publications/PublicationsShow',[
            'id' => $id,
        ]);
    }

    public function create()
    {
        return Inertia::render('Publications/PublicationsCreate');
    }

    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            "title" => "required|max:255",
            "description" => "required",
            "publication" => "required|file|mimes:pdf",
            "cover_image" => "nullable|image|mimes:jpg,jpeg,png,webp|dimensions:width=600,height=600",
        ]);
        $path = $request->file('publication')->storeAs('publications', substr(Str::slug($validatedRequest["title"], '-'), 0, 21).date('-Y-m-d-H-i').'.pdf');
        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->storeAs(
                'cover-images/publications',
                substr(Str::slug($validatedRequest["title"], '-'), 0, 21).date('-Y-m-d-H-i').'.'.$request->file('cover_image')->getClientOriginalExtension()
            );
        }
        Publication::create([
            "title" => $validatedRequest["title"],
            "description" => $validatedRequest["description"],
            "file_path" => $path,
            "cover_image_path" => $coverImagePath,
        ]);
        return redirect()->route("publications.index")->with('message', 'Uspješno ste kreirali publikaciju "'.$validatedRequest["title"] .'"!');
    }

    public function download(Publication $publication){
        $path = $publication->file_path;
        $slug = Str::slug($publication->title).'.pdf';
        $headers = [
            'Content-Type' => 'application/pdf',
         ];

        return Storage::download($path, $slug, $headers);
    }

    public function get($publication)
    {
        $publication = Publication::findOrFail($publication);
        $file =  Storage::path($publication->file_path);
        return response()->file($file);
    }

    public function cover(Publication $publication)
    {
        $path = $publication->cover_image_path;
        if (empty($path)) {
            abort(404);
        }

        if (Storage::exists($path)) {
            return response()->file(Storage::path($path));
        }

        if (Storage::disk('public')->exists($path)) {
            return response()->file(Storage::disk('public')->path($path));
        }

        if (Str::startsWith($path, 'images/') && file_exists(public_path($path))) {
            return response()->file(public_path($path));
        }

        abort(404);
    }

    public function edit(Publication $publication)
    {
        $publication['file_name'] = Str::slug($publication->title).'.pdf';
        $publication['cover_image'] = $this->coverImageUrl($publication->cover_image_path);
        return Inertia::render('Publications/PublicationsEdit',[
            'publication' => $publication,
            'pdf_icon' => asset('images/pdf_icon.png'),
            'default_cover' => asset('images/histmuz-pdf-bg.png'),
        ]);
    }

    public function update(Request $request, Publication $publication)
    {
        $validatedRequest = $request->validate([
            "title" => "required|max:255",
            "description" => "required",
            "publication" => "file|mimes:pdf|nullable",
            "cover_image" => "nullable|image|mimes:jpg,jpeg,png,webp|dimensions:width=600,height=600",
        ]);

        $path = $publication->file_path;
        $coverImagePath = $publication->cover_image_path;
        //Proccess the new file
        if ($validatedRequest['publication'] != null)
        {
            //Delete old
            Storage::delete($path);
            //Upload new
            $path = $request->file('publication')->storeAs('publications', substr(Str::slug($validatedRequest["title"], '-'), 0, 21).date('-Y-m-d-H-i').'.pdf');
        }
        if ($request->hasFile('cover_image')) {
            if ($coverImagePath) {
                if (Storage::exists($coverImagePath)) {
                    Storage::delete($coverImagePath);
                } elseif (Storage::disk('public')->exists($coverImagePath)) {
                    Storage::disk('public')->delete($coverImagePath);
                } elseif (Str::startsWith($coverImagePath, 'images/') && file_exists(public_path($coverImagePath))) {
                    unlink(public_path($coverImagePath));
                }
            }

            $coverImagePath = $request->file('cover_image')->storeAs(
                'cover-images/publications',
                substr(Str::slug($validatedRequest["title"], '-'), 0, 21).date('-Y-m-d-H-i').'.'.$request->file('cover_image')->getClientOriginalExtension()
            );
        }

        $publication->title = $validatedRequest["title"];
        $publication->description = $validatedRequest["description"];
        $publication->file_path = $path;
        $publication->cover_image_path = $coverImagePath;
        $publication->save();
        
        return redirect()->route("publications.index")->with('message', 'Uspješno ste kreirali publikaciju "'.$validatedRequest["title"] .'"!');
    }

    public function destroy(Publication $publication)
    {
        Storage::delete($publication->file_path);
        if ($publication->cover_image_path) {
            if (Storage::exists($publication->cover_image_path)) {
                Storage::delete($publication->cover_image_path);
            } elseif (Storage::disk('public')->exists($publication->cover_image_path)) {
                Storage::disk('public')->delete($publication->cover_image_path);
            } elseif (Str::startsWith($publication->cover_image_path, 'images/') && file_exists(public_path($publication->cover_image_path))) {
                unlink(public_path($publication->cover_image_path));
            }
        }
        $title = $publication->title;
        $publication->delete();
        return redirect()->route("publications.index")->with('message', 'Uspješno ste izbrisali publikaciju "'.$title .'"!');
    }

    private function coverImageUrl(?string $coverImagePath, int $publicationId): string
    {
        if (!empty($coverImagePath)) {
            if (Storage::exists($coverImagePath) || Storage::disk('public')->exists($coverImagePath)) {
                return route('publications.cover', ['publication' => $publicationId]);
            }
            if (Str::startsWith($coverImagePath, 'images/') && file_exists(public_path($coverImagePath))) {
                return asset($coverImagePath);
            }
        }

        return asset('images/histmuz-pdf-bg.png');
    }
}
