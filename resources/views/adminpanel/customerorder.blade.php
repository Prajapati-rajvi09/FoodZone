@extends('adminpanel.master')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Order Management</h1>
        <p class="text-muted">Monitor and track customer orders in real-time.</p>
    </div>
    <div class="col-sm-6 text-right">
        <div class="shadow-sm d-inline-block px-3 py-2 bg-white" style="border-radius: 12px;">
            <span class="text-muted small">Showing all active orders</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-white py-4">
                <h3 class="card-title font-weight-bold">Order History</h3>
            </div>
            <div class="card-body px-0">
                <div class="table-responsive px-4">
                    <table id="example1" class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">Bill No</th>
                                <th class="border-0">Customer</th>
                                <th class="border-0">Amount</th>
                                <th class="border-0">Order Date</th>
                                <th class="border-0">Shipping</th>
                                <th class="border-0 text-center">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $item)
                            <tr>
                                <td>
                                    <span class="font-weight-bold text-danger">#{{$item->billno}}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-600" style="color: #2d3436;">{{$item->custname}}</span>
                                        <small class="text-muted"><i class="fas fa-phone-alt mr-1 small"></i> {{$item->mobileno}}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-weight-bold text-success" style="font-size: 1.1rem;">₹{{$item->total}}</span>
                                </td>
                                <td>
                                    <div class="text-muted small">
                                        <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($item->orderdate)->format('d M, Y') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-soft-dark px-3 py-2" style="background: rgba(0,0,0,0.05); color: #444; border-radius: 8px; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px;">
                                        {{$item->shippingtype}}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="customerorderdetail/{{$item->id}}" class="btn btn-primary btn-sm px-4 shadow-sm" style="border-radius: 8px;">
                                        <i class="fas fa-eye mr-1"></i> View Items
                                    </a>
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
    .table-hover tbody tr:hover { background-color: rgba(255, 107, 107, 0.01); }
</style>
@endsection
