@extends('layouts.customer')

@section('content')

<div class="auth-container">

    <div class="auth-card">

        <span class="auth-label">
            SECOND CHANCE
        </span>

        <h1>
            Create Account
        </h1>

        <p>
            Join our curated luxury community.
        </p>

        <form
            method="POST"
            action="{{ route('register') }}"
        >

            @csrf

            <div class="form-group">

                <label>
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                >

                @error('name')

                    <small class="error">

                        {{ $message }}

                    </small>

                @enderror

            </div>

            <div class="form-group">

                <label>
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >

                @error('email')

                    <small class="error">

                        {{ $message }}

                    </small>

                @enderror

            </div>

            <div class="form-group">

                <label>
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                >

                @error('password')

                    <small class="error">

                        {{ $message }}

                    </small>

                @enderror

            </div>

            <div class="form-group">

                <label>
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                >

                @error('password_confirmation')

                    <small class="error">

                        {{ $message }}

                    </small>

                @enderror

            </div>

            <button
                type="submit"
                class="register-btn"
            >

                CREATE ACCOUNT

            </button>

            <div class="login-link">

                Already have an account?

                <a
                    href="{{ route('login') }}"
                >

                    Sign In

                </a>

            </div>

        </form>

    </div>

</div>

<style>

.auth-container{

    min-height:80vh;

    display:flex;

    justify-content:center;

    align-items:center;

    padding:80px 20px;
}

.auth-card{

    width:520px;

    max-width:100%;

    background:white;

    padding:60px;

    border:1px solid #eee;
}

.auth-label{

    font-size:12px;

    letter-spacing:4px;

    color:#777;
}

.auth-card h1{

    font-size:54px;

    font-weight:300;

    margin:15px 0;
}

.auth-card p{

    color:#666;

    margin-bottom:40px;
}

.form-group{

    margin-bottom:25px;
}

.form-group label{

    display:block;

    margin-bottom:10px;

    font-size:12px;

    letter-spacing:2px;

    color:#777;
}

.form-group input{

    width:100%;

    padding:16px;

    border:1px solid #ddd;

    font-size:15px;
}

.form-group input:focus{

    outline:none;

    border-color:black;
}

.register-btn{

    width:100%;

    padding:18px;

    border:none;

    background:black;

    color:white;

    letter-spacing:3px;

    cursor:pointer;
}

.register-btn:hover{

    opacity:.9;
}

.login-link{

    margin-top:30px;

    text-align:center;

    color:#666;
}

.login-link a{

    color:black;

    font-weight:500;
}

.error{

    display:block;

    margin-top:8px;

    color:#c53030;
}

@media(max-width:768px){

    .auth-card{

        padding:35px;
    }

    .auth-card h1{

        font-size:40px;
    }

}

</style>

@endsection