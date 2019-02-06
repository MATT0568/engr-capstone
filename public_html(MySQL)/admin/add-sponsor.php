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
  <!-- form for filling out contact info -->
<div class="container">
  <form method="post" action="" id="form1">
     <fieldset>
       <ul>
               <div class="col-xs-offset-2 col-xs-10"><p><b>Please enter sponsor info:</b></p></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Organization:</label><div class="col-10"><input type="text" name="organization" placeholder="organization" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Address:</label><div class="col-10"><input type="text" name="address" placeholder="address" step="any" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">City:</label><div class="col-10"><input type="text" name="city" placeholder="city" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">State:</label><div class="col-10"><input type="text" name="state" placeholder="state" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">ZIP Code:</label><div class="col-10"><input type="number" name="zip" placeholder="zip" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Sponsor Type:</label><div class="col-10"><input type="text" name="sponsor_type" placeholder="One time/Normal" class="form-control" role="input" aria-required="true"/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Partner Type:</label><div class="col-10"><input type="text" name="partner_type" placeholder="partner type" class="form-control" role="input" aria-required="true"/></div></div>
               <div class="row form-check form-check-inline"><label for="name" class="col-form-label">&nbsp;&nbsp;&nbsp;Strategic?:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="checkbox" id="checkbox" name="checkbox" value="0"/>
                   <?php
                     if(isset($_POST['checkbox'])){
                        $is_strategic = 1;
                     }
                     else{
                        $is_strategic = 0;
                     }
                   ?>
               </div>
               <div class="form-group row"><div class="col-2 col-form-label"><button name="Submit" type="submit" class="btn btn-primary">Submit</button></div></div>
       </ul>
       <br/>
     </fieldset>
   </form>


  <?php
  // takes form data and inserts it into the database
    if (isset($_POST['Submit'])) {
      $organization = $conn->real_escape_string($_POST['organization']);
      $address = $conn->real_escape_string($_POST['address']);
      $city = $conn->real_escape_string($_POST['city']);
      $state = $conn->real_escape_string($_POST['state']);
      $zip = intval($_POST['zip']);
      $sponsor_type = $conn->real_escape_string($_POST['sponsor_type']);
      $partner_type = $conn->real_escape_string($_POST['partner_type']);
      $stid=$conn->prepare("INSERT INTO SPONSOR(organization, address, city, state, zip, sponsor_type, partner_type, is_strategic) VALUES (?,?,?,?,?,?,?,?)");
      $stid->bind_param('ssssissi', $organization, $address, $city, $state, $zip, $sponsor_type, $partner_type, $is_strategic) or die($stid->error);
      $stid->execute();
      $stid->fetch();
      if ($stmt->error){
        echo "Error";
      }
      else{
        header('Location: manage-sponsors.php');
      }
    }
  ?>
</div>
</body>
</html>
