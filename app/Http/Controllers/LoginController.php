<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() 
    {   
        return view('login.index');
    }

    public function login() 
    {   
        return view('login.login');
    }

    public function auth(Request $request) 
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->intended('user.index');
        }
        return back()->withErrors(['Неверный логин или пароль']);
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
        $user->password = $data['password'];
        // $user->password = md5($data['password']);
        $user->save();
        return redirect()->route('login.create');
    }
}
