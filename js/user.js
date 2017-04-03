/*
This script handles
1. User Registration
2. User Login
3. Forgot Password
4. Misc Stuff
*/

//sign up code
$("#registerform").submit(function(event){
  
  //prevent the default php processing
  event.preventDefault();
  
  //wipe the signupmessage
  $("#signupmessage").html('');
  
  //collect the user input
  //converts it to an array of objects. quite cool
  var datatopost = $(this).serializeArray(); 
  
  //console.log(datatopost);
  
  //now perform the ajax call
  //send the data to the php page
  $.ajax({
    url: "scripts/signup.php", //sends the data here
    type: "POST", //more private
    data: datatopost, //the data to post
    success:function (data){
      //yay..sucess??
        if (data){
          //execute statement
           $("#signupmessage").html(data);
        } //end if
    },   
    error:function(){
      //not successful
      $("#signupmessage").html("<div class='alert alert-danger'>There was an error with the AJAX call. Please try again later.</div>");
      
    }
  });
});

//now do the login functionality
$("#loginform").submit(function(event){
  
   //prevent the default php processing
  event.preventDefault();
  
    $("#loginmessage").html('');
  
  //collect the user input
  //converts it to an array of objects. quite cool
  var datatopost = $(this).serializeArray(); 
  
   //now perform the ajax call
  //send the data to the php page
  $.ajax({
    url: "scripts/login.php", //sends the data here
    type: "POST", //more private
    data: datatopost, //the data to post
    success:function (data){
        if (data === "success"){
          
           window.location = "work_space.php";
        }else{
              $('#loginmessage').html(data);
        } //end if
    },   
    error:function(){
      //not successful
      $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the AJAX call. Please try again later.</div>");
     
    }
  });
});

//now do the login functionality
$("#forgotpasswordform").submit(function(event){
  
   //prevent the default php processing
  event.preventDefault();
  
    $("#forgotpasswordmessage").html('');
  
  //collect the user input
  //converts it to an array of objects. quite cool
  var datatopost = $(this).serializeArray(); 
  
   //now perform the ajax call
  //send the data to the php page
  $.ajax({
    url: "scripts/forgotpassword.php", //sends the data here
    type: "POST", //more private
    data: datatopost, //the data to post
    success:function (data){
      
            alert(data);
              $('#forgotpasswordmessage').html(data);
    
    },   
    error:function(){
      //not successful
      $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the AJAX call. Please try again later.</div>");
     
    }
  });
});


