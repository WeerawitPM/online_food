<?php
session_start();
//ตรวจสอบว่ามีการเข้าสู่ระบบแล้วหรือไม่ ถ้ามีให้กลับไปหน้า home ของแต่ละประเภท
if (isset($_SESSION['id'])) {
    header('Location: home.php');
    exit;
}

include("../db_connect.php");

if (isset($_POST['username'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $password2 = md5($_POST['password2']);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $car_no = $_POST['car_no'];

    if ($password != $password2) {
        echo "<script>alert('Password ไม่ตรงกัน')</script>";
    } else {
        $sql = "SELECT * FROM rider WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<script>alert('Username นี้มีผู้ใช้แล้ว')</script>";
        } else {
            $sql = "SELECT * FROM rider WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<script>alert('Email นี้มีผู้ใช้แล้ว')</script>";
            } else {
                //อัปโหลดไฟล์รูปไปยังโฟลเดอร์ images
                $target_dir = "images/"; //โฟลเดอร์ที่เก็บไฟล์รูป
                $target_file = $target_dir . basename($_FILES["image"]["name"]); //ไฟล์รูปที่อัปโหลด
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //นามสกุลไฟล์รูป
                $image = $target_dir . $username . "." . $imageFileType; //ไฟล์รูปที่จะเก็บลงในฐานข้อมูล
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) { //อัปโหลดไฟล์รูป
                    $sql = "INSERT INTO rider (email, username, password, firstname, lastname, phone, address, image, car_no) VALUES ('$email', '$username', '$password', '$firstname', '$lastname', '$phone', '$address', '$image', '$car_no')";
                    if ($conn->query($sql) === TRUE) {
                        echo "
                            <script>
                                alert('สมัครสมาชิกสำเร็จ');
                                window.location = 'login.php';
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>สมัครสมาชิก</title>
</head>

<body data-bs-theme="dark">
    <div>
        <h1>สมัครสมาชิก</h1>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="email">อีเมล</label>
                <input type="email" name="email" id="email" required>
            </p>
            <p>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </p>
            <p>
                <label for="password">รหัสผ่าน</label>
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <label for="password2">ยืนยันรหัสผ่าน</label>
                <input type="password" name="password2" id="password2" required>
            </p>
            <p>
                <label for="firstname">ชื่อ</label>
                <input type="text" name="firstname" id="firstname" required>
            </p>
            <p>
                <label for="lastname">นามสกุล</label>
                <input type="text" name="lastname" id="lastname" required>
            </p>
            <p>
                <label for="phone">เบอร์โทร</label>
                <input type="text" name="phone" id="phone" required>
            </p>
            <p>
                <label for="address">ที่อยู่</label>
                <textarea name="address" id="address" cols="30" rows="10" required></textarea>
            </p>
            <p>
                <label for="car_no">ทะเบียนรถ</label>
                <input name="car_no" id="car_no" required></input>
            </p>
            <p>
                <label for="image">รูปภาพ</label>
                <input type="file" name="image" id="image" required>
            </p>
            <button type="submit">Register</button>
        </form>
        <br>
        <a href="login.php">เข้าสู่ระบบ</a>
    </div>
</body>

</html>