<?php
$host = 'localhost';
$user = 'mm';
$pass = "fQzsl56O2e3Xw1p";
$database = 'mobilemarket';

// establishing connection
  $conn = mysqli_connect($host,$user,$pass,$database);

 // for displaying an error msg in case the connection is not established
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>


