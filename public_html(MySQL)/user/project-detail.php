<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<?php include('validate.php'); ?>
</head>
<body>
	<?php include('../connect.php'); ?>
	<?php include('navigation.php'); ?>
	<div class="container">
		<?php
			$project_id = $_GET['id'];
			$query = "SELECT * from PROJECT_INFO where project_id = '$project_id'";
			$result = $conn->query($query);
			$row = $result->fetch_array();
			$p_year = $row['YEAR'];
			$p_organization = $row['SPONSOR'];
			$p_department = $row['DEPARTMENT'];
			$p_mentor = $row['MENTOR'];
			$p_faculty_advisor = $row['FACULTY_ADVISOR'];
			$p_project_name = $row['PROJECT_NAME'];
			$p_project_number = $row['PROJECT_NUMBER'];
			$p_project_type = $row['PROJECT_TYPE'];
			$p_note = $row['NOTE'];
			$p_index_code = $row['INDEX_CODE'];
			$p_donation = $row['ZIP'];
			$p_budget = $row['CAPSTONE_BUDGET'];
			$p_amount_spent = $row['AMOUNT_SPENT'];
			$p_supplemental_funding = $row['SUPPLEMENTAL_FUNDING'];
			$p_is_ip_assignment = $row['IS_IP_ASSIGNMENT'];
			$p_is_ip_disclosure = $row['IS_IP_DISCLOSURE'];
			$p_is_status = $row['PROJECT_STATUS'];
			$p_is_service_learning = $row['IS_SERVICE_LEARNING'];
			$p_is_sternheimer = $row['IS_STERNHEIMER'];
			$p_is_partner = $row['IS_PARTNER'];
			$p_is_citizenship_required = $row['IS_CITIZENSHIP_REQUIRED'];
			$p_is_nondisclosure_agreement = $row['IS_NONDISCLOSURE_AGREEMENT'];
			$p_sponsor_abstract_id = $row['SPONSOR_ABSTRACT_ID'];
			$p_student_abstract_id = $row['STUDENT_ABSTRACT_ID'];
			$p_student_poster_id = $row['STUDENT_POSTER_ID'];
		?>

		<form method="post" action="" id="form1">
			<fieldset>
				<ul>
					<div class="col-xs-offset-2 col-xs-10"><p><b>Project details:</b></p></div>
					<div class="row">
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Academic Year:</label>
							<input type="text" name="year" placeholder="17/18" step="any" class="form-control" role="input" aria-required="true" value="<?php print $p_year; ?>" readonly/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Sponsor:</label>
							<select name="sponsor_id" aria-required="true" class="form-control" role="input" readonly>
								<?php
									$sql = 'SELECT * FROM SPONSOR';
									$result = $conn->query($sql);
									while ($row = $result->fetch_array())
									{
										if ($row['ORGANIZATION'] === $p_organization){
											echo "<option value=\"" . $row['SPONSOR_ID'] . "\" selected >". $row['ORGANIZATION'] . "</option>";
										}
										else {
											echo "<option value=\"" . $row['SPONSOR_ID'] . "\">". $row['ORGANIZATION'] . "</option>";
										}
									}
								?>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Mentor:</label>
							<input type="text" name="mentor" placeholder="mentor" class="form-control" role="input" aria-required="true" value="<?php print $p_mentor; ?>" readonly/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Department:</label>
							<select name="department_id" aria-required="true" class="form-control" role="input" readonly>
								<?php
									$sql = 'SELECT * FROM DEPARTMENT';
									$result = $conn->query($sql);
									while ($row = $result->fetch_array())
									{
										if ($row['NAME'] === $p_department){
											echo "<option value=\"" . $row['DEPARTMENT_ID'] . "\" selected >". $row['NAME'] . "</option>";
										}
										else {
											echo "<option value=\"" . $row['DEPARTMENT_ID'] . "\">". $row['NAME'] . "</option>";
										}
									}
								?>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Faculty Advisor:</label>
							<input type="text" name="faculty_advisor" placeholder="faculty advisor" class="form-control" role="input" aria-required="true" value="<?php print $p_faculty_advisor; ?>" readonly/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Status:</label>
							<select name="status_id" aria-required="true" class="form-control" role="input" readonly>
								<?php
									$sql = 'SELECT * FROM STATUS';
									$result = $conn->query($sql);
									while ($row = $result->fetch_array())
									{
										if ($row['PROJECT_STATUS'] === $p_status){
											echo "<option value=\"" . $row['STATUS_ID'] . "\" selected >". $row['PROJECT_STATUS'] . "</option>";
										}
										else {
											echo "<option value=\"" . $row['STATUS_ID'] . "\">". $row['PROJECT_STATUS'] . "</option>";
										}
									}
								?>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Project Type:</label>
							<input type="text" name="project_type" placeholder="project type" class="form-control" role="input" aria-required="true" value="<?php print $p_project_type; ?>" readonly/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Project Number:</label>
							<input type="text" name="project_number" placeholder="project number" class="form-control" role="input" aria-required="true" value="<?php print $p_project_number; ?>" readonly/>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-10">
							<label for="name" class="col-form-label">Project Name:</label>
							<input type="text" name="project_name" placeholder="project name" class="form-control" role="input" aria-required="true" value="<?php print $p_project_name; ?>" readonly/>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Index Code:</label>
							<input type="number" name="index_code" placeholder="1234" step="any" class="form-control" role="input" aria-required="true" value="<?php print $p_index_code; ?>" readonly/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Donation Received:</label>
							<input type="number" name="donation" placeholder="5000" class="form-control" role="input" aria-required="true" value="<?php print $p_donation; ?>" readonly/>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Budget:</label>
							<input type="number" name="budget" placeholder="5000" class="form-control" role="input" aria-required="true" value="<?php print $p_budget; ?>" readonly/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Amount Spent:</label>
							<input type="number" name="amount_spent" placeholder="0" class="form-control" role="input" aria-required="true" value="<?php print $p_amount_spent; ?>" readonly/>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-10">
							<label for="name" class="col-form-label">Supplemental Funding:</label>
							<input type="number" name="supplemental_funding" placeholder="0" class="form-control" role="input" aria-required="true"value="<?php print 0; ?>" readonly/>
						</div>
					</div>

					<div class="row form-check form-check-inline">
						<div class="form-check">
							<label for="name" class="col-form-label">
								<span>Service Learning?:&nbsp;</span>
								<input class="checkbox" type="checkbox" id="checkbox" name="is_service_learning" value="0" <?php if($p_is_service_learning == 1){print "checked";} ?> onclick="return false;"/>
							</label>
							<?php
								if(isset($_POST['is_service_learning'])) {
									$is_service_learning = 1;
								} else {
									$is_service_learning = 0;
								}
							?>
						</div>

						<div class="form-check">
							<label for="name" class="col-form-label">
								<span>Sternheimer?:&nbsp;</span>
								<input type="checkbox" id="checkbox" name="is_sternheimer" value="0" <?php if($p_is_sternheimer == 1){print "checked";} ?> onclick="return false;"/>
							</label>
							<?php
								if(isset($_POST['is_sternheimer'])) {
									$is_sternheimer = 1;
								} else {
									$is_sternheimer = 0;
								}
							?>
						</div>

						<div class="form-check">
							<label for="name" class="col-form-label">
								<span>Business Collaboration?:&nbsp;</span>
								<input type="checkbox" id="checkbox" name="is_partner" value="0" <?php if($p_is_partner == 1){print "checked";} ?> onclick="return false;"/>
							</label>
							<?php
								if(isset($_POST['is_partner'])) {
									$is_partner = 1;
								} else {
									$is_partner = 0;
								}
							?>
						</div>

						<div class="form-check">
							<label for="name" class="col-form-label">
								<span>US Citizenship?:&nbsp;</span>
								<input type="checkbox" id="checkbox" name="is_citizenship_required" value="0" <?php if($p_is_citizenship_required == 1){print "checked";} ?> onclick="return false;"/>
							</label>
							<?php
								if(isset($_POST['is_citizenship_required'])) {
									$is_citizenship_required = 1;
								} else {
									$is_citizenship_required = 0;
								}
							?>
						</div>
					</div>

					<div class="row checkboxes form-check form-check-inline">
						<div class="form-check">
							<label for="name" class="col-form-label">
								<span>IP Assignment?:&nbsp;</span>
								<input type="checkbox" id="checkbox" name="is_ip_assignment" value="0" <?php if($p_is_ip_assignment == 1){print "checked";} ?> onclick="return false;"/>
							</label>
							<?php
							  if(isset($_POST['is_ip_assignment'])){
								 $is_ip_assignment = 1;
							  }
							  else{
								 $is_ip_assignment = 0;
							  }
							?>
						</div>
						<div class="form-check">
							<label for="name" class="col-form-label">
								<span>IP Disclosure?:&nbsp;</span>
								<input type="checkbox" id="checkbox" name="is_ip_disclosure" value="0" <?php if($p_is_ip_disclosure == 1){print "checked";} ?> onclick="return false;"/>
							</label>
							<?php
							  if(isset($_POST['is_ip_disclosure'])){
								 $is_ip_disclosure = 1;
							  }
							  else{
								 $is_ip_disclosure = 0;
							  }
							?>
						</div>
						<div class="form-check">
							<label for="name" class="col-form-label">
								<span>Non Disclosure Agreement?:&nbsp;</span>
								<input type="checkbox" id="checkbox" name="is_nondisclosure_agreement" value="0" <?php if($p_is_nondisclosure_agreement == 1){print "checked";} ?> onclick="return false;"/>
							</label>
							<?php
								if(isset($_POST['is_nondisclosure_agreement'])) {
									$is_nondisclosure_agreement = 1;
								} else {
									$is_nondisclosure_agreement = 0;
								}
							?>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-10">
							<label for="name" class="col-form-label">Note:</label>
							<textarea type="text" name="note" class="form-control" rows=6 role="input" aria-required="true" readonly>
								<?=$p_note?>
							</textarea>
						</div>
					</div>
				</ul>
			</fieldset>
		</form>

		<div style="width:100%">
			<table class="table table-striped" table style="margin-left:30px">
				<?php
					$query = "SELECT * from STUDENT where PROJECT_ID = '$project_id'";
					$result = $conn->query($query);
					if ($row = $result->fetch_array()) {
						echo "<thead><tr><th>Email</th><th>First Name</th><th>Last Name</th></thead>";
						echo "<tbody>";
						print '<tr>';
						print '<td>' . $row["EMAIL"] . '</td><td>' . $row["FIRST_NAME"] . '</td><td>' . $row["LAST_NAME"] . '</td>';
						print '</tr>';
					}
					while ($row = $result->fetch_array()) {
						print '<tr>';
						print '<td>' . $row["EMAIL"] . '</td><td>' . $row["FIRST_NAME"] . '</td><td>' . $row["LAST_NAME"] . '</td>';
						print '</tr>';
					}
				?>
		</div>
	</div>
</body>
</html>
