<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArenaController extends Controller
{
    public function createForm() {
        return view('arenas.create');
    }

    public function create() {
        
    }
}
