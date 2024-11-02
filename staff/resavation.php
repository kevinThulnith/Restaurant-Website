<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Reservations</title>
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

    // get reservation to change status
    $result = $conn->query("SELECT * FROM `reservation` WHERE `reservation_id` = $id;");
    $resavation_status = mysqli_fetch_assoc($result)['status'];

    // edit state
    if ($resavation_status == 'pending' && $mde == 'nrml') {
      $conn->query("UPDATE `reservation` SET `status`='confirmed' WHERE `reservation_id` = $id;");
      echo '<script>alert("Reservation confirmed succesfully!");</script>';
    } else if ($resavation_status == 'confirmed' && $mde == 'nrml') {
      $conn->query("UPDATE `reservation` SET `status`='completed' WHERE `reservation_id` = $id;");
      echo '<script>alert("Reservation completed succesfully!");</script>';
    } else if ($resavation_status == 'confirmed' && $mde = 'cncl') {
      $conn->query("UPDATE `reservation` SET `status`='canceled' WHERE `reservation_id` = $id;");
      echo '<script>alert("Reservation cancelled succesfully!")</script>';
    } else if ($resavation_status == 'canceled' && $mde == 'nrml') {
      $conn->query("UPDATE `reservation` SET `status`='confirmed' WHERE `reservation_id` = $id;");
      echo '<script>alert("Reservation restored succesfully!");</script>';
    } else if ($resavation_status == 'canceled' && $mde == 'delt') {
      $conn->query("DELETE from `reservation` WHERE `reservation_id` = $id;");
      echo '<script>alert("Reservation deleted succesfully!");</script>';
    }
  }
  ?>

  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <?php navigationStaff(2) ?>
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

  <?php topAdmin("Reservations", "Manage Resavations") ?>

  <div class="admin-table">
    <h2>Reservations</h2>
    <span>view and manage reservations</span>
    <div class="table" style="width: 1400px;">
      <div class="searchAddS">
        <section class="tableSearch">
          <input type="text" id="search" placeholder="reservations..." />
          <button id="search-bt">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </section>
      </div>
      <div class="table-body">
        <div class="table-header">
          <div class="table-row">
            <div class="table-cell">Customer</div>
            <div class="table-cell">Type</div>
            <div class="table-cell" style="flex: 0.6;">Party</div>
            <div class="table-cell" style="flex: 0.6;">Tables</div>
            <div class="table-cell">Date / Time</div>
            <div class="table-cell">Time Created</div>
            <div class="table-cell">Status</div>
          </div>
        </div>
        <div class="table-data">
          <?php
          require_once "../php/DbConnect.php";
          $result = $conn->query("SELECT r.*, 
                                  u.name AS customer_name, 
                                  tt.type_name AS reservation_type, 
                                  COUNT(rt.reserved_table) AS number_of_tables_reserved 
                                FROM reservation r JOIN user u ON r.user = u.user_id 
                                JOIN `table types` tt ON r.resavaton_type = tt.type_id 
                                LEFT JOIN resavation_table rt ON r.reservation_id = rt.resavation GROUP BY r.reservation_id, u.name, tt.type_name DESC;");

          while ($row = $result->fetch_assoc()) {
            echo '<div class="table-row">';
            echo '<div class="table-cell">' . $row['customer_name'] . '</div>';
            echo '<div class="table-cell">' . $row['reservation_type'] . '</div>';
            echo '<div class="table-cell" style="flex: 0.6;">' . $row['number_of_people'] . '</div>';
            echo '<div class="table-cell" style="flex: 0.6;">' . $row['number_of_tables_reserved'] . '</div>';
            echo '<div class="table-cell">' . $row['date'] . ' | ' . $row['time'] . '</div>';
            echo '<div class="table-cell">' . $row['created_time'] . '</div>';
            echo '<div class="table-cell">';
            echo "<a href=resavation.php?id=" . $row['reservation_id'] . "&mde=nrml>" . $row['status'] . "..</a>";
            echo ($row['status'] == 'confirmed') ? "<a href=resavation.php?id=" . urlencode($row['reservation_id']) . "&mde=cncl><i class='fa-solid fa-ban'></i></a>" : "";
            echo '<a href=resavationView.php?id=' . $row['reservation_id'] . '><i class="fa-solid fa-angles-right"></i></a>';
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elementsToDisable = document.querySelectorAll('a');

      elementsToDisable.forEach(function(element) {
        if (element.innerHTML.trim() === "completed..") {
          element.href = "javascript:void(0)";
          element.style.pointerEvents = 'none';
          element.style.cursor = 'default'; // Optional: changes cursor to default arrow
        }
      });
    });
  </script>

  <?php require_once '../php/loader.php' ?>
  <?php require_once '../php/scripts.php' ?>
</body>

</html>

<a href="resavation.php?id=4mde=nrml">completed..</a>