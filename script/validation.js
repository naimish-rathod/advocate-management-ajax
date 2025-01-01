$('#submitBtn').click(function(e) {
        		e.preventDefault();
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
	            $(".alert").addClass("alert-show");
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
	//For close alert button
		 		$(document).on('click', '#close-alert', function(){
		 			$(".alert").removeClass("alert-show");
		 		});

 	function imgValidate( ) {
		 let img = document.getElementById("img");
		 let errMsg = document.getElementById("errMsg");
		 let err = document.getElementById("err");
		 let fname = img.value;
		 let dot = fname.lastIndexOf(".")+1;
		 let ext = fname.substr(dot,fname.length).toLowerCase();
		 
		 if(ext=="jpg" || ext=="png" || ext=="jpeg") {
		 	err.style.display = "none";
		 }else {
		 	 img.value="";
		 	 $(".alert").addClass("alert-show");
		 	 $('.alert-txt').text(ext+" File is not accepted");
		 	 err.style.display = "unset";
		 }
	}
	function strValidate(event, errId, txtId) {
    	let txt = document.getElementById(txtId);
    	let txtVal = txt.value ;
       	let errMsg = document.getElementById(errId);

     	if(/^[a-zA-Z\s]+$/.test(txtVal.trim())) {
     		errMsg.style.display = "none";
     	}else {
     		txt.value="";
     		errMsg.style.display = "unset";
     		$(".alert").addClass("alert-show");
		 	$('.alert-txt').text("Enter alphabets only");
     	}
	}
	function intValidate() {
		let txt = document.getElementById("txt-3");
		let txtVal = txt.value;
		let errMsg = document.getElementById("err-3");
		let checkInt = Number.isInteger(Number(txtVal));//check that the entered number is integer or not ?

		if(checkInt === false) {
			txt.value = "";
			errMsg.style.display= "unset";
			$(".alert").addClass("alert-show");
		 	$('.alert-txt').text("Do not enter alphabets");
		} else {
			errMsg.style.display= "none";
		}

	}

	// for the remove warning message 
		var getPass = document.getElementById("getPass");
		var capitalId = document.getElementById("capitalId");
		var smallId = document.getElementById("smallId");
		var numberId = document.getElementById("numberId");
		var specialId = document.getElementById("specialId");
		var lengthId = document.getElementById("lengthId");
		var submitBtn = document.getElementById("submitBtn");

		getPass.onkeyup = () => {
	    
		    let inputVal = getPass.value;
		    var length = inputVal.length;
		    var lowerCase = /[a-z]/g;
			var uperCase = /[A-Z]/g;
			var number = /[0-9]/g;
			var special = /[^a-zA-Z0-9]/g;
			// optional method useful if only match the passwprd dont show hide warnings
			// var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{8,}$/;

			// Special character
			if(inputVal.match(special)) {
	    		 specialId.style.display = "none";
	    	} else { 
	    		 specialId.style.display = "unset";
	    	}
	    	
	    	// Uppercase character
			if(inputVal.match(uperCase)) {
	    		 capitalId.style.display = "none";
	    	} else { 
	    		 capitalId.style.display = "unset";
	    	}

	    	// Lower character 
	    	if(inputVal.match(lowerCase)) {
	    		 smallId.style.display = "none";
	    	} else { 
	    		 smallId.style.display = "unset";
	    	}

	    	//Number 
	    	if(inputVal.match(number)) {
	    		 numberId.style.display = "none";
	    	} else { 
	    		 numberId.style.display = "unset";
	    	}

	    	//8 digit
	    	if(inputVal.length > 8) {
	    		 lengthId.style.display = "none";
	    	} else { 
	    		 lengthId.style.display = "unset";
	    	}

	    	if(
	    		inputVal.match(special) &&
	    		inputVal.match(uperCase) &&
	    		inputVal.match(lowerCase) &&
	    		inputVal.match(number) &&
	    		inputVal.length > 8
	    		) {
		    		validation.style.display = "none";
		    		submitBtn.disabled = false;
				} else {
					validation.style.display = "unset";
		    		submitBtn.disabled = true;
				}

	}; 

	// for show and hide the validation div 
		var valBox = document.querySelector("#valBox");
		var validation = document.querySelector(".validation");
		getPass.onfocus = () => {
			validation.style.display = "unset";
		}
		getPass.onblur = () => {
			validation.style.display = "none";
		}

		function showPop(event) {

			// Show the popup by adding the 'open-popup' class
			var popup = document.getElementById("popup");
			popup.classList.add("open-popup");

			var regTab = document.getElementById("regTab");
			//blur background form 

			regTab.classList.add("blur-content");

		}
		function hidePop() {
			 popup.classList.remove("open-popup");
			 regTab.classList.remove("blur-content");
		}
		function resetData() {
			var name =  document.querySelector(".name");
			var profile =  document.querySelector(".profile");
			var pwd =  document.querySelector(".pwd");
			var edu =  document.querySelector(".edu");
			var exp =  document.querySelector(".exp");
			var work =  document.querySelector(".work");
			var availableIn =  document.querySelector(".availableIn");
			var availableOut =  document.querySelector(".availableOut");
				name.value = "";
				profile.value = "";
				pwd.value = "";
				edu.value = "";
				exp.value = "";
				work.value = "";
				availableIn.value = "";
				availableOut.value = "";
		}

 