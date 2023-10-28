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
    <title>ข้อมูลส่วนตัว</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>ข้อมูลส่วนตัว</h1>
    <?php
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM admin WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    $username = $row["username"];
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $phone = $row["phone"];
    $email = $row["email"];

    echo "
    <p>Username: $username</p>
    <p>ชื่อ: $firstname</p>
    <p>นามสกุล: $lastname</p>
    <p>เบอร์โทรศัพท์: $phone</p>
    <p>อีเมล: $email</p>
    ";

    $conn->close();
    ?>
    <a href="edit_profile.php"><button>แก้ไขข้อมูล</button></a>
    <a href="edit_password.php"><button>เปลี่ยนรหัสผ่าน</button></a>
</body>

</html>