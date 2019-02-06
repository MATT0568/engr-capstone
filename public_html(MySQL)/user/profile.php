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
      $query = 'select email, first_name, last_name from app_users where email = upper(:email)';
      $perm = oci_parse($conn, $query);
      oci_bind_by_name($perm, ":email", $_SESSION['email']);
      $x = oci_execute($perm);

      while ($row = oci_fetch_array($perm, OCI_RETURN_NULLS+OCI_ASSOC)) {
          print '<font size="3"><strong>Email:&nbsp;' . $row['EMAIL'] . "</strong></font><br>";
          print '<font size="3"><strong>First Name:&nbsp;' . $row['FIRST_NAME'] . "</strong></font><br>";
          print '<font size="3"><strong>Last Name:&nbsp;' . $row['LAST_NAME'] . "</strong></font><br>";
      }


  ?>
  <div class="form-group"><a href="edit-user.php"><button name="edit-user" type="submit" class="btn btn-primary">Change Name</button></a></div>
</div>
</body>
</html>
