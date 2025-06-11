<?php
session_start();
include 'db.php';

$cart_items = $_SESSION['cart'] ?? [];

if (isset($_POST['remove'])) {
    unset($_SESSION['cart'][$_POST['item_id']]);
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-success px-3">
    <a class="navbar-brand" href="index.php">Grocery Store</a>
</nav>

<div class="container mt-4">
    <h3>Your Cart</h3>
    <?php if (empty($cart_items)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $total = 0;
                foreach ($cart_items as $id => $qty):
                    $result = $conn->query("SELECT * FROM grocery_items WHERE id=$id");
                    $item = $result->fetch_assoc();
                    $subtotal = $item['price'] * $qty;
                    $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td>Rs <?= $item['price'] ?></td>
                    <td><?= $qty ?></td>
                    <td>Rs <?= $subtotal ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="item_id" value="<?= $id ?>">
                            <button name="remove" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <h5 class="text-end">Total: Rs <?= $total ?></h5>
        <div class="text-end">
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
