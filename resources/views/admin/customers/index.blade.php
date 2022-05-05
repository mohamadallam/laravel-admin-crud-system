@extends('admin.main-layout')

@section('content-header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Customers</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Customers</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
@section('body')
<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header text-center">
    <h3 class="card-title">Customers</h3>
    <a class="btn btn-success float-right mx-3" href="/admin/customers/create">Add New</a>
    <a class="btn btn-success float-right mx-3" href="/admin/export/customers">Export Customers</a>
    <form  class="d-inline float-right" action="" >
    <div class="form-group">
                    <input style="width: 70%" class="d-inline form-control" value="{{$q}}" type="text" name="q" placeholder="Search Customer..." />
                    <button  type="submit" class="btn btn-primary d-inline" ><i class="fas fa-search"></i></button>
                    
                    </div>
                    </form>

  </div>
  <div class="card-body p-0">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 5%">
                    id
                </th>
                <th style="width: 20%">
                name
                </th>
                <th style="width: 30%">
                address
                </th>
                <th>
                mobile
                </th>
                <th style="width: 20%">
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->address}}</td>
            <td>{{$customer->mobile}}</td>
            <td class="project-actions text-right">
                          <!-- <a class="btn btn-primary btn-sm" href="#">
                              <i class="fas fa-folder">
                              </i>
                              View
                          </a> -->
                          <a class="btn btn-info btn-sm"  href="/admin/customers/{{$customer->id}}/edit">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                              
                              <form action="{{route('customers.destroy',$customer->id)}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      		<input type="hidden" name="id" id="{{$customer->id}}" value="">
            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                              </i>
                              Delete</button>
      </form>
                      </td>
            </tr>
            @endforeach
        </tbody>
        
    </table>

    <div class="my-5  d-flex justify-content-center">
    {!! $customers->links() !!}
</div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

</section>


@endsection