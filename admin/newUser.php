<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - New User Account</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body style="display: flex;height: 100vh;justify-content: center;align-items: center;">
  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="newUser.php" class="active">New User</a></li>
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
  require_once '../php/DbConnect.php';
  $ghr = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
      // Fetch data from the form
      $name = $_POST['name'];
      $address = $_POST['address'];
      $dob = $_POST['day'];
      $username = $_POST['uname'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];
      $usertype = $_POST['usertype'];

      // Set user role flags based on the user type
      $is_admin = ($usertype == 'admin') ? 1 : 0;
      $is_staff = ($usertype == 'Staff') ? 1 : 0;
      $is_customer = ($usertype == 'customer') ? 1 : 0;

      $conn->query("INSERT INTO `user` (name, address, dob, username, password, email, mobile, is_admin, is_staff, is_customer) 
            VALUES ('$name', '$address', '$dob', '$username', '$password', '$email', '$mobile', $is_admin, $is_staff, $is_customer)");
      $ghr = "Process successfully done!";
    } catch (\Throwable $th) {
      $ghr =  $th->getMessage();
    }
  }

  ?>

  <section class="ftco-section ftco-no-pt ftco-no-pb" style="margin: 93px 0">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-5 ftco-animate img img-2" style="background-image: url(../svg/logoFull.png)"></div>
        <div class="col-md-7 ftco-animate makereservation p-4 p-md-5">
          <div class="heading-section ftco-animate mb-5">
            <h2 class="mb-4">Create User Account</h2>
          </div>
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="formi" method="post">
            <div class="row">
              <?php if ($ghr) echo "<div class='message'><i class='fa-solid fa-circle'></i> $ghr</div>"; ?>
              <div class="col-md-6 form-group">
                <label for="time">User Type</label>
                <div class="select-wrap one-third" style="max-height: 300px;">
                  <div class="icon">
                    <i class="fa-solid fa-chevron-down"></i>
                  </div>
                  <select id="time" name="usertype" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="Staff">Staff</option>
                    <option value="customer">Customer</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6 form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="User Full Name" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Address</label>
                <input type="text" name="address" class=" form-control" placeholder="Address" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Contact Number</label>
                <input type="text" name="mobile" class="form-control" name="mobile" placeholder="Contact number" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Birth day</label>
                <input type="date" name="day" class="form-control" placeholder="Date of birth" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="uname" placeholder="username" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="password" required />
              </div>
              <form action="newusercreate.php" class="formi" method="post">
                <!-- User type, name, address, email, mobile, dob, username, password fields as defined in your code -->
                <div class="col-md-12 mt-3">
                  <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-primary py-3 px-5" />
                  </div>
                </div>
              </form>
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