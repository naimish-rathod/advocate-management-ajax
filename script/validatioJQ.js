$(document).ready(function(){
    $(document).on('change', '#cname',function() {
    	var valuee = $('#cname').val();
    	var classs = $('.txtVal').attr('class');
    	validateString (valuee , classs);
    });

    $(document).on('change', '.eNameReg' , validateString);
    $(document).on('change', '#profile', imgValidate);

    $(document).on('click', '.dropdown-item', checkEmp);
});

//Function for validate string
function validateString (valuee , classs){
          
        console.log(valuee);  
         console.log(classs);
		 if(/^[a-zA-Z\s]+$/.test(valuee.trim()) && valuee.length >=5) {
     		  $(classs).css("display", "none");
     	}else {
     		$(classs) .val("");
     		$(classs).text('*Enter 5 alphabetic character or more');
     		$(classs).css("display", "unset");
     	}
   }
function imgValidate(){
	var fileName = $(this).val();
	var dot = fileName.lastIndexOf(".")+1;
	var ext = fileName.substr(dot,fileName.length).toLowerCase();
	console.log(ext);

	if(ext=="jpg" || ext == "png" || ext == "svg") {
		$('.img-msg').css("display" , "none")
		console.log("valid format")
	}else {
		$('.img-msg').css("display" , "unset")
		$('#profile').val("");
	}
}

function checkEmp() {
	var id	= $(this).val();
	console.log(id);
}