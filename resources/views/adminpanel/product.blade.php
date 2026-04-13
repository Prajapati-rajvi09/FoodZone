@extends('adminpanel.master')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Product Categories</h1>
        <p class="text-muted">Define the main food categories for your menu.</p>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right shadow-sm bg-white px-3 py-2" style="border-radius: 10px;">
            <li class="breadcrumb-item"><a href="adminindex" style="color: #FF6B6B;">Home</a></li>
            <li class="breadcrumb-item active">Categories</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <!-- Add Category Section -->
    <div class="col-md-4">
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-4">
                <h3 class="card-title font-weight-bold">New Category</h3>
            </div>
            <form action="{{url('insertproduct')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-600 mb-2">Category Name</label>
                        <input type="text" name="productname" class="form-control form-control-lg" value="{{old('productname')}}" placeholder="e.g. Pizza, Burger, Desserts" required style="border-radius: 12px; height: 50px;">
                        @error('productname')<small class="text-danger mt-1 d-block">{{$message}}</small>@enderror
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-3 text-right">
                    <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold" style="border-radius: 10px;">
                        <i class="fas fa-plus mr-2"></i> Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Categories Section -->
    <div class="col-md-8">
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 15px;">
            <i class="fas fa-check-circle mr-2"></i> {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-white py-4 d-flex align-items-center">
                <h3 class="card-title font-weight-bold mb-0">Existing Categories</h3>
            </div>
            <div class="card-body px-0">
                <div class="table-responsive px-4">
                    <table class="table table-hover dataTable align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">#</th>
                                <th class="border-0">Category Name</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $item)
                            <tr>
                                <td class="text-muted small">#{{$item->id}}</td>
                                <td>
                                    <span class="font-weight-600 text-dark">{{$item->productname}}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                                        <a href="{{url('editproduct/'.$item->id)}}" class="btn btn-white btn-sm px-3 border-right" title="Edit">
                                            <i class="fas fa-edit text-primary"></i>
                                        </a>
                                        <a href="{{url('deleteproduct/'.$item->id)}}" class="btn btn-white btn-sm px-3" title="Delete" onclick="return confirm('Delete this category and its associated products?')">
                                            <i class="fas fa-trash text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .font-weight-600 { font-weight: 600; }
    .btn-white { background: #fff; color: #555; }
    .btn-white:hover { background: #f8f9fa; }
</style>
@endsection
