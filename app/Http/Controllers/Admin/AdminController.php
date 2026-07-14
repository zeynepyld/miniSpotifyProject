<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function artists()
    {
        $artists = DB::table('artist')->get();
        return view('admin.artists', compact('artists'));
    }

    public function artistsCreate()
    {

        return view('admin.artists-create');
    }

    public function artistsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        $exists = DB::table('artist')
            ->where('name', $request->input('name'))
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'Bu sanatçı zaten mevcut!');
        }

        DB::table('artist')->insert([
            'name' => $request->input('name'),
            'bio' => $request->input('bio'),
        ]);

        return redirect()
            ->route('admin.artists.index')
            ->with('success', 'Sanatçı başarıyla eklendi!');
    }

    public function artistsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        DB::table('artist')->where('id', $id)->update([
            'name' => $request->input('name'),
            'bio' => $request->input('bio'),
        ]);
        return redirect()->route('admin.artists.index');
    }

    public function artistsDelete($id)
    {
        DB::table('artist')->where('id', $id)->delete();
        return redirect()->route('admin.artists.index');
    }

    public function artistsEdit($id)
    {
        $artist = DB::table('artist')
            ->where('id', $id)
            ->first();

        return view('admin.artists-edit', compact('artist'));
    }

    public function albums()
    {
        $albums = DB::table('_albums')
            ->join('artist', '_albums.artist_id', '=', 'artist.id')
            ->select('_albums.*', 'artist.name as artist_name')
            ->get();
        return view('admin.albums', compact('albums'));
    }

    public function albumsCreate()
    {
        $artists = DB::table('artist')->get();
        $genres = DB::table('genres')->get();

        return view('admin.albums-create', compact('artists', 'genres'));
    }

    public function albumsStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|integer|exists:artist,id',
            'genre' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',]);
        DB::table('_albums')->insert([
            'title' => $request->input('title'),
            'artist_id' => $request->input('artist_id'),
            'genre' => $request->input('genre'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.albums.index');
    }

    public function albumsDelete($id)
    {
        DB::table('_albums')->where('id', $id)->delete();
        return redirect()->route('admin.albums.index');
    }

    public function albumsEdit($id)
    {
        $album = DB::table('_albums')->where('id', $id)->first();
        $artists = DB::table('artist')->get();
        return view('admin.albums-edit', compact('album', 'artists'));
    }

    public function albumsUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|integer|exists:artist,id',
            'genre' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);
        DB::table('_albums')->where('id', $id)->update([
            'title' => $request->input('title'),
            'artist_id' => $request->input('artist_id'),
            'genre' => $request->input('genre'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.albums.index')->with('success', 'Album updated!');
    }

    public function albumDetails($id)
    {
        $album = DB::table('_albums')->where('id', $id)->first();
        if (!$album) abort(404, 'Album not found.');

        $songs = DB::table('_songs')->where('album_id', $id)->get();

        $reviews = DB::table('reviews')
            ->leftJoin('users', 'reviews.user_id', '=', 'users.id')
            ->where('album_id', $id)
            ->select('reviews.*', 'users.name as user_name')
            ->orderBy('reviews.created_at', 'desc')
            ->get();

        return view('admin.album-details', compact('album', 'songs', 'reviews'));
    }

    public function addSong(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);
        Song::create([
            'album_id' => $id,
            'name' => $request->input('title'),
        ]);
        return back()->with('success', 'Song added!');
    }

    public function placeOrder(Request $request, $id)
    {
        $album = Album::findOrFail($id);
        if ($album->stock <= 0) {
            return back()->with('error', 'This album is out of stock.');
        }

        $order = Order::where('user_id', auth()->id() ?? 1)
            ->where('status', 3)
            ->latest()
            ->first();

        if (!$order) {

            $order = Order::create([
                'user_id' => auth()->id() ?? 1,
                'order_date' => now(),
                'total_price' => 0,
                'status' => 3,
            ]);

        }



        OrderItem::create([
            'order_id' => $order->id,
            'album_id' => $album->id,
            'quantity' => 1,
            'unit_price' => $album->price,
        ]);

        $album->decrement('stock');


        $total = OrderItem::where('order_id', $order->id)
            ->sum('unit_price');


        $order->update([
            'total_price' => $total
        ]);


        return redirect()->route('admin.orders.receipt', $order->id);
    }

    public function addReview(Request $request, $id)
    {
        $request-> validate([
            'comment' => 'required|string|max:500',
        ]);

        Review::create([
            'album_id' => $id,
            'user_id' => 1,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Comment Added!');
    }

    public function reviews()
    {
        $reviews = DB::table('reviews')
            ->leftJoin('users', 'reviews.user_id', '=', 'users.id')
            ->join('_albums', 'reviews.album_id', '=', '_albums.id')
            ->select('reviews.*', 'users.name as user_name', '_albums.title as album_title')
            ->orderBy('reviews.created_at', 'desc')
            ->get();

        return view('admin.review', compact('reviews'));
    }

    public function reviewsDelete($id)
    {
        DB::table('reviews')->where('id', $id)->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Comment Deleted!');
    }

    public function orders()
{
    $orders = Order::with('items.album')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.orders', compact('orders'));
}
    public function orderDetails($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        if (!$order) abort(404);

        $items = DB::table('orderItem')
            ->join('_albums', 'orderItem.album_id', '=', '_albums.id')
            ->where('order_id', $id)
            ->select('orderItem.*', '_albums.title as album_title')
            ->get();

        return view('admin.order-details', compact('order', 'items'));
    }
    public function orderReceipt($id)
    {
        $order = DB::table('orders')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->where('orders.id', $id)
            ->select('orders.*', 'users.name as user_name')
            ->first();

        if (!$order) {
            abort(404);
        }

        $items = DB::table('orderItem')
            ->join('_albums', 'orderItem.album_id', '=', '_albums.id')
            ->where('orderItem.order_id', $id)
            ->select(
                'orderItem.quantity',
                'orderItem.unit_price',
                '_albums.title as album_title'
            )
            ->get();

        return view('admin.order-receipt', compact('order', 'items'));
    }
    public function orderDelete($id)
    {
        $order = Order::findOrFail($id);

        OrderItem::where('order_id', $id)->delete();

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }
    public function orderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3,4',
        ]);

        Order::where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

   }
