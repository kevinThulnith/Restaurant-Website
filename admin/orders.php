<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Orders</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <?php navigationAdmin(6) ?>
        <li class="user" id="user">
          <div class="circle"></div>
          <i class="fa fa-user"></i>
        </li>
      </ul>
      <div id="userbar">
        <?php require_once '../php/userbar.php' ?>
        <a href="#" id="asd"><i class="fa-solid fa-xmark"></i></a>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <?php topAdmin("Orders", "Manage Orders") ?>
  <?php
  // get values
  $id = $_GET['id'] ?? null;
  $mde = $_GET['mde'] ?? null;

  if ($id != null || $mde != null) {
    // connect database
    include_once '../php/DbConnect.php';

    // get reservation to change status
    $result = $conn->query("SELECT * FROM `orders` WHERE `order_id` = $id;");
    $order_sstate = mysqli_fetch_assoc($result)['status'];

    if ($order_sstate == 'pending' && $mde == 'nrml') {
      $conn->query("UPDATE `orders` SET `status` = 'ready to pickup' WHERE `orders`.`order_id` = $id;");
      echo '<script>alert("Order state updated succesfully!");</script>';
    } else if ($order_sstate == 'ready to pickup' && $mde == 'nrml') {
      $conn->query("UPDATE `orders` SET `status` = 'completed' WHERE `orders`.`order_id` = $id;");
      echo '<script>alert("Order state updated succesfully!");</script>';
    } else if ($order_sstate == 'pending' && $mde = 'cncl') {
      $conn->query("UPDATE `orders` SET `status` = 'cancelled' WHERE `orders`.`order_id` = $id;");
      echo '<script>alert("Order state updated succesfully!")</script>';
    } else if ($order_sstate == 'cancelled' && $mde = 'nrml') {
      $conn->query("UPDATE `orders` SET `status` = 'pending' WHERE `orders`.`order_id` = $id;");
      echo '<script>alert("Order state updated succesfully!")</script>';
    }
  }
  ?>

  <div class="admin-table">
    <h2>Orders</h2>
    <span>view and manage orders</span>
    <div class="table" style="width: 1300px;">
      <div class="searchAddS">
        <section class="tableSearch">
          <input type="text" id="search" placeholder="search Orders..." />
          <button id="search-bt">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </section>
      </div>
      <div class=" table-body">
        <div class="table-header">
          <div class="table-row">
            <div class="table-cell">Customer</div>
            <div class="table-cell" style="flex: 0.5;">Table No</div>
            <div class="table-cell">Date / Time</div>
            <div class="table-cell">Food types</div>
            <div class="table-cell">Ammount</div>
            <div class="table-cell">Total</div>
            <div class="table-cell" style="flex: 1.1;">Status</div>
          </div>
        </div>
        <div class="table-data">
          <?php
          require_once "../php/DbConnect.php";
          $result = $conn->query("SELECT 
                                  r.*, 
                                  SUM(rt.amount) AS amm,
                                  rtbl.table_no AS table_no,
                                  u.name AS customer_name, 
                                  COUNT(rt.menu_item) AS num_amm 
                                FROM orders r 
                                LEFT JOIN user u ON r.customer = u.user_id 
                                LEFT JOIN rstrnt_table rtbl ON r.order_table = rtbl.table_id 
                                LEFT JOIN order_items rt ON r.order_id = rt.order_id 
                                GROUP BY r.order_id, rtbl.table_no, u.name 
                                ORDER BY r.time_stamp DESC;");

          while ($row = $result->fetch_assoc()) {
            echo '<div class="table-row">';
            echo '<div class="table-cell">' . $row['customer_name'] . '</div>';
            echo '<div class="table-cell" style="flex: 0.5;">' . $row['table_no'] . '</div>';
            echo '<div class="table-cell">' . $row['time_stamp'] . '</div>';
            echo '<div class="table-cell">' . $row['num_amm'] . '</div>';
            echo '<div class="table-cell">' . $row['amm'] . '</div>';
            echo '<div class="table-cell">Rs. ' . number_format($row['total'], 2) . '</div>';
            echo '<div class="table-cell" style="flex: 1.1;">';
            echo "<a href=orders.php?id=" . urlencode($row['order_id']) . "&mde=nrml>" . $row['status'] . "..</a>";
            echo ($row['status'] == 'pending') ? "<a href=orders.php?id=" . urlencode($row['order_id']) . "&mde=cncl><i class='fa-solid fa-ban'></i></a>" : "";
            echo '<a href=ordersView.php?id=' . $row['order_id'] . '><i class="fa-solid fa-angles-right"></i></a>';
            echo "</div>";
            echo '</div>';
          }
          ?>
          <div class="table-row-mt <?php echo ($result && $result->num_rows > 0) ? 'freak' : '' ?>" id="last-row">
            <div class="table-cell">No records found</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- data table -->

  <?php require_once '../php/loader.php' ?>
  <?php require_once '../php/scripts.php' ?>
</body>

</html>