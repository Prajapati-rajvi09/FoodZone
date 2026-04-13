@extends('master')
@section('Abhiraj')

<style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('{{ asset('premium_food_bg_1775802116333.png') }}') center/cover no-repeat;
        padding: 100px 20px 60px;
        position: relative;
    }

    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.7) 100%);
        z-index: 1;
    }

    .login-glass-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 40px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 480px;
        padding: 50px;
        z-index: 2;
        transform: translateY(0);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .login-glass-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.6);
    }

    .login-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 2.5rem;
        color: #1a1a1a;
        margin-bottom: 10px;
        letter-spacing: -1px;
    }

    .login-subtitle {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 40px;
    }

    .form-group-custom {
        margin-bottom: 25px;
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #ff4757;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .form-input-premium {
        width: 100%;
        padding: 16px 20px 16px 55px;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid transparent;
        border-radius: 20px;
        font-size: 1rem;
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

    .form-input-premium:focus + .input-icon {
        transform: translateY(-50%) scale(1.2);
    }

    .select-premium {
        appearance: none;
        cursor: pointer;
        padding-right: 45px !important;
    }

    .btn-login-premium {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, #ff4757 0%, #ff6b81 100%);
        border: none;
        border-radius: 20px;
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

    .btn-login-premium:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 30px rgba(255, 71, 87, 0.4);
        filter: brightness(1.1);
    }

    .btn-login-premium:active {
        transform: scale(0.98);
    }

    .register-link {
        margin-top: 30px;
        text-align: center;
        font-weight: 500;
        color: #555;
    }

    .register-link a {
        color: #ff4757;
        text-decoration: none;
        font-weight: 700;
        margin-left: 5px;
        transition: all 0.3s ease;
    }

    .register-link a:hover {
        text-decoration: underline;
        color: #ff6b81;
    }

    .alert-custom {
        border-radius: 18px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 25px;
        font-weight: 600;
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @media (max-width: 576px) {
        .login-glass-card {
            padding: 30px 20px;
        }
        .login-title {
            font-size: 2rem;
        }
    }
</style>

<div class="login-container">
    <div class="login-glass-card animate__animated animate__zoomIn">
        <div class="text-center">
            <h1 class="login-title">Welcome Home</h1>
            <p class="login-subtitle">Savor the flavor, login to continue</p>
        </div>

        @if(Session::get('success'))
            <div class="alert alert-success alert-custom shadow-sm">
                <i class="fa-solid fa-circle-check me-2"></i> {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::get('fail'))
            <div class="alert alert-danger alert-custom shadow-sm">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ Session::get('fail') }}
            </div>
        @endif

        <form action="{{ url('/admin_check') }}" method="POST">
            @csrf
            
            <div class="form-group-custom">
                <select required name="user" class="form-input-premium select-premium">
                    <option value="" disabled selected>Login As...</option>
                    <option value="admin">Administrator</option>
                    <option value="customer">Customer</option>
                </select>
                <i class="fa-solid fa-user-tag input-icon"></i>
                <i class="fa-solid fa-chevron-down position-absolute" style="right: 20px; top: 50%; transform: translateY(-50%); color: #ff4757; pointer-events: none;"></i>
            </div>

            <div class="form-group-custom">
                <input type="text" class="form-input-premium" placeholder="Username" name="username" required>
                <i class="fa-solid fa-envelope input-icon"></i>
            </div>

            <div class="form-group-custom">
                <input type="password" class="form-input-premium" placeholder="Password" name="password" required>
                <i class="fa-solid fa-shield-halved input-icon"></i>
            </div>
               
            <button type="submit" class="btn-login-premium">
                Sign In <i class="fa-solid fa-arrow-right-long ms-2"></i>
            </button>

            <div class="register-link">
                Don't have an account? <a href="{{ url('/register') }}">Create One</a>
            </div>
        </form>
    </div>
</div>

@endsection
