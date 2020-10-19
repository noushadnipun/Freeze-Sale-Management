<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <div class="panel panel-default">
	<div class="panel-body">



			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>
			  			<th style="width:40%;">Product</th>
			  			<th style="width:20%;">Rate</th>
			  			<th style="width:15%;">Quantity</th>
			  			<th style="width:15%;">Total</th>
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  					  			<tr id="row1" class="0">
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName1" onchange="getProductData(1)" >
			  						<option value="">~~SELECT~~</option>
			  						<option value='7' id='changeProduct7'>Half Pant</option><option value='8' id='changeProduct8'>Polo T-shirt</option>		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<input type="text" name="rate[]" id="rate1" autocomplete="off" disabled="true" class="form-control" />
			  					<input type="hidden" name="rateValue[]" id="rateValue1" autocomplete="off" class="form-control" />
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity1" onkeyup="getTotal(1)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<input type="text" name="total[]" id="total1" autocomplete="off" class="form-control" disabled="true" />
			  					<input type="hidden" name="totalValue[]" id="totalValue1" autocomplete="off" class="form-control" />
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(1)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  						  			<tr id="row2" class="1">
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName2" onchange="getProductData(2)" >
			  						<option value="">~~SELECT~~</option>
			  						<option value='7' id='changeProduct7'>Half Pant</option><option value='8' id='changeProduct8'>Polo T-shirt</option>		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<input type="text" name="rate[]" id="rate2" autocomplete="off" disabled="true" class="form-control" />
			  					<input type="hidden" name="rateValue[]" id="rateValue2" autocomplete="off" class="form-control" />
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity2" onkeyup="getTotal(2)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<input type="text" name="total[]" id="total2" autocomplete="off" class="form-control" disabled="true" />
			  					<input type="hidden" name="totalValue[]" id="totalValue2" autocomplete="off" class="form-control" />
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(2)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  						  			<tr id="row3" class="2">
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName3" onchange="getProductData(3)" >
			  						<option value="">~~SELECT~~</option>
			  						<option value='7' id='changeProduct7'>Half Pant</option><option value='8' id='changeProduct8'>Polo T-shirt</option>		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<input type="text" name="rate[]" id="rate3" autocomplete="off" disabled="true" class="form-control" />
			  					<input type="hidden" name="rateValue[]" id="rateValue3" autocomplete="off" class="form-control" />
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity3" onkeyup="getTotal(3)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<input type="text" name="total[]" id="total3" autocomplete="off" class="form-control" disabled="true" />
			  					<input type="hidden" name="totalValue[]" id="totalValue3" autocomplete="off" class="form-control" />
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(3)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  						  	</tbody>
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->
				  <div class="form-group">
				    <label for="vat" class="col-sm-3 control-label">VAT 13%</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
				    </div>
				  </div> <!--/form-group-->
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				  </div> <!--/form-group-->
				  <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Discount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
				    </div>
				  </div> <!--/form-group-->
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				  </div> <!--/form-group-->
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
				    </div>
				  </div> <!--/form-group-->
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				  </div> <!--/form-group-->
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Cheque</option>
				      	<option value="2">Cash</option>
				      	<option value="3">Credit Card</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Full Payment</option>
				      	<option value="2">Advance Payment</option>
				      	<option value="3">No Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->
			  </div> <!--/col-md-6-->


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>



<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Payment</h4>
      </div>

      <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

      	<div class="paymentOrderMessages"></div>


			  <div class="form-group">
			    <label for="due" class="col-sm-3 control-label">Due Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="due" name="due" disabled="true" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="payAmount" name="payAmount"/>
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentType" id="paymentType" >
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Cheque</option>
			      	<option value="2">Cash</option>
			      	<option value="3">Credit Card</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Full Payment</option>
			      	<option value="2">Advance Payment</option>
			      	<option value="3">No Payment</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->

      </div> <!--/modal-body-->
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Order</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->









<script>

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
			url: 'http://localhost/php/stock/php_action/fetchProductData.php',
			type: 'post',
			dataType: 'json',
			success:function(response) {
				$("#addRowBtn").button("reset");

				var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
					'<td>'+
						'<div class="form-group">'+

						'<select class="form-control" name="productName[]" id="productName'+count+'" onchange="getProductData('+count+')" >'+
							'<option value="">~~SELECT~~</option>';
							// console.log(response);
							$.each(response, function(index, value) {
								tr += '<option value="'+value[0]+'">'+value[1]+'</option>';
							});

						tr += '</select>'+
						'</div>'+
					'</td>'+
					'<td style="padding-left:20px;"">'+
						'<input type="text" name="rate[]" id="rate'+count+'" autocomplete="off" disabled="true" class="form-control" />'+
						'<input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
					'</td style="padding-left:20px;">'+
					'<td style="padding-left:20px;">'+
						'<div class="form-group">'+
						'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
						'</div>'+
					'</td>'+
					'<td style="padding-left:20px;">'+
						'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
						'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
					'</td>'+
					'<td>'+
						'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
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
				var tableProductLength = $("#productTable tbody tr").length;
				for(x = 0; x < tableProductLength; x++) {
					var tr = $("#productTable tbody tr")[x];
					var count = $(tr).attr('id');
					count = count.substring(3);

					var productValue = $("#productName"+row).val()

					if($("#productName"+count).val() == "") {
						$("#productName"+count).find("#changeProduct"+productId).removeClass('div-hide');
						console.log("#changeProduct"+count);
					}
				} // /for

			} else {
				$.ajax({
					url: 'http://localhost/php/stock/php_action/fetchSelectedProduct.php',
					type: 'post',
					data: {productId : productId},
					dataType: 'json',
					success:function(response) {
						// setting the rate value into the rate input field

						$("#rate"+row).val(response.rate);
						$("#rateValue"+row).val(response.rate);

						$("#quantity"+row).val(1);

						var total = Number(response.rate) * 1;
						total = total.toFixed(2);
						$("#total"+row).val(total);
						$("#totalValue"+row).val(total);

						// check if product name is selected
						var tableProductLength = $("#productTable tbody tr").length;
						for(x = 0; x < tableProductLength; x++) {
							var tr = $("#productTable tbody tr")[x];
							var count = $(tr).attr('id');
							count = count.substring(3);

							var productValue = $("#productName"+row).val()

							if($("#productName"+count).val() != productValue) {
								// $("#productName"+count+" #changeProduct"+count).addClass('div-hide');
								$("#productName"+count).find("#changeProduct"+productId).addClass('div-hide');
								console.log("#changeProduct"+count);
							}
						} // /for

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

		// vat
		var vat = (Number($("#subTotal").val())/100) * 13;
		vat = vat.toFixed(2);
		$("#vat").val(vat);
		$("#vatValue").val(vat);

		// total amount
		var totalAmount = (Number($("#subTotal").val()) + Number($("#vat").val()));
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