<?php include 'header.php'; ?>
	
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
		</body>
		<script src="script/response.js"></script><!-- Ajax jquery -->
		<!-- <script src="script/validatioJQ.js"></script> -->
		<script src="script/validationJQ2.js"></script>
		</html>