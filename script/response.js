 // this file is use for ajax and jquery code for the make all functionality to without to refresh the page
//Register form
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

	    //For the add user from the admin side (inser record in all-adv table)
		    $(document).on('click', '#registerUser', function(e){
		     	 e.preventDefault();

		     	 var addUser = new FormData();//js default built in object for appending form data
		     	addUser.append("profile", $("#profile")[0].files[0]);
		        addUser.append("name", $("#name").val());
		        addUser.append("pwd", $("#pwd").val());
		        addUser.append("edu", $("#edu").val());
		        addUser.append("exp", $("#exp").val());
		        addUser.append("work", $("#work").val());
		        addUser.append("availableIn", $("#availableIn").val());
		        addUser.append("availableOut", $("#availableOut").val());

		        $.ajax({
		        	type:"POST",
		        	url:"register-emp-user.php",
		        	data:addUser,
		        	contentType: false,  
	            	processData: false, 
		        	success: function(resp) {
		        		console.log(resp);
		        		$('#temp-user').html("");
		        		getTempData();
		        		$('#resetBtn').click();
		        	}
		        })
		
		     });
});

    // for temp user
	var confirmBox =  $(".confirm-box");
 $(document).ready(function() {
     	getTempData();
     	getPerData();
     	
	//for delete user using ajax
     	//for show confirm box
     	$(document).on('click','#rejectUser', function(e) {
     		e.preventDefault();
			confirmBox.addClass("confirm-box-show");
     	});
     	//for close confirm box
     	$(document).on('click','#closeConfirm', function(e) {
			e.preventDefault();
			confirmBox.removeClass("confirm-box-show");
     	});
     	//for delete user and remove confirm box
     	$(document).on('click','#confirmDel', function(e) {
			e.preventDefault();

     		var tempId = $("#rejectUser").closest('tr').find('.tempId').text();
     		$.ajax({
     			type:"POST",
     			url:"code.php",
     			data:{
     				'check-for-delete':true,
     				'tempId':tempId,
     			},
     			success: function(resp){
     				$('.tempUser').html("");
     				getTempData();
     				confirmBox.removeClass("confirm-box-show");
     			}
     		});

   });

    //for approve user
	     $(document).on('click' , '#approveUser', function(e) {
	     	e.preventDefault();
	     	addUser.append("name", $("#name").val());

	     	var tempId = $(this).closest('tr').find('.tempId').text();
	     	var succPop = $("#app-pop");
	     	$.ajax({
	     		type:"POST",
	     		url:"code.php",
	     		data:{
	     			'check-for-per-insert':true,
	     			'tempId':tempId,
	     		},
	     		success:function(resp) {
	     				$('.perUser').html("");
	     				$(".dropItem").html("");
	     			getPerData();
	     				$('.tempUser').html("");
     				getTempData();
	     			succPop.addClass("approve-pop-show");
						setTimeout(()=>{
		     				succPop.removeClass("approve-pop-show");
		     			},1000);
	     		}
	     	});
	     });
  });   

 	// For insert new case record
 		$(document).on('click', '#registerCase', function(e) {
 			e.preventDefault();

 			var newCase = new FormData();
 			 newCase.append("employeeId", $("#employeeId").val());//From hidden input
 			 newCase.append("cname", $("#cname").val());
 			 newCase.append("ctype", $("#ctype").val());
 			 newCase.append("cdesc", $("#cdesc").val());
 			$.ajax({
 				type:"POST",
 				url:"register-client.php",
 				data:newCase,
 				contentType: false,
        		processData: false,
 				success:function(resp) {
 					$('#resetBtn').click();
 					totalCases();
 					present_cases();
 				}

 			})
 		})

     // for retrive data from the temp-user table
	     function getTempData() {
	     	$.ajax({
	     		type:"GET",
	     		url:"fetch.php",
	     		data:{
	     				'tempData':true,
	     			},
	     		dataType: "json",
	     		success:function(resp) {
	     			$.each(resp, function(key, value) {
	     				$(".tempUser").append(
	    					'<tr>'+
	     						'<td class="tempId">'+value['id']+'</td>' +
	     						'<td>'+value['pwd']+'</td>' +
	     						'<td>'+value['name']+'</td>' +
	     						'<td>'+value['edu']+'</td>' +
	     						'<td>'+value['exp']+'</td>' +
	     						'<td>'+value['work']+'</td>' +
	     						'<td>'+value['available']+'</td>' +
	     						'<td>'+
	     							 '<button class="btn bg-purp col-wh radius" id="approveUser">'+'Approve'+'</button> '+
	     							 ' <button class="btn bg-purp col-wh radius" id="rejectUser">'+'Reject'+'</button>'+
	     						'</td>'+
	     					'</tr>'
	     					);
	     			})
	     		}
	     	});
	     }
	// for retrive data from the all-adv table
	    function getPerData() {
	    $.ajax({
	        type: "GET",
	        url: "fetch.php",
	        data: {
	            'perData': true,
	        },
	        success: function (resp) {
	            $.each(resp, function (key, value) {
	                $(".perUser").append(
	                    '<tr>' +
	                        '<td>' + value['id'] + '</td>' +
	                        '<td>' + value['pwd'] + '</td>' +
	                        '<td>' + value['name'] + '</td>' +
	                        '<td>' + value['edu'] + '</td>' +
	                        '<td>' + value['exp'] + '</td>' +
	                        '<td>' + value['work'] + '</td>' +
	                        '<td>' + value['available'] + '</td>' +
	                    '</tr>'
	                );

	                $(".dropItem").append(
	                    '<li class="dropdown-item drop" data-id="' + value['id'] + '">' + value['name'] + '</li>'
	                );
	            });

	            // Add event listener to each dropdown item to get id to the hidden input field
	            document.querySelectorAll('.drop').forEach(item => {
	                item.addEventListener('click', function () {
	                    // Set the hidden input value to the selected employee's ID
	                    const employeeId = this.getAttribute('data-id');
	                    console.log(employeeId);
	                    document.getElementById('employeeId').value = employeeId;
	                    document.getElementById('ename').innerText = this.innerText;
	                });
	            });
	        }
	    });
	}
	//Get the total case count 
		function totalCases(){
			$.ajax({
				type:"GET",
				url:"fetch.php",
				data:{
					total_cases : true,
				},
				success:function(resp) {
					$("#totalCasePill").text(resp);
				},
			})
		}
		totalCases();
	//Get the today's case count
		function present_cases() {
			$.ajax({
				type:"GET",
				url:"fetch.php",
				data:{
					present_cases: true,
				},
				success:function(resp) {
					$("#PresentCase").text(resp);
				}
			})
		}
	present_cases();