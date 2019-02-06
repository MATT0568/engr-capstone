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
    <form class="form-horizontal" method="post" action="" id="form1">
       <fieldset>
         <ul>
               <div class="col-xs-offset-2 col-xs-10"><p><b>Please enter contact info:</b></p></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">First Name:</label><div class="col-sm-10"><input type="text" name="first_name" placeholder="John" step="any" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Last Name:</label><div class="col-sm-10"><input type="text" name="last_name" placeholder="Doe" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Email:</label><div class="col-sm-10"><input type="text" name="email" placeholder="johndoe@gmail.com" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Phone Number:</label><div class="col-sm-10"><input type="number" name="phone" placeholder="8041234567" class="form-control" role="input" aria-required="true"/></div></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Title:</label><div class="col-sm-10"><input type="text" name="title" placeholder="worker" class="form-control" role="input" aria-required="true"/></div></div>
               <div class="form-group row"><div class="col-sm-2 col-form-label"><button name="Submit" type="submit" class="btn btn-primary">Submit</button></div></div>
       </ul>
     </fieldset>
   </form>


  <?php
  // takes form data and inserts it into the database
    if (isset($_POST['Submit'])) {
      $sponsor_id = $_GET['id'];
      $first_name = $conn->real_escape_string($_POST['first_name']);
      $last_name = $conn->real_escape_string($_POST['last_name']);
      $email = $conn->real_escape_string($_POST['email']);
      $email = intval($_POST['phone']);
      $title = $conn->real_escape_string($_POST['title']);
      $stid=$conn->prepare("INSERT INTO CONTACT(sponsor_id, first_name, last_name, email, phone, title) VALUES (?,?,?,?,?,?)");
      $stid->bind_param('isssis', $sponsor_id, $first_name, $last_name, $email, $phone, $title) or die($stid->error);
      $stid->execute();
      $stid->fetch();
      if ($stmt->error){
        echo "Error";
      }
      else{
        ob_start();
        echo "<script>document.location.href='view-contacts.php?id=$sponsor_id'</script>";
        ob_end_flush();
      }
    }
  ?>
</div>
</body>
</html>
