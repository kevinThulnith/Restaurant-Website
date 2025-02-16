<?php
session_start();
include_once 'core.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['item_id'];
  $name = $_POST['item_name'];
  $amm = $_POST['num_of_itms'];
  $price = $_POST['item_price'];

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  $itemFound = false;
  foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $id) {
      $item['amm'] += $amm;
      $itemFound = true;
      break;
    }
  }

  if (!$itemFound) {
    $_SESSION['cart'][] = [
      'id' => $id,
      'name' => $name,
      'amm' => $amm,
      'price' => $price
    ];
  }
} else {
  echo '
  <script>
    alert("Go to menu first");
    window.location.href = "menu.php"; // redirect to menu
  </script>';
}
