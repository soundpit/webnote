$("#contactform").submit(function(event){
  
  //prevent the default php processing
  event.preventDefault();
  
  //wipe the signupmessage
  $("#contactmessage").html('');
  
  //collect the user input
  //converts it to an array of objects. quite cool
  var datatopost = $(this).serializeArray(); 
  
  //now perform the ajax call
  //send the data to the php page
  $.ajax({
    url: "scripts/contact.php", //sends the data here
    type: "POST", //more private
    data: datatopost, //the data to post
    success:function (data){
      //yay..sucess??
        if (data){
          //execute statement
           $("#contactmessage").html(data);
        } //end if
    },   
    error:function(){
      //not successful
      $("#contactmessage").html("<div class='alert alert-danger'>There was an error with the AJAX call. Please try again later.</div>");
      
    }
  });
});