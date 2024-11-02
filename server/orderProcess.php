<?php
session_start();
include_once 'core.php';

// Check if the cart is set and not empty
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
  // Define the total variable
  $total = 0;

  // Calculate the total of the order
  foreach ($_SESSION['cart'] as $item) {
    $subtotal = $item['price'] * $item['amm'];
    $total += $subtotal;
  }

  // get user id to set resavation
  $user_data = json_decode($_COOKIE['user_data'], true);
  $user_id = $user_data['user_id'];

  require_once '../php/DbConnect.php';

  $result = $conn->query("INSERT INTO `orders` (`customer`, `time_stamp`, `total`) VALUES ( $user_id, current_timestamp(), '$total');");
  $order_id = $conn->insert_id;
  $conn->close();

  $conn2 = mysqli_connect("localhost", "root", "", "cafe");
  foreach ($_SESSION['cart'] as $item) {
    $conn2->query("INSERT INTO `order_items` (`menu_item`, `amount`, `order_id`) VALUES (" . $item['id'] . ", " . $item['amm'] . ", $order_id);");
  }
  $conn2->close();

  unset($_SESSION['cart']);
  echo '
    <script>
      alert("Order added succesfully!");
      window.location.href = "cart.php";
    </script>
';
} else echo '<script>alert("Your cart is empty."); window.location.href = "cart.php";</script>';
