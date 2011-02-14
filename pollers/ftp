#!/usr/bin/php

<?
$SERVICE = 'FTP';
$SERVER = 'ftp.legitco.ccdc';
$USER = 'legitftp';
$PASS = 'iheartftp';

mysql_connect('localhost','root','P@ssw0rd');
mysql_select_db('ccdc');

// Add service to db if it doesn't already exist
include "servicedbcheck.php";

// Get the contents of the URL and the MD5
$output = FTP($SERVER,$USER,$PASS);

//print "Output was: $output\n";
//print "MD5 is: $md5\n";
//print "Expected MD5: $HASH\n";

// Update attempt count
$query = "UPDATE services SET attempts = attempts + 1 WHERE name = '$SERVICE'";
mysql_query($query);


// If the hashes match, update the success counter
if ($output == "SUCCESS")
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

function FTP($server,$user,$pass){
 
	$connection = ftp_connect($server,21,5);

	if(ftp_login($connection,$user,$pass))
	{
		return "SUCCESS";
	}
	else
	{
		return "DENIED";
	}
   
}

?>
