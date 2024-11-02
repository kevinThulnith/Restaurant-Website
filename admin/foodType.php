<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Food Types</title>
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
  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="foodType.php" class="active">Food Types</a></li>
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

  <?php topAdmin("Food Type", "Manage Food Types") ?>

  <?php
  require_once '../php/DbConnect.php';
  $ghr = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
      $conn->query("INSERT INTO `food type` ( `name`) VALUES ('" . $_POST['name'] . "');");
      $ghr = "Process successfully done";
    } catch (\Throwable $th) {
      $ghr =  $th->getMessage();
    }
  }
  ?>

  <div class="admin-table">
    <h2>Food types</h2>
    <span>view and manage menu item types</span>
    <div class="table">
      <div class="searchAddS">
        <section class="tableSearch">
          <input type="text" id="search" placeholder="search types..." />
          <button id="search-bt"><i class="fa-solid fa-magnifying-glass"></i></button>
        </section>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="message <?php if ($ghr == "") echo "hide"; ?>">
            <i class="fa-solid fa-circle"></i>
            <?php echo $ghr ?>
          </div>
          <input
            id="name"
            name="name"
            type="text"
            pattern="[A-Za-z\s]*"
            title="Please enter only letters."
            required
            placeholder="new type.." />
          <button type="submit">Add type</button>
        </form>
        <?php if (isset($error)) echo "<p>$error</p>" ?>
      </div>
      <div class="table-body">
        <div class="table-header">
          <div class="table-row">
            <div class="table-cell">Type Id</div>
            <div class="table-cell">Type Name</div>
            <div class="table-cell">Num of Foods</div>
            <div class="table-cell">Status</div>
          </div>
        </div>
        <div class="table-data">
          <?php
          require_once "../php/DbConnect.php";
          $result = $conn->query("SELECT `food type`.*, COUNT(food.food_Id) AS food_count FROM `food type` LEFT JOIN `food` ON `food type`.`type_Id` = food.food_type GROUP BY `food type`.`type_Id`;");
          while ($row = $result->fetch_assoc()) {
            echo '<div class="table-row">';
            echo '<div class="table-cell">' . $row['type_Id'] . '</div>';
            echo '<div class="table-cell">' . $row['name'] . '</div>';
            echo '<div class="table-cell">' . $row['food_count'] . '</div>';
            echo ($row['status']) ? '<div class="table-cell"><a href="#" >Active..</a></div>' : '<div class="table-cell"><a href="#" >Inactive..</a></div>';
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