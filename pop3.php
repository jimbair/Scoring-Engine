#!/usr/bin/php

<?
$SERVICE = 'POP3';
$SERVER = '192.168.201.125';
$USER = 'management';
$PASS = 'password';

mysql_connect('localhost','root','P@ssw0rd');
mysql_select_db('ccdc');

// Add service to db if it doesn't already exist
include "servicedbcheck.php";

// Get the contents of the URL and the MD5
$output = POP3($SERVER,$USER,$PASS);
print $output;

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

function POP3($server,$user,$pass,$folder="INBOX",$ssl=false)
{ 
    $ssl=($ssl==false)?"/novalidate-cert":""; 
    if (imap_open("{"."$server:110/pop3$ssl"."}$folder",$user,$pass))
	{
		return "SUCCESS";
	}
	else
	{	
		return "FAIL";
	}
}

?> 
