<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Customers</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <?php navigationAdmin(4) ?>
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

  <?php topAdmin("Customers", "Manage Customers") ?>

  <div class="admin-table">
    <h2>Customer Accounts</h2>
    <span>view and manage customer accounts</span>
    <div class="table" style="width: 1200px;">
      <div class="searchAddS">
        <section class="tableSearch">
          <input type="text" id="search" placeholder="customers..." />
          <button id="search-bt">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </section>
        <button onclick="window.location.href = 'newUser.php'">New Customer</button>
      </div>
      <div class="table-body">
        <div class="table-header">
          <div class="table-row">
            <div class="table-cell">Name</div>
            <div class="table-cell">Username </div>
            <div class="table-cell">Email </div>
            <div class="table-cell">Password</div>
            <div class="table-cell" style="flex: 0.6;">Status</div>
          </div>
        </div>
        <div class="table-data">
          <?php
          require_once "../php/DbConnect.php";
          $result = $conn->query("SELECT * FROM user WHERE is_customer = 1;");
          while ($row = $result->fetch_assoc()) {
            echo '<div class="table-row">';
            echo '<div class="table-cell">' . $row['name'] . '</div>';
            echo '<div class="table-cell">' . $row['username'] . '</div>';
            echo '<div class="table-cell">' . $row['email'] . '</div>';
            echo '<div class="table-cell">' . $row['password'] . '</div>';
            echo "<div class='table-cell' style='flex: 0.6;'><a href=userDisable.php?id=" . $row['user_id'] . " >" . (($row['is_active']) ? "Active.." : "Inactive..") . "</a></div>";
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