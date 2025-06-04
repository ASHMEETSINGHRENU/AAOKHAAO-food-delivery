<?php
session_start();
require_once 'partials/_dbconnect.php'; // assuming your DB connection is here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentMethod = $_POST['paymentMethod'];
    $totalAmount = $_POST['totalAmount'];

    // Store in session if needed
    $_SESSION['paymentMethod'] = $paymentMethod;
    $_SESSION['totalAmount'] = $totalAmount;

    if ($paymentMethod === 'COD') {
        // Redirect to place order script
        header("Location: place_order_cod.php");
        exit();
    } elseif ($paymentMethod === 'ONLINE') {
        // Proceed with online payment gateway integration
    } else {
        echo "Invalid payment method selected.";
        exit();
    }
} else {
    echo "Invalid access.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Payment</title>
    <?php require 'inner-header.php'; ?>
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4 shadow-lg">
            <h3 class="text-center mb-4">Proceed to Online Payment</h3>
            <p class="text-center">You're about to pay <strong>Rs. <?php echo htmlspecialchars($totalAmount); ?></strong> online.</p>

            <form action="razorpay_initiate.php" method="POST">
                <input type="hidden" name="amount" value="<?php echo htmlspecialchars($totalAmount); ?>">
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Pay Now</button>
                    <a href="viewCart.php" class="btn btn-secondary ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
