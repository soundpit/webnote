<?php

session_start();

$user_id;

if (isset($_SESSION['user_name'])){
  //echo "session";
  $user_id = $_SESSION['user_name'];
}else{
 //there is not session...but check for cookies
  cookie_check();
}

function cookie_check(){
  
  if (isset($_COOKIE['name'])){
     if ($_COOKIE['name'] != 0){
      //there is a session
      //validate the cookie
       validate_cookie();
      
    }else{
      //no session
     //redirect
       header('Location:index.php');
    }
   
  }//end if
 
}//end function

function validate_cookie(){
  //check for exisitng email
  $database->query('SELECT * FROM users WHERE cookie = :cookie LIMIT 1');
  $database->bind(":cookie",$_COOKIE['name']);
  $database->execute();

  //check if it fetched a result
  $rows = $database->result_set();

  if ($rows){
   
    $user_id = $rows[0]['id'];
    //redo the session variables
    $_SESSION['email']=$rows[0]['email'];
    $_SESSION['logged-in']=true;
    $_SESSION['user_id'] = $rows[0]['id'];
    $_SESSION['user_name'] = $rows[0]['user_name'];
    $user_id = $_SESSION['user_name'];
   
  }else{
    //no cookie found. 
    die(); //workspace view only
  }//end rows
  
};

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

    <title>Web Note | Work Space</title>
    
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css" />
   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css" />

  
  </head>
<!-- NAVBAR
================================================== -->
  <body>
  
    <div class="navbar-wrapper">
  
        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container-fluid">
            
            <div class="navbar-header">
              <!-- create the button that appears when the page is in mobile view -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              
              <!-- this is the brand and the logo -->
              <a class="navbar-brand" href="index.php"> <span class="glyphicon glyphicon-pencil"></span> Web Note</a>
              
            </div> <!-- /.navbar-header -->
            
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                 <li><a data-toggle='modal' data-target = '#help' href='#'>Help</a></li>
                 <li><a data-toggle='modal' data-target = '#profile' href='#'>Profile</a></li>
          
              </ul> <!-- /.navbar-nav -->
              
                 <ul class="nav navbar-nav navbar-right">
            
            <!-- ok tricky stuff here -->
                   <li><a>Welcome <?php echo $user_id; ?></a></li>
                   <li><a id="logout" href="#">Logout</a></li>
          </ul>
            </div>
          </div>
        </nav>

      
    </div>

<!-- the main body. it's just blank anyway -->
<div id="main" class='container-fluid'>
 
<div id="dock">
  <p id = "dock_title">Binder</p>

  <span id="add_page" class="glyphicon glyphicon-plus"></span>
  <span id = "book_opts" class="glyphicon glyphicon-cog" data-toggle='modal' data-target = '#settingsbindmodal'></span>
  <span id = "save_book" class="glyphicon glyphicon-save"></span>
  
<ul id="menu" class="add_menu">

</ul>
  </div> <!-- /#dock -->
  
</div><!-- /#main -->
<?php
  require ("views/help.php");
  require ("views/profile.php");
  require("views/settings_binder.php");
  require("views/settings_page.php");
    
?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  
    
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   
   
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   
    <script src="js/main.js"></script>
    <script src="js/save_pages.js"></script>
    <script src="js/get_pages.js"></script>
    <script src="js/logout.js"></script>
    <script src="js/settings_page.js"></script>
  
  </body>
</html>
