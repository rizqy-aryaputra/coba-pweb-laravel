@extends('layouts.app')

@section('content')

<div class="orders-container">

    <div class="orders-header">

        <span>ORDER MANAGEMENT</span>

        <h1>Customer Orders</h1>

        <p>
            Manage and confirm incoming orders.
        </p>

    </div>

    @if(session('success'))

        <div class="success-alert">

            {{ session('success') }}

        </div>

    @endif

    @forelse($orders as $order)

        <div class="order-card">

            <div class="order-image">

                @if($order->product->foto)

                    <img
                        src="{{ asset($order->product->foto) }}"
                    >

                @endif

            </div>

            <div class="order-content">

                <div class="order-top">

                    <div>

                        <h3>

                            {{ strtoupper($order->product->nama) }}

                        </h3>

                        <div class="price">

                            Rp {{ number_format($order->total_price) }}

                        </div>

                    </div>

                    <span
                        class="status
                        {{ strtolower($order->status) }}"
                    >

                        {{ $order->status }}

                    </span>

                </div>

                <div class="customer-info">

                    <p>
                        <strong>Customer:</strong>
                        {{ $order->name }}
                    </p>

                    <p>
                        <strong>Phone:</strong>
                        {{ $order->phone }}
                    </p>

                    <p>
                        <strong>Address:</strong>
                        {{ $order->address }}
                    </p>

                    <p>
                        <strong>Order Date:</strong>
                        {{ $order->created_at->format('d M Y') }}
                    </p>

                </div>

                @if($order->status == 'Pending')

                    <div class="action-buttons">

                        <form
                            action="{{ route('admin.orders.confirm',$order) }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="confirm-btn"
                            >

                                CONFIRM ORDER

                            </button>

                        </form>

                        <form
                            action="{{ route('orders.cancel',$order) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="cancel-link"
                                onclick="
                                    return confirm(
                                        'Cancel this order?'
                                    )
                                "
                            >

                                Cancel Order

                            </button>

                        </form>

                    </div>

                @endif

            </div>

        </div>

    @empty

        <div class="empty-orders">

            No orders found.

        </div>

    @endforelse

</div>

<style>

.orders-container{
    width:90%;
    margin:60px auto;
}

.orders-header{
    margin-bottom:50px;
}

.orders-header span{
    letter-spacing:4px;
    font-size:12px;
    color:#777;
}

.orders-header h1{
    font-size:52px;
    font-weight:300;
    margin:15px 0;
}

.orders-header p{
    color:#777;
}

.order-card{
    display:grid;
    grid-template-columns:240px 1fr;
    gap:35px;

    padding:30px;

    margin-bottom:25px;

    background:white;

    border-radius:20px;

    box-shadow:0 5px 20px rgba(0,0,0,.05);
}

.order-image img{
    width:100%;
    height:240px;
    object-fit:cover;
    border-radius:15px;
}

.order-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
}

.order-top h3{
    font-size:26px;
    font-weight:400;
}

.price{
    margin-top:10px;
    font-size:22px;
    font-weight:600;
}

.customer-info{
    margin-top:25px;
}

.customer-info p{
    margin-bottom:10px;
    color:#555;
}

.status{
    font-size:12px;
    letter-spacing:2px;
}

.status.pending{
    color:#9c7a3f;
}

.status.confirmed{
    color:#2e7d32;
}

.confirm-btn{
    margin-top:25px;

    background:black;
    color:white;

    border:none;

    padding:
        14px
        28px;

    letter-spacing:2px;

    cursor:pointer;
}

.success-alert{
    background:#eef8ee;
    color:#2e7d32;

    padding:18px;

    border-radius:10px;

    margin-bottom:30px;
}

.empty-orders{
    text-align:center;
    padding:100px;
}

.status.cancelled{

    background:#f8f8f8;

    color:#555;

    border:1px solid #ddd;
}

.action-buttons{

    display:flex;

    align-items:center;

    gap:24px;

    margin-top:25px;
}

.confirm-btn{

    background:black;

    color:white;

    border:none;

    padding:14px 28px;

    letter-spacing:2px;

    cursor:pointer;
}

.action-buttons{

    display:flex;

    align-items:center;

    gap:25px;

    margin-top:25px;
}

.cancel-link{

    background:none;

    border:none;

    padding:0;

    color:#777;

    font-size:13px;

    letter-spacing:1px;

    border-bottom:1px solid #ddd;

    cursor:pointer;

    transition:.3s;
}

.cancel-link:hover{

    color:black;

    border-color:black;
}

.status{

    display:inline-flex;

    align-items:center;

    gap:10px;

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

    display:block;
}

.status.pending{

    color:#b79a63;
}

.status.pending::before{

    background:#b79a63;
}

.status.confirmed{

    color:#4b7b4b;
}

.status.confirmed::before{

    background:#4b7b4b;
}

.status.cancelled{

    color:#888;
}

.status.cancelled::before{

    background:#888;
}

@media(max-width:768px){

    .order-card{
        grid-template-columns:1fr;
    }

}

</style>

@endsection