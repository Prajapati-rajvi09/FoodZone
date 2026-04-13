@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .detail-container {
        padding: 80px 0;
    }
    .img-main-container {
        background: white;
        border-radius: 40px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        height: 500px;
    }
    .img-main-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .info-card {
        background: white;
        border-radius: 40px;
        padding: 50px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        height: 100%;
    }
    .price-big {
        font-size: 3rem;
        font-weight: 800;
        color: var(--primary-color);
        margin-bottom: 30px;
    }
    .feature-tag {
        display: inline-flex;
        align-items: center;
        background: #f1f2f6;
        padding: 10px 20px;
        border-radius: 15px;
        margin-right: 10px;
        margin-bottom: 10px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .feature-tag i {
        color: var(--primary-color);
        margin-right: 10px;
    }
</style>

<div class="detail-container">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/viewproduct') }}" class="text-decoration-none text-muted">Menu</a></li>
                <li class="breadcrumb-item active fw-bold text-dark">{{ $item->product_entry->productname }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-6">
                <div class="img-main-container">
                    <img src="{{ asset('image_upload/'.$item->image1) }}" alt="{{ $item->product_entry->productname }}">
                </div>
                
                <!-- Thumbnails if any -->
                <div class="row mt-4 g-3">
                    @for($i=2; $i<=4; $i++)
                        @php $imgField = 'image'.$i; @endphp
                        @if($item->$imgField)
                        <div class="col-3">
                            <div class="rounded-4 overflow-hidden shadow-sm" style="height: 100px;">
                                <img src="{{ asset('image_upload/'.$item->$imgField) }}" class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>
                        @endif
                    @endfor
                </div>
            </div>

            <div class="col-lg-6">
                <div class="info-card">
                    <span class="badge bg-soft-primary px-3 py-2 rounded-pill mb-3" style="background: rgba(110, 142, 251, 0.1); color: var(--primary-color); font-weight: 700;">
                        {{ $item->product_entry->productname }}
                    </span>
                    <h1 class="display-4 fw-bold text-dark mb-4">{{ $item->product_entry->productname }}</h1>
                    
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="text-warning fs-5">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <span class="text-muted fw-bold">(4.9 Rated by 200+ customers)</span>
                    </div>

                    <div class="price-big">₹{{ $item->price }}</div>

                    <div class="description mb-5">
                        <h5 class="fw-bold text-dark mb-3">About this dish</h5>
                        <p class="text-muted fs-5" style="line-height: 1.8;">
                            Experience the authentic taste of our signature {{ $item->product_entry->productname }}. 
                            Prepared with freshly sourced ingredients and traditional spices to ensure a premium dining experience right at your home.
                        </p>
                    </div>

                    <div class="features mb-5">
                        <div class="feature-tag"><i class="fa-solid fa-leaf"></i> Fresh Ingredients</div>
                        <div class="feature-tag"><i class="fa-solid fa-fire"></i> Served Hot</div>
                        <div class="feature-tag"><i class="fa-solid fa-clock"></i> 30-Min Delivery</div>
                        <div class="feature-tag"><i class="fa-solid fa-ruler-combined"></i> {{ $item->size }} Serving</div>
                    </div>

                    <div class="d-flex gap-3">
                        <form action="{{ url('/addtocart') }}" method="POST" class="flex-grow-1">
                            @csrf
                            <input type="hidden" name="productid" value="{{ $item->id }}">
                            <input type="hidden" name="productqty" value="1">
                            <input type="hidden" name="productcart" value="cart">
                            <input type="hidden" name="billno" value="0">
                            <input type="hidden" name="pprice" value="{{ $item->price }}">
                            <button class="btn btn-premium w-100 py-3 rounded-4 fs-5 fw-bold shadow">
                                <i class="fa-solid fa-cart-plus me-3"></i> Add to Bag
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
