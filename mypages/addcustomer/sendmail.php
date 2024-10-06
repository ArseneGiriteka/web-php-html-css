<?php
	$dbc = mysqli_connect('localhost','root','Biba$arsene0','elvis_store') 
	or die("Error connecting to MySQL database");

	$from = 'giritekaarsene@gmail.com';
	$subject = $_POST['subject'];
	$text = $_POST['elvis_mail'];
	$isFormSet = isset($_POST['submit']);

	if ((!empty($subject)) && (!empty($text))) {
			$query = "SELECT * FROM email_list";
			$result = mysqli_query($dbc,$query);

			while ($row = mysqli_fetch_array($result)) {
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];

				$msg = "Dear $first_name $last_name;\n $text";

				$to = $row['email'];

				mail('giritekaarsene@gmail.com', $subject, $msg, 'from : '.$from);

				echo 'Email sent to '.$to.'<br>';
			}

			mysqli_close($dbc);
		}
		else{
			if (empty($subject) && ($isFormSet)) {
				// code...
				echo "Empty subject<br>";
			}

			if (empty($text) && ($isFormSet)) {
				// code...
				echo "Empty mail text<br>";
			}
			?>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<label for="subject">Subject of email:</label><br>
				<input type="text" name="subject" id="subject" value="<?php echo $subject; ?>"><br>
				<label for="elvis_mail">Body of email:</label><br>
				<textarea name="elvis_mail" id="elvis_mail" rows="8" cols="60"><?php echo $text ?></textarea>
				<input type="submit" name="submit" value="submit">
			</form>
			<?php
		}
		
?>