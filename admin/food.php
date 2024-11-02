<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Menu Items</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <?php
  $id = $_GET['id'] ?? null;

  if ($id != null) {
    // connect database
    include_once '../php/DbConnect.php';

    // get food to change food_sts
    $result = $conn->query("SELECT * FROM `food` WHERE `food_Id` = $id;");
    $food_status = mysqli_fetch_assoc($result)['food_sts'];

    if ($food_status) {
      $conn->query("UPDATE `food` SET `food_sts` = '0' WHERE `food`.`food_Id` = $id;");
      echo '<script>alert("Menu item disabled succesfully!");</script>';
    } else {
      $conn->query("UPDATE `food` SET `food_sts` = '1' WHERE `food`.`food_Id` = $id;");
      echo '<script>alert("Menu item enabled succesfully!");</script>';
    }
  }
  ?>

  <?php
  require_once '../php/DbConnect.php';
  $ghr = "";

  // retreve data if form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
      $image = $_FILES['image']['tmp_name'];
      $imgContent = addslashes(file_get_contents($image));

      // Validate food type
      $foodType = $_POST['type'];
      $checkTypeQuery = $conn->query("SELECT * FROM `food type` WHERE `type_Id` = '$foodType'");
      if ($checkTypeQuery->num_rows === 0) {
        die("Invalid food type selected.");
      }

      // input data to db
      $conn->query("INSERT INTO `food` ( `name`, `food_type`, `price`, `image`, `cousin`) VALUES ( '" . $_POST['name'] . "', '" . $_POST['type'] . "', '" . $_POST['price'] . "', '$imgContent', '" . $_POST['cousin'] . "')");
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
        <?php navigationAdmin(3) ?>
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
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 1015px" enctype="multipart/form-data">
      <span>Gallery Cafe</span>
      <h2>Add new menu item</h2>
      <div class="xmark"><i class="fa-solid fa-xmark"></i></div>
      <div class="form-body">
        <div class="image" style="height: 415px">
          <img
            src="../svg/image.svg"
            class="display"
            style="max-width: 360px; max-height:360px" />
        </div>
        <div class="fields">
          <!-- Display any messages -->
          <div class="message <?php if ($ghr == "") echo "pop"; ?>">
            <i class="fa-solid fa-circle"></i>
            <?php echo htmlspecialchars($ghr); ?>
          </div>
          <div class="fields" style="width: 580px">
            <div class="inputs">
              <label>Name</label>
              <input type="text" name="name" placeholder="name..." required />
            </div>
            <div class="inputs">
              <label>price</label>
              <input type="text" name="price" placeholder="price..." pattern="^\d+(\.\d+)?$" title="only numbers and ." />
            </div>
            <div class="inputs">
              <label>Cousin</label>
              <select name="cousin" class="form-control" required>
                <option value="Sri Lankan" selected>Sri Lankan</option>
                <option value="Chinese">Chinese</option>
                <option value="Italian">Italian</option>
                <option value="Indian">Indian</option>
                <option value="French">French</option>
                <option value="Korean">Korean</option>
              </select>
            </div>
            <div class="inputs">
              <label>Food type</label>
              <select name="type" class="form-control" required>
                <?php
                // Fetching Food types from the database
                $result1 = $conn->query("SELECT * FROM `food type`");
                while ($row1 = $result1->fetch_assoc()) {
                  echo "<option value='" . $row1['type_Id'] . "'>" . $row1['name'] . "</option>";
                }
                ?>
              </select>
            </div>
            <div class="inputs">
              <label>Product image</label>
              <input
                type="file"
                name="image"
                id="image_input"
                required
                accept=".jpg, .jpeg, .png, .img"
                title="edit properly before uploading" />
            </div>
          </div>
          <button type="submit">Submit</button>
        </div>
      </div>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>" ?>
  </div>
  <!-- popup -->

  <?php topAdmin("Food", "Manage Menu Items") ?>

  <div class="admin-table">
    <h2>Menu Items</h2>
    <span>view and manage menu items</span>
    <div class="table" style="width: 1200px;">
      <div class="searchAddS">
        <section class="tableSearch">
          <input type="text" id="search" placeholder="search foods..." />
          <button id="search-bt">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </section>
        <button id="btt1">New Menu Item</button>
      </div>
      <div class="table-body">
        <div class="table-header">
          <div class="table-row">
            <div class="table-cell">Cousin</div>
            <div class="table-cell">Name</div>
            <div class="table-cell">Food Type</div>
            <div class="table-cell" style="flex: 0.5 ;">Score</div>
            <div class="table-cell">Price</div>
            <div class="table-cell">Status</div>
          </div>
        </div>
        <div class="table-data">
          <?php
          require_once "../php/DbConnect.php";
          $result = $conn->query("SELECT food.*, `food type`.`name` as type_name FROM `food`,`food type` WHERE food.food_type = `food type`.`type_Id` ORDER BY food.name;");
          while ($row = $result->fetch_assoc()) {
            $imageData = $row["image"];

            // Determine the image type
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $imageType = $finfo->buffer($imageData);

            // Encode the image data to base64
            $base64Image = base64_encode($imageData);

            echo '<div class="table-row">';
            echo '<div class="table-cell">' . $row['cousin'] . '</div>';
            echo '<div class="table-cell">';
            echo $row['name'];
            echo "<div class='img' style='background-image: url(data:$imageType;base64,$base64Image)'></div>";
            echo '</div>';
            echo '<div class="table-cell">' . $row['type_name'] . '</div>';
            echo '<div class="table-cell" style="flex: 0.5 ;">' . $row['score'] . '</div>';
            echo '<div class="table-cell">Rs. ' . number_format($row['price'], 2) . '</div>';
            echo "<div class='table-cell'><a href=food.php?id=" . $row['food_Id'] . " >" . (($row['food_sts']) ? "Active.." : "Inactive..") . "</a></div>";
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

<!-- echo ($row['food_sts']) ? 'Active..</a></div>' : '<div class="table-cell"><a href="#">'; -->