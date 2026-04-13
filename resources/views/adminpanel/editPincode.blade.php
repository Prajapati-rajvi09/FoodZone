@extends('adminpanel.master')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Update Area</h1>
        <p class="text-muted">Edit the delivery pincode information.</p>
    </div>
    <div class="col-sm-6 text-right">
        <ol class="breadcrumb float-sm-right shadow-sm bg-white px-3 py-2" style="border-radius: 10px;">
            <li class="breadcrumb-item"><a href="adminindex" style="color: #FF6B6B;">Home</a></li>
            <li class="breadcrumb-item"><a href="/Pincode" style="color: #FF6B6B;">Areas</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if(session('status'))
        <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 15px;">
            <i class="fas fa-info-circle mr-2"></i> {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-4">
                <h3 class="card-title font-weight-bold" style="font-size: 1.25rem;">Edit Pincode #{{$edit_pincode->id}}</h3>
            </div>
            <form action="{{url('updatePincode/'.$edit_pincode->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body px-4 pb-5">
                    <div class="form-group mb-0">
                        <label class="font-weight-600 mb-2">Pincode / Zip Code</label>
                        <input type="text" name="Pincode" class="form-control form-control-lg text-center font-weight-bold" value="{{$edit_pincode->pincode}}" placeholder="Enter Pincode" style="border-radius: 12px; height: 60px; font-size: 1.5rem; letter-spacing: 2px;">
                        @error('Pincode')<small class="text-danger mt-1 d-block">{{$message}}</small>@enderror
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-4 px-4 text-right">
                    <a href="{{url('Pincode')}}" class="btn btn-link text-muted mr-3">Cancel</a>
                    <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold" style="border-radius: 12px;">Update Pincode</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .font-weight-600 { font-weight: 600; color: #444; }
</style>
@endsection
