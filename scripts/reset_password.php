<?php

//the user logs in and checks it against the database.
require("../classes/Database.php");

if(!$_GET){
  echo "nope";
  die();
}

//sanitize the string
$get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

//var_dump($get);

$database = new Database;

$database->query("SELECT * FROM users WHERE email = :email AND forgot_password = :hash");
$database->bind(":email", $get['email']);
$database->bind(":hash", $get['hash']);
$database->execute();

$rows = $database->result_set();

if (!$rows){
  echo "<p class='alert alert-danger'>Not found</p>";
  die();
}

echo $rows[0]['email'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Resest Password</title>  
    
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>

  <body>
  <!-- the main body. it's just blank anyway -->
    <div id="main" class='container'>
    
      <form class="col-md-6" method="POST" action="reset2.php">
        <h1>Reset your password</h1>
        <div class="form-group">
          <label for="pass1">Password</label>
          <input type="password" name="pass1" class="form-control" id="pass1">
        </div>
        <input type="hidden" name="email" value="<?php echo $rows[0]['email']?>">
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </form>
    </div><!-- /#main -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
  </body>
</html>