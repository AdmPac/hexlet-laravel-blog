<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Specialization;
use App\Models\Adboard;

class AdboardController extends Controller
{
    /**
     * Общая доска объявлений
     * @return [type]
     */
    public function index() {
        $id = Auth::id();
        $user = Auth::user();
        $specs = Specialization::all();
        $ads = Adboard::with('user')->with('specialization')->where('active', '1')->get();
        return view('pages.adboard', compact('specs', 'ads', 'id', 'user'));
    }
    
    function adboard () {
        $id = Auth::id();
        $user = Auth::user();
        $specs = Specialization::all();
        $ads = Adboard::query()->where('user_id', $id)->get();
        return view('user.adboard', compact('id', 'specs', 'ads', 'user'));
    }

    function edit(Request $request, $id, $adboard_id) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'specialization' => 'required',
        ]);
        
        $ad = Adboard::find($adboard_id);
        $ad->title = $data['title'];
        $ad->description = $data['description'];
        $ad->price = $data['price'];
        $ad->specialization()->associate($data['specialization']);
        $ad->save();

        return back();
    }

    function delete($id, $adboard_id) {
        $ad = Adboard::find($adboard_id);
        $ad->delete();
        return back();
    }

    function active($id, $adboard_id)
    {
        $ad = Adboard::find($adboard_id);
        $ad->active = !$ad->active;
        $result = $ad->save();
        return $result;
    }

    function add(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'specialization' => 'required',
        ]);

        $ad = new Adboard();
        $ad->title = $data['title'];
        $ad->description = $data['description'];
        $ad->price = $data['price'];
        $ad->specialization()->associate($data['specialization']);
        $ad->user()->associate(Auth::id());
        $ad->save();
        
        return back();
    }
}
