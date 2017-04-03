//create a globals object
var Globals = {
  current_page:'' ,
  current_link:'' ,
  zindex: 101
}

$(document).ready(function(){
  
  //create the object
  var click_button = document.getElementById("add_page");
  var demo = document.getElementById("menu");

  //do the steps that add a new page
  click_button.addEventListener("click", function(){ 
    add_page(demo);
  }); //end add page
  
  var dock_2 = document.getElementById('dock');

  $('#dock').draggable();
  
  get_pages();//load all the pages from the database

}); // end document ready

$("#dock").on('click',function(){
  
   //if the zindex matches. the page is already ontop
      if (this.style.zIndex != Globals.zindex){
       // console.log(this.style.zIndex);
       // console.log(Globals.zindex); 
      Globals.zindex += 1;
      this.style.zIndex = Globals.zindex;
      }   
  
});

//the page object constructor
function Page(){
	
  var page = document.createElement('div');
  //assign it a class
  page.className = "page";

  //create the heading
  var head = document.createElement('p');
  head.className = "page_head";
  var tex = document.createTextNode("Page Header");
  head.appendChild(tex);

  var text_area = document.createElement('textarea');
  text_area.className = "page_text";
  text_area.setAttribute("autocomplete","off");

  page.appendChild(head);
  page.appendChild(text_area);

  //give it a zindex
  Globals.zindex += 1;
  page.style.zIndex = Globals.zindex;
  //console.log(Globals.zindex);

  //add it to itself
  this.page = page;

  this.page_id; //create the page id

  //add it to the document
  document.getElementById('main').appendChild(page);

  //mousedown for the z-index test
  page.addEventListener('mousedown', function(){

    //if the zindex matches. the page is already ontop
    if (this.style.zIndex != Globals.zindex){
      //console.log(this.style.zIndex);
      // console.log(Globals.zindex); 
      Globals.zindex += 1;
      this.style.zIndex = Globals.zindex;
    }    
  }); // mousdown
} //end page

function add_page(demo,pages_array){
  
    //quite messy here...does all the page shit
    //create the link
    var link = document.createElement('li');
    link.className = "page_link";

    // this works - arrow
    var arrow = document.createElement('span');
    arrow.className = "glyphicon glyphicon-ok arrow";
    link.appendChild(arrow);

    //create text span
    var t_span = document.createElement('span');
    t_span.className ="text_span";
    var t = document.createTextNode("Page");
    t_span.appendChild(t);
    link.appendChild(t_span);
  
    //options
    var opts = document.createElement('span');
    opts.className = "glyphicon glyphicon-cog opts";
     //set the bootstrap data
    opts.setAttribute("data-toggle","modal");
    opts.setAttribute("data-target","#settingspagemodal");
    link.appendChild(opts);
  
    //delete
    var del = document.createElement('span');
    del.className = "glyphicon glyphicon-trash trash";
    link.appendChild(del);
  
    //add it to the menu
    demo.appendChild(link);
  
    //the visibility thing
    arrow.addEventListener("click", function(){

      if (link.page.page.style.visibility == "hidden"){
        link.page.page.style.visibility = "visible";
        //console.log(link.page.page.style.visibility);
        this.className = "glyphicon glyphicon-ok arrow";
        this.style.color = "green";
      }else{
        link.page.page.style.visibility = "hidden";
        //console.log(link.page.page.style.visibility);
        this.className = "glyphicon glyphicon-remove arrow";
        this.style.color = "red";
      } //end if
     }); // end listener
  
    //the delete thing
    del.addEventListener("click", function(){

      //delete the page
      //how do u delete an object?
      //delete the page first
      //then delete the link
      delete_page(link.page.page.id);
    
      document.getElementById('main').removeChild(link.page.page);
      document.getElementById('menu').removeChild(link);
   
     }); // end delete
  
    opts.addEventListener("click",function(){
      
      Globals.current_page = link.page.page;
      Globals.current_link = link;
      
      //alert(Globals.current_page.style.left);
      
    })
  
  //now to set the active
    t_span.addEventListener('click', function(){
      /*
      //alert("click");
        if (Globals.current_link == ''){
         //there is currently no active link
         //set the current link
         Globals.current_link = link;
         Globals.current_page = link.page.page;
          Globals.current_page.style.border = "5px solid #ddd";
        Globals.current_link.style.backgroundColor = "#ccc";
         Globals.current_link.style.color = "#222";
         console.log(Globals.current_page);
         //set the colors
         //color setting here
      } //end if

      if (Globals.current_link !== link){
        //it's not the same link. 
        Globals.current_page.style.border = "1px solid black";
        Globals.current_link.style.backgroundColor = "#333";
        Globals.current_link.style.color = "#fff";
        //1. change colour of the current link back to normal
        //2. Set the new current objects
        Globals.current_link = link;
        Globals.current_page = link.page.page;
        //3. Change the colours of the new objects  
        Globals.current_page.style.border = "5px solid #ddd";
        Globals.current_link.style.backgroundColor = "#ccc";
        Globals.current_link.style.color = "#222";
      } //end active highlight
    */
    }); // end click text node
  
  if (!pages_array){
    //create a new object
    //create the page
  var new_page = new Page();
  
  //for now just dump the page in a random position
  new_page.page.style.left = Math.round(Math.random() * 400) + 'px';
  new_page.page.style.top = Math.round(Math.random() * 500) + 'px';
  
  //add the reference to the link
  link.page = new_page;
  
  //console.log(link.page);
  // $( ".page" ).css( "border", "3px solid red" );
  $( ".page" ).draggable();
  $( 'textarea').resizable()
    
  }else{
    
    var new_page = new Page();   
    new_page.link = link;
    
   //new_page.page.style.border= "thick solid #0000FF";
    new_page.page.id = pages_array.page_id;
    new_page.page.style.left = pages_array.page_left + 'px';
    new_page.page.style.top = pages_array.page_top + 'px';
    new_page.page.children[0].innerText = pages_array.page_title;
    //new_page.page.children[1].textContent = pages_array.page_text;
    new_page.page.children[1].innerHTML = pages_array.page_text;
    new_page.page.children[1].style.width = pages_array.page_width + 'px';
    new_page.page.children[1].style.height = pages_array.page_height + 'px';
    new_page.page.style.zIndex = pages_array.z_index;
    t.textContent = pages_array.page_title;
   
    //add the reference to the link
    link.page = new_page;
  
 // console.log(link.page);
 
  $( ".page" ).draggable();
  $( 'textarea').resizable()
    
  }// end else
  
};

function delete_page(id){
   
   $.ajax({
      url: "scripts/delete_page.php", //sends the data here
      type: "POST", //more private
      data: { page_id: id },
      success:function (data){
        //empty success
        console.log(data);
          
      },
      error:function(){
        //not successful
        $("#loginmessage").html("<div class='alert alert-danger'>There was an error with the AJAX call. Please try again later.</div>");
      }
  
});
  
  
}
