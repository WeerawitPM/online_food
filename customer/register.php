<?php
//ตรวจสอบว่ามีการเข้าสู่ระบบแล้วหรือไม่ ถ้ามีให้กลับไปหน้า home ของแต่ละประเภท
session_start();
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

    if ($password != $password2) {
        echo "<script>alert('Password ไม่ตรงกัน')</script>";
    } else {
        $sql = "SELECT * FROM customer WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<script>alert('Username นี้มีผู้ใช้แล้ว')</script>";
        } else {
            $sql = "SELECT * FROM customer WHERE email = '$email'";
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
                    $sql = "INSERT INTO customer (email, username, password, firstname, lastname, phone, address, image) VALUES ('$email', '$username', '$password', '$firstname', '$lastname', '$phone', '$address', '$image')";
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
    <title>Register | Customer</title>
</head>

<body data-bs-theme="dark">
    <div class="d-flex flex-column justify-content-center align-items-center m-5">
        <div class="card" style="min-width: 60%;">
            <div class="card-header text-center">
                <h1>Register | Customer</h1>
            </div>
            <div class="card-body">
                <form action="register.php" method="post" enctype="multipart/form-data" class="d-flex flex-column">
                    <div class="mb-3 fs-5">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-3 fs-5">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3 fs-5">
                        <label for="password2" class="form-label">Confirm Password</label>
                        <input type="password" name="password2" id="password2" class="form-control" required>
                    </div>
                    <div class="mb-3 fs-5 d-flex">
                        <div class="w-100 me-1">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" required>
                        </div>
                        <div class="w-100 ms-1">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3 fs-5 d-flex">
                        <div class="w-100 ms-1">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="w-100 ms-1">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3 fs-5">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3 fs-5">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg bg-primary-subtle">Register</button>
                </form>
            </div>
            <div class="card-footer text-center">
                You have an Account? <a href="login.php">Login Here</a>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>