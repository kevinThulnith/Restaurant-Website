<?php
session_start();
include_once 'core.php';

// Check if the cart is set and not empty
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
  if (isset($_SESSION['orderId'])) {
    // Define the total variable
    $total = 0;

    // Calculate the total of the order
    foreach ($_SESSION['cart'] as $item) {
      $subtotal = $item['price'] * $item['amm'];
      $total += $subtotal;
    }

    require_once '../php/DbConnect.php';
    $conn->query("UPDATE `orders` SET `total` = $total WHERE `orders`.`order_id` = " . $_SESSION['orderId'] . ";");

    foreach ($_SESSION['cart'] as $item) {
      $conn->query("INSERT INTO `order_items` (`menu_item`, `amount`, `order_id`) VALUES (" . $item['id'] . ", " . $item['amm'] . ", " . $_SESSION['orderId'] . " );");
    }

    unset($_SESSION['cart']);
    unset($_SESSION['orderId']);
    echo '
      <script>
        alert("Order added succesfully!");
        window.location.href = "cart.php";
      </script>
  ';

    echo $_SESSION['orderId'];
  } else echo '<script>alert("No table selected."); window.location.href = "cart.php";</script>';
} else {
  echo '<script>alert("Your cart is empty."); window.location.href = "cart.php";</script>';
}
