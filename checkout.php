<?php

session_start();

include "database.php";

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$total = 0;

foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

if (isset($_POST['checkout'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $sql = "INSERT INTO orders
            (customer_name, phone, address, total)
            VALUES
            ('$name', '$phone', '$address', '$total')";

    if (mysqli_query($conn, $sql)) {

        $_SESSION['cart'] = [];

        header("Location: order-sucess.php");
        exit;

    } else {

        $error = "Order failed: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Checkout - GlowCare</title>

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

<div class="form-box">

    <h2>Checkout</h2>

    <?php if (isset($error)) { ?>

        <div class="alert-error">
            <?php echo $error; ?>
        </div>

    <?php } ?>

    <p>
        <strong>Total Amount:</strong>
        ₹<?php echo number_format($total, 2); ?>
    </p>

    <form method="POST">

        <div class="form-group">

            <label>Full Name</label>

            <input
                type="text"
                name="name"
                required
            >

        </div>

        <div class="form-group">

            <label>Phone Number</label>

            <input
                type="tel"
                name="phone"
                required
            >

        </div>

        <div class="form-group">

            <label>Address</label>

            <textarea
                name="address"
                rows="5"
                required
            ></textarea>

        </div>

        <button
            type="submit"
            name="checkout"
            class="btn"
        >
            Place Order
        </button>

    </form>

</div>

</body>

</html>