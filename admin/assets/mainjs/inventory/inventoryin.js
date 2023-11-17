$(document).ready(function(){
	

	$(document).on('change', '.product_id', function() {
		var product_id = $('.product_id').val();
		if (product_id != '') {
			var mydata = {product_id: product_id};
			$.ajax({
				url: base + "/Inventory/checkVariants",
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

	$(document).on('click', '.add-category', function(){
		$('.category-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-category', function(){
		$('.category-modal').find('.modal-title').text('Update Category');
		$('.category-modal').modal('show');
		$('.save').attr('data-type', 'update');
		$('.save').text('Update');

		$('.category_id').val($(this).data('category_id'));
		$('.cat_title').val($(this).data('title'));
		$('.code').val($(this).data('code'));
		$('.desc').val($(this).data('desc'));
	});

	$(document).on('click', '.save', function(){
		var validate = checkValidation('.category-modal');
		if (validate) {
			var type = $(this).data('type');
			var category_id = $('.category_id').val();
			var title = $('.cat_title').val();
			var code = $('.code').val();
			var desc = $('.desc').val();

			if (type == 'add') {
				var mydata = {type: type, title: title, code: code, desc: desc };
				var notify_title = 'Category Add';
				var notify_text = 'Category Add successfully!';
			} else {
				var mydata = {category_id: category_id, type: type, title: title, code: code, desc: desc };
				var notify_title = 'Category Update';
				var notify_text = 'Category Update successfully!';
			}

			$.ajax({
				url: base + "/category/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    $(".category-modal").modal('hide');	
					    Swal.fire(notify_title, notify_text, 'success');
					    table.ajax.reload();
					} else {
						Swal.fire('', data.msg, 'error');
						$('.code').addClass('is-invalid');
					}
				}
			});		
		}

	});

	$('.category-modal').on('hidden.bs.modal', function (e) {
		$('.category-modal').find('.modal-title').text('Add Category');
	    $('.category_id').val('');
	    $('.cat_title').val('');
	    $('.code').val('');
	    $('.desc').val('');
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
	$(document).on('click', '#is_active', function(){
		var category_id = $(this).data('category_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {category_id: category_id, is_active: is_active};
		$.ajax({
			url: base + "/category/statusUpdate",
			type: "POST",
			data: mydata,        
			success: function(data) {
			    if (data.success) {
				    Swal.fire('', data.msg, 'success');
				}
			}
		});	
	});

});