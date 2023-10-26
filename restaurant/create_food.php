<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["name"])) {
    $restaurant_id = $_SESSION["id"];
    $name = $_POST["name"];
    $detail = $_POST["detail"];

    $sql = "SELECT * FROM food WHERE name = '$name' AND restaurant_id = '$restaurant_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script>alert('รายการอาหารนี้มีอยู่แล้ว')</script>";
    } else {
        $target_dir = "images/"; //โฟลเดอร์ที่เก็บไฟล์รูป
        $target_file = $target_dir . basename($_FILES["image"]["name"]); //ไฟล์รูปที่อัปโหลด
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //นามสกุลไฟล์รูป
        $image = $target_dir . $restaurant_id . "_" . $name . "." . $imageFileType; //ไฟล์รูปที่จะเก็บลงในฐานข้อมูล
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) { //อัปโหลดไฟล์รูป
            $sql = "INSERT INTO food (restaurant_id, name, detail, image) VALUES ('$restaurant_id', '$name', '$detail', '$image')";
            $result = $conn->query($sql);
            if ($result === TRUE) {
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
        } else {
            echo "<script>alert('อัปโหลดรูปไม่สำเร็จ')</script>";
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
    <form action="create_food.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="name">ชื่อรายการอาหาร:</label>
            <input type="text" name="name" id="name" required>
        </p>
        <p>
            <label for="detail">รายละเอียด:</label>
            <textarea type="text" name="detail" id="detail" required></textarea>
        </p>
        <p>
            <label for="price">ราคา:</label>
            <input type="number" name="price" id="price" required>
        </p>
        <p>
            <label for="food_category">หมวดหมู่อาหาร</label>
            <select name="food_category" id="food_category" required>
                <?php
                $sql = "SELECT * FROM food_category WHERE restaurant_id = '" . $_SESSION["id"] . "'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                }
                ?>
            </select>
        </p>
        <p>
            <label for="image">ภาพอาหาร</label>
            <input type="file" name="image" id="image" required>
        </p>
        <button type="submit">เพิ่ม</button>
    </form>
</body>

</html>