@extends('layouts.customer')

@section('content')

<div class="breadcrumb">

    <a href="{{ route('home') }}">

        HOME

    </a>

    <span>/</span>

    <a href="{{ route('products.index') }}">

        COLLECTION

    </a>

    <span>/</span>

    <a
        href="{{ route(
            'products.index',
            ['category' => $product->kategori]
        ) }}"
    >

        {{ strtoupper($product->kategori) }}

    </a>

    <span>/</span>

    <span class="current">

        {{ strtoupper($product->nama) }}

    </span>

</div>

<div class="product-detail">

    <!-- IMAGE -->

    <div class="product-gallery">

        @if($product->foto)

            <img
                src="{{ asset($product->foto) }}"
                alt="{{ $product->nama }}"
                class="main-image"
            >

        @else

            <div class="no-image">

                No Image

            </div>

        @endif

    </div>

    <!-- INFO -->

    <div class="product-info">

        <div class="product-category">

            {{ strtoupper($product->kategori) }}

        </div>

        <h1>

            {{ strtoupper($product->nama) }}

        </h1>

        <div class="product-price">

            @if($product->stok > 0)

                Rp {{ number_format($product->harga) }}

            @else

                <span style="color:#999;">
                    OUT OF STOCK
                </span>

            @endif

        </div>

        <p class="product-description">

            Authentic preloved luxury item
            carefully curated for its next owner.

            Timeless design, exceptional quality,
            and ready for its next chapter.

        </p>

        <div class="product-meta">

            <div>

                <span>Stock</span>

                <p>

                    {{ $product->stok }}

                </p>

            </div>

            <div>

                <span>Date Added</span>

                <p>

                    {{ $product->tanggal_masuk }}

                </p>

            </div>

        </div>

        @php

            $isWishlisted = false;

            if(auth()->check()){

                $isWishlisted =
                    auth()->user()
                        ->wishlists()
                        ->where(
                            'product_id',
                            $product->id
                        )
                        ->exists();

            }

        @endphp

        @auth

            @if(auth()->user()->role == 'customer')

                <form
                    action="{{ route(
                        'wishlist.toggle',
                        $product
                    ) }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="wishlist-btn
                            {{ $isWishlisted ? 'active' : '' }}"
                    >

                        @if($isWishlisted)

                            ♥ Wishlisted

                        @else

                            ♡ Add to Wishlist

                        @endif

                    </button>

                </form>

                <div class="action-buttons">

                    @if($product->stok > 0)

                        <a
                            href="{{ route(
                                'checkout',
                                $product
                            ) }}"
                            class="buy-btn"
                        >

                            Buy Now

                        </a>

                    @else

                        <button
                            class="sold-btn"
                            disabled
                        >

                            SOLD OUT

                        </button>

                    @endif

                    <a
                        href="{{ route('products.index') }}"
                        class="back-btn"
                    >

                        ← Back to Collection

                    </a>

                </div>

            @endif

        @endauth

    </div>

</div>

<!-- RELATED PRODUCTS -->

<section class="related-products">

    <h2>

        More {{ strtoupper($product->kategori) }}
        Collection

    </h2>

    <div class="related-grid">

        @foreach($relatedProducts as $item)

            <a
                href="{{ route(
                    'products.show',
                    $item
                ) }}"
                class="related-card"
            >

                @if($item->foto)

                    <img
                        src="{{ asset(
                            $item->foto
                        ) }}"
                    >

                @endif

                <h3>

                    {{ strtoupper(
                        $item->nama
                    ) }}

                </h3>

                <p>

                    Rp
                    {{ number_format(
                        $item->harga
                    ) }}

                </p>

            </a>

        @endforeach

    </div>

</section>

<style>

/* =========================
   PRODUCT DETAIL
========================= */

/* =========================
   BREADCRUMB
========================= */

.breadcrumb{

    width:88%;
    max-width:1400px;

    margin:60px auto 0;

    display:flex;

    gap:12px;

    flex-wrap:wrap;

    font-size:11px;

    letter-spacing:2px;

    color:#888;
}

.breadcrumb a{

    color:#888;

    transition:.3s;
}

.breadcrumb a:hover{

    color:black;
}

.current{

    color:black;

    font-weight:500;
}

.product-detail{

    width:88%;
    max-width:1400px;

    margin:80px auto;

    display:grid;

    grid-template-columns:55% 45%;

    gap:80px;

    align-items:start;
}

.product-gallery{

    background:#fafafa;

    min-height:800px;

    display:flex;

    justify-content:center;

    align-items:flex-start;

    padding:40px;
}

.main-image{

    width:100%;

    max-height:700px;

    object-fit:contain;
}

.no-image{

    height:850px;

    background:#eee;

    display:flex;

    justify-content:center;

    align-items:center;
}

.product-category{

    letter-spacing:4px;

    font-size:12px;

    color:#777;
}

.product-info h1{

    margin-top:15px;

    font-size:48px;

    font-weight:300;

    line-height:1.1;
}

.product-price{

    margin-top:25px;

    font-size:30px;

    font-weight:600;
}

.product-description{

    margin-top:35px;

    color:#666;

    line-height:2;
}

.product-meta{

    margin-top:40px;

    display:flex;

    gap:80px;
}

.product-meta span{

    color:#888;

    font-size:12px;

    letter-spacing:2px;
}

.product-meta p{

    margin-top:10px;

    font-size:16px;
}

.wishlist-btn{

    margin-top:50px;

    padding:
        16px
        35px;

    background:black;

    color:white;

    border:none;

    cursor:pointer;

    letter-spacing:2px;

    transition:.3s;
}

.wishlist-btn.active{

    background:white;

    color:black;

    border:1px solid black;
}

.back-btn{

    display:inline-block;

    margin-top:30px;

    color:black;
}

.buy-btn{

    display:inline-block;

    margin-top:15px;

    padding:
        16px
        35px;

    background:white;

    color:black;

    border:1px solid black;

    letter-spacing:2px;
}

.sold-btn{

    display:inline-block;

    margin-top:15px;

    padding:
        16px
        35px;

    background:#d9d9d9;

    color:#666;

    border:none;

    letter-spacing:2px;

    cursor:not-allowed;
}

.action-buttons{

    margin-top:20px;

    display:flex;

    flex-direction:column;

    align-items:flex-start;

    gap:16px;
}

.buy-btn,
.sold-btn{

    width:260px;

    text-align:center;
}

.back-btn{

    margin-top:0;

    color:#666;

    font-size:15px;

    transition:.3s;
}

.back-btn:hover{

    color:black;

    transform:translateX(5px);
}

/* =========================
   RELATED
========================= */

.related-products{

    width:88%;

    margin:
        120px auto;
}

.related-products h2{

    font-size:38px;

    font-weight:300;

    margin-bottom:40px;
}

.related-grid{

    display:grid;

    grid-template-columns:
        repeat(4,1fr);

    gap:30px;
}

.related-card{

    color:black;
}

.related-card img{

    width:100%;

    height:350px;

    object-fit:cover;

    margin-bottom:15px;
}

.related-card h3{

    font-size:14px;

    margin-bottom:8px;
}

.related-card p{

    color:#555;
}

/* =========================
   MOBILE
========================= */

@media(max-width:992px){

    .product-detail{

        grid-template-columns:1fr;
    }

    .main-image{

        height:550px;
    }

    .related-grid{

        grid-template-columns:
            repeat(2,1fr);
    }

}

@media(max-width:768px){

    .product-info h1{

        font-size:42px;
    }

    .related-grid{

        grid-template-columns:1fr;
    }

}

</style>

@endsection
