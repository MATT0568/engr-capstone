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
  <?php
    // gets values from database for selected contact
    $student_id = $_GET['id'];
    $query = "SELECT * from STUDENT where student_id = '$student_id'";
    $result = $conn->query($query);
    $row = $result->fetch_array();
    $p_department = $row['DEPARTMENT_ID'];
    $p_academic_year = $row['ACADEMIC_YEAR'];
    $p_first_name = $row['FIRST_NAME'];
    $p_last_name = $row['LAST_NAME'];
    $p_email = $row['EMAIL'];
  ?>

<!-- form for editing sponsor info -->
<div class="container">
  <form class="form-horizontal" method="post" action="" id="form1">
     <fieldset>
       <ul>
               <div class="col-xs-offset-2 col-xs-10"><p><b>Please edit your student details:</b></p></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">First Name:</label><div class="col-10"><input type="text" name="first_name" class="form-control" role="input" aria-required="true" value="<?php print $p_first_name; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Last Name:</label><div class="col-10"><input type="text" name="last_name" step="any" class="form-control" role="input" aria-required="true" value="<?php print $p_last_name; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Email:</label><div class="col-10"><input type="text" name="email" class="form-control" role="input" aria-required="true" value="<?php print $p_email; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Department:</label><div class="col-10"><select name="department_id" aria-required="true" class="form-control" role="input" value="2" required>
                   <?php
                   $sql = 'SELECT * FROM DEPARTMENT';
                   $result = $conn->query($sql);
                    while ($row = $result->fetch_array())
                      {
                        if ($row['DEPARTMENT_ID'] === $p_department){
                          echo "<option value=\"" . $row['DEPARTMENT_ID'] . "\" selected >". $row['NAME'] . "</option>";
                        }
                        else {
                          echo "<option value=\"" . $row['DEPARTMENT_ID'] . "\">". $row['NAME'] . "</option>";
                        }
                      }
                  ?>
                </select></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Academic Year:</label><div class="col-10"><input type="text" name="academic_year" class="form-control" role="input" aria-required="true" value="<?php print $p_academic_year; ?>" required/></div></div>
               <div class="form-group"><div class="col-xs-offset-2 col-xs-10"><button name="Submit" type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;<button name="Delete" type="submit" class="btn btn-primary">Delete</button></div></div>
       </ul>
       <br/>
     </fieldset>
   </form>


  <?php
    if (isset($_POST['Submit'])) {
      // Insert into database using values supplied by user
      $department_id = intval($_POST['department_id']);
      $first_name = $conn->real_escape_string($_POST['first_name']);
      $last_name = $conn->real_escape_string($_POST['last_name']);
      $email = $conn->real_escape_string($_POST['email']);
      $academic_year = $conn->real_escape_string($_POST['academic_year']);
      $stid=$conn->prepare("UPDATE STUDENT SET department_id = ?, academic_year = ?, first_name = ?, last_name = ?, email = ? WHERE student_id = ?");
      $stid->bind_param('issssi', $department_id, $academic_year, $first_name, $last_name, $email, $student_id) or die($stid->error);
      $stid->execute();
      $stid->fetch();
      ob_start();
      echo "<script>document.location.href='edit-student.php?id=$student_id'</script>";
      ob_end_flush();
    }

  if (isset($_POST['Delete'])){
    // delete selected contact from database
    $stid=$conn->prepare("DELETE FROM STUDENT WHERE student_id = ?");
    $stid->bind_param('i', $student_id) or die($stid->error);
    $success = $stid->execute();
    if($success){
      ob_start();
      echo "<script>document.location.href='search-students.php'</script>";
      ob_end_flush();
    }
  }
  ?>
</div>
</body>
</html>
