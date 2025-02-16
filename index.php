<?php
require_once 'php/https.php';
session_start();

// check user if logged in or an admin
if (isset($_SESSION['username'])) {

  // Decode the JSON string back to an array
  $user_data = json_decode($_COOKIE['user_data'], true);
  $name = $user_data['name'];
  $is_admin = $user_data['is_admin'];

  // if admin loggs in
  if ($user_data['is_admin']) header("Location: admin/dashboard.php");

  // if staff loggs in
  else if ($user_data['is_staff']) header("Location: staff/dashboard.php");

  // if customer logs in
  else header("Location: server/home.php");
} else {
  $_SESSION['logged_in'] = false;
  header("Location: server/home.php");
}
