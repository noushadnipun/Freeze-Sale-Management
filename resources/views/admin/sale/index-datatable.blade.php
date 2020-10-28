<table xid="customDataTable" class="table table-bordered table-hover table-head-fixed text-center table-responsive-sm table-sm">
    <thead>
        <tr>
            <th>SL</th>
            <th>Call No</th>
            <th>Call Date</th>
            <th>Visi ID</th>
            <th>Visi Size</th>
            <th colspan="2">Outlet Name</th>
            <th colspan="3">Address & Cell No</th>
            <th colspan="2">DB Name</th>
            <span colspan="4">
                <th colspan="2">Work Details</th>
                <th>Qty</th>
                <th>Rate</th>
                <th>Taka</th>
            </span>
            <th>Total Amount</th>
            <th>Delivery Date</th>
            <th class="pdfv">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($getSale as $key => $data)  {?>
        <tr>
            <td>
                @if(Request()->routeIs('admin_sale_filterOutlet', 'admin_sale_filterDistributor'))
                    {{++$key}}
                @else
                    {{ $key + $getSale->firstItem()}}
                @endif
            </td>
            <td>{{$data->call_no}}</td>
            <td>{{$data->call_date}}</td>
            <td>
                    {{$data->visi_id}}
            </td>
            <td>
                    {{$data->visi_size}}
            </td>
            <td colspan="2">
                {{$data->outletName}}
            </td>
            <td colspan="3">
                    {{$data->outletAddress}} <br>
                    {{$data->outletMobile}}
            </td>
            <td colspan="2">
                    {{$data->dbName}}
            </td>
            @php
                $thisSaleItem = App\SaleItem::where('sales_id', $data->id)->get();
            @endphp
            <td style="vertical-align: top" colspan="2">
                @foreach($data->saleItems  as $item)
                    @php
                        $thisService = App\Service::where('id', $item->service_id)->first();
                    @endphp
                    <div class="border-bottom">{{$thisService->name}}</div>
                @endforeach
               
                {{-- <div class="text-danger">Discount</div> --}}
            </td>
            <td style="vertical-align: top">
                @foreach($data->saleItems as $item)
                    <div class="border-bottom">{{$item->service_qty}}</div>
                @endforeach
                    {{-- <div></div> --}}
            </td>
            <td style="vertical-align: top">
                @foreach($data->saleItems as $item)
                    @php
                        $thisService = App\Service::where('id', $item->service_id)->first();
                    @endphp
                    <div class="border-bottom">{{$thisService->rate}}</div>
                @endforeach
                {{-- <div></div> --}}
            </td>
            <td style="vertical-align: top">
                @foreach($data->saleItems as $item)
                    @php
                        $thisService = App\Service::where('id', $item->service_id)->first();
                        $getServiceTk = $item->service_qty * $thisService->rate ;
                    @endphp
                    
                    <div class="border-bottom">{{$getServiceTk}}</div>
                @endforeach
                {{-- <div class="text-danger">- {{$data->discount}}</div> --}}
            </td> 
            <td>
                
                    {{round($data->grand_total)}}
                
            </td> 
            <td>{{$data->delivery_date}}</td>
            <td class="pdfv">
                <a href="" class="btn-sm btn-warning" data-toggle="modal" data-target=".view-sale{{$data->id}}" title="View"><i class="fa fa-eye"></i></a> 
                <a href="{{route('admin_sale_edit', $data->id)}}" class="btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></a> 
                <a href="{{route('admin_sale_delete', $data->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a> 
            </td>
        </tr>
    <?php } ?>
    </tbody>
        <tr>
            <th colspan="17" class="text-right">Total</th>
            <th colspan="1" class="text-center">{{$sumTotalRawAmountCount}}</th>
            <th colspan="1"></th>
            <th class="pdfv" colspan="1"></th>
        </tr>
    <tfoot>
        
    </tfoot>
</table>

@foreach($getSale as $key => $data)
    @include('admin.sale.view-modal')
@endforeach

<div class="float-right mt-2 p-0">
    @if(Request()->routeIs('admin_sale_filterOutlet', 'admin_sale_filterDistributor'))
        
    @else
        {{ $getSale->links() }}
    @endif
</div>


@if(Request()->routeIs('admin_sale_pdf'))
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<style>
    tbody:before, tbody:after { display: none; }
    .pdfv { display: none; }
    table {table-layout: fixed; font-size: 12px;}
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
    .table td div.border-bottom:last-child{
        border-bottom: 0px !important;
    }
    th,td  {padding:0 5px;}
</style>

@endif