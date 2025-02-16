<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - resavation Details</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="resavation.php">Reservations</a></li>
        <li><a href="" class="active" onclick="disableLink(event)">View Reservation</a></li>
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

  <?php topAdmin("Reservations", "View Reservation Details") ?>

  <?php
  // get values
  $id = $_GET['id'] ?? null;

  // redirect to orders if acceseed indirectly
  if ($id == null) echo '<script>alert("Go to Orders fists");window.location.href = "orders.php"; </script>';

  // connect database
  include_once '../php/DbConnect.php';

  // get order
  $result = mysqli_query($conn, "SELECT 
                                  reservation.*, 
                                  user.name as customer, 
                                  `table types`.`type_name`, 
                                  COUNT(resavation_table.resavation) as tbls 
                                FROM reservation 
                                JOIN user ON user.user_id = reservation.user 
                                JOIN `table types` ON reservation.resavaton_type = `table types`.`type_id` 
                                LEFT JOIN resavation_table ON resavation_table.resavation = reservation.reservation_id 
                                WHERE reservation_id = $id;");
  $order = mysqli_fetch_assoc($result);
  ?>

  <div class="order-intel">
    <h1>Order Details</h1>
    <div class="forum">
      <div class="line">
        <div class="name">Customer</div>
        <div class="value"><?php echo $order["customer"] ?></div>
      </div>
      <div class="line">
        <div class="name">Time Stamp</div>
        <div class="value"><?php echo $order["created_time"] ?></div>
      </div>
      <div class="line">
        <div class="name">Date / Time</div>
        <div class="value"><?php echo $order["date"] . " | " . $order["time"] ?></div>
      </div>
      <div class="line">
        <div class="name">Party</div>
        <div class="value"><?php echo $order["number_of_people"] ?></div>
      </div>
      <div class="line">
        <div class="name">Reservation Type</div>
        <div class="value"><?php echo $order["type_name"] ?></div>
      </div>
      <div class="line">
        <div class="name">Number of Tables</div>
        <div class="value"><?php echo $order["tbls"] ?></div>
      </div>
      <div class="line">
        <div class="name">Reservation Status</div>
        <div class="value"><?php echo $order["status"] ?></div>
      </div>
    </div>
    <h1>Selected menu items</h1>
    <div class="menu-items">
      <?php
      $result1 = $conn->query("SELECT resavation_table.*, rstrnt_table.* FROM resavation_table, rstrnt_table WHERE resavation_table.resavation = $id AND resavation_table.reserved_table = rstrnt_table.table_id;");
      while ($row = $result1->fetch_assoc()) {
        echo "<div class='room'>
              <div class='name'>" . $row['table_no'] . "</div>
              <a href=tableState.php?id=" . $row['table_id'] . ">" . $row['table state'] . "..</a>
            </div>";
      }
      ?>
    </div>
  </div>

  <?php require '../php/feature.php' ?>
</body>

</html>