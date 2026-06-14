<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalCustomers = User::where('role', 'customer')->count();

        $latestProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCustomers',
            'latestProducts'
        ));
    }
}