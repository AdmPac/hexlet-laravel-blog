<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    
    public function articles() {
        $data = \App\Models\Article::paginate(4);
        return view('articles', compact('data'));
    }
}
