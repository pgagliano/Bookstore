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
	$ship = $_GET['sc'];
	$tax = $_GET['ta'];
	$total = $_GET['to'];
	$pid = $_GET['pid'];
	
	$query = ("SELECT CustomerID FROM Customers WHERE Email = '$email';");   
	$result = mysql_query($query) ;
	$rownum = mysql_num_rows($result);
				
	for($i=0; $i < $rownum; $i++)
		{
			$id = mysql_result($result, $i, "CustomerID") ;	
		}
	
	$query = ("SELECT OrderID FROM Orders WHERE CustomerID = '$id';");   
	$result = mysql_query($query) ;
	$rownum = mysql_num_rows($result);
				
	for($i=0; $i < $rownum; $i++)
		{
			$oid = mysql_result($result, $i, "OrderID") ;	
		}
						
	//Insert into order details
	$sql = "INSERT INTO OrderDetails(OrderID, ProductID, Quantity, LineTotal)
						VALUES('$id','$pid', 1,'$total')";

	if(mysql_query($sql))
	{
		echo "<script>alert('Order has been placed!')</script>";
		echo "<script>history.back()</script>";
	}
	else
	{
		echo"Order could not be processed";
		echo "<script>history.back()</script>";
	}
	
	mysql_close($connection);			
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
	$ship = $_GET['sc'];
	$tax = $_GET['ta'];
	$total = $_GET['to'];
	$pid = $_GET['pid'];
	
	$query = ("SELECT CustomerID FROM Customers WHERE Email = '$email';");   
	$result = mysql_query($query) ;
	$rownum = mysql_num_rows($result);
				
	for($i=0; $i < $rownum; $i++)
		{
			$id = mysql_result($result, $i, "CustomerID") ;	
		}
	
	$query = ("SELECT OrderID FROM Orders WHERE CustomerID = '$id';");   
	$result = mysql_query($query) ;
	$rownum = mysql_num_rows($result);
				
	for($i=0; $i < $rownum; $i++)
		{
			$oid = mysql_result($result, $i, "OrderID") ;	
		}
		
	//Insert into orders
	$sql = "INSERT INTO Orders(CustomerID, ShippingCost, Tax, Total, OrderDate)
						VALUES('$id','$ship','$tax','$total','2015-05-05')";

	if(mysql_query($sql))
	{
		echo "<script>alert('Order has been placed!')</script>";
		echo "<script>history.back()</script>";
	}
	else
	{
		echo"Order could not be processed";
		echo "<script>history.back()</script>";
	}
	
	mysql_close($connection);			
?>
		