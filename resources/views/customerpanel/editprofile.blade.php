@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .edit-profile-header {
        background: white;
        padding: 50px 0;
        border-bottom: 1px solid #eee;
        margin-bottom: 50px;
    }
    .form-card {
        background: white;
        border-radius: 35px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        padding: 40px;
        border: none;
    }
    .input-group-custom {
        margin-bottom: 25px;
    }
    .input-group-custom label {
        font-weight: 700;
        color: var(--secondary-color);
        margin-bottom: 10px;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .form-control-custom {
        border-radius: 15px;
        padding: 15px 20px;
        background: #f8f9fa;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        height: 55px;
    }
    .form-control-custom:focus {
        background: white;
        border-color: var(--primary-color);
        box-shadow: 0 10px 20px rgba(255, 71, 87, 0.05);
        outline: none;
    }
</style>

<div class="edit-profile-header text-center">
    <div class="container">
        <h1 class="fw-bold mb-2">Edit Your Profile</h1>
        <p class="text-muted">Keep your information up to date for better service</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            @if(session('status'))
                <div class="alert alert-danger border-0 rounded-4 mb-4 text-center py-3 shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="form-card animate__animated animate__fadeInUp">
                <form action="{{url('updateprofile')}}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <div class="input-group-custom text-center mb-5">
                        <div class="position-relative d-inline-block">
                            <img src="{{ asset('img/user.jpg') }}" class="rounded-circle shadow" width="100" height="100" style="object-fit: cover; border: 4px solid white;">
                            <span class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; border: 2px solid white; cursor: pointer;">
                                <i class="fa-solid fa-camera small"></i>
                            </span>
                        </div>
                    </div>

                    <div class="input-group-custom">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control form-control-custom" value="{{$edit->name}}" placeholder="Enter your full name">
                        @error('name')<small class="text-danger mt-1 d-block fw-bold">{{$message}}</small>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group-custom">
                                <label>Delivery Address</label>
                                <textarea name="address" class="form-control form-control-custom" style="height: auto;" rows="3" placeholder="Enter your full home/office address">{{$edit->address}}</textarea>
                                @error('address')<small class="text-danger mt-1 d-block fw-bold">{{$message}}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group-custom">
                                <label>City</label>
                                <input type="text" name="city" class="form-control form-control-custom" value="{{$edit->city}}" placeholder="e.g. Surat, Bardoli">
                                @error('city')<small class="text-danger mt-1 d-block fw-bold">{{$message}}</small>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-premium py-3 rounded-4 fw-bold shadow">
                            <i class="fa-solid fa-save me-2"></i> Save Profile Changes
                        </button>
                        <a href="{{ url('/profile') }}" class="btn btn-link text-muted mt-3 text-decoration-none">
                            <i class="fa-solid fa-arrow-left me-2"></i> Back to Profile
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
