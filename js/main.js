$(document).ready(function() {


	$(".cb").click(function(){
		
	if ($(this).is(':checked')) {
	    $(this).next("span").css("text-decoration", "line-through");
	} else {
	    $(this).next("span").css("text-decoration", "none");
	} 
		
		
	});
 
  /*
  	$.post("test.php", { name: "John", time: "2pm" })
.done(function(data) {
  alert("Data Loaded: " + data);
});
  */
 
 $(".deleteit").click(function(){
 	
 	var id=$(this).attr("id");
 	alert(id);
 	
   	$.post("/index.php/phpclasses/ajax.php", { name: "John", time: "2pm" })
.done(function(d) {
  alert(d);
});	
 	
 	
 	
 });
  
  
  
  
  
});





