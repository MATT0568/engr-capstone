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
  <?php $exporthref = "export-data.php"; ?>
<!-- form to filter projects -->
<div class="container">
  <div style="width:60%">
  <form class="form-horizontal" method="post" action="" id="form1">
     <fieldset>
       <ul>
               <div class="col-xs-offset-1 col-xs-10"><p><b>Please enter project filters:</b></p></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Sponsor:</label><div class="col-8"><select name="sponsor_id" aria-required="true" class="form-control" role="input">
                   <?php
                     $sql = 'SELECT * FROM SPONSOR';
                     $result = $conn->query($sql);
                     echo '<option label=" "></option>';
                     while ($row = $result->fetch_array()){
                       echo "<option value=\"" . $row['SPONSOR_ID'] . "\">". $row['ORGANIZATION'] . "</option>";
                     }
                   ?>
               </select></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Department:</label><div class="col-8"><select name="department_id" aria-required="true" class="form-control" role="input">
                   <?php
                     $sql = 'SELECT * FROM DEPARTMENT';
                     $result = $conn->query($sql);
                     echo '<option label=" "></option>';
                     while ($row = $result->fetch_array()){
                       echo "<option value=\"" . $row['DEPARTMENT_ID'] . "\">". $row['NAME'] . "</option>";
                     }
                   ?>
               </select></div></div>
               <div class="form-group row"><label for="name" class="col-2 col-form-label">Status:</label><div class="col-8"><select name="status_id" aria-required="true" class="form-control" role="input">
                  <?php
                    $sql = 'SELECT * FROM STATUS';
                    $result = $conn->query($sql);
                    echo '<option label=" "></option>';
                    while ($row = $result->fetch_array()){
                      echo "<option value=\"" . $row['STATUS_ID'] . "\">". $row['PROJECT_STATUS'] . "</option>";
                    }
                  ?>
              </select></div></div>
              <div class="form-group row"><label for="name" class="col-2 col-form-label">Academic Year:</label><div class="col-8"><select name="year" aria-required="true" class="form-control" role="input">
                  <?php
                    $sql = 'SELECT DISTINCT YEAR FROM PROJECT';
                    $result = $conn->query($sql);
                    echo '<option label=" "></option>';
                    while ($row = $result->fetch_array()){
                      echo "<option value=\"" . $row['YEAR'] . "\">". $row['YEAR'] . "</option>";
                    }
                  ?>
              </select></div></div>
               <!-- button allows exportation of selected projects data to csv -->
               <div class="form-group"><div class="col-xs-offset-10 col-xs-10"><button name="Search" type="submit" class="btn btn-primary">Submit</button> <div onclick="generateCSV()" class="btn btn-success">Export Projects</div></div></div>
             </ul>
            <br/>
          </fieldset>
        </form>

      </div>

   <!-- table displays filtered projects -->
   <div style="width:65%">
     <table class="table table-striped" table style="margin-left:30px">
       <?php
         if (isset($_POST['Search'])) {
           echo "<thead><tr><th>Project Number</th><th>Project Name</th><th>Sponsor</th><th>Year</th></thead>";
           echo "<tbody>";
           if (!empty($_POST['year'])){
              $year = $conn->real_escape_string($_POST['year']);
              $exporthref = $exporthref . "?id1=".$year."";
           }
           if (!empty($_POST['sponsor_id'])){
              $sponsor = $conn->real_escape_string($_POST['sponsor_id']);
              if(empty($_POST['year'])){
                $exporthref = $exporthref . "?id2=".$sponsor."";
              }
              else{
                $exporthref = $exporthref . "&id2=".$sponsor."";
              }
           }
           if (!empty($_POST['department_id'])){
              $department = $conn->real_escape_string($_POST['department_id']);
              if(empty($_POST['year']) && empty($_POST['sponsor_id'])){
                $exporthref = $exporthref . "?id3=".$department."";
              }
              else{
                $exporthref = $exporthref . "&id3=".$department."";
              }
           }
           if (!empty($_POST['status_id'])){
              $status = $conn->real_escape_string($_POST['status_id']);
              if(empty($_POST['year']) && empty($_POST['sponsor_id']) && empty($_POST['department_id'])){
                $exporthref = $exporthref . "?id4=".$status."";
              }
              else{
                $exporthref = $exporthref . "&id4=".$status."";
              }
           }
           $query = 'SELECT * FROM PROJECT_INFO WHERE 1=1';
           if (!empty($_POST['year'])){$query = $query . " and year = '".$year."'";}
           if (!empty($_POST['sponsor_id'])){$query = $query . " and sponsor_id = '".$sponsor."'";}
           if (!empty($_POST['department_id'])){ $query = $query . " and department_id = '".$department."'";}
           if (!empty($_POST['status_id'])){ $query = $query . " and status_id = '".$status."'";}
           $result = $conn->query($query);
           while ($row = $result->fetch_array()) {
             print '<tr>';
             print '<td>' . $row["PROJECT_NUMBER"] . '</td><td>' . $row["PROJECT_NAME"] . '</td><td>' . $row["SPONSOR"] . '</td><td>' . $row["YEAR"] . '</td><td><a href="edit-project.php?id=' . $row['PROJECT_ID'] . '">View/Edit</a></td>';
             print '</tr>';
           }
         }
        ?>
      </tbody>
      </table>
    </div>
 </div>
<!-- creates link with filters to export project -->
<script type="text/javascript">
  function generateCSV() {
      window.location.href = '<?php echo $exporthref ?>';
  }

</script>
</body>
</html>
