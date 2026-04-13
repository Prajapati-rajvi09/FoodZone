@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .feedback-header {
        background: linear-gradient(135deg, #1e272e, #2f3640);
        padding: 100px 0 60px;
        color: white;
        text-align: center;
        margin-bottom: 50px;
    }
    .feedback-card {
        background: white;
        border-radius: 25px;
        padding: 50px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.06);
        border: none;
        margin-top: -80px;
        position: relative;
        z-index: 10;
    }
    .form-control-premium {
        background: #f8f9fa;
        border: 2px solid transparent;
        border-radius: 12px;
        padding: 15px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .form-control-premium:focus {
        background: white;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(255, 71, 87, 0.1);
    }
    .testimonial-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        border: none;
        height: 100%;
        transition: all 0.3s ease;
    }
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    }
    .avatar-circle {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #ff4757, #ff6b81);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }
</style>

<div class="feedback-header">
    <div class="container">
        <h1 class="display-4 fw-bold">We Value Your Feedback</h1>
        <p class="opacity-75 pb-5">Help us improve your FoodZone experience. We read every single review.</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="feedback-card">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Share Your Experience</h3>
                    <p class="text-muted">Fill out the form below to let us know how we did.</p>
                </div>
                
                @if(session('status'))
                <div class="alert alert-success border-0 rounded-4 mb-4 d-flex align-items-center p-3 shadow-sm">
                    <i class="fa-solid fa-circle-check text-success fs-4 me-3"></i> 
                    <span class="fw-bold">{{session('status')}}</span>
                </div>
                @endif

                <form action="{{url('feedbackinsert')}}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Full Name</label>
                            <input type="text" class="form-control form-control-premium" name="custname" value="{{ Session::has('CustomerLogginId') ? Session::get('CustomerLogginId')['name'] : old('custname') }}" required placeholder="John Doe">
                            @error('custname')<small class="text-danger mt-1">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Mobile Number</label>
                            <input type="number" class="form-control form-control-premium" name="mobileno" value="{{ Session::has('CustomerLogginId') ? Session::get('CustomerLogginId')['mobileno'] : old('mobileno') }}" required placeholder="1234567890">
                            @error('mobileno')<small class="text-danger mt-1">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-12">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Email Address</label>
                            <input type="email" class="form-control form-control-premium" name="custemail" value="{{ Session::has('CustomerLogginId') ? Session::get('CustomerLogginId')['emailid'] : old('custemail') }}" required placeholder="john@example.com">
                            @error('custemail')<small class="text-danger mt-1">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-12">
                            <label class="small fw-bold text-muted text-uppercase mb-2">Your Message</label>
                            <textarea name="description" class="form-control form-control-premium" rows="4" required placeholder="Tell us what you loved or what we can improve..."></textarea>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-premium px-5 py-3 rounded-pill fw-bold shadow">Submit Feedback <i class="fa-regular fa-paper-plane ms-2"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(count($feedback) > 0)
    <div class="mt-5 pt-5 border-top">
        <h3 class="fw-bold text-center mb-5">What Our Customers Say</h3>
        <div class="row g-4">
            @foreach($feedback->sortByDesc('id')->take(6) as $item)
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-circle me-3 shadow-sm">
                            {{ strtoupper(substr($item->custname, 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">{{ $item->custname }}</h6>
                            <small class="text-muted"><i class="fa-solid fa-star text-warning"></i> Verified Customer</small>
                        </div>
                    </div>
                    <p class="text-muted small mb-0" style="line-height: 1.6; font-style: italic;">"{{ $item->description }}"</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection
