@extends('layouts.app')

@section('content')

<h1>Detail Product</h1>

@if($product->foto)

<img
    src="{{ asset($product->foto) }}"
    width="300"
>

@endif

<h2>{{ $product->nama }}</h2>

<p>Kategori: {{ $product->kategori }}</p>

<p>Harga: Rp {{ number_format($product->harga) }}</p>

<p>Stok: {{ $product->stok }}</p>

<p>Tanggal Masuk: {{ $product->tanggal_masuk }}</p>

<a href="{{ route('products.index') }}">
    Kembali
</a>

@endsection