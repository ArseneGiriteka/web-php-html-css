<?php
	
	$to = "giritekaarsene@gmail.com";
	$subject = "Hey";
	$message = "I m not done yet";

	$headers = "Content-Type: text/plain; charset=utf-8\r\n";
	$headers = "From : giritekaaarsene@gmail.com\r\n";

	if(mail($to, $subject, $message ))
		echo "Sent";
	else
		echo "Not Sent";

?>