@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .invoice-container {
        max-width: 900px;
        margin: 50px auto;
        background: white;
        padding: 60px;
        border-radius: 40px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }
    .invoice-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 10px;
        background: linear-gradient(to right, var(--primary-color), var(--accent-color));
    }
    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 60px;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 30px;
    }
    .invoice-logo {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }
    .invoice-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #dfe4ea;
        text-transform: uppercase;
        letter-spacing: 5px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 60px;
    }
    .info-box-label {
        color: #a4b0be;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }
    .info-box-value {
        color: var(--secondary-color);
        font-weight: 700;
        font-size: 1.1rem;
        line-height: 1.5;
    }
    .invoice-table {
        width: 100%;
        margin-bottom: 40px;
    }
    .invoice-table th {
        background: #f8f9fa;
        padding: 15px 20px;
        color: var(--secondary-color);
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
        border: none;
    }
    .invoice-table td {
        padding: 20px;
        border-bottom: 1px solid #f1f2f6;
        vertical-align: middle;
    }
    .total-section {
        margin-left: auto;
        width: 350px;
        background: #f8f9fa;
        border-radius: 20px;
        padding: 30px;
    }
    .total-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    .total-row:last-child {
        margin-bottom: 0;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 2px dashed #dfe4ea;
    }
    .total-label {
        color: #747d8c;
        font-weight: 600;
    }
    .total-value {
        color: var(--secondary-color);
        font-weight: 700;
    }
    .grand-total-label {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--secondary-color);
    }
    .grand-total-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary-color);
    }
    .invoice-footer {
        text-align: center;
        margin-top: 60px;
        padding-top: 30px;
        border-top: 1px solid #f1f2f6;
    }
    .print-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 20px rgba(255, 71, 87, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1000;
        border: none;
    }
    .print-btn:hover {
        transform: scale(1.1);
        background: var(--secondary-color);
    }
    @media print {
        .navbar, footer, .print-btn { display: none !important; }
        body { background: white; }
        .invoice-container { box-shadow: none; margin: 0; max-width: 100%; padding: 0; }
    }
</style>

<button class="print-btn" onclick="window.print()" title="Print Invoice">
    <i class="fa-solid fa-print fs-4"></i>
</button>

<div class="container">
    <div class="invoice-container">
        @foreach($cust as $item)
        <div class="invoice-header">
            <div class="invoice-logo">FoodZone</div>
            <div class="invoice-title">Invoice</div>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <span class="info-box-label">Billed To</span>
                <div class="info-box-value">
                    {{$item->custname}}<br>
                    {{$item->address}}<br>
                    {{$item->city ?? 'N/A'}}, {{$item->pincode}}<br>
                    <i class="fa-solid fa-phone small me-2 opacity-50"></i>{{$item->mobileno}}
                </div>
            </div>
            <div class="info-box text-md-end">
                <div class="mb-4">
                    <span class="info-box-label">Invoice Number</span>
                    <div class="info-box-value text-primary">#FZ-INV-{{str_pad($item->id, 6, '0', STR_PAD_LEFT)}}</div>
                </div>
                <div>
                    <span class="info-box-label">Date of Issue</span>
                    <div class="info-box-value">{{ \Carbon\Carbon::parse($item->orderdate)->format('F d, Y') }}</div>
                </div>
            </div>
        </div>

        <div class="info-box mb-5">
            <span class="info-box-label">Shipping Method</span>
            <div class="info-box-value">
                <span class="badge bg-light text-dark px-3 py-2 rounded-3 border">
                    <i class="fa-solid fa-truck-fast me-2 text-primary"></i>{{$item->shippingtype}}
                </span>
            </div>
        </div>
        @endforeach

        <table class="invoice-table">
            <thead>
                <tr>
                    <th width="10%">SR</th>
                    <th width="50%">Item Description</th>
                    <th width="10%" class="text-center">QTY</th>
                    <th width="15%" class="text-end">Price</th>
                    <th width="15%" class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                    $k = 1;
                @endphp
                @foreach($cust1 as $item1)
                @php
                    $product_entry = DB::table('product_entry_models')->where('id', $item1->productid)->first();
                    $product_master = DB::table('product_models')->where('id', $product_entry->pnameid)->first();
                    $item_total = $item1->qty * $item1->pprice;
                    $subtotal += $item_total;
                @endphp
                <tr>
                    <td>{{ str_pad($k++, 2, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="fw-bold text-dark">{{ $product_master->productname }}</div>
                        <small class="text-muted">{{ $product_entry->size }} variant</small>
                    </td>
                    <td class="text-center fw-bold">{{ $item1->qty }}</td>
                    <td class="text-end text-muted">₹{{ number_format($item1->pprice, 2) }}</td>
                    <td class="text-end fw-bold text-dark">₹{{ number_format($item_total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $gst = ($subtotal * 5) / 100;
            $grand_total = $subtotal + $gst;
        @endphp

        <div class="total-section">
            <div class="total-row">
                <span class="total-label">Subtotal</span>
                <span class="total-value">₹{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="total-row">
                <span class="total-label">GST (5%)</span>
                <span class="total-value">₹{{ number_format($gst, 2) }}</span>
            </div>
            <div class="total-row">
                <span class="grand-total-label">Total Amount</span>
                <span class="grand-total-value">₹{{ number_format($grand_total, 2) }}</span>
            </div>
        </div>

        <div class="invoice-footer">
            <h6 class="fw-bold text-dark mb-2">Thank you for dining with FoodZone!</h6>
            <p class="text-muted small mb-0">For any inquiries, please contact us at support@foodzone.com or call +91-1234567890</p>
        </div>
    </div>
</div>

@endsection
