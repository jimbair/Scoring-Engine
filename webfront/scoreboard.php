<html>
<head>
<?
require('../class/ccdc.class.php');

$con = ccdc::pconnect();

mysql_select_db('ccdc');

$numteams = ccdc::numteams($con);
$currteam = $_GET['team'];

$here = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

if(empty($currteam))
{
	header('location:?team=1');	
}
else
{
	if($currteam < $numteams)
	{
		print '<meta http-equiv="refresh" content="15;url=http://' . $here . '?team=' . ($currteam +1) . '">';
	} 
	else
	{
		print '<meta http-equiv="refresh" content="15;url=http://' . $here . '?team=1">';
	}
}

// Get current team's id
$query = "SELECT id FROM teams limit " . ($currteam -1) . ", 1";
$row = mysql_fetch_row(mysql_query($query));
$teamid = $row[0];

$query = "SELECT * FROM teams WHERE id = $teamid";
$result = mysql_query($query);
$teaminfo = mysql_fetch_assoc($result);
print_r($teaminfo);
?>

<title>CCDC Practice Scoreboard</title>


<style type="text/css">
	.up { background: green; }
	.down { background: red; }
	table { border-spacing: 10px; }
</style>

</head>
<body bgcolor="black">
	<br />
	<center><h1 style="color: white;"><? print $teaminfo['name']; ?></h1></center>

<?

$query = "SELECT * from services WHERE teamid = $teamid AND active = 1";
$result = mysql_query($query);

mysql_num_rows($result);

// Start the table
print '<center><table style="color: white;"><tr style="font-size: x-large;"><th>Service</th><th>Attempts</th><th>Successful</th><th>Uptime</th></tr>';

while( $row = mysql_fetch_assoc($result) )
{
	// Check if service was up at alst polling
	$class = ($row['lastcheck'] == 1) ? 'up' : 'down';

	print '<tr style="font-size: large;"><td class=\'' . $class . '\'>' . $row['name'] . '</td><td>' . $row['attempts'] . '</td><td>' . $row['success'] . '</td>' . '<td>' . round( ($row['success'] / $row['attempts'] *100), 1) . '%</td></tr>';
}

// End the table
print '</table></center>';

mysql_close();
?>

</body>
</html>
