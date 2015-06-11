<?php
include 'config.php';

/* Establish MySQL connection */
$mysqli = new mysqli($host, $username, $password, $database);
if ($mysqli->connect_error) { 
	/* Error if connection is not established */
   die('Connect Error (' . $mysqli->connect_errno . ') '
   . $mysqli->connect_error);
}

$mysqli->set_charset("utf8");

?>
