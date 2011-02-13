<?
$query = "select * from services where name = '$SERVICE'";
$result = mysql_query($query);

if (mysql_num_rows($result) < 1)
{	
	print "Adding service to database\n";
	$query = "insert into services values('$SERVICE',0,0,0)";
	mysql_query($query);
}
?>
