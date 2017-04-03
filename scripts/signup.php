<?php

/* Sign in.
table: users
user_name -varchar
email - varchar
password - varchar
verified - varchar

*/

require("../classes/Database.php");

require("send_mail.php");

//sanitize the string
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$database = new Database;

//functions
test_input($post);                                        //cheks for input validity
check_for_user($post['email'],$database);                 //check for existing user
validate_email($post['email']);                           //check for valid email
match_passwords($post['password'],$post['password2']);    //check for matching passwords
$post['password'] = hash_password($post['password']);     //hash passwords

//ok by this stage everything is valid and passes. time to add it
add_user($post,$database);

function test_input($post){
  
  //loop through the post and check if all fields are set
  foreach ($post as $value) {
    if (empty(trim($value))){
      echo "<div class='alert alert-danger'>Please fill out all fields.</div>";
      die();
    }
  } 
 
} // end test_input

function check_for_user($email,$database){
  
//check for exisitng email
$database->query('SELECT * FROM users WHERE email = :email');
$database->bind(":email",$email);
$database->execute();

//check if it fetched a result
$rows = $database->result_set();
  if ($rows){
    echo "<div class='alert alert-danger'>Email already in use.</div>";
    die();
  }
  
}//end check for user

function validate_email($email){
  
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo "<div class='alert alert-danger'>Invalid Email address.</div>";
    die();
  } 
  
}//end validate email

function match_passwords($password, $password2){
  
  if ($password !== $password2){
    echo "<div class='alert alert-danger'>Passwords don't match!.</div>";
    die();
  }
  
} // end match passwords

function hash_password ($password){
  
  return password_hash($password, PASSWORD_DEFAULT);
   
}// end hash passwords

function add_user($post,$database){
  
//create email verification number
$hash = md5(rand(0,1000));
  
//check for exisitng email
$database->query('INSERT INTO users (user_name,email,password,verified)
                              VALUES (:username, :email, :password, :verified)');
  
$database->bind(":email",$post['email']);
$database->bind(":username",$post['username']);
$database->bind(":password",$post['password']);
$database->bind(":verified",$hash);
  
$database->execute();
  
  send_mail($post['username'],$post['email'],$hash);

  echo "<div class='alert alert-success'>You have successfully registerd<br>A verification email has been sent to activate your account.</div>";
   
}

?>