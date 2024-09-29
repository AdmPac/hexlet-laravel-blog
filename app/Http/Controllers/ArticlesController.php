<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    
    public function articles() {
        $data = \App\Models\Article::paginate(10);
        return view('article.articles', compact('data'));
    }
    
    public function articles_id($id) {
        $data[] = \App\Models\Article::findOrFail($id);
        return view('article.articles', compact('data'));
    }
    public function create() {
        $article = new \App\Models\Article();
        return view('article.create', compact('article'));       
    }

    public function store(Request $request) {
        $article = new \App\Models\Article();
        $data = $request->validate([
            'name' => 'required|unique:articles',
            'body' => 'required',
        ]);
        $article->fill($data);
        $article->save();

        return redirect()->route('arc');
    }
}
