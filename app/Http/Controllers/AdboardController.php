<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdboardController extends Controller
{
    public function index() {
        return view('pages.adboard');
    }
}
