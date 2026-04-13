@extends('master')
@section('Abhiraj')

<div class="section-padding" style="margin-top: 80px; background: #FFF5F5;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item"><a href="{{ url('/menu') }}" class="text-primary">Menu</a></li>
                        <li class="breadcrumb-item active">Non-Vegetarian</li>
                    </ol>
                </nav>
                <h1 class="display-5">Gourmet <span>Meats</span></h1>
            </div>
            <a href="{{ url('/menu') }}" class="btn btn-light rounded-circle p-3 shadow-sm">
                <i class="fa-solid fa-arrow-left fs-4"></i>
            </a>
        </div>

        <div class="row g-5">
            <!-- Items Grid -->
            <div class="col-lg-8">
                <div class="row g-4">
                    @php
                        $nonVegItems = [
                            ['name' => 'Mutton Curry', 'price' => 450, 'img' => 'thumb__1200_0_0_0_auto.jpg'],
                            ['name' => 'Kolkata Mutton Biryani', 'price' => 380, 'img' => '1606113764_KolkataMutton.jfif'],
                            ['name' => 'Chicken Tikka Masala', 'price' => 320, 'img' => 'chikan-tikka-masala.jpg'],
                            ['name' => 'Chicken 65 Special', 'price' => 280, 'img' => 'chicken-65-restaurant-style.jpg'],
                            ['name' => 'Tandoori Chicken', 'price' => 490, 'img' => 'Chicken_Whole_in_tandoori_With_Skin-02a48764cccd.avif'],
                            ['name' => 'Butter Chicken', 'price' => 350, 'img' => 'butter-chicken--600x600.jpg'],
                        ];
                    @endphp

                    @foreach($nonVegItems as $item)
                        <div class="col-md-6">
                            <div class="food-card">
                                <img src="{{ asset('images/'.$item['img']) }}" alt="{{ $item['name'] }}">
                                <h4>{{ $item['name'] }}</h4>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="price-tag">Rs. {{ $item['price'] }}</span>
                                    <button class="btn btn-order py-2 px-4 w-auto">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Enquiry Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg p-4 sticky-top" style="top: 120px; border-radius: 24px;">
                    <div class="text-center mb-4">
                        <div class="fs-1 text-primary mb-2"><i class="fa-solid fa-drumstick-bite"></i></div>
                        <h4>Meaty Enquiry</h4>
                        <p class="text-muted small">Bulk orders for parties or celebrations? Contact us!</p>
                        <h5 class="text-primary mt-2">+91 63 24 56 86 58</h5>
                    </div>

                    <form action="{{ url('insertenquire') }}" method="POST">
                        @csrf
                        @if(Session::get('success'))
                            <div class="alert alert-success border-0 rounded-3 small">{{ Session::get('success') }}</div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email address" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Message</label>
                            <textarea name="message" class="form-control" rows="4" placeholder="Your requirements..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-order shadow">Submit Enquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
