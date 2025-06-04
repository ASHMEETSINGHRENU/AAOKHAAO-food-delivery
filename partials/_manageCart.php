<?php
include '_dbconnect.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    if(isset($_POST['addToCart'])) {
        $itemId = $_POST["itemId"];
        $quant = (!empty($_POST["quant"]));
        // Check whether this item exists
        $existSql = "SELECT * FROM `tbl_viewcart` WHERE foodId = '$itemId' AND `userId`='$userId'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo "<script> 
                    alert('Item Already Added.');
                    window.location.href = 'http://localhost/food-ordering-system/index.php';
                    </script>";
        }
        else if($quant!=0){
            $sql = "INSERT INTO `tbl_viewcart` (`foodId`, `itemQuantity`, `userId`, `addedDate`) VALUES ('$itemId', '$quant', '$userId', current_timestamp())";   
            $result = mysqli_query($conn, $sql);
            if ($result){
                echo "<script>
                    window.location.href = 'http://localhost/food-ordering-system/index.php';
                    </script>";
            }
        }
        else {
            $sql = "INSERT INTO `tbl_viewcart` (`foodId`, `itemQuantity`, `userId`, `addedDate`) VALUES ('$itemId', 1, '$userId', current_timestamp())";   
            $result = mysqli_query($conn, $sql);
            if ($result){
                echo "<script>
                    window.location.href = 'http://localhost/food-ordering-system/index.php';
                    </script>";
            }
        }
    }
    if(isset($_POST['removeItem'])) {
        $itemId = $_POST["itemId"];
        $sql = "DELETE FROM `tbl_viewcart` WHERE `foodId`='$itemId' AND `userId`='$userId'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed.');
window.location.href = 'http://localhost/food-ordering-system/viewCart.php';
            </script>";
    }
    if(isset($_POST['removeAllItem'])) {
        $sql = "DELETE FROM `tbl_viewcart` WHERE `userId`='$userId'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed All.');
window.location.href = 'http://localhost/food-ordering-system/viewCart.php';
            </script>";
    }
    if(isset($_POST['checkout'])) {
        $amount = $_POST["amount"];
        $address1 = $_POST["address"];
        $address2 = $_POST["address1"];
        $phone = $_POST["phone"];
        $zipcode = $_POST["zipcode"];
        $password = $_POST["password"];
        $address = $address1.", ".$address2;
        
        $passSql = "SELECT * FROM tbl_users WHERE id='$userId'"; 
        $passResult = mysqli_query($conn, $passSql);
        $passRow=mysqli_fetch_assoc($passResult);
        $userName = $passRow['username'];
        if (password_verify($password, $passRow['password'])){ 
            $sql = "INSERT INTO `tbl_orders` (`userId`, `address`, `zipCode`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`) VALUES ('$userId', '$address', '$zipcode', '$phone', '$amount', '0', '0', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $orderId = $conn->insert_id;
            if ($result){
                $addSql = "SELECT * FROM `tbl_viewcart` WHERE userId='$userId'"; 
                $addResult = mysqli_query($conn, $addSql);
                while($addrow = mysqli_fetch_assoc($addResult)){
                    $foodId = $addrow['foodId'];
                    $itemQuantity = $addrow['itemQuantity'];
                    $itemSql = "INSERT INTO `tbl_orderitems` (`orderId`, `foodId`, `itemQuantity`) VALUES ('$orderId', '$foodId', '$itemQuantity')";
                    $itemResult = mysqli_query($conn, $itemSql);
                }
                $deletesql = "DELETE FROM `tbl_viewcart` WHERE `userId`='$userId'";   
                $deleteresult = mysqli_query($conn, $deletesql);
                echo '<script>alert("Thanks for ordering with us. Your order id is ' .$orderId. '.");
                    window.location.href="http://localhost/food-ordering-system/index.php";  
                    </script>';
                    exit();
            }
        } 
        else{
            echo '<script>alert("Incorrect Password! Please enter correct Password.");
                    window.history.back();
                    </script>';
                    exit();
        }    
    }
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        $foodId = $_POST['foodId'];
        $qty = $_POST['quantity'];
        $updatesql = "UPDATE `tbl_viewcart` SET `itemQuantity`='$qty' WHERE `foodId`='$foodId' AND `userId`='$userId'";
        $updateresult = mysqli_query($conn, $updatesql);
    }
    
}
?>