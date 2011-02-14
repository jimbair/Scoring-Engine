#!/usr/bin/php

<?
$SERVICE = 'DNS';
$SERVER = '192.168.201.100';
$RECORD = 'www.legitco.ccdc'; 
$EXPECTED = '123.123.123.123';

mysql_connect('localhost','root','P@ssw0rd');
mysql_select_db('ccdc');

// Add service to db if it doesn't already exist
include "servicedbcheck.php";

// Get the contents of the URL and the MD5
$output = exec("dig +short $RECORD @$SERVER");

//print "Output was: $output\n";
//print "Expected was: $EXPECTED\n";

// Update attempt count
$query = "UPDATE services SET attempts = attempts + 1 WHERE name = '$SERVICE'";
mysql_query($query);

// If the hashes match, update the success counter
if ($output == $EXPECTED)
{
	$query = "UPDATE services SET success = success + 1 WHERE name = '$SERVICE'";
	mysql_query($query);
	$query = "UPDATE services SET lastcheck = 1 WHERE name = '$SERVICE'";
	mysql_query($query);
}
else
{
	$query = "UPDATE services SET lastcheck = 0 WHERE name = '$SERVICE'";
	mysql_query($query);
}

mysql_close();
?>
