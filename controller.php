#!/usr/bin/php

<?
//Get MySQL username from config file
$CONFIGFILE = file_get_contents('.config');


mysql_pconnect('localhost','root','P@ssw0rd');
mysql_select_db('ccdc');

// Change max execution time to 1 minute
set_time_limit(60);

// Update attempt count
$query = "SELECT name from teams'";
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
