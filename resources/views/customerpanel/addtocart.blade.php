@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .cart-header {
        background: white;
        padding: 50px 0;
        border-bottom: 1px solid #eee;
        margin-bottom: 50px;
    }
    .cart-item-card {
        background: white;
        border-radius: 25px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        border: none;
        transition: all 0.3s ease;
    }
    .cart-item-card:hover {
        box-shadow: 0 15px 35px rgba(0,0,0,0.06);
    }
    .qty-control {
        display: flex;
        align-items: center;
        background: #f1f2f6;
        padding: 5px;
        border-radius: 15px;
        gap: 15px;
    }
    .qty-btn {
        width: 35px;
        height: 35px;
        border-radius: 12px;
        background: white;
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .qty-btn:hover {
        background: var(--primary-color);
        color: white;
    }
    .qty-val {
        font-weight: 800;
        font-size: 1.1rem;
        min-width: 30px;
        text-align: center;
    }
    .checkout-sidebar {
        position: sticky;
        top: 100px;
    }
    .form-control-pill {
        border-radius: 15px;
        padding: 12px 20px;
        background: #f8f9fa;
        border: 2px solid transparent;
        font-weight: 600;
    }
    .form-control-pill:focus {
        background: white;
        border-color: var(--primary-color);
        box-shadow: none;
    }
    .payment-option {
        border: 2px solid #eee;
        border-radius: 15px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 15px;
    }
    .payment-option:hover {
        border-color: #ddd;
    }
    .payment-option.active {
        border-color: var(--primary-color);
        background: rgba(255, 71, 87, 0.05);
    }
</style>

<div class="cart-header text-center">
    <div class="container">
        <h1 class="fw-bold mb-0">Shopping Bag</h1>
        <p class="text-muted">You have <span id="itemCountDisplay">{{ count($cust) }}</span> delicacies ready for checkout</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-5">
        <div class="col-lg-7">
            @forelse($cust as $item)
                @php
                    $product_entry = DB::table('product_entry_models')->where('id', $item->productid)->first();
                    $product_master = DB::table('product_models')->where('id', $product_entry->pnameid)->first();
                @endphp
                <div class="cart-item-card" id="cartItem-{{ $item->id }}">
                    <div class="row align-items-center">
                        <div class="col-md-2 col-4">
                            <div class="rounded-4 overflow-hidden" style="width: 80px; height: 80px;">
                                <img src="{{ asset('image_upload/'.$product_entry->image1) }}" class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>
                        <div class="col-md-4 col-8">
                            <h5 class="fw-bold mb-1">{{ $product_master->productname }}</h5>
                            <span class="badge bg-light text-muted border">{{ $product_entry->size }} variant</span>
                        </div>
                        <div class="col-md-3 col-6 my-3 my-md-0">
                            <div class="qty-control mx-auto mx-md-0" style="max-width: fit-content;">
                                <button class="qty-btn dec-btn" data-id="{{ $item->id }}" data-price="{{ $item->pprice }}">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <span class="qty-val" id="qty-{{ $item->id }}">{{ $item->qty }}</span>
                                <button class="qty-btn inc-btn" data-id="{{ $item->id }}" data-price="{{ $item->pprice }}">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2 col-4 text-center">
                            <div class="fw-bold text-dark">₹<span class="item-subtotal" id="subtotal-{{ $item->id }}">{{ $item->qty * $item->pprice }}</span></div>
                        </div>
                        <div class="col-md-1 col-2 text-end">
                            <a href="{{ url('deleteaddtocart/'.$item->id) }}" class="text-danger opacity-25">
                                <i class="fa-solid fa-trash-can fs-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 bg-white rounded-5 shadow-sm">
                    <div class="mb-4 opacity-10"><i class="fa-solid fa-bag-shopping display-1"></i></div>
                    <h3 class="fw-bold text-muted">Your bag is empty</h3>
                    <a href="{{ url('/viewproduct') }}" class="btn btn-premium px-5 mt-3">Browse Menu</a>
                </div>
            @endforelse
        </div>

        @if(count($cust) > 0)
        <div class="col-lg-5">
            <div class="card border-0 rounded-5 shadow-lg checkout-sidebar overflow-hidden">
                <div class="bg-dark p-4 text-white text-center">
                    <h5 class="fw-bold mb-0">Delivery Details</h5>
                </div>
                <div class="card-body p-4">
                    <form id="checkoutForm" action="{{ url('checkoutinsertdata') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase">Full Name</label>
                            <input type="text" name="custname" class="form-control form-control-pill" value="{{ Session::get('CustomerLogginId')['name'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase">Mobile No.</label>
                            <input type="number" name="mobileno" class="form-control form-control-pill" value="{{ Session::get('CustomerLogginId')['mobileno'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold text-muted text-uppercase">Address</label>
                            <textarea name="address" class="form-control form-control-pill" rows="2" required>{{ Session::get('CustomerLogginId')['address'] }}</textarea>
                        </div>
                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="small fw-bold text-muted text-uppercase">Pincode</label>
                                <select name="pincode" class="form-select form-control-pill" required>
                                    @foreach($data2 as $row)
                                        <option value="{{ $row->Pincode }}">{{ $row->Pincode }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="small fw-bold text-muted text-uppercase">Date</label>
                                <input type="text" name="orderdate" class="form-control form-control-pill bg-white" value="{{ now()->format('Y-m-d') }}" readonly>
                            </div>
                        </div>

                        <h6 class="fw-bold text-dark mb-3">Payment Method</h6>
                        <div class="payment-option active" data-type="COD">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-money-bill-transfer text-success fs-4 me-3"></i>
                                <div class="fw-bold">Cash On Delivery</div>
                                <i class="fa-solid fa-circle-check text-primary ms-auto fs-5"></i>
                            </div>
                        </div>
                        <div class="payment-option" data-type="Razorpay">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-credit-card text-primary fs-4 me-3"></i>
                                <div class="fw-bold">Online Payment (Razorpay)</div>
                            </div>
                        </div>

                        <div class="bg-light p-4 rounded-4 mb-4">
                            @php
                                $subtotal = 0; foreach($cust as $c) { $subtotal += ($c->qty * $c->pprice); }
                                $gst = ($subtotal * 5) / 100; $grand_total = $subtotal + $gst;
                            @endphp
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Total</span>
                                <h4 class="fw-bold mb-0 text-primary">₹<span id="finalTotalDisplay">{{ $grand_total }}</span></h4>
                            </div>
                        </div>

                        <input type="hidden" name="custemail" value="{{ Session::get('CustomerLogginId')['emailid'] }}">
                        <input type="hidden" name="total" id="totalHidden" value="{{ $grand_total }}">
                        <input type="hidden" name="shippingtype" id="shippingTypeInput" value="COD">
                        <input type="hidden" name="billno" value="0">

                        <button type="submit" class="btn btn-premium w-100 py-3 mb-2 rounded-4 fw-bold shadow">
                            Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$(document).ready(function() {
    $('.payment-option').click(function() {
        $('.payment-option').removeClass('active').find('.fa-circle-check').remove();
        $(this).addClass('active').append('<i class="fa-solid fa-circle-check text-primary ms-auto fs-5"></i>');
        $('#shippingTypeInput').val($(this).data('type'));
    });

    $('#checkoutForm').submit(function(e) {
        if ($('#shippingTypeInput').val() === 'Razorpay') {
            e.preventDefault();
            // Mock Razorpay Payment
            var options = {
                "key": "rzp_test_mock", // Mock Key
                "amount": parseFloat($('#totalHidden').val()) * 100,
                "currency": "INR",
                "name": "FoodZone",
                "description": "Premium Dining Payment",
                "handler": function (response){
                    alert("Payment Successful! Razorpay ID: " + response.razorpay_payment_id);
                    $('#shippingTypeInput').val('Razorpay (Success)');
                    $('#checkoutForm')[0].submit();
                }
            };
            var rzp = new Razorpay(options);
            rzp.open();
        }
    });

    // Existing AJAX Qty Logic
    $('.inc-btn, .dec-btn').click(function() {
        const id = $(this).data('id');
        const price = $(this).data('price');
        const isInc = $(this).hasClass('inc-btn');
        let qtySpan = $('#qty-' + id);
        let currentQty = parseInt(qtySpan.text());
        if (!isInc && currentQty <= 1) return;
        let newQty = isInc ? currentQty + 1 : currentQty - 1;
        qtySpan.text(newQty);
        $('#subtotal-' + id).text((newQty * price).toFixed(2));
        updateFinals();
        $.ajax({ url: "{{ url('updateqty') }}/" + id, method: 'POST', data: { _token: '{{ csrf_token() }}', qty: newQty } });
    });

    function updateFinals() {
        let subtotal = 0;
        $('.item-subtotal').each(function() { subtotal += parseFloat($(this).text()); });
        let total = subtotal + (subtotal * 0.05);
        $('#finalTotalDisplay').text(total.toFixed(2));
        $('#totalHidden').val(total.toFixed(2));
    }
});
</script>

@endsection
