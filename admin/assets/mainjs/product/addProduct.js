$(document).ready(function() {

	function option_values(){
		var values = '';
		var optionValues = $('.option-values').find('.tagit-choice');
		var length = optionValues.length;
		var counter = 1;
		optionValues.each(function() {
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
		$('.option_values').val(values);
	}
	$(document).on('all', '.ui-autocomplete-input', function(){
		option_values();
	})
})