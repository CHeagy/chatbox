<?php
##################################
##### Chatbox details below #####
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
##### Chatbocx details above #####
##################################

$dsn = 'mysql:host=' . $dbhostname . ';dbname=' . $dbdatabase;
$db = new PDO($dsn, $dbusername, $dbpassword);
?>