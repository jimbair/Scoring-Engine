#!/usr/bin/php

<?
require('class/ccdc.class.php');

// Change max execution time to 1 minute
set_time_limit(60);

$con = ccdc::pconnect();

mysql_select_db('ccdc');

print "Number of teams: " . ccdc::numteams($con) . "\n";

print "Number of services running: " . ccdc::numservices($con) . "\n";

ccdc::dbclose($con);

?>
