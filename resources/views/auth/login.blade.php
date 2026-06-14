@extends('layouts.customer')

@section('content')

<div class="auth-container">

    <div class="auth-card">

        <span class="auth-label">
            SECOND CHANCE
        </span>

        <h1>
            Welcome Back
        </h1>

        <p>
            Sign in to continue your luxury journey.
        </p>

        @if(session('status'))

            <div class="success-box">

                {{ session('status') }}

            </div>

        @endif

        <form
            method="POST"
            action="{{ route('login') }}"
        >

            @csrf

            <div class="form-group">

                <label>
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
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

            <div class="remember-row">

                <label>

                    <input
                        type="checkbox"
                        name="remember"
                    >

                    Remember Me

                </label>

            </div>

            <button
                type="submit"
                class="login-btn"
            >

                SIGN IN

            </button>

            @if(Route::has('password.request'))

                <a
                    href="{{ route('password.request') }}"
                    class="forgot-link"
                >

                    Forgot Password?

                </a>

            @endif

            <div class="register-link">

                Don't have an account?

                <a
                    href="{{ route('register') }}"
                >

                    Create Account

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

.remember-row{

    margin-bottom:25px;

    font-size:14px;
}

.login-btn{

    width:100%;

    padding:18px;

    border:none;

    background:black;

    color:white;

    letter-spacing:3px;

    cursor:pointer;
}

.login-btn:hover{

    opacity:.9;
}

.forgot-link{

    display:block;

    text-align:center;

    margin-top:20px;

    color:#666;
}

.register-link{

    margin-top:30px;

    text-align:center;

    color:#666;
}

.register-link a{

    color:black;

    font-weight:500;
}

.error{

    display:block;

    margin-top:8px;

    color:#c53030;
}

.success-box{

    background:#eef8ee;

    color:#2e7d32;

    padding:15px;

    margin-bottom:25px;
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