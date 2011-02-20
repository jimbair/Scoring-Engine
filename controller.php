#!/usr/bin/php

<?
require('class/ccdc.class.php');
$basedir = 'pollers/';
print $_SERVER['DOCUMENT_ROOT'];

// Change max execution time to 1 minute
set_time_limit(60);

$con = ccdc::pconnect();

mysql_select_db('ccdc');

print "Number of teams: " . ccdc::numTeams($con) . "\n";

print "Number of services running: " . ccdc::numServices($con) . "\n";


$activeservices = ccdc::getActiveServices($con);
while($row = mysql_fetch_array($activeservices, MYSQL_ASSOC))
{
	// Execute: poller host user pass
	$status = exec($basedir . $row['poller'] . " " . $row['host'] . " " . $row['user'] . " " . $row['pass']);

	if(trim($status) == "SUCCESS")
	{
		$query = "UPDATE services SET attempts = attempts + 1, success = success + 1, lastcheck = 1 WHERE name = '" . $row['name'] . "' AND teamid = " . $row['teamid'];
		mysql_query($query);
	}
	else
	{
		$query = "UPDATE services SET attempts = attempts + 1, lastcheck = 0 WHERE name = '" . $row['name'] . "' AND teamid = " . $row['teamid'];
		mysql_query($query);
	}
}

ccdc::dbclose($con);

?>
