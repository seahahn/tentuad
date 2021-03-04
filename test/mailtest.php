<?php
$to = "tnstls93@naver.com";
$subject = "Greeting";
$message = "Hello\nWorld";
$headers = 'From:noreply@tentuad.io' . "\r\n"; // Set from headers
mail( $to, $subject, $message, $headers );
?>