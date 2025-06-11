<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    if (!isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id] = 1;
        $added_msg = "Item added to cart.";
    } else {
        $_SESSION['cart'][$item_id]++;
        $added_msg = "Item quantity updated.";
    }
}

$items = $conn->query("SELECT * FROM grocery_items");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-success px-3">
    <a class="navbar-brand" href="#">Grocery Store</a>
    <div class="ms-auto">
        <a href="cart.php" class="btn btn-light">Cart (<?= count($_SESSION['cart']) ?>)</a>
    </div>
</nav>

<div class="container mt-4">
    <?php if (!empty($added_msg)): ?>
        <div class="alert alert-success"><?= $added_msg ?></div>
    <?php endif; ?>

    <div class="row">
        <?php while ($row = $items->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                        <p class="card-text">Price: Rs <?= $row['price'] ?></p>
                        <form method="POST">
                            <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
                            <button type="submit" name="add_to_cart" class="btn btn-success w-100">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
