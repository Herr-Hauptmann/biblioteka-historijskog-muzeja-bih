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
            'name' => 'required|string|max:255',
        ]);
        $author = Author::create([
            'name' => $request->name,
        ]);
        dd($author);
    }

    
    public function show(Author $author)
    {
        //
    }

    public function edit(Author $author)
    {
        //
    }

    
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        //
    }

    public function destroy($id)
    {
        $author = Author::destroy($id);
        return redirect(route("authors.index"));
    }
}
