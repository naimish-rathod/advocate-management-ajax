<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
			/* =================================
					variable declaration 
					====================================*/
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
			<script src="script/jquery-3.7.1.min.js"></script>	
			<link rel="icon" type="image/x-icon" href="img/justice.png">
			<link rel="stylesheet" type="text/css" href="css/index-style.css">
		</head>
		<body>
			<!-- confirm box -->
				<div class="card text-center confirm-box bg-l-purp">
					<div class="card-header">Are you sure to reject ?</div>
					<div class="card-body d-flex justify-content-around">
						<button class="btn bg-purp col-wh" id="confirmDel">Yes</button>  
						<button class="btn bg-purp col-wh" id="closeConfirm">No</button>
					</div>
				</div>
			<!-- slide (toast) notification -->
				<div class="approve-pop" id="app-pop">
					<img src="img/accept-icon.svg"> <span> Approved successfully</span>
				</div>
			<!-- alert box -->
				<div class="card alert">
					<div class="card-header bg-l-purp text-center alert-head">Alert</div>
					<div class="card-body bg-l-purp alert-body">
						<div class="text-center">
							<span class="alert-txt">Please fill required fields.</span>
						</div>
						<div class="float-end">
							<button class="btn bg-purp" id="close-alert"><span class="col-wh">OK</span></button>
						</div>
					</div>
				</div>
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
									<a href="employee.php" class="nav-link fs-5">Employee</a>
								</li>
								<li class="nav-item">
									<a href="approve-emp.php" class="nav-link fs-5">Approve employee</a>
								</li>
								<li class="nav-item">
									<a href="register-new-emp.php" class="nav-link fs-5">Register Employee</a>
								</li>
								<li  class="nav-item">
									<a href="cases.php" class="nav-link fs-5">Cases</a>
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
						<img src="img/close.png"  class="text-reset close" data-bs-dismiss="offcanvas" >
					</div>
					<div class="offcanvas-body mt-2">
							<hr class="col-wh">
						<p class="dash-font"><a class="logout-txt dash-font" href="admin-doc.php">Documents</a></p>
							<hr class="col-wh">
						<p class="dash-font ">Total case <span class="ntfy" id="totalCasePill"></span></p>
							<hr class="col-wh">
						<p class="dash-font">
						    <a href="complate-case.php" class="nav-link fs-5 dash-font">Complated<span class="ntfy"><?php echo htmlspecialchars($ntfyCountDone) ?></span></a>
						</p>
						<hr class="col-wh">
						<p class="dash-font">
							<a href="pending-case.php" class="nav-link fs-5 dash-font">Pending<span class="ntfy"><?php echo htmlspecialchars($ntfyCountPend) ?></span></a>
						</p>
							<hr class="col-wh">
						<p class="dash-font">
							<a class="logout-txt" href="Logout.php">Logout</a>
						</p>
						<hr class="col-wh">
					</div>
				</div>
	 <!-- ==============================
		   	Register a new  case
	 =============================== -->
		   <div class="row container-lg mx-auto mt-5">
		   	 
		   	<div class="col-sm-8 mt-3"> 
		   		<table class="table table-bordered text table-striped">
		   			<form class="form case-form" method="get">
		   				<tr >
		   					<th colspan="2" class="table-head-col ">
		   						<h4 class="text-center marg" >Register a new  case</h4>
		   					</th>
		   				</tr>
		   				<tr>
		   					<th>Employee ID *</th>
		   					<td> 
		   						<div class="dropdown">
		   							<button class="btn bg-purp col-wh radius dropdown-toggle" data-bs-toggle="dropdown" id="ename">Employee list</button>
		   							<ul class="dropdown-menu dropItem">
		   								<!-- Result from ajax response.js -->
		   							</ul>
		   						</div>
		   						<input type="hidden" id="employeeId" name="employeeId" class="form-field">
		   					</td>
		   				</tr>
		   				<tr>
		   					<th>Client name *<br>
		   						<span class="txtVal errMsg"></span>
		   					</th>
		   					<td class="text-center">
		   						<input type="text" name="cname" id="cname" class="form-control form-field" placeholder="Enter client name" ></td>
		   				</tr>
		   				<tr>
		   					<th>Case type *<br>
		   					<span class="txtVal errMsg2"></span>
		   					</th>
		   					<td><input type="text" name="ctype" id="ctype" class="form-control form-field" placeholder="Enter case type" ></td>
		   				</tr>
		   				<tr>
		   					<th>Client email *<br>
		   						<span class="txtVal errMsg5"></span>
		   					</th>
		   					<td class="text-center">
		   						<input type="email" name="email" id="cemail" class="form-control form-field" placeholder="Enter client email" >
		   					</td>
		   				</tr>
		   				<tr>
		   					<th>Client contact no. *<br>
		   						<span class="txtVal errMsg4"></span>
		   					</th>
		   					<td class="text-center">
		   						<input type="text" name="cont" id="ccont" class="form-control form-field" placeholder="Enter client contact no." >
		   					</td>
		   				</tr>
		   				<tr>
		   					<th>Case description *<br>
		   						<span class="txtVal errMsg3"></span>
		   					</th>
		   					<td><textarea rows="5" name="cdesc" id="cdesc" class="form-control form-field" placeholder="Case discripton" ></textarea></td>
		   				</tr>
		   				<tr class="text-center">
		   					<td colspan="2" rowspan="2">
		   						<input type="reset" name="reset" class="btn bg-purp col-wh radius" id="resetBtn">
		   						<input type="submit" name="submit" value="Register" id="registerCase" class="btn bg-purp col-wh radius" >
		   					</td> 
		   				</tr>
		   			</form>
		   		</table>
		   	</div>
		   	<div class="col-sm-4 buble-main">
		   		<div class="bg-l-purp buble text-center shadow">
		   			<div><h4 class="mt-3 col-blk">Today's cases</h4></div>
		   			<div><h1 class="attend-font col-blk" id="PresentCase">0</h1></div>
		   			<div class="view-txt"><a href="today-case.php" class="buble-a col-blk">View</a></div>
		   		</div>
		   		<div class="bg-l-purp buble text-center shadow">
		   			<div><h4 class="mt-3 col-blk">Available employee</h4></div>
		   			<div><h1 class="attend-font col-blk" id="presentEmp">0</h1></div>
		   			<div class="view-txt"><a href="today-employee.php" class="buble-a  col-blk">View</a></div>
		   		</div>
		   	</div>

		   </div>
	 <!-- ==============================
					register employee
	 =============================== -->
				<div class="container mt-4">
					<table class="table table-bordered text-center table-striped">
						<form class="form emp-form" action="register-emp-admin.php" method="post" enctype="multipart/form-data">
							<tr >
								<th colspan="2" class="table-head-col ">
									<h4 class="text-center marg" >Register a new employee</h4>
								</th>
							</tr>
							<tr>
								<th>Profile picture</th>
								<td class="position-relative">
									<div class="img-msg bg-l-purp img-show">
										<span>*Please upload image file(jpg,png,svg)</span>
									</div>
									<input type="file" name="profile" id="profile" class="form-control">
								</td>
							</tr>
							<tr>
								<th>Employee name </th>
								<td class="position-relative">
									<div class="img-msg bg-l-purp txtVal2">
										<span>*Enter 5 alphabetic character or more</span>
									</div>
									<input type="text" name="name" id="name" class="form-control emp-field eNameReg">
								</td>
							</tr>
							<tr>
								<th>Employee password</th>
								<td class="position-relative">
									<div class="img-msg bg-l-purp pass">
										<span></span>
									</div>
									<input type="text" name="pwd" id="pwd" class="form-control emp-field getPass">
								</td>
							</tr>
							<tr>
								<th>Education</th>
								<td class="position-relative">
									<div class="img-msg bg-l-purp edu">
										<span></span>
									</div>
									<input type="text" name="edu" id="edu" class="form-control emp-field">
								</td>
							</tr>
							<tr>
								<th>Experiance</th>
								<td class="position-relative">
									<div class="img-msg bg-l-purp exp">
										<span></span>
									</div>
									<input type="text" name="exp" id="exp" class="form-control emp-field">
								</td>
							</tr>
							<tr>
								<th>Work speciality</th>
								<td class="position-relative">
									<div class="img-msg bg-l-purp work">
										<span></span>
									</div>
									<input type="text" name="work" id="work" class="form-control emp-field">
								</td>
							</tr>
							<tr>
								<th>Available</th>
								<td colspan="3" class="time-par">
									<input type="time" name="availableIn" id="availableIn" class="form-control time availableIn" placeholder="Availity" required><span>To</span>
									<input type="time" name="availableOut" id="availableOut" class="form-control time availableOut" placeholder="Availity" required>
								</td>
							</tr>
							<tr class="text-center">
								<td colspan="2" rowspan="2">
									<input type="reset" name="reset" class="btn bg-purp col-wh radius" id="resetBtnUser">
									<input type="submit" name="submit" value="Register" class="btn bg-purp col-wh radius" id="registerUser">
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
					<table class="table table-striped table-bordered text-center">
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
						<tbody class="tempUser" id="temp-user">
							<!-- Data is received from response.js getTempData(); function  -->
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
						<tbody class="perUser">
							<!-- data is received from response.js getPerData(); function -->
						</tbody>

					</table>
				</div>
			</body>
			<script src="script/response.js"></script><!-- Ajax jquery -->
			<!-- <script src="script/validatioJQ.js"></script> -->
			<script src="script/validationJQ2.js"></script>
			</html>

			<?php

 } //if brace end here 
 else {
 	echo "no result found";
 } 
?>