@extends('layouts.customer')

@section('content')

<div class="checkout-container">

    <div class="checkout-left">

        @if($product->foto)

            <img
                src="{{ asset($product->foto) }}"
                class="product-image"
            >

        @endif

    </div>

    <div class="checkout-right">

        <span class="section-label">
            CHECKOUT
        </span>

        <h1>
            {{ strtoupper($product->nama) }}
        </h1>

        <div class="price">

            Rp {{ number_format($product->harga) }}

        </div>

        <form
            action="{{ route('orders.store') }}"
            method="POST"
        >

            @csrf

            <input
                type="hidden"
                name="product_id"
                value="{{ $product->id }}"
            >

            <div class="form-group">

                <label>
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ auth()->user()->name }}"
                    required
                >

            </div>

            <div class="form-group">

                <label>
                    Phone Number
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    required
                >

                @error('phone')

                    <small class="error">

                        {{ $message }}

                    </small>

                @enderror

            </div>

            <div class="form-group">

                <label>
                    Shipping Address
                </label>

                <textarea
                    name="address"
                    rows="5"
                    required
                ></textarea>

            </div>

            @if($product->stok > 0)

                <button
                    type="submit"
                    class="place-order-btn"
                >

                    PLACE ORDER

                </button>

            @else

                <button
                    class="sold-btn"
                    disabled
                >

                    SOLD OUT

                </button>

            @endif

        </form>

    </div>

    @if(session('error'))

        <div class="alert-error">

            {{ session('error') }}

        </div>

    @endif

</div>

<style>

.checkout-container{

    width:88%;
    max-width:1400px;

    margin:80px auto;

    display:grid;

    grid-template-columns:55% 45%;

    gap:80px;
}

.product-image{

    width:100%;

    max-height:700px;

    object-fit:cover;

    background:#fafafa;
}

.section-label{

    letter-spacing:4px;

    font-size:12px;

    color:#777;
}

.checkout-right h1{

    margin-top:15px;

    font-size:48px;

    font-weight:300;
}

.price{

    margin:20px 0 40px;

    font-size:28px;

    font-weight:600;
}

.form-group{

    margin-bottom:25px;
}

.form-group label{

    display:block;

    margin-bottom:10px;

    font-size:12px;

    letter-spacing:2px;
}

.form-group input,
.form-group textarea{

    width:100%;

    padding:15px;

    border:1px solid #ddd;

    font-size:15px;
}

.place-order-btn{

    width:100%;

    padding:18px;

    border:none;

    background:black;

    color:white;

    letter-spacing:3px;

    cursor:pointer;
}

.error{

    color:#c0392b;

    font-size:13px;

    margin-top:5px;

    display:block;
}


.alert-error{

    background:#fff0f0;

    color:#c0392b;

    padding:15px;

    margin-bottom:25px;

    border:1px solid #f5c2c2;
}

.sold-btn{

    width:100%;

    padding:18px;

    border:none;

    background:#ccc;

    color:white;

    letter-spacing:3px;

    cursor:not-allowed;
}

@media(max-width:992px){

    .checkout-container{

        grid-template-columns:1fr;
    }

}

</style>

@endsection