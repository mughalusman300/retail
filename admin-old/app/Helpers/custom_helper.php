<?php
	
	function month_year_custom($month_year) {
	    if ($month_year != "") {
	    	$month_year = "01-".$month_year;
	        $month_year = date_create($month_year);
	        $month_year = date_format($month_year,"F Y");
	    }
	    return $month_year; 
	}

	function ddd($array, $die = 1, $comment = "") {
		if ($comment !='') {
			echo "<pre>" . $comment. ': '; print_r($array);
		} else {
			echo "<pre>"; print_r($array);
		}
		if ($die) {
			die;
		}
	}
?>