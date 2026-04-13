@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .hero-swiper {
        height: 700px;
        border-radius: 50px;
        margin: 20px 0 60px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.15);
        .hero-section {
            height: 90vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('{{ asset('premium_pizza_hero_1776080155632.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            border-radius: 0 0 80px 80px;
            margin-bottom: -100px;
            position: relative;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }

        .category-card {
            background: white;
            border-radius: 35px;
            padding: 40px;
            text-align: center;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(0,0,0,0.03);
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, rgba(255, 71, 87, 0.05) 0%, rgba(255, 165, 2, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .category-card:hover::before { opacity: 1; }

        .category-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 30px 60px rgba(255, 71, 87, 0.1);
            border-color: rgba(255, 71, 87, 0.1);
        }

        .cat-img-box {
            width: 140px;
            height: 140px;
            margin: 0 auto 25px;
            border-radius: 40px;
            overflow: hidden;
            background: #f8f9fa;
            transition: transform 0.5s ease;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }

        .category-card:hover .cat-img-box {
            transform: rotate(10deg) scale(1.1);
        }

        .cat-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            image-rendering: -webkit-optimize-contrast;
            transition: all 0.5s ease;
        }
transition: transform 0.8s ease;
    }
    .slide-content {
        background: linear-gradient(to right, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0) 80%);
        height: 100%;
        display: flex;
        align-items: center;
        padding-left: 8%;
        border-radius: 50px;
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 5.5rem;
        line-height: 1.1;
        letter-spacing: -2px;
    }
    .food-card {
        background: white;
        border-radius: 40px;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .food-card:hover {
        transform: translateY(-20px);
        box-shadow: 0 30px 60px rgba(255, 71, 87, 0.15);
    }
    .food-img-container {
        height: 280px;
        position: relative;
        overflow: hidden;
        margin: 15px;
        border-radius: 30px;
    }
    .food-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }
    .price-tag-floating {
        position: absolute;
        bottom: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        padding: 10px 20px;
        border-radius: 20px;
        font-weight: 800;
        color: var(--primary-color);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        font-size: 1.2rem;
    }
    .cat-icon-box {
        width: 100px;
        height: 100px;
        background: white;
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: var(--primary-color);
        margin: 0 auto 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    .category-item:hover .cat-icon-box {
        background: var(--primary-color);
        color: white;
        transform: scale(1.1) rotate(10deg);
    }
    .category-item {
        text-decoration: none;
        color: var(--secondary-color);
        transition: all 0.3s ease;
    }
    .section-header {
        margin-bottom: 60px;
    }
    .section-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 800;
    }
    .floating-badge {
        background: rgba(255, 71, 87, 0.1);
        color: var(--primary-color);
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 700;
        display: inline-block;
        margin-bottom: 15px;
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 2.2rem !important; margin-top: 20px; word-break: break-word; line-height: 1.2; }
        .section-header h2 { font-size: 1.8rem !important; }
        .display-3 { font-size: 2.2rem !important; }
        .hero-swiper { height: 450px; border-radius: 25px; margin-top: 10px; }
        .slide-content { padding: 0 15px; text-align: center; justify-content: center; align-items: center; }
        .hero-title br { display: none; } /* Remove line breaks on mobile */
    }
</style>

<div class="container animate__animated animate__fadeIn">
    <!-- Premium Hero Slider -->
    <div class="swiper main-swiper hero-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background: url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=1920&q=80') center/cover;">
                <div class="slide-content">
                    <div class="text-white" style="max-width: 700px;">
                        <span class="floating-badge bg-white">✨ New Season Arrivals</span>
                        <h1 class="hero-title mb-4">Taste the <br>Future of <span style="color: var(--primary-color)">Flavor</span></h1>
                        <p class="fs-4 opacity-75 mb-5 fw-light">Discover the finest ingredients blended with innovative culinary techniques.</p>
                        <a href="{{ url('/viewproduct') }}" class="btn-premium px-5 py-4 fs-5 text-white text-decoration-none shadow-lg">Start Exploring Menu</a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" style="background: url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=1920&q=80') center/cover;">
                <div class="slide-content">
                    <div class="text-white" style="max-width: 700px;">
                        <span class="floating-badge bg-white">🔥 Most Loved Dishes</span>
                        <h1 class="hero-title mb-4">Artisan <br>Cooking <span style="color: var(--accent-color)">Handmade</span></h1>
                        <p class="fs-4 opacity-75 mb-5 fw-light">Every dish Tells a story of tradition and cinematic fusion.</p>
                        <a href="{{ url('/viewproduct') }}" class="btn-premium px-5 py-4 fs-5 text-white text-decoration-none shadow-lg">Our Signature Collection</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <!-- Quick Categories -->
    <div class="section-header text-center">
        <span class="floating-badge">Browse Categories</span>
        <h2>What's on your mind?</h2>
    </div>

    <div class="row g-4 mb-5 pb-5 text-center">
        <div class="col-6 col-lg-2">
            <a href="{{ url('/viewproduct#category-pizza') }}" class="category-item">
                <div class="cat-icon-box shadow-lg border">
                    <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=150&q=80" style="width: 100%; height: 100%; object-fit: cover; border-radius: 30px;" alt="Pizza">
                </div>
                <h6 class="fw-bold">Pizza</h6>
            </a>
        </div>
        <div class="col-6 col-lg-2">
            <a href="{{ url('/viewproduct#category-burgers') }}" class="category-item">
                <div class="cat-icon-box shadow-lg border">
                    <img src="https://images.unsplash.com/photo-1571091718767-18b5b1457add?auto=format&fit=crop&w=150&q=80" style="width: 100%; height: 100%; object-fit: cover; border-radius: 30px;" alt="Burgers">
                </div>
                <h6 class="fw-bold">Burgers</h6>
            </a>
        </div>
        <div class="col-6 col-lg-2">
            <a href="{{ url('/viewproduct#category-desserts') }}" class="category-item">
                <div class="cat-icon-box shadow-lg border">
                    <img src="https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?auto=format&fit=crop&w=150&q=80" style="width: 100%; height: 100%; object-fit: cover; border-radius: 30px;" alt="Desserts">
                </div>
                <h6 class="fw-bold">Desserts</h6>
            </a>
        </div>
        <div class="col-6 col-lg-2">
            <a href="{{ url('/viewproduct#category-drinks') }}" class="category-item">
                <div class="cat-icon-box shadow-lg border">
                    <img src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&w=200&q=80" style="width: 100%; height: 100%; object-fit: cover; border-radius: 30px;" alt="Drinks">
                </div>
                <h6 class="fw-bold">Drinks</h6>
            </a>
        </div>
        <div class="col-6 col-lg-2">
            <a href="{{ url('/viewproduct#category-grilled') }}" class="category-item">
                <div class="cat-icon-box shadow-lg border">
                    <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=150&q=80" style="width: 100%; height: 100%; object-fit: cover; border-radius: 30px;" alt="Grilled">
                </div>
                <h6 class="fw-bold">Grilled</h6>
            </a>
        </div>
        <div class="col-6 col-lg-2">
            <a href="{{ url('/viewproduct#category-veggie') }}" class="category-item">
                <div class="cat-icon-box shadow-lg border">
                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=150&q=80" style="width: 100%; height: 100%; object-fit: cover; border-radius: 30px;" alt="Veggie">
                </div>
                <h6 class="fw-bold">Veggie</h6>
            </a>
        </div>
    </div>

    <!-- Featured Grid -->
    <section class="py-5 mt-5">
        <div class="row align-items-end mb-5">
            <div class="col-md-7">
                <span class="floating-badge">Chef's Recommendations</span>
                <h2 class="display-3 fw-bold" style="font-family: 'Playfair Display', serif;">Popular Right Now</h2>
            </div>
            <div class="col-md-5 text-md-end pb-3">
                <a href="{{ url('/viewproduct') }}" class="text-primary fw-bold text-decoration-none fs-5">View Full Menu <i class="fa-solid fa-arrow-right ms-2"></i></a>
            </div>
        </div>

        <div class="row g-5">
            <!-- Item 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="food-card">
                    <div class="food-img-container">
                        <img src="https://images.unsplash.com/photo-1589301760014-d929f3979dbc?auto=format&fit=crop&w=800&q=80" alt="Masala Dosa">
                        <div class="price-tag-floating">₹120</div>
                    </div>
                    <div class="p-5 pt-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="fw-bold mb-0">Premium Dosa</h3>
                            <div class="bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-3 small fw-bold">
                                <i class="fa-solid fa-star"></i> 4.8
                            </div>
                        </div>
                        <p class="text-muted mb-4 opacity-75">Crispy golden dosa fermented to perfection, served with authentic sambar.</p>
                        <a href="{{ url('/viewproduct') }}" class="btn btn-premium w-100 py-3 rounded-4 shadow-sm">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="food-card">
                    <div class="food-img-container">
                        <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=800&q=80" alt="Veggie Pizza">
                        <div class="price-tag-floating">₹299</div>
                    </div>
                    <div class="p-5 pt-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="fw-bold mb-0">Veggie Pizza</h3>
                            <div class="bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-3 small fw-bold">
                                <i class="fa-solid fa-star"></i> 4.9
                            </div>
                        </div>
                        <p class="text-muted mb-4 opacity-75">Fresh farm toppings with premium mozzarella cheese on hand-stretched dough.</p>
                        <a href="{{ url('/viewproduct') }}" class="btn btn-premium w-100 py-3 rounded-4 shadow-sm">Order Now</a>
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="col-lg-4 d-none d-lg-block">
                <div class="food-card">
                    <div class="food-img-container">
                        <img src="https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?auto=format&fit=crop&w=800&q=80" alt="Biryani">
                        <div class="price-tag-floating">₹250</div>
                    </div>
                    <div class="p-5 pt-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="fw-bold mb-0">Royal Biryani</h3>
                            <div class="bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-3 small fw-bold">
                                <i class="fa-solid fa-star"></i> 4.7
                            </div>
                        </div>
                        <p class="text-muted mb-4 opacity-75">Long grain basmati rice slow-cooked with signature spices and tender herbs.</p>
                        <a href="{{ url('/viewproduct') }}" class="btn btn-premium w-100 py-3 rounded-4 shadow-sm">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- App Promo -->
    <div class="py-5 my-5">
        <div class="rounded-5 p-5 text-white text-center position-relative overflow-hidden shadow-lg border-0" style="background: linear-gradient(135deg, #1e272e, #2f3542);">
            <div class="position-relative z-1 py-4">
                <h2 class="display-3 fw-bold mb-4">Hungry? Stay Home, <br>We Deliver <span class="text-primary">Fast!</span></h2>
                <p class="fs-4 opacity-75 mb-5 mx-auto" style="max-width: 700px;">Get 40% OFF on your first order. Use code <b>FOODZONE40</b></p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url('/viewproduct') }}" class="btn btn-premium px-5 py-3 fs-5">Order Now</a>
                    <a href="#" class="btn btn-outline-light px-5 py-3 fs-5 rounded-4">Contact Support</a>
                </div>
            </div>
            <!-- Decorative circle -->
            <div class="position-absolute" style="width: 300px; height: 300px; background: rgba(255, 71, 87, 0.1); border-radius: 50%; top: -100px; right: -100px;"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper(".main-swiper", {
            speed: 1200,
            loop: true,
            effect: "fade",
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    });
</script>

@endsection
