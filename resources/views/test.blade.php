<link rel="stylesheet" href="http://localhost/PHP/stock/assests/bootstrap/css/bootstrap.min.css">
<script src="http://localhost/PHP/stock/assests/jquery/jquery.min.js"></script>
	<script src="http://localhost/PHP/stock/assests/bootstrap/js/bootstrap.min.js"></script>



<div class="panel-body">
			
					

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->			  

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
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
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
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
                        
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
		

	</div> <!--/panel-->	
</div> <!--/panel-->	


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


<!-- jquery -->
	
<script>
	// var manageOrderTable;

	// $(document).ready(function() {

	// 	var divRequest = $(".div-request").text();

	// 	// top nav bar 
	// 	$("#navOrder").addClass('active');

	// 	if(divRequest == 'add')  {
	// 		// add order	
	// 		// top nav child bar 
	// 		$('#topNavAddOrder').addClass('active');	

	// 		// order date picker
	// 		$("#orderDate").datepicker();

	// 		// create order form function
	// 		$("#createOrderForm").unbind('submit').bind('submit', function() {
	// 			var form = $(this);

	// 			$('.form-group').removeClass('has-error').removeClass('has-success');
	// 			$('.text-danger').remove();
					
	// 			var orderDate = $("#orderDate").val();
	// 			var clientName = $("#clientName").val();
	// 			var clientContact = $("#clientContact").val();
	// 			var paid = $("#paid").val();
	// 			var discount = $("#discount").val();
	// 			var paymentType = $("#paymentType").val();
	// 			var paymentStatus = $("#paymentStatus").val();		

	// 			// form validation 
	// 			if(orderDate == "") {
	// 				$("#orderDate").after('<p class="text-danger"> The Order Date field is required </p>');
	// 				$('#orderDate').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#orderDate').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(clientName == "") {
	// 				$("#clientName").after('<p class="text-danger"> The Client Name field is required </p>');
	// 				$('#clientName').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#clientName').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(clientContact == "") {
	// 				$("#clientContact").after('<p class="text-danger"> The Contact field is required </p>');
	// 				$('#clientContact').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#clientContact').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(paid == "") {
	// 				$("#paid").after('<p class="text-danger"> The Paid field is required </p>');
	// 				$('#paid').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#paid').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(discount == "") {
	// 				$("#discount").after('<p class="text-danger"> The Discount field is required </p>');
	// 				$('#discount').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#discount').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(paymentType == "") {
	// 				$("#paymentType").after('<p class="text-danger"> The Payment Type field is required </p>');
	// 				$('#paymentType').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#paymentType').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(paymentStatus == "") {
	// 				$("#paymentStatus").after('<p class="text-danger"> The Payment Status field is required </p>');
	// 				$('#paymentStatus').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#paymentStatus').closest('.form-group').addClass('has-success');
	// 			} // /else


	// 			// array validation
	// 			var productName = document.getElementsByName('productName[]');				
	// 			var validateProduct;
	// 			for (var x = 0; x < productName.length; x++) {       			
	// 				var productNameId = productName[x].id;	    	
	// 		    if(productName[x].value == ''){	    		    	
	// 		    	$("#"+productNameId+"").after('<p class="text-danger"> Product Name Field is required!! </p>');
	// 		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
	// 	      } else {      	
	// 		    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
	// 	      }          
	// 	   	} // for

	// 	   	for (var x = 0; x < productName.length; x++) {       						
	// 		    if(productName[x].value){	    		    		    	
	// 		    	validateProduct = true;
	// 	      } else {      	
	// 		    	validateProduct = false;
	// 	      }          
	// 	   	} // for       		   	
			
	// 	   	var quantity = document.getElementsByName('quantity[]');		   	
	// 	   	var validateQuantity;
	// 	   	for (var x = 0; x < quantity.length; x++) {       
	// 	 			var quantityId = quantity[x].id;
	// 		    if(quantity[x].value == ''){	    	
	// 		    	$("#"+quantityId+"").after('<p class="text-danger"> Product Name Field is required!! </p>');
	// 		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	// 	      } else {      	
	// 		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	// 	      } 
	// 	   	}  // for

	// 	   	for (var x = 0; x < quantity.length; x++) {       						
	// 		    if(quantity[x].value){	    		    		    	
	// 		    	validateQuantity = true;
	// 	      } else {      	
	// 		    	validateQuantity = false;
	// 	      }          
	// 	   	} // for       	
			

	// 			if(orderDate && clientName && clientContact && paid && discount && paymentType && paymentStatus) {
	// 				if(validateProduct == true && validateQuantity == true) {
	// 					// create order button
	// 					// $("#createOrderBtn").button('loading');

	// 					$.ajax({
	// 						url : form.attr('action'),
	// 						type: form.attr('method'),
	// 						data: form.serialize(),					
	// 						dataType: 'json',
	// 						success:function(response) {
	// 							console.log(response);
	// 							// reset button
	// 							$("#createOrderBtn").button('reset');
								
	// 							$(".text-danger").remove();
	// 							$('.form-group').removeClass('has-error').removeClass('has-success');

	// 							if(response.success == true) {
									
	// 								// create order button
	// 								$(".success-messages").html('<div class="alert alert-success">'+
	// 	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	// 	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	// 	            	' <br /> <br /> <a type="button" onclick="printOrder('+response.order_id+')" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Print </a>'+
	// 	            	'<a href="orders.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Order </a>'+
						
	// 	   		       '</div>');
									
	// 							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

	// 							// disabled te modal footer button
	// 							$(".submitButtonFooter").addClass('div-hide');
	// 							// remove the product row
	// 							$(".removeProductRowBtn").addClass('div-hide');
									
	// 							} else {
	// 								alert(response.messages);								
	// 							}
	// 						} // /response
	// 					}); // /ajax
	// 				} // if array validate is true
	// 			} // /if field validate is true
				

	// 			return false;
	// 		}); // /create order form function	
		
	// 	} else if(divRequest == 'manord') {
	// 		// top nav child bar 
	// 		$('#topNavManageOrder').addClass('active');

	// 		manageOrderTable = $("#manageOrderTable").DataTable({
	// 			'ajax': 'http://localhost/php/stock/php_action/fetchOrder.php',
	// 			'order': []
	// 		});		
						
	// 	} else if(divRequest == 'editOrd') {
	// 		$("#orderDate").datepicker();

	// 		// edit order form function
	// 		$("#editOrderForm").unbind('submit').bind('submit', function() {
	// 			// alert('ok');
	// 			var form = $(this);

	// 			$('.form-group').removeClass('has-error').removeClass('has-success');
	// 			$('.text-danger').remove();
					
	// 			var orderDate = $("#orderDate").val();
	// 			var clientName = $("#clientName").val();
	// 			var clientContact = $("#clientContact").val();
	// 			var paid = $("#paid").val();
	// 			var discount = $("#discount").val();
	// 			var paymentType = $("#paymentType").val();
	// 			var paymentStatus = $("#paymentStatus").val();		

	// 			// form validation 
	// 			if(orderDate == "") {
	// 				$("#orderDate").after('<p class="text-danger"> The Order Date field is required </p>');
	// 				$('#orderDate').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#orderDate').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(clientName == "") {
	// 				$("#clientName").after('<p class="text-danger"> The Client Name field is required </p>');
	// 				$('#clientName').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#clientName').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(clientContact == "") {
	// 				$("#clientContact").after('<p class="text-danger"> The Contact field is required </p>');
	// 				$('#clientContact').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#clientContact').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(paid == "") {
	// 				$("#paid").after('<p class="text-danger"> The Paid field is required </p>');
	// 				$('#paid').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#paid').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(discount == "") {
	// 				$("#discount").after('<p class="text-danger"> The Discount field is required </p>');
	// 				$('#discount').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#discount').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(paymentType == "") {
	// 				$("#paymentType").after('<p class="text-danger"> The Payment Type field is required </p>');
	// 				$('#paymentType').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#paymentType').closest('.form-group').addClass('has-success');
	// 			} // /else

	// 			if(paymentStatus == "") {
	// 				$("#paymentStatus").after('<p class="text-danger"> The Payment Status field is required </p>');
	// 				$('#paymentStatus').closest('.form-group').addClass('has-error');
	// 			} else {
	// 				$('#paymentStatus').closest('.form-group').addClass('has-success');
	// 			} // /else


	// 			// array validation
	// 			var productName = document.getElementsByName('productName[]');				
	// 			var validateProduct;
	// 			for (var x = 0; x < productName.length; x++) {       			
	// 				var productNameId = productName[x].id;	    	
	// 		    if(productName[x].value == ''){	    		    	
	// 		    	$("#"+productNameId+"").after('<p class="text-danger"> Product Name Field is required!! </p>');
	// 		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
	// 	      } else {      	
	// 		    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
	// 	      }          
	// 	   	} // for

	// 	   	for (var x = 0; x < productName.length; x++) {       						
	// 		    if(productName[x].value){	    		    		    	
	// 		    	validateProduct = true;
	// 	      } else {      	
	// 		    	validateProduct = false;
	// 	      }          
	// 	   	} // for       		   	
			
	// 	   	var quantity = document.getElementsByName('quantity[]');		   	
	// 	   	var validateQuantity;
	// 	   	for (var x = 0; x < quantity.length; x++) {       
	// 	 			var quantityId = quantity[x].id;
	// 		    if(quantity[x].value == ''){	    	
	// 		    	$("#"+quantityId+"").after('<p class="text-danger"> Product Name Field is required!! </p>');
	// 		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	// 	      } else {      	
	// 		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	// 	      } 
	// 	   	}  // for

	// 	   	for (var x = 0; x < quantity.length; x++) {       						
	// 		    if(quantity[x].value){	    		    		    	
	// 		    	validateQuantity = true;
	// 	      } else {      	
	// 		    	validateQuantity = false;
	// 	      }          
	// 	   	} // for       	
			

	// 			if(orderDate && clientName && clientContact && paid && discount && paymentType && paymentStatus) {
	// 				if(validateProduct == true && validateQuantity == true) {
	// 					// create order button
	// 					// $("#createOrderBtn").button('loading');

	// 					$.ajax({
	// 						url : form.attr('action'),
	// 						type: form.attr('method'),
	// 						data: form.serialize(),					
	// 						dataType: 'json',
	// 						success:function(response) {
	// 							console.log(response);
	// 							// reset button
	// 							$("#editOrderBtn").button('reset');
								
	// 							$(".text-danger").remove();
	// 							$('.form-group').removeClass('has-error').removeClass('has-success');

	// 							if(response.success == true) {
									
	// 								// create order button
	// 								$(".success-messages").html('<div class="alert alert-success">'+
	// 	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	// 	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +	            		            		            	
	// 	   		       '</div>');
									
	// 							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

	// 							// disabled te modal footer button
	// 							$(".editButtonFooter").addClass('div-hide');
	// 							// remove the product row
	// 							$(".removeProductRowBtn").addClass('div-hide');
									
	// 							} else {
	// 								alert(response.messages);								
	// 							}
	// 						} // /response
	// 					}); // /ajax
	// 				} // if array validate is true
	// 			} // /if field validate is true
				

	// 			return false;
	// 		}); // /edit order form function	
	// 	} 	

	// }); // /documernt


	// // print order function
	// function printOrder(orderId = null) {
	// 	if(orderId) {		
				
	// 		$.ajax({
	// 			url: 'http://localhost/php/stock/php_action/printOrder.php',
	// 			type: 'post',
	// 			data: {orderId: orderId},
	// 			dataType: 'text',
	// 			success:function(response) {
					
	// 				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
	//         mywindow.document.write('<html><head><title>Order Invoice</title>');        
	//         mywindow.document.write('</head><body>');
	//         mywindow.document.write(response);
	//         mywindow.document.write('</body></html>');

	//         mywindow.document.close(); // necessary for IE >= 10
	//         mywindow.focus(); // necessary for IE >= 10

	//         mywindow.print();
	//         mywindow.close();
					
	// 			}// /success function
	// 		}); // /ajax function to fetch the printable order
	// 	} // /if orderId
	// } // /print order function

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

						'<select class="form-control" name="productName[]" id="productName'+count+'" onchange="getProductData('+count+')" >'+
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
						console.log(response[productId]);
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


	// // remove order from server
	// function removeOrder(orderId = null) {
	// 	if(orderId) {
	// 		$("#removeOrderBtn").unbind('click').bind('click', function() {
	// 			$("#removeOrderBtn").button('loading');

	// 			$.ajax({
	// 				url: 'php_action/removeOrder.php',
	// 				type: 'post',
	// 				data: {orderId : orderId},
	// 				dataType: 'json',
	// 				success:function(response) {
	// 					$("#removeOrderBtn").button('reset');

	// 					if(response.success == true) {

	// 						manageOrderTable.ajax.reload(null, false);
	// 						// hide modal
	// 						$("#removeOrderModal").modal('hide');
	// 						// success messages
	// 						$("#success-messages").html('<div class="alert alert-success">'+
	// 	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	// 	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	// 	          '</div>');

	// 						// remove the mesages
	// 	          $(".alert-success").delay(500).show(10, function() {
	// 							$(this).delay(3000).hide(10, function() {
	// 								$(this).remove();
	// 							});
	// 						}); // /.alert	          

	// 					} else {
	// 						// error messages
	// 						$(".removeOrderMessages").html('<div class="alert alert-warning">'+
	// 	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	// 	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	// 	          '</div>');

	// 						// remove the mesages
	// 	          $(".alert-success").delay(500).show(10, function() {
	// 							$(this).delay(3000).hide(10, function() {
	// 								$(this).remove();
	// 							});
	// 						}); // /.alert	          
	// 					} // /else

	// 				} // /success
	// 			});  // /ajax function to remove the order

	// 		}); // /remove order button clicked
			

	// 	} else {
	// 		alert('error! refresh the page again');
	// 	}
	// }
	// // /remove order from server

	// // Payment ORDER
	// function paymentOrder(orderId = null) {
	// 	if(orderId) {

	// 		$("#orderDate").datepicker();

	// 		$.ajax({
	// 			url: '{{route("api_service")}}',
	// 			type: 'get',
	// 			data: {orderId: orderId},
	// 			dataType: 'json',
	// 			success:function(response) {				

	// 				// due 
	// 				$("#due").val(response.order[10]);				

	// 				// pay amount 
	// 				$("#payAmount").val(response.order[10]);

	// 				var paidAmount = response.order[9] 
	// 				var dueAmount = response.order[10];							
	// 				var grandTotal = response.order[8];

	// 				// update payment
	// 				$("#updatePaymentOrderBtn").unbind('click').bind('click', function() {
	// 					var payAmount = $("#payAmount").val();
	// 					var paymentType = $("#paymentType").val();
	// 					var paymentStatus = $("#paymentStatus").val();

	// 					if(payAmount == "") {
	// 						$("#payAmount").after('<p class="text-danger">The Pay Amount field is required</p>');
	// 						$("#payAmount").closest('.form-group').addClass('has-error');
	// 					} else {
	// 						$("#payAmount").closest('.form-group').addClass('has-success');
	// 					}

	// 					if(paymentType == "") {
	// 						$("#paymentType").after('<p class="text-danger">The Pay Amount field is required</p>');
	// 						$("#paymentType").closest('.form-group').addClass('has-error');
	// 					} else {
	// 						$("#paymentType").closest('.form-group').addClass('has-success');
	// 					}

	// 					if(paymentStatus == "") {
	// 						$("#paymentStatus").after('<p class="text-danger">The Pay Amount field is required</p>');
	// 						$("#paymentStatus").closest('.form-group').addClass('has-error');
	// 					} else {
	// 						$("#paymentStatus").closest('.form-group').addClass('has-success');
	// 					}

	// 					if(payAmount && paymentType && paymentStatus) {
	// 						$("#updatePaymentOrderBtn").button('loading');
	// 						$.ajax({
	// 							url: 'http://localhost/php/stock/php_action/editPayment.php',
	// 							type: 'post',
	// 							data: {
	// 								orderId: orderId,
	// 								payAmount: payAmount,
	// 								paymentType: paymentType,
	// 								paymentStatus: paymentStatus,
	// 								paidAmount: paidAmount,
	// 								grandTotal: grandTotal
	// 							},
	// 							dataType: 'json',
	// 							success:function(response) {
	// 								$("#updatePaymentOrderBtn").button('loading');

	// 								// remove error
	// 								$('.text-danger').remove();
	// 								$('.form-group').removeClass('has-error').removeClass('has-success');

	// 								$("#paymentOrderModal").modal('hide');

	// 								$("#success-messages").html('<div class="alert alert-success">'+
	// 			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	// 			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	// 			          '</div>');

	// 								// remove the mesages
	// 			          $(".alert-success").delay(500).show(10, function() {
	// 									$(this).delay(3000).hide(10, function() {
	// 										$(this).remove();
	// 									});
	// 								}); // /.alert	

	// 			          // refresh the manage order table
	// 								manageOrderTable.ajax.reload(null, false);

	// 							} //

	// 						});
	// 					} // /if
							
	// 					return false;
	// 				}); // /update payment			

	// 			} // /success
	// 		}); // fetch order data
	// 	} else {
	// 		alert('Error ! Refresh the page again');
	// 	}
	// }
</script>