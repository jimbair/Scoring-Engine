<html>
<head>
	<meta http-equiv="refresh" content="60">
	<title>CCDC Practice Scoreboard</title>

<style type="text/css">
	.up { background: green; }
	.down { background: red; }
	table { border-spacing: 10px; }
</style>

</head>
<body bgcolor="black">
	<br />
	<center><h1 style="color: white;">CCDC Practice Scoreboard</h1></center>

<?
mysql_connect('localhost','root','P@ssw0rd');
mysql_select_db('ccdc');

$query = "SELECT * from services";
$result = mysql_query($query);

mysql_num_rows($result);

// Start the table
print '<center><table style="color: white;"><tr style="font-size: x-large;"><th>Service</th><th>Attempts</th><th>Successful</th><th>Uptime</th></tr>';

while( $row = mysql_fetch_array($result) )
{
	// Check if service was up at alst polling
	$class = ($row[3] == 1) ? 'up' : 'down';

	print '<tr style="font-size: large;"><td class=\'' . $class . '\'>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td>' . 
	'<td>' . round( ($row[2] / $row[1] *100), 1) . '%</td></tr>';
}

// End the table
print '</table></center>';

mysql_close();
?>

</body>
</html>
