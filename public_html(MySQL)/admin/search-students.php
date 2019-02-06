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

<!-- form for filtering students -->
<div class="container">
  <div style="width:60%">
  <form class="form-horizontal" method="post" action="" id="form1">
     <fieldset>
       <ul>
               <div class="col-xs-offset-1 col-xs-10"><p><b>Please enter student filters:</b></p></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Department:</label><div class="col-7"><select name="department_id" aria-required="true" class="form-control" role="input">
                   <?php
                     $sql = 'SELECT * FROM DEPARTMENT';
                     $result = $conn->query($sql);
                     echo '<option label=" "></option>';
                     while ($row = $result->fetch_array()){
                       echo "<option value=\"" . $row['DEPARTMENT_ID'] . "\">". $row['NAME'] . "</option>";
                     }
                   ?>
               </select></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Academic Year:</label><div class="col-7"><select name="year" aria-required="true" class="form-control" role="input">
                   <?php
                     $sql = 'SELECT DISTINCT ACADEMIC_YEAR FROM STUDENT';
                     $result = $conn->query($sql);
                     echo '<option label=" "></option>';
                     while ($row = $result->fetch_array()){
                       echo "<option value=\"" . $row['ACADEMIC_YEAR'] . "\">". $row['ACADEMIC_YEAR'] . "</option>";
                     }
                   ?>
               </select></div></div>
              <div class="form-group"><div class="col-xs-offset-2 col-xs-10"><button name="Search" type="submit" class="btn btn-primary">Submit</button></div></div>
       </ul>
       <br/>
     </fieldset>
   </form>
 </div>
   <div style="width:100%">
     <table class="table table-striped" table style="margin-left:30px">
   <?php
     if (isset($_POST['Search'])) {
       //displays selected students in table and gives links to students assigned project, an edit student page, and picking a project for the student
       echo "<thead><tr><th>Email</th><th>First Name</th><th>Last Name</th><th>Project</th></thead>";
       echo "<tbody>";
       if (!empty($_POST['department_id'])){
          $department_id = $conn->real_escape_string($_POST['department_id']);
       }
       if (!empty($_POST['year'])){
          $year = $conn->real_escape_string($_POST['year']);
       }
       $query = 'SELECT * from STUDENT where 1=1';
       if (!empty($_POST['year'])){$query = $query . " and academic_year = '".$year."'";}
       if (!empty($_POST['department_id'])){ $query = $query . " and department_id = '".$department_id."'";}
       $result = $conn->query($query);
       while ($row = $result->fetch_array()) {
         if (!empty($row["PROJECT_ID"])){
           $query2 = 'SELECT * from PROJECT_INFO where STUDENT_ID = '.$row["STUDENT_ID"].'';
           $result2 = $conn->query($query2);
           $row2 = $result2->fetch_array();
           $project = '<a href="edit-project.php?id=' . $row['PROJECT_ID'] . '"style="color: #00cc1b">' . $row2["PROJECT_NAME"] . '</a>';
         }
         else {
           $project = 'unassigned';
         }
         print '<tr>';
         print '<td>' . $row["EMAIL"] . '</td><td>' . $row["FIRST_NAME"] . '</td><td>' . $row["LAST_NAME"] . '</td><td>' . $project . '</td><td><a href="edit-student.php?id=' . $row['STUDENT_ID'] . '">View/Edit</a></td>' . '</td><td><a href="pick-project.php?id=' . $row['STUDENT_ID'] . '">Pick Project</a></td>';
         print '</tr>';
       }
     }
        ?>
      </tbody>
      </table>
    </div>
      </div>
</body>
</html>
