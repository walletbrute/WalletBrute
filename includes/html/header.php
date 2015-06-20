<?php
	include('includes/config.php');
	include(APP_INCLUDES.'/processor/functions.php');
	system('php '.APP_INCLUDES.'/processor/cron.php');
?>
<html>

<head>
<title>
<?php echo APP_TITLE; ?>
</title>
<link rel="icon" href="<?php echo APP_IMAGES; ?>/favicon.ico">
<link rel="shortcut icon" href="<?php echo APP_IMAGES; ?>/favicon.ico" />


<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script src="<?php echo APP_JS; ?>/bootstrap-tabs-x.min.js"></script>
<script src="<?php echo APP_JS; ?>/main.js"></script>
<script src="<?php echo APP_JS; ?>/jquery.ui.widget.js"></script>
<script src="<?php echo APP_JS; ?>/jquery.iframe-transport.js"></script>
<script src="<?php echo APP_JS; ?>/ion.sound.min.js"></script>
<script src="<?php echo APP_JS; ?>/bitcoinjs-min.js"></script>
<script src="<?php echo APP_JS; ?>/qrcode.js"></script>
<script src="<?php echo APP_JS; ?>/rfc1751.js"></script>
<script src="<?php echo APP_JS; ?>/mnemonic.js"></script>
<script src="<?php echo APP_JS; ?>/armory.js"></script>
<script src="<?php echo APP_JS; ?>/electrum.js"></script>
<script src="<?php echo APP_JS; ?>/tx.js"></script>
<script src="<?php echo APP_JS; ?>/bitcoinsig.js"></script>
<script src="<?php echo APP_JS; ?>/secure-random.js"></script>
<script src="<?php echo APP_JS; ?>/asn1.js"></script>
<script src="<?php echo APP_JS; ?>/brainwallet.js"></script>
<script src="<?php echo APP_JS; ?>/jquery.fileupload.js"></script>
<script src="<?php echo APP_JS; ?>/jquery.flot.js"></script>


<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo APP_CSS; ?>/bootstrap-tabs-x.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo APP_CSS; ?>/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo APP_CSS; ?>/jquery.fileupload.css">


<script>
$( document ).ready(function() {
	
	//Check Wallet Every Stroke
	$('#pass').keypress(function(e){
		var pass = $(this).val();
		var addr = $('#addr').val();
		var code = String.fromCharCode(e.which);
		checkWallet(code);		
	});


	// Load and Initialize Sounds
	ion.sound({
	    sounds: [
        	{name: "beer_can_opening"},
	        {name: "bell_ring"},
	        {name: "pop_cork"},
	        {name: "button_click_on"},
	        {name: "branch_break"},
	        {name: "button_click"}
	    ],

	    // main config
	    path: "/includes/sounds/",
	    preload: true,
	    multiplay: true,
	    volume: 1
	});

	// Setup Each Sound Event
	$(".btn").on("click", function(){
	    ion.sound.play("pop_cork");
	});
	$("a").on("click", function(){
	    ion.sound.play("pop_cork");
	});
	document.onkeypress = function (e) {
    		e = e || window.event;
	    	ion.sound.play("branch_break");
	};

	
	// Load Wallets
	showWallets();
	setInterval (function(){
		$('#wallets_found').dataTable()._fnAjaxUpdate();
	},1000);

	
	showRates();
	
	// Fade In Loader
	//setTimeout("$('#wrapper_loader').fadeOut()",1500);
	//setTimeout("$('#wrapper').fadeIn()",1600);
		
	$(function () {
	    'use strict';
	    // Change this to the location of your server-side upload handler:
	    var url = window.location.origin+'/includes/uploads/';
	    $('#fileupload').fileupload({
	        url: url,
	        dataType: 'json',
	        done: function (e, data) {
	            $.each(data.result.files, function (index, file) {
			var outputDiv = $('#files');
			outputDiv.html('');
			outputDiv.show();
	                outputDiv.append('Uploading file and renaming to '+file.name+'...\n');
	                outputDiv.append('Creating session for new temporary file '+file.name+'...\n');
	            });
	        },
	        progressall: function (e, data) {
			$('#progress').show();
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            $('#progress .progress-bar').css(
	                'width',
	                progress + '%'
	            );
	        }
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});




});
</script>

</head>
<body>

<?php include(APP_HTML.'/modals.php'); ?>

<div id="wrapper_loader" style="display:none;width:100%;margin-top:100px;">
	<div style="text-align:center;">
		<img src="<?php echo APP_IMAGES; ?>/loader.gif" style="text-align:center;height:400px;">
	</div>
</div>

<div id="wrapper" style="">
<div id="error_log" style="width:100%;font-size:.8em;"></div>

<a href="/" style="text-decoration:none;color:#000;vertical-align:bottom;"><img src="<?php echo APP_IMAGES; ?>/logo.png" style="float:left;max-height:50px;margin-right:5px;margin-top:5px;"><span style="font-size:3em;font-weight:bolder;color:#000;border-bottom:1px solid #265a88;"><?php echo APP_TITLE; ?></span></a>

<div id="visitor_information_header" style="float:right;text-align:right;">
	<?php echo date('l F jS Y').' <span id="clock"></span><br />'; ?>
	<div  style="border-top:1px solid #eee;padding-top:10px;">
		<table id="visitor_information_data" style="font-size:.8em;text-align:right;width:100%;border-collapse:collapse;border-spacing:0;" cellpadding="0" cellspacing="0"></table>
		<br />
		<table id="visitor_information_bitcoin" style="font-size:.8em;text-align:right;width:100%;border-collapse:collapse;border-spacing:0;margin-bottom:10px;" cellpadding="0" cellspacing="0"></table>
	</div>
</div>
<br />
<!--<h2>May the odds be with you...</h2>-->

<script>
// The Clock
setInterval('updateClock()', 1000);
// Get Visitor Location Data
$.get("//www.telize.com/geoip?callback=?", function(response) {
	var ip = response.ip;
	var city = response.city;
	var region = response.region;
	var country = response.country;
	var countryCode = response.country_code3;
	var flagCode = response.country_code.toLowerCase();
	var postal = response.postal_code;
	var isp = response.isp;
	var timezone = response.timezone;
	$('#visitor_information_data').append('<tr><td class="left">IP Address</td><td><span class="visitorInfo">'+ip+'</span></td></tr>');
	$('#visitor_information_data').append('<tr><td class="left">Service Provider</td><td><span class="visitorInfo">'+isp+'</span></td></tr>');
	//$('#visitor_information_data').append('<tr><td class="left">Your City</td><td><span class="visitorInfo">'+city+'</span></td></tr>');
	//$('#visitor_information_data').append('<tr><td class="left">Your Sate</td><td><span class="visitorInfo">'+region+'</span></td></tr>');
	//$('#visitor_information_data').append('<tr><td class="left">Your ZIP</td><td><span class="visitorInfo">'+postal+'</span></td></tr>');
	$('#visitor_information_data').append('<tr><td class="left">Your Country</td><td><span class="visitorInfo">'+country+'</span></td></tr>');
	$('#visitor_information_data td, #visitor_information_data tr').css('vertical-align','bottom').css('padding','0').css('margin','0');
	// Get Currency for Supplied Country
	$.getJSON("//restcountries.eu/rest/v1/alpha/"+countryCode, function(currency) {
		$('#visitor_information_bitcoin').append('<tr><td class="left">Your Currency</td><td rowspan="2"><img id="flag" style="height:20px;"></td><td><span class="visitorInfo">'+currency.currencies[0]+' <span id="currencyName"></span></span></td><td rowspan="2"></tr>');
		// Get Bitcoin Exchange Rate for Supplied Country
		$.getJSON("//bitpay.com/api/rates/"+currency.currencies[0], function(data) {
		    var rate = data.rate;
		    var name = data.name;
		    $('#currencyName').html("("+name+")");
			$('#visitor_information_bitcoin').append('<tr><td class="left">Your Exchange Rate</td><td><span class="visitorInfo">'+rate+'</span></td></tr>');
			var flag = "includes/images/flags/"+flagCode+".png";
			$('#flag').attr('src',flag);
		});
	});
}, "jsonp");

</script>	

<div style="">
