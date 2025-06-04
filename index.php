
<?php
require_once 'header.php';
?>
<!-- hero area -->
<div class="hero-area hero-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 offset-lg-2 text-center">
        <div class="hero-text">
          <div class="hero-text-tablecell">
            <p class="subtitle"> Jo Chaho Jab Chaho AaoKhaao! </p>
            <h1> AaoKhaao </h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end hero area -->

<!-- product section -->
<div class="product-section mt-150 mb-150">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="section-title">
          <h3><span class="orange-text">Our</span> Menu</h3>
        </div>
      </div>
    </div>

    <div class="row">
      <?php
      $sql = "SELECT * FROM tbl_food";
      $result = mysqli_query($conn, $sql);
      $noResult = true;
      while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $foodId = $row['id'];
        $foodName = $row['item'];
        $foodprice = $row['price'];
        $fooddesc = $row['description'];

        echo '<div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                  <div class="product-image">
                    <img src="img/item-' . $foodId . '.jpg" alt="">
                  </div>
                  <h3>' . $foodName . '</h3>
                  <p class="card-text">' . substr($fooddesc, 0, 40) . '...</p>
                  <p class="product-price">₹ ' . $foodprice . '</p>';

        if ($loggedin) {
          $quaSql = "SELECT `itemQuantity` FROM `tbl_viewcart` WHERE foodId = '$foodId' AND `userId`='$userId'";
          $quaresult = mysqli_query($conn, $quaSql);
          $quaExistRows = mysqli_num_rows($quaresult);

          if ($quaExistRows == 0) {
            echo '<form action="partials/_manageCart.php" method="POST" style="margin-left: 47px; margin-right: -54px; float:left">
                    <input type="hidden" name="itemId" value="' . $foodId . '">
                    <input type="number" name="quantity" value="1" min="1" max="10" required style="width: 60px; margin-right: 10px;" onkeydown="return false;">

                    <button type="submit" name="addToCart" class="cart-btn"> Add </button>
                  </form>';
          } else {
            echo '<a href="viewCart.php" class="cart-btn"> Proceed </a>';
          }
        } else {
          echo '<a class="cart-btn" data-toggle="modal" data-target="#loginModal"> Add </a>';
        }

        echo '<a href="viewitem.php?foodid=' . $foodId . '" class="cart-btn"> View</a>
              </div>
            </div>';
      }

      if ($noResult) {
        echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <p class="display-4">Sorry In this category No items available.</p>
                  <p class="lead"> We will update Soon.</p>
                </div>
              </div>';
      }
      ?>
    </div>
  </div>
</div>

<!-- features list section -->
<div class="list-section pt-80 pb-80">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <div class="list-box d-flex align-items-center">
          <div class="list-icon">
            <i class="fas fa-shipping-fast"></i>
          </div>
          <div class="content">
            <h3>Free Shipping</h3>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <div class="list-box d-flex align-items-center">
          <div class="list-icon">
            <i class="fas fa-phone-volume"></i>
          </div>
          <div class="content">
            <h3>24/7 Support</h3>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="list-box d-flex justify-content-start align-items-center">
          <div class="list-icon">
            <i class="fas fa-sync"></i>
          </div>
          <div class="content">
            <h3>Refund</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'footer.php'; ?>
