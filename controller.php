#!/usr/bin/php

<?
require('class/ccdc.class.php');

// Change max execution time to 1 minute
set_time_limit(60);

$con = ccdc::pconnect();

mysql_select_db('ccdc');

// Update team count
$query = "SELECT name from teams";
$result = mysql_query($query);

$NUMTEAMS = mysql_num_rows($result);

print $NUMTEAMS;

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
