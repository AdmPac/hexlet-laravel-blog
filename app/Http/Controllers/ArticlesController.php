<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    
    public function articles() {
        $data = \App\Models\Article::paginate(4);
        return view('articles', compact('data'));
    }
    
    public function articles_id($id) {
        $data[] = \App\Models\Article::findOrFail($id);
        return view('articles', compact('data'));
    }
}
