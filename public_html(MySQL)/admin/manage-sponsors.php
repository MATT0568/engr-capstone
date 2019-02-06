<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <?php include 'validate.php'; ?>
</head>
<body>
  <?php include('navigation.php'); ?>
  <?php include('../connect.php'); ?>
<!-- shows a list of all sponsors with links to edit the sponsor, view a sponsors contacts, and a button to export all sponsors. -->
<div class="container">
  <div style="width:50%">
    <table class="table table-striped">
      <div class="form-group"><div class="col-xs-offset-10 col-xs-10"><a href="export-sponsors.php" class="btn btn-success">Export Sponsors</a>&nbsp;&nbsp;<a href="export-contacts.php" class="btn btn-success">Export Contacts</a></div></div>
      <thead><tr><th>Sponsor</th><th>Address</th></thead>
        <tbody>
        <?php
            $query = "SELECT * FROM SPONSOR";
            $result = $conn->query($query);
            while($row = $result->fetch_array()){
              print '<tr>';
              print '<td>' . $row["ORGANIZATION"] . '</td><td>' . $row["ADDRESS"] . '</td><td><a href="edit-sponsor.php?id=' . $row["SPONSOR_ID"] . '">View/Edit</a></td>' . '<td><a href="view-contacts.php?id=' . $row['SPONSOR_ID'] . '">Contacts</a></td>';
              print '</tr>';
            }
        ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
