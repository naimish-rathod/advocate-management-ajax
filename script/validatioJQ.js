$(document).ready(function() {
    //For validate the value of the client name
    $(document).on('keyup', '#cname', function() {
        var valuee = $('#cname').val();
        var classs = '.errMsg';
        validateString(valuee, classs);
    });

    //For validate and pass the value of the employee name
    $(document).on('keyup', '.eNameReg', function() {
        var valuee = $('.eNameReg').val();
        var classs = '.txtVal2';
        validateString(valuee, classs);
    });
    //For case type 
    $(document).on('keyup', '#ctype', function() {
        var valuee = $('#ctype').val();
        var classs = '.errMsg2'
        validateString(valuee, classs);
    })
    //For case description
    $(document).on('keyup', '#cdesc', function() {
        var valuee = $('#cdesc').val();
        var classs = '.errMsg3'
        validateString(valuee, classs);
    })
    //For check enployee is select or not
    $(document).on('click', '.dropdown-item', function() {
        const id = $(this).data('id');
        $('#employeeId').val(id);
        checkFormFields();
    });
    //For the validate education string
    $(document).on('change', '#edu', function() {
        var valuee = $('#edu').val();
        var classs = '.edu';
        validateString(valuee, classs);
    });
    // Check the form fields on keyup and change
    $('.form-field').on('keyup change', function() {
        checkFormFields();
    });

    function checkFormFields() {
        let allFilled = true;


        $('.form-field').each(function() {
            if ($(this).val().trim() === "") {
                allFilled = false;
                validateString();
            }
        });
        if (allFilled && checkErr && checkErr2 && checkErr3) {
            $('#registerCase').prop('disabled', false);
        } else {
            $('#registerCase').prop('disabled', true);
        }
    }


    //For validate the experiance
    $(document).on('change', '#exp', numValidate);
    //For validate the password 
    $(document).on('keyup', '.getPass', passValidate);
    //For validate the image  
    $(document).on('change', '#profile', imgValidate);

});

//Function for validate string
function validateString(valuee, classs) {

	let checkErr = false;
	let checkErr2 = false;
	let checkErr3 = false;

    if (/^[a-zA-Z\s]+$/.test(valuee.trim()) && valuee.length >= 5) {
        $(classs).css("display", "none");
        let checkErr = false;
    } else {
        $(this).val("");
        $(classs).text('*Enter 5 alphabetic character or more');
        $(classs).css("display", "unset");
        let checkErr = true;
    }
    //For length 3
    if (classs == ".edu" || classs == ".errMsg2") {
        if (/^[a-zA-Z\s]+$/.test(valuee.trim()) && valuee.length >= 3) {
            $(classs).css("display", "none");
            let checkErr2 = false;
        } else {
            $(this).val("");
            $(classs).text('*Enter 3 alphabetic character or more');
            $(classs).css("display", "unset");
            let checkErr = true;
        }
    }
    //For length 15
    if (classs == ".errMsg3") {
        if (/^[a-zA-Z\s]+$/.test(valuee.trim()) && valuee.length >= 15) {
            $(classs).css("display", "none");
            let checkErr3 = false;
        } else {
            $(this).val("");
            $(classs).text('*Enter 15 alphabetic character or more');
            $(classs).css("display", "unset");
            let checkErr = true;
        }
    }

}
//Fuction for validate image extension 
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
//Function for validate the experiance(number)
function numValidate() {
    var val = $(this).val();
    var regex = /^[0-9]+$/;

    if (val.match(regex)) {
        $('.exp').css("display", "none");
    } else {
        $('.exp').css("display", "unset").text("Enter experiance in year");
        $(this).val("");

    }
}

function passValidate() {
    var val = $(this).val();
    console.log(val);
    // Regular expression for password validation
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9]).{8,}$/;

    if (val.match(regex)) {
        // If password is valid, hide the error message
        $('.pass').css("display", "none");
    } else {
        // If password is invalid, show the error message
        $('.pass').text('Password must be at least 8 characters, including uppercase, lowercase, number, and special character.')
            .css("display", "unset");
    }
}