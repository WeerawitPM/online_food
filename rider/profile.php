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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>ข้อมูลส่วนตัว</title>
</head>

<body data-bs-theme="dark">
    <?php include("navbar.php"); ?>
    <h1>ข้อมูลส่วนตัว</h1>
    <?php
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM rider WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo "<img src='" . $row["image"] . "' width='200'>";
    echo "<p>Username: " . $row["username"] . "</p>";
    echo "<p>ชื่อ: " . $row["firstname"] . "</p>";
    echo "<p>นามสกุล: " . $row["lastname"] . "</p>";
    echo "<p>เบอร์โทรศัพท์: " . $row["phone"] . "</p>";
    echo "<p>อีเมล: " . $row["email"] . "</p>";
    echo "<p>ที่อยู่: " . $row["address"] . "</p>";
    echo "<p>ทะเบียนรถ: " . $row["car_no"] . "</p>";
    echo "<p>สถานะ: " . $row["status"] . "</p>";
    ?>
    <a href="edit_profile.php"><button>แก้ไขข้อมูล</button></a>
    <a href="edit_password.php"><button>เปลี่ยนรหัสผ่าน</button></a>
</body>

</html>