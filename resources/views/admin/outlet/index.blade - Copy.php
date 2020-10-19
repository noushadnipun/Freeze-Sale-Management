@extends('admin.layouts.master')
@section('page-content')
    @if(Session::get('success') == true)
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('admin_outlet_store') }}" method="POST">
                @csrf
                <div class="card card-purple card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Add/Edit</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="outletName">Outlet Name</label>
                            <input type="text" name="name" class="form-control" id="outletName" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="outletAddess">Outlet Address</label>
                            <input type="text" name="address" class="form-control" id="outletAddess" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label for="outletMobile">Cell No</label>
                            <input type="text" name="mobile" class="form-control" id="outletMobile" placeholder="Enter Mobile">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-purple">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- End Col  4 -->
        <div class="col-md-8">
            <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">All Outlets Records</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="customDataTable" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Address(s)</th>
                  <th>Cell No</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($getOutlet as $key => $data)  {?>
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->address}}</td>
                    <td> {{$data->mobile}}</td>
                    <td>
                        <a href="{{route('admin_outlet_edit', $data->id)}}" class="btn-sm btn-success"><i class="fa fa-pen"></i></a>  
                        <a href="" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Address(s)</th>
                  <th>Cell No</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>

@endsection

@section('cusjs')
    <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <script src="{{asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>


    <script>
    $(function () {
        $('#customDataTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
    </script>
@endsection
