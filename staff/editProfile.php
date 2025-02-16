<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Edit Profile</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body style="display: flex;height: 100vh;justify-content: center;align-items: center;">
  <nav>
    <a href="home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="editProfile.php" class="active">Edit Profile</a></li>
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

  <?php
  require_once '../php/DbConnect.php';
  $ghr = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Invalid CSRF token, possible form tampering attempt detected
    if (!isset($_POST['csrf_token']) && !($_POST['csrf_token'] === $_SESSION['csrf_token'])) die('Invalid CSRF token.');

    try {
      $bod = $_POST['day'];
      $name = $_POST['name'];
      $address = $_POST['address'];

      $conn->query("UPDATE user SET name = '$name',address = '$address', dob = '$bod' WHERE username = '" . $_SESSION['username'] . "'");
      $ghr = "Profile updated succesfully!";

      // Unset a specific session variable
      unset($_SESSION['csrf_token']); // Removes the 'csrf_token' session variable

    } catch (\Throwable $th) {
      $ghr =  $th->getMessage();
    }
  }

  if (isset($_SESSION['username'])) {
    $sql = "SELECT * FROM user WHERE username = '" . $_SESSION['username'] . "';";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) $row = mysqli_fetch_assoc($res);
  }

  // Check if the token is already set, if not, generate it
  if (empty($_SESSION['csrf_token'])) {
    // Generate a unique token using random bytes (or a more complex approach if necessary)
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Secure 32-byte random token
  }
  ?>

  <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-5 ftco-animate img img-2" style="background-image: url(../svg/logoFull.png)"></div>
        <div class="col-md-7 ftco-animate makereservation p-4 p-md-5">
          <div class="heading-section ftco-animate mb-5">
            <h2 class="mb-4">Update Profile</h2>
          </div>
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="formi" method="post">
            <div class="row">
              <?php if ($ghr) echo "<div class='message'><i class='fa-solid fa-circle'></i> $ghr</div>" ?>
              <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?>">
              <div class="col-md-6 form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $row["name"] ?>" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Address</label>
                <input type="text" name="address" class=" form-control" value="<?php echo $row["address"] ?>" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Birth day</label>
                <input type="date" name="day" class="form-control" value="<?php echo $row["dob"] ?>" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Email</label>
                <input type="email" class="form-control" value="<?php echo  $row["email"] ?>" readonly />
              </div>
              <div class="col-md-6 form-group">
                <label>Contact Number</label>
                <input type="text" class="form-control" value="<?php echo  $row["mobile"] ?>" readonly />
              </div>
              <div class="col-md-12 mt-3">
                <div class="form-group">
                  <input type="submit" value="Update Profile" class="btn btn-primary py-3 px-5" />
                </div>
              </div>
            </div>
          </form>
          <?php if (isset($error)) echo "<p>$error</p>" ?>
        </div>
      </div>
    </div>
  </section>
  <!-- Form -->

  <?php require_once '../php/loader.php' ?>
  <?php require_once '../php/scripts.php' ?>
</body>

</html>