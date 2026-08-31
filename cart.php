<?php

session_start();

if (isset($_GET['remove'])) {

    $id = $_GET['remove'];

    unset($_SESSION['cart'][$id]);

    header("Location: cart.php");
    exit;
}

$cart = $_SESSION['cart'] ?? [];

$total = 0;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>GlowCare</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
    </nav>
</header>

<div class="cart">

    <h2>Your Cart</h2>

    <?php if (empty($cart)) { ?>

        <p>Your cart is empty.</p>

    <?php } else { ?>

        <?php foreach ($cart as $item) {

            $subtotal =
                $item['price'] * $item['quantity'];

            $total += $subtotal;

        ?>

            <div class="cart-item">

                <img src="images/<?php echo $item['image']; ?>">

                <div>

                    <h3><?php echo $item['name']; ?></h3>

                    <p>₹<?php echo $item['price']; ?></p>

                    <p>
                        Quantity:
                        <?php echo $item['quantity']; ?>
                    </p>

                    <a href="cart.php?remove=<?php echo $item['id']; ?>">
                        Remove
                    </a>

                </div>

            </div>

        <?php } ?>

        <h2>Total: ₹<?php echo $total; ?></h2>

        <a class="btn" href="checkout.php">
            Proceed to Checkout
        </a>

    <?php } ?>

</div>

</body>
</html>