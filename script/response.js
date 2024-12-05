$(document).ready(function() {
 
	 	//function for submit registration in the database 
		$('#submitBtn').click(function(event) {
        		event.preventDefault();
		   var formData = new FormData();
	        formData.append("profile", $(".profile")[0].files[0]);
	        formData.append("name", $(".name").val());
	        formData.append("pwd", $(".pwd").val());
	        formData.append("edu", $(".edu").val());
	        formData.append("exp", $(".exp").val());
	        formData.append("work", $(".work").val());
	        formData.append("availableIn", $(".availableIn").val());
	        formData.append("availableOut", $(".availableOut").val());

	        // Validate required fields
	        if (!$(".name").val() || !$(".pwd").val() || !$(".edu").val() || !$(".exp").val() || !$(".work").val() || !$(".availableIn").val() || !$(".availableOut").val()) {
	            console.log("Missing required fields");
	            alert( "Please fill in all required fields.");
	            return;
	        }
		 // send data to the php page
	        $.ajax({
	            type: "POST",
	            url: "register-emp-user.php",
	            data: formData,
	            contentType: false,  
	            processData: false,  
	            success: function() {
	                showPop();//from validation.js
	                resetData();//from validation.js

	            }
	        });
	    });

});
