<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Inertia\Inertia;



class AuthorController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Authors/AuthorsIndex',[
            'authors' => Author::query()
                ->when($request->input('search'), function ($query, $search){
                    $query->where('name', 'like', '%'.$search.'%');
                })
                ->paginate(20)
                ->withQueryString()
                ->through(fn($author)=>[
                    'id' => $author->id,
                    'name' => $author->name,
                    ]),
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Authors/AuthorsCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:authors,name|max:255',
        ]);
        $author = Author::create([
            'name' => $request->name,
        ]);
        return redirect()->route('authors.index')->with('message', 'Uspješno ste dodali autora "'.$author->name .'"!' );
    }

    
    public function show(Author $author)
    {
        //
    }

    public function edit(Author $author)
    {
        return Inertia::render('Authors/AuthorsEdit',[
            'author' => $author,
        ]);
    }

    
    public function update(Request $request, Author $author)
    {
        $validatedRequest = $request->validate([
            'name' => 'required|string|unique:authors,name|max:255',
        ]);
        $author->name = $validatedRequest["name"];
        $author->save();
        return redirect()->route('authors.index')->with('message', 'Uspješno ste izmijenili autora "'.$author->name .'"!' );
    }

    public function destroy(Author $author)
    {
        $authorName = $author->name;
        $author->delete();
        return redirect()->route("authors.index")->with('message', 'Uspješno ste izbrisali autora "'.$authorName .'"!' );
    }
}
