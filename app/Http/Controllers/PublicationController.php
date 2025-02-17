<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Vite;

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
                ]),
            'filters' => $request->only(['search']),
            'pdf_icon' => asset('images/histmuz-pdf-bg.png'),
        ]);
    }

    public function landing()
    {
        $latest['data'] = Publication::latest()->take(4)->get(['id','title', 'description']);
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
        ]);
        $path = $request->file('publication')->storeAs('publications', substr(Str::slug($validatedRequest["title"], '-'), 0, 21).date('-Y-m-d-H-i').'.pdf');
        Publication::create([
            "title" => $validatedRequest["title"],
            "description" => $validatedRequest["description"],
            "file_path" => $path,
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

    public function edit(Publication $publication)
    {
        $publication['file_name'] = Str::slug($publication->title).'.pdf';
        return Inertia::render('Publications/PublicationsEdit',[
            'publication' => $publication,
            'pdf_icon' => asset('images/pdf_icon.png'),
        ]);
    }

    public function update(Request $request, Publication $publication)
    {
        $validatedRequest = $request->validate([
            "title" => "required|max:255",
            "description" => "required",
            "publication" => "file|mimes:pdf|nullable",
        ]);

        $path = $publication->file_path;
        //Proccess the new file
        if ($validatedRequest['publication'] != null)
        {
            //Delete old
            Storage::delete($path);
            //Upload new
            $path = $request->file('publication')->storeAs('publications', substr(Str::slug($validatedRequest["title"], '-'), 0, 21).date('-Y-m-d-H-i').'.pdf');
        }

        $publication->title = $validatedRequest["title"];
        $publication->description = $validatedRequest["description"];
        $publication->file_path = $path;
        $publication->save();
        
        return redirect()->route("publications.index")->with('message', 'Uspješno ste kreirali publikaciju "'.$validatedRequest["title"] .'"!');
    }

    public function destroy(Publication $publication)
    {
        Storage::delete($publication->file_path);
        $title = $publication->title;
        $publication->delete();
        return redirect()->route("publications.index")->with('message', 'Uspješno ste izbrisali publikaciju "'.$title .'"!');
    }
}
