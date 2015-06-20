<?php
include(dirname(__FILE__).'/../config.php');
function appVersion() {
    system('git log --pretty=format:"%h" -n 1');
}
function appDevStatus() {
	system("git log -n 40 --graph --pretty=format:'%Cred%h%Creset - %s %Cgreen(%cr) %C(bold blue)<%an>%Creset' --abbrev-commit -- | ".APP_INCLUDES."/bin/ansi2html.sh > ".APP_INCLUDES."/temp/log.html");
}
function appCurVer() {
	system('git log -1 --pretty=format:"%h"');
}
// Function for basic field validation (present and neither empty nor only white space
function IsNullOrEmptyString($question){
    return (!isset($question) || trim($question)==='');
}
?>
