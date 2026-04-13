@extends('adminpanel.master')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Add New Product</h1>
        <p class="text-muted">Create a new entry in your digital menu.</p>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right shadow-sm bg-white px-3 py-2" style="border-radius: 10px;">
            <li class="breadcrumb-item"><a href="adminindex" style="color: #FF6B6B;">Home</a></li>
            <li class="breadcrumb-item"><a href="productentryview" style="color: #FF6B6B;">Products</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 15px;">
            <i class="fas fa-check-circle mr-2"></i> {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-4">
                <h3 class="card-title font-weight-bold" style="font-size: 1.25rem;">Product Details</h3>
            </div>
            <form action="{{url('insertproductentry')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body px-4">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-600 mb-2">Food Category</label>
                            <select class="form-control form-control-lg custom-select" name="pnameid" required style="height: 55px; border-radius: 12px; font-size: 1rem;">
                                <option value="" disabled selected>Select a category</option>
                                @foreach($data as $row)
                                <option value="{{$row->id}}">{{$row->productname}}</option>
                                @endforeach
                            </select>
                            @error('pnameid')<small class="text-danger mt-1 d-block">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-600 mb-2">Size / Variant</label>
                            <input type="text" name="size" class="form-control form-control-lg" value="{{old('size')}}" placeholder="e.g. Regular, Large, 500ml" required style="height: 55px; border-radius: 12px; font-size: 1rem;">
                            @error('size')<small class="text-danger mt-1 d-block">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="font-weight-600 mb-2">Price (₹)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-right-0" style="background: white; border-radius: 12px 0 0 12px;">₹</span>
                                </div>
                                <input type="number" name="price" class="form-control form-control-lg border-left-0" value="{{old('price')}}" placeholder="0.00" required style="height: 55px; border-radius: 0 12px 12px 0; font-size: 1rem;">
                            </div>
                            @error('price')<small class="text-danger mt-1 d-block">{{$message}}</small>@enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="font-weight-600 mb-2">Product Image</label>
                            <div class="custom-file-upload p-4 text-center border-dashed" style="border: 2px dashed #ddd; border-radius: 15px; background: #fafafa;">
                                <i class="fas fa-image fa-3x text-muted mb-3 d-block"></i>
                                <input type="file" name="image1" class="form-control-file d-none" id="image1" required onchange="updateFileName(this)">
                                <label for="image1" class="btn btn-outline-danger btn-sm px-4" style="border-radius: 10px;">Browse Image</label>
                                <p id="file-name" class="text-muted mt-2 small">No file selected</p>
                            </div>
                            @error('image1')<small class="text-danger mt-1 d-block">{{$message}}</small>@enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-4 px-4 text-right">
                    <button type="reset" class="btn btn-link text-muted mr-3">Reset Form</button>
                    <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold" style="border-radius: 12px;">Create Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateFileName(input) {
        var fileName = input.files[0].name;
        document.getElementById('file-name').textContent = fileName;
    }
</script>

<style>
    .font-weight-600 { font-weight: 600; color: #444; }
    .custom-select { appearance: none; }
</style>
@endsection
