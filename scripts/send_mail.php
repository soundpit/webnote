<?php

function send_mail ($user_name,$email,$hash){

$server = "http://$_SERVER[HTTP_HOST]";
$actual_link = $_SERVER['REQUEST_URI'];
$actual_link = explode("/",$actual_link);
$actual = array_pop($actual_link);
$shit = array_shift($actual_link);
$actual_link = implode('/',$actual_link);
$true_link =  $server.'/'.$actual_link.'/';
  
  
$to      = $email; // Send email to our user
$subject = 'Activate your Webnote account'; // Give the email a subject 
$message = '
 
Thanks for signing up!
  
Please click this link to activate your account:
'.$true_link.'verify.php?email='.urlencode($email).'&hash='.$hash.'

 
'; // Our message above including the link
                     
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email


};



?>