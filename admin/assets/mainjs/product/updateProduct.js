$(document).ready(function() {

	var tagitInstance = $("#tags").data("ui-tagit");
	// Add the new tags
	for (var i = 0; i < saved_tags.length; i++) {
	  tagitInstance.createTag(saved_tags[i]);
	}


	function keywords(){
		var values = '';
		var keywordsValues = $('.keywords-ul').find('.tagit-choice');
		var length = keywordsValues.length;
		var counter = 1;
		$('.variant-tbody').html('');
		keywordsValues.each(function() {
			var value = $(this).find('.tagit-label').text();
			if (value != '') {
				if(counter < length) {
					values += value + ',';
				} else {
					values += value;
				}
			}
			counter++;
		});

		$('.keywords').val(values);
	}
	
	$(document).on('click', '.save', function(){	
		keywords();

		console.log($('.keywords').val());
		var validate = checkValidation('.add-product');
		if(!validate) {
			return false;
		}
	});

	$(document).on('click', '.add-more-image', function(){
		var html = `<div class="row mb-3">
						<div class="col-2 text-center">
							<div class="form-check form-switch mt-1">
                            	<input type="checkbox" class="form-check-input default" name="default" value="1">
								<input type="hidden" class="default_image" name="default_image[]" value="">
                        	</div>
						</div>

						<div class="col-10 upload-row text-end">
							<div class="img-col">
								<img  class="img-preview product-img-preview" style="display: none;" title="Click here to remove this file" src="">
							</div>
							<button
								style="display: none;" 
								type="button" 
								class="btn btn-sm btn-danger remove-img mt-1"
								data-attachment_id=""
							>
								Delete
							</button>
							<input type="file" name="product_img[]" id="product_img" placeholder=" Attachments" class="form-control attachment-file  product_img" accept="gif, .jpg, .png," style="display: none">

							<button type="button" class=" btn btn-default btn-browse form-control ">
			                    <i class="fa fa-cloud-upload"></i>
			                    Uploade Image           
			                </button>
						</div>
					</div>`;

		$('.image-parent-div').append(html);
	});

	$(document).on('change',".default",function (e) {
		$('.default_image').val('');

		if ($(this).prop("checked", true)) {
			$(this).closest('div').find('.default_image').val(1);
		}

		$('.default').prop('checked', false);
		$(this).prop("checked", true);
	});
	$(document).on('click',".img-preview",function (e) {
		var selector = $(this);

		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  	if (result.isConfirmed) {
       			selector.parents('.upload-row').find('.attachment-file').val('');
       			selector.parents('.upload-row').find('.btn-browse ').show();
	            selector.hide();
		  	}
		})

	});

	$(document).on('click',".remove-img",function (e) {
		var selector = $(this);
		var attachment_id = selector.data('attachment_id');

		if (attachment_id != '') {
			Swal.fire({
			  title: 'Are you sure?',
			  text: "Image will be delete Permanently",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  	if (result.isConfirmed) {
	       			
			  	}
			})
		} else {
			selector.find('.main-row').remove();
		}

	});

	$(document).on('click',".img-preview",function (e) {
		var selector = $(this);

		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  	if (result.isConfirmed) {
       			selector.parents('.upload-row').find('.attachment-file').val('');
       			selector.parents('.upload-row').find('.btn-browse ').show();
	            selector.hide();
		  	}
		})

	});

})