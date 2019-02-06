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
    // gets values from database for selected contact
    $contact_id = $_GET['contact_id'];
    $sponsor_id = $_GET['sid'];
    $query = "SELECT * from CONTACT where contact_id = '$contact_id'";
    $result = $conn->query($query);
    $row = $result->fetch_array();
    $p_organization_id = $row['SPONSOR_ID'];
    $p_first_name = $row['FIRST_NAME'];
    $p_last_name = $row['LAST_NAME'];
    $p_email = $row['EMAIL'];
    $p_phone = $row['PHONE'];
    $p_title = $row['TITLE'];
  ?>
  <!-- form for editing contact info -->
  <form class="form-horizontal" method="post" action="" id="form1">
     <fieldset>
       <ul>
               <div class="col-xs-offset-2 col-xs-10"><p><b>Please edit your Contact details:</b></p></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Sponsor:</label><div class="col-10"><select name="organization_id" aria-required="true" class="form-control" role="input" value="2">
                   <?php
                    $sql = 'SELECT * FROM SPONSOR';
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_array())
                      {
                        if ($row['ORGANIZATION'] === $p_organization_id){
                          echo "<option value=\"" . $row['SPONSOR_ID'] . "\" selected >". $row['ORGANIZATION'] . "</option>";
                        }
                        else {
                          echo "<option value=\"" . $row['SPONSOR_ID'] . "\">". $row['ORGANIZATION'] . "</option>";
                        }
                      }
                  ?>
               </select></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">First Name:</label><div class="col-10"><input type="text" name="first_name" step="any" class="form-control" role="input" aria-required="true" value="<?php print $p_first_name; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Last Name:</label><div class="col-10"><input type="text" name="last_name" class="form-control" role="input" aria-required="true" value="<?php print $p_last_name; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Email:</label><div class="col-10"><input type="text" name="email" class="form-control" role="input" aria-required="true" value="<?php print $p_email; ?>" required/></div></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Phone Number:</label><div class="col-sm-10"><input type="number" name="phone" placeholder="8041234567" class="form-control" role="input" aria-required="true" value="<?php print $p_phone; ?>"/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Title:</label><div class="col-10"><input type="text" name="title" class="form-control" role="input" aria-required="true" value="<?php print $p_title; ?>"/></div></div>
               <div class="form-group"><div class="col-xs-offset-2 col-xs-10"><button name="Submit" type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;<button name="Delete" type="submit" class="btn btn-primary">Delete</button></div></div>
       </ul>
       <br/>
     </fieldset>
   </form>


  <?php
    if (isset($_POST['Submit'])) {
      // Insert into database using values supplied by user
      $organization_id = $conn->real_escape_string($_POST['organization_id']);
      $first_name = $conn->real_escape_string($_POST['first_name']);
      $last_name = $conn->real_escape_string($_POST['last_name']);
      $email = $conn->real_escape_string($_POST['email']);
      $phone = intval($_POST['phone']);
      $title = $conn->real_escape_string($_POST['title']);
      $stid=$conn->prepare("UPDATE CONTACT SET sponsor_id = ?, first_name = ?, last_name = ?, email = ?, phone = ?, title = ? WHERE contact_id = ?");
      $stid->bind_param('isssisi', $organization_id, $first_name, $last_name, $email, $phone, $title, $contact_id) or die($stid->error);
      if ($stid->execute()){
        ob_start();
        echo "<script>document.location.href='view-contacts.php?id=$sponsor_id'</script>";
        ob_end_flush();
      }
      else{
        echo "Error";
      }
    }

  if (isset($_POST['Delete'])){
    // delete selected contact from database
    $stid=$conn->prepare("DELETE FROM CONTACT WHERE contact_id = ?");
    $stid->bind_param('i', $contact_id) or die($stid->error);
    $success = $stid->execute();
    if($success){
      ob_start();
      echo "<script>document.location.href='view-contacts.php?id=$sponsor_id'</script>";
      ob_end_flush();
    }
  }


  ?>
</div>
</body>
</html>
