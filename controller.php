#!/usr/bin/php

<?
require('class/ccdc.class.php');

// Change max execution time to 1 minute
set_time_limit(60);

$con = ccdc::pconnect();

mysql_select_db('ccdc');

print "Number of teams: " . ccdc::numTeams($con) . "\n";

print "Number of services running: " . ccdc::numServices($con) . "\n";


$activeservices = ccdc::getActiveServices($con);
while($row = mysql_fetch_array($activeservices, MYSQL_ASSOC))
{
	print $row['name'] . "\n";
}

ccdc::dbclose($con);

?>
