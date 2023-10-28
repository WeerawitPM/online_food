<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>ร้านอาหาร</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>รายการอาหาร</h1>
    <div class="d-flex flex-row justify-content-center align-items-start flex-wrap">
        <?php
        $restaurant_id = $_GET["id"];
        $sql = "SELECT * FROM food WHERE restaurant_id = $restaurant_id";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='card m-2' style='width: 18rem;'>
                <img src='../restaurant/" . $row['image'] . "' class='card-img-top' alt='...' width='100px' >
                <div class='card-body'>
                    <h2 class='card-title'>" . $row['name'] . "</h2>
                    <p class='card-text'>" . $row['detail'] . "</p>
                    <a class='btn btn-primary'>สั่งอาหาร</a>
                </div>
            </div>
            ";
        }
        $conn->close();
        ?>
    </div>
</body>

</html>