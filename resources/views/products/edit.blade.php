@extends('layouts.app')

@section('content')

<h1>Edit Product</h1>

@if ($errors->any())

    <div style="
        background:#f8d7da;
        color:#721c24;
        padding:15px;
        margin-bottom:20px;
        border-radius:10px;
    ">

        <ul style="padding-left:20px;">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<form
    action="{{ route('products.update', $product->id) }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf
    @method('PUT')

    <input
        type="text"
        name="kode"
        value="{{ old('kode', $product->kode) }}"
    >
    <br><br>

    <input
        type="text"
        name="nama"
        value="{{ old('nama', $product->nama) }}"
    >
    <br><br>

    <input
        type="text"
        name="kategori"
        value="{{ old('kategori', $product->kategori) }}"
    >
    <br><br>

    <input
        type="number"
        name="stok"
        value="{{ old('stok', $product->stok) }}"
    >
    <br><br>

    <input
        type="number"
        name="harga"
        value="{{ old('harga', $product->harga) }}"
    >
    <br><br>

    <input
        type="date"
        name="tanggal_masuk"
        value="{{ old('tanggal_masuk', $product->tanggal_masuk) }}"
    >
    <br><br>

    <input type="file" name="foto">
    <br><br>

    <button type="submit">
        Update
    </button>

</form>

@endsection