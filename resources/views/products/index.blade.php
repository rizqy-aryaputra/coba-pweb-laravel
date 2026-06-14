@extends('layouts.customer')

@section('content')

<div class="collection-page">

    <section class="collection-hero">

        <span>
            SECOND CHANCE
        </span>

        <h1>
            Collection
        </h1>

        <p>
            Curated luxury pieces with a second life.
        </p>

        <div class="hero-divider"></div>

        @auth

            @if(auth()->user()->role == 'admin')

                <a
                    href="{{ route('products.create') }}"
                    class="add-product-btn"
                >

                    + Add Product

                </a>

            @endif

        @endauth

    </section>

    <!-- SEARCH -->

    <section class="search-section">

        <input
            type="text"
            id="searchInput"
            placeholder="Search item..."
        >

    </section>

    <!-- CATEGORY -->

    <section class="category-section">

        <a
            href="{{ route('products.index') }}"
            class="{{ request('category') ? '' : 'active-category' }}"
        >
            ALL
        </a>

        @foreach($categories as $category)

            <a
                href="{{ route(
                    'products.index',
                    [
                        'category' => $category,
                        'search' => request('search')
                    ]
                ) }}"
                class="{{ request('category') == $category ? 'active-category' : '' }}"
            >

                {{ strtoupper($category) }}

            </a>

        @endforeach

    </section>

    <!-- PRODUCTS -->

    <div
        class="product-grid"
        id="product-list"
    >

        @forelse($products as $product)

            <div class="product-card">

                <a
                    href="{{ route('products.show',$product) }}"
                >

                    @if($product->foto)

                        <img
                            src="{{ asset($product->foto) }}"
                            class="product-image"
                        >

                    @else

                        <div class="no-image">

                            No Image

                        </div>

                    @endif

                </a>

                <div class="product-info">

                    <div class="category">

                        {{ strtoupper($product->kategori) }}

                    </div>

                    <h3>

                        {{ strtoupper($product->nama) }}

                    </h3>

                    <div class="price">

                        Rp
                        {{ number_format($product->harga) }}

                    </div>

                    @auth

                        @if(auth()->user()->role == 'admin')

                            <div class="admin-action">

                                <a
                                    href="{{ route(
                                        'products.edit',
                                        $product
                                    ) }}"
                                >

                                    Edit

                                </a>

                                <button
                                    type="button"
                                    class="delete-btn"
                                    onclick="openDeleteModal(
                                        '{{ route('products.destroy', $product) }}',
                                        '{{ $product->nama }}'
                                    )"
                                >

                                    Delete

                                </button>

                            </div>

                        @endif

                    @endauth

                </div>

            </div>

        @empty

            <div class="empty">

                No products found.

            </div>

        @endforelse

    </div>

    <!-- PAGINATION -->

    @if ($products->hasPages())

    <div class="luxury-pagination">

        @if ($products->onFirstPage())
            <span class="disabled">← Previous</span>
        @else
            <a href="{{ $products->previousPageUrl() }}">
                ← Previous
            </a>
        @endif

        <span class="page-number">
            {{ str_pad($products->currentPage(), 2, '0', STR_PAD_LEFT) }}
            /
            {{ str_pad($products->lastPage(), 2, '0', STR_PAD_LEFT) }}
        </span>

        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}">
                Next →
            </a>
        @else
            <span class="disabled">Next →</span>
        @endif

    </div>

    @endif

    <div
    id="deleteModal"
    class="modal-overlay"
    onclick="closeDeleteModal()"
>

    <div
        class="modal-card"
        onclick="event.stopPropagation()"
    >

        <h3>

            Delete Product

        </h3>

        <div id="productNameModal"
            class="product-name-modal">
        </div>

        <p id="deleteText">

            Are you sure?

        </p>

        <div class="modal-actions">

            <button
                type="button"
                class="cancel-btn"
                onclick="closeDeleteModal()"
            >

                Cancel

            </button>

            <form
                id="deleteForm"
                method="POST"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="confirm-delete-btn"
                >

                    Delete

                </button>

            </form>

        </div>

    </div>

</div>

</div>

<style>

/* =========================
   PAGE
========================= */

.collection-page{

    width:88%;
    margin:auto;

    padding:60px 0 100px;
}

/* =========================
   HERO
========================= */

.collection-hero{

    text-align:center;

    padding:120px 0 90px;
}

.hero-divider{

    width:80px;
    height:1px;

    background:#111;

    margin:40px auto 0;
}

.collection-hero span{

    letter-spacing:5px;

    font-size:12px;

    color:#777;
}

.collection-hero h1{

    font-size:72px;

    font-weight:300;

    margin:20px 0;
}

.collection-hero p{

    color:#666;

    font-size:18px;
}

.add-product-btn{

    display:inline-block;

    margin-top:35px;

    background:black;

    color:white;

    padding:
        14px
        28px;

    letter-spacing:2px;
}

/* =========================
   SEARCH
========================= */

.search-section{

    margin-bottom:40px;
}

.search-section input{

    width:100%;

    padding:18px;

    border:none;

    border-bottom:
        1px solid #ccc;

    font-size:16px;

    outline:none;
}

/* =========================
   CATEGORY
========================= */

.category-section{

    display:flex;

    justify-content:center;

    gap:35px;

    margin-bottom:60px;

    flex-wrap:wrap;
}

.category-section a{

    color:#666;

    letter-spacing:2px;

    font-size:12px;
}

.active-category{

    color:black !important;

    font-weight:600;

    border-bottom:1px solid black;

    padding-bottom:5px;
}

/* =========================
   PRODUCTS
========================= */

.product-grid{

    display:grid;

    grid-template-columns:
        repeat(auto-fill,minmax(280px,1fr));

    gap:45px;
}

.product-card{

    transition:.3s;
}

.product-image{

    width:100%;

    height:420px;

    object-fit:cover;

    transition:.5s;
}

.product-card:hover
.product-image{

    transform:scale(1.03);
}

.no-image{

    height:420px;

    background:#eee;

    display:flex;

    align-items:center;

    justify-content:center;
}

.product-info{

    padding-top:20px;
}

.category{

    font-size:11px;

    color:#777;

    letter-spacing:3px;

    margin-bottom:10px;
}

.product-info h3{

    font-size:15px;

    margin-bottom:10px;

    font-weight:500;
}

.price{

    font-size:15px;

    font-weight:600;
}

/* =========================
   ADMIN
========================= */

.admin-action{

    margin-top:20px;

    display:flex;

    gap:15px;

    align-items:center;
}

.admin-action a{

    color:black;
}

.confirm-delete-btn{

    width:140px;

    height:52px;

    border:none;

    background:black;

    color:white;

    letter-spacing:2px;

    cursor:pointer;

    transition:.3s;
}

.confirm-delete-btn:hover{

    opacity:.85;
}

/* =========================
   PAGINATION
========================= */

.pagination-wrapper{

    margin-top:80px;

    display:flex;

    justify-content:center;
}

.luxury-pagination{

    margin-top:80px;

    display:flex;

    justify-content:center;

    align-items:center;

    gap:40px;
}

.luxury-pagination a{

    text-decoration:none;

    color:#111;

    letter-spacing:2px;

    font-size:12px;

    text-transform:uppercase;
}

.luxury-pagination a:hover{

    opacity:.5;
}

.page-number{

    font-size:14px;

    letter-spacing:5px;

    color:#111;
}

.disabled{

    color:#bbb;
}

/* =========================
   EMPTY
========================= */

.empty{

    text-align:center;

    padding:80px;
}

/* =========================
   MOBILE
========================= */

.modal-overlay{

    position:fixed;

    inset:0;

    background:
        rgba(0,0,0,.55);

    display:none;

    justify-content:center;

    align-items:center;

    z-index:9999;
}

.modal-card{

    background:white;

    width:480px;

    max-width:90%;

    padding:60px 50px;

    text-align:center;

    border-radius:0;

    box-shadow:
        0 30px 60px rgba(0,0,0,.12);

    animation:
        popup .25s ease;
}

.modal-card h3{

    font-size:14px;

    letter-spacing:4px;

    text-transform:uppercase;

    font-weight:500;

    margin-bottom:25px;
}

.modal-card p{

    color:#666;

    line-height:1.8;

    margin-bottom:30px;
}

.product-name-modal{

    font-size:34px;

    font-weight:300;

    margin-bottom:25px;

    line-height:1.2;
}

.modal-actions{

    display:flex;

    justify-content:center;

    gap:12px;
}

.cancel-btn{

    width:140px;

    height:52px;

    border:1px solid #ddd;

    background:white;

    letter-spacing:2px;

    cursor:pointer;

    transition:.3s;
}

.cancel-btn:hover{

    background:#f7f7f7;
}

.confirm-delete-btn{

    padding:
        12px
        24px;

    border:none;

    background:black;

    color:white;

    cursor:pointer;

    letter-spacing:2px;
}

@media(max-width:768px){

    .collection-hero h1{

        font-size:48px;
    }

    .product-image{

        height:320px;
    }

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

</style>

<script>

function openDeleteModal(
    action,
    productName
){

    document
        .getElementById('deleteModal')
        .style.display = 'flex';

    document
        .getElementById('deleteForm')
        .action = action;

    document
        .getElementById('productNameModal')
        .innerText = productName;

    document
        .getElementById('deleteText')
        .innerHTML =
        `
        This item will be permanently removed
        from your collection.
        `;
}

function closeDeleteModal(){

    document
        .getElementById(
            'deleteModal'
        )
        .style.display = 'none';
}


document
    .getElementById('searchInput')
    .addEventListener('keyup', async function(){

        const keyword = this.value;

        const response = await fetch(
            `/search-products?keyword=${keyword}`
        );

        const products =
            await response.json();

        let html = '';

        products.forEach(product => {

            html += `
                <div class="product-card">

                    <a href="/products/${product.id}">

                        ${
                            product.foto
                            ?
                            `<img
                                src="/${product.foto}"
                                class="product-image"
                            >`
                            :
                            `<div class="no-image">
                                No Image
                            </div>`
                        }

                    </a>

                    <div class="product-info">

                        <div class="category">
                            ${product.kategori.toUpperCase()}
                        </div>

                        <h3>
                            ${product.nama.toUpperCase()}
                        </h3>

                        <div class="price">
                            Rp ${Number(product.harga)
                                .toLocaleString('id-ID')}
                        </div>

                    </div>

                </div>
            `;

        });

        if(products.length === 0){

            html =
            `
                <div class="empty">
                    No products found.
                </div>
            `;
        }

        document
            .getElementById('product-list')
            .innerHTML = html;

    });
</script>

@endsection