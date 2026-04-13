@extends('adminpanel.master')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 font-weight-bold" style="color: #2d3436;">Customer Feedbacks</h1>
        <p class="text-muted">Read and analyze what your customers have to say.</p>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right shadow-sm bg-white px-3 py-2" style="border-radius: 10px;">
            <li class="breadcrumb-item"><a href="adminindex" style="color: #FF6B6B;">Home</a></li>
            <li class="breadcrumb-item active">Feedbacks</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="card-header bg-white py-4">
                <h3 class="card-title font-weight-bold">Recent Reviews</h3>
            </div>
            <div class="card-body px-0">
                <div class="table-responsive px-4">
                    <table id="example1" class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">ID</th>
                                <th class="border-0">User Profile</th>
                                <th class="border-0">Contact Info</th>
                                <th class="border-0">Feedback Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedback1 as $item)
                            <tr>
                                <td class="text-muted font-weight-bold">#{{$item->id}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle bg-soft-warning text-warning mr-3 d-flex align-items-center justify-content-center font-weight-bold" style="width: 45px; height: 45px; border-radius: 50%; background: rgba(255, 159, 67, 0.1);">
                                            {{ substr($item->custname, 0, 1) }}
                                        </div>
                                        <span class="font-weight-600" style="color: #2d3436;">{{$item->custname}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="text-muted"><i class="fas fa-envelope mr-1"></i> {{$item->custemail}}</div>
                                        <div class="text-muted"><i class="fas fa-phone mr-1"></i> {{$item->mobileno}}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="feedback-bubble p-3" style="background: #f8f9fa; border-radius: 12px; border-left: 4px solid #FF6B6B;">
                                        <p class="mb-0 text-dark" style="font-size: 0.95rem; line-height: 1.5;">"{{$item->description}}"</p>
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
    .bg-soft-warning { background-color: rgba(255, 159, 67, 0.1); }
    .table-hover tbody tr:hover { background-color: rgba(255, 107, 107, 0.01); }
</style>
@endsection
