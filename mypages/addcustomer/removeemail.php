<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Remove Customer</title>
</head>
<body>
	<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
		<?php  
			$dbc = mysqli_connect('localhost','root','Biba$arsene0','elvis_store') 
					or die('Error connecting to MySQL database');

			if(isset($_POST['submit'])){
				foreach ($_POST['todelete'] as $delete_id) {
					$delete_id_query = "DELETE FROM email_list WHERE id=$delete_id";

					mysqli_query($dbc,$delete_id_query)
					or die("Error querying database");
				}
				echo 'Customer(s) removed.<br>';
			}

			$query = "SELECT * FROM email_list";

			$result = mysqli_query($dbc,$query) or die('Error querrying MySQL database');

			while($row = mysqli_fetch_array($result)){
				echo '<input type="checkbox" value="'.$row['id'].'" name="todelete[]" />';

				echo '			'.$row['first_name'];
				echo '			'.$row['last_name'];
				echo '			'.$row['email'];
				echo '<br>';
			}

			mysqli_close($dbc);
		?>
		<input type="submit" name="submit" value="Remove">
	</form>
</body>
</html>