<?php
// Force HTTPS in PHP
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
  header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit;
}
