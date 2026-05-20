<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori',
        'harga',
        'stok',
        'aktif',
        'foto',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
        'aktif' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_produk')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}



