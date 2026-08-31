<?php

session_start();

if (!isset($_SESSION['admin'])) {

    header("Location: login.php");
    exit;
}

include "../../../database.php";

$result = mysqli_query(
    $conn,
    "SELECT * FROM products"
);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Admin Dashboard</title>

    <link rel="stylesheet"
          href="../../../style.css">

</head>

<body>

<header>

    <h1>Admin Dashboard</h1>

    <nav>

        <a href="add-product.php">
            Add Product
        </a>

        <a href="logout.php">
            Logout
        </a>

    </nav>

</header>

<div class="products">

    <h2>All Products</h2>

    <a class="btn"
       href="add-product.php">
        Add New Product
    </a>

    <br><br>

    <table border="1"
           cellpadding="10"
           width="100%">

        <tr>

            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>

        </tr>

        <?php while ($product = mysqli_fetch_assoc($result)) { ?>

        <tr>

            <td>
                <?php echo $product['id']; ?>
            </td>

            <td>

                <img
                    src="<?php echo $product['image']; ?>"
                    width="80">

            </td>

            <td>
                <?php echo $product['name']; ?>
            </td>

            <td>
                ₹<?php echo $product['price']; ?>
            </td>

            <td>

                <a href="edit-product.php?id=<?php echo $product['id']; ?>">
                    Edit
                </a>

                |

                <a
                    href="delete-product.php?id=<?php echo $product['id']; ?>"
                    onclick="return confirmDelete()">

                    Delete

                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

<script src="../../../script.js"></script>

</body>
</html>