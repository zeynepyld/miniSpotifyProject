<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = '_albums';
    protected $fillable = ['title', 'artist_id', 'genre', 'price', 'stock'];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'album_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'album_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'album_id');
    }

}
