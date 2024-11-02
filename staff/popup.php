<div class="contrt hide">
  <div class="menu-box">
    <div class="xmark"><i class="fa-solid fa-xmark"></i></div>
    <div
      class="image"
      style="background-image: url(images/breakfast-1.jpg)"></div>
    <div class="text">
      <h1>Grilled Beef with potatoes</h1>
      <p>
        <span>Italien</span>
      </p>
      <h3 style="font-size: 17px">$29.00/=</h3>
      <div class="rating">
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
      </div>
      <div class="bar">
        <div class="cart">
          <button id="plsBtt">
            <i class="fa-solid fa-plus"></i>
          </button>
          <input type="text" name="noi" id="noi" value="1" readonly />
          <button id="mnsBtt">
            <i class="fa-solid fa-minus"></i>
          </button>
        </div>
        <form action="cartAdd.php" method="post">
          <input type="hidden" name="item_id" id="form-id" value="1" />
          <input type="hidden" name="item_name" id="form-name" value="1" />
          <input type="hidden" name="num_of_itms" id="form-noi" value="1" />
          <input
            type="hidden"
            name="item_price"
            id="form-price"
            value="1" />
          <button id="cart" type="submit">
            <i class="fa-solid fa-plus"></i>
            Select item
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End pop up -->

<?php
// Check if the user is logged in (true or false)
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>

<script>
  // Get the login status from the PHP session
  var isLoggedIn = <?php echo json_encode($logged_in); ?>;

  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('cart').addEventListener('click', function() {
      event.preventDefault();
      if (!isLoggedIn) {
        alert("Login or singup to use this feature"); // Show alert
        window.location.href = 'login.php'; // redirect to login
      } else {
        var form = this.closest('form')
        var formData = new FormData(form)
        fetch("cartAdd.php", {
            method: 'post',
            body: formData
          })
          .then(response => response.text())
          .then(data => alert('Menu item added to cart!'))
          .catch(error => console.error('Error:', error));
      }
    });
  });
</script>