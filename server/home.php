<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Home</title>
  <?php require_once '../php/styles.php' ?>
</head>

<body>
  <nav>
    <a href="home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <?php navigation(1) ?>
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
  <!-- End pop up -->

  <section class="home-slider js-fullheight owl-carousel bg-white">
    <div class="slider-item js-fullheight">
      <div class="overlay"></div>
      <div class="container-fluid p-0">
        <div
          class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end"
          data-scrollax-parent="true">
          <div
            class="one-third order-md-last img js-fullheight"
            style="background-image: url(../images/bg_3.jpg)">
            <div class="overlay"></div>
          </div>
          <div
            class="one-forth d-flex js-fullheight align-items-center ftco-animate"
            data-scrollax=" properties: { translateY: '70%' }">
            <div class="text mt-md-5">
              <h1 class="mb-4">
                Eat Healthy <br />
                and Natural Foods
              </h1>
              <p>
                A small river named Duden flows by their place and supplies it
                with the necessary regelialia. It is a paradisematic country.
              </p>
              <div class="thumb mt-4 mb-3 d-flex">
                <a href="#" class="thumb-menu pr-md-4 text-center">
                  <div
                    class="img"
                    style="background-image: url(../images/menu-1.jpg)"></div>
                  <h4>Australian Organic Beef</h4>
                </a>
                <a href="#" class="thumb-menu pr-md-4 text-center">
                  <div
                    class="img"
                    style="background-image: url(../images/menu-2.jpg)"></div>
                  <h4>Australian Organic Beef</h4>
                </a>
                <a href="#" class="thumb-menu pr-md-4 text-center">
                  <div
                    class="img"
                    style="background-image: url(../images/menu-3.jpg)"></div>
                  <h4>Australian Organic Beef</h4>
                </a>
              </div>
              <p>
                <?php echo (!isset($_SESSION['username'])) ? "<a href='login.php' class='btn btn-primary px-4 py-3 mt-3'>Login</a>" : "<a href='cart.php' class='btn btn-primary px-4 py-3 mt-3'>Make a order</a>"; ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="slider-item js-fullheight">
      <div class="overlay"></div>
      <div class="container-fluid p-0">
        <div
          class="row d-flex no-gutters slider-text js-fullheight align-items-center justify-content-end"
          data-scrollax-parent="true">
          <div
            class="one-third order-md-last img js-fullheight"
            style="background-image: url(../images/bg_2.jpg)">
            <div class="overlay"></div>
          </div>
          <div
            class="one-forth d-flex js-fullheight align-items-center ftco-animate"
            data-scrollax=" properties: { translateY: '70%' }">
            <div class="text mt-md-5">
              <h1 class="mb-4">
                We Love <br />
                Delicious Foods
              </h1>
              <p>
                A small river named Duden flows by their place and supplies it
                with the necessary regelialia. It is a paradisematic country.
              </p>
              <div class="thumb mt-4 mb-3 d-flex">
                <a href="#" class="thumb-menu pr-md-4 text-center">
                  <div
                    class="img"
                    style="background-image: url(../images/menu-1.jpg)"></div>
                  <h4>Australian Organic Beef</h4>
                </a>
                <a href="#" class="thumb-menu pr-md-4 text-center">
                  <div
                    class="img"
                    style="background-image: url(../images/menu-2.jpg)"></div>
                  <h4>Australian Organic Beef</h4>
                </a>
                <a href="#" class="thumb-menu pr-md-4 text-center">
                  <div
                    class="img"
                    style="background-image: url(../images/menu-3.jpg)"></div>
                  <h4>Australian Organic Beef</h4>
                </a>
              </div>
              <p>
                <?php echo (!isset($_SESSION['username'])) ? "<a href='singUp.php' class='btn btn-primary px-4 py-3 mt-3'>Sing up</a>" : "<a href='reservation.php' class='btn btn-primary px-4 py-3 mt-3'>Make a Reservation</a>"; ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require_once '../php/welcome.php' ?>
  <?php require_once '../php/numbers.php' ?>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-2">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <span class="subheading">Specialties</span>
          <h2 class="mb-4">Our Menu</h2>
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
          $result = $conn->query("SELECT * FROM food WHERE `food_sts` > 0 AND food_type = '" . $row1['type_Id'] . "' LIMIT 3;");
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
          <p><a href="menu.php" class="btn btn-black py-3 px-5">View All Menu</a></p>
        </div>
      </div>
    </div>
  </section>

  <?php require_once '../php/review.php' ?>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-2">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <span class="subheading">Chef</span>
          <h2 class="mb-4">Our Mater Chef</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3 ftco-animate">
          <div class="staff">
            <div
              class="img"
              style="background-image: url(../images/chef-4.jpg)"></div>
            <div class="text px-4 pt-4">
              <h3>John Smooth</h3>
              <span class="position mb-2">CEO, Co Founder</span>
              <div class="faded">
                <!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
                <ul class="ftco-social d-flex">
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-google-plus"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 ftco-animate">
          <div class="staff">
            <div
              class="img"
              style="background-image: url(../images/chef-2.jpg)"></div>
            <div class="text px-4 pt-4">
              <h3>Rebeca Welson</h3>
              <span class="position mb-2">Head Chef</span>
              <div class="faded">
                <!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
                <ul class="ftco-social d-flex">
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-google-plus"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 ftco-animate">
          <div class="staff">
            <div
              class="img"
              style="background-image: url(../images/chef-3.jpg)"></div>
            <div class="text px-4 pt-4">
              <h3>Kharl Branyt</h3>
              <span class="position mb-2">Chef</span>
              <div class="faded">
                <!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
                <ul class="ftco-social d-flex">
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-google-plus"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 ftco-animate">
          <div class="staff">
            <div
              class="img"
              style="background-image: url(../images/chef-1.jpg)"></div>
            <div class="text px-4 pt-4">
              <h3>Luke Simon</h3>
              <span class="position mb-2">Chef</span>
              <div class="faded">
                <!-- <p>I am an ambitious workaholic, but apart from that, pretty simple person.</p> -->
                <ul class="ftco-social d-flex">
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-twitter"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-facebook"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-google-plus"></span></a>
                  </li>
                  <li class="ftco-animate">
                    <a href="#"><span class="icon-instagram"></span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require_once '../php/feature.php' ?>

</body>

</html>