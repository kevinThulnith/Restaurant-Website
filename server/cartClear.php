<?php
session_start();
include_once 'core.php';
if (isset($_SESSION['cart'])) unset($_SESSION['cart']); // Clear the cart
echo '
<script>
  alert("Cart has been clered succesfully!");
  window.location.href = "cart.php";
</script>
';
