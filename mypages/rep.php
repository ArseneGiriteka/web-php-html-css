<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Abduction report</title>
</head>
<body>
	<h2>Aliens abducted me</h2>
	<?php
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$when_it_happened = $_POST['whenithappened'];
		$how_long = $_POST['howlong'];
		$alien_description = $_POST['aliendescription'];
		$fang_spotted = $_POST['fangspotted'];
		$email = $_POST['email'];
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$how_many = $_POST['howmany'];
		$what_they_did = $_POST['whattheydid'];
		$other = $_POST['other'];

		$msg = "$first_name $last_name was abducted $when_it_happened and he was gone for $how_long<br>".
			  	"number of aliens : $how_many<br>".
			  	"Alien description : $alien_description<br>".
			  	"What they did : $what_they_did<br>".
			  	"Fang spotted : $fang_spotted<br>".
			  	"Other : $other<br>";

		$dbc = mysqli_connect('localhost','root','Biba$arsene0','alienabduction') 
		or die("Error connecting to MySQL server");

		$query = "INSERT INTO alien_abduction (first_name, last_name, when_it_happened , how_long,".
					"how_many, alien_description, what_they_did, fang_spotted, other, email)".
					"VALUES ( '$first_name', '$last_name', '$when_it_happened', '$how_long',".
					"'$how_many',".
					"'$alien_description', '$what_they_did', '$fang_spotted', '$other', '$email')";


		$result = mysqli_query( $dbc ,$query ) or die("Error quereing data base");

		mysqli_close($dbc);

		echo "$msg";
		
		
	?>
</body>
</html>