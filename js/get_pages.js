function get_pages(){
  
  //now perform the ajax call
  //send the data to the php page
  $.ajax({
    url: "scripts/get_pages.php", //sends the data here
    type: "POST", //more private
    success:function (data){
      //yay..sucess??
        if (data){
           //parse the json data back into an array of objects
          var obj = JSON.parse(data);
          //now i have an array of objects       
          var demo = document.getElementById("menu");
          
          //for loop through the array
          var i;
          var len = obj.length;
          
          for (i=0;i < len;i++){
            //call the add page function
            add_page(demo,obj[i]);
          }
         
          //console.log(obj);
          //console.log(obj[0].page_id);
          
        } //end if
    },   
    error:function(){
      //not successful
  
    }//end error
  });
};