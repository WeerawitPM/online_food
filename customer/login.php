<?php
session_start();
//ตรวจสอบว่ามีการเข้าสู่ระบบแล้วหรือไม่ ถ้ามีให้กลับไปหน้า home ของแต่ละประเภท
if (isset($_SESSION["id"])) {
    header('Location: home.php');
    exit;
}
include("../db_connect.php");

if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM customer WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION["id"] = $row["id"];
        $_SESSION["type"] = "customer";

        echo "
            <script>
                alert('เข้าสู่ระบบสำเร็จ ยินดีต้อนรับ $username');
                window.location = 'home.php';
            </script>
        ";
        exit;
    } else {
        echo "<script>alert('Username หรือ Password ไม่ถูกต้อง')</script>";
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
    <title>เข้าสู่ระบบ | ลูกค้า</title>
</head>

<body class="bg-dark w-100" data-bs-theme="dark">
    <div class="d-flex flex-column justify-content-center align-items-center w-100" style="height: 100vh;">
        <h1>เข้าสู่ระบบลูกค้า</h1>
        <form action="login.php" method="post" class="d-flex flex-column mt-3 w-75">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control form-control-lg" name="username" id="username"
                    placeholder="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control form-control-lg" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <br>
        <div class="d-flex">
            <a href="../index.php" class="btn btn-success mx-1">กลับหน้าแรก</a>
            <a href="register.php" class="btn btn-danger mx-1">สมัครสมาชิก</a>
        </div>
    </div>
</body>

</html>