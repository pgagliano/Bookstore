<?php 	
	
	$DB_NAME = 'pgagl623_bookstore';
	$DB_HOST = 'localhost';
	$DB_USER = 'pgagl623';
	$DB_PASS = 'ma5pachU';

	$connection = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
		or die("Cannot connect to $DB_HOST as $DB_USER" . mysql_error());

	mysql_select_db($DB_NAME) or die ("Cannot open $DB_NAME:" . mysql_error());
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$first = $_POST['firstname'];
	$last = $_POST['lastname'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$address2 = $_POST['address2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	
	$sql = "INSERT INTO Customers(Email, Passwd, FirstName, LastName, Address1, Address2, ZipCode, State, PhoneNumber, City)
						   VALUES('$email','$password','$first','$last','$address','$address2','$zip','$state','$phone','$city')";

	if(mysql_query($sql))
	{
		echo "<script>alert('Account Successfully Created')</script>";
		echo "<script>history.back()</script>";
	}
	else
	{
		echo"Error! " . $sql . "<br>" . mysql_error($connection);
		echo "<script>history.back()</script>";
	}
	
	mysql_close($connection);
	
?>