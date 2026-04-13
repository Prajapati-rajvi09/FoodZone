<?php 
use App\Http\Controllers\CustomerPanelController;
$total = CustomerPanelController::cartitem();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FoodZone | Premium Dining Experience</title>
    
    <!-- Fonts & Icons -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Smart Auto-Order Logic
            window.handleMagicOrder = function(category) {
                // Find the targeted category section (case-insensitive and partial match)
                const targetSection = $(`section[id*="${category.toLowerCase()}"]`);
                
                if (targetSection.length > 0) {
                    const firstItemForm = targetSection.find('form').first();
                    if (firstItemForm.length > 0) {
                        Swal.fire({
                            title: 'AI Magic Ordering...',
                            text: `${category} section dhoond liya hai! Adding to cart... 🍕✨`,
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: () => { Swal.showLoading(); }
                        }).then(() => {
                            firstItemForm.submit(); // Direct Form Submission
                        });
                    }
                } else {
                    Swal.fire('Sorry!', `${category} section nahi mil raha hai.`, 'info');
                }
            };

            const urlParams = new URLSearchParams(window.location.search);
            const autoOrderCat = urlParams.get('autoOrder');
            if (autoOrderCat) {
                handleMagicOrder(autoOrderCat);
            }
        });
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <style>
        html, body { overflow-x: hidden; width: 100%; margin: 0; padding: 0; }
        :root {
            --primary-color: #ff4757;
            --secondary-color: #2f3542;
            --accent-color: #ffa502;
            --bg-light: #f8f9fa;
            --text-dark: #2f3542;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --card-bg: #ffffff;
            --border-color: rgba(0,0,0,0.05);
        }

        [data-theme="dark"] {
            --bg-light: #0f172a;
            --text-dark: #f1f2f7;
            --secondary-color: #1e293b;
            --glass-bg: rgba(30, 41, 59, 0.95);
            --card-bg: #1e293b;
            --border-color: rgba(255,255,255,0.1);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Dark Mode Toggle */
        .theme-toggle {
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--border-color);
            color: var(--text-dark);
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: var(--primary-color);
            color: white;
            transform: rotate(15deg);
        }

        /* Navbar Styling */
        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            padding: 0.4rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            letter-spacing: -1px;
            background: linear-gradient(45deg, #ff4757, #ffa502);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            font-weight: 600;
            color: var(--text-dark) !important;
            margin: 0 12px;
            padding: 8px 0;
            position: relative;
            transition: color 0.3s ease;
        }

        /* Corrected card styles to use variables */
        .card, .food-card, .food-card-v2, .food-card-premium, .info-card, .profile-card, .cart-item-card {
            background-color: var(--card-bg) !important;
            border-color: var(--border-color) !important;
        }
        
        .text-muted {
            color: #94a3b8 !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -5px;
            left: 0;
            background: var(--primary-color);
            border-radius: 10px;
            transition: width 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        .btn-premium {
            background: linear-gradient(45deg, var(--primary-color), #ff6b81);
            color: white;
            border-radius: 18px;
            padding: 12px 28px;
            font-weight: 700;
            border: none;
            box-shadow: 0 10px 20px rgba(255, 71, 87, 0.2);
            transition: all 0.3s ease;
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 71, 87, 0.3);
            color: white;
        }

        .cart-badge {
            background: var(--accent-color);
            color: white;
            font-size: 0.65rem;
            padding: 5px 8px;
            border-radius: 50%;
            position: absolute;
            top: -8px;
            right: -12px;
            font-weight: 800;
            border: 2px solid var(--card-bg);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Mobile Bottom Nav (PWA feel) */
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--card-bg);
            display: none;
            justify-content: space-around;
            padding: 15px 5px;
            box-shadow: 0 -10px 30px rgba(0,0,0,0.05);
            border-radius: 30px 30px 0 0;
            z-index: 1050;
        }

        .mobile-nav-item {
            flex: 1;
            text-align: center;
            font-size: 0.65rem;
            color: #64748b;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            transition: all 0.3s ease;
            min-width: 0;
        }
        .mobile-nav-item i { font-size: 1.1rem; }

        .mobile-nav-item.active {
            color: var(--primary-color);
        }

        @media (max-width: 991px) {
            .navbar-nav { display: none; }
            .mobile-bottom-nav { display: flex; }
            main { padding-bottom: 80px; }
        }

        footer {
            background: var(--secondary-color);
            color: white;
            padding: 5rem 0 2rem;
            margin-top: 80px;
            border-radius: 50px 50px 0 0;
        }

        /* Premium Dropdown UI */
        .dropdown-menu {
            display: block !important;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: var(--glass-bg) !important;
            backdrop-filter: blur(15px);
            border-radius: 20px !important;
            padding: 15px !important;
            min-width: 200px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
            border: 1px solid var(--border-color) !important;
        }

        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 25px;
            width: 15px;
            height: 15px;
            background: var(--card-bg);
            transform: rotate(45deg);
            border-left: 1px solid var(--border-color);
            border-top: 1px solid var(--border-color);
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            border-radius: 12px !important;
            padding: 10px 15px !important;
            font-weight: 600 !important;
            color: var(--text-dark) !important;
            transition: all 0.3s ease !important;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 71, 87, 0.1) !important;
            color: #ff4757 !important;
            transform: translateX(5px);
        }

        .dropdown-item i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* AI Chatbot Mock Styles */
        #chatbot-bubble {
            position: fixed;
            bottom: 30px;
            left: 30px; /* Moved back to Left to avoid conflict with backToTop */
            width: 65px;
            height: 65px;
            background: linear-gradient(45deg, var(--primary-color), #ff6b81);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            cursor: pointer;
            z-index: 9999;
            box-shadow: 0 10px 25px rgba(255, 71, 87, 0.4);
            transition: all 0.3s ease;
            animation: chatPulse 2s infinite;
        }

        @keyframes chatPulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 71, 87, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(255, 71, 87, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 71, 87, 0); }
        }

        #chatbot-bubble:hover { transform: scale(1.1) rotate(-15deg); }

        /* Live Activity Marquee */
        .live-marquee {
            background: linear-gradient(90deg, #1e293b, #334155);
            color: white;
            padding: 8px 0;
            font-size: 0.85rem;
            font-weight: 600;
            z-index: 1100; /* Higher than navbar */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        [data-theme="dark"] .live-marquee {
            background: linear-gradient(90deg, #020617, #0f172a);
        }

        .marquee-content {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 30s linear infinite;
            padding-left: 100%;
        }

        @keyframes marquee {
            0% { transform: translate(0, 0); }
            100% { transform: translate(-100%, 0); }
        }

        .marquee-item {
            display: inline-flex;
            align-items: center;
            margin-right: 50px;
        }

        .marquee-item i {
            color: var(--accent-color);
            margin-right: 8px;
        }

        #chatbot-window {
            position: fixed;
            bottom: 110px;
            left: 30px; /* Moved back to Left */
            width: 350px;
            background: var(--card-bg);
            border-radius: 25px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            z-index: 9999;
            display: none;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .chat-header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-body {
            height: 300px;
            overflow-y: auto;
            padding: 20px;
            background: var(--bg-light);
        }

        .chat-msg {
            margin-bottom: 15px;
            max-width: 80%;
            padding: 10px 15px;
            border-radius: 15px;
            font-size: 0.9rem;
        }

        .msg-bot { background: white; color: #2d3436; align-self: flex-start; border-bottom-left-radius: 0; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .msg-user { background: var(--primary-color); color: white; align-self: flex-end; margin-left: auto; border-bottom-right-radius: 0; }

        .chat-footer { padding: 15px; background: var(--card-bg); display: flex; gap: 10px; }
        .chat-input { flex: 1; border: none; background: var(--bg-light); padding: 10px 15px; border-radius: 12px; font-size: 0.9rem; color: var(--text-dark); }
        .chat-input:focus { outline: none; }

        /* Scratch Card Styles */
        #scratch-container {
            position: fixed;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 320px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 40px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.5);
            z-index: 10001;
            display: none;
            text-align: center;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.3);
            animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        @keyframes bounceIn {
            0% { transform: translate(-50%, -50%) scale(0.5); opacity: 0; }
            100% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
        }
        #scratch-card {
            position: relative;
            width: 250px;
            height: 250px;
            margin: 0 auto 20px;
            border-radius: 25px;
            overflow: hidden;
            background: #fff;
            box-shadow: inset 0 0 15px rgba(0,0,0,0.05);
            cursor: crosshair;
        }
        #scratch-canvas {
            position: absolute;
            top: 0; left: 0;
            z-index: 2;
        }
        .reward-content {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1;
            background: linear-gradient(135deg, #fff 0%, #f1f2f6 100%);
        }
        .reward-code {
            font-size: 2.2rem;
            font-weight: 900;
            color: #ff4757;
            letter-spacing: 2px;
            text-shadow: 0 4px 10px rgba(255, 71, 87, 0.2);
        }
        .scratch-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(5px);
            z-index: 10000;
            display: none;
        /* Global Reset for Mobile */
        * { box-sizing: border-box; }
        
        /* Mobile Optimization */
        @media (max-width: 768px) {
            .container { padding-left: 15px; padding-right: 15px; overflow: hidden; }
            .navbar-brand .logo-text { font-size: 1.3rem; }
            .btn-premium { width: 100%; margin-bottom: 10px; text-align: center; justify-content: center; }
            .live-marquee { font-size: 0.7rem; padding: 4px 0; height: 35px; }
            nav.navbar { top: 35px !important; }
            main { padding-top: 105px !important; }
            
            /* Chatbot Mobile Fix */
            #chatbot-bubble { bottom: 85px; left: 15px; width: 50px; height: 50px; font-size: 1.3rem; }
            #chatbot-window { 
                width: calc(100% - 30px); 
                left: 15px; 
                bottom: 85px; 
                height: 400px; 
                max-width: none;
            }
            .chat-msg { max-width: 90%; }

            /* Grid Fixes */
            .row { margin-left: -5px; margin-right: -5px; }
            .col-12, .col-6, .col-md-6, .col-lg-4 { padding-left: 5px; padding-right: 5px; }
            
            /* Button & Flex Wrap */
            .d-flex.gap-3 { flex-wrap: wrap !important; }
            .d-flex.gap-3 .btn { flex: 1 1 100%; }
        }
    </style>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="scratch-overlay"></div>
    <div id="scratch-container">
        <div class="p-4">
            <h4 class="fw-bold mb-2">You Won a Reward! 🎁</h4>
            <p class="small text-muted mb-4">Scratch the card below to reveal your secret gift!</p>
            <div id="scratch-card">
                <div class="reward-content">
                    <span class="text-muted small mb-1">Your Coupon Code:</span>
                    <div class="reward-code">FOODIE25</div>
                    <div class="mt-2 badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Valid for 48 Hours</div>
                </div>
                <canvas id="scratch-canvas" width="250" height="250"></canvas>
            </div>
            <button class="btn btn-premium w-100 py-3 rounded-4 mt-2" onclick="closeScratchCard()">Claim & Continue</button>
        </div>
    </div>

    <!-- Live Activity Marquee -->
    <div class="live-marquee">
        <div class="marquee-content" id="marqueeItems">
            <span class="marquee-item"><i class="fa-solid fa-fire"></i> Hot Offer: Get 50% off on all Burgers today! Use code: BURGER50</span>
            <span class="marquee-item"><i class="fa-solid fa-circle-check"></i> Rahul just ordered a Paneer Tikka Masala!</span>
            <span class="marquee-item"><i class="fa-solid fa-bolt"></i> Lightning Fast Delivery now available in Mumbai Metropolitan!</span>
            <span class="marquee-item"><i class="fa-solid fa-heart"></i> Loved by 10,000+ Foodies across the city!</span>
            <span class="marquee-item"><i class="fa-solid fa-star"></i> Priya gave 5-stars to Margherita Pizza!</span>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg fixed-top" style="top: 36px;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/customerindex') }}">
                <span class="logo-text">FoodZone</span>
            </a>
            
            <div class="d-flex align-items-center">
                <ul class="navbar-nav ms-auto mb-0 align-items-center flex-row">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link {{ Request::is('customerindex') ? 'active' : '' }}" href="{{ url('/customerindex') }}">Explore</a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link {{ Request::is('viewproduct') ? 'active' : '' }}" href="{{ url('/viewproduct') }}">Menu</a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link {{ Request::is('myorder') ? 'active' : '' }}" href="{{ url('/myorder') }}">My Orders</a></li>
                    
                    <li class="nav-item">
                        <div class="theme-toggle" id="themeToggle">
                            <i class="fa-solid fa-moon"></i>
                        </div>
                    </li>

                    <li class="nav-item ms-lg-3 me-3 position-relative">
                        <a class="nav-link p-0" href="{{ url('/addtocart') }}">
                            <i class="fa-solid fa-bag-shopping fs-4"></i>
                            <span class="cart-badge">{{ $total }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="btn-premium dropdown-toggle text-decoration-none d-flex align-items-center p-2 pe-3" href="#" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('img/user.jpg') }}" class="rounded-circle me-2 border border-white" width="32" height="32" style="border-width: 2px !important;">
                                <span class="d-none d-sm-inline">{{ Session::get('CustomerLogginId')['name'] }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 rounded-4 mt-3 animate__animated animate__fadeIn">
                                <li><a class="dropdown-item rounded-3 py-2 px-3" href="{{ url('/profile') }}"><i class="fa-solid fa-circle-user me-3 text-primary"></i>My Profile</a></li>
                                <li><a class="dropdown-item rounded-3 py-2 px-3" href="{{ url('/myorder') }}"><i class="fa-solid fa-clock-rotate-left me-3 text-primary"></i>Order History</a></li>
                                <li><a class="dropdown-item rounded-3 py-2 px-3" href="{{ url('/feedback') }}"><i class="fa-solid fa-comment-dots me-3 text-primary"></i>Send Feedback</a></li>
                                <li><hr class="dropdown-divider mx-2"></li>
                                <li><a class="dropdown-item rounded-3 py-2 px-3 text-danger" href="{{ url('/customerlogout') }}"><i class="fa-solid fa-arrow-right-from-bracket me-3"></i>Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Navigation -->
    <div class="mobile-bottom-nav">
        <a href="{{ url('/customerindex') }}" class="mobile-nav-item {{ Request::is('customerindex') ? 'active' : '' }}">
            <i class="fa-solid fa-compass"></i>
            Explore
        </a>
        <a href="{{ url('/viewproduct') }}" class="mobile-nav-item {{ Request::is('viewproduct') ? 'active' : '' }}">
            <i class="fa-solid fa-utensils"></i>
            Menu
        </a>
        <a href="{{ url('/addtocart') }}" class="mobile-nav-item {{ Request::is('addtocart') ? 'active' : '' }}">
            <i class="fa-solid fa-cart-shopping"></i>
            Cart
        </a>
        <a href="{{ url('/myorder') }}" class="mobile-nav-item {{ Request::is('myorder') ? 'active' : '' }}">
            <i class="fa-solid fa-receipt"></i>
            Orders
        </a>
        <a href="{{ url('/profile') }}" class="mobile-nav-item {{ Request::is('profile') ? 'active' : '' }}">
            <i class="fa-solid fa-user"></i>
            Account
        </a>
        <a href="{{ url('/customerlogout') }}" class="mobile-nav-item text-danger">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>
    </div>

    <main style="padding-top: 110px;">
        @yield('Abhiraj')
    </main>

    <!-- AI Assistant Bubble & Window -->
    <div id="chatbot-bubble" title="Need help?">
        <i class="fa-solid fa-robot"></i>
    </div>
    <div id="chatbot-window">
        <div class="chat-header">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-robot me-2"></i>
                <span class="fw-bold">Foodie AI Support</span>
            </div>
            <i class="fa-solid fa-xmark cursor-pointer" id="closeChat" style="cursor: pointer;"></i>
        </div>
        <div class="chat-body d-flex flex-column" id="chatBody">
            <div class="chat-msg msg-bot">Hello! How can I help you today? You can ask about our timing, location or offers.</div>
        </div>
        <div class="chat-footer">
            <input type="text" class="chat-input" id="chatInput" placeholder="Type a message...">
            <button class="btn btn-primary rounded-circle" id="sendMsg" style="width: 40px; height: 40px; padding: 0;"><i class="fa-solid fa-paper-plane"></i></button>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 for Premium Notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Canvas Confetti for Celebration -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <script>
        $(document).ready(function() {
            // Celebrate on order success (After Payment/Checkout)
            @if(session('status'))
                @if(str_contains(strtolower(session('status')), 'checkout successfully'))
                    confetti({
                        particleCount: 150,
                        spread: 70,
                        origin: { y: 0.6 },
                        colors: ['#ff4757', '#ffa502', '#2f3542']
                    });
                    
                    setTimeout(() => {
                        showScratchCard();
                    }, 1200);
                @endif
            @endif
            // Theme Logic
            const themeToggle = document.getElementById('themeToggle');
            const body = document.body;
            const icon = themeToggle.querySelector('i');

            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                body.setAttribute('data-theme', savedTheme);
                updateIcon(savedTheme);
            }

            themeToggle.addEventListener('click', () => {
                let theme = body.getAttribute('data-theme');
                if (theme === 'dark') {
                    body.removeAttribute('data-theme');
                    localStorage.setItem('theme', 'light');
                    updateIcon('light');
                } else {
                    body.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                    updateIcon('dark');
                }
            });

            function updateIcon(theme) {
                if (theme === 'dark') { icon.classList.replace('fa-moon', 'fa-sun'); } 
                else { icon.classList.replace('fa-sun', 'fa-moon'); }
            }

            // High-End Notifications (SweetAlert2)
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if(session('status'))
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('status') }}",
                    background: body.getAttribute('data-theme') === 'dark' ? '#1e293b' : '#fff',
                    color: body.getAttribute('data-theme') === 'dark' ? '#fff' : '#000'
                });
            @endif

            @if(session('error'))
                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}",
                    background: body.getAttribute('data-theme') === 'dark' ? '#1e293b' : '#fff',
                    color: body.getAttribute('data-theme') === 'dark' ? '#fff' : '#000'
                });
            @endif

            // AI Chatbot Logic
            $('#chatbot-bubble').click(() => $('#chatbot-window').fadeToggle());
            $('#closeChat').click(() => $('#chatbot-window').fadeOut());

            $('#sendMsg').click(sendMessage);
            $('#chatInput').keypress((e) => { if(e.which == 13) sendMessage(); });

            function sendMessage() {
                const input = $('#chatInput');
                const text = input.val().trim();
                if(!text) return;

                $('#chatBody').append(`<div class="chat-msg msg-user animate__animated animate__fadeInRight">${text}</div>`);
                input.val('');
                $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);

                // Expanded AI Brain (Conversational Logic)
                setTimeout(() => {
                    let lowerText = text.toLowerCase();
                    let reply = "";

                    // 1. Greetings
                    if(['hi', 'hello', 'hey', 'helloo', 'kaise ho', 'hii'].some(word => lowerText.includes(word))) {
                        reply = "Hi there! 👋 Main FoodZone ka AI Assistant hoon. Main aapka order lene ya aapki madad karne ke liye tayyar hoon. Aap kaise hain?";
                    }
                    // 2. Gratitude
                    else if(['thank', 'thanks', 'shukriya', 'dhanyawad'].some(word => lowerText.includes(word))) {
                        reply = "You're most welcome! 😊 Aapko serve karke humein khushi huyi. Agar kuch aur chahiye toh bataiye!";
                    }
                    // 3. Appreciation
                    else if(['nice', 'awesome', 'good', 'great', 'mazza', 'badhiya'].some(word => lowerText.includes(word))) {
                        reply = "Thank you so much! ❤️ Hum hamesha best quality service dene ki koshish karte hain. Enjoy your meal!";
                    }
                // 4. Ordering Intent (Deep Backend-Aware Logic)
                @php
                    $allProducts = \App\Models\ProductEntryModel::with('product_entry')->get()->map(function($p) {
                        return [
                            'id' => $p->id,
                            'name' => strtolower($p->product_entry->productname ?? ''),
                            'price' => $p->price
                        ];
                    })->toArray();
                @endphp
                const productList = {!! json_encode($allProducts) !!};
                
                let bestMatch = null;
                productList.forEach(prod => {
                    if(lowerText.includes(prod.name)) {
                        // Priority to longer names to match "Paneer Tikka Masala" over just "Paneer"
                        if(!bestMatch || prod.name.length > bestMatch.name.length) {
                            bestMatch = prod;
                        }
                    }
                });

                if(bestMatch || ['order', 'buy', 'want', 'khana'].some(word => lowerText.includes(word))) {
                    if(bestMatch) {
                        reply = `Zaroor! Main aapke liye hamara best **${bestMatch.name}** cart mein add kar raha hoon... ✨`;
                        
                        // Action: Use a hidden magic form to add to cart
                        setTimeout(() => {
                            Swal.fire({
                                title: 'AI Magic Ordering...',
                                text: `${bestMatch.name} dhoond liya hai! Price: ₹${bestMatch.price}`,
                                timer: 1500,
                                timerProgressBar: true,
                                didOpen: () => { Swal.showLoading(); }
                            }).then(() => {
                                // Create a dynamic form to submit to addtocart
                                const magicForm = `
                                    <form id="magicForm" action="{{ url('/addtocart') }}" method="POST" style="display:none;">
                                        @csrf
                                        <input type="hidden" name="productid" value="${bestMatch.id}">
                                        <input type="hidden" name="productqty" value="1">
                                        <input type="hidden" name="pprice" value="${bestMatch.price}">
                                        <input type="hidden" name="productcart" value="cart">
                                        <input type="hidden" name="billno" value="0">
                                    </form>
                                `;
                                $('body').append(magicForm);
                                $('#magicForm').submit();
                            });
                        }, 1000);
                    } else {
                        reply = "Aap hamare menu mein se kuch bhi order kar sakte hain! Jaise Pizza, Burger ya koi special dish! 🍕🍔";
                    }
                } 
                    // 5. General Info (Location/Timing)
                    else if(lowerText.includes('time') || lowerText.includes('kab tak')) {
                        reply = "Hum roz subah 10:00 AM se raat 11:30 PM tak open rehte hain. 🕙";
                    }
                    else if(lowerText.includes('location') || lowerText.includes('kahan') || lowerText.includes('where')) {
                        reply = "Humara main kitchen FoodZone Tower, MG Road, Mumbai mein hai, par hum poore shehar mein delivery karte hain! 📍";
                    }
                    // 6. Identity
                    else if(lowerText.includes('who are you') || lowerText.includes('kaun ho')) {
                        reply = "Main FoodZone ka digital assistant hoon, jo aapke ordering experience ko magic jaisa fast banane ke liye design kiya gaya hai! 🤖✨";
                    }
                    // 7. Goodbye
                    else if(['bye', 'good night', 'chalo'].some(word => lowerText.includes(word))) {
                        reply = "Bye-bye! 👋 Jaldi hi milte hain agle order ke saath. Take care!";
                    }
                    else {
                        reply = "Main abhi seekh raha hoon, par main aapke sawal ka matlab samajh nahi paya. Kya aap order, location ya timing ke bare mein batana chahenge?";
                    }

                $('#chatBody').append(`<div class="chat-msg msg-bot animate__animated animate__fadeInLeft">${reply}</div>`);
                $('#chatBody').scrollTop($('#chatBody')[0].scrollHeight);
            }, 800);
        }

        // Dynamic Marquee Logic
        const names = ['Rahul', 'Sanya', 'Vikram', 'Anjali', 'Deepak', 'Meera', 'Arjun', 'Isha'];
        const items = ['Paneer Pizza', 'Giant Burger', 'Choco Lava Cake', 'Farmhouse Pizza', 'Cold Coffee', 'Garlic Bread'];
        
        setInterval(() => {
            const randomName = names[Math.floor(Math.random() * names.length)];
            const randomItem = items[Math.floor(Math.random() * items.length)];
            const newItem = `<span class="marquee-item"><i class="fa-solid fa-circle-check"></i> ${randomName} just ordered a ${randomItem}!</span>`;
            if($('#marqueeItems .marquee-item').length > 10) $('#marqueeItems .marquee-item').first().remove();
            $('#marqueeItems').append(newItem);
        }, 8000);

        // Scratch Card Logic
        window.showScratchCard = function() {
            $('.scratch-overlay, #scratch-container').fadeIn();
            const canvas = document.getElementById('scratch-canvas');
            if(!canvas) return;
            const ctx = canvas.getContext('2d');
            let isDrawing = false;

            // Fill with premium silver
            const gradient = ctx.createLinearGradient(0, 0, 250, 250);
            gradient.addColorStop(0, '#bdc3c7');
            gradient.addColorStop(0.5, '#ecf0f1');
            gradient.addColorStop(1, '#bdc3c7');
            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, 250, 250);
            
            ctx.fillStyle = '#7f8c8d';
            ctx.font = 'bold 18px Helvetica';
            ctx.textAlign = 'center';
            ctx.fillText('SCRATCH TO REVEAL', 125, 125);

            function getCoords(e) {
                const rect = canvas.getBoundingClientRect();
                const clientX = e.clientX || (e.touches ? e.touches[0].clientX : 0);
                const clientY = e.clientY || (e.touches ? e.touches[0].clientY : 0);
                return { x: clientX - rect.left, y: clientY - rect.top };
            }

            function scratch(e) {
                if (!isDrawing) return;
                const { x, y } = getCoords(e);
                ctx.globalCompositeOperation = 'destination-out';
                ctx.beginPath();
                ctx.arc(x, y, 30, 0, Math.PI * 2);
                ctx.fill();
            }

            canvas.addEventListener('mousedown', () => isDrawing = true);
            canvas.addEventListener('touchstart', (e) => { isDrawing = true; e.preventDefault(); }, {passive: false});
            window.addEventListener('mouseup', () => isDrawing = false);
            window.addEventListener('touchend', () => isDrawing = false);
            canvas.addEventListener('mousemove', scratch);
            canvas.addEventListener('touchmove', (e) => { scratch(e); e.preventDefault(); }, {passive: false});
        }

        window.closeScratchCard = function() {
            $('.scratch-overlay, #scratch-container').fadeOut();
        };
    });
</script>
</body>
</html>
