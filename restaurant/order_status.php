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
    <title>สถานะออเดอร์อาหาร</title>
</head>

<body data-bs-theme="dark">
    <?php include("navbar.php"); ?>
    <h1>สถานะออเดอร์อาหาร</h1>
    <div class="d-flex flex-row justify-content-center align-items-start flex-wrap">
        <?php
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM food_order WHERE restaurant_id = '$id'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $status = $row['status'];
            switch ($status) {
                case 'ไรเดอร์กำลังไปรอรับอาหารจากร้านค้า':
                    $food_id = $row["food_id"];
                    $count = $row["count"];
                    $total_price = $row["total_price"];
                    $customer_id = $row["customer_id"];
                    $rider_id = $row["rider_id"];

                    $sql2 = "SELECT * FROM food WHERE id = '$food_id'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $name = $row2["name"];
                    $image = $row2["image"];

                    $sql3 = "SELECT * FROM customer WHERE id = '$customer_id'";
                    $result3 = $conn->query($sql3);
                    $row3 = $result3->fetch_assoc();
                    $customer_name = $row3["firstname"];

                    $sql4 = "SELECT * FROM rider WHERE id = '$rider_id'";
                    $result4 = $conn->query($sql4);
                    $row4 = $result4->fetch_assoc();
                    $rider_name = $row4["firstname"];

                    echo "
                    <div class='card m-2' style='width: 18rem;'>
                        <img src='../restaurant/$image' class='card-img-top' alt='...' width='100px' >
                        <div class='card-body'>
                            <h2 class='card-title'>$name</h2>
                            <p class='card-text'>จำนวน : $count</p>
                            <h3 class='card-text'>฿ $total_price</h3>
                        </div>
                        <center>
                            <div class='card-footer'>
                                <p>สถานะ: รอรับออเดอร์</p>
                                <p>ชื่อลูกค้า: $customer_name</p>
                                <p>ชื่อไรเดอร์: $rider_name</p>
                                <form action='' method='post'>
                                    <button type='submit' value='$food_id' name='food_id' class='btn btn-primary'>กดยืนยันรับออเดอร์</button>
                                </form>
                            </div>
                        </center>
                    </div>
                    ";
                    break;
                case 'กำลังทำอาหาร':
                    $food_id = $row["food_id"];
                    $count = $row["count"];
                    $total_price = $row["total_price"];
                    $customer_id = $row["customer_id"];
                    $rider_id = $row["rider_id"];

                    $sql2 = "SELECT * FROM food WHERE id = '$food_id'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $name = $row2["name"];
                    $image = $row2["image"];

                    $sql3 = "SELECT * FROM customer WHERE id = '$customer_id'";
                    $result3 = $conn->query($sql3);
                    $row3 = $result3->fetch_assoc();
                    $customer_name = $row3["firstname"];

                    $sql4 = "SELECT * FROM rider WHERE id = '$rider_id'";
                    $result4 = $conn->query($sql4);
                    $row4 = $result4->fetch_assoc();
                    $rider_name = $row4["firstname"];

                    echo "
                    <div class='card m-2' style='width: 18rem;'>
                        <img src='../restaurant/$image' class='card-img-top' alt='...' width='100px' >
                        <div class='card-body'>
                            <h2 class='card-title'>$name</h2>
                            <p class='card-text'>จำนวน : $count</p>
                            <h3 class='card-text'>฿ $total_price</h3>
                        </div>
                        <center>
                            <div class='card-footer'>
                                <p>สถานะ: กำลังทำอาหาร</p>
                                <p>ชื่อลูกค้า: $customer_name</p>
                                <p>ชื่อไรเดอร์: $rider_name</p>
                                <form action='' method='post'>
                                    <button type='submit' value='$food_id' name='food_id' class='btn btn-primary'>ทำอาหารเสร็จสิ้น</button>
                                </form>
                            </div>
                        </center>
                    </div>
                    ";
                    break;
                default:
                    break;
            }
        }
        ?>
    </div>
</body>

</html>