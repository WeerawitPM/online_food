<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["old_password"])) {
    $id = $_SESSION["id"];
    $old_password = md5($_POST["old_password"]);
    $new_password = md5($_POST["new_password"]);
    $confirm_password = md5($_POST["confirm_password"]);

    $sql = "SELECT * FROM restaurant WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($old_password != $row["password"]) {
        echo "<script>alert('รหัสผ่านเดิมไม่ถูกต้อง')</script>";
    } else if ($new_password != $confirm_password) {
        echo "<script>alert('รหัสผ่านใหม่ไม่ตรงกัน')</script>";
    } else {
        $sql = "UPDATE restaurant SET password = '$new_password' WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "
                <script>
                    alert('เปลี่ยนรหัสผ่านสำเร็จ');
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
    <title>เปลี่ยนรหัสผ่าน</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>เปลี่ยนรหัสผ่าน</h1>
    <form action="" method="post">
        <p>รหัสผ่านเดิม: <input type="password" name="old_password" required></p>
        <p>รหัสผ่านใหม่: <input type="password" name="new_password" required></p>
        <p>ยืนยันรหัสผ่านใหม่: <input type="password" name="confirm_password" required></p>
        <button type="submit">บันทึก</button>
    </form>
</body>

</html>