<?php
session_start();
$_SESSION['cart'] = []; // Clear the cart after checkout
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout Complete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-center d-flex justify-content-center align-items-center vh-100">
    <div class="card p-5 shadow">
        <h2>✅ Thank you for your purchase!</h2>
        <p>Your order has been placed.</p>
        <a href="index.php" class="btn btn-success mt-3">Continue Shopping</a>
    </div>
</body>
</html>
