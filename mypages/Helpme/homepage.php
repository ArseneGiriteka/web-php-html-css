<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Helpme</title>
	<link rel="stylesheet" type="text/css" href="homepage.css">
</head>
<body>
	<div id="my_site">
		<div id = "main_part">
			<div id="header_id">
				<?php
				echo file_get_contents('header.php');
				?>
			</div>
			<section id="section_content_id">
				<p>
					HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
				</p>
			</section>
			<aside id="aside_content_id">
				<p>
					AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
				</p>
			</aside>
		</div>
		<div id="footer_id">
			<?php
			echo file_get_contents('footer.php');
			?>
		</div>
	</div>
</body>
</html>