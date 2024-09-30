<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Article::paginate(10);
        return view('article.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $article = new Article();
        return view('article.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obj = new Article();
        $data = $request->validate([
            'name' => 'required|unique:articles',
            'body' => 'required|max:255',
        ]);
        $obj->fill($data);
        $obj->save();

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $data[] = Article::findOrFail($article->id);
        return view('article.index', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $article = Article::findOrFail($article->id);
        return view('article.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'name' => 'required|unique:articles',
            'body' => 'required|max:255',
        ]);
        
        $article->update($data);
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if (Article::find($article->id)) $article->delete();
        return redirect()->route('articles.index');
    }
}