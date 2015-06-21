<?php
error_reporting(E_ALL);
// Get DB and other Includes
include( '../config.php' );
require( '../classes/datatables_ssp.php' );

// Action for Processor
$action = $_GET['action'];

switch ($action) {

    // Show Rates
    case "show_rates":
		// Send Response
		$data = file_get_contents(APP_INCLUDES.'/temp/rates');
		echo $data;		
	break;

    // Found Wallets
    case "wallets_found":
		// DB Table to Use
		$table = 'wallets_found';

		// Table's Primary Key
		$primaryKey = 'private_key';

		// Table Column Definitions
		$columns = array(
		    array( 'db' => 'dictionary_word',   'dt' => 0 ),
		    array( 'db' => 'private_key', 'dt' => 1 ),
		    array( 'db' => 'wallet_address',  'dt' => 2 ),
		    array( 'db' => 'current_balance',     'dt' => 3 ),
		    array( 'db' => 'received_bitcoins',     'dt' => 4 ),
		    array( 'db' => 'last_updated',     'dt' => 5 ),
			array( 'db' => 'wallet_exists',     'dt' => 6 ),

		);

		// Send Response
		echo json_encode(
		    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
		);
	break;

	// Check Wallet
	case "checkWallet":
		$guess = $_GET['guess'];
		$guessAddr = $_GET['guessAddr'];
		$private = $_GET['private'];
		$public = $_GET['public'];
		$balance = $_GET['balance'];
		$received = $_GET['received'];
		$exists = ucfirst($_GET['exists']);
		$timestamp = date("m-d-Y H:i:s");
		$con = mysqli_connect(APP_SQL_HOST,APP_SQL_USER,APP_SQL_PASS);
		mysqli_select_db($con,APP_SQL_DB);
		$select_result = mysqli_query($con,$query);
		$query="INSERT INTO wallets_found (private_key, public_key, wallet_address, dictionary_word, current_balance, received_bitcoins, last_updated, wallet_exists) VALUES ('$private','$public','$guessAddr','$guess','$balance','$received','$timestamp','$exists') ON DUPLICATE KEY UPDATE current_balance=VALUES(current_balance), received_bitcoins=VALUES(received_bitcoins), last_updated=VALUES(last_updated), wallet_exists=VALUES(wallet_exists)";
		mysqli_query($con,$query);
		$id = mysqli_insert_id();
		mysqli_commit($con);
		mysqli_close($con);
	break;

	// Check Wallet Batch
	case "checkWalletBatch":
		set_time_limit(0); 
		$name = $_GET['name'];

		system('mv '.APP_INCLUDES.'/uploads/files/'.$name.' '.APP_INCLUDES.'/temp/'.$name);
		system(APP_INCLUDES.'/app/run.sh '.APP_INCLUDES.'/app/check.py '.APP_INCLUDES.'/temp/'.$name.' >> '.APP_INCLUDES.'/temp/'.$name.'.html; rm '.APP_INCLUDES.'/temp/'.$name);
		
	break;

	// Check Wallet Batch Result
	case "checkWalletBatchTwo":
		set_time_limit(0); 
		$name = $_GET['name'];
		$content = "";

		$file = file_get_contents(APP_INCLUDES.'/temp/'.$name.'.html');
		//echo $file;
		$data = str_getcsv($file, "\n"); //parse the rows 
		system('echo "<br /><br /><div style=\"font-weight:bold;\">Next we lookup the balance and received transactions to the addresses. This will take some time, and there is no notification when it completes. Save session ID above to access larger jobs that are still running in the future beyond this browser session. You can enter the session ID at the very top of this page.</div><br />" >> '.APP_INCLUDES.'/temp/'.$name.'.html');
		system('echo "Starting batch address query live feed...<br /><br />" >> '.APP_INCLUDES.'/temp/'.$name.'.html');


		foreach($data as &$row) $row = str_getcsv($row, ","); //parse the items in rows
		//print_r($data);
		foreach ($data as &$record) {
			$addr = $record[2];
			$passphrase = $record[0];
			$privateKey = $record[1];
			
			$url = 'https://bitcoin.toshi.io/api/v0/addresses/'.$addr;
			$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';		
	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_USERAGENT, $agent);
			$result=curl_exec($ch);
			curl_close($ch);
			
			if($result == '{"error":"Not Found"}') {
				$existState = 'No';
			} else {
				$existState = 'Yes';
			}
			
			$object = json_decode($result,true);
			$balance = $object['balance'] / 100000000;
			$received = $object['received'] / 100000000;
			$content .= "Passphrase: <b>".$passphrase."</b><br />";
			$content .= "Private Key: <b>".$privateKey."</b><br />";
			$content .= "Address: <b>".$addr."</b><br />";
			$content .= "Balance: <b>".number_format($balance, 8, '.', '')."</b><br />";
			$content .= "Received: <b>".number_format($received, 8, '.', '')."</b><br />";
			$content .= "Active: <b>".$existState."</b><br /><br />";
			
			//START MYSQL
			$timestamp = date("m-d-Y H:i:s");
			$con = mysqli_connect(APP_SQL_HOST,APP_SQL_USER,APP_SQL_PASS);
			mysqli_select_db($con,APP_SQL_DB);
			$select_result = mysqli_query($con,$query);
			$query="INSERT INTO wallets_found (private_key, public_key, wallet_address, dictionary_word, current_balance, received_bitcoins, last_updated, wallet_exists) VALUES ('$privateKey','NULL','$addr','$passphrase','$balance','$received','$timestamp','$existState') ON DUPLICATE KEY UPDATE current_balance=VALUES(current_balance), received_bitcoins=VALUES(received_bitcoins), last_updated=VALUES(last_updated), wallet_exists=VALUES(wallet_exists)";
			mysqli_query($con,$query);
			$id = mysqli_insert_id();
			mysqli_commit($con);
			mysqli_close($con); 
			//END MYSQL  
		}
		system('echo "'.$content.'" >> '.APP_INCLUDES.'/temp/'.$name.'.html');
	break;


	// Get Status of Batch
	case "batchQuery":
		set_time_limit(0); 
		$name = $_GET['name'];

		$file = file_get_contents(APP_INCLUDES.'/temp/'.$name.'.html');
		echo $file;

	break;
	
	case "dbQuery":
		$mysqli = new mysqli(APP_SQL_HOST, APP_SQL_USER, APP_SQL_PASS, APP_SQL_DB);
		$mysqli2 = new mysqli(APP_SQL_HOST, APP_SQL_USER, APP_SQL_PASS, APP_SQL_DB);
	
		
		if ($result = $mysqli->query("SELECT * FROM wallets_found")) {
		    /* determine number of rows result set */
		    $row_cnt = $result->num_rows;
			if ($result2 = $mysqli2->query("SELECT * FROM wallets_found WHERE wallet_exists='Yes'")) {
				$row_cnt2 = $result2->num_rows;
				echo "<b>".$row_cnt."</b> Total Wallets, <b>".$row_cnt2."</b> Active";
				$result2->close();
			}
		    /* close result set */
		    $result->close();
		}
		
		/* close connection */
		$mysqli->close();
	break;	

}


?>
