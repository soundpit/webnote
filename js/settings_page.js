$("#settingspageform").submit(function(event){
  
  //prevent the default php processing
  event.preventDefault();
  
  //console.log("here");
   
  //collect the user input
  //converts it to an array of objects. quite cool
  var datatopost = $(this).serializeArray(); 
  
  //console.log(datatopost[0].value);
   Globals.current_link.children[1].innerHTML = datatopost[0].value;
  Globals.current_page.children[0].innerHTML = datatopost[0].value;
  
});