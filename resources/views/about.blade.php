@extends('layouts.customer')

@section('content')

<section class="about-hero">

    <span>

        ABOUT SECOND CHANCE

    </span>

    <h1>

        Luxury deserves
        <br>
        a second life.

    </h1>

</section>

<section class="about-story">

    <div class="story-image">

        <img
            src="https://media.fashionnetwork.com/cdn-cgi/image/fit=contain,width=1000,height=1000,format=auto/m/6ced/c498/e13f/4cde/5953/cbb5/e85a/7d72/0f44/ccf2/ccf2.jpg"
            alt="Luxury Fashion"
        >

    </div>

    <div class="story-content">

        <h2>

            Our Story

        </h2>

        <p>

            Second Chance is a curated destination
            for authentic preloved luxury fashion
            and accessories.

        </p>

        <p>

            We believe that timeless pieces deserve
            more than one chapter. Every item in our
            collection is carefully selected to ensure
            quality, authenticity, and lasting value.

        </p>

        <p>

            By extending the life of luxury products,
            we encourage a more sustainable approach
            to fashion while helping exceptional pieces
            find their next owner.

        </p>

    </div>

</section>

<section class="values-section">

    <div class="value">

        <h3>

            Authenticity

        </h3>

        <p>

            Every item is carefully reviewed before
            entering our collection.

        </p>

    </div>

    <div class="value">

        <h3>

            Sustainability

        </h3>

        <p>

            Giving luxury fashion a second life
            reduces unnecessary waste.

        </p>

    </div>

    <div class="value">

        <h3>

            Timeless Style

        </h3>

        <p>

            We focus on pieces that remain relevant
            beyond seasonal trends.

        </p>

    </div>

</section>

<section class="mission-section">

    <div class="mission-overlay">

        <span>

            OUR MISSION

        </span>

        <h2>

            Redefining luxury through
            conscious consumption.

        </h2>

        <p>

            We connect exceptional pieces
            with new owners who appreciate
            craftsmanship, heritage, and
            timeless style.

        </p>

    </div>

</section>

<section class="about-cta">

    <h2>

        Explore Our Collection

    </h2>

    <p>

        Discover curated luxury pieces
        ready for their next chapter.

    </p>

    <a
        href="{{ route('products.index') }}"
        class="cta-btn"
    >

        SHOP NOW

    </a>

</section>

<style>

.about-hero{

    text-align:center;

    padding:120px 0;
}

.about-hero span{

    letter-spacing:4px;

    font-size:12px;

    color:#777;
}

.about-hero h1{

    margin-top:20px;

    font-size:80px;

    font-weight:300;

    line-height:1.1;
}

.about-story{

    width:88%;

    margin:auto;

    display:grid;

    grid-template-columns:
        1fr 1fr;

    gap:80px;

    align-items:center;
}

.story-image img{

    width:100%;

    height:700px;

    object-fit:cover;
}

.story-content h2{

    font-size:48px;

    font-weight:300;

    margin-bottom:30px;
}

.story-content p{

    margin-bottom:25px;

    line-height:2;

    color:#555;
}

.values-section{

    width:88%;

    margin:120px auto;

    display:grid;

    grid-template-columns:
        repeat(3,1fr);

    gap:50px;

    border-top:1px solid #eee;

    padding-top:80px;
}

.value h3{

    margin-bottom:20px;

    font-weight:500;
}

.value p{

    color:#666;

    line-height:1.8;
}

@media(max-width:992px){

    .about-story{

        grid-template-columns:1fr;
    }

    .about-hero h1{

        font-size:50px;
    }

    .values-section{

        grid-template-columns:1fr;
    }

}

.mission-section{

    width:100%;

    margin:120px 0;

    background-image:
        linear-gradient(
            rgba(0,0,0,.45),
            rgba(0,0,0,.45)
        ),
        url('https://i.pinimg.com/736x/8e/2f/e9/8e2fe92085c4bac3e2f0acb5a9ad4703.jpg');

    background-size:cover;

    background-position:center;

    background-attachment:fixed;
}

.mission-overlay{

    padding:180px 20px;

    text-align:center;
}

.mission-overlay span{

    font-size:12px;

    letter-spacing:5px;

    color:#d6cbbf;
}

.mission-overlay h2{

    max-width:1000px;

    margin:25px auto;

    font-size:72px;

    font-weight:300;

    line-height:1.2;

    color:white;
}

.mission-overlay p{

    max-width:700px;

    margin:auto;

    line-height:2;

    font-size:18px;

    color:#d6cbbf;
}

.mission-section span{

    font-size:12px;

    letter-spacing:4px;

    color:#e7ddd2;
}

.mission-section h2{

    margin-top:20px;

    font-size:56px;

    font-weight:300;

    line-height:1.2;
}

.mission-section p{

    margin-top:30px;

    color:#e7ddd2;

    line-height:2;

    max-width:700px;

    margin-left:auto;

    margin-right:auto;
}

.about-cta{

    text-align:center;

    padding:140px 0;

    border-top:1px solid #eee;

    margin-top:120px;
}

.about-cta h2{

    font-size:56px;

    font-weight:300;
}

.about-cta p{

    margin-top:20px;

    color:#666;
}

.cta-btn{

    display:inline-block;

    margin-top:40px;

    background:black;

    color:white;

    padding:
        18px
        40px;

    letter-spacing:3px;

    transition:.3s;
}

.cta-btn:hover{

    opacity:.85;
}

</style>

@endsection