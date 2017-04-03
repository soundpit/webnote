<?php

//create the database
require ('../classes/Database.php');

$database = new Database;

//sanitize string
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$hash = password_hash($_POST['pass1'], PASSWORD_DEFAULT);

$database->query("UPDATE users SET
                                password = :pass,
                                forgot_password = :forgot
                                WHERE email = :email");
  
$database->bind(':pass', $hash);
$database->bind(':forgot',0);
$database->bind(':email',$_POST['email']);

$database->execute();
                
echo "<p>Password Updated Successfully</p>";
echo "<a href='../index.php'>Back to home page </a>";

?>