@extends('layouts.app')

@section('content')

<div class="edit-container">

    <div class="edit-card">

        <div class="header">

            <span>PRODUCT MANAGEMENT</span>

            <h1>Edit Product</h1>

        </div>

        @if ($errors->any())

            <div class="error-box">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        @if($product->foto)

            <div class="preview-image">

                <img
                    src="{{ asset($product->foto) }}"
                    alt="{{ $product->nama }}"
                >

            </div>

        @endif

        <form
            action="{{ route('products.update', $product->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="form-group">

                <label>Product Code</label>

                <input
                    type="text"
                    name="kode"
                    value="{{ old('kode', $product->kode) }}"
                >

            </div>

            <div class="form-group">

                <label>Product Name</label>

                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama', $product->nama) }}"
                >

            </div>

            <div class="form-group">

                <label>Category</label>

                <input
                    type="text"
                    name="kategori"
                    value="{{ old('kategori', $product->kategori) }}"
                >

            </div>

            <div class="form-group">

                <label>Stock</label>

                <input
                    type="number"
                    name="stok"
                    value="{{ old('stok', $product->stok) }}"
                >

            </div>

            <div class="form-group">

                <label>Price</label>

                <input
                    type="number"
                    name="harga"
                    value="{{ old('harga', $product->harga) }}"
                >

            </div>

            <div class="form-group">

                <label>Date Added</label>

                <input
                    type="date"
                    name="tanggal_masuk"
                    value="{{ old('tanggal_masuk', $product->tanggal_masuk) }}"
                >

            </div>

            <div class="form-group">

                <label>Upload New Image</label>

                <input
                    type="file"
                    name="foto"
                >

            </div>

            <button
                type="submit"
                class="update-btn"
            >

                UPDATE PRODUCT

            </button>

        </form>

    </div>

    <a
        href="{{ route('products.index') }}"
        class="close-btn"
    >
        ✕
    </a>

</div>

<style>

.edit-container{

    position:fixed;

    top:0;
    left:0;

    width:100%;
    height:100vh;

    background:
        rgba(0,0,0,.55);

    display:flex;

    justify-content:center;
    align-items:center;

    padding:30px;

    z-index:9999;
}

.edit-card{

    position:relative;

    width:100%;
    max-width:850px;

    max-height:90vh;

    overflow-y:auto;

    background:white;

    padding:50px;

    border-radius:24px;

    box-shadow:
        0 20px 60px rgba(0,0,0,.18);
}

.header span{

    font-size:12px;

    letter-spacing:4px;

    color:#777;
}

.header h1{

    font-size:48px;

    font-weight:300;

    margin-top:15px;

    margin-bottom:40px;
}

.preview-image{

    text-align:center;

    margin-bottom:40px;
}

.preview-image img{

    width:260px;

    height:260px;

    object-fit:cover;

    border-radius:18px;

    border:1px solid #eee;
}

.form-group{

    margin-bottom:24px;
}

.form-group label{

    display:block;

    margin-bottom:10px;

    font-size:13px;

    letter-spacing:1px;
}

.form-group input{

    width:100%;

    padding:15px;

    border:1px solid #ddd;

    border-radius:10px;

    font-size:15px;
}

.update-btn{

    width:100%;

    padding:18px;

    border:none;

    border-radius:12px;

    background:black;

    color:white;

    letter-spacing:3px;

    cursor:pointer;

    transition:.3s;
}

.update-btn:hover{

    opacity:.9;
}

.close-btn{

    position:absolute;

    top:25px;
    right:25px;

    width:40px;
    height:40px;

    border-radius:50%;

    background:#f7f7f7;

    color:#111;

    display:flex;

    justify-content:center;
    align-items:center;

    font-size:20px;

    transition:.3s;
}

.close-btn:hover{

    background:black;

    color:white;
}

.edit-card{

    animation:
        popup .25s ease;
}

@keyframes popup{

    from{

        opacity:0;

        transform:
            translateY(20px);
    }

    to{

        opacity:1;

        transform:
            translateY(0);
    }
}

.error-box{

    background:#fff1f1;

    color:#c62828;

    padding:18px;

    border-radius:12px;

    margin-bottom:30px;
}

.error-box ul{

    padding-left:20px;
}

</style>

@endsection