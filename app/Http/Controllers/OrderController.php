<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(Product $product)
    {
        return view(
            'orders.checkout',
            compact('product')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'product_id' => 'required',

            'name' => 'required',

            'phone' => 'required|numeric|digits_between:10,15',

            'address' => 'required'

        ]);

        $product = Product::findOrFail(
            $validated['product_id']
        );

        if($product->stok <= 0){

            return back()->with(
                'error',
                'Product is sold out.'
            );

        }

        Order::create([

            'user_id' => auth()->id(),

            'product_id' => $product->id,

            'name' => $validated['name'],

            'phone' => $validated['phone'],

            'address' => $validated['address'],

            'total_price' => $product->harga,

            'status' => 'Pending'

        ]);

        $product->decrement('stok');

        return redirect()
            ->route('orders.index')
            ->with(
                'success',
                'Order placed successfully.'
            );
    }

    public function index()
    {
        $orders = Order::where(
                'user_id',
                auth()->id()
            )
            ->latest()
            ->get();

        return view(
            'orders.index',
            compact('orders')
        );
    }

    public function adminIndex()
    {
        $orders = Order::with([
                'product',
                'user'
            ])
            ->latest()
            ->get();

        return view(
            'orders.admin',
            compact('orders')
        );
    }

    public function confirm(Order $order)
    {
        if($order->status == 'Pending')
        {
            $order->update([
                'status' => 'Confirmed'
            ]);
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Order confirmed.'
            );
    }

    public function cancel(Order $order)
    {
        if($order->status == 'Pending')
        {
            $product = $order->product;

            if($product)
            {
                $product->increment('stok');
            }

            $order->update([
                'status' => 'Cancelled'
            ]);
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Order cancelled successfully.'
            );
    }

}