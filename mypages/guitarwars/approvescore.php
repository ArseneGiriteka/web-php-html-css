<?php
	require_once('authorize.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Guitar wars - Approve score</title>
</head>
<body>
<?php 

	require_once('connectvars.php');
	require_once('appvars.php');

	if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['date']) && isset($_GET['score']) && isset($_GET['screenshot'])){

		$id = $_GET['id'];
		$name = $_GET['name'];
		$date = $_GET['date'];
		$score = $_GET['score'];
		$screenshot = $_GET['screenshot'];

	}
	elseif (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$score = $_POST['score'];
	}
	else{
		echo '<p class="error">Sorry no high score was specified for approval.</p>';
	}


	if(isset($_POST['submit'])){

		if($_POST['confirm'] == 'Yes'){

			$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

			$query = "UPDATE guitarwars_table SET approved=1 WHERE id='$id'";

			mysqli_query($dbc,$query);

			mysqli_close($dbc);

			echo '<p>The high score of '.$score.' for '.$name.' was successfully approved.</p>';
		}
		else{
			echo '<p class="error">The high score was not approved.</p>';
		}

	}
	elseif(isset($id) && isset($name) && isset($date) && isset($score) && isset($screenshot)){
		echo '<p>Do you want to delete the following score</p>';
		echo '<p><strong>Name: </strong>'.$name.' <strong>Date: </strong>'.$date.
		'<br> <strong>Score: </strong>'.$score.'</p>';

		echo '<form method="post" action="approvescore.php">';
		echo '<input type="radio" name="confirm" value="Yes"> Yes';
		echo '<input type="radio" name="confirm" value="No"> No<br>';
		echo '<input type="submit" value="submit" name="submit">';
		echo '<input type="hidden" name="name" value="'.$name.'">';
		echo '<input type="hidden" name="id" value="'.$id.'">';
		echo '<input type="hidden" name="score" value="'.$score.'">'; 
		echo '</form>';
	}

	echo '<p><a href="admin.php">>>Back to admin page</a></p>';

?>
</body>
</html>