<?php
##################################
##### Chatbox details below ######
##################################

## Username ##
$dbusername = "username";

## Password ##
$dbpassword = "password";

## Hostname ##
$dbhostname = "localhost";

## Database ##
$dbdatabase = "chat";

## Base site ##
$baseurl = "http://sites.local/chatbox/";

##################################
##### Chatbox details above ######
##################################

$url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$r = pathinfo($url);

if(file_exists("install.php") && $r['filename'] != "install") {
	header('location: install.php');
}

$dsn = 'mysql:host=' . $dbhostname . ';dbname=' . $dbdatabase;
$db = new PDO($dsn, $dbusername, $dbpassword);
?>