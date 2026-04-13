@extends('adminpanel.master')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Product Catalog</h1>
        <p class="text-muted">Manage your menu items and their pricing.</p>
    </div>
    <div class="col-sm-6 text-right">
        <a href="/productentry" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i> Add New Product
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 15px;">
            <i class="fas fa-check-circle mr-2"></i> {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-white py-4">
                <h3 class="card-title font-weight-bold">All Products</h3>
            </div>
            <div class="card-body px-0">
                <div class="table-responsive px-4">
                    <table id="example1" class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">ID</th>
                                <th class="border-0">Image</th>
                                <th class="border-0">Product Name</th>
                                <th class="border-0">Size/Type</th>
                                <th class="border-0">Price</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productentryview as $item)
                            <tr>
                                <td class="font-weight-bold text-muted">#{{$item->id}}</td>
                                <td>
                                    <div class="product-img-container shadow-sm" style="width: 60px; height: 60px; border-radius: 12px; overflow: hidden; background: #f8f9fa;">
                                        <img src="image_upload/{{$item->image1}}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </td>
                                <td>
                                    <span class="font-weight-600" style="color: #2d3436; font-size: 1rem;">{{$item->product_entry->productname}}</span>
                                </td>
                                <td>
                                    <span class="badge badge-soft-primary px-3 py-2" style="background: rgba(110, 142, 251, 0.1); color: #6e8efb; border-radius: 8px;">
                                        {{$item->size}}
                                    </span>
                                </td>
                                <td>
                                    <span class="font-weight-bold text-success">₹{{$item->price}}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                                        <a href="{{url('editproductentryview/'.$item->id)}}" class="btn btn-white btn-sm px-3 border-right" title="Edit">
                                            <i class="fas fa-edit text-primary"></i>
                                        </a>
                                        <a href="{{url('deleteproductentryview/'.$item->id)}}" class="btn btn-white btn-sm px-3" title="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
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
    .table-hover tbody tr:hover { background-color: rgba(255, 107, 107, 0.02); }
</style>
@endsection
