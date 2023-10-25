$(document).ready(function() {

	function option_values(){

		setTimeout(function(){
			var values = '';
			var optionValues = $('.option-values-ul').find('.tagit-choice');
			var length = optionValues.length;
			var counter = 1;
			$('.variant-tbody').html('');
			optionValues.each(function() {
				var value = $(this).find('.tagit-label').text();
				if (value != '') {
					var variant_html = setVariantHtml(value);
					$('.variant-tbody').append(variant_html);
					if(counter < length) {
						values += value + ',';
					} else {
						values += value;
					}
				}
				counter++;
			});
			$('.option_values').val(values);

		},300);
	}
	
	$( ".option-values-ul .ui-autocomplete-input" ).focusout(function() {
		option_values();
	});
	$( ".option-values-ul .ui-autocomplete-input" ).keydown(function(event) {
		if (event.keyCode == 9 || event.keyCode == 32 || event.keyCode == 13 || event.keyCode == 8) {
			option_values();
		}
	});

	$(document).on('click', '.option-values-ul .tagit-close', function(){	
		console.log('in');
		$(this).closest('li').remove();
		option_values();
	});

	function setVariantHtml(value) {
		var html = `<tr>
						<td class="align-middle">
							<div class="form-check">
								<input type="checkbox" name="variant[0][enabled]" id="variant_0_enabled" value="1" checked class="form-check-input">
								<label class="form-check-label">&nbsp;</label>
							</div>
						</td>
						<td class="align-middle">
							<span class="text-theme">${value}</span>
						</td>
						<td><input type="text" class="form-control dashspecialvalidation" value="" placeholder="#SKU000001"></td>
						<td><input type="text" class="form-control twodecimel" value="" placeholder="0.00"></td>
						<td><input type="text" class="form-control number" value="" placeholder="0"></td>
					</tr>`;
		return html;
	}



	function keywords(){

		setTimeout(function(){
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

		},100);
	}
	
	$(document).on('click', '.save', function(){	
		console.log('ttdd');
		keywords();
		console.log('dd');
		var validate = checkValidation('.add-product');
	});

	$(document).on('click', '.add-more-image', function(){
		var html = `<div class="row mb-3">
							<div class="col-2 text-center">
								<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
							</div>

							<div class="col-10 upload-row">
								<div style="width: 92%" class="img-col">
									<img  class="img-preview product-img-preview" style="display: none;" title="Click here to remove this file" src="">
								</div>
								<input type="file" name="pro_image_a" id="pro_image_a" placeholder=" Attachments" class="form-control attachment-file " accept="gif, .jpg, .png," style="display: none">

								<button type="button" class=" btn btn-default btn-browse form-control ">
				                    <i class="fa fa-cloud-upload"></i>
				                    Uploade Image             
				                </button>
							</div>
						</div>`;

		$('.image-parent-div').append(html);
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