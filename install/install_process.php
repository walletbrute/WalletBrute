<?php include('../includes/config.php'); ?>
<?php include(APP_INCLUDES.'/processor/functions.php'); ?>

<?php
$step = $_GET['step'];
switch ($step) {
    //Install Step One
    case "Install_Step_One":
    	$installDB = $_GET['installDB'];
    	$installUser = $_GET['installUser'];
    	$installPass = $_GET['installPass'];
    	$installHost = $_GET['installHost'];
		//echo $installDB.','.$installUser.','.$installPass.','.$installHost;

		// Name of the file
		$filename = 'install.sql';
		if (is_writable($filename)) {
		    echo 'The file is writable';
		} else {
		    echo "install.sql not writeable";
		    header('HTTP/1.1 500 Application Booboo');
		}
		// MySQL host
		$mysql_host = $installHost;
		// MySQL username
		$mysql_username = $installUser;
		// MySQL password
		$mysql_password = $installPass;
		// Database name
		$mysql_database = $installDB;
		
		// Connect to MySQL server
		mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error() . header('HTTP/1.1 500 Application Booboo') );
		// Select database
		mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error() . header('HTTP/1.1 500 Application Booboo') );
		
		// Temporary variable, used to store current query
		$templine = '';
		// Read in entire file
		$lines = file($filename);
		// Loop through each line
		foreach ($lines as $line)
		{
		// Skip it if it's a comment
		if (substr($line, 0, 2) == '--' || $line == '')
		    continue;
		
		// Add this line to the current segment
		$templine .= $line;
		// If it has a semicolon at the end, it's the end of the query
		if (substr(trim($line), -1, 1) == ';')
		{
		    // Perform the query
		    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . header('HTTP/1.1 500 Application Booboo') . '<br /><br />');
		    // Reset temp variable to empty
		    $templine = '';
		}
		$defaultConfig=file_get_contents('config.tmpl');
		$defaultConfig=str_replace("INSERT_APP_SQL_USER","$mysql_username",$defaultConfig);
		$defaultConfig=str_replace("INSERT_APP_SQL_PASS","$mysql_password",$defaultConfig);
		$defaultConfig=str_replace("INSERT_APP_SQL_DB","$mysql_database",$defaultConfig);
		$defaultConfig=str_replace("INSERT_APP_SQL_HOST","$mysql_host",$defaultConfig);
		file_put_contents('config.new', $defaultConfig);
		
		//Template out App.py
		$defaultApp=file_get_contents('app.tmpl');
		$defaultApp=str_replace("INSERT_DB_USER","$mysql_username",$defaultApp);
		$defaultApp=str_replace("INSERT_DB_PASS","$mysql_password",$defaultApp);
		$defaultApp=str_replace("INSERT_DB_NAME","$mysql_database",$defaultApp);
		$defaultApp=str_replace("INSERT_DB_HOST","$mysql_host",$defaultApp);
		file_put_contents('app.new', $defaultApp);		
		}			
	break;

    //Install Step Two
    case "Install_Step_Two":
    	$installTitle = $_GET['installTitle'];	
    	if(empty($installTitle)) {
	    	header('HTTP/1.1 500 Application Booboo');
    	} else {
			$defaultConfig=file_get_contents('config.new');
			
			$defaultConfig=str_replace("INSERT_APP_TITLE","$installTitle",$defaultConfig);
			
			file_put_contents('config.new', $defaultConfig);
    	}		
	break;

	//Install Step Three
	case "Install_Step_Three":
    	$installDomain = $_GET['installDomain'];	
    	$installDir = $_GET['installDir'];	
    	$installPython = $_GET['installPython'];	
    	if(empty($installDomain)) {
	    	header('HTTP/1.1 500 Application Booboo');
    	} 
    	if(empty($installDir)) {
	    	header('HTTP/1.1 500 Application Booboo');
    	} 
    	if(empty($installPython)) {
	    	header('HTTP/1.1 500 Application Booboo');
    	}     	
		$defaultConfig=file_get_contents('config.new');
		$defaultConfig=str_replace("INSERT_APP_DOMAIN","$installDomain",$defaultConfig);
		$defaultConfig=str_replace("INSERT_APP_DIR","$installDir",$defaultConfig);
		$defaultConfig=str_replace("INSERT_APP_PYTHON","$installPython",$defaultConfig);
		file_put_contents('config.new', $defaultConfig);
	break;

	//Install Step Four
	case "Install_Step_Four":		
		//Template out the Config.php
		system('mv app.new ../includes/app/app.py');
		system('mv config.new ../includes/config.php');
		system('rm -rf ../install*');
		system('chmod -R +x ../includes/app/app.py');
	break;
	
}
