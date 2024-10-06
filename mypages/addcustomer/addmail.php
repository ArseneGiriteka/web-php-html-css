<?php
	$connection_err_msg = "Error  connecting to MySQL database";

	$dbc = mysqli_connect('localhost','root','Biba$arsene0','elvis_store') or die($connection_err_msg);

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];

	$query = "INSERT INTO email_list(first_name,last_name,email)".
	"VALUES ('$first_name','$last_name','$email')";

	mysqli_query($dbc,$query) or die("Error querrying database");

	echo "Customer add";

	mysqli_close($dbc);
?>
