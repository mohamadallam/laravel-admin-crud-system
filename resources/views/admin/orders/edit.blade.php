@extends('admin.main-layout')

@section('content-header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">order Edit</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">order Edit</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
@section('body')
@if(empty($order))
{{ Redirect::to('/admin/dashboard') }}
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="content">
<form action="{{route('orders.update',$order->id)}}" method="post">
          @method('PUT')
      		@csrf
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">order Edit</h3>
            </div>
            <div class="card-body">
            <div class="form-group">
                <label for="customer_id">customer id</label>
                <input type="number" id="customer_id" name="customer_id" class="form-control" value="{{$order->customer_id}}">
              </div>
			  <div class="form-group">
                <label for="description">description</label>
                <input type="text" name="description" id="description" class="form-control" value="{{$order->description}}">
              </div>
			  <div class="form-group">
                <label for="total_price">total_price</label>
                <input type="number" name="total_price" id="total_price" class="form-control" value="{{$order->total_price}}">
              </div>

            
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="#" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save Changes" class="btn btn-success float-right">
        </div>
      </div>
	  </form>
    </section>

@endsection