<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = ['album_id', 'user_id', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}
