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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            echo "
            <div class='card m-2' style='width: 18rem;'>
                <img src='../restaurant/" . $row['image'] . "' class='card-img-top' alt='...' width='100px' >
                <div class='card-body'>
                    <h2 class='card-title'>" . $row['restaurant_name'] . "</h2>
                    <p class='card-text'>" . $row['restaurant_type'] . "</p>
                    <a href='#' class='btn btn-primary'>เข้าสู่ร้านค้า</a>
                </div>
            </div>
            ";
        }
        ?>
    </div>
</body>

</html>