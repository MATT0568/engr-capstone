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
	
	
	
	if (isset($_POST['Upload_File'])) {
		$target_file = $_FILES['fileToUpload']['tmp_name'];
		$filename = basename($_FILES["fileToUpload"]["name"]);
		$project_id = $_POST['project_id'];
		$null = NULL;
		
		$stid=$conn->prepare("INSERT INTO ATTACHMENT (NAME, DATA) VALUES (?,?)");
		$stid->bind_param("sb", $filename, $null);
		
		$fp = fopen($target_file, "r");
		if (!$fp) die("failed to upload file");
		while (!feof($fp)) {
			$stid->send_long_data(1, fread($fp, 8192));
		}
		fclose($fp);
		
		$success = $stid->execute();
		
		if ($success) {
			$id = $conn->insert_id;
			$filetype = $_POST['type'];
		
			if ($id !== null and $project_id !== null) {
				$stid=$conn->prepare("UPDATE PROJECT SET $filetype = ? WHERE project_id = ?");
				$stid->bind_param("ii", $id, $project_id);
				$success = $stid->execute();
				if ($success) {
					ob_start();
					echo "<script>document.location.href='edit-project.php?id=$project_id'</script>";
					ob_end_flush();
				}
				else {
				  print "upload still failed";
				}
			}
		} else {
			print $conn->error;
		}
	} else {
		print "upload failed";
	}
	
    /* if (isset($_POST['Submit'])) {
		$target_file = $_FILES['fileToUpload']['tmp_name']
		$filename = basename($_FILES["fileToUpload"]["name"]);
		$null = NULL;
		
		$stid=$conn->prepare("INSERT INTO ATTACHMENT (NAME, DATA) VALUES (?,?)");
		$stid->bind_param("sb", $filename, $null);
		
		$fp = fopen($target_file, "r");
		while (!feof($fp)) {
			$stid->send_long_data(0, fread($fp, 8192));
		}
		fclose($fp);
		
		$stid->execute();
		
		$id = $conn->insert_id;
		$project_id = $_POST['project_id'];
		
		if ($_POST['type'] === 'sponsor_abstract') {
			$s
		}
		else if ($_POST['type'] === 'student_abstract') {

		}
		else if ($_POST['type'] === 'student_poster') {

		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	} */
?>
</body>
