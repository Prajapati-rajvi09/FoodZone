@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .menu-page-wrapper {
        background: #fdfdfd;
        min-height: 100vh;
    }

    .menu-header-premium {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{asset('images/home.jpg')}}') center/cover;
        padding: 120px 0 80px;
        color: white;
        text-align: center;
        border-radius: 0 0 60px 60px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        margin-bottom: -40px;
    }

    .search-filter-container {
        position: relative;
        z-index: 1001;
        margin-top: -35px;
    }

    .search-bar-glass {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 25px;
        padding: 20px 30px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .search-input {
        border: none;
        background: transparent;
        width: 100%;
        font-size: 1.1rem;
        font-weight: 500;
        color: #2f3542;
    }

    .search-input:focus {
        outline: none;
    }

    .category-scroll-premium {
        background: white;
        padding: 15px 0;
        position: sticky;
        top: 70px;
        z-index: 1000;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .nav-pill-premium {
        padding: 10px 25px;
        border-radius: 50px;
        color: #747d8c;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid transparent;
        font-size: 0.9rem;
    }

    .nav-pill-premium:hover, .nav-pill-premium.active {
        background: var(--primary-color);
        color: white !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(255, 71, 87, 0.2);
    }

    .food-card-premium {
        background: white;
        border-radius: 30px;
        border: 1px solid #f1f2f6;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
    }

    .food-card-premium:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 30px 60px rgba(0,0,0,0.1);
        border-color: var(--primary-color);
    }

    .food-tag-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 10;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(5px);
        padding: 5px 12px;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 800;
        box-shadow: 0 5px 10px rgba(0,0,0,0.05);
    }

    .food-img-container {
        height: 240px;
        overflow: hidden;
        position: relative;
    }

    .food-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1s ease;
    }

    .food-card-premium:hover .food-img-container img {
        transform: scale(1.1);
    }

    .cart-btn-floating {
        background: linear-gradient(45deg, var(--primary-color), #ff6b81);
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        box-shadow: 0 8px 20px rgba(255, 71, 87, 0.3);
        transition: all 0.3s ease;
    }

    .cart-btn-floating:hover {
        transform: rotate(90deg) scale(1.1);
        color: white;
    }

    .category-label {
        color: var(--primary-color);
        font-weight: 800;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }

    .dot-separator {
        width: 4px;
        height: 4px;
        background: #ced4da;
        border-radius: 50%;
        display: inline-block;
        margin: 0 8px;
        vertical-align: middle;
    }

    #backToTop {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    #backToTop:hover {
        transform: translateY(-5px);
    }

    @media (max-width: 768px) {
        .menu-header-premium { padding: 80px 0 60px; }
        .food-img-container { height: 180px; }
    }
</style>

<div class="menu-page-wrapper">
    <div class="menu-header-premium">
        <div class="container animate__animated animate__fadeIn">
            <h1 class="display-3 fw-bold mb-3" style="font-family: 'Playfair Display', serif;">Gourmet Collections</h1>
            <p class="fs-5 opacity-75">Curated with Passion, Served with Perfection</p>
        </div>
    </div>

    <div class="container search-filter-container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="search-bar-glass">
                    <i class="fa-solid fa-magnifying-glass text-muted fs-4"></i>
                    <input type="text" id="foodSearch" class="search-input" placeholder="Search for your favorite pizza, burger, or dessert...">
                    
                    <!-- Voice Search Button -->
                    <button id="voiceSearchBtn" class="btn btn-light rounded-circle shadow-sm me-2" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border: none; transition: all 0.3s ease;">
                        <i class="fa-solid fa-microphone text-primary"></i>
                    </button>

                    <select id="priceFilter" class="form-select border-0 bg-light rounded-pill px-4" style="width: auto; height: 45px; font-weight: 600;">
                        <option value="all">Sort By</option>
                        <option value="low">Price: Low to High</option>
                        <option value="high">Price: High to Low</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="category-scroll-premium mt-5">
        <div class="container d-flex overflow-auto py-2">
            @foreach($categories as $cat)
            <a href="#cat-{{ Str::slug($cat) }}" class="nav-pill-premium me-2">
                {{ $cat }}
            </a>
            @endforeach
        </div>
    </div>

    <div class="container py-5">
        <div id="foodGrid">
            @foreach($categories as $cat)
                @php
                    $items = $product_entry->filter(function($item) use ($cat) {
                        return ($item->product_entry->productname ?? '') == $cat;
                    });
                @endphp

                @if($items->count() > 0)
                <section class="mb-5 pt-5 category-section" id="cat-{{ Str::slug($cat) }}">
                    <div class="mb-5 text-center">
                        <div class="category-label">Handpicked Selection</div>
                        <h2 class="display-5 fw-bold" style="font-family: 'Playfair Display', serif;">{{ $cat }}</h2>
                        <div class="text-muted small mt-2">Discover our finest {{ strtolower($cat) }} creations</div>
                    </div>

                    <div class="row g-5">
                        @foreach($items as $item)
                        <div class="col-xl-3 col-lg-4 col-md-6 food-item-card" data-price="{{ $item->price }}" data-name="{{ strtolower($item->size) }}">
                            <div class="food-card-premium">
                                <div class="food-tag-badge">
                                    <i class="fa-solid fa-circle {{ rand(0,1) ? 'text-success' : 'text-danger' }} me-1" style="font-size: 0.6rem;"></i> 
                                    {{ rand(0,1) ? 'Best Seller' : 'New Arrival' }}
                                </div>
                                <div class="food-img-container">
                                    <img src="{{ asset('image_upload/'.$item->image1) }}" alt="{{ $item->size }}" loading="lazy">
                                    <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                                        <div class="text-white">
                                            <span class="fw-bold fs-4">₹{{ number_format($item->price, 0) }}</span>
                                            <span class="opacity-75 ms-1 text-sm">/ portion</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="fw-bold mb-0 text-dark">{{ $item->size }}</h5>
                                        <div class="bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-3 small fw-bold">
                                            <i class="fa-solid fa-star me-1"></i>4.{{ rand(5,9) }}
                                        </div>
                                    </div>
                                    <p class="text-muted small mb-4 opacity-75" style="height: 40px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        Delicious and freshly prepared {{ strtolower($cat) }} with premium authentic flavors.
                                    </p>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ url('/viewdetail/'.$item->id.'/'.$item->size) }}" class="text-primary fw-bold text-decoration-none small">
                                            Details <i class="fa-solid fa-chevron-right ms-1" style="font-size: 0.7rem;"></i>
                                        </a>
                                        <form action="{{ url('/addtocart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="productid" value="{{ $item->id }}">
                                            <input type="hidden" name="productqty" value="1">
                                            <input type="hidden" name="productcart" value="cart">
                                            <input type="hidden" name="billno" value="0">
                                            <button type="submit" class="cart-btn-floating">
                                                <i class="fa-solid fa-cart-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            @endforeach
        </div>
    </div>
</div>

<div id="backToTop" class="shadow-lg"><i class="fa-solid fa-arrow-up"></i></div>

<script>
    $(document).ready(function() {
        // Search Functionality
        $("#foodSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".food-item-card").filter(function() {
                $(this).toggle($(this).attr("data-name").indexOf(value) > -1);
            });
            
            // Hide empty categories
            $(".category-section").each(function() {
                var visibleItems = $(this).find(".food-item-card:visible").length;
                $(this).toggle(visibleItems > 0);
            });
        });

        // Price Filter Functionality
        $("#priceFilter").on("change", function() {
            var mode = $(this).val();
            if(mode === 'all') return;

            $(".category-section").each(function() {
                var section = $(this);
                var items = section.find(".food-item-card").get();
                items.sort(function(a, b) {
                    var valA = parseInt($(a).attr("data-price"));
                    var valB = parseInt($(b).attr("data-price"));
                    return mode === 'low' ? valA - valB : valB - valA;
                });
                $.each(items, function(i, item) {
                    section.find(".row").append(item);
                });
            });
        });

        // Back to top button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('#backToTop').css('display', 'flex');
            } else {
                $('#backToTop').css('display', 'none');
            }
        });

        $('#backToTop').click(function() {
            $('html, body').animate({scrollTop: 0}, 600);
            return false;
        });

        // Sticky Navbar adjustments
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('.category-scroll-premium').addClass('shadow-sm');
            } else {
                $('.category-scroll-premium').removeClass('shadow-sm');
            }
        // Voice Search Logic
        const voiceBtn = document.getElementById('voiceSearchBtn');
        const recognition = window.SpeechRecognition || window.webkitSpeechRecognition ? new (window.SpeechRecognition || window.webkitSpeechRecognition)() : null;

        if (recognition) {
            recognition.continuous = false;
            recognition.lang = 'en-US';

            voiceBtn.addEventListener('click', () => {
                recognition.start();
                voiceBtn.classList.add('bg-danger', 'text-white', 'animate__animated', 'animate__pulse', 'animate__infinite');
            });

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                $("#foodSearch").val(transcript).keyup();
                voiceBtn.classList.remove('bg-danger', 'text-white', 'animate__animated', 'animate__pulse', 'animate__infinite');
            };

            recognition.onerror = () => {
                voiceBtn.classList.remove('bg-danger', 'text-white', 'animate__animated', 'animate__pulse', 'animate__infinite');
                Swal.fire('Oops!', 'Voice search failed. Please try again.', 'error');
            };

            recognition.onend = () => {
                voiceBtn.classList.remove('bg-danger', 'text-white', 'animate__animated', 'animate__pulse', 'animate__infinite');
            };
        } else {
            voiceBtn.style.display = 'none';
        }

        // Smart Auto-Order Logic
        const urlParams = new URLSearchParams(window.location.search);
        const autoOrderCat = urlParams.get('autoOrder');
        if (autoOrderCat && typeof handleMagicOrder === 'function') {
            handleMagicOrder(autoOrderCat);
        }
    });
</script>

@endsection
