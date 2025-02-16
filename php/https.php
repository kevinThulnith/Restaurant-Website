<?php
// Add security headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");

// Force HTTPS in PHP
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
  header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}
