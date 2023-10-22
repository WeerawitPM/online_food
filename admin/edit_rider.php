<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["normal"])) {
    $id = $_POST["normal"];
    $sql = "UPDATE rider SET status = 'อนุมัติ' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "
            <script>
                alert('เปลี่ยนสถานะเป็นอนุมัติสำเร็จ');
                window.location = 'edit_rider.php';
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
    $sql = "UPDATE rider SET status = 'ไม่อนุมัติ' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "
            <script>
                alert('เปลี่ยนสถานะเป็นไม่อนุมัติสำเร็จ');
                window.location = 'edit_rider.php';
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
    $sql = "DELETE FROM rider WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "
            <script>
                alert('ลบสำเร็จ');
                window.location = 'edit_rider.php';
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
    <title>จัดการไรเดอร์</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>จัดการไรเดอร์</h1>
    <table border="1">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อผู้ใช้</th>
                <th>ชื่อจริง</th>
                <th>นามสกุล</th>
                <th>เบอร์โทรศัพท์</th>
                <th>อีเมล</th>
                <th>ทะเบียนรถ</th>
                <th>สถานะ</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <form action="edit_rider.php" method="post">
                <?php
                $sql = "SELECT * FROM rider";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["firstname"] . "</td>";
                    echo "<td>" . $row["lastname"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["car_no"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>";
                    echo "<button type='submit' name='normal' value='" . $row["id"] . "'>อนุมัติ</button>";
                    echo "<button type='submit' name='banned' value='" . $row["id"] . "'>ไม่อนุมัติ</button>";
                    echo "<button type='submit' name='delete' value='" . $row["id"] . "'>ลบ</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </form>
        </tbody>
</body>

</html>