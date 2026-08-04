<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function albums()
    {
        $albums = Album::all();

        return view('user.albums', compact('albums'));
    }
}
