<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $restaurant_id = $_SESSION["id"];

    $sql = "SELECT * FROM food_category WHERE name = '$name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "
        <script>
            alert('หมวดหมู่อาหารนี้มีอยู่แล้ว');
            window.location = 'create_category.php';
        </script>";
    } else {
        $sql = "INSERT INTO food_category (name, restaurant_id) VALUES ('$name', '$restaurant_id')";
        if ($conn->query($sql) === TRUE) {
            echo "
                <script>
                    alert('เพิ่มหมวดหมู่อาหารสำเร็จ');
                    window.location = 'create_category.php';
                </script>
            ";
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit;
        }
    }
    $conn->close();
}

if (isset($_POST["delete"])) {
    $id = $_POST["delete"];
    $sql = "DELETE FROM food_category WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "
            <script>
                alert('ลบหมวดหมู่อาหารสำเร็จ');
                window.location = 'create_category.php';
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
    <title>จัดการหมวดหมู่อาหาร</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>จัดการหมวดหมู่อาหาร</h1>
    <form action="create_category.php" method="post">
        <label for="name">ชื่อหมวดหมู่อาหาร:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">เพิ่ม</button>
    </form>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>หมวดหมู่อาหาร</th>
                <th>ลบ</th>
            </tr>
        </thead>
        <tbody>
            <form action="create_category.php" method="post">
                <?php
                $sql = "SELECT * FROM food_category WHERE restaurant_id = '" . $_SESSION["id"] . "'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>" . $row["name"] . "</td>
                            <td><button type='submit' name='delete' value='" . $row["id"] . "'>ลบ</button></td>
                        </tr>
                    ";
                }
                $conn->close();
                ?>
            </form>
        </tbody>
</body>

</html>