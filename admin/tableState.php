<?php
session_start();
include_once 'core.php';

// get values
$id = $_GET['id'] ?? null;

// redirect dashboard if acceseed indirectly
if ($id != null) {
  // connect database
  include_once '../php/DbConnect.php';

  // get table to change state
  $result = $conn->query("SELECT * FROM `rstrnt_table` WHERE `table_id` = $id;");
  $table_state = mysqli_fetch_assoc($result)['table state'];

  // change state
  if ($table_state == 'free') {
    $conn->query("UPDATE `rstrnt_table` SET `table state` = 'in use' WHERE `rstrnt_table`.`table_id` = $id;");
    echo '<script>alert("Table state updated succesfully!");history.back()</script>';
  } else {
    echo '<script>alert("Table already in use");history.back()</script>';
  }
} else echo '<script>alert("Select reservation fist");window.location.href = "resavation.php"; </script>';
// Redirect to reservations