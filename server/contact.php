<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gallery Cafe - Contact</title>
  <?php require_once '../php/styles.php' ?>
  <style>
    iframe {
      width: 100%;
      height: 100%;
    }
  </style>
</head>

<body>
  <nav>
    <a href="home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <?php navigation(5) ?>
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

  <?php top("Contact", "Contact Us") ?>

  <section class="ftco-section contact-section bg-light">
    <div class="container">
      <div class="row d-flex mb-5 contact-info">
        <div class="col-md-12 mb-4">
          <h2 class="h4 font-weight-bold">Contact Information</h2>
        </div>
        <div class="w-100"></div>
        <div class="col-md-3 d-flex">
          <div class="dbox">
            <p>
              <span>Address:</span> 198 West 21th Street, Suite 721 New York
              NY 10016
            </p>
          </div>
        </div>
        <div class="col-md-3 d-flex">
          <div class="dbox">
            <p>
              <span>Phone:</span>
              <a href="tel://1234567920">+ 1235 2355 98</a>
            </p>
          </div>
        </div>
        <div class="col-md-3 d-flex">
          <div class="dbox">
            <p>
              <span>Email:</span>
              <a href="mailto:info@yoursite.com">info@yoursite.com</a>
            </p>
          </div>
        </div>
        <div class="col-md-3 d-flex">
          <div class="dbox">
            <p><span>Website</span> <a href="#">yoursite.com</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-no-pt ftco-no-pb contact-section" style="margin-bottom: 100px; margin-top: 120px;">
    <div class="container">
      <div class="row d-flex align-items-stretch no-gutters">
        <div class="col-md-6 p-5 order-md-last">
          <h2 class="h4 mb-5 font-weight-bold">Contact Us</h2>
          <form action="#">
            <div class="form-group">
              <input
                type="text" class="form-control" placeholder="Your Name" />
            </div>
            <div class="form-group">
              <input
                type="text" class="form-control" placeholder="Your Email" />
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Subject" />
            </div>
            <div class="form-group">
              <textarea
                name=""
                id=""
                cols="30"
                rows="7"
                class="form-control"
                placeholder="Message"></textarea>
            </div>
            <div class="form-group">
              <input
                type="submit" value="Send Message" class="btn btn-primary py-3 px-5" />
            </div>
          </form>
        </div>
        <div class="col-md-6 d-flex align-items-stretch">
          <div id="map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.3360579683635!2d80.5448239109769!3d5.948344794011319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae138d46853166b%3A0x3e9af2010e6917a8!2zTWF0YXJhIEJvZGhpeWEgLSDgtrjgt4_gtq3gtrsg4La24Led4Law4LeS4La6ICjgrq7grr7grqTgrr7grrDgrr4g4K6q4K-LIOCuruCusOCuruCvjSk!5e0!3m2!1sen!2slk!4v1703309236816!5m2!1sen!2slk"
              width="600"
              height="450"
              style="border: 0"
              allowfullscreen="true"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require '../php/feature.php' ?>
</body>

</html>