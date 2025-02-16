<?php
if (!isset($_SESSION['username'])) {
  echo "<li><a href='login.php'>Login</a></li>
        <li><a href='singUp.php'>Sing Up</a></li>
        <li><a href='resetPassword.php'>Reset password</a></li>";
} else {
  if (isset($_COOKIE['user_data'])) {
    // Decode the JSON string back to an array
    $user_data = json_decode($_COOKIE['user_data'], true);
    $name = $user_data['name'];
    $is_admin = $user_data['is_admin'];
    echo "<h4>Hey $name,</h4>";
    if ($user_data['is_admin']) {
      echo "
      <li><a href='newUser.php'>Add User Account</a></li>
      <li><a href='tableTypes.php'>Table Types</a></li>
      <li><a href='foodType.php'>Food Types</a></li>
      <li><a href='editProfile.php'>Edit Profile</a></li>
      <li><a href='staff.php'>Staff</a></li>
      <li><a href='../server/logout.php'>Logout</a></li>
          ";
    } else if ($user_data['is_staff']) {
      echo "
      <li><a href='menu.php'>Take Order</a></li>
      <li><a href='editProfile.php'>Edit Profile</a></li>
      <li><a href='../server/logout.php'>Logout</a></li>
          ";
    } else {
      echo "
      <li><a href='myReservations.php'>My Reservations</a></li>
      <li><a href='reservation.php'>Reservations</a></li>
      <li><a href='editProfile.php'>Edit Profile</a></li>
      <li><a href='orders.php'>My Orders</a></li>      
      <li><a href='cart.php'>My Cart</a></li>
      <li><a href='logout.php'>Logout</a></li>
          ";
    }
  }
}
