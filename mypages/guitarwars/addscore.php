<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>add score</title>
	</head>
	<body>
		<h2>Guitar Wars - Add Your High Score</h2>
		<?php
			require_once('appvars.php');
			require_once('connectvars.php');
			
			if(isset($_POST['submit'])){
				$name = $_POST['name'];
				$score = $_POST['score'];
				$screenshot = $_FILES['screenshot']['name'];
				$screenshot_type = $_FILES['screenshot']['type'];
				$screenshot_size = $_FILES['screenshot']['size'];

				if(!empty($name) && !empty($score) && is_numeric($score) && !empty($screenshot)){
					$target = GW_UPLOADPATH.$screenshot;

					if(($screenshot_type=="image/pjpeg" || $screenshot_type=="image/jpeg" || 
						$screenshot_type=="image/gif" || $screenshot_type=="image/jpg" || 
						$screenshot_type=="image/png" || $screenshot_type=="image/jfif") &&          ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)){

						if($_FILES['screenshot']['error'] == 0){
							if(move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)){
								$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
								or die("Error connecting to MySQL server");

								$name = mysqli_real_escape_string($dbc,trim($_POST['name']));
								$score = mysqli_real_escape_string($dbc,trim($_POST['score']));
								$screenshot = mysqli_real_escape_string($dbc,trim($_POST['screenshot']['name']));
								$query = "INSERT INTO guitarwars_table(date,name,score,screenshot)".
								"VALUES (NOW(),'$name','$score','$screenshot')";

								mysqli_query($dbc,$query);

								echo '<p>Thanks for adding your new high score</p>';
								echo '<p><strong>Name:</strong> '.$name.'<br>';
								echo '<strong>Score:</strong> '.$score.'<br>';
								echo '<img src="'.$target.'" alt="score image"></p>';
								echo '<p><a href="index.php"> >> Back to high scores</a></p>';

								$name = "";
								$score = "";
								$screenshot = "";

								mysqli_close($dbc);
							}
							else{
								echo '<p>Sorry there was an error uploading your screenshot'.        'image.</p>';
							}
						}
					} 
					else {
						echo "<p>The screenshot must be gif png jpg* gif and no so havy</p>";	
					}

					@unlink($_FILES['screenshot']['tmp_name']);

				}
				else{
					echo '<p class="error">Please enter all of the information to add your high'.    'score.'.
					'<br>';
				}
			}
		?>
		<hr>
		<form enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
			<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
			<label for="name">Name:</label>
			<input type="text" name="name" value="<?php if(!empty($name)) echo $name;?>"><br>
			<label for="score">Score:</label>
			<input type="text" name="score" value="<?php if(!empty($score)) echo $score; ?>"><br>
			<label for="screenshot">Screen shot: </label>
			<input type="file" id="screenshot" name="screenshot">
			<hr>
			<input type="submit" name="submit" value="add">
		</form>
	</body>
</html>