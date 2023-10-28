<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["normal"])) {
    $id = $_POST["normal"];
    $sql = "UPDATE restaurant SET status = 'อนุมัติ' WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "
            <script>
                alert('เปลี่ยนสถานะเป็นอนุมัติสำเร็จ');
                window.location = 'edit_restaurant.php';
            </script>
        ";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

if(isset($_POST["banned"])){
    $id = $_POST["banned"];
    $sql = "UPDATE restaurant SET status = 'ไม่อนุมัติ' WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "
            <script>
                alert('เปลี่ยนสถานะเป็นไม่อนุมัติสำเร็จ');
                window.location = 'edit_restaurant.php';
            </script>
        ";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

if(isset($_POST["delete"])){
    $id = $_POST["delete"];
    $sql = "DELETE FROM restaurant WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "
            <script>
                alert('ลบสำเร็จ');
                window.location = 'edit_restaurant.php';
            </script>
        ";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการร้านอาหาร</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>จัดการร้านอาหาร</h1>
    <table border="1">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อผู้ใช้</th>
                <th>ชื่อจริง</th>
                <th>นามสกุล</th>
                <th>เบอร์โทรศัพท์</th>
                <th>อีเมล</th>
                <th>ชื่อร้าน</th>
                <th>ประเภท</th>
                <th>สถานะ</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <form action="edit_restaurant.php" method="post">
                <?php
                $sql = "SELECT * FROM restaurant";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $username = $row["username"];
                    $firstname = $row["firstname"];
                    $lastname = $row["lastname"];
                    $phone = $row["phone"];
                    $email = $row["email"];
                    $restaurant_name = $row["restaurant_name"];
                    $restaurant_type = $row["restaurant_type"];
                    $status = $row["status"];

                    echo "
                    <tr>
                        <td>$id</td>
                        <td>$username</td>
                        <td>$firstname</td>
                        <td>$lastname</td>
                        <td>$phone</td>
                        <td>$email</td>
                        <td>$restaurant_name</td>
                        <td>$restaurant_type</td>
                        <td>$status</td>
                        <td>
                            <button type='submit' name='normal' value='$id'>อนุมัติ</button>
                            <button type='submit' name='banned' value='$id'>ไม่อนุมัติ</button>
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