<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Tables</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <?php
  // get values
  $id = $_GET['id'] ?? null;

  // redirect dashboard if acceseed indirectly
  if ($id != null) {
    // connect database
    include_once '../php/DbConnect.php';

    // get table to change state
    $result = $conn->query("SELECT * FROM `rstrnt_table` WHERE `table_id` = $id;");
    $table_state = mysqli_fetch_assoc($result)['table state'];

    if ($table_state == 'free') {
      $conn->query("UPDATE `rstrnt_table` SET `table state` = 'in use' WHERE `rstrnt_table`.`table_id` = $id;");
      echo '<script>alert("Table state updated succesfully!");</script>';
    } else {
      $conn->query("UPDATE `rstrnt_table` SET `table state` = 'free' WHERE `rstrnt_table`.`table_id` = $id;");
      echo '<script>alert("Table state updated succesfully!");</script>';
    }
  }
  ?>

  <?php
  require_once '../php/DbConnect.php';
  $ghr = "";

  // retreve data if form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
      // input data to db
      $conn->query("INSERT INTO `rstrnt_table` ( `table_no`, `table type`) VALUES ( '" . $_POST['name'] . "'," . $_POST['type'] . ")");
      $ghr = "Process successfully done";
    } catch (\Throwable $th) {
      $ghr =  $th->getMessage();
    }
  }

  ?>
  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <?php navigationStaff(5) ?>
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

  <div class="popup <?php if ($ghr == "") echo "hide"; ?>" style="margin-top: -62px;">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 580px">
      <span>Gallery Cafe</span>
      <h2>Add new Table</h2>
      <div class="xmark"><i class="fa-solid fa-xmark"></i></div>
      <div class="form-body">
        <div class="fields">
          <!-- Display any messages -->
          <div class="message <?php if ($ghr == "") echo "pop"; ?>">
            <i class="fa-solid fa-circle"></i>
            <?php echo htmlspecialchars($ghr); ?>
          </div>
          <div class="fields" style="width: 580px">
            <div class="inputs">
              <label>Table No</label>
              <input type="text" name="name" placeholder="tableXX" />
            </div>
            <div class="inputs">
              <label>Table Type</label>
              <select name="type" class="form-control" required>
                <?php
                // Fetching table types from the database
                $result1 = $conn->query("SELECT * FROM `table types`;");
                while ($row1 = $result1->fetch_assoc()) {
                  echo "<option value='" . $row1['type_id'] . "'>" . $row1['type_name'] . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <button type="submit">Submit</button>
        </div>
      </div>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>" ?>
  </div>
  <!-- popup -->

  <?php topAdmin("Tables", "Manage Tables") ?>

  <div class="admin-table">
    <h2>Restuarant Tables</h2>
    <span>view and manage resturant tables</span>
    <div class="table">
      <div class="searchAddS">
        <section class="tableSearch">
          <input type="text" id="search" placeholder="search tables..." />
          <button id="search-bt">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </section>
        <button id="btt1">New Table</button>
      </div>
      <div class="table-body">
        <div class="table-header">
          <div class="table-row">
            <div class="table-cell">Table Id</div>
            <div class="table-cell">Table No</div>
            <div class="table-cell">Table Type</div>
            <div class="table-cell">Status</div>
          </div>
        </div>
        <div class="table-data">
          <?php
          require_once "../php/DbConnect.php";
          $result = $conn->query("SELECT `rstrnt_table`.* , `table types`.`type_name` FROM `rstrnt_table`, `table types` WHERE `rstrnt_table`.`table type` = `table types`.`type_id` ORDER BY rstrnt_table.table_id, rstrnt_table.`table state`;;");
          while ($row = $result->fetch_assoc()) {
            echo '<div class="table-row">';
            echo '<div class="table-cell">' . $row['table_id'] . '</div>';
            echo '<div class="table-cell">' . $row['table_no'] . '</div>';
            echo '<div class="table-cell">' . $row['type_name'] . '</div>';
            echo '<div class="table-cell"><a href=table.php?id=' . $row['table_id'] . ' >' . $row['table state'] . '..</a></div>';
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