<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Cart</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <nav>
    <a href="home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="home.php">Home</a></li>
        <li><a href="cart.php" class="active">My Cart</a></li>
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
        <section class="tableSearch">
          <input type="text" id="search" placeholder="search items..." />
          <button id="search-bt">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </section>
        <button onclick="window.location.href = 'menu.php'"">Add more items</button>
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
        <button id="varify" onclick="window.location.href = 'orderProcess.php'"" >Varify for Takeaway</button>
        <button onclick=" window.location.href='cartClear.php'"">Clear cart</button>
      </div>
    </div>
  </div>
  <script>
    // disable button after 8 pm
    document.addEventListener('DOMContentLoaded', function() {
      var verifyButton = document.getElementById('varify');
      var currentTime = new Date();
      var currentHour = currentTime.getHours();

      // 20 is 8 PM in 24-hour format
      if (currentHour >= 20) {
        verifyButton.disabled = true;
        verifyButton.title = " Button disabled after 8 PM";
      }
    });
  </script>
  <!-- data table -->

  <?php require '../php/feature.php' ?>

</body>

</html>