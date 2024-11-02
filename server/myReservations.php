<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - My Resavations</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <?php
  // get values
  $id = $_GET['id'] ?? null;
  $mde = $_GET['mde'] ?? null;

  if ($id != null || $mde != null) {
    // connect database
    include_once '../php/DbConnect.php';

    // get resavation to change status
    $result = $conn->query("SELECT * FROM `reservation` WHERE `reservation_id` = $id;");
    $resavation_status = mysqli_fetch_assoc($result)['status'];

    if ($mde == 'cncl') {
      $conn->query("UPDATE `reservation` SET `status`='canceled' WHERE `reservation_id` = $id;");
      echo '<script>alert("Reservation cancelled succesfully!");</script>';
    }
  }
  ?>

  <nav>
    <a href="home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="home.php">Home</a></li>
        <li><a href="myReservations.php" class="active">My Resavations</a></li>
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

  <?php top("My Reservation", "Manage Reservation") ?>

  <div class="admin-table" style="min-height: 400px;">
    <h2>Reservations</h2>
    <span>view and manage reservations</span>
    <div class="table" style="width: 1200px;">
      <div class="searchAddS">
        <section class="tableSearch">
          <input type="text" id="search" placeholder="reservations..." />
          <button id="search-bt">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </section>
        <button onclick="window.location.href = 'reservation.php'"">Make a Reservation</button>
      </div>
      <div class=" table-body">
          <div class="table-header">
            <div class="table-row">
              <div class="table-cell">Type</div>
              <div class="table-cell" style="flex:0.6">Party</div>
              <div class="table-cell" style="flex:0.6">Tables</div>
              <div class="table-cell">Date</div>
              <div class="table-cell" style="flex:0.7">Time</div>
              <div class="table-cell">Time Created</div>
              <div class="table-cell">Status</div>
            </div>
          </div>
          <div class="table-data">
            <?php
            require_once "../php/DbConnect.php";
            $user_data = json_decode($_COOKIE['user_data'], true);
            $user_id = $user_data['user_id'];
            $result = $conn->query("SELECT r.*, 
                                  tt.type_name AS reservation_type, 
                                  COUNT(rt.reserved_table) AS number_of_tables_reserved 
                                FROM reservation r JOIN user u ON r.user = u.user_id AND r.user = $user_id
                                JOIN `table types` tt ON r.resavaton_type = tt.type_id 
                                LEFT JOIN resavation_table rt ON r.reservation_id = rt.resavation GROUP BY r.created_time DESC;");

            while ($row = $result->fetch_assoc()) {
              echo '<div class="table-row">';
              echo '<div class="table-cell">' . $row['reservation_type'] . '</div>';
              echo '<div class="table-cell" style="flex:0.6">' . $row['number_of_people'] . '</div>';
              echo '<div class="table-cell" style="flex:0.6">' . $row['number_of_tables_reserved'] . '</div>';
              echo '<div class="table-cell">' . $row['date'] . '</div>';
              echo '<div class="table-cell" style="flex:0.7">' . $row['time'] . '</div>';
              echo '<div class="table-cell">' . $row['created_time'] . '</div>';
              echo '<div class="table-cell">';
              echo "<a>" . $row['status'] . "..</a>";
              echo ($row['status'] == 'confirmed' || $row['status'] == 'pending') ? "<a href=myReservations.php?id=" . urlencode($row['reservation_id']) . "&mde=cncl><i class='fa-solid fa-ban'></i></a>" : "";
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