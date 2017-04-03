<?php
//when the user logs out
//a few things happen
//the session is reset
//the cookie is reset to 0
//the page goes back to the main page
session_start();

//the user logs in and checks it against the database.
require("../classes/Database.php");

//sanitize the string
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$database = new Database;

$database->query("UPDATE users SET
                              cookie = :cookie
                              WHERE id = :id");
  
$database->bind(':id', $_SESSION["user_id"]);
$database->bind(':cookie',0);

$database->execute();

//session_destroy($_SESSION);
$_SESSION = array();

//$_COOKIE['name']=0;
 setcookie("name", 0, time() + (86400 * 30), "/");

//var_dump($_COOKIE);

?>