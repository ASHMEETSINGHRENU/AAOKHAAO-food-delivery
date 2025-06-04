<?php
require_once 'inner-header.php';

$foodId = $_GET['foodid'];
$sql = "SELECT * FROM `tbl_food` WHERE id = $foodId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$foodName = $row['item'];
$foodprice = $row['price'];
$fooddesc = $row['description'];
?> 

<!-- single product -->
<div class="single-product mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="single-product-img">
                    <img src="img/item-<?php echo $foodId; ?>.jpg" alt="">
                </div>
            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <h3><?php echo $foodName; ?></h3>
                    <p class="single-product-pricing">₹ <?php echo $foodprice; ?></p>
                    <p><?php echo $fooddesc; ?></p>

                    <?php
                    if ($loggedin) {
                        $quaSql = "SELECT `itemQuantity` FROM `tbl_viewcart` WHERE foodId = '$foodId' AND `userId`='$userId'";
                        $quaresult = mysqli_query($conn, $quaSql);
                        $quaExistRows = mysqli_num_rows($quaresult);
                        
                        if ($quaExistRows == 0) {
                            echo '<form action="partials/_manageCart.php" method="POST">
                                   
                                                        <input type="number" name="quantity" value="1" min="1" max="10" required style="width: 60px; margin-right: 10px;" onkeydown="return false;">
<br><br>
                                    <input type="hidden" name="itemId" value="' . $foodId . '">
                                    <button type="submit" name="addToCart" class="cart-btn"> Add </button>
                                  </form>';
                        } else {
                            echo '<div class="single-product-form">
                                    <a href="viewCart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Go to Cart</a>
                                  </div>';
                        }
                    } else {
                        echo '<div class="single-product-form">
                                
                        <input type="number" name="quantity" value="1" min="1" max="10" required style="width: 60px; margin-right: 10px;" onkeydown="return false;">

                                <a class="cart-btn" data-toggle="modal" data-target="#loginModal"> Add </a>
                              </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end single product -->
<?php require_once 'footer.php' ?>
