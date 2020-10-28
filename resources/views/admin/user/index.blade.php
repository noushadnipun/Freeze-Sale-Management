@extends('admin.layouts.master')
@section('site-title')
User
@endsection

@section('page-content')
    @include('admin.includes.message')

    <div class="row">
        <div class="col-md-4">
            <form action="{{ (!empty($editUser)) ? route('admin_user_update') : route('admin_user_store') }}" method="POST">
                @csrf
                @if(!empty($editUser))
                    <input type="hidden" name="id" value="{{$editUser->id}}">
                @endif
                <div class="card card-purple card-outline">
                    <div class="card-header {{ (!empty($editUser)) ? 'bg-purple text-white' : '' }}">
                        <h3 class="card-title">{{ (!empty($editUser)) ? 'Edit ' : 'Add' }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="outletName">Name</label>
                            <input type="text" name="name" class="form-control" id="" placeholder="Enter Name" value="{{ (!empty($editUser)) ? $editUser->name : old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="outletName">Email</label>
                            <input type="text" name="email" class="form-control" id="" placeholder="Enter Email" value="{{ (!empty($editUser)) ? $editUser->email : old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="outletName">Password</label>
                            <input type="text" name="password" class="form-control" id="" placeholder="Enter Password" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="outletName">Confirm Password</label>
                            <input type="text" name="password_confirmation" class="form-control" id="" placeholder="Enter Confirm Password" value="" required>
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
            <h3 class="card-title">All User Records </h3> <a href="{{ route('admin_user_index') }}" class=" ml-1 btn-xs btn-success" title="Add New">  <i class="fa fa-plus"></i></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="customDataTable" class="table table-bordered table-hover table-head-fixed">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Address(s)</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($getUser as $key => $data)  {?>
                <tr>
                    <td>{{ ++$key  }}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>
                        <a href="{{route('admin_user_edit', $data->id)}}" class="btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></a>  
                        <a href="{{route('admin_user_delete', $data->id)}}" class="btn-sm btn-danger" onclick="return confirm('Are you sure want to Delete?')" title="Delete"><i class="fa fa-trash"></i></a>
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