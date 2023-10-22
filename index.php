<?php
session_start();
if (isset($_SESSION["id"])) {
    if ($_SESSION["type"] == "customer") {
        header('Location: customer/home.php');
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

<body>
    <div>
        <h1>ยินดีต้อนรับสู่ Online Food Delivery !</h1>
        <a href="customer/login.php">เข้าสู่ระบบลูกค้า</a><br>
        <a href="restaurant/login.php">เข้าสู่ระบบร้านอาหาร</a><br>
        <a href="rider/login.php">เข้าสู่ระบบผู้ส่งอาหาร</a><br>
        <a href="admin/login.php">เข้าสู่ระบบผู้ดูแลระบบ</a>
    </div>
</body>

</html>