<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../../../database.php";

$id = (int)$_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM products WHERE id=$id"
);

$product = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    mysqli_query(
        $conn,
        "UPDATE products SET
        name='$name',
        price='$price',
        image='$image',
        description='$description'
        WHERE id=$id"
    );

    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Product</title>

    <link rel="stylesheet"
          href="../../../style.css">

</head>

<body>

<div class="form-box">

    <h2>Edit Product</h2>

    <form method="POST">

        <div class="form-group">

            <label>Product Name</label>

            <input type="text"
                   name="name"
                   value="<?php echo $product['name']; ?>"
                   required>

        </div>

        <div class="form-group">

            <label>Price</label>

            <input type="number"
                   name="price"
                   value="<?php echo $product['price']; ?>"
                   required>

        </div>

        <div class="form-group">

            <label>Image URL</label>

            <input type="text"
                   name="image"
                   value="<?php echo $product['image']; ?>"
                   required>

        </div>

        <div class="form-group">

            <label>Description</label>

            <textarea
                name="description"
                required><?php echo $product['description']; ?></textarea>

        </div>

        <button type="submit"
                name="update"
                class="btn">

            Update Product

        </button>

    </form>

</div>

</body>
</html>