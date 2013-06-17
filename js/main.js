$(document).ready(function() {


	$(".cb").click(function(){
		
	if ($(this).is(':checked')) {
	    $(this).next("span").css("text-decoration", "line-through");
	} else {
	    $(this).next("span").css("text-decoration", "none");
	} 
		
		
	});
 

  
  
  
  
});





