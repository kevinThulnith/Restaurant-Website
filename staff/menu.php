<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Specialties</title>
  <?php require_once '../php/styles.php' ?>
  <style>
    .contrt {
      margin-top: -62px;
    }
  </style>
</head>

<body>
  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="menu.php" class="active">Menu Items</a></li>
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

  <?php require_once 'popup.php' ?>

  <?php topAdmin("Menu", "Specialties") ?>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-2">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <span class="subheading">Specialties</span>
          <h2 class="mb-4">Our Menu</h2>
          <section class="search">
            <input type="text" id="search" placeholder="search here...">
            <button id="search-bt"><i class="fa-solid fa-magnifying-glass"></i></button>
          </section>
        </div>
      </div>
      <div class="row">
        <?php
        // db connecyion
        include_once '../php/DbConnect.php';

        // get menu item types
        $result1 = $conn->query("SELECT * FROM `food type`;");
        while ($row1 = $result1->fetch_assoc()) {

          // headings
          echo "<div class='col-md-6 col-lg-4 menu-wrap'>
                  <div class='heading-menu text-center ftco-animate'>
                    <h3>" . $row1['name'] . "</h3>
                  </div>";

          // get menu items
          $result = $conn->query("SELECT * FROM food WHERE `food_sts` > 0 AND food_type = '" . $row1['type_Id'] . "';");
          while ($row = $result->fetch_assoc()) {
            $imageData = $row["image"];

            // Determine the image type
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $imageType = $finfo->buffer($imageData);

            // Encode the image data to base64
            $base64Image = base64_encode($imageData);

            echo "<div class='menus d-flex ftco-animate'>
                      <div class='menu-img img' style='background-image: url(data:$imageType;base64,$base64Image)'></div>
                      <div class='text'>
                        <div class='d-flex'>
                          <div class='one-half'>
                            <h3 style='text-transform: capitalize;'>" . $row['name'] . "</h3>
                          </div>
                          <div class='one-forth'>
                            <span class='price'>Rs" . $row['price'] . "</span>
                          </div>
                        </div>
                        <p>
                          <span>" . $row['cousin'] . " cousin</span>
                          <input type='hidden' class='p-id' value='" . $row['food_Id'] . "'>
                        </p>
                      </div>
                    </div>";
          }
          echo "</div>";
        }
        $conn->close();
        ?>
      </div>
      <div class="row">
        <div class="col-md-12 text-center ftco-animate">
          <p><a href="cart.php" class="btn btn-black py-3 px-5">View Selected Menu Items</a></p>
        </div>
      </div>
    </div>
  </section>

  <?php require_once '../php/loader.php' ?>
  <?php require_once '../php/scripts.php' ?>
</body>

</html>