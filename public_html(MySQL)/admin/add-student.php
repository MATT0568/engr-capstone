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
  <!-- form for filling out student info -->
  <div class="container">
    <form class="form-horizontal" method="post" action="" id="form1">
       <fieldset>
         <ul>
               <div class="col-xs-offset-2 col-xs-10"><p><b>Please enter student info:</b></p></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">First Name:</label><div class="col-sm-10"><input type="text" name="first_name" placeholder="John" step="any" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Last Name:</label><div class="col-sm-10"><input type="text" name="last_name" placeholder="Doe" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Email:</label><div class="col-sm-10"><input type="text" name="email" placeholder="johndoe@gmail.com" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Department:</label><div class="col-sm-10"><select name="department_id" aria-required="true" class="form-control" role="input" required>
                   <?php
                   $sql = 'SELECT * FROM DEPARTMENT';
                   $result = $conn->query($sql);
                    echo '<option label=" "></option>';
                    while ($row = $result->fetch_array())
                      {
                        echo "<option value=\"" . $row['DEPARTMENT_ID'] . "\">". $row['NAME'] . "</option>";
                      }
                  ?>
                </select></div></div>
               <div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Academic Year:</label><div class="col-sm-10"><input type="text" name="academic_year" placeholder="17/18" class="form-control" role="input" aria-required="true" required/></div></div>
               <div class="form-group row"><div class="col-sm-2 col-form-label"><button name="Submit" type="submit" class="btn btn-primary">Submit</button></div></div>
       </ul>
     </fieldset>
   </form>


   <?php
   // takes form data and inserts it into the database
     if (isset($_POST['Submit'])) {
       $department_id = $conn->real_escape_string($_POST['department_id']);
       $first_name = $conn->real_escape_string($_POST['first_name']);
       $last_name = $conn->real_escape_string($_POST['last_name']);
       $email = $conn->real_escape_string($_POST['email']);
       $academic_year = $conn->real_escape_string($_POST['academic_year']);
       $stid=$conn->prepare("INSERT INTO STUDENT(department_id, academic_year, first_name, last_name, email) VALUES (?,?,?,?,?)");
       $stid->bind_param('issss', $department_id, $academic_year, $first_name, $last_name, $email);
       $stid->execute();
     }
   ?>
</div>
</body>
</html>
