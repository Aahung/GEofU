<?php
require_once "Mail.php";
function sendMail($to, $subject, $body) {
	$from = "geofu@cityofu.com";
	$host = "smtp.live.com";
	$port = "587";
	$username = "geofu@cityofu.com";
	$password = "ge.cityofu";

	$headers = array ('From' => $from,
		'To' => $to,
		'Subject' => $subject);
	$smtp = Mail::factory('smtp',
	array ('host' => $host,
		'port' => $port,
		'auth' => true,
		'username' => $username,
		'password' => $password));

	$mail = $smtp->send($to, $headers, $body);
	// if (PEAR::isError($mail)) {
	//    echo("<p>" . $mail->getMessage() . "</p>");
	//   } else {
	//    echo("<p>Message successfully sent!</p>");
	//   }

}
	

	
	
	 ?>