@extends('adminpanel.master')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Update Category</h1>
        <p class="text-muted">Edit existence food category details.</p>
    </div>
    <div class="col-sm-6 text-right">
        <ol class="breadcrumb float-sm-right shadow-sm bg-white px-3 py-2" style="border-radius: 10px;">
            <li class="breadcrumb-item"><a href="adminindex" style="color: #FF6B6B;">Home</a></li>
            <li class="breadcrumb-item"><a href="/product" style="color: #FF6B6B;">Categories</a></li>
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
                <h3 class="card-title font-weight-bold" style="font-size: 1.25rem;">Edit Category #{{$edit->id}}</h3>
            </div>
            <form action="{{url('updateproduct/'.$edit->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body px-4 pb-5">
                    <div class="form-group mb-0">
                        <label class="font-weight-600 mb-2">Category Name</label>
                        <input type="text" name="productname" class="form-control form-control-lg font-weight-600" value="{{$edit->productname}}" placeholder="Enter Product Name" style="border-radius: 12px; height: 55px; font-size: 1.1rem;">
                        @error('productname')<small class="text-danger mt-1 d-block">{{$message}}</small>@enderror
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-4 px-4 text-right">
                    <a href="{{url('product')}}" class="btn btn-link text-muted mr-3">Cancel</a>
                    <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold" style="border-radius: 12px;">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .font-weight-600 { font-weight: 600; color: #444; }
</style>
@endsection
