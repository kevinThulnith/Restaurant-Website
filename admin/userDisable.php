<?php
session_start();
include_once 'core.php';

// get values
$id = $_GET['id'] ?? null;

// redirect dashboard if acceseed indirectly
if ($id == null) {
  echo '
    <script>
    alert("Go to Customer fists");
    window.location.href = "customer.php"; // Redirect to your customer page
    </script>
    ';
}

// connect database
include_once '../php/DbConnect.php';

// get user to change is_active
$result = $conn->query("SELECT * FROM `user` WHERE `user_id` = $id;");
$user_status = mysqli_fetch_assoc($result)['is_active'];

if ($user_status) {
  $conn->query("UPDATE `user` SET `is_active` = '0' WHERE `user`.`user_id` = $id;");
  echo '
    <script>
    alert("User account disabled succesfully!");
    history.back(); // Redirect to previous page
    </script>
    ';
} else {
  $conn->query("UPDATE `user` SET `is_active` = '1' WHERE `user`.`user_id` = $id;");
  echo '
    <script>
    alert("User account enabled succesfully!");
    history.back(); // Redirect to previous page
    </script>
    ';
}
