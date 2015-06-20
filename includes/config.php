<?php
//Start Install 
//Start Set by User

//Basic Settings
define("APP_DOMAIN","www.walletbrute.com");
define("APP_TITLE","WalletBrute.com");
define("APP_DIR","/web/walletbrute.com");
define("APP_PYTHON","/usr/bin/python");

//Database Settings
define("APP_SQL_USER","bitcoin");
define("APP_SQL_PASS","b1tc01n");
define("APP_SQL_DB","walletbrute");
define("APP_SQL_HOST","127.0.0.1");

//End Set by User

//Start Set by App

//Misc Settings
define("APP_LOG",APP_DIR."/includes/logs/main.log");
define("APP_DIR_RUN",APP_DIR."/includes/app");
define("APP_DIR_TEMP",APP_DIR."/includes/temp");

//Resource Locations
define("APP_INCLUDES",APP_DIR."/includes");
define("APP_HTML",APP_DIR."/includes/html");
define("APP_IMAGES","//".APP_DOMAIN."/includes/images");
define("APP_CSS","//".APP_DOMAIN."/includes/css");
define("APP_JS","//".APP_DOMAIN."/includes/js");

//End Set by App


//End Install 
?>
