<?php

session_start();

include "../database.php";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM admins
         WHERE username='$username'
         AND password='$password'"
    );

    if (mysqli_num_rows($result) == 1) {

        $admin = mysqli_fetch_assoc($result);

        $_SESSION['admin'] = $admin['username'];

        header("Location: dashboard.php");
        exit;

    } else {

        $error = "Invalid username or password";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Admin Login</title>

    <link rel="stylesheet" href="../style.css">

</head>

<body>

<div class="form-box">

    <h2>Admin Login</h2>

    <?php if (isset($error)) { ?>

        <div class="alert-error">
            <?php echo $error; ?>
        </div>

    <?php } ?>

    <form method="POST">

        <div class="form-group">

            <label>Username</label>

            <input type="text"
                   name="username"
                   required>

        </div>

        <div class="form-group">

            <label>Password</label>

            <input type="password"
                   name="password"
                   required>

        </div>

        <button type="submit"
                name="login"
                class="btn">

            Login

        </button>

    </form>

</div>

</body>
</html>