@extends('adminpanel.master')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Order Details</h1>
        <p class="text-muted">Review items and manage fulfillment status.</p>
    </div>
    <div class="col-sm-6 text-right">
        <ol class="breadcrumb float-sm-right shadow-sm bg-white px-3 py-2" style="border-radius: 10px;">
            <li class="breadcrumb-item"><a href="adminindex" style="color: #FF6B6B;">Home</a></li>
            <li class="breadcrumb-item"><a href="customerorder" style="color: #FF6B6B;">Orders</a></li>
            <li class="breadcrumb-item active">Details</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold mb-0">Items in this Order</h3>
                <span class="badge badge-soft-danger px-3 py-2" style="border-radius: 10px; background: rgba(255,107,107,0.1); color: #FF6B6B;">
                    Bill No: #{{ $order[0]->billno ?? 'N/A' }}
                </span>
            </div>
            <div class="card-body px-0">
                <div class="table-responsive px-4">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">Product Info</th>
                                <th class="border-0">Qty</th>
                                <th class="border-0">Price</th>
                                <th class="border-0">Subtotal</th>
                                <th class="border-0 text-center">Status/Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach($order as $item)
                            @php
                                $item_subtotal = $item->qty * $item->pprice;
                                $subtotal += $item_subtotal;
                                
                                $product_entry = DB::table('product_entry_models')->where('id', $item->productid)->first();
                                $product_master = DB::table('product_models')->where('id', $product_entry->pnameid)->first();
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-600" style="color: #2d3436; font-size: 1rem;">
                                            {{ $product_master->productname }}
                                        </span>
                                        <small class="text-muted">Size: {{ $product_entry->size }}</small>
                                    </div>
                                </td>
                                <td><span class="badge bg-light px-3 py-2" style="border-radius: 8px;">{{$item->qty}}x</span></td>
                                <td>₹{{$item->pprice}}</td>
                                <td><span class="font-weight-bold">₹{{ $item_subtotal }}</span></td>
                                <td class="text-center">
                                    @if($item->pstatus == 'cancel')
                                        <span class="badge badge-danger px-3 py-2" style="border-radius: 8px;">Cancelled</span>
                                    @elseif($item->pstatus == 'order')
                                        <a href="orderuser/{{$item->id}}" class="btn btn-soft-success btn-sm px-4" style="border-radius: 8px; background: rgba(0,184,148,0.1); color: #00b894; border: none;" onclick="return confirm('Process this item to Preparation?')">
                                            Start Preparation
                                        </a>
                                    @elseif($item->pstatus == 'process')
                                        <a href="orderuser1/{{$item->id}}" class="btn btn-soft-warning btn-sm px-4" style="border-radius: 8px; background: rgba(255,159,67,0.1); color: #ff9f43; border: none;" onclick="return confirm('Item is ready for Dispatch?')">
                                            Ready to Dispatch
                                        </a>
                                    @elseif($item->pstatus == 'dispatch')
                                        <a href="orderuser2/{{$item->id}}" class="btn btn-soft-primary btn-sm px-4" style="border-radius: 8px; background: rgba(110,142,251,0.1); color: #6e8efb; border: none;" onclick="return confirm('Mark as Delivered?')">
                                            Hand over to Courier
                                        </a>
                                    @else
                                        <span class="badge badge-success px-3 py-2" style="border-radius: 8px;">Delivered ✓</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Summary Card -->
    <div class="col-md-5 ml-auto">
        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-4">
                <h4 class="card-title font-weight-bold">Payment Summary</h4>
            </div>
            <div class="card-body">
                @php
                    $gst = ($subtotal * 5) / 100;
                    $total = $subtotal + $gst;
                @endphp
                <div class="d-flex justify-content-between mb-3 text-muted">
                    <span>Items Total</span>
                    <span>₹{{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3 text-muted">
                    <span>GST (5%)</span>
                    <span>₹{{ number_format($gst, 2) }}</span>
                </div>
                <hr style="border-top: 2px dashed #eee;">
                <div class="d-flex justify-content-between align-items-center mb-0 mt-4">
                    <span class="h5 font-weight-bold mb-0" style="color: #2d3436;">Grand Total</span>
                    <span class="h4 font-weight-bold mb-0 text-danger">₹{{ number_format($total, 2) }}</span>
                </div>
            </div>
            <div class="card-footer bg-light border-0 py-4 text-center">
                <p class="small text-muted mb-0"><i class="fas fa-shield-alt mr-1"></i> Final amount inclusive of all taxes.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .font-weight-600 { font-weight: 600; }
    .btn-soft-success:hover { background: rgba(0,184,148,0.2) !important; text-decoration: none; }
    .btn-soft-warning:hover { background: rgba(255,159,67,0.2) !important; text-decoration: none; }
    .btn-soft-primary:hover { background: rgba(110,142,251,0.2) !important; text-decoration: none; }
</style>
@endsection
