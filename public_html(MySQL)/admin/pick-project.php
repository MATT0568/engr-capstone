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
  <!-- gets the selected student -->
  <?php $student_id = $_GET['id'];?>

<!-- form to filter projects for selection -->
<div class="container">
  <div style="width:60%">
  <form class="form-horizontal" method="post" action="" id="form1">
     <fieldset>
       <ul>
               <div class="col-xs-offset-1 col-xs-10"><p><b>Please enter project filters:</b></p></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Sponsor:</label><div class="col-7"><select name="sponsor_id" aria-required="true" class="form-control" role="input">
                   <?php
                     $sql = 'SELECT * FROM SPONSOR';
                     $result = $conn->query($sql);
                     echo '<option label=" "></option>';
                     while ($row = $result->fetch_array()){
                       echo "<option value=\"" . $row['SPONSOR_ID'] . "\">". $row['ORGANIZATION'] . "</option>";
                     }
                   ?>
               </select></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Status:</label><div class="col-7"><select name="status_id" aria-required="true" class="form-control" role="input">
                  <?php
                    $sql = 'SELECT * FROM STATUS';
                    $result = $conn->query($sql);
                    echo '<option label=" "></option>';
                    while ($row = $result->fetch_array()){
                      echo "<option value=\"" . $row['STATUS_ID'] . "\">". $row['PROJECT_STATUS'] . "</option>";
                    }
                  ?>
              </select></div></div>
               <div class="form-group"><div class="col-xs-offset-10 col-xs-10"><button name="Search" type="submit" class="btn btn-primary">Submit</button></div></div>
           </ul>
           <br/>
           </fieldset>
           </form>
           </div>

   <div style="width:65%">
     <table class="table table-striped" table style="margin-left:30px">
   <?php
     if (isset($_POST['Search'])) {
       // collects students department and year as aditional filters
       echo "<thead><tr><th>Project Name</th><th>Sponsor</th><th>Year</th></thead>";
       echo "<tbody>";
       $sql = 'SELECT * FROM STUDENT WHERE STUDENT_ID='.$student_id.'';
       $result = $conn->query($sql);
       $row = $result->fetch_array();
       $department = $row['DEPARTMENT_ID'];
       $year = $row['ACADEMIC_YEAR'];
       if (!empty($_POST['sponsor_id'])){
          $sponsor = $conn->real_escape_string($_POST['sponsor_id']);

       }
       if (!empty($_POST['status_id'])){
          $status = $conn->real_escape_string($_POST['status_id']);
       }
       // run query on project_info view to find and display projects that fit the filters
       $query = 'SELECT * FROM PROJECT_INFO WHERE 1=1';
       $query = $query . " and year = '".$year."'";
       $query = $query . " and department_id = '".$department."'";
       if (!empty($_POST['sponsor_id'])){$query = $query . " and sponsor_id = '".$sponsor."'";}
       if (!empty($_POST['status_id'])){ $query = $query . " and status_id = '".$status."'";}
       $result = $conn->query($query);
       while ($row = $result->fetch_array()) {
         print '<tr>';
         print '<td>' . $row["PROJECT_NAME"] . '</td><td>' . $row["SPONSOR"] . '</td><td>' . $row["YEAR"] . '</td><td><a href="assign-project.php?id1=' . $row['PROJECT_ID'] . '&id2=' . $student_id . '">Assign Project</a></td>';
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
