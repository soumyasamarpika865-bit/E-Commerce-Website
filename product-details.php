<?php

session_start();
include "database.php";

$id = (int)$_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM products WHERE id = $id"
);

$product = mysqli_fetch_assoc($result);

if (!$product) {
    die("Product not found");
}

if (isset($_POST['add_cart'])) {

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {

        $_SESSION['cart'][$id] = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => 1
        ];
    }

    header("Location: cart.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>GlowCare</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="cart.php">Cart</a>
    </nav>
</header>

<div class="details">

    <img src="images/<?php echo $product['image']; ?>">

    <div>

        <h2><?php echo $product['name']; ?></h2>

        <h3>₹<?php echo $product['price']; ?></h3>

        <p><?php echo $product['description']; ?></p>

        <form method="POST">

            <button class="btn"
                    type="submit"
                    name="add_cart">
                Add to Cart
            </button>

        </form>

    </div>

</div>

</body>
</html>