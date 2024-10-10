<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    public function person($id) {
        $user = Auth::user();
        
        return view('user.index', compact('id', 'user'));
    }
}
