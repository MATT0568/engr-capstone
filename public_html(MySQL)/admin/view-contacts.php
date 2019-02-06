<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <?php include 'validate.php'; ?>
</head>
<body>
  <?php include('../connect.php'); ?>
  <?php include('navigation.php'); ?>
  <?php
  // elects contacts from specified sponsor
  $sponsor_id = $_GET['id'];
  $stid=$conn->prepare("SELECT * FROM CONTACT WHERE sponsor_id = ?");
  $stid->bind_param('i', $sponsor_id) or die($stid->error);
  ?>
  <!-- button to create contact -->
  <div class="container">
    <div style="width:50%">
      <div class="form-group"><a href="add-contact.php?id=<?php echo $sponsor_id ?>"><button name="AddContact" type="submit" class="btn btn-primary">Add Contact</button></a></div>
      <table class="table table-striped">
          <tbody>
  <?php
    // gets contact info for specified sponsor and using filters. Also gives a link to esit contact
    $query = "SELECT * FROM CONTACT WHERE sponsor_id = '".$sponsor_id."'";
      $result = $conn->query($query);
      if($row = $result->fetch_array()){
        echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Title</th></thead>";
        print '<tr>';
        print '<td>' . $row["FIRST_NAME"] . '</td><td>' . $row["LAST_NAME"] . '</td><td>' . $row["EMAIL"] . '</td><td>' . $row["PHONE"] . '</td><td>' . $row["TITLE"] . '</td><td><a href="edit-contact.php?contact_id=' . $row['CONTACT_ID'] . '&sid=' . $sponsor_id . '">Edit</a></td>';
        print '</tr>';
      }
      while ($row = $result->fetch_array()) {
        print '<tr>';
        print '<td>' . $row["FIRST_NAME"] . '</td><td>' . $row["LAST_NAME"] . '</td><td>' . $row["EMAIL"] . '</td><td>' . $row["PHONE"] . '</td><td>' . $row["TITLE"] . '</td><td><a href="edit-contact.php?contact_id=' . $row['CONTACT_ID'] . '&sid=' . $sponsor_id . '">Edit</a></td>';
        print '</tr>';
      }
  ?>
</tbody>
</table>
</div>
</div>
</body>
</html>
