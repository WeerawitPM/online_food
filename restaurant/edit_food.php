<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

//ข้อมูลรายการอาหารที่ต้องการแก้ไข โดยอ้างอิงจาก id ที่ส่งมา
$food_id = $_GET["id"];
$food = "SELECT * FROM food WHERE id = $food_id";
$food_result = $conn->query($food);
$food_row = $food_result->fetch_assoc();

//ข้อมูลหมวดหมู่อาหาร
$restaurant_id = $_SESSION["id"];
$food_category = "SELECT * FROM food_category WHERE restaurant_id = $restaurant_id";
$food_category_result = $conn->query($food_category);

//เมื่อกดปุ่มบันทึก
if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $detail = $_POST["detail"];
    $food_category = $_POST["food_category"];
    $price = $_POST["price"];

    //อัปโหลดรูปภาพ
    if ($_FILES["image"]["name"]) {
        //ลบรูปเก่าออกจากโฟลเดอร์ images
        unlink($food_row["image"]);
        //อัปโหลดไฟล์รูปไปยังโฟลเดอร์ images
        $target_dir = "images/"; //โฟลเดอร์ที่เก็บไฟล์รูป
        $target_file = $target_dir . basename($_FILES["image"]["name"]); //ไฟล์รูปที่อัปโหลด
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //นามสกุลไฟล์รูป
        $image = $target_dir . $restaurant_id . "_" . $name . "." . $imageFileType; //ไฟล์รูปที่จะเก็บลงในฐานข้อมูล
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) { //อัปโหลดไฟล์รูป
            $sql = "UPDATE food SET name = '$name', detail = '$detail', food_category = '$food_category', price = '$price', image = '$image' WHERE id = '$food_id'";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                echo "
                    <script>
                        alert('อัพเดทรายการอาหารสำเร็จ');
                        window.location = 'edit_food.php?id=$food_id';
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
    else {
        $sql = "UPDATE food SET name = '$name', detail = '$detail', food_category = '$food_category', price = '$price' WHERE id = '$food_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            echo "
                <script>
                    alert('อัพเดทรายการอาหารสำเร็จ');
                    window.location = 'edit_food.php?id=$food_id';
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
    <title>แก้ไขรายการอาหาร</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>แก้ไขรายการอาหาร</h1>
    <form action="edit_food.php?id=<?php echo $food_id ?>" method="post" enctype="multipart/form-data">
        <p>
            <img src="<?php echo $food_row['image']; ?>" width="200">
        <p>
        <p>
            <label for="name">ชื่อรายการอาหาร:</label>
            <input type="text" name="name" id="name" value="<?php echo $food_row['name']; ?>" required>
        </p>
        <p>
            <label for="detail">รายละเอียด:</label>
            <textarea type="text" name="detail" id="detail" required><?php echo $food_row['detail']; ?></textarea>
        </p>
        <p>
            <label for="food_category">หมวดหมู่:</label>
            <select name="food_category" id="food_category" required>
                <?php
                while ($food_category_row = $food_category_result->fetch_assoc()) {
                    if ($food_category_row['name'] == $food_row['food_category']) {
                        echo "<option value='" . $food_category_row['name'] . "' selected>" . $food_category_row['name'] . "</option>";
                    } else {
                        echo "<option value='" . $food_category_row['name'] . "'>" . $food_category_row['name'] . "</option>";
                    }
                }
                ?>
            </select>
        </p>
        <p>
            <label for="price">ราคา:</label>
            <input type="number" name="price" id="price" value="<?php echo $food_row['price']; ?>" required>
        </p>
        <p>
            <label for="image">รูปภาพ:</label>
            <input type="file" name="image" id="image">
        </p>
        <button type="submit">บันทึก</button>
    </form>
</body>

</html>