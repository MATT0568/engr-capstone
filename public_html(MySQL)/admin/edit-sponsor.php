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
    $sponsor_id = $_GET['id'];
    $query = "SELECT * from SPONSOR where sponsor_id = '$sponsor_id'";
    $result = $conn->query($query);
    $row = $result->fetch_array();
    $p_organization = $row['ORGANIZATION'];
    $p_address = $row['ADDRESS'];
    $p_city = $row['CITY'];
    $p_state = $row['STATE'];
    $p_zip = $row['ZIP'];
    $p_sponsor_type = $row['SPONSOR_TYPE'];
    $p_partner_type = $row['PARTNER_TYPE'];
    $p_is_strategic = $row['IS_STRATEGIC'];
  ?>
<!-- form for editing sponsor info -->
<div class="container">
  <form class="form-horizontal" method="post" action="" id="form1">
     <fieldset>
       <ul>
               <div class="col-xs-offset-2 col-xs-10"><p><b>Please edit your Sponsor details:</b></p></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Organization:</label><div class="col-10"><input type="text" name="sponsor" class="form-control" role="input" aria-required="true" value="<?php print $p_organization; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Address:</label><div class="col-10"><input type="text" name="address" step="any" class="form-control" role="input" aria-required="true" value="<?php print $p_address; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">City:</label><div class="col-10"><input type="text" name="city" class="form-control" role="input" aria-required="true" value="<?php print $p_city; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">State:</label><div class="col-10"><input type="text" name="state" class="form-control" role="input" aria-required="true" value="<?php print $p_state; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Zip:</label><div class="col-10"><input type="number" name="zip" class="form-control" role="input" aria-required="true" value="<?php print $p_zip; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Sponsor Type:</label><div class="col-10"><input type="text" name="sponsor_type" class="form-control" role="input" aria-required="true" value="<?php print $p_sponsor_type; ?>"/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Partner Type:</label><div class="col-10"><input type="text" name="partner_type" class="form-control" role="input" aria-required="true" value="<?php print $p_partner_type; ?>"/></div></div>
               <div class="row form-check form-check-inline"><label for="name" class="col-form-label">&nbsp;&nbsp;&nbsp;Strategic?:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="checkbox" id="checkbox" name="checkbox" value="0" <?php if($p_is_strategic == 1){print "checked";} ?>/>
                   <?php
                     if(isset($_POST['checkbox'])){
                        $is_strategic = 1;
                     }
                     else{
                        $is_strategic = 0;
                     }
                   ?>
               </div>
               <div class="form-group"><div class="col-xs-offset-2 col-xs-10"><button name="Submit" type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;<button name="Delete" type="submit" class="btn btn-primary">Delete</button></div></div>
       </ul>
       <br/>
     </fieldset>
   </form>


  <?php
    if (isset($_POST['Submit'])) {
      // Insert into database using values supplied by user
      $organization = $conn->real_escape_string($_POST['sponsor']);
      $address = $conn->real_escape_string($_POST['address']);
      $city = $conn->real_escape_string($_POST['city']);
      $state = $conn->real_escape_string($_POST['state']);
      $zip = intval($_POST['zip']);
      $sponsor_type = $conn->real_escape_string($_POST['sponsor_type']);
      $partner_type = $conn->real_escape_string($_POST['partner_type']);
      $stid=$conn->prepare("UPDATE SPONSOR SET organization = ?, address = ?, city = ?, state = ?, zip = ?, sponsor_type = ?, partner_type = ?, is_strategic = ? WHERE sponsor_id = ?");
      $stid->bind_param('ssssissii', $organization, $address, $city, $state, $zip, $sponsor_type, $partner_type, $is_strategic, $sponsor_id) or die($stid->error);
      $stid->execute();
      $stid->fetch();
      header('Location: manage-sponsors.php');
    }

  if (isset($_POST['Delete'])){
    // delete selected contact from database
    $stid=$conn->prepare("DELETE FROM SPONSOR WHERE sponsor_id = ?");
    $stid->bind_param('i', $sponsor_id) or die($stid->error);
    $success = $stid->execute();
    if($success){
    header('Location: manage-sponsors.php');
    }
  }
  ?>
</div>
</body>
</html>
