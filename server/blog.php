<!DOCTYPE html>
<html lang="en">

<head>
  <title>Galey Cafe - Blog</title>
  <?php require_once '../php/styles.php' ?>
</head>

<body>
  <nav>
    <a href="home.php" class="brand"> Gallery Cafe </a>
    <div>
      <ul id="navbar">
        <?php navigation(4) ?>
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

  <?php top("Blog", "Stories") ?>

  <section class="ftco-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-4 ftco-animate">
          <div class="blog-entry">
            <a
              href="blog-single.html"
              class="block-20"
              style="background-image: url('../images/image_1.jpg')">
            </a>
            <div class="text px-4 pt-3 pb-4">
              <div class="meta">
                <div><a href="#">Feb 4, 2019</a></div>
                <div><a href="#">Admin</a></div>
              </div>
              <h3 class="heading">
                <a href="#">Even the all-powerful Pointing has no control about the
                  blind texts</a>
              </h3>
              <p class="clearfix">
                <a href="#" class="float-left read">Read more</a>
                <a href="#" class="float-right meta-chat"><span class="icon-chat"></span> 3</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 ftco-animate">
          <div class="blog-entry">
            <a
              href="blog-single.html"
              class="block-20"
              style="background-image: url('../images/image_2.jpg')">
            </a>
            <div class="text px-4 pt-3 pb-4">
              <div class="meta">
                <div><a href="#">Feb 4, 2019</a></div>
                <div><a href="#">Admin</a></div>
              </div>
              <h3 class="heading">
                <a href="#">Even the all-powerful Pointing has no control about the
                  blind texts</a>
              </h3>
              <p class="clearfix">
                <a href="#" class="float-left read">Read more</a>
                <a href="#" class="float-right meta-chat"><span class="icon-chat"></span> 3</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 ftco-animate">
          <div class="blog-entry">
            <a
              href="blog-single.html"
              class="block-20"
              style="background-image: url('../images/image_3.jpg')">
            </a>
            <div class="text px-4 pt-3 pb-4">
              <div class="meta">
                <div><a href="#">Feb 4, 2019</a></div>
                <div><a href="#">Admin</a></div>
              </div>
              <h3 class="heading">
                <a href="#">Even the all-powerful Pointing has no control about the
                  blind texts</a>
              </h3>
              <p class="clearfix">
                <a href="#" class="float-left read">Read more</a>
                <a href="#" class="float-right meta-chat"><span class="icon-chat"></span> 3</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 ftco-animate">
          <div class="blog-entry">
            <a
              href="blog-single.html"
              class="block-20"
              style="background-image: url('../images/image_4.jpg')">
            </a>
            <div class="text px-4 pt-3 pb-4">
              <div class="meta">
                <div><a href="#">Feb 4, 2019</a></div>
                <div><a href="#">Admin</a></div>
              </div>
              <h3 class="heading">
                <a href="#">Even the all-powerful Pointing has no control about the
                  blind texts</a>
              </h3>
              <p class="clearfix">
                <a href="#" class="float-left read">Read more</a>
                <a href="#" class="float-right meta-chat"><span class="icon-chat"></span> 3</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 ftco-animate">
          <div class="blog-entry">
            <a
              href="blog-single.html"
              class="block-20"
              style="background-image: url('../images/image_5.jpg')">
            </a>
            <div class="text px-4 pt-3 pb-4">
              <div class="meta">
                <div><a href="#">Feb 4, 2019</a></div>
                <div><a href="#">Admin</a></div>
              </div>
              <h3 class="heading">
                <a href="#">Even the all-powerful Pointing has no control about the
                  blind texts</a>
              </h3>
              <p class="clearfix">
                <a href="#" class="float-left read">Read more</a>
                <a href="#" class="float-right meta-chat"><span class="icon-chat"></span> 3</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 ftco-animate">
          <div class="blog-entry">
            <a
              href="blog-single.html"
              class="block-20"
              style="background-image: url('../images/image_6.jpg')">
            </a>
            <div class="text px-4 pt-3 pb-4">
              <div class="meta">
                <div><a href="#">Feb 4, 2019</a></div>
                <div><a href="#">Admin</a></div>
              </div>
              <h3 class="heading">
                <a href="#">Even the all-powerful Pointing has no control about the
                  blind texts</a>
              </h3>
              <p class="clearfix">
                <a href="#" class="float-left read">Read more</a>
                <a href="#" class="float-right meta-chat"><span class="icon-chat"></span> 3</a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row no-gutters my-5">
        <div class="col text-center">
          <div class="block-27">
            <ul>
              <li><a href="#">&lt;</a></li>
              <li class="active"><span>1</span></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&gt;</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require '../php/feature.php' ?>
</body>

</html>