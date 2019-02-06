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
  <!-- form for filling out user info -->
<div class="container">
  <form class="form-horizontal" method="post" action="" id="form1">
     <fieldset>
       <ul>
               <div class="col-xs-offset-2 col-xs-10"><p><b>Please enter your information:</b></p></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">First Name:</label><div class="col-10"><input type="text" name="first_name" placeholder="first name" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Last Name:</label><div class="col-10"><input type="text" name="last_name" placeholder="last name" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Email:</label><div class="col-10"><input type="text" name="email" placeholder="email" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Password:</label><div class="col-10"><input type="password" name="password" placeholder="password" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="row form-check form-check-inline"><label for="name" class="col-form-label">&nbsp;&nbsp;&nbsp;Is Admin?:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="checkbox" id="checkbox" name="is_admin" value="0"/>
                   <?php
                     if(isset($_POST['is_admin'])){
                        $is_admin = 1;
                     }
                     else{
                        $is_admin = 0;
                     }
                   ?>
               </div>
               <div class="form-group row"><div class="col-2 col-form-label"><button name="Submit" type="submit" class="btn btn-primary">Submit</button></div></div>
       </ul>
       <br/>
     </fieldset>
   </form>


   <?php
   //if the form is submitted then call add user function to create user
     if (isset($_POST['Submit'])) {
       $first_name = $conn->real_escape_string($_POST['first_name']);
       $last_name = $conn->real_escape_string($_POST['last_name']);
       $email = $conn->real_escape_string($_POST['email']);
       $password = $conn->real_escape_string($_POST['password']);
         $stid=$conn->prepare("CALL add_user(?,?,?,?,?)");
         $stid->bind_param('ssiss', $email, $password, $is_admin, $first_name, $last_name) or die($stid->error);
         $stid->execute();
       }
   }


   ?>
 </div>
</body>
</html>
