<?php

//deletes the page
//create the database
require ('../classes/Database.php');

  $database = new Database;

  $delete_id = $_POST['page_id'];
  
   
  $database->query("DELETE FROM page WHERE page_id = :id");
  $database->bind(":id", $delete_id);
  $database->execute();
?>