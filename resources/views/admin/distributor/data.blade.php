<table  class="table table-bordered table-hover table-head-fixed">
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
            <td>{{ $key + $getDistributor->firstItem()  }}</td>
            <td>{{$data->name}}</td>
            <td> {{$data->mobile}}</td>
            <td>{{$data->description}}</td>
            <td>
                <a href="{{route('admin_distributor_sale', $data->id)}}" class="btn-sm btn-warning d-none" title="View"><i class="fa fa-eye"></i></a>
                <a href="{{route('admin_distributor_edit', $data->id)}}" class="btn-sm btn-success edit-data-btn" data-target="{{$data->id}}" data-target="{{$data->id}}"  title="Edit"><i class="fa fa-pen"></i></a>  
                <a href="{{route('admin_distributor_delete', $data->id)}}" data-target="{{$data->id}}" class="btn-sm btn-danger delete-data-btn" onclick="return confirm('Are you sure want to Delete?')" title="Delete"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
    
    </tfoot>
     
</table>
<div class="float-right mt-2 p-0">
    {{ $getDistributor->links() }}
</div>
