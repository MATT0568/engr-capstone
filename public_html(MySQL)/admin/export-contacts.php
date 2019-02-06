<?php include('../connect.php'); ?>
  <?php
  error_reporting(0);
  date_default_timezone_set("America/New_York");
  $query = 'SELECT * FROM CONTACT WHERE 1=1 group by SPONSOR_ID';
  $result = $conn->query($query);
  // checks to see if query returns anything. If it does then create column names and fill with specified data from the contact table
  if($result->num_rows > 0){
      $delimiter = ",";
      $filename = "contacts_" . date("m-d-y") . ".csv";

      $f = fopen('php://memory', 'w');

      $fields = array('organization', 'first name', 'last name', 'email', 'phone', 'title');
      fputcsv($f, $fields, $delimiter);

      while($row = $result->fetch_assoc()){
          $sponsorQuery = 'SELECT * FROM SPONSOR WHERE SPONSOR_ID='.$row['SPONSOR_ID'].'';
          $sponsor = $conn->query($sponsorQuery);
          $sponsorRow = $sponsor->fetch_assoc();
          $lineData = array($sponsorRow['ORGANIZATION'], $row['FIRST_NAME'], $row['LAST_NAME'], $row['EMAIL'], $row['PHONE'], $row['TITLE']);
          fputcsv($f, $lineData, $delimiter);
      }

      fseek($f, 0);

      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="' . $filename . '";');

      fpassthru($f);
  }
  exit;
  ?>
