<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Review;
use App\Models\Song;


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

    public function albumDetails($id)
    {
        $album = Album::findOrFail($id);

        $songs = $album->songs;

        $reviews = $album->reviews()
            ->leftJoin('users', 'review.user_id', '=', 'users.id')
            ->select('review.*', 'users.name as user_name')
            ->get();

        return view('user.details', compact(
            'album',
            'songs',
            'reviews'
        ));
    }
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('user.orders', compact('orders'));
    }

    public function details($id)
    {
        $album = Album::findOrFail($id);

        $songs = $album->songs;

        $reviews = $album->reviews()
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*', 'users.name as user_name')
            ->get();

        return view('user.details', compact(
            'album',
            'songs',
            'reviews'
        ));
    }
}
