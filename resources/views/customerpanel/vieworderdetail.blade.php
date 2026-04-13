@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .order-detail-header {
        background: white;
        padding: 40px 0;
        margin-bottom: 40px;
        border-bottom: 1px solid #eee;
    }
    .status-timeline {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        position: relative;
    }
    .status-timeline::before {
        content: '';
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
        height: 4px;
        background: #f1f2f6;
        z-index: 1;
    }
    .status-step {
        position: relative;
        z-index: 2;
        background: white;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        border: 4px solid #f1f2f6;
        transition: all 0.3s ease;
    }
    .status-step.active {
        border-color: var(--primary-color);
        background: var(--primary-color);
        box-shadow: 0 0 0 5px rgba(255, 71, 87, 0.2);
    }
    .status-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 10px;
        color: #a4b0be;
    }
    .status-step.active + .status-label {
        color: var(--primary-color);
    }
    .product-list-card {
        background: white;
        border-radius: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        overflow: hidden;
        border: none;
    }
</style>

<div class="order-detail-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/customerindex') }}" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/myorder') }}" class="text-decoration-none text-muted">My Orders</a></li>
                <li class="breadcrumb-item active fw-bold text-primary">Order Details</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-0">Order Summary</h2>
    </div>
</div>

<div class="container pb-5">
    @if(session('status'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="product-list-card mb-4">
                <div class="card-header bg-white py-4 px-4 border-0">
                    <h5 class="fw-bold mb-0">Purchased Items</h5>
                </div>
                <div class="table-responsive px-4 pb-4">
                    <table class="table align-middle">
                        <thead class="text-muted small text-uppercase">
                            <tr>
                                <th class="border-0">Product</th>
                                <th class="border-0 text-center">QTY</th>
                                <th class="border-0 text-end">Price</th>
                                <th class="border-0 text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach($vieworderdetail1 as $item)
                            @php
                                $productid = DB::table('product_entry_models')->where('id', $item->productid)->first();
                                $productMaster = DB::table('product_models')->where('id', $productid->pnameid)->first();
                                $item_total = $item->qty * $item->pprice;
                                $subtotal += $item_total;
                            @endphp
                            <tr>
                                <td class="py-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-4 overflow-hidden me-3" style="width: 60px; height: 60px; background: #f8f9fa;">
                                            <img src="{{ asset('image_upload/'.$productid->image1) }}" class="w-100 h-100 object-fit-cover">
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $productMaster->productname }}</div>
                                            <small class="text-muted">{{ $productid->size }} variant</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center fw-bold">{{ $item->qty }}</td>
                                <td class="text-end text-muted">₹{{ number_format($item->pprice, 2) }}</td>
                                <td class="text-end fw-bold text-dark">₹{{ number_format($item_total, 2) }}</td>
                            </tr>
                            
                            <!-- Delivery Tracking Row -->
                            <tr>
                                <td colspan="4" class="border-0 pt-0 pb-4">
                                    <div class="bg-light rounded-4 p-4 mx-2">
                                        <div class="d-flex justify-content-between mb-3 align-items-center">
                                            <span class="small fw-bold text-muted text-uppercase letter-spacing-1">Delivery Status</span>
                                            <span class="badge rounded-pill px-3 py-2 bg-white text-primary border shadow-sm small">
                                                @if($item->pstatus == 'order') Placed 
                                                @elseif($item->pstatus == 'process') Preparing 
                                                @elseif($item->pstatus == 'dispatch') Out for Delivery 
                                                @elseif($item->pstatus == 'deliver') Enjoy your food! 
                                                @else Cancelled @endif
                                            </span>
                                        </div>
                                        @if($item->pstatus == 'dispatch')
                            <div class="alert alert-warning border-0 shadow-sm rounded-4 p-4 mb-5 animate__animated animate__pulse animate__infinite" style="background: rgba(255, 165, 2, 0.1); border-left: 5px solid var(--accent-color) !important;">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; min-width: 50px;">
                                        <i class="fa-solid fa-bell-concierge fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1 text-dark">Your Feast is Ready!</h5>
                                        <p class="mb-0 text-muted">Exquisite flavors are waiting. You can now take delivery or wait for our courier to reach you.</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <section class="timeline-container px-4">
                                        <div class="status-timeline px-4">
                                            <div class="text-center">
                                                <div class="status-step {{ in_array($item->pstatus, ['order','process','dispatch','deliver']) ? 'active' : '' }}"></div>
                                                <div class="status-label">Placed</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="status-step {{ in_array($item->pstatus, ['process','dispatch','deliver']) ? 'active' : '' }}"></div>
                                                <div class="status-label">Preparing</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="status-step {{ in_array($item->pstatus, ['dispatch','deliver']) ? 'active' : '' }}"></div>
                                                <div class="status-label">On Way</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="status-step {{ $item->pstatus == 'deliver' ? 'active' : '' }}"></div>
                                                <div class="status-label">Delivered</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 rounded-5 shadow-sm overflow-hidden">
                <div class="card-body p-5">
                    <h5 class="fw-bold mb-4">Payment Summary</h5>
                    @php
                        $gst = ($subtotal * 5) / 100;
                        $grand_total = $subtotal + $gst;
                    @endphp
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Total Balance</span>
                        <span class="fw-bold">₹{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 pb-4 border-bottom">
                        <span class="text-muted">GST (5%)</span>
                        <span class="fw-bold">₹{{ number_format($gst, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <span class="h5 fw-bold mb-0">Grand Total</span>
                        <span class="h4 fw-bold mb-0 text-primary">₹{{ number_format($grand_total, 2) }}</span>
                    </div>
                    <a href="{{ url('/viewproduct') }}" class="btn btn-premium w-100 py-3 rounded-4 fw-bold">Order More Food</a>
                    <a href="{{ url('/myorder') }}" class="btn btn-link text-muted w-100 mt-3 text-decoration-none small"><i class="fa-solid fa-arrow-left me-2"></i>Back to My Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
