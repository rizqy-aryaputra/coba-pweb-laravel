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
        }

        html{
            scroll-behavior:smooth;
        }

        body{

            font-family:
                "Helvetica Neue",
                Helvetica,
                Arial,
                sans-serif;

            background:white;

            color:#111;

            overflow-x:hidden;
        }

        a{
            text-decoration:none;
        }

        img{
            display:block;
        }

        /* =====================
            NAVBAR
        ===================== */

        .navbar{

            position:absolute;

            top:0;
            left:0;

            width:100%;

            z-index:1000;

            padding:35px 70px;

            display:flex;

            justify-content:space-between;

            align-items:center;
        }

        .logo{

            color:white;

            font-size:18px;

            letter-spacing:6px;

            font-weight:600;
        }

        .nav-links,
        .auth-links{

            display:flex;

            gap:40px;
        }

        .navbar a{

            color:white;

            font-size:12px;

            letter-spacing:3px;

            transition:.3s;
        }

        .navbar a:hover{

            opacity:.7;
        }

        /* =====================
            HERO
        ===================== */

        .hero{

            height:100vh;

            background:
            linear-gradient(
                rgba(0,0,0,.35),
                rgba(0,0,0,.35)
            ),
            url('https://fashionista.com/.image/MjAwMDc0MDkxMjIxMzYyMDQw/ferragamo-fall-2024-campaign-by-tyler-mitchell.jpg?profile=w1536&x=50&y=50'
            );

            background-size:cover;

            background-position:center;

            display:flex;

            justify-content:center;

            align-items:center;
        }

        .hero-content{

            text-align:center;

            color:white;

            width:900px;

            max-width:90%;
        }

        .hero-content span{

            font-size:12px;

            letter-spacing:6px;
        }

        .hero-content h1{

            margin-top:25px;

            font-size:90px;

            font-weight:300;

            line-height:1.05;
        }

        .hero-content p{

            margin-top:30px;

            letter-spacing:4px;

            font-size:14px;
        }

        .hero-btn{

            display:inline-block;

            margin-top:50px;

            background:white;

            color:black;

            padding:
                18px
                45px;

            letter-spacing:3px;

            font-size:12px;

            transition:.3s;
        }

        .hero-btn:hover{

            background:black;

            color:white;
        }

        /* =====================
            EDITORIAL
        ===================== */

        .editorial{

            width:85%;

            margin:
                150px auto;

            display:grid;

            grid-template-columns:
                1fr 1fr;

            gap:100px;

            align-items:center;
        }

        .editorial-text h2{

            font-size:82px;

            font-weight:300;

            line-height:1.05;
        }

        .editorial-text p{

            margin-top:40px;

            font-size:18px;

            color:#666;

            line-height:1.9;
        }

        .editorial img{

            width:100%;

            height:750px;

            object-fit:cover;
        }

        /* =====================
            FEATURED COLLECTION
        ===================== */

        .campaigns{

            width:85%;

            margin:
                150px auto;
        }

        .section-label{

            font-size:12px;

            letter-spacing:4px;

            margin-bottom:40px;
        }

        .campaign-grid{

            display:grid;

            grid-template-columns:
                1fr 1fr;

            gap:25px;
        }

        .campaign{

            position:relative;
        }

        .campaign img{

            width:100%;

            height:700px;

            object-fit:cover;
        }

        .campaign-overlay{

            position:absolute;

            top:50%;

            left:50%;

            transform:
                translate(-50%,-50%);

            text-align:center;

            color:white;
        }

        .campaign-overlay h2{

            font-size:48px;

            font-weight:300;

            margin-bottom:20px;
        }

        .campaign-overlay a{

            color:white;

            border-bottom:
                1px solid white;

            padding-bottom:4px;
        }

    </style>

</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar">

        <div class="logo">

            SECOND CHANCE

        </div>

        <div class="nav-links">

            <a href="/products">
                COLLECTION
            </a>

            <a href="{{ route('about') }}">
                ABOUT
            </a>

        </div>

        <div class="auth-links">

            @guest

                <a href="{{ route('login') }}">
                    LOGIN
                </a>

                <a href="{{ route('register') }}">
                    REGISTER
                </a>

            @else

                <a href="{{ route('wishlist.index') }}">
                    WISHLIST
                </a>

                <a href="{{ route('dashboard') }}">
                    ACCOUNT
                </a>

            @endguest

        </div>

    </nav>

    <!-- HERO -->

    <section class="hero">

        <div class="hero-content">

            <span>

                SECOND CHANCE

            </span>

            <h1>

                Luxury deserves
                <br>
                a second life.

            </h1>

            <p>

                AUTHENTIC PRELOVED
                DESIGNER PIECES

            </p>

            <a
                href="/products"
                class="hero-btn"
            >

                SHOP NOW

            </a>

        </div>

    </section>

    <!-- EDITORIAL -->

    <section class="editorial">

        <div class="editorial-text">

            <h2>

                Luxury deserves
                <br>
                a second life.

            </h2>

            <p>

                Discover authentic designer pieces
                carefully curated for their next chapter.

                <br><br>

                Every item is selected to offer
                timeless style, exceptional quality,
                and a more sustainable way to shop.

            </p>

        </div>

        <div>

            <img
                src="https://i.pinimg.com/originals/51/c7/3a/51c73aac6738678e647423c41ca5d277.jpg"
            >

        </div>

    </section>

    <!-- FEATURED COLLECTIONS -->

    <section class="campaigns">

        <div class="section-label">

            FEATURED COLLECTIONS

        </div>

        <div class="campaign-grid">

            <div class="campaign">

                <img
                    src="https://www.fashiongonerogue.com/wp-content/uploads/2026/05/ningning-gucci-bag-2026-campaign02.jpg"
                >

                <div class="campaign-overlay">

                    <h2>

                        Designer Bags

                    </h2>

                    <a href="/products">

                        Shop Now

                    </a>

                </div>

            </div>

            <div class="campaign">

                <img
                    src="https://www.ptkorea.com/wp-content/uploads/2023/07/_PKZNvbLkeaEGMOVt-dt35mAZIxJdE3571s6worTPpc.png"
                >

                <div class="campaign-overlay">

                    <h2>

                         Accessories

                    </h2>

                    <a href="/products">

                        Shop Now

                    </a>

                </div>

            </div>

        </div>

    </section>

    <!-- SHOP BY CATEGORY -->

    <section class="categories">

        <div class="section-label">

            SHOP BY CATEGORY

        </div>

        <div class="category-grid">

            <a
                href="{{ route(
                    'products.index',
                    ['category' => 'Bag']
                ) }}"
                class="category-card"
            >

                <img
                    src="https://uncommonandcurated.com/wp-content/uploads/2023/01/Quiet-Luxury-Handbags-Lowkey-Luxury-Handbags-3-1024x696.jpg"
                >

                <div class="category-overlay">

                    BAGS

                </div>

            </a>

            <a
                href="{{ route(
                    'products.index',
                    ['category' => 'Watch']
                ) }}"
                class="category-card"
            >

                <img
                    src="https://www.vancleefarpels.com/content/dam/vancleefarpels/La-Maison/newsroom/2025/w-w-2025/Duo%20copie.jpg"
                >

                <div class="category-overlay">

                    WATCHES

                </div>

            </a>

            <a
                href="{{ route(
                    'products.index',
                    ['category' => 'Shoes']
                ) }}"
                class="category-card"
            >

                <img
                    src="https://www.net-a-porter.com/variants/images/34480784412038974/cu/w2000_a3-4_q60.jpg"
                >

                <div class="category-overlay">

                    SHOES

                </div>

            </a>

            <a
                href="{{ route(
                    'products.index',
                    ['category' => 'Accessories']
                ) }}"
                class="category-card"
            >

                <img
                    src="https://www.cartier.com/dw/image/v2/BGTJ_PRD/on/demandware.static/-/Sites-cartier-master/default/dwb77b1143/images/large/ab019a0d16e05d8e919037f60df17057.png?sw=750&sh=750&sm=fit&sfrm=png"
                >

                <div class="category-overlay">

                    ACCESSORIES

                </div>

            </a>

        </div>

    </section>

    <!-- NEW ARRIVALS -->

    <section class="arrivals">

        <div class="section-label">

            NEW ARRIVALS

        </div>

        <div class="product-grid">

            @foreach(
                \App\Models\Product::latest()
                    ->take(4)
                    ->get()
                as $product
            )

                <a
                    href="{{ route('products.show',$product) }}"
                    class="product-card"
                >

                    <div class="product-image-wrapper">

                        <img
                            src="{{ asset($product->foto) }}"
                            class="product-image"
                        >

                    </div>

                    <div class="product-info">

                        <h3>

                            {{ strtoupper($product->nama) }}

                        </h3>

                        <p>

                            Rp {{ number_format($product->harga) }}

                        </p>

                    </div>

                </a>

            @endforeach

        </div>

    </section>

    <!-- FOOTER -->

    <footer>

        <div class="footer-logo">

            SECOND CHANCE

        </div>

        <p>

            Authentic Preloved Luxury

        </p>

        <div class="footer-links">

            <a href="/products">
                SHOP
            </a>

            <a href="/products">
                COLLECTION
            </a>

            @guest

                <a href="/login">
                    LOGIN
                </a>

                <a href="/register">
                    REGISTER
                </a>

            @else

                <a href="/dashboard">
                    DASHBOARD
                </a>

            @endguest

        </div>

        <div class="copyright">

            © 2026 SECOND CHANCE

        </div>

    </footer>

    <style>

        /* =====================
            CATEGORIES
        ===================== */

        .categories{

            width:85%;

            margin:150px auto;
        }

        .category-grid{

            display:grid;

            grid-template-columns:
                repeat(4,1fr);

            gap:25px;
        }

        .category-card{

            position:relative;

            overflow:hidden;
        }

        .category-card img{

            width:100%;

            height:500px;

            object-fit:cover;

            transition:.6s;
        }

        .category-card:hover img{

            transform:scale(1.05);
        }

        .category-overlay{

            position:absolute;

            bottom:30px;

            left:30px;

            color:white;

            font-size:24px;

            letter-spacing:3px;

            font-weight:300;
        }

        /* =====================
            ARRIVALS
        ===================== */

        .arrivals{

            width:85%;

            margin:
                150px auto;
        }

        .product-grid{

            display:grid;

            grid-template-columns:
                repeat(4,1fr);

            gap:40px;
        }

        .product-card{

            color:#111;

            transition:.4s;
        }

        .product-image-wrapper{

            overflow:hidden;
        }

        .product-image{

            width:100%;

            height:520px;

            object-fit:cover;

            transition:.6s;
        }

        .product-card:hover
        .product-image{

            transform:scale(1.04);
        }

        .product-info{

            padding-top:18px;
        }

        .product-info h3{

            font-size:14px;

            font-weight:500;

            letter-spacing:1px;

            margin-bottom:8px;
        }

        .product-info p{

            color:#555;
        }

        /* =====================
            FOOTER
        ===================== */

        footer{

            margin-top:180px;

            padding:
                80px
                60px;

            border-top:
                1px solid #e5e5e5;

            text-align:center;
        }

        .footer-logo{

            font-size:20px;

            letter-spacing:6px;

            margin-bottom:20px;
        }

        footer p{

            color:#666;

            margin-bottom:30px;
        }

        .footer-links{

            display:flex;

            justify-content:center;

            gap:35px;

            margin-bottom:40px;
        }

        .footer-links a{

            color:#111;

            font-size:12px;

            letter-spacing:3px;
        }

        .copyright{

            color:#888;

            font-size:12px;
        }

        /* =====================
            RESPONSIVE
        ===================== */

        @media(max-width:992px){

            .hero-content h1{

                font-size:60px;
            }

            .editorial{

                grid-template-columns:
                    1fr;

                gap:40px;
            }

            .category-grid{

                grid-template-columns:
                    repeat(2,1fr);
            }

            .campaign-grid{

                grid-template-columns:
                    1fr;
            }

            .product-grid{

                grid-template-columns:
                    repeat(2,1fr);
            }

            .campaign img{

                height:500px;
            }

            .editorial img{

                height:500px;
            }
        }

        @media(max-width:768px){

            .navbar{

                padding:
                    25px
                    30px;

                flex-direction:column;

                gap:15px;
            }

            .hero-content h1{

                font-size:44px;
            }

            .editorial-text h2{

                font-size:52px;
            }

            .category-grid{

                grid-template-columns:1fr;
            }

            .product-grid{

                grid-template-columns:
                    1fr;
            }

            .product-image{

                height:450px;
            }

            .footer-links{

                flex-direction:column;

                gap:15px;
            }
        }

    </style>

</body>
</html>