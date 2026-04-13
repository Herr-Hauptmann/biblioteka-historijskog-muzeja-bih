<?php

namespace App\Http\Controllers;

use App\Models\Anthology;
use App\Models\AnthologyBookInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AnthologyController extends Controller
{
    private $perPage = 25;

    public function index(Request $request)
    {
        return Inertia::render('Anthologies/AnthologiesIndex', [
            'anthologies' => Anthology::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('title', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage)
                ->withQueryString()
                ->through(fn ($anthology) => [
                    'id' => $anthology->id,
                    'title' => $anthology->title,
                    'description' => $anthology->description,
                    'created_at' => $anthology->created_at->format('d.m.Y.'),
                ]),
            'filters' => $request->only(['search']),
            'bookInfo' => $this->bookInfoArray(),
        ]);
    }

    public function list(Request $request)
    {
        return Inertia::render('Anthologies/AnthologiesList', [
            'anthologies' => Anthology::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('title', 'like', '%'.$search.'%')->orWhere('description', 'like', '%'.$search.'%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->withQueryString()
                ->through(fn ($anthology) => [
                    'id' => $anthology->id,
                    'title' => $anthology->title,
                    'description' => $anthology->description,
                    'created_at' => $anthology->created_at->format('d.m.Y.'),
                ]),
            'filters' => $request->only(['search']),
            'pdf_icon' => asset('images/histmuz-pdf-bg.png'),
            'bookInfo' => $this->bookInfoArray(),
        ]);
    }

    public function landing()
    {
        $latest['data'] = Anthology::latest()->take(4)->get(['id', 'title', 'description']);
        $latest['image_path'] = asset('images/histmuz-pdf-bg.png');
        $latest['book_info'] = $this->bookInfoArray();

        return response()->json($latest);
    }

    public function editBookInfo()
    {
        $row = AnthologyBookInfo::query()->firstOrFail();

        return Inertia::render('Anthologies/AnthologiesBookInfoEdit', [
            'bookInfo' => $this->toBookInfoArray($row),
        ]);
    }

    public function updateBookInfo(Request $request)
    {
        $validated = $request->validate([
            'issn' => 'nullable|string|max:255',
            'publisher_name' => 'nullable|string|max:255',
            'publisher_address' => 'nullable|string|max:2000',
            'publisher_phone' => 'nullable|string|max:255',
            'publisher_email' => 'nullable|string|max:255',
            'publisher_website' => 'nullable|string|max:255',
            'for_publisher' => 'nullable|string|max:255',
            'editorial_reviews' => 'nullable|string|max:10000',
            'editor_in_chief' => 'nullable|string|max:255',
            'managing_editor' => 'nullable|string|max:255',
        ]);

        AnthologyBookInfo::query()->firstOrFail()->update($validated);

        return redirect()->route('anthologies.index')->with('message', 'Podaci o zborniku su uspješno sačuvani.');
    }

    public function show($id)
    {
        return Inertia::render('Anthologies/AnthologiesShow', [
            'id' => $id,
        ]);
    }

    public function create()
    {
        return Inertia::render('Anthologies/AnthologiesCreate');
    }

    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'anthology' => 'required|file|mimes:pdf',
        ]);
        $path = $request->file('anthology')->storeAs('anthologies', substr(Str::slug($validatedRequest['title'], '-'), 0, 21).date('-Y-m-d-H-i').'.pdf');
        Anthology::create([
            'title' => $validatedRequest['title'],
            'description' => $validatedRequest['description'],
            'file_path' => $path,
        ]);

        return redirect()->route('anthologies.index')->with('message', 'Uspješno ste dodali broj zbornika radova Historijskog muzeja BiH pod naslovom "'.$validatedRequest['title'].'"!');
    }

    public function download(Anthology $anthology)
    {
        $path = $anthology->file_path;
        $slug = Str::slug($anthology->title).'.pdf';
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return Storage::download($path, $slug, $headers);
    }

    public function get($anthology)
    {
        $anthology = Anthology::findOrFail($anthology);
        $file = Storage::path($anthology->file_path);

        return response()->file($file);
    }

    public function edit(Anthology $anthology)
    {
        $anthology['file_name'] = Str::slug($anthology->title).'.pdf';

        return Inertia::render('Anthologies/AnthologiesEdit', [
            'anthology' => $anthology,
            'pdf_icon' => asset('images/pdf_icon.png'),
        ]);
    }

    public function update(Request $request, Anthology $anthology)
    {
        $validatedRequest = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'anthology' => 'file|mimes:pdf|nullable',
        ]);

        $path = $anthology->file_path;
        if ($validatedRequest['anthology'] != null) {
            Storage::delete($path);
            $path = $request->file('anthology')->storeAs('anthologies', substr(Str::slug($validatedRequest['title'], '-'), 0, 21).date('-Y-m-d-H-i').'.pdf');
        }

        $anthology->title = $validatedRequest['title'];
        $anthology->description = $validatedRequest['description'];
        $anthology->file_path = $path;
        $anthology->save();

        return redirect()->route('anthologies.index')->with('message', 'Uspješno ste ažurirali broj zbornika radova Historijskog muzeja BiH pod naslovom "'.$validatedRequest['title'].'"!');
    }

    public function destroy(Anthology $anthology)
    {
        Storage::delete($anthology->file_path);
        $title = $anthology->title;
        $anthology->delete();

        return redirect()->route('anthologies.index')->with('message', 'Uspješno ste izbrisali broj zbornika radova Historijskog muzeja BiH pod naslovom "'.$title.'"!');
    }

    /**
     * @return array<string, mixed>|null
     */
    private function bookInfoArray(): ?array
    {
        $row = AnthologyBookInfo::query()->first();

        return $row ? $this->toBookInfoArray($row) : null;
    }

    /**
     * @return array<string, mixed>
     */
    private function toBookInfoArray(AnthologyBookInfo $b): array
    {
        return [
            'issn' => $b->issn,
            'publisher_name' => $b->publisher_name,
            'publisher_address' => $b->publisher_address,
            'publisher_phone' => $b->publisher_phone,
            'publisher_email' => $b->publisher_email,
            'publisher_website' => $b->publisher_website,
            'for_publisher' => $b->for_publisher,
            'editorial_reviews' => $b->editorial_reviews,
            'editor_in_chief' => $b->editor_in_chief,
            'managing_editor' => $b->managing_editor,
        ];
    }
}
