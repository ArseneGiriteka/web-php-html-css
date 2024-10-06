<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>assistance pratform</title>
</head>
<body>
	<?php
		echo file_get_contents('header.php');
	?>
	<div>
		<form method="submit" action="the_file_iwll write in php">
			<p>
				<label for="message">write down your problemes and magicaly they 'll all fade away</label><br>
				<textarea name="message" id="message"></textarea><br>
				<input type="submit" value="send">
			</p>
		</form>
	</div>
	<?php
		echo file_get_contents('footer.php');
	?>
</body>
</html>