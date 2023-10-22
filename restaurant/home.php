<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก</title>
</head>

<body>
    <nav>
        <a href="home.php">หน้าแรก</a>
        <a href="profile.php">ข้อมูลร้านอาหาร</a>
        <a href="../logout.php">ออกจากระบบ</a>
    </nav>
</body>

</html>