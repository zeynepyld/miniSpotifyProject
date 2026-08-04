<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Breeze Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect('/user');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | User Panel
    |--------------------------------------------------------------------------
    */

    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');

    Route::get('/user/albums', [UserController::class, 'albums'])->name('user.albums');

    Route::get('/user/favorites', function () {
        return view('user.favorites');
    })->name('user.favorites');

    Route::get('/user/orders', function () {
        return view('user.orders');
    })->name('user.orders');
});

/*
|--------------------------------------------------------------------------
| Admin Panel (Eski çalışan panel)
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

Route::get('/admin/artists', [AdminController::class, 'artists'])->name('admin.artists.index');
Route::get('/admin/artists/create', [AdminController::class, 'artistsCreate'])->name('admin.artists.create');
Route::post('/admin/artists/store', [AdminController::class, 'artistsStore'])->name('admin.artists.store');
Route::get('/admin/artists/{id}/edit', [AdminController::class, 'artistsEdit'])->name('admin.artists.edit');
Route::post('/admin/artists/{id}/update', [AdminController::class, 'artistsUpdate'])->name('admin.artists.update');
Route::post('/admin/artists/{id}/delete', [AdminController::class, 'artistsDelete'])->name('admin.artists.delete');

Route::get('/admin/albums', [AdminController::class, 'albums'])->name('admin.albums.index');
Route::get('/admin/albums/create', [AdminController::class, 'albumsCreate'])->name('admin.albums.create');
Route::post('/admin/albums/store', [AdminController::class, 'albumsStore'])->name('admin.albums.store');
Route::get('/admin/albums/delete/{id}', [AdminController::class, 'albumsDelete'])->name('admin.albums.delete');
Route::get('/admin/albums/edit/{id}', [AdminController::class, 'albumsEdit'])->name('admin.albums.edit');
Route::post('/admin/albums/update/{id}', [AdminController::class, 'albumsUpdate'])->name('admin.albums.update');

Route::get('/admin/reviews', [AdminController::class, 'reviews'])->name('admin.reviews.index');
Route::get('/admin/reviews/delete/{id}', [AdminController::class, 'reviewsDelete'])->name('admin.reviews.delete');

Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders.index');

Route::get('/albums/{id}', [AdminController::class, 'albumDetails'])->name('admin.albums.details');

Route::post('/admin/albums/{id}/add-song', [AdminController::class, 'addSong'])->name('admin.songs.store');
Route::post('/admin/albums/{id}/add-review', [AdminController::class, 'addReview'])->name('admin.reviews.store');

Route::get('/admin/orders/details/{id}', [AdminController::class, 'orderDetails'])->name('admin.orders.details');
Route::get('/admin/orders/receipt/{id}', [AdminController::class, 'orderReceipt'])->name('admin.orders.receipt');

Route::post('/admin/orders/{id}/delete', [AdminController::class, 'orderDelete'])->name('admin.orders.delete');
Route::post('/admin/order/place/{id}', [AdminController::class, 'placeOrder'])->name('admin.order.place');
Route::post('/admin/orders/{id}/status', [AdminController::class, 'orderStatus'])->name('admin.orders.status');

require __DIR__.'/auth.php';
