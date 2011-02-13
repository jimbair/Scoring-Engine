#!/usr/bin/php

<?
$SERVICE = 'SSH';
$SERVER = '192.168.201.90';
$USER = 'legitshell';
$PASS = 's3cr3t';

mysql_connect('localhost','root','P@ssw0rd');
mysql_select_db('ccdc');

// Add service to db if it doesn't already exist
include "servicedbcheck.php";

// Connect and authenticate to the server
$output = SSH($SERVER,$USER,$PASS);

//print "Output was: $output\n";
//print "MD5 is: $md5\n";
//print "Expected MD5: $HASH\n";

// Update attempt count
$query = "UPDATE services SET attempts = attempts + 1 WHERE name = '$SERVICE'";
mysql_query($query);


// If the hashes match, update the success counter
if ($output = "SUCCESS")
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

function SSH($server,$user,$pass){
    
	$connection = ssh2_connect($server,22);

	if (ssh2_auth_password($connection,$user,$pass)) {
  		return "SUCCESS";
	} else {
  		return "FAIL";
	}
}

?>
