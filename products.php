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
	<div>
		<form id = "form-customerContainer" action="addcart.php" method = "get">
			<?php
				
				$DB_NAME = 'bookstore_pgagl623';
				$DB_HOST = 'localhost';
				$DB_USER = 'pgagl623';
				$DB_PASS = 'ma5pachU';

				$connection = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)
					or die("Cannot connect to $DB_HOST as $DB_USER" . mysql_error());

				mysql_select_db($DB_NAME) or die ("Cannot open $DB_NAME:" . mysql_error());
					
				$id = $_GET['id'];
				$name = $_GET['cat'];
					
				print"<div style='text-align:center'><h1>$name Products</h1>";
				
				$query = ("SELECT * FROM Products WHERE CategoryID = '$id';");   
				$result = mysql_query($query) ;
				$rownum = mysql_num_rows($result);
				
				for($i=0; $i < $rownum; $i++)
					{
						$titles = mysql_result($result, $i, "Title") ;		
						$pid = mysql_result($result, $i, "ProductID");
						$author1 = mysql_result($result, $i, "Author1");
						$author2 = mysql_result($result, $i, "Author2");
						$author3 = mysql_result($result, $i, "Author3");
						$quantity = mysql_result($result, $i, "Quantity");
						$price = mysql_result($result, $i, "Price");
						print "<tr><td><div style='text-align:center'>Product ID: $pid  </td></tr>" ;
						print "<tr><td><div style='text-align:center'>Title: $titles </td></tr>" ;
						print "<tr><td><div style='text-align:center'>Author 1: $author1 </td></tr>" ;
						if($author2 != NULL)
						{
							print "<td><div style='text-align:center'>Author 2: $author2 </td>" ;
						}
						if($author3 != NULL)
						{
							print "<td><div style='text-align:center'>Author 3: $author3 </td>" ;
						}
						print "<td><div style='text-align:center'>Quantity: $quantity </td>" ;
						print "<td><div style='text-align:center'>Price: $</td>".number_format($price, 2) ;
						print "<td><div style='text-align:center'>Category ID: $id ></td>";
						print "<br>";
						print "<br>";
						print "<td><div><a class='button' href='addcart.php?id=$pid'>Add To Cart</a></div></td>";
						print "<br>";
						print "<hr>";
					}	 
					mysql_close($connection);			
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
