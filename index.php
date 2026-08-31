<?php
include "database.php";

$result = mysqli_query($conn, "SELECT * FROM products LIMIT 3");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Skincare Shop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>GlowCare</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="cart.php">Cart</a>
        <a href="configure/user/admin/login.php">Admin</a>
    </nav>
</header>

<section class="hero">
    <h2>Healthy Skin, Happy You</h2>
    <p>Discover premium skincare products for your daily routine.</p>

    <a class="btn" href="products.php">Shop Now</a>
</section>

<section class="products">
    <h2>Featured Products</h2>

    <div class="product-grid">

        <?php while ($product = mysqli_fetch_assoc($result)) { ?>

            <div class="product-card">

                <img src="images/<?php echo $product['image']; ?>">

                <h3><?php echo $product['name']; ?></h3>

                <p>₹<?php echo $product['price']; ?></p>

                <a class="btn"
                   href="product-details.php?id=<?php echo $product['id']; ?>">
                    View Product
                </a>

            </div>

        <?php } ?>

    </div>
</section>

<footer>
    <p>© 2026 GlowCare Skincare Shop</p>
</footer>

</body>
</html>