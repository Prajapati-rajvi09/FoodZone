@extends('adminpanel.master')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Update Product</h1>
        <p class="text-muted">Modify existing product information.</p>
    </div>
    <div class="col-sm-6 text-right">
        <ol class="breadcrumb float-sm-right shadow-sm bg-white px-3 py-2" style="border-radius: 10px;">
            <li class="breadcrumb-item"><a href="adminindex" style="color: #FF6B6B;">Home</a></li>
            <li class="breadcrumb-item"><a href="/productentryview" style="color: #FF6B6B;">Products</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
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
                <h3 class="card-title font-weight-bold" style="font-size: 1.25rem;">Edit Item #{{$edit->id}}</h3>
            </div>
            <form action="{{url('updateproductentryview/'.$edit->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body px-4">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label class="font-weight-600 mb-2">Product: <span class="text-danger">{{ $edit->product_entry->productname ?? 'N/A' }}</span></label>
                            <p class="text-muted small">Category selection is currently locked. Contact admin to change category.</p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-600 mb-2">Size / Variant</label>
                            <input type="text" name="size" class="form-control form-control-lg" value="{{$edit->size}}" placeholder="Enter size" style="border-radius: 12px; height: 55px;">
                            @error('size')<small class="text-danger mt-1 d-block">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-600 mb-2">Price (₹)</label>
                            <input type="number" name="price" class="form-control form-control-lg" value="{{$edit->price}}" placeholder="Enter price" style="border-radius: 12px; height: 55px;">
                            @error('price')<small class="text-danger mt-1 d-block">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-12 mb-3 mt-3 text-center">
                            <label class="font-weight-600 mb-3 d-block">Current Image</label>
                            @if($edit->image1)
                                <img src="{{ asset('image_upload/'.$edit->image1) }}" class="img-thumbnail shadow-sm mb-3" style="max-height: 200px; border-radius: 15px;">
                            @else
                                <p class="text-muted">No primary image set.</p>
                            @endif
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="font-weight-600 mb-2">Replace Primary Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" class="custom-file-input" id="image">
                                <label class="custom-file-label" for="image" style="border-radius: 12px; height: 45px; display: flex; align-items: center;">Choose new file...</label>
                            </div>
                            @error('image')<small class="text-danger mt-1 d-block">{{$message}}</small>@enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-4 px-4 text-right">
                    <a href="{{url('productentryview')}}" class="btn btn-link text-muted mr-3">Cancel</a>
                    <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold" style="border-radius: 12px;">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .font-weight-600 { font-weight: 600; color: #444; }
    .custom-file-label::after {
        height: 43px;
        display: flex;
        align-items: center;
        background: #f8f9fa;
        border-radius: 0 12px 12px 0;
    }
</style>
@endsection
