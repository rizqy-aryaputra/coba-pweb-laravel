@extends('layouts.app')

@section('content')

<div class="container">

    <div class="top-bar">

        <h1>Product Management</h1>

        <a href="{{ route('products.create') }}" class="btn">
            + Tambah Product
        </a>

    </div>

    {{-- Flash Message --}}
    @if(session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="alert-error">
            {{ session('error') }}
        </div>

    @endif

    {{-- Product List --}}
    <div class="product-grid">

        @forelse($products as $product)

            <div class="card">

                {{-- Foto --}}
                @if($product->foto)

                    <img
                        src="{{ asset($product->foto) }}"
                        alt="{{ $product->nama }}"
                        class="product-image"
                    >

                @else

                    <div class="no-image">
                        No Image
                    </div>

                @endif

                {{-- Info --}}
                <div class="card-body">

                    <h2>{{ $product->nama }}</h2>

                    <p>
                        <strong>Kode:</strong>
                        {{ $product->kode }}
                    </p>

                    <p>
                        <strong>Kategori:</strong>
                        {{ $product->kategori }}
                    </p>

                    <p>
                        <strong>Stok:</strong>
                        {{ $product->stok }}
                    </p>

                    <p>
                        <strong>Harga:</strong>
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </p>

                    <p>
                        <strong>Tanggal Masuk:</strong>
                        {{ $product->tanggal_masuk }}
                    </p>

                    {{-- Action --}}
                    <div class="action">

                        <a
                            href="{{ route('products.show', $product->id) }}"
                            class="btn"
                        >
                            Detail
                        </a>

                        <a
                            href="{{ route('products.edit', $product->id) }}"
                            class="btn"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('products.destroy', $product->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin hapus product ini?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger"
                            >
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <p>Belum ada product.</p>

        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper">

        {{-- Prev --}}
        @if ($products->onFirstPage())

            <span class="pagination-disabled">
                Prev
            </span>

        @else

            <a
                href="{{ $products->previousPageUrl() }}"
                class="pagination-btn"
            >
                Prev
            </a>

        @endif

        {{-- Page Number --}}
        @for ($i = 1; $i <= $products->lastPage(); $i++)

            <a
                href="{{ $products->url($i) }}"
                class="pagination-number {{ $products->currentPage() == $i ? 'active' : '' }}"
            >
                {{ $i }}
            </a>

        @endfor

        {{-- Next --}}
        @if ($products->hasMorePages())

            <a
                href="{{ $products->nextPageUrl() }}"
                class="pagination-btn"
            >
                Next
            </a>

        @else

            <span class="pagination-disabled">
                Next
            </span>

        @endif

    </div>

</div>

<style>

.container{
    width:90%;
    margin:auto;
    padding:40px 0;
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.top-bar h1{
    font-size:32px;
}

.btn{
    padding:10px 18px;
    background:black;
    color:white;
    text-decoration:none;
    border:none;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover{
    opacity:0.85;
}

.btn-danger{
    background:#dc3545;
}

.alert-success{
    background:#d4edda;
    color:#155724;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
}

.alert-error{
    background:#f8d7da;
    color:#721c24;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
}

.product-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));
    gap:25px;
}

.card{
    border:1px solid #ddd;
    border-radius:16px;
    overflow:hidden;
    background:white;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
}

.product-image{
    width:100%;
    height:250px;
    object-fit:cover;
}

.no-image{
    height:250px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#eee;
}

.card-body{
    padding:20px;
}

.card-body h2{
    margin-bottom:15px;
}

.action{
    margin-top:20px;
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.pagination-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;
    margin-top:40px;
}

.pagination-btn,
.pagination-number{
    padding:10px 16px;
    border:1px solid black;
    border-radius:8px;
    text-decoration:none;
    color:black;
}

.pagination-number.active{
    background:black;
    color:white;
}

.pagination-disabled{
    padding:10px 16px;
    background:#ccc;
    border-radius:8px;
    color:white;
}

</style>

@endsection