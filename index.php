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
    //die(); //workspace view only
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

    <title>Web Note | Home</title>
    
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css" />
   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     
    <!-- main stylesheet -->
    <link rel="stylesheet" href="css/style.css" />
<style>

.main_title{
	margin-top:1em;
	color:white;
	margin-bottom:1em;
}

.main_image {
	color:white;
	font-size:10em;

}

.main_text {
	color:white;
	margin:30px;
  font-size:24px;
}

.btn_log {
	margin-right:30px;
}

.btn_reg {
	1color: #222;
}

.btn_reg:hover {
	1color: #222;
}

.btn_reg:active {
	/* this is being overridden somehow */
	1color: #222 !important;
}
  
html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #333;
  color:#ddd;
  font-size:12px;
}

.footer p {
    line-height:60px;
}
</style>
 
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
              <a class="navbar-brand" href="#"> <span class="glyphicon glyphicon-pencil"></span> Web Note</a>
              
            </div> <!-- /.navbar-header -->
            
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a data-toggle='modal' data-target = '#about' href='#'>About</a></li>
                <li><a data-toggle='modal' data-target = '#contact' href='#'>Contact</a></li>
              </ul> <!-- /.navbar-nav -->
			   <ul class="nav navbar-nav navbar-right">
                 <?php
                 if (isset($user_id)){
                   echo "<li><a href='#'>Welcome ".$user_id."</a></li>";
                   echo "<li><a href='work_space.php'>My Pages</a></li>";
                   echo "<li><a id='logout' href='#'>Logout</a></li>";
                  }else{
                     echo  "<li><a data-toggle='modal' data-target = '#login' href='#'>Login</a></li>";
                 }
                 ?>
               </ul>
            </div><!-- navbar collapse -->
          </div><!-- container fluid -->
        </nav><!-- navbar -->
    </div> <!-- /navbar wrapper -->

<!-- the main body. it's just blank anyway -->
<div id="main" class='container-fluid'>
 
 <div class="row text-center">
  <h1 class="main_title">Welcome to Webnote</h1>
  <span class="glyphicon glyphicon-pencil main_image"></span>
  <p class="main_text">Store your words on the web</p>
  <a class="btn btn_reg btn-success btn-lg" data-toggle="modal" data-target = "#register" href="#">Sign up now - it's free!<a>
  </div><!-- /row -->
  
</div><!-- /#main -->
   

<?php
   
  require ("views/login.php");
  require ("views/registration.php");
  require ("views/forgotpassword.php");
  require ("views/contact.php");
  require ("views/about.php");
  require ("views/privacy_policy.php");
   
?>
   
    <footer class="footer">
      <div class="container">
        <p class="text-center">&copy <?php echo date("Y"); ?> Evan Scofield | <a data-toggle='modal' data-target = '#privacypolicy' href='#'>Privacy Policy
          </a></p>
      </div>
    </footer>
   
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

   <!-- custome scripts -->
  <script src="js/user.js"></script>
  <script src="js/main.js"></script>
  <script src="js/logout.js"></script>
   <script src="js/contact.js"></script>
  
  </body>
</html>
