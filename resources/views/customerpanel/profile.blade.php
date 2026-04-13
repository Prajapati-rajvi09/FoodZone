@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .profile-hero {
        background: linear-gradient(135deg, var(--primary-color), #ff6b81);
        padding: 100px 0 160px;
        border-radius: 0 0 80px 80px;
        position: relative;
        overflow: hidden;
    }
    .profile-hero::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.1;
    }
    .profile-card {
        background: var(--card-bg);
        border-radius: 50px;
        box-shadow: 0 30px 70px rgba(0,0,0,0.15);
        margin-top: -120px;
        position: relative;
        z-index: 2;
        border: 1px solid var(--border-color);
    }
    .hub-stat-card {
        background: var(--bg-light);
        padding: 25px;
        border-radius: 30px;
        border: 1px solid var(--border-color);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .hub-stat-card:hover {
        transform: translateY(-10px);
        background: white;
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    }
    .profile-avatar-box {
        position: relative;
        display: inline-block;
        margin-top: -90px;
    }
    .profile-avatar {
        width: 160px;
        height: 160px;
        border-radius: 50px;
        border: 8px solid var(--card-bg);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
    .loyalty-badge {
        position: absolute;
        bottom: 10px;
        right: -10px;
        background: #ffd32a;
        color: #000;
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 0.75rem;
        box-shadow: 0 5px 15px rgba(255, 211, 42, 0.4);
    }
    .progress-hub {
        height: 12px;
        border-radius: 10px;
        background: #f1f2f6;
        margin: 20px 0;
    }
    .progress-hub-bar {
        background: linear-gradient(to right, var(--primary-color), #ff6b81);
        border-radius: 10px;
    }
</style>

<div class="profile-hero text-center text-white">
    <div class="container">
        <h1 class="display-5 fw-bold mb-2">My Foodie Hub</h1>
        <p class="opacity-75 fs-5">Tracking your culinary journey at FoodZone</p>
    </div>
</div>

<div class="container pb-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="profile-card p-4 p-lg-5">
                <div class="text-center mb-5">
                    <div class="profile-avatar-box mb-4">
                        <img src="{{ asset('img/user.jpg') }}" class="profile-avatar">
                        <div class="loyalty-badge animate__animated animate__pulse animate__infinite"><i class="fa-solid fa-crown me-1"></i> SILVER MEMBER</div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ Session::get('CustomerLogginId')['name'] }}</h2>
                    <p class="text-muted">Member since {{ date('M Y') }}</p>
                    
                    <!-- Loyalty Progress -->
                    <div class="mx-auto mt-4" style="max-width: 400px;">
                        <div class="d-flex justify-content-between small fw-bold mb-1">
                            <span>Silver Tier</span>
                            <span class="text-primary">75% to Gold</span>
                        </div>
                        <div class="progress progress-hub">
                            <div class="progress-bar progress-hub-bar" style="width: 75%"></div>
                        </div>
                    </div>
                </div>

                @php
                    $id = Session::get('CustomerLogginId')['id'];
                    $orderCount = \App\Models\CheckoutModel::where('custid', $id)->count();
                @endphp

                <!-- Dashbaord Stats -->
                <div class="row g-4 mb-5">
                    <div class="col-md-3">
                        <div class="hub-stat-card text-center">
                            <i class="fa-solid fa-bag-shopping text-primary fs-3 mb-3"></i>
                            <h3 class="fw-bold mb-0">{{ $orderCount }}</h3>
                            <p class="text-muted small mb-0">Total Orders</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="hub-stat-card text-center">
                            <i class="fa-solid fa-coins text-warning fs-3 mb-3"></i>
                            <h3 class="fw-bold mb-0">{{ $orderCount * 25 }}</h3>
                            <p class="text-muted small mb-0">Reward Points</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="hub-stat-card text-center">
                            <i class="fa-solid fa-ticket text-danger fs-3 mb-3"></i>
                            <h3 class="fw-bold mb-0">3</h3>
                            <p class="text-muted small mb-0">Active Coupons</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="hub-stat-card text-center">
                            <i class="fa-solid fa-heart text-accent fs-3 mb-3"></i>
                            <h3 class="fw-bold mb-0">Pizza</h3>
                            <p class="text-muted small mb-0">Top Craving</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="fw-bold mb-4 px-2"><i class="fa-solid fa-user-gear me-2 text-primary"></i> Personal Information</h5>
                    <div class="row g-4">
                        @foreach($view as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 border bg-white h-100">
                                <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Official Email</label>
                                <div class="fw-bold fs-5 text-dark">{{ $item->emailid }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 border bg-white h-100">
                                <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Phone Contact</label>
                                <div class="fw-bold fs-5 text-dark">{{ $item->mobileno }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 border bg-white h-100">
                                <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Current City</label>
                                <div class="fw-bold fs-5 text-dark">{{ $item->city }}</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="p-4 rounded-4 border bg-white">
                                <label class="text-muted small fw-bold text-uppercase mb-2 d-block">Primary Delivery Address</label>
                                <div class="fw-bold fs-5 text-dark"><i class="fa-solid fa-location-dot me-2 text-primary"></i> {{ $item->address }}</div>
                            </div>
                        </div>
                        
                        <div class="col-12 mt-5">
                            <div class="p-4 rounded-5 bg-light d-md-flex align-items-center justify-content-between border">
                                <div>
                                    <h4 class="fw-bold mb-1">Make a change?</h4>
                                    <p class="text-muted mb-md-0">Update your profile details or security settings</p>
                                </div>
                                <div class="d-flex gap-3">
                                    <a href="{{ url('editprofile') }}" class="btn btn-primary px-4 py-3 rounded-4 fw-bold shadow-sm">
                                        Update Profile
                                    </a>
                                    <a href="{{ url('/changepassword') }}" class="btn btn-white border px-4 py-3 rounded-4 fw-bold shadow-sm bg-white">
                                        Security
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
