<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Illuminate\Support\Str;

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
    public function list()
    {
        return 'radi';
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
        $path = $request->file('publication')->storeAs('publications', substr(Str::slug($validatedRequest["title"], '-'), 0, 21).date('-Y-m-d-H-i'));
        Publication::create([
            "title" => $validatedRequest["title"],
            "description" => $validatedRequest["description"],
            "file_path" => $path,
        ]);
        return redirect()->route("publications.index")->with('message', 'Uspješno ste kreirali publikaciju "'.$validatedRequest["title"] .'"!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        return 'radi';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        //
    }
}
