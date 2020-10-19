@extends('admin.layouts.master')
@section('page-content')
    @include('admin.includes.message')
    <div class="row">
        <div class="col-md-4">
            <form action="{{ (!empty($editService)) ? route('admin_service_update') :  route('admin_service_store') }}" method="POST">
                @csrf
                @if(!empty($editService))
                    <input type="hidden" name="id" value="{{$editService->id}}">
                @endif
                <div class="card card-purple card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Add/Edit</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="outletName">Service Name</label>
                            <input type="text" name="name" class="form-control" id="outletName" placeholder="Enter name" value="{{ (!empty($editService)) ? $editService->name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="outletAddess">Rate</label>
                            <input type="text" name="rate" class="form-control" id="outletAddess" placeholder="Enter Rate" value="{{ (!empty($editService)) ? $editService->rate : '' }}" required>
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
              <h3 class="card-title">All Services Records</h3> <a href="{{ route('admin_service') }}" class=" ml-1 btn-xs btn-success" title="Add New">  <i class="fa fa-plus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="customDataTable" class="table table-bordered table-hover table-head-fixed">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Rate</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($getService as $key => $data)  {?>
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->rate}}</td>
                    <td>
                        <a href="{{route('admin_service_edit', $data->id)}}" class="btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></a>  
                        <a href="{{route('admin_service_delete', $data->id)}}" class="btn-sm btn-danger" onclick="return confirm('Are you sure want to Delete?')" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                
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
