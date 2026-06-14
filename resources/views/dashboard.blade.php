@extends('layouts.customer')

@section('content')

@php

$recentProducts = \App\Models\Product::whereIn(
    'id',
    session('recent_products', [])
)->get();

@endphp

<section class="account-header">

    <span>
        MY ACCOUNT
    </span>

    <h1>

        Welcome back,
        {{ auth()->user()->name }}

    </h1>

    <p>

        Continue exploring curated luxury pieces.

    </p>

</section>

<section class="account-stats">

    <div class="stat-item">

        <span>
            Wishlist Items
        </span>

        <h2>

            {{ auth()->user()->wishlists()->count() }}

        </h2>

    </div>

    <div class="stat-item">

        <span>
            Recently Viewed
        </span>

        <h2>

            {{ count(session('recent_products', [])) }}

        </h2>

    </div>

    <div class="stat-item">

        <span>
            Member Since
        </span>

        <h2>

            {{ auth()->user()->created_at->format('M Y') }}

        </h2>

    </div>

</section>

<section class="account-services">

    <a
        href="{{ route('profile.edit') }}"
        class="service-card"
    >

        <span>
            ACCOUNT
        </span>

        <h3>

            Profile Settings

        </h3>

        <p>

            Update your personal information
            and account details.

        </p>

    </a>

    <a
        href="{{ route('orders.index') }}"
        class="service-card"
    >

        <span>
            PURCHASES
        </span>

        <h3>

            Order History

        </h3>

        <p>

            View and track all your
            luxury purchases.

        </p>

    </a>

</section>

<section class="quick-links">

    <a
        href="{{ route('products.index') }}"
        class="quick-btn"
    >

        Shop Collection

    </a>

    <a
        href="{{ route('wishlist.index') }}"
        class="quick-btn"
    >

        View Wishlist

    </a>

</section>

@if($recentProducts->count())

<section class="recent-section">

    <div class="section-title">

        RECENTLY VIEWED

    </div>

    <div class="product-grid">

        @foreach($recentProducts as $product)

            <a
                href="{{ route('products.show',$product) }}"
                class="product-card"
            >

                @if($product->foto)

                    <img
                        src="{{ asset($product->foto) }}"
                        class="product-image"
                    >

                @endif

                <h3>

                    {{ strtoupper($product->nama) }}

                </h3>

                <p>

                    Rp
                    {{ number_format($product->harga) }}

                </p>

            </a>

        @endforeach

    </div>

</section>

@endif

<style>

.account-header{

    width:88%;
    margin:90px auto 70px;
}

.account-header span{

    letter-spacing:4px;
    font-size:12px;
    color:#777;
}

.account-header h1{

    margin-top:15px;

    font-size:68px;

    font-weight:300;

    line-height:1.1;
}

.account-header p{

    margin-top:20px;

    color:#666;

    font-size:18px;
}

.account-stats{

    width:88%;
    margin:auto;

    display:grid;

    grid-template-columns:
        repeat(3,1fr);

    border-top:1px solid #eee;
    border-bottom:1px solid #eee;
}

.account-services{

    width:88%;

    margin:70px auto;

    display:grid;

    grid-template-columns:
        repeat(2,1fr);

    gap:25px;
}

.service-card{

    border:1px solid #eee;

    padding:40px;

    color:black;

    transition:.3s;
}

.service-card:hover{

    transform:translateY(-4px);

    box-shadow:
        0 15px 35px rgba(0,0,0,.06);
}

.service-card span{

    font-size:11px;

    letter-spacing:3px;

    color:#888;
}

.service-card h3{

    margin-top:15px;

    margin-bottom:15px;

    font-size:28px;

    font-weight:300;
}

.service-card p{

    color:#666;

    line-height:1.8;
}

.stat-item{

    padding:40px 0;
}

.stat-item span{

    font-size:12px;

    letter-spacing:3px;

    color:#888;
}

.stat-item h2{

    margin-top:15px;

    font-size:42px;

    font-weight:300;
}

.quick-links{

    width:88%;
    margin:70px auto;

    display:flex;

    gap:20px;
}

.quick-btn{

    border:1px solid #111;

    padding:
        16px
        35px;

    color:black;

    transition:.3s;
}

.quick-btn:hover{

    background:black;

    color:white;
}

.recent-section{

    width:88%;

    margin:120px auto;
}

.section-title{

    font-size:14px;

    letter-spacing:4px;

    margin-bottom:40px;
}

.product-grid{

    display:grid;

    grid-template-columns:
        repeat(4,1fr);

    gap:30px;
}

.product-card{

    color:black;
}

.product-image{

    width:100%;

    height:350px;

    object-fit:cover;

    margin-bottom:15px;
}

.product-card h3{

    font-size:14px;

    margin-bottom:8px;
}

.product-card p{

    color:#555;
}

@media(max-width:992px){

    .account-header h1{

        font-size:48px;
    }

    .account-stats{

        grid-template-columns:1fr;
    }

    .product-grid{

        grid-template-columns:
            repeat(2,1fr);
    }

    .account-services{

        grid-template-columns:1fr;
    }

}

@media(max-width:768px){

    .product-grid{

        grid-template-columns:1fr;
    }

}

</style>

@endsection