<?php
session_start();
?>

<?php
	$DB_NAME = 'bookstore_pgagl623';
	$DB_HOST = 'localhost';
	$DB_USER = 'pgagl623';
	$DB_PASS = 'ma5pachU';

	$connection = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
		or die("Cannot connect to $DB_HOST as $DB_USER" . mysql_error());

	mysql_select_db($DB_NAME) or die ("Cannot open $DB_NAME:" . mysql_error());
					
	$email = $_SESSION['CurrentUser'];
	$id = $_GET['id'];
	
	//Get values where ID matches
	$query = ("DELETE FROM Cart WHERE ProductID = '$id';");   
	
	if(mysql_query($query))
	{
		echo "<script>alert('Item successfully removed from cart')</script>";
		echo "<script>history.back()</script>";
	}
	else
	{
		echo"Item could not be removed. Re-Check your decision.";
		echo "<script>history.back()</script>";
	}
	
	mysql_close($connection);			
?>
		