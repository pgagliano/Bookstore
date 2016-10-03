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
	<body>
			<div style="text-align: center;" id="form-customerContainer"> 
			<form id = "productform" action="removecart.php" method = "get">
			<h1><u><span>Shopping Cart<span></u></h1>
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
					echo"<h2>Shopping cart for " . $_SESSION['CurrentUser'] . "</h2>";
					echo"<hr>";
				}
				else
				{
					echo"<h2>You Need to be logged in to view the orders!</h2>";
				}
				
				//Get customer ID
				$email = $_SESSION['CurrentUser'];
				$query = ("SELECT * FROM Cart WHERE Email = '$email';");
				$res = mysql_query($query);
				$numOfRows = mysql_num_rows($res);
				$numRow = mysql_fetch_array($res);
				
				//Gets customers order from customers email
				for ($i=0; $i<$numOfRows; $i++)					
					{ 
						$pid = mysql_result($res, $i, "ProductID");
						$title = mysql_result($res, $i, "Title") ;		
						$author = mysql_result($res, $i, "Author");
						$price = mysql_result($res, $i, "Price");
						$pricee = number_format($price, 2);
						
						print "<tr><div style='text-align:center'>Product ID: $pid</tr> ";
						print "<tr><div style='text-align:center'>Ttile: $title </tr> " ;
						print "<td><div style='text-align:center'>Author: $author </td> " ;
						print "<td><div style='text-align:center'>Price: $</td>".number_format($price, 2);
						print "<br>";
						print "<br>";
						print "<td><div style='text-align:center'><a class='button' href='removecart.php?id=$pid'>Remove</a></td>";
						print "<br>";
						print "<br>";
						print "<br>";
						print "<td><div style='text-align:center'><a class='button' href='phase2browse.php'>Continue Shopping</a></td>";
						print "<br>";
						print "<br>";
						print"<hr>";
					}
				
				
			mysql_close($connection);			
			?>
		</form>
		
		<form>
			<h3><u><span>Order Details<span></u></h3>
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
					//Variables 
				$subtotal = 0;
				$tax = 0;
				$shipping = 0;
				$totalAmount = 0;
				
				//Get Prices
				$email = $_SESSION['CurrentUser'];
				$query = ("SELECT Price FROM Cart WHERE Email = '$email';");
				$res = mysql_query($query);
				$numOfRows = mysql_num_rows($res);
				
				//Gets subtotal
				for ($i=0; $i<$numOfRows; $i++)					
					{ 
						$price = mysql_result($res, $i, "Price");
					}
				
				print "<td><div style='text-align:center'>Subtotal: $</td>".number_format($price, 2) ;
				
				//Gets tax
				$tax = $price * 0.06;
				print "<td><div style='text-align:center'>Tax: $</td>".number_format($tax, 2) ;
				
				//Gets shipping price
				if($price < 25)
					{
						$shippingCost = 4.50;
					}
				else if($price < 50)
					{
						$shippingCost = 7.00;
					}
				else
					{
						$shippingCost = 10.25;
					}
				
				//Check Buttons
				if($shippingCost == 'expedited')
				{
					$shippingCost + 5.00;
				}

				print "<td><div style='text-align:center'><input type ='radio' name='method' id='standard' checked='checked'>Standard</td><td><input type ='radio' name='method' id='expedited'>Expedited</td>";
				print "<td><div style='text-align:center'>Shipping Cost: $".number_format($shippingCost, 2);
				
				//Gets total cost of order
				$totalAmount = $price + $tax + $shippingCost;
				
				print "<td><div style='text-align:center'>Total Amount: $</td>".number_format($totalAmount, 2) ;
				print"<hr>";
				print "<br>";
				print "<td><div style='text-align:center'><div style='text-align:center'><a class='button' href='placeorder.php?sc=$shippingCost&ta=$tax&to=$totalAmount&pid=$pid'>Checkout</a></td>";
				
				}
			?>
		</form>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
	</body>
		
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
