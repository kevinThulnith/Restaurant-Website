<?php
// allow acces only for employees
if (isset($_SESSION['username'])) {

  // Decode the JSON string back to an array
  $user_data = json_decode($_COOKIE['user_data'], true);
  $name = $user_data['name'];
  $is_Staff = $user_data['is_staff'];

  // Redirect to login page
  if (!$is_Staff) echo '<script type="text/javascript">alert("Unauthorized access denied.");window.location.href = "../server/home.php"; </script>';
} else echo '<script type="text/javascript">alert("Unauthorized access denied.");window.location.href = "../server/login.php"; </script>';
