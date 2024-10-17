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
        if (Auth::check()) {
            $id = Auth::id();
            return redirect()->route('user.index', $id);
        }
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
            return redirect()->route('user.index', Auth::id());
        }
        return back()->withErrors(['Неверный логин или пароль']);
    }

    public function create()
    {
        if (Auth::check()) {
            $id = Auth::id();
            return redirect()->route('user.index', $id);
        } else {
            return view('login.create');
        }
        $user = new User();
        $user->avatar = 'build/assets/img/default/avatar/flat_blue_1.svg';
        $user->save();
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
