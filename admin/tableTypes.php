<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Table Types</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="tableTypes.php" class="active">Table Types</a></li>
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

  <?php topAdmin("Table Type", "Table Types") ?>

  <div class="admin-table">
    <h2>Table types</h2>
    <span>view and manage menu table types</span>
    <div class="table">
      <div class="table-body">
        <div class="table-header">
          <div class="table-row">
            <div class="table-cell">Type Id</div>
            <div class="table-cell">Type Name</div>
            <div class="table-cell">Num of Tables</div>
            <div class="table-cell">Status</div>
          </div>
        </div>
        <div class="table-data">
          <?php
          require_once "../php/DbConnect.php";
          $result = $conn->query("SELECT 
                                  `table types`.*, 
                                  COUNT(rstrnt_table.table_id) AS table_count 
                                 FROM `table types` LEFT JOIN rstrnt_table ON rstrnt_table.`table type` = `table types`.`type_id` GROUP BY `table types`.`type_id`;");
          while ($row = $result->fetch_assoc()) {
            echo '<div class="table-row">';
            echo '<div class="table-cell">' . $row['type_id'] . '</div>';
            echo '<div class="table-cell">' . $row['type_name'] . '</div>';
            echo '<div class="table-cell">' . $row['table_count'] . '</div>';
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