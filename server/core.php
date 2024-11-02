<?php
// redirect to login if user not logged iv
if (!isset($_SESSION['username'])) echo '<script>alert("Login to use this feature");window.location.href = "login.php";</script>';
