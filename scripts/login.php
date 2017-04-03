<?php

//the user logs in and checks it against the database.
require("../classes/Database.php");

//sanitize the string
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$database = new Database;

//functions
test_input($post);                              //checks for valid input
validate_email($post['loginemail']);                 //test for valid email
check_for_user($post,$database);       //checks that the user is actually registered

function test_input($post){
  //loop through the post and check if all fields are set
  foreach ($post as $value) {
    if (empty(trim($value))){
      echo "<div class='alert alert-danger'>Please fill out all fields.</div>";
      die();
    }
  }    
} // end test_input

function check_for_user($post,$database){
  
  //check for exisitng email
  $database->query('SELECT * FROM users WHERE email = :email LIMIT 1');
  $database->bind(":email",$post['loginemail']);
  $database->execute();

  //check if it fetched a result
  $rows = $database->result_set();

  if ($rows){
    if (password_verify($post['loginpassword'],$rows[0]['password'])) {
      // Correct Password
      //its the correct password.set the session variables. go to the users account
      session_start();
      $_SESSION['email']=$rows[0]['email'];
      $_SESSION['logged-in']=true;
      $_SESSION['user_id'] = $rows[0]['id'];
      $_SESSION['user_name'] = $rows[0]['user_name'];
      
      if (isset($post['rememberme'])){
        //set the cookie
        $cookie_name = "name";
        $hash = md5(rand(0,1000));
        $cookie_value = $hash;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        
        //update cookie
        update_cookie($post,$database,$hash);
      }else{
        //wipe the cookie
        setcookie ("name", "", time() - 3600);
        $hash = 0;
        update_cookie($post,$database,$hash);
      }
      
      echo "success";
        
    } else {
      // Wrong password
      echo "<div class='alert alert-danger'>Incorrect login details</div>";
      die();
    }//end password verify
  }else{
    echo "<div class='alert alert-danger'>User doesn't exist!</div>";
    die();
  }//end rows
  
}//end check for user

function validate_email($email){
  
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo "<div class='alert alert-danger'>Invalid Email address.</div>";
    die();
  } 
  
}//end validate email

function update_cookie($post,$database,$hash){
  
     //check for exisitng email
     $database->query("UPDATE users SET
                                    cookie = :cookie                       
                                  WHERE email = :email");
  
  $database->bind(":email",$post['loginemail']);
  $database->bind(":cookie",$hash);
  $database->execute();
  
}

?>