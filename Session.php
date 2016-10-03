<?php
	session_start();
	
	$_SESSION['num'] = sessFile1;
	$_SESSION['num'] = sessFile2;
	
?>

<html>
<body>
	<a href = "sessFile1.php"><h1>File1</h1></a>
	<a href = "sessFile2.php"><h1>File2</h1></a>
</body>
</html>
