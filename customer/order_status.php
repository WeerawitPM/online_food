<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["food_id"])) {
    $food_id = $_POST["food_id"];
    $status = "เสร็จสิ้น";

    $sql = "UPDATE food_order SET status = '$status' WHERE food_id ='$food_id'";
    $result = $conn->query($sql);
    if ($result === true) {
        echo "
        <script>
            alert('เปลี่ยนสถานะของอาหารเสร็จสิ้น');
            window.location.href='order_status.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>สถานะคำสั่งซื้อ</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>รายการอาหารที่สั่ง</h1>
    <div class="d-flex flex-row justify-content-center align-items-start flex-wrap">
        <?php
        $customer_id = $_SESSION["id"];

        $status1 = 'รอคนขับ';
        $sql = "SELECT * FROM food_order WHERE customer_id = '$customer_id' AND status = '$status1'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $food_id = $row["food_id"];
                $count = $row["count"];
                $total_price = $row["total_price"];

                $sql = "SELECT * FROM food WHERE id = '$food_id'";
                $result2 = $conn->query($sql);
                $row2 = $result2->fetch_assoc();
                $name = $row2["name"];
                $image = $row2["image"];

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
                            สถานะ: $status1
                        </div>
                    </center>
                </div>
                ";
            }
        }

        $status2 = 'รอร้านค้าทำอาหาร';
        $sql = "SELECT * FROM food_order WHERE customer_id = '$customer_id' AND status = '$status2'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $food_id = $row["food_id"];
                $count = $row["count"];
                $total_price = $row["total_price"];

                $sql = "SELECT * FROM food WHERE id = '$food_id'";
                $result2 = $conn->query($sql);
                $row2 = $result2->fetch_assoc();
                $name = $row2["name"];
                $image = $row2["image"];

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
                            สถานะ: $status2
                        </div>
                    </center>
                </div>
            ";
            }
        }

        $status3 = 'กำลังส่ง';
        $sql = "SELECT * FROM food_order WHERE customer_id = '$customer_id' AND status = '$status3'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $food_id = $row["food_id"];
                $count = $row["count"];
                $total_price = $row["total_price"];

                $sql = "SELECT * FROM food WHERE id = '$food_id'";
                $result2 = $conn->query($sql);
                $row2 = $result2->fetch_assoc();
                $name = $row2["name"];
                $image = $row2["image"];

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
                            สถานะ: $status3
                        </div>
                    </center>
                </div>
            ";
            }
        }

        $status4 = 'ส่งอาหารแล้ว';
        $sql = "SELECT * FROM food_order WHERE customer_id = '$customer_id' AND status = '$status4'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $food_id = $row["food_id"];
                $count = $row["count"];
                $total_price = $row["total_price"];

                $sql = "SELECT * FROM food WHERE id = '$food_id'";
                $result2 = $conn->query($sql);
                $row2 = $result2->fetch_assoc();
                $name = $row2["name"];
                $image = $row2["image"];
                
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
                            <p>สถานะ: $status4</p>
                            <form action='' method='post'>
                                <button type='submit' value='$food_id' name='food_id' class='btn btn-primary'>กดยืนยันรับอาหาร</button>
                            </form>
                        </div>
                    </center>
                </div>
            ";
            }
        }
        ?>
    </div>
</body>

</html>