$(document).ready(function(){
	$( '.select2' ).select2( {
	    theme: "bootstrap-5",
	    selectionCssClass: "select2--small",
	    dropdownCssClass: "select2--small",
	});
	$(document).on('select2:open', () => {
		document.querySelector('.select2-search__field').focus();
	});	
	$(document).on('change', '.product_id', function() {
		var product_id = $('.product_id').val();
		if (product_id != '') {
			var mydata = {product_id: product_id};
			$.ajax({
				url: base + "/Inventory/inv_section",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
				    	$('.response').html(data.html);
					} else {
						$('.response').html('');
					}
				}
			});	

		} else {

		}
	});

	$(document).on('change', '.purch_total_price', function() {
		var total_price = $(this).val();
		if (total_price != '') {
			total_price = parseInt(total_price);
			var sale_qty = $('.sale_qty').val();
			if (sale_qty !='') {
				var sale_unit_cost = parseFloat((total_price/sale_qty).toFixed(2));
				$('.sale_unit_cost').val(sale_unit_cost);
			} else {
				$('.purch_total_price').val('');
				$('.sale_unit_cost').val('');
				$('.sale_unit_price').val('');
				Swal.fire('', 'Please add purchase qty first!', 'warning');
			}
		} else {
			$('.sale_unit_cost').val('');
			$('.sale_unit_price').val('');
		}
	});

	$(document).on('keyup', '.barcode', function(e){
		// var validate = checkValidation('.inventory-in-form');
		validate = true; //remove temporary added
		if (validate) {
			var v1 = "", v2 = "", v3 = "";
			var barcode = $('.barcode').val();
			var product_id = $('.product_id').val();
			var sale_unit_price = $('.sale_unit_price').val();
			if ($('.v1').is(':visible')) {
				v1 = $('.v1').val();
			}
			if ($('.v2').is(':visible')) {
				v2 = $('.v2').val();
			}
			if ($('.v3').is(':visible')) {
				v3 = $('.v3').val();
			}
			var mydata = {barcode: barcode, product_id: product_id, v1: v1, v2: v2, v3: v3, sale_unit_price: sale_unit_price};

			var keyCode = e.which;
			if (barcode !='' && keyCode == 13) {
				$.ajax({
					url: base + "/inventory/validateBarcode",
					type: "POST",
					'async': false,
					data: mydata,        
					success: function(data) {
					    if (data.success) {
						    Swal.fire('', data.msg, 'info');
						} else {
							Swal.fire('', data.msg, 'error');
							$('.barcode').val('');
						}
					}
				});	
			}
		} else {
			Swal.fire('', 'Fill all the required fields first!', 'error');
			$('.barcode').val('');
		}
	});

	$(document).on('click', '.save', function(e){

		var validate = checkValidation('.inventory-in-form');
		if (validate) {
			
			var formdata = new FormData( $("#inventory-in-form")[0] );
			$.ajax({
				url: base + "/inventory/create",
				type : 'post',
				'async': true,
				'processData': false,  // tell jQuery not to process the data
				'contentType': false,  // tell jQuery not to set contentType
				data: formdata,        
				success: function(data) {
				    if (data.success) {
				    	location.reload(true);
				    	// let insert_id = data.insert_id;
				    	// let url = base + "/inventory/product_barcode/"+ insert_id +""; 
				    	// var win = window.open(url, '_blank');
					    // Swal.fire(notify_title, notify_text, 'success');
					} else {
						Swal.fire('', data.msg, 'error');
					}
				}
			});	

		} else {
			return false;
		}

	});


	$(document).on('change', '.purch_qty', function(){
		var purch_qty = $(this).val();
		var p_to_i = $('#p_to_i').val();
		var small_unit_qty = $('#small_unit_qty').val();

		if (p_to_i == '*') {
			$('.inv_qty').val(purch_qty * small_unit_qty);
		} else {
			$('.inv_qty').val(purch_qty / small_unit_qty);
		}

		var inv_qty = $('.inv_qty').val();
		var i_to_s = $('#i_to_s').val();
		var inv_small_unit_qty = $('#inv_small_unit_qty').val();

		if (i_to_s == '*') {
			$('.sale_qty').val(inv_qty * inv_small_unit_qty);
		} else {
			$('.sale_qty').val(inv_qty / inv_small_unit_qty);
		}


	});
});