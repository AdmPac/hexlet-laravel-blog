<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;

class LoginController extends Controller
{
    public function index() 
    {   
        return view('login.index');
    }

    public function create() 
    {
        $user = new User();
        return view('login.create', compact('user'));
    }
    
    public function store(Request $request) { // store обрабатывает запрос с формы create()
        $user = new User();
        $data = $request->validate([
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
        ]);
        $user->email = $data['email'];
        $user->password = md5($data['password']);
        $user->save();
        return redirect()->route('login.create');
    }
}
