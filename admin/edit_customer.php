<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["normal"])) {
    $id = $_POST["normal"];
    $sql = "UPDATE customer SET status = 'ปกติ' WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "
            <script>
                alert('เปลี่ยนสถานะเป็นปกติสำเร็จ');
                window.location = 'edit_customer.php';
            </script>
        ";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST["banned"])) {
    $id = $_POST["banned"];
    $sql = "UPDATE customer SET status = 'ระงับการใช้งาน' WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "
            <script>
                alert('เปลี่ยนสถานะเป็นระงับการใช้งานสำเร็จ');
                window.location = 'edit_customer.php';
            </script>
        ";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST["delete"])) {
    $id = $_POST["delete"];
    $sql = "DELETE FROM customer WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "
            <script>
                alert('ลบสำเร็จ');
                window.location = 'edit_customer.php';
            </script>
        ";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการลูกค้า</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>จัดการลูกค้า</h1>
    <table border="1">
        <thead>
            <tr>
                <th>รหัสลูกค้า</th>
                <th>ชื่อผู้ใช้</th>
                <th>ชื่อจริงลูกค้า</th>
                <th>นามสกุลลูกค้า</th>
                <th>เบอร์โทรศัพท์</th>
                <th>อีเมล</th>
                <th>สถานะ</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <form action="edit_customer.php" method="post">
                <?php
                $sql = "SELECT * FROM customer";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $username = $row["username"];
                    $firstname = $row["firstname"];
                    $lastname = $row["lastname"];
                    $phone = $row["phone"];
                    $email = $row["email"];
                    $status = $row["status"];
                    
                    echo "
                    <tr>
                        <td>$id</td>
                        <td>$username</td>
                        <td>$firstname</td>
                        <td>$lastname</td>
                        <td>$phone</td>
                        <td>$email</td>
                        <td>$status</td>
                        <td>
                            <button type='submit' name='normal' value='$id'>ปกติ</button>
                            <button type='submit' name='banned' value='$id'>ระงับ</button>
                            <button type='submit' name='delete' value='$id'>ลบ</button>
                        </td>
                    </tr>
                    ";
                }
                $conn->close();
                ?>
            </form>
        </tbody>
</body>

</html>