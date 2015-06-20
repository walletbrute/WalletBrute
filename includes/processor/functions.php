<?php
function appVersion() {
    system('git log --pretty=format:"%h" -n 1');
}
function appDevStatus() {
	system('git log -40 --pretty=format:"%h - %cd : %s" --date=short');
}
function appCurVer() {
	system('git log -1 --pretty=format:"%h"');
}
?>
