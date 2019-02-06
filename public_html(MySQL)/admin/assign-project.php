<?php
  //takes selected student id and project id and sets the students project_id to the seleced project_id 
  include('../connect.php');
  $project_id = $_GET['id1'];
  $student_id = $_GET['id2'];

  $stid=$conn->prepare("UPDATE STUDENT SET project_id = ? WHERE student_id = ?");
  $stid->bind_param('ii', $project_id, $student_id) or die($stid->error);
  $stid->execute();
  $stid->fetch();
  ob_start();
  echo "<script>document.location.href='search-students.php'</script>";
  ob_end_flush();
?>
