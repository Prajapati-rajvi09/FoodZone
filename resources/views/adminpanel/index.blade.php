@extends('adminpanel.master')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Dashboard Overview</h1>
            <p class="text-muted">Welcome back! Here's your business performance at a glance.</p>
        </div>
        <div class="col-sm-6 text-right">
            <div class="date-badge d-inline-block shadow-sm bg-white px-3 py-2" style="border-radius: 12px; border-left: 4px solid var(--primary-color);">
                <i class="far fa-calendar-alt mr-2 text-muted"></i>
                <span class="font-weight-600 text-dark">{{ now()->format('d M, Y') }}</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-6">
        <div class="small-box stats-card text-white shadow" style="background: linear-gradient(135deg, #6e8efb 0%, #a777e3 100%);">
            <div class="inner">
                <h3>{{ $totalCustomers }}</h3>
                <p>Total Customers</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="customerview" class="small-box-footer">View List <i class="fas fa-arrow-circle-right ml-1"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box stats-card text-white shadow" style="background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%);">
            <div class="inner">
                <h3>{{ $totalProducts }}</h3>
                <p>Menu Items</p>
            </div>
            <div class="icon">
                <i class="fas fa-utensils"></i>
            </div>
            <a href="productentryview" class="small-box-footer">Catalog <i class="fas fa-arrow-circle-right ml-1"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box stats-card text-white shadow" style="background: linear-gradient(135deg, #00b894 0%, #55efc4 100%);">
            <div class="inner">
                <h3>{{ $totalOrders }}</h3>
                <p>Total Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <a href="customerorder" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right ml-1"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box stats-card text-white shadow" style="background: linear-gradient(135deg, #0984e3 0%, #74b9ff 100%);">
            <div class="inner">
                <h3>₹{{ number_format($totalRevenue, 0) }}</h3>
                <p>Total Revenue</p>
            </div>
            <div class="icon">
                <i class="fas fa-wallet"></i>
            </div>
            <a href="customerorder" class="small-box-footer">Details <i class="fas fa-arrow-circle-right ml-1"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Sales Chart -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center">
                <h3 class="card-title font-weight-bold mb-0">
                    <i class="fas fa-chart-area mr-2 text-danger"></i> Revenue Growth (Last 7 Days)
                </h3>
            </div>
            <div class="card-body">
                <div style="height: 350px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Recent Orders Table -->
        <div class="card border-0 shadow-sm mt-4" style="border-radius: 20px;">
            <div class="card-header bg-white py-4">
                <h3 class="card-title font-weight-bold">Recent Orders</h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive px-4">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">Bill #</th>
                                <th class="border-0">Customer</th>
                                <th class="border-0">Amount</th>
                                <th class="border-0">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr>
                                <td><span class="font-weight-bold">#{{ $order->billno }}</span></td>
                                <td>{{ $order->custname }}</td>
                                <td class="text-success fw-bold">₹{{ $order->total }}</td>
                                <td><span class="badge badge-pill bg-light text-dark px-3">{{ $order->shippingtype }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 text-center py-3">
                <a href="customerorder" class="text-primary font-weight-600">View All Orders</a>
            </div>
        </div>
    </div>

    <!-- Right Sidebar Content -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="background: #2d3436; color: white; border-radius: 20px;">
            <div class="card-header border-0 pt-4 px-4 bg-transparent text-center">
                <h3 class="card-title w-100 float-none">Quick Actions</h3>
            </div>
            <div class="card-body px-4 pb-4">
                <a href="/productentry" class="btn btn-block btn-secondary text-left py-3 mb-3 border-0" style="border-radius: 12px; background: rgba(255,255,255,0.05);">
                    <i class="fas fa-plus-circle mr-3 text-warning"></i> Add New Dish
                </a>
                <a href="/Pincode" class="btn btn-block btn-secondary text-left py-3 mb-3 border-0" style="border-radius: 12px; background: rgba(255,255,255,0.05);">
                    <i class="fas fa-map-marked-alt mr-3 text-info"></i> Manage Service Areas
                </a>
                <a href="customerorder" class="btn btn-block btn-secondary text-left py-3 mb-4 border-0" style="border-radius: 12px; background: rgba(255,255,255,0.05);">
                    <i class="fas fa-motorcycle mr-3 text-success"></i> Track Live Deliveries
                </a>
                
                <div class="p-3 bg-dark" style="border-radius: 15px;">
                    <h6 class="font-weight-bold mb-3 small text-muted text-uppercase">System Status</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="small">Live Orders</span>
                        <span class="badge badge-success">Online</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="small">Database</span>
                        <span class="badge badge-success">Healthy</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mt-4 bg-white" style="border-radius: 20px;">
            <div class="card-body p-4 text-center">
                <div class="bg-soft-danger mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 15px; background: rgba(255, 107, 107, 0.1);">
                    <i class="fas fa-headset text-danger fs-4"></i>
                </div>
                <h5 class="font-weight-bold">Need Help?</h5>
                <p class="text-muted small">Access configuration settings or contact system documentation.</p>
                <button class="btn btn-outline-danger btn-sm px-4 rounded-pill">Documentation</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .stats-card { border-radius: 20px !important; overflow: hidden; }
    .stats-card .inner h3 { font-size: 2.2rem; font-weight: 800; margin-bottom: 5px; }
    .stats-card .icon { top: 15px; right: 15px; font-size: 50px; }
    .font-weight-600 { font-weight: 600; }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    // Create gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(255, 107, 107, 0.4)');
    gradient.addColorStop(1, 'rgba(255, 107, 107, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Revenue (₹)',
                data: {!! json_encode($chartValues) !!},
                borderColor: '#FF6B6B',
                borderWidth: 4,
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#FF6B6B',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: { color: '#888' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#888' }
                }
            }
        }
    });
});
</script>
@endsection
