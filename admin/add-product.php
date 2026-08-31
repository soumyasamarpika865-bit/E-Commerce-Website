<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include "../../../database.php";

if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    $query = "INSERT INTO products
    (name, price, image, description)

    VALUES
    ('$name', '$price', '$image', '$description')";

    mysqli_query($conn, $query);

    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Add Product</title>

    <link rel="stylesheet"
          href="../../../style.css">

</head>

<body>

<div class="form-box">

    <h2>Add Product</h2>

    <form method="POST">

        <div class="form-group">

            <label>Product Name</label>

            <input type="text"
                   name="name"
                   required>

        </div>

        <div class="form-group">

            <label>Price</label>

            <input type="number"
                   name="price"
                   required>

        </div>

        <div class="form-group">

            <label>Image URL</label>

            <input type="text"
                   name="image"
                   required>

        </div>

        <div class="form-group">

            <label>Description</label>

            <textarea
                name="description"
                required></textarea>

        </div>

        <button type="submit"
                name="add"
                class="btn">

            Add Product

        </button>

    </form>

</div>

</body>
</html>