<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'artist';
    protected $fillable = ['name', 'bio'];

    public function albums()
    {
        return $this->hasMany(Album::class, 'artist_id');
    }
}
