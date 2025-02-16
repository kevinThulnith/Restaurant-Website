<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - View Order Details</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <nav>
    <a href="home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="orders.php">My Orders</a></li>
        <li><a href="" class="active" onclick="disableLink(event)">View Order</a></li>
        <li class="user" id="user">
          <div class="circle"></div>
          <i class="fa fa-user"></i>
          <?php require_once '../php/exclamation.php' ?>
        </li>
      </ul>
      <div id="userbar">
        <?php require_once '../php/userbar.php' ?>
        <a href="#" id="asd"><i class="fa-solid fa-xmark"></i></a>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <?php top("My Orders", "View Order Details") ?>

  <?php
  // get values
  $id = $_GET['id'] ?? null;

  // redirect to orders if acceseed indirectly
  if ($id == null) echo '<script>alert("Go to Orders fists");window.location.href = "orders.php"; </script>';

  // connect database
  include_once '../php/DbConnect.php';

  // get order
  $result = mysqli_query($conn, "SELECT orders.*, COUNT(order_items.menu_item) as item_types, SUM(order_items.amount) as amount FROM orders, order_items WHERE orders.order_id = $id AND order_items.order_id = orders.order_id;");
  $order = mysqli_fetch_assoc($result);
  ?>

  <div class="order-intel">
    <h1>Order Details</h1>
    <div class="forum">
      <div class="line">
        <div class="name">Date / Time</div>
        <div class="value"><?php echo $order["time_stamp"] ?></div>
      </div>
      <div class="line">
        <div class="name">Order Status</div>
        <div class="value"><?php echo $order["status"] ?></div>
      </div>
      <div class="line">
        <div class="name">Order type</div>
        <div class="value"><?php echo $order["type"] ?></div>
      </div>
      <div class="line">
        <div class="name">Menu Items</div>
        <div class="value"><?php echo $order["item_types"] ?></div>
      </div>
      <div class="line">
        <div class="name">Amount</div>
        <div class="value"><?php echo $order["amount"] ?></div>
      </div>
      <div class="line">
        <div class="name">Total</div>
        <div class="value">Rs. <?php echo number_format($order["total"], 2)  ?></div>
      </div>
    </div>
    <h1>Selected menu items</h1>
    <div class="menu-items">
      <?php
      $result1 = $conn->query("SELECT food.*, order_items.* FROM order_items, food WHERE order_items.order_id = $id AND order_items.menu_item = food.food_Id;");
      while ($row = $result1->fetch_assoc()) {
        $imageData = $row["image"];

        // Determine the image type
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $imageType = $finfo->buffer($imageData);

        // Encode the image data to base64
        $base64Image = base64_encode($imageData);

        // calculate subtotal
        $subtot = floatval($row['price']) * floatval($row['amount']);

        echo "<div class='item'>
                <div
                  class='img'
                  style='background-image: url(data:$imageType;base64,$base64Image)'></div>
                <div class='text'>
                  <div class='name'>" . $row['name'] . "</div>
                  <div class='price'>Rs" . number_format($row['price'], 2) . "</div>
                  <div class='amount'>x" . $row['amount'] . "</div>
                  <div class='sub-total'>Rs. " . number_format($subtot, 2) . "</div>
                </div>
              </div>";
      }
      ?>
    </div>
  </div>

  <?php require '../php/feature.php' ?>
</body>

</html>