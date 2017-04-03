<?php

session_start();
/*
This script retrieves all the pages. The fields to retrieve are
table - page
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

//sanitize the post
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//get the query
//the only thing to get is based on the user_id
//$database->query("SELECT * FROM page WHERE user_id = :id");

$database->query("SELECT * FROM page WHERE user_id = :id");

//bind the values
//$database->bind(":id", $post['id']);
$database->bind(":id", $_SESSION['user_id']);

//execute the statement
$database->execute();

//now I have all the pages.
//this gets an associative array
$rows = $database->result_set();

echo json_encode($rows); //not really sure if this is the right thing to do. we'll see


?>