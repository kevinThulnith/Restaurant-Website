<?php
// logout
setcookie('user_data', "", time() - (86400 * 30), "/"); // unsset user cockie
session_start();
session_destroy();
header('Location: ../index.php');
exit();
