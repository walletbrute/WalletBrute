<?php

	//Check for a Completed Setup File

	if (file_exists('includes/config.php')) {
	} else {
		header('Location: /install/install.php');
	}

	$start_time = microtime(TRUE);
	include('includes/html/header.php'); 

	echo '<div id="wrapper_main">';
	include('includes/html/main.php');
	echo '</div>';

	include('includes/html/footer.php');
 
	echo '<div style="text-align:center;margin-bottom:10px;">';		 
	$end_time = microtime(TRUE);		 
	$time_taken = $end_time - $start_time;		 
	$time_taken = round($time_taken,5);		 
	echo '<span style="color:#fff;display:none;" style="display:none;" id="loadTime">Page generated in '.$time_taken.' seconds.</span>';		 
	echo '</div>';
?>
