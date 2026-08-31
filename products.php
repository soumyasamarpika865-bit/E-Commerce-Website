<?php
include "database.php";

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
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

<section class="products">

    <h2>Our Products</h2>

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

</body>
</html>