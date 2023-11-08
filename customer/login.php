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
        $_SESSION["username"] = $row["username"];
        $_SESSION["image"] = $row["image"];
        $_SESSION["type"] = "customer";

        echo "
            <script>
                alert('เข้าสู่ระบบสำเร็จ ยินดีต้อนรับ $username');
                window.location = 'index.php';
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
    <title>Login | Customer</title>
</head>

<body data-bs-theme="dark">
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="min-width: 60%;">
            <div class="card-header text-center">
                <h1>Login | Customer</h1>
            </div>
            <div class="card-body fs-5">
                <form action="login.php" method="post" class="d-flex flex-column">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control form-control-lg" name="username" id="username"
                            placeholder="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-lg" name="password" id="password"
                            placeholder="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="../index.php">Back to First Page</a> | Don't have an Account? <a href="register.php">Register Now</a>
            </div>
        </div>
    </div>
</body>

</html>