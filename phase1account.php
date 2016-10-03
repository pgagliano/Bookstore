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
		<div id="form-customerContainer">
			<form name="form1" action="phase2insertCustomers.php" method="post">
				<table style="width:100%">
					<th><h1>Create An Account</h1></th>
						<tr>
							<td> <p><class="firsName">
									<input name="firstName" type="text" pattern="[A-Za-z]{1,}" class="feedback-input" placeholder="First Name" id="firstName" required> *
								</p>
							</td>
						</tr>
						<tr>
							<td><p class="lastName">
								<input name="lastName" type="text" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Last Name" id="lastName" required> *
								</p>
							</td>
						</tr>
						<tr>
							<td><p class="phone">
								<input name="phone" type="number" pattern="[0-9]{10}" class="validate[required, feedback-input" placeholder="Phone Number" id="phone" required> *
								</p>
							</td>
						</tr>
						<tr>
							<td><p><class="email">
								<input name="email" type="text" class="feedback-input" placeholder="E-Mail" id="email" required> *
								</p>
							</td>
						</tr>
						<tr>
							<td><p><class="password">
								<input name="password" type="password" class="feedback-input" placeholder="Password" id="password" required> *
								</p>
							</td>
						</tr>
						<tr>
							<td><p class="address">
								<input name="address"  class="validate[required, feedback-input" placeholder="Address 1" id="address" required> *
								</p>
							</td>
						</tr>
						<tr>
							<td><p class="address2">
								<input name="address2"  class="validate[required, feedback-input" placeholder="Address 2" id="address2">
								</p>
							</td>
						</tr>
						<tr>
							<td><p class="city">
								<input name="city" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="City" id="city" required> *
							</td>
						</tr>
						<tr>
							<td><p class="state">
								<input name="state" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="State (Ex: PA)" id="state" required> *
								</p>
							</td>
						</tr>
						<tr>
							<td><p class="zip">
								<input name="zip" type="number" pattern="[0-9]{10}" class="validate[required, feedback-input" placeholder="Zip Code" id="zip"  /required> *
								</p>
							</td>
						</tr>
						<tr>						
			</table>
			<input type="submit" class="button">
			<button type="reset" class="button">Clear</button>
		</form>	
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

