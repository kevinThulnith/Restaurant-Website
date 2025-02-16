<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Staff Dashboard</title>
  <?php require_once '../php/styles.php' ?>
  <?php require_once 'core.php' ?>
</head>

<body>
  <nav>
    <a href="dashboard.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <?php navigationStaff(1) ?>
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

  <?php topAdmin("Staff", "Staff Dashboard") ?>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-2">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <h2 class="mb-4">Employee Options</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3 ftco-animate" onclick="window.location.href = 'resavation.php'"">
          <div class=" staff">
          <div class="img" style="background-image: url(../images/opt1.jpg)"></div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 ftco-animate" onclick="window.location.href = 'orders.php'"">
        <div class=" staff">
        <div class="img" style="background-image: url(../images/opt2.jpg)"></div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3 ftco-animate" onclick="window.location.href = 'table.php'"">
        <div class=" staff">
      <div class="img" style="background-image: url(../images/opt3.jpg)"></div>
    </div>
    </div>
    <div class="col-md-6 col-lg-3 ftco-animate" onclick="window.location.href = 'food.php'"">
        <div class=" staff">
      <div class="img" style="background-image: url(../images/opt4.jpg)"></div>
    </div>
    </div>
    </div>
    </div>
  </section>

  <?php require_once '../php/loader.php' ?>
  <?php require_once '../php/scripts.php' ?>
</body>

</html>