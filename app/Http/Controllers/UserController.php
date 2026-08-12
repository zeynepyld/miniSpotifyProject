<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Artist;
class UserController extends Controller
{
    public function index()
    {
        $topAlbums = Album::with(['artist', 'reviews'])
            ->get()
            ->sortByDesc(function ($album) {
                return $album->reviews->avg('rating');
            })
            ->take(3);

        return view('user.index', compact('topAlbums'));
    }

    public function artists()
    {
        $artists = Artist::all();

        return view('user.artists', compact('artists'));
    }
    public function artistDetails($id)
    {
        $artist = Artist::findOrFail($id);

        return view('user.artist-details', compact('artist'));
    }

    public function albums(Request $request)
    {
        $query = Album::with(['artist','reviews']);

        if($request->artist_id)
        {
            $query->where('artist_id',$request->artist_id);
        }

        $albums = $query->get();

        $artists = Artist::all();

        return view('user.albums', compact(
            'albums',
            'artists'
        ));
    }

    public function albumDetails($id)
    {
        $album = Album::with(['artist', 'reviews'])->findOrFail($id);

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
        $album = Album::with(['artist', 'reviews'])->findOrFail($id);

        $songs = $album->songs;

        $reviews = $album->reviews()
            ->leftJoin('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*', 'users.name as user_name')
            ->get();

        return view('user.details', compact(
            'album',
            'songs',
            'reviews'
        ));
    }
}
