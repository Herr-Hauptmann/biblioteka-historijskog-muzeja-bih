<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

use App\Models\Keyword;

class KeywordController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Keywords/KeywordsIndex',[
            'keywords' => Keyword::query()
                ->when($request->input('search'), function ($query, $search){
                    $query->where('title', 'like', '%'.$search.'%');
                })
                ->paginate(20)
                ->withQueryString()
                ->through(fn($keyword)=>[
                    'id' => $keyword->id,
                    'title' => $keyword->title,
                    ]),
            'filters' => $request->only(['search']),
        ]);
    }

}
