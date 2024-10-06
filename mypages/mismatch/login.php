<?php
  require_once('connectvars.php');
  session_start();

  $error_msg = "";

if(!isset($_SESSION['user_id'])){
  	if(isset($_POST['submit'])){
  		$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

  		// Grab the user-entered log-in data
  		$user_username = mysqli_real_escape_string($dbc,trim($_POST['username']));
  		$user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));

  		if(!empty($user_username) && !empty($user_password)){

  			// Look up the username and password in the database
			$query = "SELECT user_id, username FROM mismatch_user WHERE username = '$user_username' AND ". "password = SHA('$user_password')";
			$data = mysqli_query($dbc, $query);

			if (mysqli_num_rows($data) == 1) {
			    // The log-in is OK so set the user ID and username variables
			    $row = mysqli_fetch_array($data);
			    $_SESSION['username'] = $row['username'];
			    $_SESSION['user_id'] = $row['user_id'];

			    setcookie('user_id',$_COOKIE['user_id'],time()+(60*60*24*30));
			    setcookie('username',$_COOKIE['username'],time()+(60*60*24*30));

			    $home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
			    header('Location: '.$home_url);
			}else {
			   $error_msg = "Sorry, tou must inter valid username and password";
			}
  		}
  		else{
  			$error_msg = "You must fill all text field to log in ;-)";
  		}
  	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="">
	<title>Mismatch - Login</title>
</head>
<body>
	<h3>Mismatch - Login</h3>
	<?php 
		if(empty($_SESSION['user_id'])){ 
			echo '<p>'.$error_msg.'</p>';	
	?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<legend>Log In</legend>
				<label for="username">Username:</label>
				<input type="text" name="username" value="<?php                                          if(!empty($_POST['username'])) echo $username; 
					?>"><br>
				<label for="password">Password:</label>
				<input type="password" name="password">
			</fieldset>
			<input type="submit" name="submit" value="Log in">
		</form>
	<?php
		}
		else{
			echo '<p>You \'re logged in as '.$_SESSION['username'].'</p>';
		}
	?>
<?php
	require_once('footer.php');
?>