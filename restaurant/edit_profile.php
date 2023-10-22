<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

$id = $_SESSION["id"];
$sql = "SELECT * FROM restaurant WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$image = $row["image"];
$username = $row["username"];
$firstname = $row["firstname"];
$lastname = $row["lastname"];
$phone = $row["phone"];
$address = $row["address"];
$email = $row["email"];
$restaurant_name = $row["restaurant_name"];
$restaurant_type = $row["restaurant_type"];
$status = $row["status"];

if (isset($_POST["firstname"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $restaurant_name = $_POST["restaurant_name"];

    if ($_FILES["image"]["name"]) {
        //ลบรูปเก่าออกจากโฟลเดอร์ images
        unlink($image);
        //อัปโหลดไฟล์รูปไปยังโฟลเดอร์ images
        $target_dir = "images/"; //โฟลเดอร์ที่เก็บไฟล์รูป
        $target_file = $target_dir . basename($_FILES["image"]["name"]); //ไฟล์รูปที่อัปโหลด
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //นามสกุลไฟล์รูป
        $image = $target_dir . $username . "." . $imageFileType; //ไฟล์รูปที่จะเก็บลงในฐานข้อมูล
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) { //อัปโหลดไฟล์รูป
            $sql = "UPDATE restaurant SET firstname = '$firstname', lastname = '$lastname', phone = '$phone', address = '$address', image = '$image' WHERE id = '$id'";
            if ($conn->query($sql) === TRUE) {
                echo "
                    <script>
                        alert('แก้ไขข้อมูลสำเร็จ');
                        window.location = 'profile.php';
                    </script>
                ";
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<script>alert('อัปโหลดรูปไม่สำเร็จ')</script>";
        }
    } else {
        $sql = "UPDATE restaurant SET firstname = '$firstname', lastname = '$lastname', phone = '$phone', address = '$address', restaurant_name = '$restaurant_name' WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "
                <script>
                    alert('แก้ไขข้อมูลสำเร็จ');
                    window.location = 'profile.php';
                </script>
            ";
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลร้านอาหาร</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>แก้ไขข้อมูลร้านอาหาร</h1>
    <form action="edit_profile.php" enctype="multipart/form-data" method="post">
        <p>
            <img src="<?php echo $image; ?>" width="200">
        <p>
            <label for="image">รูปภาพ</label>
            <input type="file" name="image" id="image">
        </p>
        <p>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>" disabled>
        </p>
        <p>
            <label for="firstname">ชื่อ</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" required>
        </p>
        <p>
            <label for="lastname">นามสกุล</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" required>
        </p>
        <p>
            <label for="phone">เบอร์โทรศัพท์</label>
            <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" required>
        </p>
        <p>
            <label for="address">ที่อยู่</label>
            <input type="text" name="address" id="address" value="<?php echo $address; ?>" required>
        </p>
        <p>
            <label for="email">อีเมล</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" disabled>
        </p>
        <p>
            <label for="restaurant_name">ชื่อร้าน</label>
            <input type="text" name="restaurant_name" id="restaurant_name" value="<?php echo $restaurant_name; ?>" required>
        </p>
        <p>
            <label for="restaurant_type">ประเภทร้าน</label>
            <input type="text" name="restaurant_type" id="restaurant_type" value="<?php echo $restaurant_type; ?>" disabled>
        </p>
        <p>
            <label for="status">สถานะร้าน</label>
            <input type="text" name="status" id="status" value="<?php echo $status; ?>" disabled>
        </p>
        <button type="submit">บันทึก</button>
    </form>
</body>

</html>