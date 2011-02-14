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

ccdc::dbclose($con);
}

?>
