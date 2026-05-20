<?php

namespace App\Models;

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
}