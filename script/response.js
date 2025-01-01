 // this file is use for ajax and jquery code for the make all functionality to without to refresh the page
//Register form
$(document).ready(function() {
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

		        if(!$("#profile")[0].files[0] || !$("#name").val() || !$("#pwd").val() || !$("#edu").val() || !$("#exp").val() || !$("#work").val() || !$("#availableIn").val() || !$("#availableOut").val()){
		        	 $(".alert").addClass("alert-show");
		        	 return;
		        }
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
		        		$('#resetBtnUser').click();
		        	}
		        })
		
		     });
});
		//For close alert button
	 		$(document).on('click', '#close-alert', function(){
	 			$(".alert").removeClass("alert-show");
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
 			 newCase.append("cdesc", $("#ctype").val());
 			 newCase.append("ceml" , $("#cemail").val());
 			 newCase.append("ccont", $("#ccont").val());

 			 if(!$("#employeeId").val() || !$("#cname").val() || !$("#ctype").val() || !$("#cdesc").val() || !$("#cemail").val() || !$("#ccont").val()) {
 			 	$(".alert").addClass("alert-show");
 			 	return;
 			 }
 			$.ajax({
 				type:"POST",
 				url:"register-client.php",
 				data:newCase,
 				contentType: false,
        		processData: false,
 				success:function(resp) {
 					console.log(resp);
 					$('.alert').addClass(".")
 					$('#resetBtn').click();
 					totalCases();
 					present_cases();
 				}

 			})
 		})
 	//For close alert button
 		$(document).on('click', '#close-alert', function(){
 			$(".alert").removeClass("alert-show");
 		});
 		
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
	     			if(resp && resp.length > 0) {
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
	     			}else {
	     				$(".tempUser").append(
	     					'<tr>'+
	     						'<td colspan="8">'+'No any pending user request available'+'</td>'
	     					);
	     			}
	     			
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
				},
			})
		}
	present_cases();
	//Get the today available employee count (Attandance)
		let set_intetval = setInterval(todayEmp,1000);//Set timeout then the function is call after given time 

		function todayEmp() {
			$.ajax({
				type:"GET",
				url:"fetch.php",
				data:{
					today_emp : true,
				},
				success:function(resp) {
					$("#presentEmp").text(resp);
				},
			})
		}
	//Get user case data
		function userCase() {
			$.ajax({
				type:"GET",
				url:"fetch.php",
				data:{
					user_case : true,
				},
				success:function(resp) {
					$.each(resp, function(key, value) {
						// console.log(key, value);
						$("#caseData").append(
						'<tr>'+
	                        '<form action="update-work.php" method="post" enctype="multipart/form-data">'+
	                            '<td class="caseId">'+value['case_id']+'</td>'+
	                            '<td>'+value['client-name']+'</td>'+
	                            '<td>'+value['email']+'</td>'+
	                            '<td>'+value['contact']+'</td>'+
	                            '<td class="text-start">'+value['case-desc']+'</td>'+
	                            '<td>'+
	                                '<label for="optionSelect">'+'Status:'+''+value['status']+ '</label>'+'<br>'+
	                                '<select id="optionSelect" name="option" class="option-sty opts">'+
	                                    '<option value="pending">'+'Pending'+'</option>'+
	                                    '<option value="done">'+'Done'+'</option>'+
	                                '</select>'+
	                            '</td>'+
	                            '<td>'+
	                                '<textarea class="form-control cDesc" rows="4" name="case_cls_desc" placeholder="Enter the case expense and close description">'+value['case_cls_desc']+'</textarea>'+
	                            '</td>'+
	                            '<td>'+
	                                '<input type="file" name="file[]" class="form-control files" multiple>'+
	                                '<span class="filetxt">'+'You can choose multiple files'+'</span>'+
	                            '</td>'+
	                            '<td>'+
	                                '<input type="submit" value="Update" class="btn radius bg-purp col-wh" id="caseUpdate">'+
	                            '</td>'+
	                        '</form>'+
	                    '</tr>'
							);
					})
				},

			})
		}
		userCase();
	//if we want to update record automatically refresh in every 5 sec
	 	// setRef = setInterval(refTab,5000);
	 	// function refTab(){
	 	// 	$('#caseData').html("");
		// 	    userCase();
	 	// }
			$(document).on('click', '#caseUpdate', function(e) {
			    e.preventDefault(); 

			    var formData = new FormData(); 

			    // Get data from the form data 
			    var caseId = $(this).closest('tr').find('.caseId').text();
			    var cDesc = $(this).closest('tr').find('.cDesc').val();
			    var opts = $(this).closest('tr').find('.opts').val();
			    var fileInput = $(this).closest('tr').find('.files')[0];//0 is use for DOM element means it return the that full tag like full input tag
			    var fileList = fileInput.files; 
			    console.log(fileInput)

			    // Append data to FormData object to all variable value
			    formData.append('case_id', caseId);
			    formData.append('case_cls_desc', cDesc);
			    formData.append('option', opts);

			    // Append each file to FormData
			    for (let i = 0; i < fileList.length; i++) {
			        formData.append('file[]', fileList[i]);
			         console.log(fileList[i])
			    }
			    $.ajax({
			        type: "POST",
			        url: "update-work.php",
			        data: formData,
			        processData: false,  
			        contentType: false, 
			        success: function(resp) {
			        	 $(".alert").addClass("alert-show");
			        	 $(".alert-txt").text("Record updated successfully")
			        	 $('#caseData').html("");
			            userCase();
			            
			        },
			    });
			});
