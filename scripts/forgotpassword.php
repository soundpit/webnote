<?php

require("../classes/Database.php");

//sanitize the string
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$database = new Database;

//check to see if the user exists
check_for_user($post['forgotpasswordemail'],$database);

function check_for_user($email,$database){
  
//check for exisitng email
$database->query('SELECT * FROM users WHERE email = :email');
$database->bind(":email",$email);
$database->execute();

//check if it fetched a result
$rows = $database->result_set();
  if (!$rows){
    echo "<div class='alert alert-danger'>Didn't find user!</div>";
    die();
  }else{
    //send an email
    //create a verification hash
    //create email verification number
    $hash = md5(rand(0,1000));
    reset_pass_mail ($rows[0]['user_name'],$rows[0]['email'],$hash);
    
    insert_hash($rows[0]['id'],$hash,$database);
    
  }
  
}//end check for user

function insert_hash($id,$hash,$database){
  
  $database->query("UPDATE users SET forgot_password = :hash WHERE id=:id");
  $database->bind(":id",$id);
  $database->bind(":hash",$hash);
  $database->execute();
  
}

function reset_pass_mail ($user_name,$email,$hash){

$server = "http://$_SERVER[HTTP_HOST]";
$actual_link = $_SERVER['REQUEST_URI'];
$actual_link = explode("/",$actual_link);
$actual = array_pop($actual_link);
$shit = array_shift($actual_link);
$actual_link = implode('/',$actual_link);
$true_link =  $server.'/'.$actual_link.'/';
  
  
$to      = $email; // Send email to our user
$subject = 'Reset Your Password'; // Give the email a subject 
$message = '
 
Follow the link to reset your password

'.$true_link.'reset_password.php?email='.urlencode($email).'&hash='.$hash.'

 
'; // Our message above including the link
                     
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email


};

?>