<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["count"])) {
    $food_id = $_POST["food_id"];
    $customer_id = $_SESSION["id"];
    $count = $_POST["count"];

    $sql = "SELECT * FROM food WHERE id = $food_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $name = $row["name"];
    $price = $row["price"];
    $total_price = $price * $count;

    $sql = "INSERT INTO food_order (food_id, count, total_price, customer_id) VALUES ('$food_id', '$count', '$total_price', '$customer_id')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('สั่งอาหารสำเร็จ');</script>";
    } else {
        echo "<script>alert('สั่งอาหารไม่สำเร็จ')</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>ร้านอาหาร</title>
</head>

<body data-bs-theme="dark">
    <?php include("navbar.php"); ?>
    <h1>รายการอาหาร</h1>
    <div class="d-flex flex-row justify-content-center align-items-start flex-wrap">
        <?php
        $restaurant_id = $_GET["id"];
        $sql = "SELECT * FROM food WHERE restaurant_id = $restaurant_id";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $image = $row['image'];
            $name = $row['name'];
            $detail = $row['detail'];
            $price = $row['price'];
            echo "
            <div class='card m-2' style='width: 18rem;'>
                <img src='../restaurant/$image' class='card-img-top' alt='...' width='100px' >
                <div class='card-body'>
                    <h2 class='card-title'>$name</h2>
                    <p class='card-text'>$detail</p>
                    <h3 class='card-text'>฿ $price</h3>
                </div>
                <center>
                    <div class='card-footer'>
                        <form action='' method='post'>
                            <input type='number' value='0' name='count'>
                            <button class='btn btn-primary mt-1' type='submit' value='$id' name='food_id'>สั่งอาหาร</button>
                        </form>
                    </div>
                </center>
            </div>
            ";
        }
        ?>
    </div>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>