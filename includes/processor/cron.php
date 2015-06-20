<?php
//Includes from PHP App, Don't Need the DB Stuff, Just Globals
require(dirname(__FILE__).'/../config.php');
require(dirname(__FILE__).'/functions.php');


//Update DEV temp/log.html
appDevStatus();




//Update the RATES file.
system('mkdir '.APP_DIR_TEMP);


//The Actual Cron Jobs Here,
//May Break File Apart into Daily, Weekly, Hourly Etc..
//For Now All in This File for Daily


//Get Exchange Rates
//Enable NON Logged Update
system('cd '.APP_DIR_TEMP.'/ && rm rates; wget https://bitpay.com/api/rates');
//Enable Logged Update
//system('cd '.APP_DIR_TEMP.'/ && rm rates; wget https://bitpay.com/api/rates 2>>'.APP_LOG);

//Format for our Javascript
$rates = str_replace("]","",str_replace("[","",shell_exec('cat '.APP_DIR_TEMP.'/rates')));
$ratesRev1 = str_replace("}","]",str_replace("{","[",$rates));
$ratesRev2 = '{"data":['.$ratesRev1.']}';
$ratesRev3 = str_replace('"code":','',str_replace('"name":','',str_replace('"rate":','',$ratesRev2)));
$ratesRevised = str_replace('["BTC","Bitcoin",1],','',$ratesRev3);
shell_exec('rm '.APP_DIR_TEMP.'/rates');
$ratesFile = fopen(APP_DIR_TEMP."/rates", "w") or die("Unable to open file!");
$content = $ratesRevised;
fwrite($ratesFile, $content);
fclose($ratesFile);

?>
