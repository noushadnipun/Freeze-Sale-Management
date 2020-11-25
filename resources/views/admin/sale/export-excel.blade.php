<table style="display: table;"  border="1">
    <thead>
        <tr>
            <th style="font-weight: bold;  text-align: center;">SL No</th>
            <th style="font-weight: bold;  text-align: center;">Call No</th>
            <th style="font-weight: bold;  text-align: center;">Call Date</th>
            <th style="font-weight: bold;  text-align: center;">Pull Date</th>
            <th style="font-weight: bold;  text-align: center;">Visi ID</th>
            <th style="font-weight: bold;  text-align: center;">Visi Size</th>
            <th style="font-weight: bold;  text-align: center;">Outlet Name</th>
            <th style="font-weight: bold;  text-align: center;">Address &amp; Cell No</th>
            <th style="font-weight: bold;  text-align: center;">DB Name</th>
            <th style="font-weight: bold;  text-align: center;">Work Details</th>
            <th style="font-weight: bold;  text-align: center;">Qty</th>
            <th style="font-weight: bold;  text-align: center;">Rate</th>
            <th style="font-weight: bold;  text-align: center;">Taka</th>
            <th style="font-weight: bold;  text-align: center;">Total Amount</th>
            <th style="font-weight: bold;  text-align: center;">Delivery Date</th>
        </tr>
    </thead>
    <tbody>
        
     <?php foreach($getSale as $key => $data)  {?>
        <tr>
            <td style="vertical-align: center; text-align: center;">
   
               {{++$getSerialNumber}}
                
            </td>
            <td style="vertical-align: center; text-align: center;">{{$data->call_no}}</td>
            <td style="vertical-align: center; text-align: center;">{{$data->call_date}}</td>
            <td style="vertical-align: center; text-align: center;">{{$data->pull_date}}</td>
            <td style="vertical-align: center; text-align: center;"> {{$data->visi_id}}</td>
            <td style="vertical-align: center; text-align: center;">{{$data->visi_size}} </td>
            <td style="vertical-align: center; text-align: center;">{{$data->outletName}}</td>
            <td style="vertical-align: center; text-align: center;">
                    {{$data->outletAddress}} <br>
                    {{$data->outletMobile}}
            </td>
            <td style="vertical-align: center; text-align: center;">
                    {{$data->dbName}}
            </td>
            @php
                $thisSaleItem = App\SaleItem::where('sales_id', $data->id)->get();
            @endphp
            <td style="vertical-align: top">
                @foreach($data->saleItems  as $item)
                    @php
                        $thisService = App\Service::where('id', $item->service_id)->first();
                    @endphp
                    {{$thisService->name}} <br style="mso-data-placement:same-cell;" />
                @endforeach
               
            </td>
            <td style="vertical-align: top;  text-align: center;">
                @foreach($data->saleItems as $item)
                    {{$item->service_qty}} <br style="mso-data-placement:same-cell;" />
                @endforeach
            </td>
            <td style="vertical-align: top;  text-align: center;">
                @foreach($data->saleItems as $item)
                    @php
                        $thisService = App\Service::where('id', $item->service_id)->first();
                    @endphp
                    {{$thisService->rate}} <br style="mso-data-placement:same-cell;" />
                @endforeach
            </td>
            <td style="vertical-align: top;  text-align: center;">
                @foreach($data->saleItems as $item)
                    @php
                        $thisService = App\Service::where('id', $item->service_id)->first();
                        $getServiceTk = $item->service_qty * $thisService->rate ;
                    @endphp
                    {{$getServiceTk}} <br style="mso-data-placement:same-cell;" />
                @endforeach
                {{-- <div class="text-danger">- {{$data->discount}}</div> --}}
            </td> 
            <td style="vertical-align: center; text-align: center;">
                
                    {{round($data->grand_total)}}
                
            </td> 
            <td style="vertical-align: center; text-align: center;">{{$data->delivery_date}}</td>
        </tr>
    <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="12" class="text-left" style="font-weight: bold;  font-size: 12px;">
                @php
                 $inWordAmount  = App\CustomClass\NumberToWord::numberTowords($sumTotalRawAmountCount); 
                @endphp
                 In Word: {{ $inWordAmount }}
            </th>
            <th colspan="1" style="font-weight: bold;  text-align: right;">Total</th>
            <th style="font-weight: bold;  text-align: center;">{{$sumTotalRawAmountCount}}</th>
            <th colspan="1"></th>
        </tr>
    </tfoot>
</table>
<style>
    .text-center-align-center {
        text-align: center;
    }

    tr td {
        border: 1px solid #000000;
    }
</style>