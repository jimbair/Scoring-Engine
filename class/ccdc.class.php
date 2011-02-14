<?

class ccdc
{

	public static function pconnect()
	{
		// Get location of config file
		if(file_exists('.config'))
			{ $CONFIGFILE = '.config'; }
		elseif(file_exists('../.config'))
			{ $CONFIGFILE = '../.config'; }
		else
			{ die("Could not locate config file!\n"); }


		// Get MySQL connection info from config file
		$CONFIG = parse_ini_file($CONFIGFILE);	

		// Connect to the database server
		$con = mysql_pconnect( $CONFIG['mysqlhost'], $CONFIG['mysqluser'], $CONFIG['mysqlpass'] );
		if ( !$con )
   			{ die( 'Could not connect to db: ' . mysql_error() ); }

		// Return connection
		return $con;

	} // End method pconnect()

	public static function dbclose($con)
	{
	
		mysql_close($con);

	}

	public static function numteams($con)
	{
		// Update team count
		$query = "SELECT name from teams";
		$result = mysql_query($query,$con);

		return mysql_num_rows($result);
	}

	public static function numservices($con)
	{
		// Update the number of services running
		$query = "SELECT name from services";
		$result = mysql_query($query,$con);
		
		return mysql_num_rows($result);
	}

}

?>
