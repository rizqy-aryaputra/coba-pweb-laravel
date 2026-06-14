<?php

namespace App\Models;
use App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'kode',
        'nama',
        'kategori',
        'stok',
        'harga',
        'tanggal_masuk',
        'foto',
        'user_id'
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function orders()
    {
        return $this->hasMany(
            Order::class
        );
    }
}