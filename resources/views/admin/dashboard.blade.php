@extends('layouts.app')

@section('content')

<div class="dashboard-container">

    <!-- HERO -->

    <div class="hero-section">

        <div>

            <h1>
                Hi, {{ auth()->user()->name }} 👋
            </h1>

            <p>
                Welcome back to SECOND CHANCE
            </p>

        </div>

        <div class="hero-buttons">

            <a href="/products" class="btn">
                Manage Products
            </a>

            <a href="/products/create" class="btn">
                + Add Product
            </a>

            <a
                href="{{ route('admin.orders') }}"
                class="btn"
            >
                Orders
            </a>

            <a href="/preferensi" class="btn">
                Preferences
            </a>

        </div>

    </div>

<!-- STATS -->

<div class="stats-grid">

    <div class="stat-card">

        <h3> Total Products</h3>

        <p>
            {{ \App\Models\Product::count() }}
        </p>

    </div>

    <div class="stat-card">

        <h3> Total Customers</h3>

        <p>
            {{
                \App\Models\User::where(
                    'role',
                    'customer'
                )->count()
            }}
        </p>

    </div>

    <div class="stat-card">

        <h3> Total Stock</h3>

        <p>
            {{ \App\Models\Product::sum('stok') }}
        </p>

    </div>

    <div class="stat-card">

        <h3> Inventory Value</h3>

        <p style="font-size:28px">
            Rp
            {{
                number_format(
                    \App\Models\Product::sum('harga')
                )
            }}
        </p>

    </div>

    <div class="stat-card">

        <h3>Total Orders</h3>

        <p>

            {{ \App\Models\Order::count() }}

        </p>

    </div>

    <div class="stat-card">

        <h3>Pending Orders</h3>

        <p>

            {{
                \App\Models\Order::where(
                    'status',
                    'Pending'
                )->count()
            }}

        </p>

    </div>

    <div class="stat-card">

        <h3>Confirmed Orders</h3>

        <p>

            {{
                \App\Models\Order::where(
                    'status',
                    'Confirmed'
                )->count()
            }}

        </p>

    </div>

    <div class="stat-card">

        <h3>Revenue</h3>

        <p style="font-size:24px">

            Rp

            {{
                number_format(
                    \App\Models\Order::where(
                        'status',
                        'Confirmed'
                    )->sum('total_price')
                )
            }}

        </p>

    </div>

</div>

<div class="insight-card">

    <h2>

        Business Overview

    </h2>

    <h2>

        Website Visit Statistics

    </h2>

    <p>

        Total Visits :
        <strong>
            {{ session('visit_count', 0) }}
        </strong>

    </p>

    <p>

        First Visit :
        <strong>
            {{ session('first_visit')
                ? \Carbon\Carbon::parse(
                    session('first_visit')
                )->format('d F Y • H:i')
                : '-'
            }}
        </strong>

    </p>

    <p>

        Last Visit :
        <strong>
            {{ session('last_visit')
                ? \Carbon\Carbon::parse(
                    session('last_visit')
                )->format('d F Y • H:i')
                : '-'
            }}
        </strong>

    </p>

    <a
        href="{{ route('reset.visit') }}"
        class="btn"
        style="margin-top:20px;display:inline-block;"
    >

        Reset Counter

    </a>

    <p>

        You currently have

        <strong>
            {{ \App\Models\Product::count() }}
        </strong>

        products listed,

        <strong>
            {{ \App\Models\Order::count() }}
        </strong>

        total orders,

        and

        <strong>
            {{
                \App\Models\Order::where(
                    'status',
                    'Pending'
                )->count()
            }}
        </strong>

        orders awaiting confirmation.

    </p>

</div>

<!-- RECENT ORDERS -->

<div class="orders-card">

    <div class="orders-header">

        <h2>
            Recent Orders
        </h2>

        <span>
            Latest transactions
        </span>

    </div>

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>Order ID</th>

                    <th>Customer</th>

                    <th>Total</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                @forelse(
                    \App\Models\Order::latest()
                        ->take(5)
                        ->get()
                    as $order
                )

                    <tr>

                        <td>

                            #{{ $order->id }}

                        </td>

                        <td>

                            {{ $order->user->name ?? '-' }}

                        </td>

                        <td>

                            Rp
                            {{ number_format($order->total_price) }}

                        </td>

                        <td>

                            <span
                                class="
                                status-badge
                                {{ strtolower($order->status) }}
                                "
                            >

                                {{ $order->status }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            style="text-align:center"
                        >

                            No orders found

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

    <!-- WEATHER -->

    <div class="weather-section">

        <h2>Weather in Surabaya</h2>

        <div id="loading">
            Loading weather data...
        </div>

        <div id="weather-result"
            style="display:none;">

            <h3 id="city"></h3>

            <p id="temperature"></p>

            <p id="description"></p>

        </div>

    </div>

    <!-- LATEST PRODUCTS -->

        <div class="product-grid">

            @foreach(
                \App\Models\Product::latest()
                    ->take(4)
                    ->get()
                as $product
            )

                <a
                    href="{{ route('products.show', $product) }}"
                    class="card"
                    style="text-decoration:none;color:inherit;"
                >

                    @if($product->foto)

                        <img
                            src="{{ asset($product->foto) }}"
                            class="product-image"
                        >

                    @endif

                    <div class="card-body">

                        <h3>
                            {{ $product->nama }}
                        </h3>

                        <p>
                            Rp
                            {{ number_format($product->harga) }}
                        </p>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</div>

<style>

.dashboard-container{
    width:90%;
    margin:auto;
    padding:40px 0;
}

/* HERO */

.hero-section{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:40px;
    flex-wrap:wrap;
    gap:20px;
}

.hero-section h1{

    font-size:56px;

    font-weight:300;

    letter-spacing:-1px;
}

.dark .hero-section h1{

    color:white;
}

.dark .hero-section p{

    color:#9ca3af;
}

.hero-section p{

    color:#777;

    font-size:18px;

    margin-top:8px;
}

.hero-buttons{
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}

.btn{
    padding:12px 20px;
    background:black;
    color:white;
    border-radius:12px;
    text-decoration:none;
}

.dark .btn{
    background:white;
    color:black;
}

/* STATS */

.stats-grid{
    display:grid;
    grid-template-columns:
        repeat(auto-fit, minmax(220px,1fr));
    gap:20px;
    margin-bottom:40px;
}

.stat-card{

    background:white;

    padding:35px;

    border-radius:24px;

    border:1px solid #f1f1f1;

    box-shadow:
        0 10px 30px rgba(0,0,0,.04);

    transition:.3s;
}

.stat-card:hover{

    transform:translateY(-4px);

    box-shadow:
        0 18px 40px rgba(0,0,0,.08);
}

.dark .stat-card{

    background:
        rgba(255,255,255,.05);

    color:white;

    border:
        1px solid rgba(
            255,
            255,
            255,
            .15
        );

    backdrop-filter:
        blur(12px);
}

.stat-card h3{
    margin-bottom:10px;
}

.stat-card p{

    font-size:42px;

    font-weight:300;

    margin-top:10px;
}

/* WEATHER */

.weather-section{
    background:white;
    padding:30px;
    border-radius:20px;
    margin-bottom:40px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.dark .weather-section{
    background:#1f2937;
    color:white;
}

#temperature{
    font-size:40px;
    font-weight:bold;
}

/* PRODUCTS */

.latest-products h2{
    margin-bottom:20px;
}

.product-grid{
    display:grid;
    grid-template-columns:
        repeat(auto-fit, minmax(250px,1fr));
    gap:20px;
}

.card{
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.dark .card{
    background:#1f2937;
    color:white;
}

.product-image{
    width:100%;
    height:250px;
    object-fit:cover;
}

.card-body{
    padding:20px;
}

.insight-card{

    margin-bottom:40px;

    background:white;

    padding:35px;

    border-radius:24px;

    border:1px solid #f1f1f1;
}

.dark .insight-card{

    background:#1f2937;

    color:white;

    border:1px solid #374151;
}

.dark .insight-card p{

    color:#d1d5db;
}

.insight-card h2{

    font-size:26px;

    font-weight:300;

    margin-bottom:15px;
}

.insight-card p{

    color:#666;

    line-height:1.8;
}

/* =====================
   RECENT ORDERS
===================== */

.orders-card{

    background:white;

    border-radius:24px;

    padding:35px;

    margin-bottom:40px;

    border:1px solid #f1f1f1;

    box-shadow:
        0 10px 30px rgba(0,0,0,.04);
}

.dark .orders-card{

    background:#1f2937;
}

.orders-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:25px;
}

.orders-header h2{

    font-size:26px;

    font-weight:300;
}

.orders-header span{

    color:#888;
}

.table-wrapper{

    overflow-x:auto;
}

.orders-card table{

    width:100%;

    border-collapse:collapse;
}

.orders-card th{

    text-align:left;

    padding:18px;

    font-size:13px;

    letter-spacing:1px;

    border-bottom:1px solid #eee;
}

.orders-card td{

    padding:18px;
}

.orders-card tbody tr:nth-child(even){

    background:#fafafa;
}

.dark .orders-card tbody tr:nth-child(even){

    background:#111827;
}

.orders-card tbody tr:hover{

    background:#f3f4f6;
}

.dark .orders-card tbody tr:hover{

    background:#374151;
}

.status-badge{

    display:inline-block;

    padding:
        8px
        16px;

    border:1px solid #ddd;

    border-radius:999px;

    font-size:11px;

    letter-spacing:2px;

    text-transform:uppercase;

    background:white;

    color:#111;
}

.dark .status-badge{

    background:transparent;

    border:1px solid #555;

    color:white;
}

.dark .orders-card{

    color:white;
}

.dark .orders-card th{

    color:#e5e7eb;

    border-bottom:
        1px solid #374151;
}

.dark .orders-card td{

    color:#d1d5db;
}

.dark #loading{

    color:#d1d5db;
}

.dark #city{

    color:white;
}

.dark #description{

    color:#d1d5db;
}

.dark .dashboard-container{

    background:
        linear-gradient(
            135deg,
            #0f172a,
            #020617
        );

    border-radius:24px;

    padding:40px;
}

</style>

<script>

async function getWeather() {

    const loading =
        document.getElementById('loading');

    const result =
        document.getElementById('weather-result');

    try {

        const response = await fetch(
            'https://wttr.in/Surabaya?format=j1'
        );

        const data = await response.json();

        document.getElementById('city')
            .innerText = '📍 Surabaya';

        document.getElementById('temperature')
            .innerText =
            `🌡 ${data.current_condition[0].temp_C}°C`;

        document.getElementById('description')
            .innerText =
            `☁ ${data.current_condition[0]
                .weatherDesc[0].value}`;

        loading.style.display = 'none';

        result.style.display = 'block';

    } catch(error){

        loading.innerText =
            'Failed to load weather data';
    }

}

getWeather();

</script>

@endsection