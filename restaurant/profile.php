<?php
include("../db_connect.php");
session_start();

if (isset($_SESSION["type"]) != "restaurant") {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลร้านอาหาร</title>
</head>

<body>
    <nav>
        <a href="home.php">หน้าแรก</a>
        <a href="profile.php">ข้อมูลร้านอาหาร</a>
        <a href="../logout.php">ออกจากระบบ</a>
    </nav>
    <h1>ข้อมูลร้านอาหาร</h1>
    <?php
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM restaurant WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo "<img src='" . $row["image"] . "' width='200'>";
    echo "<p>Username: " . $row["username"] . "</p>";
    echo "<p>ชื่อ: " . $row["firstname"] . "</p>";
    echo "<p>นามสกุล: " . $row["lastname"] . "</p>";
    echo "<p>เบอร์โทรศัพท์: " . $row["phone"] . "</p>";
    echo "<p>อีเมล: " . $row["email"] . "</p>";
    echo "<p>ที่อยู่: " . $row["address"] . "</p>";
    echo "<p>ชื่อร้าน: " . $row["restaurant_name"] . "</p>";
    echo "<p>ประเภทร้าน: " . $row["restaurant_type"] . "</p>";
    echo "<p>สถานะร้าน: " . $row["status"] . " </p>"
    ?>
    <a href="edit_profile.php"><button>แก้ไขข้อมูล</button></a>
    <a href="edit_password.php"><button>เปลี่ยนรหัสผ่าน</button></a>
</body>

</html>