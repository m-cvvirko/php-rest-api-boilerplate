<?php

//ini_set('display_errors', 1); 
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
// phpinfo();

$emailFrom = 'email@email.com';
$emailBcc = 'email@email.com';
$subjectTempl = 'Info %s for %s';

$emailTo = "email@email.com";
$subject = sprintf($subjectTempl, "nickname", "Hi!");

$headers = "From: " .$emailFrom. "\r\n";
$headers .= "Reply-To: ".$emailFrom. "\r\n";
// $headers .= "BCC: $emailBcc\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$content ="Raport";

$message = '<html><body>';
$message .= $content;
$message .= "</body></html>";

$ok = mail($emailTo, $subject, $message, $headers);

echo "--------------";
echo "email:".$ok.":";
echo "--------------";

?>