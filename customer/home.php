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
    <title>หน้าแรก</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <br>
    <div class="d-flex flex-row justify-content-center align-items-start flex-wrap">
        <?php
        $sql = "SELECT * FROM restaurant";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $image = $row['image'];
            $restaurant_name = $row['restaurant_name'];
            $restaurant_type = $row['restaurant_type'];
            $id = $row['id'];
            echo "
            <div class='card m-2' style='width: 18rem;'>
                <img src='../restaurant/$image' class='card-img-top' alt='...' width='100px' >
                <div class='card-body'>
                    <h2 class='card-title'>$restaurant_name</h2>
                    <p class='card-text'>$restaurant_type</p>
                    <a href='restaurant.php?id=$id' class='btn btn-primary'>เข้าสู่ร้านค้า</a>
                </div>
            </div>
            ";
        }
        ?>
    </div>
</body>

</html>