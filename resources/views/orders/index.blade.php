@extends('layouts.customer')

@section('content')

<div class="orders-container">

    <div class="orders-header">

        <span>MY PURCHASES</span>

        <h1>Order History</h1>

        <p>
            Track your luxury purchases.
        </p>

    </div>

    @if(session('success'))

        <div class="success-alert">

            ✓ {{ session('success') }}

        </div>

    @endif

    @forelse($orders as $order)

        <div class="order-card">

            <div class="order-image">

                @if($order->product->foto)

                    <img
                        src="{{ asset($order->product->foto) }}"
                        alt="{{ $order->product->nama }}"
                    >

                @endif

            </div>

            <div class="order-content">

                <div class="order-top">

                    <h3>

                        {{ strtoupper($order->product->nama) }}

                    </h3>

                    <span class="status">

                        {{ $order->status }}

                    </span>

                </div>

                <p class="price">

                    Rp {{ number_format($order->total_price) }}

                </p>

                <p class="date">

                    Ordered on
                    {{ $order->created_at->format('d M Y') }}

                </p>

                <p class="address">

                    {{ $order->address }}

                </p>

            </div>

        </div>

    @empty
        <div class="empty-orders">

            <h2>
                No Orders Yet
            </h2>

            <p>
                Start exploring our collection.
            </p>

            <a
                href="{{ route('products.index') }}"
                class="shop-btn"
            >
                SHOP NOW
            </a>

        </div>

    @endforelse

</div>


<style>

.orders-container{
    width:88%;
    margin:80px auto;
}

.orders-header{
    margin-bottom:50px;
}

.orders-header span{
    letter-spacing:4px;
    color:#777;
    font-size:12px;
}

.orders-header h1{
    font-size:52px;
    font-weight:300;
    margin:15px 0;
}

.order-card{

    display:grid;

    grid-template-columns:
        220px 1fr;

    gap:30px;

    padding:25px;

    border:1px solid #eee;

    margin-bottom:25px;

    background:white;
}

.order-image img{

    width:100%;

    height:220px;

    object-fit:cover;

    background:#f7f7f7;
}

.order-top{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:15px;
}

.order-top h3{

    font-size:22px;

    font-weight:400;
}

.status{

    display:inline-flex;

    align-items:center;

    gap:10px;

    color:#8b7355;

    font-size:12px;

    letter-spacing:2px;

    text-transform:uppercase;

    font-weight:500;
}

.status::before{

    content:'';

    width:7px;

    height:7px;

    border-radius:50%;

    background:#b79a63;

    display:block;
}

.price{

    font-size:20px;

    font-weight:600;

    margin-bottom:12px;
}

.date{

    color:#777;

    margin-bottom:15px;
}

.address{

    color:#555;

    line-height:1.8;
}

.empty-orders{
    text-align:center;
    padding:120px 0;
}

.shop-btn{
    display:inline-block;
    margin-top:20px;
    padding:14px 30px;
    background:black;
    color:white;
}

.success-alert{

    background:#f8f8f8;

    color:#111;

    padding:20px 24px;

    margin-bottom:35px;

    border-left:3px solid black;

    font-size:14px;

    letter-spacing:1px;
}

@media(max-width:768px){

    .order-card{

        grid-template-columns:1fr;
    }

    .order-image img{

        height:300px;
    }

}

</style>

@endsection