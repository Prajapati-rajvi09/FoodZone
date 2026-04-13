<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FoodZone | Premium Dining</title>
    
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .dropdown-menu {
            display: block !important;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(15px);
            border-radius: 20px !important;
            padding: 15px !important;
            min-width: 200px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
            border: 1px solid rgba(0,0,0,0.05) !important;
        }

        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 25px;
            width: 15px;
            height: 15px;
            background: white;
            transform: rotate(45deg);
            border-left: 1px solid rgba(0,0,0,0.05);
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            border-radius: 12px;
            padding: 10px 15px !important;
            font-weight: 600;
            color: #2F3542;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 71, 87, 0.1);
            color: #ff4757;
            transform: translateX(5px);
        }

        .dropdown-item i {
            width: 20px;
            margin-right: 12px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header id="header" class="site-header fixed-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <span class="logo-text">FOODZONE</span>
                </a>
                
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                        <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Welcome to FoodZone</a></li>
                        
                        <li class="nav-item ms-lg-4">
                            @if(Session::has('CustomerLogginId'))
                                <div class="dropdown">
                                    <a class="btn btn-order d-inline-block px-4 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-user me-2"></i> Account
                                    </a>
                                    <ul class="dropdown-menu border-0 shadow-lg mt-3">
                                        <li><a class="dropdown-item py-2" href="{{ url('/profile') }}"><i class="fa-solid fa-circle-user"></i> Profile</a></li>
                                        <li><a class="dropdown-item py-2" href="{{ url('/myorder') }}"><i class="fa-solid fa-clock-rotate-left"></i> My Orders</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item py-2 text-danger" href="{{ url('/customerlogout') }}"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                                    </ul>
                                </div>
                            @else
                                <a href="{{ url('/login') }}" class="btn btn-order d-inline-block px-4">
                                    Login / Join
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('Abhiraj')
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.getElementById('header').classList.add('scrolled');
            } else {
                document.getElementById('header').classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
