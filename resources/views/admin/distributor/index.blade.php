@extends('admin.layouts.master')

@section('site-title')
    Distributors
@endsection

@section('page-content')

    @include('admin.includes.message')

    <div class="row">
        <div class="col-md-4">
            <form action="{{ (!empty($editDistributor)) ? route('admin_distributor_update') : route('admin_distributor_store') }}" method="POST">
                @csrf
                @if(!empty($editDistributor))
                    <input type="hidden" name="id" value="{{$editDistributor->id}}">
                @endif
                <div class="card card-purple card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Add/Edit</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="outletName">Distributor Name</label>
                        <input type="text" name="name" class="form-control" id="outletName" placeholder="Enter name" value="{{ (!empty($editDistributor)) ? $editDistributor->name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="outletMobile">Cell No</label>
                            <input type="text" name="mobile" class="form-control" id="outletMobile" placeholder="Enter Mobile" value="{{ (!empty($editDistributor)) ? $editDistributor->mobile : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="outletAddess">Description</label>
                            <input type="text" name="description" class="form-control" id="outletAddess" placeholder="Enter Address" value="{{ (!empty($editDistributor)) ? $editDistributor->description : '' }}">
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
            <h3 class="card-title">All Distributor Records </h3> <a href="{{ route('admin_distributor') }}" class=" ml-1 btn-xs btn-success" title="Add New">  <i class="fa fa-plus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="customDataTable" class="table table-bordered table-hover table-head-fixed">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Cell No</th>
                  <th>Description(s)</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($getDistributor as $key => $data)  {?>
                <tr>
                    <td>{{ ++$key  }}</td>
                    <td>{{$data->name}}</td>
                    <td> {{$data->mobile}}</td>
                    <td>{{$data->description}}</td>
                    <td>
                        <a href="{{route('admin_distributor_outlet', $data->id)}}" class="btn-sm btn-warning" title="View"><i class="fa fa-eye"></i></a>
                        <a href="{{route('admin_distributor_edit', $data->id)}}" class="btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></a>  
                        <a href="{{route('admin_distributor_delete', $data->id)}}" class="btn-sm btn-danger" onclick="return confirm('Are you sure want to Delete?')" title="Delete"><i class="fa fa-trash"></i></a>
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
