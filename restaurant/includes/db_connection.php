<?php
  // 1. Create a database connection
  $dbhost = "localhost";
  $dbuser = "chuducty";
  $dbpass = "8997";
  $dbname = "online_res";
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  // Test if connection occurred.
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
  
?>