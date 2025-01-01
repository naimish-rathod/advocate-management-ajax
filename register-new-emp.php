<?php include 'header.php'; ?>

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
		</body>
		<script src="script/response.js"></script><!-- Ajax jquery -->
		<!-- <script src="script/validatioJQ.js"></script> -->
		<script src="script/validationJQ2.js"></script>
		</html>