<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orderItem';
    protected $fillable = ['order_id', 'album_id', 'quantity', 'unit_price'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}
