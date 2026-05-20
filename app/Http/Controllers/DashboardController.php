<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $produk = DB::table('products')
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $totalProduk = $produk->count();
        $totalItem = $produk->sum('stok');
        $newArrival = $produk->take(6)->count();

        return view('dashboard', compact('produk', 'totalProduk', 'totalItem', 'newArrival'));
    }

    public function katalog()
    {
        $produk = DB::table('products')
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        return view('katalog', compact('produk'));
    }

    public function detail($id)
    {
        $produk = DB::table('products')
            ->where('id', $id)
            ->first();

        return view('detail', compact('produk'));
    }

    public function admin()
    {
        $produk = DB::table('products')
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $totalItem = $produk->sum('stok');
        $totalNilai = $produk->sum(function ($item) {
            return $item->stok * $item->harga;
        });
        $stokMenipis = $produk->where('stok', '<', 5)->count();

        $editProduk = null;

        return view('admin', compact('produk', 'totalItem', 'totalNilai', 'stokMenipis', 'editProduk'));
    }
}