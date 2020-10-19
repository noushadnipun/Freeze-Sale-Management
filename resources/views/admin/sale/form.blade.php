@extends('admin.layouts.master')

@section('site-title')
    New Services
@endsection

@section('page-content')

    @include('admin.includes.message')

    <div class="card card-purple card-outline">
        <div class="card-header">
            Sale
        </div>
        <form method="post" action="{{!empty($saleValue->id) ? route('admin_sale_update') : route('admin_sale_store') }}"  id="createOrderForm">
            @csrf
            @if(!empty($saleValue->id))
                <input type="hidden" name="id" value="{{$saleValue->id}}">
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Call No</label>
                        <input type="text" class="form-control" name="call_no" autocomplete="off" value="{{!empty($saleValue->id) ? $saleValue->call_no : '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Call Date</label>
                            <input type="text" class="form-control" id="call_datepicker" name="call_date" value="{{!empty($saleValue->id) ? $saleValue->call_date : '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Visi ID</label>
                            <input type="text" class="form-control" name="visi_id" value="{{!empty($saleValue->id) ? $saleValue->visi_id : '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Visi Size</label>
                            <input type="text" class="form-control" name="visi_size" value="{{!empty($saleValue->id) ? $saleValue->visi_size : '' }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Select Outlet</label>
                        <select xid="locality-dropdown" name="outlet_id" data-live-search="true" class="selectpicker form-control showOutletInfo" data-size="10" required>
                            @php
                                $getOutlet = App\Outlet::get();
                            @endphp
                            <option selected="true" disabled>Choose Outlet</option>
                            @foreach($getOutlet as $data)
                                <option 
                                    data-token="{{$data->name}}" 
                                    data-mobile="<?php echo 'Mobile: '?>{{$data->mobile}}" 
                                    data-address="<?php echo 'Address: '?>{{$data->address}}" 
                                    data-distributor="<?php $dataDistrobutor = App\Distributor::where('id', $data->distributor_id)->first(); echo 'Distributor: '?>{{!empty($dataDistrobutor) ? $dataDistrobutor->name: ''}}" 
                                    value="{{$data->id}}" {{!empty($saleValue->id) && $saleValue->outlet_id == $data->id ? 'selected'  : '' }}> {{$data->name}}
                                </option>
                            @endforeach
                        </select>
                        <div class="p-3 bg-white text-dark text-md">

                                @if(!empty($saleValue))
                                    @php
                                        $getOutlet = App\Outlet::where('id', $saleValue->outlet_id)->first();
                                        $getDistributor = App\Distributor::where('id', $getOutlet->distributor_id)->first();
                                    @endphp
                                @endif

                                <div class="font-weight-bold"> 
                                    <span class="outlet-address">
                                        {{!empty($saleValue) ? 'Address: '.$getOutlet->address : '' }}
                                    </span> 
                                </div>
                                <div class="font-weight-bold"> 
                                    <span class="outlet-mobile">
                                        {{!empty($saleValue) ? 'Mobile: '.$getOutlet->mobile : '' }}
                                    </span> 
                                </div>
                                <div class="font-weight-bold"> 
                                    <span class="outlet-distributor">
                                        {{!empty($saleValue) && !empty($getDistributor) ? 'Distributor: '.$getDistributor->name : '' }}
                                    </span> 
                                </div>
                        </div>
                    </div>

                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="">DB Name</label>
                            <input type="text" class="form-control" name="db_name" value="{{!empty($saleValue->id) ? $saleValue->db_name : '' }}" required>
                        </div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Delivery Date</label>
                            <input type="text" class="form-control" id="delivery_datepicker" name="delivery_date" value="{{!empty($saleValue->id) ? $saleValue->delivery_date : '' }}">
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
                                <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus text-success"></i> </button>

                                <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="fa fa-undo text-warning"></i></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($saleValue->id))
                            {{-- Update Form  --}}
                            @php
                                $getThisSaleItem = App\SaleItem::where('sales_id', $saleValue->id)->get();
                            @endphp
                            @foreach($getThisSaleItem as $data)
                            @if(!empty($saleValue->id))
                                <input type="hidden" name="item_id[]" value="{{$data->id}}">
                             @endif
                                <?php
                                    $arrayNumber = 0;
                                    //for($x = 1; $x < 2; $x++) { 
                                        $x = $data->id.'00';
                                    ?>
                                        <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
                                            <td style="margin-left:20px;">
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" name="service_id[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" data-live-search="true" data-size="8" required>
                                                        <option value="">~~SELECT~~</option>
                                                        <?php
                                                            $productData = App\Service::get();

                                                            foreach($productData as $row) { ?>									 		
                                                                <option value="{{ $row['id'] }}" id="changeProduct{{$row['id']}}" {{ $row['id'] == $data->service_id ? 'selected' : '' }} >{{$row['name']}}</option>
                                                                }  

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="padding-left:20px;">	
                                                @php
                                                    $getSeviceRate = App\Service::where('id', $data->service_id)->first();
                                                @endphp		  					
                                                <input type="text" xname="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="{{$getSeviceRate->rate}}" />			  					
                                                <input type="hidden" xname="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                            </td>
                                            <td style="padding-left:20px;">
                                                <div class="form-group">
                                                <input type="number" name="service_qty[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" required value="{{$data->service_qty}}"/>
                                                </div>
                                            </td>
                                            <td style="padding-left:20px;">			  					
                                                <input type="text" xname="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="{{$data->service_qty * $getSeviceRate->rate}}" />			  					
                                                <input type="hidden" xname="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                            </td>
                                            <td>

                                                <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash text-danger"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                                    $arrayNumber++;
                                    //} // /for
                                ?>
                            @endforeach
                            {{-- End Update Form  --}}
                        @else
                        <?php
                        //Craete Forrm
                        $arrayNumber = 0;
                        for($x = 1; $x < 2; $x++) { ?>
                            <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
                                <td style="margin-left:20px;">
                                    <div class="form-group">
                                        <select class="form-control selectpicker" name="service_id[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" data-live-search="true" data-size="8" required>
                                            <option value="">~~SELECT~~</option>
                                            <?php
                                                $productData = App\Service::get();

                                                foreach($productData as $row) {									 		
                                                    echo "<option value='".$row['id']."' id='changeProduct".$row['id']."'>".$row['name']."</option>";
                                                    } // /while 

                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td style="padding-left:20px;">			  					
                                    <input type="text" xname="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
                                    <input type="hidden" xname="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                </td>
                                <td style="padding-left:20px;">
                                    <div class="form-group">
                                    <input type="number" name="service_qty[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" required />
                                    </div>
                                </td>
                                <td style="padding-left:20px;">			  					
                                    <input type="text" xname="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
                                    <input type="hidden" xname="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
                                </td>
                                <td>

                                    <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash text-danger"></i></button>
                                </td>
                            </tr>
                        <?php
                        $arrayNumber++;
                        } // /for
                        //End Create Form
                        ?>
                        @endif  
                    </tbody>			  	
                </table>
                
                <div class="row clearfix float-right" style="margin-right: 10%;">
                    <div class="col-md-12">
                        <table class="table-bordered table-hover mt-3">
                            <tbody>               
                                <tr class="d-none">
                                    <th class="text-center p-3">Sub Total</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
                                        <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
                                    </td>
                                </tr>
                                <tr class="d-none">
                                    <th class="text-center p-3">VAT 13%</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
                                        <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-center p-3">Total Amount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="{{!empty($saleValue->id) ? $saleValue->grand_total + $saleValue->discount : '' }}" />
                                        <input type="hidden" class="form-control" id="totalAmountValue" xname="totalAmountValue" value="{{!empty($saleValue->id) ? $saleValue->grand_total + $saleValue->discount : '' }}" />
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-center p-3">Discount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="{{!empty($saleValue->id) ? $saleValue->discount : '' }}" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center p-3">Grand Total</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="{{!empty($saleValue->id) ? $saleValue->grand_total : '' }}"/>
                                    <input type="hidden" class="form-control" id="grandTotalValue" name="grand_total" value="{{!empty($saleValue->id) ? $saleValue->grand_total : '' }}" />
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center p-3">Paid Amount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="paid" name="paid_amount" autocomplete="off" onkeyup="paidAmount()" autocomplete="off" value="{{!empty($saleValue->id) ? $saleValue->paid_amount : '' }}" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center p-3">Due Amount</th>
                                    <td class="text-center p-3">
                                        <input type="text" class="form-control" id="due" name="due" disabled="true" value="{{!empty($saleValue->id) ? $saleValue->grand_total - $saleValue->paid_amount : '' }}" />
                                        <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="{{!empty($saleValue->id) ? $saleValue->grand_total - $saleValue->paid_amount : '' }}" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!--/col-md-6-->
                
                </div>
                

            </div>
            <div class="card-footer">
                <div class="row clearfix submitButtonFooter float-right mr-5">
                    <div class="col-md-10">
                        <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



@endsection



@section('cusjs')

<script>
    /*
    let dropdown = $('#locality-dropdown');

    dropdown.empty();

    dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
    dropdown.prop('selectedIndex', 0);

    const url = "{{route('api_service')}}";

    // Populate dropdown with list of provinces
    $.getJSON(url, function (data) {
    $.each(data, function (key, entry) {
        dropdown.append($('<option data-token="'+entry.name+'" data-mobile="'+entry.mobile+'" data-address="'+entry.address+'"></option>').attr('value', entry.id).text([entry.name]));
    })
    });
    */

    //SHow Out Let info After Select
    $('.showOutletInfo').on('change', function() {
        $('.outlet-address')
        .text(
            $(this).find(':selected').data('address')
        );
        $('.outlet-mobile')
        .text(
        $(this).find(':selected').data('mobile')
        );
        $('.outlet-distributor')
        .text(
        $(this).find(':selected').data('distributor')
        );
    });
</script>


<script>
    //Add Row All Function

    function addRow() {
        $("#addRowBtn").button("loading");

        var tableLength = $("#productTable tbody tr").length;

        var tableRow;
        var arrayNumber;
        var count;

        if(tableLength > 0) {		
            tableRow = $("#productTable tbody tr:last").attr('id');
            arrayNumber = $("#productTable tbody tr:last").attr('class');
            count = tableRow.substring(3);	
            count = Number(count) + 1;
            arrayNumber = Number(arrayNumber) + 1;					
        } else {
            // no table row
            count = 1;
            arrayNumber = 0;
        }

        $.ajax({
            url: '{{route("api_service")}}',
            type: 'get',
            dataType: 'json',
            success:function(response) {
                $("#addRowBtn").button("reset");			
                var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				
                    '<td>'+
                        '<div class="form-group">'+

                        '<select required class="form-control" name="service_id[]" id="productName'+count+'" onchange="getProductData('+count+')" >'+
                            '<option value="">~~SELECT~~</option>';
                            //console.log(response);
                            $.each(response, function(index, value) {
                                tr += '<option value="'+value['id']+'">'+value['name']+'</option>';
                                //tr += '<option value="'+value[0]+'">'+value[1]+'</option>';								
                            });
                                                        
                        tr += '</select>'+
                        '</div>'+
                    '</td>'+
                    '<td style="padding-left:20px;"">'+
                        '<input type="text" xname="rate[]" id="rate'+count+'" autocomplete="off" disabled="true" class="form-control" />'+
                        '<input type="hidden" xname="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
                    '</td style="padding-left:20px;">'+
                    '<td style="padding-left:20px;">'+
                        '<div class="form-group">'+
                        '<input type="number" name="service_qty[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" required />'+
                        '</div>'+
                    '</td>'+
                    '<td style="padding-left:20px;">'+
                        '<input type="text" xname="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
                        '<input type="hidden" xname="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
                    '</td>'+
                    '<td>'+
                        '<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="fa fa-trash text-danger"></i></button>'+
                    '</td>'+
                '</tr>';
                if(tableLength > 0) {							
                    $("#productTable tbody tr:last").after(tr);
                } else {				
                    $("#productTable tbody").append(tr);
                }		

            } // /success
        });	// get the product data

    } // /add row

    function removeProductRow(row = null) {
        if(row) {
            $("#row"+row).remove();


            subAmount();
        } else {
            alert('error! Refresh the page again');
        }
    }

    // select on product data
    function getProductData(row = null) {
        if(row) {
            var productId = $("#productName"+row).val();		
            
            if(productId == "") {
                $("#rate"+row).val("");

                $("#quantity"+row).val("");						
                $("#total"+row).val("");

                // remove check if product name is selected
                // var tableProductLength = $("#productTable tbody tr").length;			
                // for(x = 0; x < tableProductLength; x++) {
                // 	var tr = $("#productTable tbody tr")[x];
                // 	var count = $(tr).attr('id');
                // 	count = count.substring(3);

                // 	var productValue = $("#productName"+row).val()

                // 	if($("#productName"+count).val() == "") {					
                // 		$("#productName"+count).find("#changeProduct"+productId).removeClass('div-hide');	
                // 		console.log("#changeProduct"+count);
                // 	}											
                // } // /for

            } else {
                $.ajax({
                    url: '{{route("api_service")}}',
                    type: 'get',
                    data: {productId : productId},
                    dataType: 'json',
                    success:function(response) {
                        // setting the rate value into the rate input field
                        //console.log(response[productId]['rate']);
                        //console.log(response[productId]);
                        $("#rate"+row).val(response[productId-1].rate);
                        $("#rateValue"+row).val(response.rate);

                        $("#quantity"+row).val(1);

                        var total = Number(response[productId-1].rate) * 1;
                        total = total.toFixed(2);
                        $("#total"+row).val(total);
                        $("#totalValue"+row).val(total);
                        
                        // check if product name is selected
                        // var tableProductLength = $("#productTable tbody tr").length;					
                        // for(x = 0; x < tableProductLength; x++) {
                        // 	var tr = $("#productTable tbody tr")[x];
                        // 	var count = $(tr).attr('id');
                        // 	count = count.substring(3);

                        // 	var productValue = $("#productName"+row).val()

                        // 	if($("#productName"+count).val() != productValue) {
                        // 		// $("#productName"+count+" #changeProduct"+count).addClass('div-hide');	
                        // 		$("#productName"+count).find("#changeProduct"+productId).addClass('div-hide');								
                        // 		console.log("#changeProduct"+count);
                        // 	}											
                        // } // /for
                
                        subAmount();
                    } // /success
                }); // /ajax function to fetch the product data	
            }
                    
        } else {
            alert('no row! please refresh the page');
        }
    } // /select on product data

    // table total
    function getTotal(row = null) {
        if(row) {
            var total = Number($("#rate"+row).val()) * Number($("#quantity"+row).val());
            total = total.toFixed(2);
            $("#total"+row).val(total);
            $("#totalValue"+row).val(total);
            
            subAmount();

        } else {
            alert('no row !! please refresh the page');
        }
    }

    function subAmount() {
        var tableProductLength = $("#productTable tbody tr").length;
        var totalSubAmount = 0;
        for(x = 0; x < tableProductLength; x++) {
            var tr = $("#productTable tbody tr")[x];
            var count = $(tr).attr('id');
            count = count.substring(3);

            totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
        } // /for

        totalSubAmount = totalSubAmount.toFixed(2);

        // sub total
        $("#subTotal").val(totalSubAmount);
        $("#subTotalValue").val(totalSubAmount);
        /*
        // vat
        var vat = (Number($("#subTotal").val())/100) * 13;
        vat = vat.toFixed(2);
        $("#vat").val(vat);
        $("#vatValue").val(vat);
        */
        // total amount
        //var totalAmount = (Number($("#subTotal").val()) + Number($("#vat").val()));
        var totalAmount = (Number($("#subTotal").val()));
        totalAmount = totalAmount.toFixed(2);
        $("#totalAmount").val(totalAmount);
        $("#totalAmountValue").val(totalAmount);

        var discount = $("#discount").val();
        if(discount) {
            var grandTotal = Number($("#totalAmount").val()) - Number(discount);
            grandTotal = grandTotal.toFixed(2);
            $("#grandTotal").val(grandTotal);
            $("#grandTotalValue").val(grandTotal);
        } else {
            $("#grandTotal").val(totalAmount);
            $("#grandTotalValue").val(totalAmount);
        } // /else discount	

        var paidAmount = $("#paid").val();
        if(paidAmount) {
            paidAmount =  Number($("#grandTotal").val()) - Number(paidAmount);
            paidAmount = paidAmount.toFixed(2);
            $("#due").val(paidAmount);
            $("#dueValue").val(paidAmount);
        } else {	
            $("#due").val($("#grandTotal").val());
            $("#dueValue").val($("#grandTotal").val());
        } // else

    } // /sub total amount

    function discountFunc() {
        var discount = $("#discount").val();
        var totalAmount = Number($("#totalAmount").val());
        totalAmount = totalAmount.toFixed(2);

        var grandTotal;
        if(totalAmount) { 	
            grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
            grandTotal = grandTotal.toFixed(2);

            $("#grandTotal").val(grandTotal);
            $("#grandTotalValue").val(grandTotal);
        } else {
        }

        var paid = $("#paid").val();

        var dueAmount; 	
        if(paid) {
            dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
            dueAmount = dueAmount.toFixed(2);

            $("#due").val(dueAmount);
            $("#dueValue").val(dueAmount);
        } else {
            $("#due").val($("#grandTotal").val());
            $("#dueValue").val($("#grandTotal").val());
        }

    } // /discount function

    function paidAmount() {
        var grandTotal = $("#grandTotal").val();

        if(grandTotal) {
            var dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
            dueAmount = dueAmount.toFixed(2);
            $("#due").val(dueAmount);
            $("#dueValue").val(dueAmount);
        } // /if
    } // /paid amoutn function


    function resetOrderForm() {
        // reset the input field
        $("#createOrderForm")[0].reset();
        // remove remove text danger
        $(".text-danger").remove();
        // remove form group error 
        $(".form-group").removeClass('has-success').removeClass('has-error');
    } // /reset order form
</script>



<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">


<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>  
<link href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet">

<script>
  $(function () {
    //Date picker
    $('#call_datepicker').datepicker({
      autoclose: true,
      dateFormat: 'dd/mm/yy',
    })
    $('#delivery_datepicker').datepicker({
      autoclose: true,
      dateFormat: 'dd/mm/yy'
    })
  })
</script>


<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>




@endsection
