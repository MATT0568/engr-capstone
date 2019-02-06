<?php include('../connect.php'); ?>
  <?php
  error_reporting(0);
  date_default_timezone_set("America/New_York");
  $query = 'SELECT * FROM SPONSOR WHERE 1=1';
  $result = $conn->query($query);
  // checks to see if query returns anything. If it does then create column names and fill with specified data from the contact table
  if($result->num_rows > 0){
      $delimiter = ",";
      $filename = "sponsors_" . date("m-d-y") . ".csv";

      $f = fopen('php://memory', 'w');

      $fields = array('organization', 'address', 'city', 'state', 'zip', 'sponsor_type');
      fputcsv($f, $fields, $delimiter);

      while($row = $result->fetch_assoc()){
          $lineData = array($row['ORGANIZATION'], $row['ADDRESS'], $row['CITY'], $row['STATE'], $row['ZIP'], $row['SPONSOR_TYPE']);
          fputcsv($f, $lineData, $delimiter);
      }

      fseek($f, 0);

      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="' . $filename . '";');

      fpassthru($f);
  }
  exit;
  ?>
