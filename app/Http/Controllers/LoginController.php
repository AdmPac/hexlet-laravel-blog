<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\UserVerified;

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
    }
    
    public function verify(Request $request, $code) {
        if (session('code') != $code) {
            return back()->withErrors(['Неверный код']);
        } else {
            $existsUser = User::where('email', session('email'));
            if (!$existsUser->exists()) {
                $user = new User();
                $user->email = session('email');
                $user->password = md5(session('password'));
                $user->avatar = 'build/assets/img/default/avatar/flat_blue_1.svg';
                
                $user->save();
                $id = $user->id;
                Auth::loginUsingId($id);
                return redirect()->route('user.index', compact('id'));
            } else {
                return back()->withErrors(['Неверный код']);
            }
        }
    }
    
    public function store(Request $request) { // store обрабатывает запрос с формы create()
        $data = $request->validate([
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
        ]);
        $data['code'] = md5($data['email']);
        event(new UserVerified($data));
        return view('login.verify', compact('data'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
