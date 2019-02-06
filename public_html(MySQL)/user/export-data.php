<?php include('../connect.php'); ?>
  <?php
  error_reporting(0);
  date_default_timezone_set("America/New_York");
  // creates query using selected filters
  $query = 'SELECT * FROM PROJECT_INFO WHERE 1=1';
  if(isset($_GET['id1'])){
    $query = $query . " and year = '".$_GET['id1']."'";
  }
  if(isset($_GET['id2'])){
    $query = $query . " and sponsor_id = '".$_GET['id2']."'";
  }
  if(isset($_GET['id3'])){
    $query = $query . " and department_id = '".$_GET['id3']."'";
  }
  if(isset($_GET['id4'])){
    $query = $query . " and status_id = '".$_GET['id4']."'";
  }
  // checks to see if query returns anything. If it does then create column names and fill with specified data from the project_info view
  $result = $conn->query($query);
  if($result->num_rows > 0){
      $delimiter = ",";
      $filename = "projects_" . date("m-d-y") . ".csv";

      $f = fopen('php://memory', 'w');

      $fields = array('year', 'sponsor', 'department', 'faculty_advisor', 'mentor', 'project_name', 'project_number', 'project_status', 'index_code', 'donation', 'budget', 'amount_spent', 'supplemental_funding', 'is_service_learning', 'is_sternheimer', 'is_partner', 'is_citizenship_required', 'is_ip_assignment', 'is_ip_disclosure', 'is_nondisclosure_agreement');
      fputcsv($f, $fields, $delimiter);

      while($row = $result->fetch_assoc()){
          if($row['IS_SERVICE_LEARNING'] == 1){
            $is_service_learning = 'yes';
          }
          else{
            $is_service_learning = 'no';
          }
          if($row['IS_STERNHEIMER'] == 1){
            $is_sternheimer = 'yes';
          }
          else{
            $is_sternheimer = 'no';
          }
          if($row['IS_PARTNER'] == 1){
            $is_partner = 'yes';
          }
          else{
            $is_partner = 'no';
          }
          if($row['IS_CITIZENSHIP_REQUIRED'] == 1){
            $is_citizenship_required = 'yes';
          }
          else{
            $is_citizenship_required = 'no';
          }
          if($row['IS_IP_ASSIGNMENT'] == 1){
            $is_ip_assignment= 'yes';
          }
          else{
            $is_ip_assignment = 'no';
          }
          if($row['IS_IP_DISCLOSURE'] == 1){
            $is_ip_disclosure = 'yes';
          }
          else{
            $is_ip_disclosure = 'no';
          }
          if($row['IS_NONDISCLOSURE_AGREEMENT'] == 1){
            $is_nondisclosure_agreement = 'yes';
          }
          else{
            $is_nondisclosure_agreement = 'no';
          }
          $lineData = array($row['YEAR'], $row['SPONSOR'], $row['DEPARTMENT'], $row['FACULTY_ADVISOR'], $row['MENTOR'], $row['PROJECT_NAME'],
          $row['PROJECT_NUMBER'], $row['PROJECT_STATUS'], $row['INDEX_CODE'], $row['DONATION'], $row['CAPSTONE_BUDGET'], $row['AMOUNT_SPENT'], $row['SUPPLEMENTAL_FUNDING'], $is_service_learning, $is_sternheimer, $is_partner, $is_citizenship_required, $is_ip_assignment, $is_ip_disclosure, $is_nondisclosure_agreement);
          fputcsv($f, $lineData, $delimiter);
      }

      fseek($f, 0);

      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="' . $filename . '";');

      fpassthru($f);
  }
  exit;
  ?>
