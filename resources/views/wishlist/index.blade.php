@extends('layouts.customer')

@section('content')

<div class="wishlist-container">

    <div class="wishlist-header">

        <span>
            SAVED ITEMS
        </span>

        <h1>
            My Wishlist
        </h1>

        <p>
            Your curated collection of timeless pieces.
        </p>

    </div>

    @if($wishlists->count())

        <div class="wishlist-grid">

            @foreach($wishlists as $wishlist)

                <a
                    href="{{ route(
                        'products.show',
                        $wishlist->product
                    ) }}"
                    class="wishlist-card"
                >

                    @if($wishlist->product->foto)

                        <img
                            src="{{ asset(
                                $wishlist->product->foto
                            ) }}"
                            class="wishlist-image"
                        >

                    @endif

                    <div class="wishlist-info">

                        <h3>
                            {{ strtoupper(
                                $wishlist->product->nama
                            ) }}
                        </h3>

                        <p class="category">
                            {{ $wishlist->product->kategori }}
                        </p>

                        <p class="price">

                            Rp
                            {{ number_format(
                                $wishlist->product->harga
                            ) }}

                        </p>

                    </div>

                </a>

            @endforeach

        </div>

    @else

        <div class="empty-wishlist">

            <div class="heart-icon">

                ♡

            </div>

            <h2>

                Your wishlist is waiting.

            </h2>

            <p>

                Save luxury pieces you love
                and revisit them anytime.

            </p>

            <a
                href="{{ route('products.index') }}"
                class="browse-btn"
            >

                BROWSE COLLECTION

            </a>

        </div>

    @endif

</div>

<style>

.wishlist-container{

    width:88%;
    margin:80px auto;
}

.wishlist-header{

    margin-bottom:60px;
}

.wishlist-header span{

    font-size:12px;
    letter-spacing:4px;
    color:#777;
}

.wishlist-header h1{

    font-size:52px;
    font-weight:300;

    margin-top:15px;
    margin-bottom:15px;
}

.wishlist-header p{

    color:#777;
    font-size:16px;
}

.wishlist-grid{

    display:grid;

    grid-template-columns:
        repeat(auto-fill,minmax(280px,1fr));

    gap:40px;
}

.wishlist-card{

    color:black;

    transition:.3s;
}

.wishlist-card:hover{

    transform:translateY(-5px);
}

.wishlist-image{

    width:100%;
    height:420px;

    object-fit:cover;

    margin-bottom:20px;

    background:#f7f7f7;
}

.wishlist-info h3{

    font-size:15px;
    letter-spacing:1px;

    margin-bottom:8px;
}

.category{

    color:#888;
    font-size:14px;

    margin-bottom:12px;
}

.price{

    font-size:15px;
    font-weight:600;
}

.empty-state{

    text-align:center;

    padding:120px 0;
}

.empty-state h2{

    font-size:40px;
    font-weight:300;

    margin-bottom:15px;
}

.empty-state p{

    color:#777;

    margin-bottom:35px;
}

.shop-btn{

    display:inline-block;

    padding:15px 35px;

    background:black;
    color:white;

    letter-spacing:2px;
}

.shop-btn:hover{

    opacity:.85;
}

.empty-wishlist{

    text-align:center;

    padding:120px 20px;
}

.heart-icon{

    font-size:70px;

    margin-bottom:20px;

    color:#999;
}

.empty-wishlist h2{

    font-size:42px;

    font-weight:300;

    margin-bottom:20px;
}

.empty-wishlist p{

    color:#666;

    line-height:1.8;

    margin-bottom:40px;
}

.browse-btn{

    display:inline-block;

    padding:
        16px
        38px;

    background:black;

    color:white;

    letter-spacing:3px;

    font-size:12px;

    transition:.3s;
}

.browse-btn:hover{

    opacity:.85;
}

</style>

@endsection