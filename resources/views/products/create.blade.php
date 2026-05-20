@extends('layouts.app')

@section('content')

<h1>Tambah Product</h1>

@if ($errors->any())

    <div style="
        background:#f8d7da;
        color:#721c24;
        padding:15px;
        margin-bottom:20px;
        border-radius:10px;
    ">

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<form
    action="{{ route('products.store') }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf

    <input type="text" name="kode" placeholder="Kode">
    <br><br>

    <input type="text" name="nama" placeholder="Nama">
    <br><br>

    <input type="text" name="kategori" placeholder="Kategori">
    <br><br>

    <input type="number" name="stok" placeholder="Stok">
    <br><br>

    <input type="number" name="harga" placeholder="Harga">
    <br><br>

    <input type="date" name="tanggal_masuk">
    <br><br>

    <input type="file" name="foto">
    <br><br>

    <button type="submit">
        Simpan
    </button>

</form>

@endsection