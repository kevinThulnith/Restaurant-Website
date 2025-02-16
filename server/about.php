<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - About</title>
  <?php require_once '../php/styles.php' ?>
</head>

<body>
  <nav>
    <a href="home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <?php navigation(2) ?>
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

  <?php top("About", "About") ?>
  <?php require_once '../php/welcome.php' ?>
  <?php require_once '../php/numbers.php' ?>

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
                <p>
                  I am an ambitious workaholic, but apart from that, pretty
                  simple person.
                </p>
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
                <p>
                  I am an ambitious workaholic, but apart from that, pretty
                  simple person.
                </p>
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
                <p>
                  I am an ambitious workaholic, but apart from that, pretty
                  simple person.
                </p>
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
                <p>
                  I am an ambitious workaholic, but apart from that, pretty
                  simple person.
                </p>
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

  <?php require_once '../php/review.php' ?>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-2">
        <div class="col-md-7 text-center heading-section ftco-animate">
          <span class="subheading">More Healthy Foods</span>
          <h2 class="mb-4">We Love Healthy and Natural Foods</h2>
          <p>
            A small river named Duden flows by their place and supplies it
            with the necessary regelialia. It is a paradisematic country, in
            which roasted parts of sentences fly into your mouth.
          </p>
          <p>
            <a href="reservation.php" class="btn btn-primary px-4 py-3">Book A Table</a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <?php require '../php/feature.php' ?>
</body>

</html>