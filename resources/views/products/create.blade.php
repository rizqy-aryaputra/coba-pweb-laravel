@extends('layouts.app')

@section('content')

<div class="form-page">

    <div class="form-card">

        <span class="form-label">
            ADMIN PANEL
        </span>

        <h1>
            Add Product
        </h1>

        <p>
            Add a new luxury item to the collection.
        </p>

        @if ($errors->any())

            <div class="error-box">

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

            <div class="form-group">

                <label>
                    Product Code
                </label>

                <input
                    type="text"
                    name="kode"
                    value="{{ old('kode') }}"
                    required
                >

            </div>

            <div class="form-group">

                <label>
                    Product Name
                </label>

                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    required
                >

            </div>

            <div class="form-group">

                <label>
                    Category
                </label>

                <input
                    type="text"
                    name="kategori"
                    value="{{ old('kategori') }}"
                    required
                >

            </div>

            <div class="two-column">

                <div class="form-group">

                    <label>
                        Stock
                    </label>

                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok') }}"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>
                        Price
                    </label>

                    <input
                        type="number"
                        name="harga"
                        value="{{ old('harga') }}"
                        required
                    >

                </div>

            </div>

            <div class="form-group">

                <label>
                    Date Added
                </label>

                <input
                    type="date"
                    name="tanggal_masuk"
                    value="{{ old('tanggal_masuk') }}"
                    required
                >

            </div>

            <div class="image-upload">

                <input
                    type="file"
                    name="foto"
                    id="imageInput"
                    accept="image/*"
                >

                <div class="preview-wrapper">

                    <img
                        id="previewImage"
                        src=""
                        style="display:none;"
                    >

                    <div id="placeholder">

                        No image selected

                    </div>

                </div>

            </div>

            <div class="button-group">

                <a
                    href="{{ route('products.index') }}"
                    class="cancel-btn"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="save-btn"
                >
                    Save Product
                </button>

            </div>

        </form>

    </div>

</div>

<style>

.form-page{

    width:100%;
    max-width:900px;

    margin:80px auto;

    padding-bottom:120px;
}

.form-card{

    background:white;

    padding:70px;

    border-radius:24px;

    box-shadow:
        0 15px 40px rgba(0,0,0,.08);
}

.form-label{

    font-size:12px;

    letter-spacing:4px;

    color:#888;
}

.form-card h1{

    font-size:52px;

    font-weight:300;

    margin:15px 0;
}

.form-card p{

    color:#666;

    margin-bottom:50px;
}

.error-box{

    background:#fff5f5;

    border:1px solid #ffdada;

    padding:20px;

    margin-bottom:30px;

    border-radius:12px;
}

.error-box ul{

    padding-left:20px;
}

.form-group{

    margin-bottom:25px;
}

.form-group label{

    display:block;

    margin-bottom:10px;

    font-size:12px;

    letter-spacing:2px;

    color:#666;
}

.form-group input{

    width:100%;

    padding:16px;

    border:1px solid #ddd;

    font-size:15px;

    transition:.3s;
}

.form-group input:focus{

    outline:none;

    border-color:black;
}

.preview-wrapper{

    margin-top:15px;

    width:100%;

    height:300px;

    border:1px solid #ddd;

    border-radius:16px;

    overflow:hidden;

    display:flex;

    align-items:center;

    justify-content:center;

    background:#fafafa;
}

#previewImage{

    width:100%;

    height:100%;

    object-fit:cover;
}

#placeholder{

    color:#999;

    letter-spacing:2px;

    font-size:13px;
}

.two-column{

    display:grid;

    grid-template-columns:
        1fr 1fr;

    gap:20px;
}

.button-group{

    margin-top:50px;

    display:flex;

    gap:15px;
}

.cancel-btn{

    flex:1;

    text-align:center;

    padding:18px;

    border:1px solid #ddd;

    color:black;

    transition:.3s;
}

.cancel-btn:hover{

    background:#f7f7f7;
}

.save-btn{

    flex:1;

    border:none;

    background:black;

    color:white;

    letter-spacing:2px;

    cursor:pointer;

    transition:.3s;
}

.save-btn:hover{

    opacity:.9;
}

@media(max-width:768px){

    .form-card{

        padding:35px;
    }

    .form-card h1{

        font-size:38px;
    }

    .two-column{

        grid-template-columns:1fr;
    }

}

</style>

<script>

document
    .getElementById('imageInput')
    .addEventListener('change', function(e){

        const file =
            e.target.files[0];

        if(file){

            const reader =
                new FileReader();

            reader.onload =
                function(event){

                    document
                        .getElementById('previewImage')
                        .src =
                        event.target.result;

                    document
                        .getElementById('previewImage')
                        .style.display =
                        'block';

                    document
                        .getElementById('placeholder')
                        .style.display =
                        'none';
                };

            reader.readAsDataURL(file);
        }

    });

</script>

@endsection