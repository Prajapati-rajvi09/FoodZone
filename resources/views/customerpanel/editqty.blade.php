@extends('adminpanel.master')

@section('content')
  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adminindex">Home</a></li>
             
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <center>
    @if(session('status'))
    <h3 style="color:green">{{session('status')}}</h3>
    @endif
    </center>
    <!-- Main content -->
   
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quantity Update</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
              <form action="{{url('updateqty/'.$edit->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                 <div class="container-fluid">Quantity Update</div>
                    <input type="text" name="qty" min="1" max="20" class="form-control" value="{{$edit->qty}}">
                  </div>
                  <h6 style="color:green">@error('qty'){{$message}}@enderror</h6>
                  
             

               

                
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
           
            <!-- /.card -->
            
        <!-- /.row -->
  
    </section>
   
      <!-- /.control-sidebar -->
    
<!-- ./wrapper -->
  @endsection

