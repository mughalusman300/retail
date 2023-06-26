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

});