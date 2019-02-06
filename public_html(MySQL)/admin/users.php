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
  <!-- shows all users and has a button to create a user -->
  <div class="container">
    <div style="width:50%">
      <div class="form-group"><a href="create-user.php"><button name="CreateUser" type="submit" class="btn btn-primary">Create User</button></a></div>
      <table class="table table-striped">
        <thead><tr><th>Email</th><th>First Name</th><th>Last Name</th><th>Admin</th></thead>
          <tbody>
  <?php
      $sql = 'SELECT * from APP_USERS';
      $result = $conn->query($sql);
      while ($row = $result->fetch_array()){
        if($row['IS_ADMIN'] == 1){
          $is_admin = 'Y';
        }
        else{
          $is_admin = 'N';
        }
        print '<tr>';
          print '<td>' . $row['EMAIL'] . '</td><td>' . $row['FIRST_NAME'] . '</td><td>' . $row['LAST_NAME'] . '</td><td>' . $is_admin . '</td>';
        print '</tr>';
      }
  ?>
</tbody>
</table>
</div>
</div>
</body>
</html>
