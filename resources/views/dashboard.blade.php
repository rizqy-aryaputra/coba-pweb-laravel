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
                View Products
            </a>

            <a href="/products/create" class="btn">
                + Add Product
            </a>

            <a href="/preferensi" class="btn">
                Preferences
            </a>

        </div>

    </div>

    <!-- STATS -->

    <div class="stats-grid">

        <div class="stat-card">

            <h3>Total Products</h3>

            <p>{{ \App\Models\Product::count() }}</p>

        </div>

        <div class="stat-card">

            <h3>Total Stock</h3>

            <p>{{ \App\Models\Product::sum('stok') }}</p>

        </div>

        <div class="stat-card">

            <h3>Low Stock</h3>

            <p>
                {{
                    \App\Models\Product::where(
                        'stok',
                        '<',
                        5
                    )->count()
                }}
            </p>

        </div>

        <div class="stat-card">

            <h3>Categories</h3>

            <p>
                {{
                    \App\Models\Product::distinct()
                        ->count('kategori')
                }}
            </p>

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

    <div class="latest-products">

        <h2>Latest Products</h2>

        <div class="product-grid">

            @foreach(
                \App\Models\Product::latest()
                    ->take(4)
                    ->get()
                as $product
            )

                <div class="card">

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

                </div>

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
    font-size:42px;
    margin-bottom:10px;
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
    padding:30px;
    border-radius:20px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.dark .stat-card{
    background:#1f2937;
    color:white;
}

.stat-card h3{
    margin-bottom:10px;
}

.stat-card p{
    font-size:36px;
    font-weight:bold;
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