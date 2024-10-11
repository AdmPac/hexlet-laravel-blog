<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    function store(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $works = array_filter($request->works, function($work) {
                return !is_null($work);
            });
            $education = array_filter($request->works, function($work) {
                return !is_null($work);
            });
            $request->merge(['works' => $works]);
            $request->education = $education;
            $user->fill($request->all());            
            $user->save();
        } else {
            return back()->withErrors(['User ' . $request->id . ' not found']);
        }
        return back()->with('success', 'Изменения сохранены');
    }

    
    public function person($id) {
        
        if ($id == Auth::id()) { // своя страница
            $user = Auth::user();
            $my_page = 1;
        } else {
            $my_page = 0;
            $user = User::find($id);
        }

        if ($user->works) $user->works = json_decode($user->works);
        
        if (is_array($user->works)) {
            $works = [];
            foreach ($user->works as $work) {
                if ($work != null) $works[] = $work;
            }
            $user->works = $works;
        }        
        if ($user->education) $user->education = json_decode($user->education);
        if (is_array($user->education)) {
            $education = [];
            foreach ($user->education as $edu) {
                if ($edu != null) $education[] = $edu;
            }
            $user->education = $education;
        }
        return view('user.index', compact('id', 'user', 'my_page'));
    }
}
