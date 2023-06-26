$(document).ready(function(){
	categorylist();

	function categorylist(){
		$('#category').DataTable({
			dom: "<'row mb-3'<'col-md-4 mb-3 mb-md-0'l><'col-md-8 text-right'<'d-flex justify-content-end'f<'ms-2'B>>>>t<'row align-items-center'<'mr-auto col-md-6 mb-3 mb-md-0 mt-n2 'i><'mb-0 col-md-6'p>>",
			lengthMenu: [ 10, 20, 30, 40, 50 ],
			responsive: true,
			buttons: [
				{ extend: 'print', className: 'btn btn-default btn-sm' },
				{ extend: 'csv', className: 'btn btn-default btn-sm' }
			]
		});
	}

	checkValidation('.category-modal');

	function categoryListNew(){
		var table = $('#category').DataTable({
			responsive: true,
			buttons: [
				{ extend: 'print', className: 'btn btn-default btn-sm' },
				{ extend: 'csv', className: 'btn btn-default btn-sm' }
			],
	    	"serverSide": true,
			//"stateSave": true,
			"paging": true,
	    	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	    	"order": [[ 0, "desc" ]],
			"dom": "<'row mb-3'<'col-md-4 mb-3 mb-md-0'l><'col-md-8 text-right'<'d-flex justify-content-end'f<'ms-2'B>>>>t<'row align-items-center'<'mr-auto col-md-6 mb-3 mb-md-0 mt-n2 'i><'mb-0 col-md-6'p>>",
			"pageLength": 25,	
			"ordering"   :false,
	        "processing": true,
	        "ajax":{
		     	"url": base +"Category/categoryList",
		     	"dataType": "json",
		     	"type": "POST",
		    },
	    	"columns": [
		        { "data": "sr" },
		        { "data": "title" },
		        { "data": "code" },
		        { "data": "desc" },
		        { "data": "status" },
		        { "data": "Action" },
		    ]	 

	    });
	}

	$(document).on('click', '.add-category', function(){
		$('.category-modal').modal('show');
		$('.save').data('type', 'add');
		$('.save').text('Save');
	});

	$(document).on('click', '.edit-category', function(){
		$('.category-modal').modal('show');
		$('.save').data('type', 'update');
		$('.save').text('Update');

		$('.category_id').val($(this).data('category_id'));
		$('.title').val($(this).data('title'));
		$('.code').val($(this).data('code'));
		$('.desc').val($(this).data('desc'));
	});

	$(document).on('click', '.save', function(){
		var model = $(".category-modal");
		var validate = checkValidation(model);
		if (validate) {
			var type = $(this).data('type');
			var category_id = $('.category_id').val();
			var title = $('.title').val();
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
				url: base + "category/add",
				type: "POST",
				data: mydata,        
				success: function(data) {
				    if (data.success) {
					    new PNotify({title: notify_title, text: notify_text,type: 'success'});
					    table.ajax.reload();
					    $(".category-modal").modal('hide');	
					} else {
						new PNotify({title: '', text: data.msg, type: 'error'});
						$('.code').addClass('is-invalid');
					}
				}
			});		
		}

	});

	$('.category-modal').on('hidden.bs.modal', function (e) {
	    $('.category_id').val('');
	    $('.title').val('');
	    $('.code').val('');
	    $('.desc').val('');
	});

});