<?php
##################################
##### Chatbox details below ######
##### Version 0.5			######
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

## Number of messages to load at once ##
$load_limit = 25;

## Allow anonymous users to chat? ##
$anonymous_chatters = true;

## Max number of comments on user pages ##
$max_user_comments = 25;

##################################
##### Chatbox details above ######
##################################

$url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$r = pathinfo($url);

if(file_exists("install.php") && $r['filename'] != "install") {
	header('location: install.php');
}
try {
	$dsn = 'mysql:host=' . $dbhostname . ';dbname=' . $dbdatabase;
	$db = new PDO($dsn, $dbusername, $dbpassword);
	$db_error = false;
} catch (Exception $e) {
	$db_error = true;
	if($r['filename'] != "install")
		header('location: install.php');
}
?>