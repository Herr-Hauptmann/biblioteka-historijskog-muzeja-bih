<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class NewsController extends Controller
{
    private $perPage = 20;

    public function index(Request $request)
    {
        return Inertia::render('News/NewsIndex', [
            'news' => News::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('article', 'like', '%' . $search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate($this->perPage)
                ->withQueryString()
                ->through(fn($news) => [
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
        $latest = News::latest()->take(3)->get(['id', 'title']);
        return response()->json($latest);
    }

    public function landing()
    {
        $latest = News::latest()->take(4)->get(['id', 'title', 'image_path', 'description']);
        // foreach($latest as $article)
        // {
        //     $article['image_path'] =$article->image_path;
        // }
        return response()->json($latest);
    }

    public function list(Request $request)
    {
        return Inertia::render('News/NewsList', [
            'news' => News::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('article', 'like', '%' . $search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->withQueryString()
                ->through(fn($news) => [
                    'id' => $news->id,
                    'title' => $news->title,
                    'description' => $news->description,
                    // 'image_path' => Storage::url($news->image_path),
                    'image_path' => $news->image_path,
                ]),
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('News/NewsCreate', [
            "apikey" => env('TINY_API_KEY'),
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedRequest = $request->validate([
            "title" => "required|max:255",
            "description" => "required",
            "article" => "required|max:10000",
            "image" => "required|image",
        ]);

        // Define the directory for storing images
        $directory = 'news';

        // Retrieve the image file from the request
        $image = $validatedRequest['image'];

        // Generate a unique file name for the image
        $imageName = uniqid() . '.' . $image->extension();

        // Store the file using Storage::put()
        $filePath = "{$directory}/{$imageName}";
        Storage::put($filePath, file_get_contents($image->getRealPath()));

        // Convert the file path for public access
        $imagePath = Storage::url($filePath);

        // Create a new news record
        News::create([
            "title" => $validatedRequest["title"],
            "description" => $validatedRequest["description"],
            "article" => $validatedRequest["article"],
            "image_path" => $imagePath, // Save the public path
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route("news.index")->with('message', 'Uspješno ste kreirali vijest "' . $validatedRequest["title"] . '"!');
    }
    public function show($id)
    {
        $news = News::findOrFail($id);
        // $path = Storage::url($news->image_path);
        $path = $news->image_path;
        $latest = News::latest()->take(3)->get(['id', 'title', 'image_path', 'description']);
        // foreach ($latest as $article) {
        //     $article['image_path'] = Storage::url($article->image_path);
        // }
        return Inertia::render('News/NewsShow', [
            'news' => $news,
            'image' => $path,
            'latest' => $latest,
        ]);
    }

    public function edit(News $news)
    {
        return Inertia::render('News/NewsEdit', [
            'news' => $news,
            'image_path' => $news->image_path,
            "apikey" => env('TINY_API_KEY'),
        ]);
    }

    public function update(Request $request, News $news)
    {
        // Validate the incoming request data
        $validatedRequest = $request->validate([
            "title" => "required|max:255",
            "description" => "required",
            "article" => "required|max:10000",
            "image" => "image|nullable",
        ]);

        // Retain the existing image path
        $imagePath = $news->image_path;

        // Process the new file if provided
        if ($validatedRequest['image'] != null) {
            // Delete the old file if it exists
            if ($news->image_path) {
                // Extract the relative file path by removing the base URL
                $relativePath = str_replace(env('APP_URL').'/storage'.'/', '', $news->image_path);
                // Delete the file from storage
                Storage::delete($relativePath);
            }

            // Define the directory for storing images
            $directory = 'news';

            // Retrieve the image file from the request
            $image = $validatedRequest['image'];

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->extension();

            // Store the file using Storage::put()
            $filePath = "{$directory}/{$imageName}";
            Storage::put($filePath, file_get_contents($image->getRealPath()));

            // Convert the file path for public access
            $imagePath = Storage::url($filePath);
        }

        // Update the news record
        $news->title = $validatedRequest["title"];
        $news->description = $validatedRequest["description"];
        $news->article = $validatedRequest["article"];
        $news->image_path = $imagePath;
        $news->save();

        // Redirect back with a success message
        return redirect()->route("news.index")->with('message', 'Uspješno ste izmijenili vijest "' . $validatedRequest["title"] . '"!');
    }


    public function destroy(News $news)
    {
        if ($news->image_path) {
            // Extract the relative file path by removing the base URL
            $relativePath = str_replace(env('APP_URL').'/storage'.'/', '', $news->image_path);
            // Delete the file from storage
            Storage::delete($relativePath);
        }
        $title = $news->title;
        $news->delete();
        return redirect()->route("news.index")->with('message', 'Uspješno ste izbrisali vijest "' . $title . '"!');
    }
}
