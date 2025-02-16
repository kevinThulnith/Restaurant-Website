<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Dashboard</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body style="display:flex; height:100vh; justify-content:center; align-items:center;">
  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <?php navigationAdmin(1) ?>
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

  <?php
  require_once "../php/DbConnect.php";

  // setting up data 
  $arr = [0, 0, 0, 0, 0, 0, 0, 0];
  $sql = [
    "SELECT COUNT(*) AS count FROM user WHERE is_staff = 1;",
    "SELECT COUNT(*) AS count FROM rstrnt_table;",
    "SELECT COUNT(*) AS count FROM `table types`;",
    "SELECT COUNT(*) AS count FROM food;",
    "SELECT COUNT(*) as count FROM `food type`;",
    "SELECT COUNT(*) AS count FROM user WHERE is_customer = 1 ;",
    "SELECT COUNT(*) AS count FROM orders;",
    "SELECT COUNT(*) AS count FROM reservation;"
  ];

  // execute queries
  for ($i = 0; $i < count($sql); $i++) {
    $result = $conn->query($sql[$i]);
    while ($row = $result->fetch_assoc()) {
      $arr[$i] = $row['count'];
    }
  }
  ?>

  <div class="container">
    <h1>Quick view of the inventory!</h1>
    <div class="pad">
      <div class="row">
        <div class="cell">
          <p>Employees</p>
          <h2><?php echo $arr[0] ?></h2>
        </div>
        <div class="cell">
          <p>Tables</p>
          <h2><?php echo $arr[1] ?></h2>
        </div>
        <div class="cell">
          <p>Table types</p>
          <h2><?php echo $arr[2] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="cell half">
          <p>Menu Items</p>
          <h2><?php echo $arr[3] ?></h2>
        </div>
        <div class="cell half">
          <p>Menu item types</p>
          <h2><?php echo $arr[4] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="cell">
          <p>Customers</p>
          <h2><?php echo $arr[5] ?></h2>
        </div>
        <div class="cell">
          <p>Orders</p>
          <h2><?php echo $arr[6] ?></h2>
        </div>
        <div class="cell">
          <p>Reservations</p>
          <h2><?php echo $arr[7] ?></h2>
        </div>
      </div>
    </div>
  </div>
  <!--quick view    -->

  <?php require_once '../php/loader.php' ?>
  <?php require_once '../php/scripts.php' ?>
</body>

</html>