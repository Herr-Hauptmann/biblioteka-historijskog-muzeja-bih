<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Vite;


class NewsController extends Controller
{
    private $perPage = 20;

    public function index(Request $request)
    {
        return Inertia::render('News/NewsIndex',[
            'news' => News::query()
                ->when($request->input('search'), function ($query, $search){
                    $query->where('title', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->orWhere('article', 'like', '%'.$search.'%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage)
                ->withQueryString()
                ->through(fn($news)=>[
                    'id' => $news->id,
                    'title' => $news->title,
                    'description' => $news->description,
                    'created_at' => $news->created_at->format('d.m.Y.'),
                ]),
            'filters' => $request->only(['search']),
        ]);
    }

    public function latest()
    {
        $latest = News::latest()->take(3)->get(['id','title']);
        return response()->json($latest);
    }

    public function list()
    {

    }

    public function create()
    {
        return Inertia::render('News/NewsCreate');
    }

    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            "title" => "required|max:255",
            "description" => "required",
            "article" => "required|max:10000",
            "image" => "required|image",
        ]);
        $type = $validatedRequest['image']->extension();
        $path = $validatedRequest['image']->storeAs('public/news', substr(Str::slug($validatedRequest["title"], '-'), 0, 21).date('-Y-m-d-H-i').'.'.$type);
        News::create([
            "title" => $validatedRequest["title"],
            "description" => $validatedRequest["description"],
            'article' => $validatedRequest["article"],
            "image_path" => $path,
        ]);
        return redirect()->route("news.index")->with('message', 'Uspješno ste kreirali vijest "'.$validatedRequest["title"] .'"!');
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        $path = Storage::url($news->image_path);
        $latest =  News::latest()->take(3)->get(['id','title', 'image_path', 'description']);
        foreach($latest as $article)
        {
            $article['image_path'] = Storage::url($article->image_path);
        }
        return Inertia::render('News/NewsShow', [
            'news' => $news,
            'image' => $path,
            'latest' => $latest,
        ]);
    }

    public function edit(News $news)
    {
        //
    }

    public function update(Request $request, News $news)
    {
        //
    }

    public function destroy(News $news)
    {
        //
    }
}
