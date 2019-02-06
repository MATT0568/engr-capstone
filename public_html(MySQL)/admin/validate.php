<?php
// include this in each page so it checks to see if it is a valid session and if it is an admin
  session_start();

  if (!isset($_SESSION['IS_ADMIN']) || $_SESSION['IS_ADMIN'] === 'N'){
    header('Location: ../index.php');
  }
 ?>

 <link rel="stylesheet" href="../css/styles.css">
