<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArenaController extends Controller
{
    public function createForm() {
        return view('arenas.create');
    }

    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:users,name'
        ]);
        $arena = new \App\Arena();
        $arena->name = $request->get('name');
        $arena->creator_id = \Auth::user()->id;
        $arena->private = $request->get('private') === 1 ? true : false;
        $arena->save();
        return redirect(action('HomeController@index'));
    }
}
