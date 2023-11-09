<?php
session_start();
if (isset($_SESSION["id"])) {
    if ($_SESSION["type"] == "customer") {
        header('Location: customer/index.php');
        exit;
    } else if ($_SESSION["type"] == "restaurant") {
        header('Location: restaurant/home.php');
        exit;
    } else if ($_SESSION["type"] == "rider") {
        header('Location: rider/home.php');
        exit;
    } else if ($_SESSION['type'] == 'admin') {
        header('Location: admin/home.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="bg-dark" data-bs-theme="dark">
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 100vh;">
        <div class="card text-center">
            <div class="card-header">
                <h1 class="mx-5">Welcome to Online Food Delivery !</h1>
            </div>
            <div class="card-body">
                <a href="customer/login.php" class="btn btn-primary btn-lg my-2 w-50">Login to Customer</a><br>
                <a href="restaurant/login.php" class="btn btn-success btn-lg my-2 w-50">Login to Restaurant</a><br>
                <a href="rider/login.php" class="btn btn-warning btn-lg my-2 w-50">Login to Rider</a><br>
                <a href="admin/login.php" class="btn btn-danger btn-lg my-2 w-50">Login to Admin</a>
            </div>
        </div>
    </div>
</body>

</html>