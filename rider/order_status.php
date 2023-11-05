<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["food_order_id"])) {
    $food_order_id = $_POST["food_order_id"];
    $status = $_POST["status"];
    $sql = "UPDATE food_order SET status = '$status' WHERE id = '$food_order_id'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('เปลี่ยนสถานะสำเร็จ')</script>";
    } else {
        echo "<script>alert('เปลี่ยนสถานะไม่สำเร็จ')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>สถานะการส่งอาหาร</title>
</head>

<body data-bs-theme="dark">
    <?php include("navbar.php"); ?>
    <h1>สถานะการส่งอาหาร</h1>
    <div class="d-flex flex-row justify-content-center align-items-start flex-wrap">
        <?php
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM food_order WHERE rider_id = '$id'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $food_order_id = $row["id"];
            $status = $row['status'];
            $food_id = $row["food_id"];
            $food_count = $row["food_count"];
            $total_price = $row["total_price"];
            $customer_id = $row["customer_id"];
            $restaurant_id = $row["restaurant_id"];
            switch ($status) {
                case 'ยืนยันการชำระเงินจากไรเดอร์':
                    $sql2 = "SELECT * FROM food WHERE id = '$food_id'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $name = $row2["name"];
                    $image = $row2["image"];

                    $sql3 = "SELECT * FROM customer WHERE id = '$customer_id'";
                    $result3 = $conn->query($sql3);
                    $row3 = $result3->fetch_assoc();
                    $customer_name = $row3["firstname"];
                    $customer_phone = $row3["phone"];
                    $customer_address = $row3["address"];

                    $sql4 = "SELECT * FROM restaurant WHERE id = '$restaurant_id'";
                    $result4 = $conn->query($sql4);
                    $row4 = $result4->fetch_assoc();
                    $restaurant_name = $row4["restaurant_name"];
                    $restaurant_phone = $row4["phone"];
                    $restaurant_address = $row4["address"];

                    echo "
                    <div class='card m-2' style='width: 18rem;'>
                        <img src='../restaurant/$image' class='card-img-top' alt='...' width='100px' >
                        <div class='card-body'>
                            <h2 class='card-title'>$name</h2>
                            <p class='card-text'>จำนวน : $food_count</p>
                            <h3 class='card-text'>฿ $total_price</h3>
                        </div>
                        <center>
                            <div class='card-footer'>
                                <p>สถานะ: รอรับอาหาร</p>
                                <hr>
                                <p>ชื่อร้านอาหาร: $restaurant_name</p>
                                <p>เบอร์โทรศัพท์ร้านอาหาร: $restaurant_phone</p>
                                <p>ที่อยู่ร้านอาหาร: $restaurant_address</p>
                                <hr>
                                <p>ชื่อลูกค้า: $customer_name</p>
                                <p>เบอร์โทรศัพท์ลูกค้า: $customer_phone</p>
                                <p>ที่อยู่ลูกค้า: $customer_address</p>
                                <form action='' method='post'>
                                    <input type='hidden' name='status' value='กำลังนำส่งอาหาร'>
                                    <button type='submit' value='$food_order_id' name='food_order_id' class='btn btn-primary'>กดรับอาหาร</button>
                                </form>
                            </div>
                        </center>
                    </div>
                    ";
                    break;
                case 'กำลังนำส่งอาหาร':
                    $sql2 = "SELECT * FROM food WHERE id = '$food_id'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $name = $row2["name"];
                    $image = $row2["image"];

                    $sql3 = "SELECT * FROM customer WHERE id = '$customer_id'";
                    $result3 = $conn->query($sql3);
                    $row3 = $result3->fetch_assoc();
                    $customer_name = $row3["firstname"];
                    $customer_phone = $row3["phone"];
                    $customer_address = $row3["address"];

                    $sql4 = "SELECT * FROM restaurant WHERE id = '$restaurant_id'";
                    $result4 = $conn->query($sql4);
                    $row4 = $result4->fetch_assoc();
                    $restaurant_name = $row4["restaurant_name"];
                    $restaurant_phone = $row4["phone"];
                    $restaurant_address = $row4["address"];

                    echo "
                    <div class='card m-2' style='width: 18rem;'>
                        <img src='../restaurant/$image' class='card-img-top' alt='...' width='100px' >
                        <div class='card-body'>
                            <h2 class='card-title'>$name</h2>
                            <p class='card-text'>จำนวน : $food_count</p>
                            <h3 class='card-text'>฿ $total_price</h3>
                        </div>
                        <center>
                            <div class='card-footer'>
                                <p>สถานะ: $status</p>
                                <hr>
                                <p>ชื่อร้านอาหาร: $restaurant_name</p>
                                <p>เบอร์โทรศัพท์ร้านอาหาร: $restaurant_phone</p>
                                <p>ที่อยู่ร้านอาหาร: $restaurant_address</p>
                                <hr>
                                <p>ชื่อลูกค้า: $customer_name</p>
                                <p>เบอร์โทรศัพท์ลูกค้า: $customer_phone</p>
                                <p>ที่อยู่ลูกค้า: $customer_address</p>
                                <form action='' method='post'>
                                    <input type='hidden' name='status' value='ส่งอาหารแล้ว'>
                                    <button type='submit' value='$food_order_id' name='food_order_id' class='btn btn-primary'>ยืนยันการส่งอาหาร และรับเงินจากลูกค้า</button>
                                </form>
                            </div>
                        </center>
                    </div>
                    ";
                    break;
                case 'เสร็จสิ้น':
                    break;
                default:
                    $sql2 = "SELECT * FROM food WHERE id = '$food_id'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $name = $row2["name"];
                    $image = $row2["image"];

                    $sql3 = "SELECT * FROM customer WHERE id = '$customer_id'";
                    $result3 = $conn->query($sql3);
                    $row3 = $result3->fetch_assoc();
                    $customer_name = $row3["firstname"];
                    $customer_phone = $row3["phone"];
                    $customer_address = $row3["address"];

                    $sql4 = "SELECT * FROM restaurant WHERE id = '$restaurant_id'";
                    $result4 = $conn->query($sql4);
                    $row4 = $result4->fetch_assoc();
                    $restaurant_name = $row4["restaurant_name"];
                    $restaurant_phone = $row4["phone"];
                    $restaurant_address = $row4["address"];

                    echo "
                    <div class='card m-2' style='width: 18rem;'>
                        <img src='../restaurant/$image' class='card-img-top' alt='...' width='100px' >
                        <div class='card-body'>
                            <h2 class='card-title'>$name</h2>
                            <p class='card-text'>จำนวน : $food_count</p>
                            <h3 class='card-text'>฿ $total_price</h3>
                        </div>
                        <center>
                            <div class='card-footer'>
                                <p>สถานะ: $status</p>
                                <hr>
                                <p>ชื่อร้านอาหาร: $restaurant_name</p>
                                <p>เบอร์โทรศัพท์ร้านอาหาร: $restaurant_phone</p>
                                <p>ที่อยู่ร้านอาหาร: $restaurant_address</p>
                                <hr>
                                <p>ชื่อลูกค้า: $customer_name</p>
                                <p>เบอร์โทรศัพท์ลูกค้า: $customer_phone</p>
                                <p>ที่อยู่ลูกค้า: $customer_address</p>
                            </div>
                        </center>
                    </div>
                    ";
                    break;
            }
        }
        ?>
    </div>
</body>

</html>