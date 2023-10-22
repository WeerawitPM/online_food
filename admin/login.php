<?php
session_start();
//ตรวจสอบว่ามีการเข้าสู่ระบบแล้วหรือไม่ ถ้ามีให้กลับไปหน้า home ของแต่ละประเภท
if(isset($_SESSION["id"])){
    header('Location: home.php');
    exit;
}
include("../db_connect.php");

if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION["id"] = $row["id"];
        $_SESSION["type"] = "admin";

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
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ | ผู้ดูแลระบบ</title>
</head>

<body>
    <div>
        <h1>เข้าสู่ระบบผู้ดูแลระบบ</h1>
        <form action="login.php" method="post">
            <p><label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </p>
            <p><label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </p>
            <button type="submit">Login</button>
        </form>
        <br>
        <a href="../index.php">กลับหน้าแรก</a>
    </div>
</body>

</html>