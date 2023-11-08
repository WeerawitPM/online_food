<?php
if (isset($_POST["food_order_id"])) {
    $food_order_id = $_POST["food_order_id"];
    $rider_id = $_POST["rider_id"];
    $status = $_POST["status"];

    $sql = "UPDATE food_order SET status = '$status' WHERE id ='$food_order_id'";
    $result = $conn->query($sql);

    if ($result) {
        $sql2 = "UPDATE rider SET status_order = 'รอรับออเดอร์' WHERE id = '$rider_id'";
        $result2 = $conn->query($sql2);
        if ($result2) {
            echo "<script>alert('ยืนยันการรับอาหารเรียบร้อย')</script>";
        } else {
            echo "<script>alert('ยืนยันการรับอาหารไม่สำเร็จ')</script>";
        }
    } else {
        echo "<script>alert('ยืนยันการส่งอาหารไม่สำเร็จ')</script>";
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

<body data-bs-theme="dark">
    <?php include("navbar.php"); ?>
    <h1>รายการอาหารที่สั่ง</h1>
    <div class="d-flex flex-row justify-content-center align-items-start flex-wrap">
        <?php
        $customer_id = $_SESSION["id"];
        $sql = "SELECT * FROM food_order WHERE customer_id = '$customer_id'";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $food_order_id = $row["id"];
            $status = $row["status"];
            $food_id = $row["food_id"];
            $food_count = $row["food_count"];
            $total_price = $row["total_price"];
            $restaurant_id = $row["restaurant_id"];
            $rider_id = $row["rider_id"];
            switch ($status) {
                case "ส่งอาหารแล้ว":
                    $sql2 = "SELECT * FROM food WHERE id = '$food_id'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $name = $row2["name"];
                    $image = $row2["image"];

                    $sql3 = "SELECT * FROM restaurant WHERE id = '$restaurant_id'";
                    $result3 = $conn->query($sql3);
                    $row3 = $result3->fetch_assoc();
                    $restaurant_name = $row3["restaurant_name"];
                    $restaurant_phone = $row3["phone"];
                    $restaurant_address = $row3["address"];

                    $sql4 = "SELECT * FROM rider WHERE id = '$rider_id'";
                    $result4 = $conn->query($sql4);
                    $row4 = $result4->fetch_assoc();
                    $rider_name = $row4["firstname"];
                    $rider_phone = $row4["phone"];

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
                                <p>ร้านอาหาร: $restaurant_name</p>
                                <p>เบอร์โทรศัพท์: $restaurant_phone</p>
                                <p>ที่อยู่: $restaurant_address</p>
                                <hr>
                                <p>ผู้ส่ง: $rider_name</p>
                                <p>เบอร์โทรศัพท์: $rider_phone</p>
                                <hr>
                                <form action='' method='post'>
                                    <input type='hidden' name='rider_id' value='$rider_id'>
                                    <input type='hidden' name='status' value='เสร็จสิ้น'>
                                    <button type='submit' value='$food_order_id' name='food_order_id' class='btn btn-primary'>กดยืนยันรับอาหาร</button>
                                </form>
                            </div>
                        </center>
                    </div>
                    ";
                    break;
                case "เสร็จสิ้น":
                    break;
                default:
                    $sql2 = "SELECT * FROM food WHERE id = '$food_id'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $name = $row2["name"];
                    $image = $row2["image"];

                    $sql3 = "SELECT * FROM restaurant WHERE id = '$restaurant_id'";
                    $result3 = $conn->query($sql3);
                    $row3 = $result3->fetch_assoc();
                    $restaurant_name = $row3["restaurant_name"];
                    $restaurant_phone = $row3["phone"];
                    $restaurant_address = $row3["address"];

                    $sql4 = "SELECT * FROM rider WHERE id = '$rider_id'";
                    $result4 = $conn->query($sql4);
                    $row4 = $result4->fetch_assoc();
                    $rider_name = $row4["firstname"];
                    $rider_phone = $row4["phone"];

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
                                <p>ร้านอาหาร: $restaurant_name</p>
                                <p>เบอร์โทรศัพท์: $restaurant_phone</p>
                                <p>ที่อยู่: $restaurant_address</p>
                                <hr>
                                <p>ผู้ส่ง: $rider_name</p>
                                <p>เบอร์โทรศัพท์: $rider_phone</p>
                                <hr>
                            </div>
                        </center>
                    </div>
                    ";
                    break;
            }
        }
        $conn->close();
        ?>
    </div>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>