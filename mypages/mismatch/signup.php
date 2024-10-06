<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="">
	<title>Mismatch - Sign up</title>
</head>
<body>
<?php
	require_once('connectvars.php');
	require_once('appvars.php');

	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	if (isset($_POST['submit'])) {
		// code...
		$username = mysqli_real_escape_string($dbc,trim($_POST['username']));
		$password1 = mysqli_real_escape_string($dbc,trim($_POST['password1']));
		$password2 = mysqli_real_escape_string($dbc,trim($_POST['password2']));

		if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
			// code...
			$query = "SELECT * FROM mismatch_user WHERE username = '$username'";
			$data = mysqli_query($dbc,$query);
			if(mysqli_num_rows($data) == 0){

				$query = "INSERT INTO mismatch_user (username,password,join_date) VALUES('$username',".
					"SHA('$password1'),NOW())";
				mysqli_query($dbc,$query);

				echo '<p>Welcome '.$username.' now you\'re ready to <a href="login.php">login your'.      'profile</a></p>';
				mysqli_close($dbc);
				exit();
			}
			else{
				echo '<p>Oops username '.$username.' has been already taken can you choose an other one' .'.</p>';
			}
		}
		else{
			echo '<p>You must fill all the text field to sign up.</p>';
		}
		mysqli_close($dbc);
	}


?>
	<p>Enter your username and password for signing up</p>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<fieldset>
			<legend>Registration info</legend>
			<label for="username">Username:</label><br>
			<input type="text" id="Password" name="username"                                             value="<?php if(!empty($username)) echo $username; ?>"><br>
			<label for="password">Password:</label><br>
			<input type="password" name="password1" id="password1"><br>
			<label for="password">Password(Retype):</label><br>
			<input type="password" name="password2" id="password2"><br>
		</fieldset>
		<input type="submit" name="submit" value="Sign Up">
	</form>
<?php
	require_once('footer.php');
?>