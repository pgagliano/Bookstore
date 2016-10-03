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
	
	$email = $_POST['email'];			//Gets user Email from form
	$password = $_POST['password'];		//Gets user password from form
	
	//Gets email and password from database and stores it in dBaseEmail and dBasePassword
	$result = mysql_query("SELECT CustomerID, Email, Passwd, FirstName FROM Customers WHERE Email = '$email' AND Passwd = '$password'");
	
	//Fetches the array and rows
	$rownum = mysql_fetch_array($result);
	
	//Compares both email and password
	if($rownum["Email"]==$email && $rownum["Passwd"]==$password)
	{
		$_SESSION['CurrentUser'] = $email;
		echo "<script>alert('You have logged in!')</script>";
		echo "<script>history.back()</script>";
	}
	else
	{
		echo "<script>alert('Incorrect username or password. Please try again.')</script>";
		echo "<script>history.back()</script>";
	}	 
	
	mysql_close($connection);
	
?>