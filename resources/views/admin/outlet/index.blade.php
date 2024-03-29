@extends('admin.layouts.master')
@section('site-title')
Outlets
@endsection
@section('page-content')

    @include('admin.includes.message')

    <div class="row">
        <div class="col-md-4">
            <form action="{{ (!empty($editOutlet)) ? route('admin_outlet_update') : route('admin_outlet_store') }}" method="POST">
                @csrf
                @if(!empty($editOutlet))
                    <input type="hidden" name="id" value="{{$editOutlet->id}}">
                @endif
                <div class="card card-purple card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Add/Edit</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="outletName">Visi ID</label>
                            <input type="text" name="visi_id" class="form-control" id="outletName" placeholder="Enter ID" value="{{ (!empty($editOutlet)) ? $editOutlet->visi_id : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="outletName">Visi Size</label>
                            <input type="text" name="visi_size" class="form-control" id="outletName" placeholder="Enter Size" value="{{ (!empty($editOutlet)) ? $editOutlet->visi_size : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="outletName">Outlet Name</label>
                            <input type="text" name="name" class="form-control" id="outletName" placeholder="Enter name" value="{{ (!empty($editOutlet)) ? $editOutlet->name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="outletAddess">Outlet Address</label>
                            <input type="text" name="address" class="form-control" id="outletAddess" placeholder="Enter Address" value="{{ (!empty($editOutlet)) ? $editOutlet->address : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="outletMobile">Cell No</label>
                            <input type="text" name="mobile" class="form-control" id="outletMobile" placeholder="Enter Mobile" value="{{ (!empty($editOutlet)) ? $editOutlet->mobile : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="outletMobile"> Distributor</label>
                            <select name="distributor_id" id="" class="form-control">
                                <option value="">Select</option>
                                @php
                                    $showDistributorList = App\Distributor::get();
                                @endphp
                                @foreach ($showDistributorList as $data)
                                    <option value="{{$data->id}}" {{ (!empty($editOutlet)) && $editOutlet->distributor_id == $data->id ? 'selected' : '' }} >{{ $data->name }}</option>
                                @endforeach
                                
                            </select>
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
            <h3 class="card-title">All Outlets Records </h3> <a href="{{ route('admin_outlet') }}" class=" ml-1 btn-xs btn-success" title="Add New">  <i class="fa fa-plus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="customDataTable" class="table table-bordered table-hover table-head-fixed">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Address(s)</th>
                  <th>Cell No</th>
                  <th>Distributor</th>
                  <th>Visi ID</th>
                  <th>Visi Size</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($getOutlet as $key => $data)  {?>
                <tr>
                    <td>{{ ++$key  }}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->address}}</td>
                    <td> {{$data->mobile}}</td>
                    <td> 
                        @php
                            $thisDistributor = App\Distributor::where('id', $data->distributor_id)->first();
                        @endphp
                        @if(!empty($thisDistributor))
                            {{$thisDistributor->name}}
                        @endif
                    </td>
                    <td> {{$data->visi_id}}</td>
                    <td> {{$data->visi_size}}</td>
                    <td>
                        <a href="{{route('admin_outlet_service', $data->id)}}" class="btn-sm btn-warning d-none" title="View"><i class="fa fa-eye"></i></a>
                        <a href="{{route('admin_outlet_edit', $data->id)}}" class="btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></a>  
                        <a href="{{route('admin_outlet_delete', $data->id)}}" class="btn-sm btn-danger" onclick="return confirm('Are you sure want to Delete?')" title="Delete"><i class="fa fa-trash"></i></a>
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
