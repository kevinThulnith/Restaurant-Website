<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Cart</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
  <style>
    #name {
      width: 130px;
    }

    #name:focus,
    #name:active {
      width: 150px;
    }
  </style>
</head>

<body>
  <?php
  require_once '../php/DbConnect.php';
  $ghr = "No table is set";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = $conn->query("SELECT * FROM `rstrnt_table` WHERE `table_no` =  '" . $_POST['name'] . "';");
    if ($result->num_rows == 0) $ghr = "No table found";
    else {
      $table_id = mysqli_fetch_assoc($result)['table_id'];
      try {
        $conn->query("UPDATE `rstrnt_table` SET `table state` = 'in use' WHERE `rstrnt_table`.`table_id` = $table_id;");
        $conn->query("INSERT INTO `orders` (`order_table`,`type`) VALUES ($table_id, 'physical')");
        $order_id = $conn->insert_id;
        $_SESSION['orderId'] = $order_id;
        $ghr = "Table set sccesfully";
      } catch (\Throwable $th) {
        $ghr = $th;
      }
    }
  }
  ?>

  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="menu.php">Menu</a></li>
        <li><a href="cart.php" class="active">Cart</a></li>
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

  <?php top("My Cart", "Manage Cart") ?>

  <div class="admin-table" style="min-height: 400px;">
    <h2>View Cart</h2>
    <span>view and manage cart items</span>
    <div class="table" style="width: 1000px;">
      <div class="searchAddS">
        <button onclick="window.location.href = 'menu.php'"">Add more items</button>
        <form action=" <?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="message">
            <i class="fa-solid fa-circle"></i>
            <?php echo $ghr ?>
          </div>
          <input
            id="name"
            name="name"
            type="text"
            required
            placeholder="table no.." />
          <button type="submit">Set Table</button>
          </form>
          <?php if (isset($error)) echo "<p>$error</p>" ?>
      </div>
      <div class=" table-body">
        <div class="table-header">
          <div class="table-row">
            <div class="table-cell">Menu Item Name</div>
            <div class="table-cell">Amount</div>
            <div class="table-cell">Price</div>
            <div class="table-cell">Subtotal</div>
          </div>
        </div>
        <div class="table-data">
          <?php
          if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $total = 0;
            foreach ($_SESSION['cart'] as $item) {
              $subtotal = $item['price'] * $item['amm'];
              $total += $subtotal;
              echo '<div class="table-row">';
              echo '<div class="table-cell">' . htmlspecialchars($item['name']) . '</div>';
              echo '<div class="table-cell"> X' . htmlspecialchars($item['amm']) . '<a style="margin-left: 15px;" href=cartRemove.php?id=' . $item['id'] . '><i class="fa-solid fa-trash-can" style="font-size: 18px;"></i></a></div>';
              echo '<div class="table-cell">Rs.' . number_format($item['price'], 2) . '</div>';
              echo '<div class="table-cell">Rs.' . number_format($subtotal, 2) . '</div>';
              echo '</div>';
            }
            echo '<div class="table-row">';
            echo '<div class="table-cell" style="flex:3;"><a>Total</a></div>';
            echo '<div class="table-cell">Rs.' . number_format($total, 2) . '</div>';
            echo '</div>';
          } else {
            echo '<div class="table-row-mt" id="last-row"><div class="table-cell">No records found</div></div>';
          }
          ?>
        </div>
      </div>
      <div class=" searchAddS" style="margin-top: 30px;">
        <button id="varify" onclick="window.location.href = 'orderProcess.php'"" >Submit</button>
        <button onclick=" window.location.href='cartClear.php'"">Clear cart</button>
      </div>
    </div>
  </div>
  <script>
    // disable submit button after 9 pm
    document.addEventListener('DOMContentLoaded', function() {
      var verifyButton = document.getElementById('varify');
      var currentTime = new Date();
      var currentHour = currentTime.getHours();

      // 21 is 9 PM in 24-hour format
      if (currentHour >= 21) {
        verifyButton.disabled = true;
        verifyButton.title = " Button disabled after 9 PM";
      }
    });
  </script>
  <!-- data table -->

  <?php require_once '../php/loader.php' ?>
  <?php require_once '../php/scripts.php' ?>

</body>

</html>