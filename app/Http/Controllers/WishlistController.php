<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function store(Product $product)
    {
        Wishlist::firstOrCreate([

            'user_id' => auth()->id(),

            'product_id' => $product->id

        ]);

        return back()->with(
            'success',
            'Product added to wishlist.'
        );
    }

    public function index()
    {
        $wishlists = Wishlist::where(
            'user_id',
            auth()->id()
        )
        ->latest()
        ->get();

        return view(
            'wishlist.index',
            compact('wishlists')
        );
    }

    public function toggle(Product $product)
    {
        $wishlist = Wishlist::where(
            'user_id',
            auth()->id()
        )
        ->where(
            'product_id',
            $product->id
        )
        ->first();

        if($wishlist){

            $wishlist->delete();

        }else{

            Wishlist::create([

                'user_id' => auth()->id(),

                'product_id' => $product->id

            ]);
        }

        return back();
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();

        return back()->with(
            'success',
            'Item removed from wishlist.'
        );
    }
}