<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>

        SECOND CHANCE

    </title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:
                "Helvetica Neue",
                Arial,
                sans-serif;
        }

        body{

            background:white;
            color:#111;
        }

        a{
            text-decoration:none;
        }

        /* ===================
           NAVBAR
        =================== */

        .navbar{

            width:100%;

            padding:
                30px
                70px;

            display:flex;

            justify-content:space-between;

            align-items:center;

            border-bottom:
                1px solid #eee;
        }

        .logo{
            font-size:24px;
            letter-spacing:6px;
            font-weight:700;
        }

        .nav-links,
        .auth-links{

            display:flex;

            gap:35px;
        }

        .navbar a{

            color:#111;

            font-size:12px;

            letter-spacing:2px;
        }

        .logout-btn{

            background:none;

            border:none;

            color:#111;

            font-size:12px;

            letter-spacing:2px;

            cursor:pointer;

            font-family:
                "Helvetica Neue",
                Arial,
                sans-serif;
        }

        /* ===================
           CONTENT
        =================== */

        .page-content{

            min-height:70vh;
        }

        /* ===================
           FOOTER
        =================== */

        footer{

            margin-top:120px;

            padding:
                80px
                60px;

            border-top:
                1px solid #eee;

            text-align:center;
        }

        .footer-logo{

            font-size:20px;

            letter-spacing:6px;

            margin-bottom:20px;
        }

        footer p{

            color:#777;

            margin-bottom:20px;
        }

        .footer-links{

            display:flex;

            justify-content:center;

            gap:30px;

            margin-bottom:30px;
        }

        .footer-links a{

            color:#111;

            font-size:12px;

            letter-spacing:2px;
        }

        .copyright{

            color:#999;

            font-size:12px;
        }

    </style>

</head>

<body>

    <nav class="navbar">

        <div class="logo">

            <a
                href="{{ route('home') }}"
                style="color:black;"
            >
                SECOND CHANCE
            </a>

        </div>

        <div class="nav-links">
            <a
                href="{{ route('products.index') }}"
            >
                COLLECTION
            </a>

            <a
                href="{{ route('about') }}"
            >
                ABOUT
            </a>

        </div>

        <div class="auth-links">

            @guest

                <a
                    href="{{ route('login') }}"
                >
                    LOGIN
                </a>

                <a
                    href="{{ route('register') }}"
                >
                    REGISTER
                </a>

            @else

                @if(auth()->user()->role == 'customer')

                    <a
                        href="{{ route('wishlist.index') }}"
                    >
                        WISHLIST
                    </a>

                    <a
                        href="{{ route('orders.index') }}"
                    >
                        MY ORDERS
                    </a>

                @endif

                @auth

                    @if(auth()->user()->role == 'admin')

                        <a href="{{ route('admin.dashboard') }}">
                            MY ACCOUNT
                        </a>

                    @else

                        <a href="{{ route('dashboard') }}">
                            MY ACCOUNT
                        </a>

                    @endif

                @endauth

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    style="display:inline;"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout-btn"
                    >

                        LOGOUT

                    </button>

                </form>

            @endguest

        </div>

    </nav>

    <div class="page-content">

        @yield('content')

    </div>

    <footer>

        <div class="footer-logo">

            SECOND CHANCE

        </div>

        <p>

            Authentic Preloved Luxury

        </p>

        <div class="footer-links">

            <a
                href="{{ route('products.index') }}"
            >
                COLLECTION
            </a>

            <a
                href="{{ route('about') }}"
            >
                ABOUT
            </a>

        </div>

        <div class="copyright">

            © 2026 SECOND CHANCE

        </div>

    </footer>

</body>

</html>