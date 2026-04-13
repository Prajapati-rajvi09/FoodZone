@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .order-header {
        background: white;
        padding: 60px 0;
        border-bottom: 1px solid #eee;
        margin-bottom: 40px;
    }
    .order-card {
        background: white;
        border-radius: 25px;
        padding: 0;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.07);
    }
    .order-id-badge {
        background: rgba(255, 71, 87, 0.1);
        color: var(--primary-color);
        padding: 8px 15px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.9rem;
    }
    .status-badge {
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-cod {
        background: rgba(47, 53, 66, 0.1);
        color: var(--secondary-color);
    }
    .status-online {
        background: rgba(110, 142, 251, 0.1);
        color: #6e8efb;
    }
    .order-info-label {
        color: #a4b0be;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }
    .order-info-value {
        color: var(--secondary-color);
        font-weight: 700;
        font-size: 1rem;
    }
    .btn-action {
        border-radius: 15px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
    .btn-view-product {
        background: #f1f2f6;
        color: var(--secondary-color);
    }
    .btn-view-product:hover {
        background: #dfe4ea;
    }
    .btn-view-bill {
        background: var(--primary-color);
        color: white;
        box-shadow: 0 4px 12px rgba(255, 71, 87, 0.2);
    }
    .btn-view-bill:hover {
        background: #ff3544;
        color: white;
        transform: scale(1.05);
    }
</style>

<div class="order-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <h1 class="fw-bold mb-0">Order History</h1>
                <p class="text-muted mb-0 mt-2">Manage and track your recent culinary journeys</p>
            </div>
            <div class="col-md-6 text-center text-md-end mt-4 mt-md-0">
                <div class="d-inline-flex bg-light p-2 rounded-4">
                    <span class="px-3 fw-bold text-muted small">Total Orders: {{ count($cust) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    @if(session('status'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 p-3 d-flex align-items-center">
            <i class="fa-solid fa-circle-check fs-4 me-3 text-success"></i>
            <span class="fw-bold">{{ session('status') }}</span>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            @forelse($cust as $item)
                <div class="order-card p-4">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-2 col-md-3">
                            <span class="order-info-label">Order Reference</span>
                            <div class="order-id-badge">BILL #{{ $item->billno }}</div>
                        </div>
                        
                        <div class="col-lg-2 col-md-3">
                            <span class="order-info-label">Order Date</span>
                            <div class="order-info-value"><i class="fa-regular fa-calendar me-2 opacity-50"></i>{{ \Carbon\Carbon::parse($item->orderdate)->format('d M, Y') }}</div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <span class="order-info-label">Delivery Address</span>
                            <div class="order-info-value text-truncate" title="{{ $item->address }}">
                                <i class="fa-solid fa-location-dot me-2 opacity-50 text-danger"></i>{{ $item->address }}, {{ $item->pincode }}
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-4">
                            <span class="order-info-label">Total Amount</span>
                            <div class="order-info-value text-success" style="font-size: 1.2rem;">₹{{ number_format($item->total, 2) }}</div>
                        </div>

                        <div class="col-lg-1 col-md-4 text-center">
                            <span class="order-info-label">Method</span>
                            <span class="status-badge {{ $item->shippingtype == 'COD' ? 'status-cod' : 'status-online' }}">
                                {{ $item->shippingtype }}
                            </span>
                        </div>

                        <div class="col-lg-2 col-md-4 text-center text-lg-end">
                            <div class="d-flex flex-column gap-2">
                                <a href="vieworderdetail/{{$item->billno}}" class="btn btn-action btn-view-product">
                                    <i class="fa-solid fa-utensils me-2"></i>Items
                                </a>
                                <a href="bill/{{$item->billno}}" class="btn btn-action btn-view-bill">
                                    <i class="fa-solid fa-file-invoice-dollar me-2"></i>Invoice
                                </a>
                            </div>
                        </div>

                        <!-- Advanced Order Tracking Stepper -->
                        <div class="col-12 mt-4 pt-3 border-top">
                            <div class="order-tracker d-flex justify-content-between position-relative">
                                <div class="step-line position-absolute w-100" style="height: 4px; background: #eee; top: 15px; z-index: 1;">
                                    <div class="progress-bar-fill h-100" style="width: 45%; background: var(--primary-color); transition: width 2s ease;"></div>
                                </div>
                                <div class="step active text-center" style="z-index: 2; position: relative;">
                                    <div class="step-dot rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px; border: 4px solid var(--card-bg); font-size: 0.8rem;">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <span class="small fw-bold opacity-75">Confirmed</span>
                                </div>
                                <div class="step active text-center" style="z-index: 2; position: relative;">
                                    <div class="step-dot rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px; border: 4px solid var(--card-bg); font-size: 0.8rem;">
                                        <i class="fa-solid fa-fire-burner animate__animated animate__pulse animate__infinite"></i>
                                    </div>
                                    <span class="small fw-bold">Preparing</span>
                                </div>
                                <div class="step text-center" style="z-index: 2; position: relative;">
                                    <div class="step-dot rounded-circle bg-light text-muted d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px; border: 4px solid var(--card-bg); font-size: 0.8rem;">
                                        <i class="fa-solid fa-bicycle"></i>
                                    </div>
                                    <span class="small fw-bold opacity-50">On the Way</span>
                                </div>
                                <div class="step text-center" style="z-index: 2; position: relative;">
                                    <div class="step-dot rounded-circle bg-light text-muted d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 35px; height: 35px; border: 4px solid var(--card-bg); font-size: 0.8rem;">
                                        <i class="fa-solid fa-house-chimney"></i>
                                    </div>
                                    <span class="small fw-bold opacity-50">Delivered</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 bg-white rounded-5 shadow-sm">
                    <div class="mb-4 opacity-10">
                        <i class="fa-solid fa-box-open display-1"></i>
                    </div>
                    <h3 class="fw-bold text-muted">No orders found yet</h3>
                    <p class="text-muted">Treat yourself to some delicious food today!</p>
                    <a href="{{ url('/viewproduct') }}" class="btn btn-premium px-5 mt-3">Start Ordering</a>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
