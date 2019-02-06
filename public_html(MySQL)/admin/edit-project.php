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

			ini_set("upload_max_filesize", "50M");
			// gets values from database for selected project
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
			$p_status = $row['PROJECT_STATUS'];
		?>
		<!-- uploading and downloading of project files -->
		<ul>
		<br><div class="col-xs-offset-2 col-xs-10"><p><b>Project files:</b></p></div>
		<div class="row">
			<div class="col-xl-10">
				<label class="col-form-label">
					<?php
						if ($p_sponsor_abstract_id === NULL) {
					?>
					<form style="margin-bottom: 0" action="upload-file.php" method="POST" enctype="multipart/form-data">
						<span>Sponsor Abstract:&nbsp;</span>
						<input type="file" name="fileToUpload">
						<input type="hidden" name="project_id" value="<?php print $project_id; ?>" />
						<input type="hidden" name="type" value="sponsor_abstract" />
						<button name="Upload File" type="submit">Upload File</button>
					</form>
					<?php
						} else {
					?>
					<form style="margin-bottom: 0" action="" method="POST">
						<span>Sponsor Abstract:&nbsp;</span>
					<?php
							$query = "select * from ATTACHMENT where ID = '$p_sponsor_abstract_id'";
							$result = $conn->query($query);
							if ($row = $result->fetch_array()) {
								$file_name = $row['NAME'];
								$target_dir = "attachments/" . $row['ID'];
								$target_file = $target_dir . "/" . $file_name;

								if (!file_exists($target_file))
									mkdir($target_dir, 0777, true);

								$file = fopen($target_file, "w");
								fwrite($file, $row['DATA']);
								fclose($file);

								print "<a href='$target_file'>$file_name</a>";
							}
							$result->close();
					?>
						<input type="hidden" name="file_id" value="<?php print $p_sponsor_abstract_id; ?>" />
						<input type="hidden" name="type" value="sponsor_abstract" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button name="Delete File" type="submit">Delete File</button>
					</form>

					<?php
						}
					?>
				</label>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-10">
				<label class="col-form-label">
					<?php
						if ($p_student_abstract_id == NULL) {
					?>
					<form style="margin-bottom: 0" action="upload-file.php" method="POST" enctype="multipart/form-data">
						<span>Student Abstract:&nbsp;</span>
						<input type="file" name="fileToUpload">
						<input type="hidden" name="project_id" value="<?php print $project_id; ?>" />
						<input type="hidden" name="type" value="student_abstract" />
						<button name="Upload File" type="submit" >Upload File</button>
					</form>
					<?php
						} else {
					?>
					<form style="margin-bottom: 0" action="" method="POST">
						<span>Student Abstract:&nbsp;</span>
					<?php
							$query = "select * from ATTACHMENT where ID = '$p_student_abstract_id'";
							$result = $conn->query($query);
							if ($row = $result->fetch_array()) {
								$file_name = $row['NAME'];
								$target_dir = "attachments/" . $row['ID'];
								$target_file = $target_dir . "/" . $file_name;

								if (!file_exists($target_file))
									mkdir($target_dir, 0777, true);

								$file = fopen($target_file, "w");
								fwrite($file, $row['DATA']);
								fclose($file);

								print "<a href='$target_file'>$file_name</a>";
							}
							$result->close();
					?>
						<input type="hidden" name="file_id" value="<?php print $p_student_abstract_id; ?>" />
						<input type="hidden" name="type" value="student_abstract" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button name="Delete File" type="submit">Delete File</button>
					</form>
					<?php
						}
					?>
				</label>
			</div>
		</div>

		<div class="row">
			<div class="col-xl-10">
				<label class="col-form-label">
					<?php
						if ($p_student_poster_id == NULL) {
					?>
					<form style="margin-bottom: 0" action="upload-file.php" method="POST" enctype="multipart/form-data">
						<span>Student Poster:&nbsp;</span>
						<input type="file" name="fileToUpload">
						<input type="hidden" name="type" value="student_poster" />
						<input type="hidden" name="project_id" value="<?php print $project_id; ?>" />
						<button name="Upload File" type="submit" >Upload File</button>
					</form>
					<?php
						} else {
					?>
					<form style="margin-bottom: 0" action="" method="POST">
						<span>Student Poster:&nbsp;</span>
					<?php
							$query = "select * from ATTACHMENT where ID = '$p_student_poster_id'";
							$result = $conn->query($query);
							if ($row = $result->fetch_array()) {
								$file_name = $row['NAME'];
								$target_dir = "attachments/" . $row['ID'];
								$target_file = $target_dir . "/" . $file_name;

								if (!file_exists($target_file))
									mkdir($target_dir, 0777, true);

								$file = fopen($target_file, "w");
								fwrite($file, $row['DATA']);
								fclose($file);

								print "<a href='$target_file'>$file_name</a>";
							}
							$result->close();
					?>
						<input type="hidden" name="file_id" value="<?php print $p_student_poster_id; ?>" />
						<input type="hidden" name="type" value="student_poster" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button name="Delete_File" type="submit">Delete File</button>
					</form>
					<?php
						}
					?>
				</label>
			</div>
		</div>
		</ul>
		<!-- form for editing contact info -->
		<form method="post" action="" id="form1">
			<fieldset>
				<ul>
					<div class="col-xs-offset-2 col-xs-10"><p><b>Project details:</b></p></div>
					<div class="row">
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Academic Year:</label>
							<input type="text" name="year" placeholder="17/18" step="any" class="form-control" role="input" aria-required="true" value="<?php print $p_year; ?>" required/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Sponsor:</label>
							<select name="sponsor_id" aria-required="true" class="form-control" role="input">
								<?php
									$sql = 'SELECT * FROM SPONSOR';
									$result = $conn->query($sql);
									while ($row = $result->fetch_array())
									{
										if ($row['ORGANIZATION'] === $p_organization) {
											echo "<option value=\"" . $row['SPONSOR_ID'] . "\" selected >". $row['ORGANIZATION'] . "</option>";
										} else {
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
							<input type="text" name="mentor" placeholder="mentor" class="form-control" role="input" aria-required="true" value="<?php print $p_mentor; ?>"/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Department:</label>
							<select name="department_id" aria-required="true" class="form-control" role="input" required>
								<?php
									$sql = 'SELECT * FROM DEPARTMENT';
									$result = $conn->query($sql);
									while ($row = $result->fetch_array())
									{
										if ($row['NAME'] === $p_department) {
											echo "<option value=\"" . $row['DEPARTMENT_ID'] . "\" selected >". $row['NAME'] . "</option>";
										} else {
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
							<input type="text" name="faculty_advisor" placeholder="faculty advisor" class="form-control" role="input" aria-required="true" value="<?php print $p_faculty_advisor; ?>"/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Status:</label>
							<select name="status_id" aria-required="true" class="form-control" role="input" required>
								<?php
									$sql = 'SELECT * FROM STATUS';
									$result = $conn->query($sql);
									while ($row = $result->fetch_array())
									{
										if ($row['PROJECT_STATUS'] === $p_status) {
											echo "<option value=\"" . $row['STATUS_ID'] . "\" selected >". $row['PROJECT_STATUS'] . "</option>";
										} else {
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
							<input type="text" name="project_type" placeholder="project type" class="form-control" role="input" aria-required="true" value="<?php print $p_project_type; ?>"/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Project Number:</label>
							<input type="text" name="project_number" placeholder="project number" class="form-control" role="input" aria-required="true" value="<?php print $p_project_number; ?>" required/>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-10">
							<label for="name" class="col-form-label">Project Name:</label>
							<input type="text" name="project_name" placeholder="project name" class="form-control" role="input" aria-required="true" value="<?php print $p_project_name; ?>" required/>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Index Code:</label>
							<input type="number" name="index_code" placeholder="1234" step="any" class="form-control" role="input" aria-required="true" value="<?php print $p_index_code; ?>"/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Donation Received:</label>
							<input type="number" name="donation" placeholder="5000" class="form-control" role="input" aria-required="true" value="<?php print $p_donation; ?>"/>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Budget:</label>
							<input type="number" name="budget" placeholder="5000" class="form-control" role="input" aria-required="true" value="<?php print $p_budget; ?>" required/>
						</div>
						<div class="col-xl-5">
							<label for="name" class="col-form-label">Amount Spent:</label>
							<input type="number" name="amount_spent" placeholder="0" class="form-control" role="input" aria-required="true" value="<?php print $p_amount_spent; ?>" required/>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-10">
							<label for="name" class="col-form-label">Supplemental Funding:</label>
							<input type="number" name="supplemental_funding" placeholder="0" class="form-control" role="input" aria-required="true"value="<?php print 0; ?>"/>
						</div>
					</div>

					<div class="row form-check form-check-inline">
						<div class="form-check">
							<label for="name" class="col-form-label">
								<span>Service Learning?:&nbsp;</span>
								<input class="checkbox" type="checkbox" id="checkbox" name="is_service_learning" value="0" <?php if($p_is_service_learning == 1){print "checked";} ?>/>
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
								<input type="checkbox" id="checkbox" name="is_sternheimer" value="0" <?php if($p_is_sternheimer == 1){print "checked";} ?>/>
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
								<input type="checkbox" id="checkbox" name="is_partner" value="0" <?php if($p_is_partner == 1){print "checked";} ?>/>
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
								<input type="checkbox" id="checkbox" name="is_citizenship_required" value="0" <?php if($p_is_citizenship_required == 1){print "checked";} ?>/>
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
								<input type="checkbox" id="checkbox" name="is_ip_assignment" value="0" <?php if($p_is_ip_assignment == 1){print "checked";} ?>/>
							</label>
							<?php
								if(isset($_POST['is_ip_assignment'])) {
									$is_ip_assignment = 1;
								} else {
									$is_ip_assignment = 0;
								}
							?>
						</div>
						<div class="form-check">
							<label for="name" class="col-form-label">
								<span>IP Disclosure?:&nbsp;</span>
								<input type="checkbox" id="checkbox" name="is_ip_disclosure" value="0" <?php if($p_is_ip_disclosure == 1){print "checked";} ?>/>
							</label>
							<?php
								if(isset($_POST['is_ip_disclosure'])) {
									$is_ip_disclosure = 1;
								} else {
									$is_ip_disclosure = 0;
								}
							?>
						</div>
						<div class="form-check">
							<label for="name" class="col-form-label">
								<span>Non Disclosure Agreement?:&nbsp;</span>
								<input type="checkbox" id="checkbox" name="is_nondisclosure_agreement" value="0" <?php if($p_is_nondisclosure_agreement == 1){print "checked";} ?>/>
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
							<textarea type="text" name="note" class="form-control" rows=6 role="input" aria-required="true"><?=$p_note?></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-5">
							<div class="col-form-label">
								<button name="Submit" type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
								<button name="Delete" type="submit" class="btn btn-primary">Delete</button>
							</div>
						</div>
					</div>


				</ul>
			</fieldset>
		</form>

		<!-- students currently assigned to project -->
		<div style="width:100%">
			<table class="table table-striped" table style="margin-left:30px">
				<?php
					$query = "SELECT * from STUDENT where PROJECT_ID = '$project_id'";
					$result = $conn->query($query);
					if ($row = $result->fetch_array()) {
						echo "<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Assigned Students:</b></p>";
						echo "<thead><tr><th>Email</th><th>First Name</th><th>Last Name</th><th></th></thead>";
						echo "<tbody>";
						print '<tr>';
						print '<td>' . $row["EMAIL"] . '</td><td>' . $row["FIRST_NAME"] . '</td><td>' . $row["LAST_NAME"] . '</td><td><a href="edit-student.php?id=' . $row['STUDENT_ID'] . '">View/Edit</a></td>';
						print '</tr>';
					}
					while ($row = $result->fetch_array()) {
						print '<tr>';
						print '<td>' . $row["EMAIL"] . '</td><td>' . $row["FIRST_NAME"] . '</td><td>' . $row["LAST_NAME"] . '</td><td><a href="edit-student.php?id=' . $row['STUDENT_ID'] . '">View/Edit</a></td>';
						print '</tr>';
					}
				?>
		</div>

		<?php
			if (isset($_POST['Submit'])) {
				// Insert into database using values supplied by user
				$sponsor_id = intval($_POST['sponsor_id']);
				$project_name = $conn->real_escape_string($_POST['project_name']);
				$project_number = $conn->real_escape_string($_POST['project_number']);
				$project_type = $conn->real_escape_string($_POST['project_type']);
				$note = $conn->real_escape_string($_POST['note']);
				$department_id = intval($_POST['department_id']);
				$mentor = $conn->real_escape_string($_POST['mentor']);
				$faculty_advisor = $conn->real_escape_string($_POST['faculty_advisor']);
				$index_code = intval($_POST['index_code']);
				$donation = intval($_POST['donation']);
				$year = $conn->real_escape_string($_POST['year']);
				$status_id = intval($_POST['status_id']);
				$capstone_budget = intval($_POST['budget']);
				$amount_spent = intval($_POST['amount_spent']);
				$supplemental_funding = intval($_POST['supplemental_funding']);
				$stid=$conn->prepare("UPDATE PROJECT SET sponsor_id = ?, project_name = ?, project_number = ?, project_type = ?, note = ?, department_id = ?, mentor = ?, faculty_advisor = ?, index_code = ?, donation = ?, year = ?, status_id = ?, is_service_learning = ?, is_ip_assignment = ?, is_ip_disclosure = ?, is_sternheimer = ?, capstone_budget = ?, amount_spent = ?, supplemental_funding = ?, is_partner = ?, is_citizenship_required = ?, is_nondisclosure_agreement = ? WHERE project_id = ?");
				$stid->bind_param('issssissiisiiiiiiiiiiii', $sponsor_id, $project_name, $project_number, $project_type, $note, $department_id, $mentor, $faculty_advisor, $index_code, $donation, $year, $status_id, $is_service_learning, $is_ip_assignment, $is_ip_disclosure, $is_sternheimer, $capstone_budget, $amount_spent, $supplemental_funding, $is_partner, $is_citizenship_required, $is_nondisclosure_agreement, $project_id) or die($stid->error);
				$stid->execute();
				$stid->fetch();
				ob_start();
				echo "<script>document.location.href='search-projects.php'</script>";
				ob_end_flush();
			}

			if (isset($_POST['Delete'])) {
				$stid=$conn->prepare("DELETE FROM PROJECT WHERE project_id = ?");
				$stid->bind_param('i', $project_id) or die($stid->error);
				$success = $stid->execute();
				if ($success) {
					ob_start();
					echo "<script>document.location.href='search-projects.php'</script>";
					ob_end_flush();
				}
			}

			if (isset($_POST['Delete_File'])) {
				$id_to_delete = $_POST['file_id'];
				$type = $_POST['type'];

				$stid=$conn->prepare("UPDATE PROJECT SET $type = NULL WHERE project_id = ?");
				$stid->bind_param('i', $project_id) or die($stid->error);
				$stid->execute() or die($stid->error);

				$stid=$conn->prepare("DELETE FROM ATTACHMENT WHERE id = ?");
				$stid->bind_param('i', $id_to_delete) or die($stid->error);
				$success = $stid->execute() or die($stid->error);

				if ($success) {
					ob_start();
					echo "<script>document.location.href='edit-project.php?id=$project_id'</script>";
					ob_end_flush();
				}
			}
		?>
	</div>
</body>
</html>
