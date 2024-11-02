<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Verification</title>
  <?php require_once '../php/styles.php' ?>
  <style>
    input {
      min-width: 250px;
    }

    input[type="submit"] {
      min-width: 100px;
      margin-right: 500px
    }
  </style>
</head>

<body style="display: flex;height: 100vh;justify-content: center;align-items: center;">
  <nav>
    <a href="Home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <li><a href="home.php">Home</a></li>
        <li><a href="verification.php" class="active">Verification</a></li>
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

  // mask email
  $user_data = json_decode($_COOKIE['newUser'], true);
  $email = maskEmail($user_data['email']);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $otp = $user_data['otp'];
    if ($code != $otp) $ghr = "Wrong code inserted";
    else {
      if (array_key_exists('name', $user_data))  $sql = "INSERT INTO `user` (`name`, `address`, `dob`, `username`, `password`, `email`, `mobile`,`is_customer`) VALUES ('" . $user_data['name'] . "', '" . $user_data['address'] . "', '" . $user_data['day'] . "', '" . $user_data['uname'] . "', '" . $user_data['password'] . "', '" . $user_data['email'] . "', '" . $user_data['mobile'] . "', '1') ";
      else  $sql = "UPDATE `user` SET `password`='" . $user_data['password'] . "' WHERE `username` = '" . $user_data['uname'] . "' AND `email` = '" . $user_data['email'] . "'; ";

      if ($conn->query($sql)) {
        setcookie("newUser", $newuser_json, time() - 3600, "/");
        header("Location:login.php");
        exit();
      }
    }
  }
  ?>

  <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-5 ftco-animate img img-2 rtt" style="background-image: url(../images/bg_1.jpg);" />
      </div>
      <div class="col-md-7 ftco-animate makereservation p-4 p-md-5">
        <div class="heading-section ftco-animate mb-5">
          <span class="subheading">Email Verification</span>
          <h2 class="mb-4">Enter Code</h2>
          <p>We have sent a 6 digit code to <?php echo $email ?></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="formi" method="post">
          <div class="row">
            <?php if ($ghr)  echo "<div class='message'><i class='fa-solid fa-circle'></i> $ghr </div>"; ?>
            <div class="col-md-6 form-group">
              <input type="text" class="form-control" name="code" pattern="\d+" placeholder="code" maxlength="6" minlength="6" required />
            </div>
            <div class="col-md-12 mt-3">
              <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-primary py-3 px-5" />
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