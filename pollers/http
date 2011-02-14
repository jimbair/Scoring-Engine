#!/usr/bin/php

<?
$SERVICE = 'HTTP';
$URL = 'http://192.168.201.97';
$HASH = '125887fd5bfc6f0bdba9264279063758'; 

mysql_connect('localhost','root','P@ssw0rd');
mysql_select_db('ccdc');

// Add service to db if it doesn't already exist
include "servicedbcheck.php";

// Get the contents of the URL and the MD5
$output = DownloadUrl($URL);
$md5 = md5($output);

//print "Output was: $output\n";
//print "MD5 is: $md5\n";
//print "Expected MD5: $HASH\n";

// Update attempt count
$query = "UPDATE services SET attempts = attempts + 1 WHERE name = '$SERVICE'";
mysql_query($query);


// If the hashes match, update the success counter
if ($md5 == $HASH)
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

function DownloadUrl($Url){
    
    // is curl installed?
    if (!function_exists('curl_init')){ 
        die('CURL is not installed!');
    }
    
    // create a new curl resource
    $ch = curl_init();

    /*
    Here you find more options for curl:
    http://www.php.net/curl_setopt
    */

    // set URL to download
    curl_setopt($ch, CURLOPT_URL, $Url);

    // set referer:
    //curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/");

    // user agent:
    //curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");

    // remove header? 0 = yes, 1 = no
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // should curl return or print the data? true = return, false = print
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    // download the given URL, and return output
    $output = curl_exec($ch);

    // close the curl resource, and free system resources
    curl_close($ch);

    // print output
    return $output;
}

?>
