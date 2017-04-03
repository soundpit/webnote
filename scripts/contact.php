<?php

//doesn't use the database...just sends me an email
$my_email = "myemail@email.com";

//sanitize the string
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
  echo "<p class='alert alert-danger'>Invalid Email Address</p>";
  die();
} 

$server = "http://$_SERVER[HTTP_HOST]";
$actual_link = $_SERVER['REQUEST_URI'];
$actual_link = explode("/",$actual_link);
$actual = array_pop($actual_link);
$shit = array_shift($actual_link);
$actual_link = implode('/',$actual_link);
$true_link =  $server.'/'.$actual_link.'/';
  
$subject = 'A question from'.$post['email']; // Give the email a subject 
$message = '
 
'.$post['email'].' sent you a question:
  
'.$post['text'].''; // Our message above including the link
  
                     
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
mail($my_email, $subject, $message, $headers); // Send our email

echo "<p class='alert alert-success'>Message Successfully Delivered</p>";


?>