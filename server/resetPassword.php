<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Reset Password</title>
  <?php require_once '../php/styles.php' ?>
</head>

<bod style="display: flex;height: 100vh;justify-content: center;align-items: center;">
  <nav>
    <a href="home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="home.php">Home</a></li>
        <li><a href="resetPassword.php" class="active">Reset password</a></li>
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
    $result1 = $conn->query("SELECT * FROM user WHERE username = '" . $_POST['uname'] . "' AND email = '" . $_POST['email'] . "';");
    if (!$result1->num_rows > 0) $ghr = "Username or email doesn't match";
    elseif ($_POST['pass1'] != $_POST['pass2']) $ghr = "Passwords don't match";
    else {
      $newuser = [
        "email" => $_POST['email'],
        "uname" => $_POST['uname'],
        "otp" => "" . rand(99999, 999999),
        "password" => $_POST['pass1']
      ];
      $newuser_json = json_encode($newuser);
      setcookie("newUser", $newuser_json, time() + 3600, "/");
      $body = "Dear customer,<br/><br/>

              We received a request to reset your password for your account associated with this email address. To proceed, please use the following One-Time Password (OTP):<br/><br/>
              
              <b>Your OTP Code: " . $newuser['otp'] . "</b><br/><br/>
              
              This OTP is valid for the next 10 minutes. Please do not share this code with anyone.<br/><br/>
              
              If you did not request a password reset, please ignore this email, and your password will remain unchanged.<br/><br/>
              
              Thank you for taking action to keep your account secure.<br/><br/>
              
              Best regards,";
      sendMail($_POST['email'], 'customer', 'Reset Password', $body);
      header("Location: verification.php");
    }
  }

  ?>

  <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-5 ftco-animate img img-2" style="background-image: url(../images/bg_1.jpg)"></div>
        <div class="col-md-7 ftco-animate makereservation p-4 p-md-5">
          <div class="heading-section ftco-animate mb-5">
            <h2 class="mb-4">Reset Password</h2>
          </div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="formi" method="post">
            <div class="row">
              <?php if ($ghr)  echo "<div class='message'> <i class='fa-solid fa-circle'></i> $ghr </div>"; ?>
              <div class="col-md-6 form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="uname" placeholder="username" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="email" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="pass1" placeholder="password" required />
              </div>
              <div class="col-md-6 form-group">
                <label>Retype password</label>
                <input type="password" class="form-control" name="pass2" placeholder="retype password" required />
              </div>
              <div class="col-md-12 mt-3">
                <div class="form-group">
                  <input type="submit" value="Submit" class="btn btn-primary py-3 px-5" />
                </div>
              </div>
            </div>
          </form>
          <?php if (isset($error)) echo "<p>$error</p>"; ?>
        </div>
      </div>
    </div>
  </section>
  <!-- Form -->

  <?php require_once '../php/loader.php' ?>
  <?php require_once '../php/scripts.php' ?>

  </body>

</html>