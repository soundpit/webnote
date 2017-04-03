<?php

//create the database
require ('../classes/Database.php');

$database = new Database;

//sanitize string
$get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

check_for_user($get,$database);

function check_for_user($get,$database){
  
//check for exisitng email
$database->query('SELECT * FROM users WHERE email = :email');
$database->bind(":email",$get['email']);
$database->execute();

//check if it fetched a result
$rows = $database->result_set();
  
 // echo('<br>'.$rows[0]['verified']);
  
  if (!$rows){
    echo "<div class='alert alert-danger'>No email in database</div>";
    die();
  }else{
    
    if ($rows[0]['verified'] === $get['hash']){
      //user is now verified
      echo "<div class='alert alert-sucess'>Account Verified.<br><a href='../index.php'>Back to main page</a></div>";
      reset_verification($get,$database);
      
      
    }else{
      echo "<div class='alert alert-danger'>Verifiction Failed</div>";
      die();
    }
  }
  
}//end check for user

function reset_verification($get,$database){
  
  //check for exisitng email
     $database->query("UPDATE users SET
                                    verified = 'verified'
                                    WHERE email = :email");
  
  
  $database->bind(":email",$get['email']);
  $database->execute();
  
  
}

?>