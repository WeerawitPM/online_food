<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $detail = $_POST["detail"];

    $sql = "SELECT * FROM food WHERE name = '$name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script>alert('รายการอาหารนี้มีอยู่แล้ว')</script>";
    } else {
        $sql = "INSERT INTO food (name) VALUES ('$name')";
        if ($conn->query($sql) === TRUE) {
            echo "
                <script>
                    alert('เพิ่มรายการอาหารสำเร็จ');
                    window.location = 'create_food.php';
                </script>
            ";
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สร้างรายการอาหาร</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>สร้างรายการอาหาร</h1>
    <form action="create_food.php" method="post">
        <p>
            <label for="name">ชื่อรายการอาหาร:</label>
            <input type="text" name="name" id="name" required>
        </p>
        <p>
            <label for="detail">รายละเอียด:</label>
            <textarea type="text" name="detail" id="detail" required></textarea>
        </p>
        <p>
            <label for="image">ภาพอาหาร</label>
            <input type="file" name="image" id="image" required>
        </p>
        <button type="submit">เพิ่ม</button>
    </form>
</body>

</html>