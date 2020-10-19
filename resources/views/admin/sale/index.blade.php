@extends('admin.layouts.master')


@section('page-content')

@include('admin.includes.message')

<div class="row">
    <div class="col-md-12">
        <div class="card card-purple card-outline">
            <div class="card-header">
              <h3 class="card-title">All Sale Records</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body px-2 py-3">
              <table id="customDataTable" class="table table-bordered table-hover table-head-fixed text-center table-responsive-sm table-sm">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Call No</th>
                        <th>Call Date</th>
                        <th>Visi No</th>
                        <th>Visi ID</th>
                        <th>Outlet Name</th>
                        <th>Outlet Address & cell No</th>
                        <th>DB Name</th>
                        <span colspan="4">
                            <th>Work Details</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th>Taka</th>
                        </span>
                        <th>Total Amount</th>
                        <th>Delivery Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($getSale as $key => $data)  {?>
                    <tr>
                        <td>{{ $key + $getSale->firstItem()}}</td>
                        <td>{{$data->call_no}}</td>
                        <td>{{$data->call_date}}</td>
                        <td>{{$data->visi_id}}</td>
                        <td>{{$data->visi_size}}</td>
                        <td>
                            @php
                                $thisOutlet = App\Outlet::where('id', $data->outlet_id)->first();
                            @endphp
                            {{$thisOutlet->name}}
                        </td>
                        <td>
                            {{$thisOutlet->address}} <br>
                            {{$thisOutlet->mobile}}
                        </td>
                        <td>{{$data->db_name}}</td>
                        @php
                            $thisSaleItem = App\Saleitem::where('sales_id', $data->id)->get();
                        @endphp
                        <td style="vertical-align: top">
                            @foreach($thisSaleItem as $item)
                                @php
                                    $thisService = App\Service::where('id', $item->service_id)->first();
                                @endphp
                                <div class="border-bottom">{{$thisService->name}}</div>
                            @endforeach
                            <div class="text-danger">Discount</div>
                        </td>
                        <td style="vertical-align: top">
                            @foreach($thisSaleItem as $item)
                                <div class="border-bottom">{{$item->service_qty}}</div>
                            @endforeach
                                <div></div>
                        </td>
                        <td style="vertical-align: top">
                            @foreach($thisSaleItem as $item)
                                @php
                                    $thisService = App\Service::where('id', $item->service_id)->first();
                                @endphp
                                <div class="border-bottom">{{$thisService->rate}}</div>
                            @endforeach
                            <div></div>
                        </td>
                        <td style="vertical-align: top">
                            @foreach($thisSaleItem as $item)
                                @php
                                    $thisService = App\Service::where('id', $item->service_id)->first();
                                    $getServiceTk = $item->service_qty * $thisService->rate ;
                                @endphp
                                
                                <div class="border-bottom">{{$getServiceTk}}</div>
                            @endforeach
                            <div class="text-danger">- {{$data->discount}}</div>
                        </td> 
                        <td>
                           
                             {{round($data->grand_total)}}
                            
                        </td>
                        <td>{{$data->delivery_date}}</td>
                        <td>
                            <a href="" class="btn-sm btn-warning" data-toggle="modal" data-target=".view-sale{{$data->id}}" title="View"><i class="fa fa-eye"></i></a> 
                            <a href="{{route('admin_sale_edit', $data->id)}}" class="btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></a> 
                            <a href="{{route('admin_sale_delete', $data->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a> 
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                    <tr>
                        <th colspan="12" class="text-right">Total</th>
                        <th colspan="1" class="text-center">{{$sumTotalRawAmountCount}}</th>
                        <th colspan="2"></th>
                    </tr>
                <tfoot>
                    
                </tfoot>
              </table>
              @foreach($getSale as $key => $data)
                @include('admin.sale.view-modal')
              @endforeach
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
                {{$getSale->links()}}
            </div>
        </div>
    </div>
</div>

@endsection
@section('cusjs')
<style>
    .table td{
        padding: 2px;
        vertical-align: middle;
    }
    .table th {
        vertical-align: middle;
    }
    .table td div.border-bottom {
        vertical-align: top;
    }
</style>

    <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <script src="{{asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>


    <script>
    $(function () {
        $('#customDataTable').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": true,
        "responsive": true,
        //"lengthMenu": [[1, 2, 5, -1], [1, 2, 5, "All"]],
        });
    });
    </script>



@endsection