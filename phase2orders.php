<?php
session_start();
?>

<?xml version = "1.0" encoding = "utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--
     Name:         Patrick Gagliano
     Project:      Nebula Bookstore
-->

<html xmlns = "http://www.w3.org/1999/xhtml">

	<link href="http://allfont.net/allfont.css?fonts=radio-space" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="phase1stylesheet.css" />
	
	<!--Header-->
    <header>  
		<div id="header">
				<a href="phase1home.php"><img class="logo" src="logo.jpg" style="width:100% height:800px;"></a>
		</div>
		<div class="dropdown">
			<ul>
				<li><a href="phase1home.php"><span>Home</span></a></li>
				<li><a href="phase1account.php"><span>Create Account</span></a></li>				
				<li><a href="phase2browse.php"><span>Browse Categories</span></a></li>
				<li><a href="phase2search.php"><span>Book Search</span></a></li>
				<li><a href="phase2orders.php"><span>Orders</span></a></li>
				<li><a href="phase2contact.php"><span>Contact Us</span></a></li>
				
				<?php
					if(isset($_SESSION['CurrentUser']))
						{
							echo"<li><a href='phase1login.php?logout=1'>Logout</a></h2></li>";
							echo" ";
							echo"<li><a href='shoppingcart.php'><span>View Cart</span></a></li>";
						}
					else
						{
							echo"<li><a href='phase1login.php'><span>Login</span></a></li>";
						}
					if(isset($_GET['logout']))
						{
							session_unset();
							session_destroy();
							echo"<script>alert('You have been logged out')</script>";
						}
				?>
			</ul>
		</div>
   </header>
		
		<!--Body-->
			<div style="text-align: center;" id="form-customerContainer">
			<form id = "productform" action = "shoppingcart.php" method = "post">
			<h1>Recent Orders</h1>
			<?php
				$DB_NAME = 'bookstore_pgagl623';
				$DB_HOST = 'localhost';
				$DB_USER = 'pgagl623';
				$DB_PASS = 'ma5pachU';

				$connection = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
					or die("Cannot connect to $DB_HOST as $DB_USER" . mysql_error());

				mysql_select_db($DB_NAME) or die ("Cannot open $DB_NAME:" . mysql_error());
				
				if(isset($_SESSION['CurrentUser']))
				{
					echo"<h2>Here are you orders for " . $_SESSION['CurrentUser'] . "</h2>";
				}
				else
				{
					echo"<h2>You Need to be logged in to view the orders!</h2>";
				}
				
				//Get customer ID
				$email = $_SESSION['CurrentUser'];
				$customerQuery = "SELECT CustomerID FROM Customers WHERE Email = '$email'";
				$customerResult = mysql_query($customerQuery);
				$customerRow = mysql_fetch_array($customerResult);
				$customerID = $customerRow['CustomerID'];
				
				//Get orders where ID equals customer ID
				$query = "SELECT OrderID, CustomerID, ShippingCost, Tax, Total, OrderDate FROM Orders WHERE CustomerID = '$customerID'";    
				$res = mysql_query($query);
				$numOfRows = mysql_num_rows($res);
				$numRow = mysql_fetch_array($res);
				
				//Compares both email and password
				for ($i=0; $i<$numOfRows; $i++)					//Iterate through the database
					{ 
						$orderid = mysql_result($res, $i, "OrderID") ;		//Store titles in cProducts
						$cID = mysql_result($res, $i, "CustomerID");
						$shippingcost = mysql_result($res, $i, "ShippingCost");
						$tax = mysql_result($res, $i, "Tax");
						$total = mysql_result($res, $i, "Total");
						$date = mysql_result($res, $i, "OrderDate");
						print "<tr><td><div style='text-align:center'>Order ID: $orderid </td> " ;
						print "<td><div style='text-align:center'>Customer ID: $cID </td> " ;
						print "<td><div style='text-align:center'>Shipping Cost: $</td>".number_format($shippingcost, 2) ;
						print "<td><div style='text-align:center'>Tax: $</td>".number_format($tax, 2) ;
						print "<td><div style='text-align:center'>Total: $</td>".number_format($total, 2) ;
						print "<td><div style='text-align:center'>$date </td> " ;
						print "<br>";
						print "<hr>";
					}
				mysql_close($connection);
			?>
			</form>
			
			<div style="padding-bottom: 40px">
			<form id="formbox" action="phase2selectedorder.php" method="post" style="border:none">
				<table style="width:100%">
				<th><h1>Order Details</h1></th>
				<tr>
					<td><p><class="email">
						<input name="pid" type="text" class="feedback-input" placeholder="Order ID" id="pid" required> *
						</p>
					</td>
				</tr>
				<tr>
					<td><button class="button" type="submit">Search</button>
					<button class="button" type="reset">Clear</button></td>
				</tr>							
				</table>
				</div>
			</form>	
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		
	<!--Footer-->
	<footer>			
		<p>***This is a project and not an actual store***</p>
		<div class="dropdown">
			<table cellspacing="10" align="center">
				<th>-- Popular Categories --</th>
					<hr>
						<?php
						
						$DB_NAME = 'bookstore_pgagl623';
						$DB_HOST = 'localhost';
						$DB_USER = 'pgagl623';
						$DB_PASS = 'ma5pachU';

						$connection = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
							or die("Cannot connect to $DB_HOST as $DB_USER" . mysql_error());

						mysql_select_db($DB_NAME) or die ("Cannot open $DB_NAME:" . mysql_error());
	
						$query = ("SELECT * FROM Categories;");
						$result = mysql_query($query) ;
						$rownum = mysql_num_rows($result);
				
						for($i=0; $i < $rownum; $i++)
						{
							$name = mysql_result($result, $i, "CategoryName") ;
							$id = mysql_result($result, $i, "CategoryID") ;
							echo "<tr><td><a id='choose' align='center' href='products.php?id=$id&cat=$name'>$name</a></td></tr>";
						}
						
						mysql_close($connection);
			
						?>
		</div>
	</footer>
</html>
