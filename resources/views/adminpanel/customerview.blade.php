@extends('adminpanel.master')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Customer Management</h1>
        <p class="text-muted">View and manage registered users.</p>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right shadow-sm bg-white px-3 py-2" style="border-radius: 10px;">
            <li class="breadcrumb-item"><a href="adminindex" style="color: #FF6B6B;">Home</a></li>
            <li class="breadcrumb-item active">Customers</li>
        </ol>
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
            <div class="card-header bg-white py-4 d-flex align-items-center">
                <h3 class="card-title font-weight-bold mb-0">Registered Users</h3>
            </div>
            <div class="card-body px-0">
                <div class="table-responsive px-4">
                    <table id="example1" class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">ID</th>
                                <th class="border-0">Customer Details</th>
                                <th class="border-0">Contact</th>
                                <th class="border-0">Address</th>
                                <th class="border-0">Gender</th>
                                <th class="border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customerview as $item)
                            <tr>
                                <td class="font-weight-bold text-muted">#{{$item->id}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm mr-3 bg-soft-danger d-flex align-items-center justify-content-center text-danger font-weight-bold" style="width: 40px; height: 40px; border-radius: 10px; background: rgba(255,107,107,0.1);">
                                            {{ substr($item->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-weight-600" style="color: #2d3436;">{{$item->name}}</div>
                                            <small class="text-muted">{{$item->emailid}}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size: 0.9rem;">
                                        <i class="fas fa-phone-alt mr-2 text-muted small"></i> {{$item->mobileno}}<br>
                                        <i class="fas fa-calendar-alt mr-2 text-muted small"></i> {{ \Carbon\Carbon::parse($item->dob)->format('d M, Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size: 0.9rem;">
                                        <span class="d-block">{{$item->address}}</span>
                                        <span class="text-muted small"><i class="fas fa-map-marker-alt mr-1"></i> {{$item->city}}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-pill {{ $item->gender == 'Male' ? 'bg-soft-primary text-primary' : 'bg-soft-danger text-danger' }}" style="padding: 6px 15px; background: {{ $item->gender == 'Male' ? 'rgba(110,142,251,0.1)' : 'rgba(255,107,107,0.1)' }};">
                                        {{$item->gender}}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                                        <a href="{{url('deleteregister/'.$item->id)}}" class="btn btn-white btn-sm px-3" title="Delete" onclick="return confirm('Delete this customer account?')">
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
    .btn-white { background: #fff; color: #555; border: 1px solid #eee; }
    .btn-white:hover { background: #f8f9fa; }
    .table-hover tbody tr:hover { background-color: rgba(255, 107, 107, 0.01); }
    .bg-soft-primary { background-color: rgba(110, 142, 251, 0.1); }
    .bg-soft-danger { background-color: rgba(255, 107, 107, 0.1); }
</style>
@endsection
