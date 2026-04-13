@extends('master')
@section('Abhiraj')

<style>
    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('{{ asset('premium_food_bg_1775802116333.png') }}') center/cover no-repeat;
        padding: 100px 20px 60px;
        position: relative;
    }

    .register-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.6) 100%);
        z-index: 1;
    }

    .register-glass-card {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border-radius: 40px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 800px;
        padding: 50px;
        z-index: 2;
        transition: all 0.5s ease;
    }

    .register-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 2.2rem;
        color: #1a1a1a;
        margin-bottom: 5px;
        letter-spacing: -1px;
    }

    .register-subtitle {
        color: #666;
        font-size: 1rem;
        margin-bottom: 40px;
    }

    .form-group-custom {
        margin-bottom: 20px;
        position: relative;
    }

    .form-label-premium {
        display: block;
        font-weight: 700;
        font-size: 0.85rem;
        color: #444;
        margin-bottom: 8px;
        margin-left: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .input-icon {
        position: absolute;
        left: 18px;
        top: calc(50% + 14px);
        transform: translateY(-50%);
        color: #ff4757;
        font-size: 1rem;
        z-index: 3;
    }

    .select-premium {
        appearance: none;
        cursor: pointer;
        padding-right: 45px !important;
    }

    .form-input-premium {
        width: 100%;
        padding: 14px 20px 14px 48px;
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid transparent;
        border-radius: 18px;
        font-size: 0.95rem;
        font-weight: 500;
        color: #333;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .form-input-premium:focus {
        outline: none;
        border-color: #ff4757;
        background: #fff;
        box-shadow: 0 8px 25px rgba(255, 71, 87, 0.15);
    }

    .btn-register-premium {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #ff4757 0%, #ff6b81 100%);
        border: none;
        border-radius: 18px;
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 10px 25px rgba(255, 71, 87, 0.3);
        transition: all 0.3s ease;
        margin-top: 20px;
        cursor: pointer;
    }

    .btn-register-premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(255, 71, 87, 0.4);
    }

    .login-link {
        margin-top: 25px;
        text-align: center;
        font-weight: 500;
        color: #555;
    }

    .login-link a {
        color: #ff4757;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .register-glass-card {
            padding: 30px 20px;
        }
    }
</style>

<div class="register-container">
    <div class="register-glass-card animate__animated animate__fadeInUp">
        <div class="text-center">
            <h1 class="register-title">Join FoodZone</h1>
            <p class="register-subtitle">Unlock a world of premium dining experiences</p>
        </div>

        @if(Session::get('success'))
            <div class="alert alert-success border-0 rounded-4 mb-4 shadow-sm">
                <i class="fa-solid fa-circle-check me-2"></i> {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::get('fail'))
            <div class="alert alert-danger border-0 rounded-4 mb-4 shadow-sm">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ Session::get('fail') }}
            </div>
        @endif

        <form method="POST" action="{{ url('insertregister') }}">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-premium">Full Name</label>
                        <i class="fa-solid fa-user input-icon"></i>
                        <input type="text" name="name" class="form-input-premium" placeholder="Your Name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-premium">Email Address</label>
                        <i class="fa-solid fa-envelope input-icon"></i>
                        <input type="email" name="emailid" class="form-input-premium" placeholder="email@example.com" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group-custom">
                        <label class="form-label-premium">Delivery Address</label>
                        <i class="fa-solid fa-location-dot input-icon"></i>
                        <input type="text" name="address" class="form-input-premium" placeholder="Street, Apartment, Area" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-premium">Gender</label>
                        <i class="fa-solid fa-venus-mars input-icon"></i>
                        <select name="gender" class="form-input-premium select-premium" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <i class="fa-solid fa-chevron-down position-absolute" style="right: 15px; top: calc(50% + 14px); transform: translateY(-50%); color: #ff4757; pointer-events: none;"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-premium">City</label>
                        <i class="fa-solid fa-city input-icon"></i>
                        <input type="text" name="city" class="form-input-premium" placeholder="Your City" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-premium">Mobile Number</label>
                        <i class="fa-solid fa-phone input-icon"></i>
                        <input type="text" name="mobileno" class="form-input-premium" placeholder="+91" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group-custom">
                        <label class="form-label-premium">Date of Birth</label>
                        <i class="fa-solid fa-calendar-days input-icon"></i>
                        <input type="date" name="dob" class="form-input-premium" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group-custom">
                        <label class="form-label-premium">Password</label>
                        <i class="fa-solid fa-lock input-icon"></i>
                        <input type="password" name="password" class="form-input-premium" placeholder="Minimum 8 characters" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-register-premium">
                Create Account <i class="fa-solid fa-user-plus ms-2"></i>
            </button>

            <div class="login-link">
                Already part of the family? <a href="{{ url('/login') }}">Login here</a>
            </div>
        </form>
    </div>
</div>

@endsection
