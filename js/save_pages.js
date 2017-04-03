
$('#save_book').on('click',function(){
  
  //save all the things. create a json object. save one by one? might be a good idea
   $(".page").each(function( index ) {
      $.ajax({
      url: "scripts/save_pages.php", //sends the data here
      type: "POST", //more private
      data: {
        page_id: this.id,
        page_title: this.children[0].innerText,
        page_text: this.children[1].children[0].value,
        page_left: this.style.left,
        page_top: this.style.top,
        page_width: this.children[1].style.width,
        page_height: this.children[1].style.height,
        z_index: this.style.zIndex
      }, //the data to post
      success:function (data){
       console.log('save data:' + data);
       },   
      error:function(){
        //not successful
        $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the AJAX call. Please try again later.</div>");
      }
    });//end ajax;
  });
});