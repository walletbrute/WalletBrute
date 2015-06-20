<?php include('../includes/processor/functions.php'); ?>
<?php include('../includes/html/modals.php'); ?>
<?php
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$start = $time;
	
	include('install_header.php'); 
	
	echo '<div id="wrapper_main">';
	include('install_body.php'); 
	echo '</div>';
	
	include('install_footer.php'); 
	
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$finish = $time;
	$total_time = round(($finish - $start), 4);
	echo '<div style="text-align:center;width:100%;margin-bottom:50px;">Total application load time was <span style="border-bottom:1px dashed #000;">'.$total_time.'</span> seconds.</div>';
?>

