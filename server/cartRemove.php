<?php
session_start();
include_once 'core.php';

// get values
$id = $_GET['id'] ?? null;

// redirect dashboard if acceseed indirectly
if ($id == null) {
  echo '
    <script>
    alert("Go to cart fists");
    window.location.href = "cart.php"; // Redirect to cart page
    </script>
    ';
}

// remove specific cart items
foreach ($_SESSION['cart'] as $key => $item) {
  if ($item['id'] == $id) {
    unset($_SESSION['cart'][$key]);
    break;
  }
}

// Re-index the array to maintain numeric keys 
$_SESSION['cart'] = array_values($_SESSION['cart']);

echo '
<script>
  alert("Menu item removed succesfully!");
  window.location.href = "cart.php";
</script>
';
