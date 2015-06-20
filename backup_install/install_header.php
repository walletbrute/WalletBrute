<html>

<head>
<title>
<?php echo "Install Process"; ?>
</title>
<link rel="shortcut icon" href="../includes/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="'../includes/images/favicon.ico" type="image/x-icon">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>-->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->

<script src="../includes/js/bootstrap-tabs-x.min.js"></script>
<script src="../includes/js/main.js"></script>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="../includes/css/bootstrap-tabs-x.min.css">
<link rel="stylesheet" type="text/css" href="../includes/css/main.css">


<script>
$( document ).ready(function() {
	
	// Fade In Loader
	setTimeout("$('#wrapper_loader').hide()",500);
	setTimeout("$('#wrapper').slideDown()",800);

});
</script>

</head>
<body>

<div id="wrapper_loader" style="width:100%;margin-top:100px;">
	<div style="text-align:center;">
		<img src="../includes/images/loader.gif" style="text-align:center;height:400px;">
	</div>
</div>

<div id="wrapper" style="display:none;">
	
<div id="error_log" style="width:100%;font-size:.8em;"></div>

<a href="/" style="text-decoration:none;color:#000;font-weight:bold;"><img src="../includes/images/logo_long.png" style="max-width:500px;width:100%;margin-left:-3px;"></a>
<div id="visitor_information_header" style="float:right;text-align:right;">
	<?php echo date('l F jS Y').' <span id="clock"></span><br />'; ?>
</div>
<br/>
<h2>Welcome to the install process. Please complete all of the tabs below.</h2>
<p style="font-style:italic;">The current version is: <span style="font-weight:bold;border-bottom:1px dashed #000;background-color:#ddd;"><?php echo appCurVer(); ?></span>. You can check your version in the bottom right hand corner. If the hash doesn't match, you don't have the latest version.</p>

<script>
// The Clock
setInterval('updateClock()', 1000);
</script>	

<div style="">

