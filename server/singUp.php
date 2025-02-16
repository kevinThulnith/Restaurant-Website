<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Sing Up</title>
  <?php require_once '../php/styles.php' ?>
</head>

<body style="display: flex;height: 100vh;justify-content: center;align-items: center;">
  <nav>
    <a href="index.html" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="home.php">Home</a></li>
        <li><a href="singUp.php" class="active">Sing Up</a></li>
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
    $result1 = $conn->query("SELECT * FROM user WHERE mobile = '" . $_POST['mobile'] . "' ;");
    $result2 = $conn->query("SELECT * FROM user WHERE username = '" . $_POST['uname'] . "';");
    $result3 = $conn->query("SELECT * FROM user WHERE email = '" . $_POST['email'] . "';");

    if ($result1->num_rows > 0)  $ghr = "Mobile nomber already used";
    elseif ($result2->num_rows > 0)  $ghr = "Username already used";
    elseif ($result3->num_rows > 0)  $ghr = "Email already used";
    elseif ($_POST['password'] != $_POST['password2'])  $ghr = "Passwords don't match";
    else {
      $newuser = [
        "name" => $_POST['name'],
        "address" => $_POST['address'],
        "mobile" => $_POST['mobile'],
        "email" => $_POST['email'],
        "day" => $_POST['day'],
        "uname" => $_POST['uname'],
        "otp" => "" . rand(99999, 999999),
        "password" => $_POST['password']
      ];
      $body = "Hi " . $_POST['name'] . ",<br/><br/>

              Thank you for signing up with Gallery Cafe! To complete your registration, please enter the One-Time Password (OTP) below:<br/><br/>
              
              <b>Your OTP Code: " . $newuser['otp'] . "</b><br/><br/>
              
              This code is valid for the next 10 minutes. If you did not request this code, please ignore this email.<br/><br/>
              
              If you encounter any issues or need further assistance, feel free to reach out to our support team at galleryCafe@gmail.com .<br/><br/>
              
              Welcome aboard!<br/><br/>
              
              Best regards,";
      $newuser_json = json_encode($newuser);
      setcookie("newUser", $newuser_json, time() + 3600, "/");
      sendMail($_POST['email'], $_POST['name'], 'Email Verification', $body);
      header("Location: verification.php");
    }
  }

  ?>

  <section class="ftco-section ftco-no-pt ftco-no-pb" style="margin: 93px 0">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-5 ftco-animate img img-2" style="background-image: url(../images/bg_1.jpg)"></div>
        <div class="col-md-7 ftco-animate makereservation p-4 p-md-5">
          <div class="heading-section ftco-animate mb-5">
            <span class="subheading">New User</span>
            <h2 class="mb-4">Singup</h2>
          </div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="formi" method="post">
            <div class="row">
              <?php if ($ghr) echo "<div class='message'><i class='fa-solid fa-circle'></i> $ghr</div>"; ?>
              <div class="col-md-6 form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="name" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address" placeholder="address" maxlength="60" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Contact Number</label>
                <input type="text" minlength="9" maxlength="10" pattern="[0-9 +\-]+" title="Please enter only numbers, spaces, +, or -." class="form-control" name="mobile" placeholder="mobile" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Birth day</label>
                <input type="date" class="form-control" name="day" placeholder="birth day" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="email" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="uname" placeholder="username" autocomplete="off" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Password</label>
                <input type='password' class="form-control" name="password" placeholder="password" autocomplete="off" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Retype password</label>
                <input type="password" class="form-control" name="password2" placeholder="retype  password" required />
              </div>
              <div class="col-md-12 mt-3">
                <div class="form-group">
                  <input type="submit" value="Sing up" class="btn btn-primary py-3 px-5" />
                </div>
              </div>
              <div class="col-md-12 mt-3" style="margin: -50px 0;">
                <div class="form-group">
                  <p>Have an account <a href="login.php">Login</a></p>
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