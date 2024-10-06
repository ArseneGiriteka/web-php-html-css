<?php 
	//header('Location:index.php');
	//header('Refresh: 5; url=http://192.168.1.16/mypages/guitarwars/index.php');
	//header('Content-Type: text/plain');
	$username = 'bibo';
	$password = 'Biba$arsene0';

	if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||                       ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)){
		echo 'hello';
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Basic realm="Guitar Wars"');
		exit('<h2>Guitar Wars</h2>Sorry, you must enter a valid user and name password to access this page.');
	}
?>