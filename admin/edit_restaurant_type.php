<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["name"])) {
    $name = $_POST["name"];

    $sql = "SELECT * FROM restaurant_type WHERE name = '$name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script>alert('ประเภทร้านอาหารนี้มีอยู่แล้ว')</script>";
    } else {
        $sql = "INSERT INTO restaurant_type (name) VALUES ('$name')";
        if ($conn->query($sql) === TRUE) {
            echo "
                <script>
                    alert('เพิ่มประเภทร้านอาหารสำเร็จ');
                    window.location = 'edit_restaurant_type.php';
                </script>
            ";
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}

if (isset($_POST["delete"])) {
    $id = $_POST["delete"];
    $sql = "DELETE FROM restaurant_type WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "
            <script>
                alert('ลบประเภทร้านอาหารสำเร็จ');
                window.location = 'edit_restaurant_type.php';
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
    <title>จัดการประเภทร้านอาหาร</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>ประเภทร้านอาหาร</h1>
    <form action="edit_restaurant_type.php" method="post">
        <label for="name">ชื่อประเภทร้านอาหาร:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">เพิ่ม</button>
    </form>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>ชื่อประเภทร้านอาหาร</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <form action="edit_restaurant_type.php" method="post">
                <?php
                $sql = "SELECT * FROM restaurant_type";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td><button type='submit' name='delete' value='" . $row["id"] . "'>ลบ</button></td>";
                    echo "</tr>";
                }
                ?>
            </form>
        </tbody>
</body>

</html>