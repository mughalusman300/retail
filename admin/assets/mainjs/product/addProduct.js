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
		keywords();
	})

})