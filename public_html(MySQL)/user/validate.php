<?php
  session_start();

  if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
  }
 ?>

<link rel="stylesheet" href="../css/styles.css">
