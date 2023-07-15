$(document).ready(function(){
	productList();

	function productList(search =''){
		var table = $('#product').DataTable({
			"rowCallback": function( row, data ) {
				$('td:eq(0)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(3)', row).addClass('align-middle');
				$('td:eq(4)', row).addClass('align-middle');
				$('td:eq(5)', row).addClass('align-middle');
			},
			responsive: false,
			// buttons: [
			// 	{ extend: 'print', className: 'btn btn-default btn-sm' },
			// 	{ extend: 'csv', className: 'btn btn-default btn-sm' }
			// ],
			"searching": false,
	    	"serverSide": true,
			//"stateSave": true,
			"paging": true,
			"lengthChange": false,
	    	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	    	"order": [[ 0, "desc" ]],
			"pageLength": 25,	
			"ordering"   :false,
	        "processing": true,
	        "ajax":{
		     	"url": base +"/product/productList",
		     	"dataType": "json",
		        "data":{ search: search, is_active: '' },
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "check" },
		        { "data": "product" },
		        { "data": "product_code" },
		        { "data": "category_title" },
		        { "data": "status" },
		        { "data": "Action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '10px' },
	        	{ targets: 1, width: '400px' },
	        	{ targets: 2, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        	{ targets: 5, width: '200px' },
	        ]
	    });
	}

	activeProductList();
	function activeProductList(search =''){
		var table = $('#active_product').DataTable({
			"rowCallback": function( row, data ) {
				$('td:eq(0)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(3)', row).addClass('align-middle');
				$('td:eq(4)', row).addClass('align-middle');
				$('td:eq(5)', row).addClass('align-middle');
			},
			responsive: false,
			// buttons: [
			// 	{ extend: 'print', className: 'btn btn-default btn-sm' },
			// 	{ extend: 'csv', className: 'btn btn-default btn-sm' }
			// ],
			"searching": false,
	    	"serverSide": true,
			//"stateSave": true,
			"paging": true,
			"lengthChange": false,
	    	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	    	"order": [[ 0, "desc" ]],
			"pageLength": 25,	
			"ordering"   :false,
	        "processing": true,
	        "ajax":{
		     	"url": base +"/product/productList",
		     	"dataType": "json",
		        "data":{ search: search, is_active: 1 },
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "check" },
		        { "data": "product" },
		        { "data": "product_code" },
		        { "data": "category_title" },
		        // { "data": "status" },
		        { "data": "Action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '10px' },
	        	{ targets: 1, width: '400px' },
	        	{ targets: 2, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        	// { targets: 5, width: '200px' },
	        ]
	    });
	}

	deactiveProductList();
	function deactiveProductList(search =''){
		var table = $('#deactive_product').DataTable({
			"rowCallback": function( row, data ) {
				$('td:eq(0)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(2)', row).addClass('align-middle');
				$('td:eq(3)', row).addClass('align-middle');
				$('td:eq(4)', row).addClass('align-middle');
				$('td:eq(5)', row).addClass('align-middle');
			},
			responsive: false,
			"searching": false,
	    	"serverSide": true,
			//"stateSave": true,
			"paging": true,
			"lengthChange": false,
	    	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	    	"order": [[ 0, "desc" ]],
			"pageLength": 25,	
			"ordering"   :false,
	        "processing": true,
	        "ajax":{
		     	"url": base +"/product/productList",
		     	"dataType": "json",
		        "data":{ search: search, is_active: 0 },
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "check" },
		        { "data": "product" },
		        { "data": "product_code" },
		        { "data": "category_title" },
		        // { "data": "status" },
		        { "data": "Action" },
		    ],
	    	"columnDefs": [
	        	{ targets: 0, width: '10px' },
	        	{ targets: 1, width: '400px' },
	        	{ targets: 2, width: '200px' },
	        	{ targets: 3, width: '200px' },
	        	{ targets: 4, width: '200px' },
	        	// { targets: 5, width: '200px' },
	        ]
	    });
	}

	$(document).on('keyup','.search',function(){
			var table = $('#product').dataTable();
			table.fnDestroy();
			// $('#product').find('tbody').empty();
			var search = $(".search").val();
			productList(search);	
			// $('#category_id').val(cat).trigger('change.select2');
			// $('#mat_category').val(mat_cat).trigger('change.select2');
	});

	$(document).on('keyup','.active_search',function(){
			var table = $('#active_product').dataTable();
			table.fnDestroy();
			var search = $(".active_search").val();
			activeProductList(search);	
	});

	$(document).on('keyup','.deactive_search',function(){
			var table = $('#deactive_product').dataTable();
			table.fnDestroy();
			var search = $(".deactive_search").val();
			deactiveProductList(search);	
	});
	
	$(document).on('click', '.add-category', function(){
		$('.category-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-category', function(){
		$('.category-modal').find('.modal-title').text('Update Category');
		$('.category-modal').modal('show');
		$('.save').data('type', 'update');
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

	$(document).on('click', '#is_active', function(){
		var product_id = $(this).data('product_id');
		if ($(this).is(":checked")) {
			var is_active = 1;
			$(this).closest('.form-switch').find('label').text('Active');
		} else {
			var is_active = 0;
			$(this).closest('.form-switch').find('label').text('Deactive');
		}

		var mydata = {product_id: product_id, is_active: is_active};
		$.ajax({
			url: base + "/product/statusUpdate",
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