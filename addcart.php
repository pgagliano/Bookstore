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
	$query = ("SELECT Title, Author1, Price FROM Products WHERE ProductID = '$id';");   
	$res = mysql_query($query);
	$numOfRows = mysql_num_rows($res);
	$numRow = mysql_fetch_array($res);
	
	for($i=0; $i < $numOfRows; $i++)
		{
			$title = mysql_result($res, $i, "Title") ;	
			$author1 = mysql_result($res, $i, "Author1");
			$price = mysql_result($res, $i, "Price");
		}
	
	if(isset($_SESSION['CurrentUser']))
	{
	//Insert into cart
	$sql = "INSERT INTO Cart(Email, ProductID, Title, Author, Price)
						VALUES('$email','$id','$title','$author1','$price')";
	}
	else
	{
		echo "<script>alert('You must be logged in to add to cart!')</script>";
		echo "<script>history.back()</script>";
	}
	
	if(mysql_query($sql))
	{
		echo "<script>alert('Item successfully added to cart')</script>";
		echo "<script>history.back()</script>";
	}
	else
	{
		echo"Item could not be added to cart. Check your shopping cart for duplicates";
		echo "<script>history.back()</script>";
	}
	
	mysql_close($connection);			
?>
		