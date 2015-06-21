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
		//echo 'guess: '.$guess.' guessAddr: '.$guessAddr.' private: '.$private.' public: '.$public.' balance: '.$balance.' received: '.$received;
		$con = mysqli_connect(APP_SQL_HOST,APP_SQL_USER,APP_SQL_PASS);
		mysqli_select_db($con,APP_SQL_DB);
		$query = "SELECT * FROM wallets_found WHERE private_key = '$private'";
		$select_result = mysqli_query($con,$query);
		$query="INSERT INTO wallets_found (private_key, public_key, wallet_address, dictionary_word, current_balance, received_bitcoins, last_updated, wallet_exists) VALUES ('$private','$public','$guessAddr','$guess','$balance','$received','$timestamp','$exists') ON DUPLICATE KEY UPDATE current_balance=VALUES(current_balance), received_bitcoins=VALUES(received_bitcoins), last_updated=VALUES(last_updated), wallet_exists=VALUES(wallet_exists)";
		mysqli_query($con,$query);
		$id = mysqli_insert_id();
		mysqli_commit($con);
		mysqli_close($con);
	break;

	// Check Wallet Batch
	case "checkWalletBatch":
	break;


}


?>
