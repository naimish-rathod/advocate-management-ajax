<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
			/* =================================
					variable declaration 
			====================================*/

	$present_cases = 0; // Default value if no cases are found
	$present_emp = 0;  // Default value if no employees are marked present
	$curdate = date('Y-m-d'); // for current date
	$ntfyCountPend = 0;
	$ntfyCountDone = 0;
	$statuss = "pending";

session_start();
include 'connection.php';

$user = $_SESSION['uname'];
	if($user){

	} else {
		header("location:login.php");
	}
// admin query
	$stmt = $conn->prepare("SELECT * FROM `adv-nr`");
	$stmt->execute();
	$res = $stmt->get_result();
	$row = $res->fetch_assoc();
// employee query

	$emp = $conn->prepare("SELECT * FROM `all-adv`");
	$emp->execute();
	$emp_res=$emp->get_result();
	 
// query for find attendace 
	$attend=$conn->prepare("SELECT * FROM `attendance` WHERE DATE(`entry`) = ?");
	$attend->bind_param("s",$curdate);
	$attend->execute();
	$attend->store_result();
		if($attend->num_rows > 0){
			$present_emp=$attend->num_rows;
		}

// query for find total cases include pending and done from all advocate
	$qryWork = "SELECT * FROM `work-data`";
	$stmtWork = $conn->prepare($qryWork);
	$stmtWork->execute();
	$resWork = $stmtWork->get_result();
	$workData = $resWork->fetch_all(MYSQLI_ASSOC);

	//query for complated and pending notification  bubble count
	foreach ($workData as $workRow) {
	    if ($workRow['status'] === 'pending') {
	        $ntfyCountPend++;
	    } else {
	    	$ntfyCountDone++;
	    }
	}
	//total case from work data 
	$totalCase = $ntfyCountDone + $ntfyCountPend;

//query for find today's case
	$cases=$conn->prepare("SELECT * FROM `work-data` WHERE DATE(`created_at`) = ?");
	$cases->bind_param("s",$curdate);
	$cases->execute();
	$cases->store_result();

	if ($cases->num_rows > 0) {
    	$present_cases = $cases->num_rows;
	}
//query for temp user 
	$tempUser=$conn->prepare("SELECT * FROM `temp_user` WHERE `status` = ?");
	$tempUser->bind_param("s", $statuss);
	$tempUser->execute();
	$tempUserRes = $tempUser->get_result();

	if ($tempUserRes->num_rows > 0) {
    	$hasTemp = true;
	} else {
	     $hasTemp = false;
	}
	
//for work and employee data
	if ($emp_res ->num_rows > 0) {  //if brace start
		 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>N.R counsultancy</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

  <link rel="stylesheet" type="text/css" href="css/index-style.css">
 </head>
<body>
	<!-- ===========================
				navigation bar
	 =============================== -->
	 <div class="container-fluid navbar-col shadow-lg">
	 	<nav class="navbar navbar-expand-sm  container">
	 	<div class="container-fluid float-end">
	 		<ul class="navbar-nav nav-text">
	 			<!-- side bar image -->
	 			<li class="nav-item me-3">
	 				 <img src="img/munu.png"  class="menu-img" data-bs-toggle="offcanvas" data-bs-target="#demo">
	 			</li>
	 			<!-- side bar image -->
	 			<li class="nav-item ms-4">
	 				<a href="#emp" class="nav-link fs-5">Employee</a>
	 			</li>
	 			<li  class="nav-item">
	 				 <a href="cases.php" class="nav-link fs-5">Cases</a>
	 			</li>
	 			<li class="nav-item">
	 				<a href="complate-case.php" class="nav-link fs-5">Complated<span class="ntfy"><?php echo htmlspecialchars($ntfyCountDone) ?></span></a>
	 			</li>
	 			<li class="nav-item">
	 				<a href="pending-case.php" class="nav-link fs-5">Pending<span class="	ntfy"><?php echo htmlspecialchars($ntfyCountPend) ?></span></a>
	 			</li>
	 		</ul>
	 	</div>
	 	<span class="uname me-3"><?php echo htmlspecialchars($row['name']); ?></span>
	 	<img alt="profile" src="<?php echo htmlspecialchars($row['user_img_src']); ?> " class="user_img me-4">
	 </nav>
	 </div>
	 
	 <!-- ===========================
				side bar
	 =============================== -->
	 <div class="offcanvas offcanvas-start sidebar text-center" id="demo">
	 	<div class="offcanvas-header">
	 		<h3 class="offcanvas-title col-wh">Dashboard</h3>
	 		<!-- <button class="btn btn-close text-reset" data-bs-dismiss="offcanvas"></button> --> <img src="img/close.png"  class="text-reset close" data-bs-dismiss="offcanvas" >
	 	</div>
	 	<div class="offcanvas-body mt-2">
	 			<hr class="col-wh">
	 		<p class="dash-font"><a class="logout-txt dash-font" href="admin-doc.php">Documents</a></p>
	 			<hr class="col-wh">
	 		<p class="dash-font ">Total case <span class="badge rounded-pill b-ntfy"> <?php echo htmlspecialchars($totalCase) ?></span></p>
	 			<hr class="col-wh">
	 		<p class="dash-font"><a class="logout-txt" href="Logout.php">Logout</a></p>
	 			<hr class="col-wh">
	 	</div>
	 </div>
	 <!-- ==============================
		   Register a new  case
	 =============================== -->
	 <div class="row container-lg mx-auto mt-5">
	 	<div class="col-sm-8 mt-3"> 
	 		<table class="table table-bordered text table-striped">
		 	<form class="form" action="register-client.php" method="get">
		 		<tr >
		 			<th colspan="2" class="table-head-col ">
		 				<h4 class="text-center marg" >Register a new  case</h4>
		 			</th>
		 		</tr>
		 		<tr>
		 			<th>Employee ID</th>
		 			<td> 
		 				<div class="dropdown">
		 					<button class="btn bg-purp col-wh radius dropdown-toggle" data-bs-toggle="dropdown" id="ename">Employee list</button>
		 					<ul class="dropdown-menu">
		 						<li class="dropdown-item drop" data-id="1">1 Mr. Vishal solanki</li>
		 						<li class="dropdown-item drop" data-id="2">2 Mr. Naimish rathod</li>
		 						<li class="dropdown-item drop" data-id="3">3 atul kumar</li>
		 						<li class="dropdown-item drop" data-id="4">4 ram shah</li>
		 					</ul>
		 				</div>
		 				<input type="hidden" id="employeeId" name="employeeId">
		 			</td>
		 		</tr>
		 		<tr>
		 			<th>Client name</th>
		 			<td><input type="text" name="cname" class="form-control" placeholder="Enter client name"></td>
		 		</tr>
		 		<tr>
		 			<th>Case type</th>
		 			<td><input type="text" name="ctype" class="form-control" placeholder="Enter case type"></td>
		 		</tr>
		 		<tr>
		 			<th>Case description</th>
		 			<td><textarea rows="5" name="cdesc" class="form-control" placeholder="Case discripton"></textarea></td>
		 		</tr>
		 		<tr class="text-center">
		 			<td colspan="2" rowspan="2">
		 				<input type="reset" name="reset" class="btn bg-purp col-wh radius">
		 				<input type="submit" name="submit" value="Register" class="btn bg-purp col-wh radius">
		 			</td> 
		 		</tr>
		 	</form>
	 		</table>
	 	</div>
	 	<div class="col-sm-4 buble-main">
	 		<div class="bg-l-purp buble text-center shadow">
	 			 <div><h4 class="mt-3 col-blk">Today's cases</h4></div>
	 			 <div><h1 class="attend-font col-blk"><?php echo htmlspecialchars($present_cases) ?></h1></div>
	 			 <div class="view-txt"><a href="today-case.php" class="buble-a col-blk">View</a></div>
	 		</div>
	 		<div class="bg-l-purp buble text-center shadow">
	 			<div><h4 class="mt-3 col-blk">Available employee</h4></div>
	 			<div><h1 class="attend-font col-blk"><?php echo htmlspecialchars($present_emp) ?></h1></div>
	 			<div class="view-txt"><a href="today-employee.php" class="buble-a  col-blk">View</a></div>
	 		</div>
	 	</div>
	 	
	 </div>
	 <!-- ==============================
				register employee
	 =============================== -->
	 <div class="container mt-4">
	 	<table class="table table-bordered text-center table-striped">
		 	<form class="form" action="register-emp-admin.php" method="post" enctype="multipart/form-data">
		 		<tr >
		 			<th colspan="2" class="table-head-col ">
		 				<h4 class="text-center marg" >Register a new employee</h4>
		 			</th>
		 		</tr>
		 		<tr>
		 				<th>Profile picture</th>
						<td>
							<input type="file" name="profile" class="form-control">
						</td>
				</tr>
		 		<tr>
		 			<th>Employee name</th>
		 			<td><input type="text" name="name" class="form-control"></td>
		 		</tr>
		 		<tr>
		 			<th>Employee password</th>
		 			<td><input type="text" name="pwd" class="form-control"></td>
		 		</tr>
		 		<tr>
		 			<th>Education</th>
		 			<td><input type="text" name="edu" class="form-control"></td>
		 		</tr>
		 		<tr>
		 			<th>Experiance</th>
		 			<td><input type="text" name="exp" class="form-control"></td>
		 		</tr>
		 		<tr>
		 			<th>Work speciality</th>
		 			<td><input type="text" name="work" class="form-control"></td>
		 		</tr>
		 		<tr>
		 			<th>Available</th>
		 			<td><input type="text" name="available" class="form-control"></td>
		 		</tr>
		 		<tr class="text-center">
		 			<td colspan="2" rowspan="2">
		 				<input type="reset" name="reset" class="btn bg-purp col-wh radius">
		 				<input type="submit" name="submit" value="Register" class="btn bg-purp col-wh radius">
		 			</td> 
		 		</tr>
		 	</form>
	 		</table>
	 </div>

	  <!-- ==============================
				pending user
	 =============================== -->
	<div class="thirteen mt-5 head-widh">
    	<h1>Approve employee</h1>
	</div>
 	 <div class="container mt-4 rounded">
	  	<table class="table table-striped table-bordered text-center" id="emp">
	  		<thead>
	  		<tr>
	  			<th class="table-head-col">Employee Id</th>
	  			<th class="table-head-col">Password</th>
	  			<th class="table-head-col">Name</th>
	  			<th class="table-head-col">Education</th>
	  			<th class="table-head-col">Work experiance</th>
	  			<th class="table-head-col">Expert</th>
	  			<th class="table-head-col">Available</th>
	  			<th class="table-head-col">Approve</th>
	  		</tr>
	  		</thead>
	  		<tbody class="tempUser">
	  			<!-- Data is received from ajax  -->
		  	</tbody>
	 	</table>
	 </div>


	 <!-- ==============================
				Staff details
	 =============================== -->
	<div class="thirteen mt-5">
    	<h1>Employee</h1>
	</div>
 	 <div class="container mt-4 rounded mb-1" id="emp">
	  	<table class="table table-striped table-bordered text-center" >
	  		<thead>
	  		<tr>
	  			<th class="table-head-col">Employee Id</th>
	  			<th class="table-head-col">Password</th>
	  			<th class="table-head-col">Name</th>
	  			<th class="table-head-col">Education</th>
	  			<th class="table-head-col">Work experiance</th>
	  			<th class="table-head-col">Expert</th>
	  			<th class="table-head-col">Available</th>
	  		</tr>
	  		</thead>
	  		<tbody>
	  		<?php while ($emp_row = $emp_res->fetch_assoc()) { ?> <!--while loop start here -->
	  		<tr>
	  			<td><?php echo htmlspecialchars($emp_row['id']); ?> </td>
	  			<td><?php echo htmlspecialchars($emp_row['pwd']); ?> </td>
	  			<td><?php echo htmlspecialchars($emp_row['name']); ?> </td>
	  			<td><?php echo htmlspecialchars($emp_row['edu']); ?> </td>
	  			<td><?php echo htmlspecialchars($emp_row['exp']); ?> </td>
	  			<td><?php echo htmlspecialchars($emp_row['work']); ?> </td>
	  			<td><?php echo htmlspecialchars($emp_row['available']); ?> </td>
	  		</tr>
		 <?php  } ?>  <!--while loop end here -->
		  	</tbody>
		 	 
	 	</table>
	 </div>
</body>
<script>
     document.querySelectorAll('.drop').forEach(item => {
        item.addEventListener('click', function() {
            // Set the hidden input value to the selected employee's ID
            const employeeId = this.getAttribute('data-id');
            document.getElementById('employeeId').value = employeeId;
            document.getElementById('ename').innerText = employeeId;
        });
    });

     // for temp user
     $(document).ready(function() {
     	getData();
     	

     	//for delete user using ajax
     	$('#rejectUser').click(function(e) {
     		e.preventDefault();
     		console.log("click");
     		
     		var tempId = $(this).closest('tr').find('.tempId').text();
     		$.ajax({
     			type:"POST",
     			url:"code.php",
     			data:{
     				'check-for-delete':true,
     				'tempId':tempId,
     			},
     			success: function(resp){
     				console.log("resp");

     				$('.tempUser').html("");
     				getData();
     			}
     		});
     	});

     });
     // for retrive data from the temp-user table
     function getData() {
     	$.ajax({
     		type:"GET",
     		url:"fetch.php",
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
     							 '<a class="btn bg-purp col-wh radius" href="add-new-user.php?id='+value['id']+'">'+'Approve'+'</a> '+
     							 ' <button class="btn bg-purp col-wh radius" id="rejectUser">'+'Reject'+'</button>'+
     						'</td>'+
     					'</tr>'
     					);
     			})
     		}
     	});
     }

</script>
</html>

<?php

 } //if brace end here 
 else {
 	echo "no result found";
 } 
?>