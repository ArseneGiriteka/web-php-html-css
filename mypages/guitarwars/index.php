<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>high score</title>
</head>
<body>
	<h2>Guitar wars - High score</h2>
	<p>
		Welcome guitar warrior, do you have what it takes to crack the high score list? If so just <a href="addscore.php">add your own score</a>.
	</p>
	<?php
		require_once('appvars.php');
		require_once('connectvars.php');

		$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) 
		or die("Error connecting to MySQL server");

		$query = "SELECT * FROM guitarwars_table WHERE approved=1 ORDER BY score DESC, date ASC";

		$data = mysqli_query($dbc,$query) or die("Error querrying MySQL database");

		$i = 0;

		echo '<table>';
		while($row = mysqli_fetch_array($data)){
			if ($i == 0) {
				// code...
				echo '<tr><td><strong>TOP SCORE:'.$row['score'].'</strong></td></tr>';
			}
			echo '<tr><td class="scoreinfo">';
			echo '<span class="score">'.$row['score'].'</span><br>';
			echo '<strong>Name:</strong> '.$row['name'].'<br>';
			echo '<strong>Date:</strong> '.$row['date'].'</td>';

			if (is_file(GW_UPLOADPATH.$row['screenshot']) && filesize(GW_UPLOADPATH.$row['screenshot'])>0) {
				echo '<td><img src="'.GW_UPLOADPATH.$row['screenshot'].'" alt="score image"></td></tr>';
			}
			else{
				echo '<td><img src="'.GW_UPLOADPATH.'error.png" alt="univerified score"></td><tr/>';
			}
			$i++;
		}
		echo '</table>';

		mysqli_close($dbc);
	?>
</body>
</html>