<table border="1" xid="customDataTable" id="tblData" class="table table-bordered table-hover table-head-fixed text-center table-responsive-sm table-sm" style="display: table; border: 1px;">
    <thead>
        <tr>
            <th style="vertical-align: center; text-align: center;">SL</th>
            <th style="vertical-align: center; text-align: center;">Call No</th>
            <th style="vertical-align: center; text-align: center;">Call Date</th>
            <th style="vertical-align: center; text-align: center;">Pull Date</th>
            <th style="vertical-align: center; text-align: center;">Visi ID</th>
            <th style="vertical-align: center; text-align: center;">Visi Size</th>
            <th colspan="2"  style="vertical-align: center; text-align: center;">Outlet Name</th>
            <th colspan="3" style="vertical-align: center; text-align: center;">Address & Cell No</th>
            <th colspan="2" style="vertical-align: center; text-align: center;">DB Name</th>
            <span colspan="4">
                <th colspan="2" style="vertical-align: center; text-align: center;" >Work Details</th>
                <th style="vertical-align: center; text-align: center;">Qty</th>
                <th style="vertical-align: center; text-align: center;">Rate</th>
                <th style="vertical-align: center; text-align: center;">Taka</th>
            </span>
            <th style="vertical-align: center; text-align: center;">Total Amount</th>
            <th style="vertical-align: center; text-align: center;">Delivery Date</th>
            <th class="pdfv" style="vertical-align: center; text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($getSale as $key => $data)  {?>
        <tr>
            <td style="vertical-align: center; text-align: center;">
                @if(Request()->routeIs('admin_sale_filterOutlet', 'admin_sale_filterDistributor'))
                    {{++$key}}
                @else
                    {{ $key + $getSale->firstItem()}}
                @endif
            </td>
            <td style="vertical-align: center; text-align: center;">{{$data->call_no}}</td>
            <td style="vertical-align: center; text-align: center;">{{$data->call_date}}</td>
            <td style="vertical-align: center; text-align: center;">{{$data->pull_date}}</td>
            <td style="vertical-align: center; text-align: center;">
                    {{$data->visi_id}}
            </td>
            <td>
                    {{$data->visi_size}}
            </td>
            <td colspan="2">
                {{$data->outletName}}
            </td>
            <td colspan="3" style="vertical-align: center; text-align: center;">
                    {{$data->outletAddress}} <br>
                    {{$data->outletMobile}}
            </td>
            <td colspan="2" style="vertical-align: center; text-align: center;">
                    {{$data->dbName}}
            </td>
            @php
                $thisSaleItem = App\SaleItem::where('sales_id', $data->id)->get();
            @endphp
            <td style="vertical-align: top;  text-align: center;" colspan="2">
                @foreach($data->saleItems  as $item)
                    @php
                        $thisService = App\Service::where('id', $item->service_id)->first();
                    @endphp
                    <div class="border-bottom">{{$thisService->name}}</div>
                @endforeach
               
                {{-- <div class="text-danger">Discount</div> --}}
            </td>
            <td style="vertical-align: top;  text-align: center;">
                @foreach($data->saleItems as $item)
                    <div class="border-bottom">{{$item->service_qty}}</div>
                @endforeach
                    {{-- <div></div> --}}
            </td>
            <td style="vertical-align: top;  text-align: center;">
                @foreach($data->saleItems as $item)
                    @php
                        $thisService = App\Service::where('id', $item->service_id)->first();
                    @endphp
                    <div class="border-bottom">{{$thisService->rate}}</div>
                @endforeach
                {{-- <div></div> --}}
            </td>
            <td style="vertical-align: top;  text-align: center;">
                @foreach($data->saleItems as $item)
                    @php
                        $thisService = App\Service::where('id', $item->service_id)->first();
                        $getServiceTk = $item->service_qty * $thisService->rate ;
                    @endphp
                    
                    <div class="border-bottom">{{$getServiceTk}}</div>
                @endforeach
                {{-- <div class="text-danger">- {{$data->discount}}</div> --}}
            </td> 
            <td style="vertical-align: center; text-align: center;">
                
                    {{round($data->grand_total)}}
                
            </td> 
            <td style="vertical-align: center; text-align: center;">{{$data->delivery_date}}</td>
            <td class="pdfv">
                <a href="" class="btn-sm btn-warning" data-toggle="modal" data-target=".view-sale{{$data->id}}" title="View"><i class="fa fa-eye"></i></a> 
                <a href="{{route('admin_sale_edit', $data->id)}}" class="btn-sm btn-success" title="Edit"><i class="fa fa-pen"></i></a> 
                <a href="{{route('admin_sale_delete', $data->id)}}" onclick="return confirm('Are you sure want to Delete?')" class="btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a> 
            </td>
        </tr>
    <?php } ?>
    </tbody>
        <tr>
            <th colspan="17" class="text-left" style="font-size: 12px;">
                @php
                  $inWordAmount  = App\CustomClass\NumberToWord::numberTowords($sumTotalRawAmountCount); 
                @endphp
                In Word: {{ $inWordAmount }}
            </th>
            <th colspan="1" class="text-right">Total</th>
            <th colspan="1" class="text-center">{{$sumTotalRawAmountCount}}</th>
            <th colspan="1"></th>
            <th class="pdfv" colspan="1"></th>
        </tr>
    <tfoot>

    </tfoot>
</table>


<div class="float-right mt-2 p-0 paginate">
    @if(Request()->routeIs('admin_sale_filterOutlet', 'admin_sale_filterDistributor'))
        {{$getSale->appends(request()->query())->links()}}
    @else
        {{-- {{ $getSale->links() }} --}}
        {{$getSale->appends(request()->query())->links()}}
        {{-- {!! $getSale->render() !!} --}}
    @endif
</div>

@foreach($getSale as $key => $data)
    @include('admin.sale.view-modal')
@endforeach


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

