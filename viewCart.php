    <?php 
    require_once 'inner-header.php';
    if($loggedin){
    ?>
    <div class="cart-section mt-150 mb-150">
    <div class="container" id="cont">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="alert alert-info mb-0" style="width: -webkit-fill-available;">
              <strong>Note:</strong> online payment are currently disabled so please choose cash on delivery.
            </div>
            </div>
            <div class="col-lg-8">
                <div class="card wish-list mb-3">
                    <table class="table text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Item Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">

                                    <form action="partials/_manageCart.php" method="POST">
                                        <button name="removeAllItem" class="btn btn-sm btn-outline-danger">Remove All</button>
                                        <input type="hidden" name="userId" value="<?php $userId = $_SESSION['userId']; echo $userId ?>">
                                    </form>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `tbl_viewcart` WHERE `userId`= $userId";
                                $result = mysqli_query($conn, $sql);
                                $counter = 0;
                                $totalPrice = 0;
                                while($row = mysqli_fetch_assoc($result)){
                                    $foodId = $row['foodId'];
                                    $Quantity = $row['itemQuantity'];
                                    $mysql = "SELECT * FROM `tbl_food` WHERE id = $foodId";
                                    $myresult = mysqli_query($conn, $mysql);
                                    $myrow = mysqli_fetch_assoc($myresult);
                                    $item = $myrow['item'];
                                    $price = $myrow['price'];
                                    $total = $price * $Quantity;
                                    $counter++;
                                    $totalPrice = $totalPrice + $total;

        echo '<tr>
                <td>' . $counter . '</td>
                <td>' . $item . '</td>
                <td>' . $price . '</td>
                <td>
                    <form id="frm' . $foodId . '">
                        <input type="hidden" name="foodId" value="' . $foodId . '">
                        <input type="number" name="quantity" value="' . $Quantity . '" class="text-center" onchange="updateCart(' . $foodId . ')" onkeyup="return false" style="width:60px" min=1 max=10 onkeydown="return false" oninput="check(this)" onClick="this.select();">
                    </form>
                </td>
                <td>' . $total . '</td>
                <td>
                    <form action="partials/_manageCart.php" method="POST">
                        <button name="removeItem" class="btn btn-sm btn-outline-danger">Remove</button>
                        <input type="hidden" name="itemId" value="'.$foodId. '">
                    </form>
                </td>
            </tr>';
    }
                                if($counter==0) {
                                    ?><script> document.getElementById("cont").innerHTML = '<div class="col-md-12 my-5"><div class="card"><div class="card-body cart"><div class="col-sm-12 empty-cart-cls text-center"> <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3"><h3><strong> Your cart is hungry! Add some tasty food </strong></h3> <a href="index.php" class="cart-btn cart-btn-transform m-3" data-abc="true"> Continue Order</a> </div></div></div></div>';</script> <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card wish-list mb-3">
                    <div class="pt-4 border bg-light rounded p-3">
                        <h5 class="mb-3 text-uppercase font-weight-bold text-center">Order summary</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 bg-light">Total Price<span>Rs. <?php echo $totalPrice ?></span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-light">Shipping<span>Rs. 0</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3 bg-light">
                                <div>
                                    <strong>The total amount of</strong>
                                    <strong><p class="mb-0">(including Tax & Charge)</p></strong>
                                </div>
                                <span><strong>Rs. <?php echo $totalPrice ?></strong></span>
                            </li>
                        </ul>



                        
<form action="payment.php" method="POST">
    <input type="hidden" name="totalAmount" value="<?php echo $totalPrice; ?>">
    
    <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="COD" checked>
        <label class="form-check-label" for="cod">Cash On Delivery</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentMethod" id="online" value="ONLINE">
        <label class="form-check-label" for="online">Online Payment</label>
    </div><br>
    
    <button type="submit" class="cart-btn btn-block">Go to Check Out</button>
</form>





<!-- 
                        <button type="button" class="cart-btn btn-block" data-toggle="modal" data-target="#checkoutModal">Go to Check Out</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>                             
    <?php 
    }
    else {
        echo '<div class="mt-150 mb-150"> <div class="container">
        <div class="alert alert-info my-3">
            <font style="font-size:22px"><center>Before checkout you need to <strong><a style="color:#f28123"; data-toggle="modal" data-target="#loginModal">Login</a></strong></center></font>
        </div></div></div>';
    }
    ?>
    <?php require 'partials/_checkoutModal.php'; ?>
    <?php require_once 'footer.php' ?>
    
    <script>
        function check(input) {
            if (input.value <= 0) {
                input.value = 1;
            }
        }
        function updateCart(id) {
            $.ajax({
                url: 'partials/_manageCart.php',
                type: 'POST',
                data:$("#frm"+id).serialize(),
                success:function(res) {
                    location.reload();
                } 
            })
        }
    </script>
