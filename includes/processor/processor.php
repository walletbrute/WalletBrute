<?php
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
		);

		// Send Response
		echo json_encode(
		    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
		);
	break;

	// Check Wallet
	case "checkWallet":
		// Need to Write Passphrase to Temp File and Process with Python App, then Echo the Result
		echo '<pre style="font-size:.8em">';
		// Start Single Entry Processor
		// Generate Random Number for Session
		$random = mt_rand();
		$file = APP_DIR."/includes/uploads/files/".$random;
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current .= $_GET['phrase'];
		// Write the contents back to the file
		file_put_contents($file, $current);

		//Create the System Command for the Core Python App
		//$command = "cd ".APP_DIR_RUN." && ".APP_PYTHON." app.py -d ".$file." -o found.txt -t blockchaininfo 2>&1";
		//system($command);
		//$commandCrossToss = "cd ".APP_DIR_RUN." && ".APP_PYTHON." app.pyo -d ".$file." -o found.txt -t blockchaininfo 2>&1";
		//system($commandCrossToss);

		//Remove temp files
		echo "Removing temporary file ".$random."...";
		system('rm -rf '.$file);
		echo '</pre>';
	break;

	// Check Wallet Batch
	case "checkWalletBatch":
	break;


}


?>
