<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["normal"])) {
    $id = $_POST["normal"];
    $sql = "UPDATE customer SET status = 'ปกติ' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
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
    $conn->close();
}

if(isset($_POST["banned"])){
    $id = $_POST["banned"];
    $sql = "UPDATE customer SET status = 'ระงับการใช้งาน' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
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
    $conn->close();
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
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["firstname"] . "</td>";
                    echo "<td>" . $row["lastname"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>";
                    echo "<button type='submit' name='normal' value='" . $row["id"] . "'>ปกติ</button>";
                    echo "<button type='submit' name='banned' value='" . $row["id"] . "'>ระงับ</button>";
                    echo "<button type='submit' name='delete' value='" . $row["id"] . "'>ลบ</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </form>
        </tbody>
</body>

</html>