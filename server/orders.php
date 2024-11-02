<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - My Orders</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <nav>
    <a href="home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="home.php">Home</a></li>
        <li><a href="orders.php" class="active">My Orders</a></li>
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

  <?php top("My Orders", "Manage Orders") ?>

  <div class="admin-table" style="min-height: 400px;">
    <h2>My Orders</h2>
    <span>view and manage orders. Cant add orders after 8.00 pm</span>
    <div class="table" style="width: 1000px;">
      <div class="searchAddS">
        <button onclick="window.location.href = 'cart.php'"">Make a Order</button>
      </div>
      <div class=" table-body">
          <div class="table-header">
            <div class="table-row">
              <div class="table-cell">Date / Time</div>
              <div class="table-cell">Food types</div>
              <div class="table-cell">Ammount</div>
              <div class="table-cell">Total</div>
              <div class="table-cell">Status</div>
            </div>
          </div>
          <div class="table-data">
            <?php
            require_once "../php/DbConnect.php";

            // get logged user id
            $user_data = json_decode($_COOKIE['user_data'], true);
            $user_id = $user_data['user_id'];

            $result = $conn->query("SELECT 
                                      r.*, 
                                      SUM(rt.amount) as amm,
                                      COUNT(rt.menu_item) AS num_amm
                                    FROM orders r JOIN user u ON r.customer = u.user_id AND r.customer = $user_id 
                                    LEFT JOIN order_items rt ON r.order_id = rt.order_id GROUP BY r.time_stamp DESC;");

            while ($row = $result->fetch_assoc()) {
              echo '<div class="table-row">';
              echo '<div class="table-cell">' . $row['time_stamp'] . '</div>';
              echo '<div class="table-cell">' . $row['num_amm'] . '</div>';
              echo '<div class="table-cell">' . $row['amm'] . '</div>';
              echo '<div class="table-cell">Rs ' . number_format($row['total'], 2) . '</div>';
              echo '<div class="table-cell">';
              echo '<a>' . $row['status'] . '</a>';
              echo '... <a href=ordersView.php?id=' . $row['order_id'] . '><i class="fa-solid fa-angles-right"></i></a>';
              echo '</div>';
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

  <?php require '../php/feature.php' ?>
</body>

</html>