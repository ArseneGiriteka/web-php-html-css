<?php
	require_once('authorize.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Guitar wars - Admin</title>
</head>
<body>
<?php 
	require_once('connectvars.php');
	require_once('appvars.php');

	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	$query = "SELECT * FROM guitarwars_table ORDER BY score DESC, date ASC";

	$data = mysqli_query($dbc,$query);

	echo '<table>';

	while($row = mysqli_fetch_array($data)){
		echo '<tr class="scorerow">';
		echo "<td><strong>".$row['name']."</strong></td>";
		echo '<td><strong>'.$row['date'].'</strong></td>';
		echo '<td><strong>'.$row['score'].'</strong></td>';
		echo '<td><a href="removescore.php?id='.$row['id'].
		'&amp;date='.$row['date'].
		'&amp;name='.$row['name'].
		'&amp;score='.$row['score'].
		'&amp;screenshot='.$row['screenshot'].'" >Remove</a> ';
		if ($row['approved'] == '0' || $row['approved'] == null) {
			echo '/ <a href="approvescore.php?id='.$row['id'].
			'&amp;date='.$row['date'].
			'&amp;name='.$row['name'].
			'&amp;score='.$row['score'].
			'&amp;screenshot='.$row['screenshot'].
			'&amp;approved='.$row['approved'].
			'" >Approve</a>';
		}
		echo '</td></tr>';
	}

	echo '</table>';

	mysqli_close($dbc);
?>
</body>
</html>