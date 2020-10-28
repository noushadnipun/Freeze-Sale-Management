<table>
    <thead>
        <tr>
            
        </tr>
    </thead>
    <tbody>
    <?php foreach($getSale as $key => $data)  {?>
        <tr>
            <td>{{ $key + $getSale->firstItem()}}</td>
            <td>{{$data->call_no}}</td>
            <td>{{$data->call_date}}</td>
            <td>
                    {{$data->visi_id}}
            </td>
            <td>
                    {{$data->visi_size}}
            </td>
            <td>
                {{$data->outletName}}
            </td>
            <td>
                    {{$data->outletAddress}} <br>
                    {{$data->outletMobile}}
            </td>
            <td>
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
        </tr>
    <?php } ?>
    </tbody>
</table>