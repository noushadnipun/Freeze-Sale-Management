<div class="modal fade view-sale{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Call No</label>
                        <input type="text" class="form-control" name="call_no" autocomplete="off" value="{{ $data->call_no }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Call Date</label>
                            <input type="text" class="form-control" xid="call_datepicker" name="call_date" value="{{$data->call_date }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Visi ID</label>
                            @if(!empty($data->id))
                                @php
                                $saleValueOutletID = App\Outlet::where('id', $data->outlet_id)->first();
                                @endphp
                            @endif
                            <input type="text" class="form-control" name="visi_id" value="{{!empty($data->id) && $saleValueOutletID ? $saleValueOutletID->visi_id : '' }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Visi Size</label>
                            <input type="text" class="form-control" name="visi_size" value="{{!empty($data->id) && $saleValueOutletID ? $saleValueOutletID->visi_size : '' }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Outlet</label>
                            @php
                                $getOutlet = App\Outlet::where('id', $data->outlet_id)->first();
                                if (!empty($getOutlet)){
                                    $getDistributor = App\Distributor::where('id', $getOutlet->distributor_id)->first();
                                }   
                            @endphp
                        @if(!empty($getOutlet))
                            <input type="text" class="form-control" value="{{$getOutlet->name}}" disabled>
                            <div class="p-3 bg-white text-dark text-md">
                                <div class="font-weight-bold">Address: <span class="outlet-address">{{$getOutlet->address}}</span> </div>
                                <div class="font-weight-bold">Mobile: <span class="outlet-mobile">{{$getOutlet->mobile}}</span> </div>
                                <div class="font-weight-bold"> 
                                    <span class="outlet-distributor">
                                        {{ !empty($getDistributor) ? 'Distributor: '.$getDistributor->name : '' }}
                                    </span> 
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="">DB Name</label>
                            <input type="text" class="form-control" name="db_name" value="{{$data->db_name }}" disabled>
                        </div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Delivery Date</label>
                            <input type="text" class="form-control" xid="delivery_datepicker" name="delivery_date" value="{{ $data->delivery_date  }}" disabled>
                        </div>
                    </div>

                </div>

                <table class="table" id="productTable">
                    <thead>
                        <tr>			  			
                            <th style="width:40%;">Product</th>
                            <th style="width:20%;">Rate</th>
                            <th style="width:15%;">Quantity</th>			  			
                            <th style="width:15%;">Total</th>			  			
                            <th style="width:10%;"> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            {{-- Update Form  --}}
                            @php
                                $getThisSaleItem = App\SaleItem::where('sales_id', $data->id)->get();
                            @endphp
                            @foreach($getThisSaleItem as $getThisSaleItemValue)
                                <?php
                                    $arrayNumber = 0;
                                    //for($x = 1; $x < 2; $x++) { 
                                        $x = $data->id.'00';
                                    ?>
                                        <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
                                            <td style="margin-left:20px; padding: .75rem; vertical-align: top;">
                                                <div class="form-group">
                                                        <?php
                                                            $productData = App\Service::where('id', $getThisSaleItemValue->service_id)->first();
                                                        ?>	
                                                        <input type="text" class="form-control" value="{{$productData->name}}" disabled>								 		
                                                </div>
                                            </td>
                                            <td style="padding-left:20px; padding: .75rem; vertical-align: top; ">	
                                                @php
                                                    $getSeviceRate = App\Service::where('id', $getThisSaleItemValue->service_id)->first();
                                                @endphp		  					
                                                <input type="text" xname="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="{{$getSeviceRate->rate}}" disabled />				  					
                                            </td>
                                            <td style="padding-left:20px; padding: .75rem; vertical-align: top;">
                                                <div class="form-group">
                                                <input type="number" name="service_qty[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" required value="{{$getThisSaleItemValue->service_qty}}" disabled/>
                                                </div>
                                            </td>
                                            <td style="padding-left:20px; padding: .75rem; vertical-align: top;">			  					
                                                <input type="text" xname="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="{{$getThisSaleItemValue->service_qty * $getSeviceRate->rate}}" disabled />			  					
                                            </td>
                                            <td>

                                                
                                            </td>
                                        </tr>
                                    <?php
                                    $arrayNumber++;
                                    //} // /for
                                ?>
                            @endforeach
                            {{-- End Update Form  --}}
                        
                    </tbody>			  	
                </table>
                
                <div class="row clearfix float-right" style="margin-right: 10%;">
                    <div class="col-md-12">
                        <table class="table-bordered table-hover mt-3">
                            <tbody>               
                                <tr class="d-none">
                                    <th class="text-center p-3">Sub Total</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true"/>
                                    </td>
                                </tr>
                                <tr class="d-none">
                                    <th class="text-center p-3">VAT 13%</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
                                        <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
                                    </td>
                                </tr>
                                <tr class="d-none">
                                    <th class="text-center p-3">Total Amount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="{{ $data->grand_total + $data->discount }}" />
                                    </td>
                                </tr>
                                <tr class="d-none">
                                    <th class="text-center p-3">Discount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="{{ $data->discount }}" disabled/>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center p-3">Grand Total</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="{{$data->grand_total }}" />
                                    </td>
                                </tr>
                                <tr class="d-none">
                                    <th class="text-center p-3">Paid Amount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="paid" name="paid_amount" autocomplete="off" onkeyup="paidAmount()" autocomplete="off" value="{{$data->paid_amount }}" disabled/>
                                    </td>
                                </tr>
                                <tr class="d-none">
                                    <th class="text-center p-3">Due Amount</th>
                                    <td class="text-center p-3">
                                    <input type="text" class="form-control" id="due" name="due" disabled="true" value="{{$data->grand_total - $data->paid_amount }}"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!--/col-md-6-->
                
                </div>
                

            </div>


    </div>
  </div>
</div>