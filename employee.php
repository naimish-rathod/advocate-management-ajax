<?php include 'header.php'; ?>
		<body>
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