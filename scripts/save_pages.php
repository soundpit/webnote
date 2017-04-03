<?php

session_start();

/*
This script saves all the pages. 
The fields to save are:
page_id - int
user_id - int
page_title - varchar
page_text - text
page_top - int
page_left - int
page_width - int
page_height - int
z_index - int
*/

//create the database
require ('../classes/Database.php');

$database = new Database;

//sanitize string
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if (empty($_POST['page_id'])){
  
  //it's a new post
  $database->query("INSERT INTO page (
                                    user_id,
                                    page_title,
                                    page_text,
                                    page_top,
                                    page_left,
                                    page_width,
                                    page_height,
                                    z_index
                                     )
                              VALUES (
                                    :user_id,
                                    :page_title,
                                    :page_text,
                                    :page_top,
                                    :page_left,
                                    :page_width,
                                    :page_height,
                                    :z_index)");
  
  
$database->bind(':user_id', $_SESSION['user_id']);
$database->bind(':page_title',$_POST['page_title']);
$database->bind(':page_text',$_POST['page_text']);
$database->bind(':page_top',$_POST['page_top']);
$database->bind(':page_left',$_POST['page_left']);
$database->bind(':page_width',$_POST['page_width']);
$database->bind(':page_height',$_POST['page_height']);
$database->bind(':z_index',$_POST['z_index']);
  
}else{
  //update
   $database->query("UPDATE page SET
                                    page_title = :page_title,
                                    page_text = :page_text,
                                    page_top = :page_top,
                                    page_left = :page_left,
                                    page_width = :page_width,
                                    page_height = :page_height,
                                    z_index = :z_index
                                  WHERE page_id = :page_id");
  
$database->bind(':page_id', $_POST['page_id']);
$database->bind(':page_title',$_POST['page_title']);
$database->bind(':page_text',$_POST['page_text']);
$database->bind(':page_top',$_POST['page_top']);
$database->bind(':page_left',$_POST['page_left']);
$database->bind(':page_width',$_POST['page_width']);
$database->bind(':page_height',$_POST['page_height']);
$database->bind(':z_index',$_POST['z_index']);
                             
};

$database->execute();

?>