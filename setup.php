#!/usr/bin/php

<?

	require('class/ccdc.class.php');

	$con = ccdc::pconnect();

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
		mysql_query("CREATE TABLE services ( name varchar(10) NOT NULL, attempts INT(10) DEFAULT 0, success INT(10) DEFAULT 0, lastcheck INT(1) DEFAULT 0, active INT(1) DEFAULT 0, useauth INT(1) DEFAULT 0, host VARCHAR(30) NOT NULL, user VARCHAR(25), pass VARCHAR(25) )");
		mysql_query("CREATE TABLE teams ( id INT(10) NOT NULL AUTO_INCREMENT, name VARCHAR(25) NOT NULL, PRIMARY KEY(id) )");
	} catch (Exception $e) {
		print "Could not create tables: $e->getMessage()\n";
	}

	print "Tables added...\n";

	ccdc::dbclose($con);
?>
