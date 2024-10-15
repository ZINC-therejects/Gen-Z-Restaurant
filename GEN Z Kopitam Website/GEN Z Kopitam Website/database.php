<?php 

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "genz_database";
$conn = "";



mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dberror = "Could not connect to the database. ";
$dbconnect = "Connected yay";

try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
} 

catch (mysqli_sql_exception $e) {
      // Catch the exception and display a custom message
      echo $dberror;
      // Optionally, log the detailed error message for debugging purposes
      error_log($e->getMessage());
  }

?> 