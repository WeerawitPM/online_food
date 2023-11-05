<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

//ดูรายการอาหาร
$restaurant_id = $_SESSION["id"]; //ให้ restaurant_id เท่ากับ SESSION id
$sql = "SELECT * FROM food WHERE restaurant_id = $restaurant_id";
$result = $conn->query($sql);

if (isset($_POST["delete"])) {
    $id = $_POST["delete"];
    $sql = "DELETE from food WHERE id = $id";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "
            <script>
                alert('ลบรายการอาหารสำเร็จ');
                window.location = 'home.php';
            </script>'
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>หน้าแรก</title>
</head>

<body data-bs-theme="dark">
    <?php include("navbar.php"); ?>
    <h1>รายการอาหาร</h1>
    <div class="d-flex flex-row justify-content-center align-items-start flex-wrap">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                    <div class='card m-2' style='width: 18rem;'>
                        <img src='" . $row['image'] . "' class='card-img-top' alt='...' width='100px' >
                        <div class='card-body'>
                            <h2 class='card-title'>" . $row['name'] . "</h2>
                            <p class='card-text'>" . $row['detail'] . "</p>
                            <p class='card-text'>หมวดหมู่: " . $row['food_category'] . "</p>
                            <p class='card-text'>ราคา: " . $row['price'] . " บาท</p>
                            <div class='d-flex'>
                                <a href='edit_food.php?id=" . $row['id'] . "' class='btn btn-primary me-1'>แก้ไข</a>
                                <form action='home.php' method='post'>
                                    <button type='submit' name='delete' value=" . $row['id'] . " class='btn btn-danger'>ลบ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                ";
            }
        } else {
            echo "<h1>ยังไม่มีรายการอาหาร</h1>";
        }
        $conn->close();
        ?>
    </div>
</body>

</html>