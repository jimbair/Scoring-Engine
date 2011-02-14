#!/usr/bin/php

<?
// Get MySQL connection info from config file
$CONFIG = parse_ini_file('.config');

// Connect to the database server
$con = mysql_pconnect( $CONFIG['mysqlhost'], $CONFIG['mysqluser'], $CONFIG['mysqlpass'] );
if ( !$con )
	{ die( 'Could not connect to db: ' . mysql_error() ); }

// Create the database if it doesn't already exist
if ( mysql_query('CREATE DATABASE IF NOT EXISTS ccdc', $con) )
	{ print "Database created...\n"; } 
else
	{ die( 'Error creating database: ' . mysql_error() ); }

mysql_select_db('ccdc');

// Drop old tables if present
try {
	mysql_query('DROP TABLE IF EXISTS services', $con);
	mysql_query('DROP TABLE IF EXISTS teams', $con);
} catch (Exception $e) {
	print "Could not drop tables: $e->getMessage()\n";
}

// Create new tables
try {
	mysql_query("CREATE TABLE services ( name varchar(10), attempts INT(10), success INT(10), lastcheck INT(1) )");
	mysql_query("CREATE TABLE teams ( id INT(10) NOT NULL AUTO_INCREMENT, name VARCHAR(25), PRIMARY KEY(id) )");
} catch (Exception $e) {
	print "Could not create tables: $e->getMessage()\n";
}

mysql_close();
?>
