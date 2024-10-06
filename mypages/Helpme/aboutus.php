<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>About us</title>
	<link rel="stylesheet" type="text/css" href="aboutus.css">
</head>
<body>
	<div id="aboutus_page_id">
		<?php
			error_reporting(E_ALL);
			ini_set("display_errors", 1);
			echo file_get_contents('header.php');
		?>
		<div>
			<h1>GIRITEKA Arsene</h1>
			<p>
				I m nothing but i can accomplish anything.
			</p>
			<p>
				contact : +33 7 53 49 75 91.<br>
				mail adress : <a href="giritekaaarsene@gmail.com">giritekaaarsene@@gmail.com</a>.<br>
				adress : <address>6 Rue carnavalet 13009</address>
			</p>
		</div>
		<?php
			echo file_get_contents('footer.php');
		?>
	</div>
</body>
</html>