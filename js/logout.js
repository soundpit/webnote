//when the user logs out
//a few things happen
//the session is reset
//the cookie is reset to 0
//the page goes back to the main page

$("#logout").on("click",function(){
  
   $.ajax({
      url: "scripts/logout.php", //sends the data here
      type: "POST", //more private
      success:function (data){
        //empty success
        //console.log(data);
       // alert("hell!");
       window.open("index.php","_self");
       
      },
      error:function(){
        //not successful
        $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the AJAX call. Please try again later.</div>");
      }
  
   });
  
});
