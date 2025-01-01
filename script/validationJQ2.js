$(document).ready(function() {
	 
	 // For register a new case
	$(document).on('change' , '.form-field', function(){
		checkFormFields();
	})
	$(document).on('submit', '.case-form', function() {
		checkFormFields();
	})
	//For register new employee
	$(document).on('change' , '.emp-field' , function(){
		checkFormFieldsEmp()
	})
	$(document).on('submit', '.emp-form', function() {
		checkFormFieldsEmp();
	})
	// For register a employee
	$(document).on('change', '#profile', imgValidate);
	//For validate the experiance
    $(document).on('change', '#exp', numValidate)
})

//For the register new case
	function checkFormFields() {
	    var eid = $('#employeeId').val(); 
	    var cname = $('#cname').val();    
	    var ctype = $('#ctype').val();    
	    var cdesc = $('#cdesc').val();   
	    var cemail = $('#cemail').val();
    	var ccont = $('#ccont').val();

   		var contReg = /^\d{10,10}$/
    	var emlReg =  /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/;
	    var str5 = /^[a-zA-Z\s]{5,}$/;
	    var str3 = /^[a-zA-Z\s]{3,}$/;
	    var str15 = /^[a-zA-Z\s]{15,}$/;

	// string length of 5
	    if (!str5.test(cname) && cname.trim() !== "") {
	        $('#registerCase').prop('disabled', true);
	       	$('.errMsg').text('*Enter 5 alphabetic character or more');
	        $('.errMsg').css("display", "unset");
	        return false;
	    } else {
	    	$('#registerCase').prop('disabled', false);
	         $('.errMsg').css("display", "none");
	    }
	// string length of 3
	    if (!str3.test(ctype) && ctype.trim() !== "") {
	    	$('#registerCase').prop('disabled', true);
	    	$('.errMsg2').text('*Enter 3 alphabetic character or more');
	        $('.errMsg2').css("display", "unset");
	    	return false;
	    } else {
	    	$('#registerCase').prop('disabled', false);
	    	$('.errMsg2').css("display", "none");
	    }
	// string length of 15
	    if (!str15.test(cdesc) && cdesc.trim() !== "") {
	    	$('#registerCase').prop('disabled', true);
	    	$('.errMsg3').text('*Enter 15 alphabetic character or more');
	        $('.errMsg3').css("display", "unset");
	    	return false;
	    } else {
	    	$('#registerCase').prop('disabled', false);
	    	$('.errMsg3').css("display", "none");
	    }
	//Check for the email
	    if (!emlReg.test(cemail) && cemail.trim() !== "") {
	    	$('#registerCase').prop('disabled', true);
	    	$('.errMsg5').text('Enter valid email format i.e abc@gmail.com').css("display" , "unset");
	    }else{
	    	$('.errMsg5').css("display", "none");
	    	$('#registerCase').prop('disabled', false);

	    }
	//Check for the contact number
	    if (!contReg.test(ccont) && ccont.trim() !== "") {
	    	$('#registerCase').prop('disabled', true);
	    	$('.errMsg4').text("Enter valid contact number max 10 digit").css("display" , "unset");
	    }else{
	    	$('.errMsg4').css("display", "none");
	    	$('#registerCase').prop('disabled', false);
	    }
	}
//For the validate the image
	 function imgValidate() {
	    var fileName = $(this).val();
	    var dot = fileName.lastIndexOf(".") + 1;
	    var ext = fileName.substr(dot, fileName.length).toLowerCase();
	    console.log(ext);

	    if (ext == "jpg" || ext == "png" || ext == "svg") {
	        $('.img-show').css("display", "none")
	        console.log("valid format")
	    } else {
	        $('.img-show').css("display", "unset")
	        $('#profile').val("");
	    }
	}
//For validate the number only 
	function numValidate() {
    var val = $(this).val();
    var regex = /^[0-9]{2}$/;

    if (val.match(regex)) {
        $('.exp').css("display", "none");
    } else {
        $('.exp').css("display", "unset").text("Enter experiance in year (Max length 2 digit)");
        $(this).val("");

    }
}
//For check the employee data 
function checkFormFieldsEmp() {
    var ename = $('#name').val();
    var epass = $('#pwd').val();
    var edu = $('#edu').val();
    var work = $('#work').val();
    
    var str5 = /^[a-zA-Z\s]{5,}$/;
    var str3 = /^[a-zA-Z\s]{3,}$/;
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{8,}$/;

    var valid = true;

    // Check the password
    if (!regex.test(epass) && epass.trim() !== "") {
        $('.pass')
            .text('Password must be at least 8 characters, including uppercase, lowercase, number, and special character.')
            .css("display", "unset");
        valid = false; // Set to false if this validation fails
    } else {
        $('.pass').css("display", "none");
    }

    // Check the name of employee
    if (!str5.test(ename) && ename.trim() !== "") {
        $('.txtVal2').text('*Enter 5 alphabetic character or more').css("display", "unset");
        valid = false;
    } else {
        $('.txtVal2').css("display", "none");
    }

    // Check the education of employee
    if (!str3.test(edu) && edu.trim() !== "") {
        $('.edu').text('*Enter 3 alphabetic character or more').css("display", "unset");
        valid = false;
    } else {
        $('.edu').css("display", "none");
    }

    // Check for the work speciality
    if (!str5.test(work) && work.trim() !== "") {
        $('.work').text('*Enter 5 alphabetic character or more').css("display", "unset");
        valid = false;
    } else {
        $('.work').css("display", "none");
    }
   
    // Enable or disable the button based on overall validity
    $('#registerUser').prop('disabled', !valid);
}

