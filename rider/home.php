<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if(isset($_POST["food_id"])){
    $food_order_id = $_POST["food_id"];
    $rider_id = $_SESSION["id"];

    $sql = "UPDATE food_order SET status = 'ไรเดอร์กำลังไปรอรับอาหารจากร้านค้า', rider_id = '$rider_id' WHERE id = '$food_order_id'";
    $result = $conn->query($sql);

    $sql = "UPDATE rider SET status_order = 'รับออเดอร์' WHERE id = '$rider_id'";
    $result = $conn->query($sql);

    echo "
    <script>
        alert('รับออเดอร์เรียบร้อยแล้ว');
        window.location = 'order_status.php';
    </script>";
}
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
    <h1>รายการอาหารที่สั่งของลูกค้า</h1>
    <div class="d-flex flex-row justify-content-center align-items-start flex-wrap">
        <?php
        $rider_id = $_SESSION["id"];

        $sql = "SELECT * FROM rider WHERE id = '$rider_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $status = $row["status"];
        $status_order = $row["status_order"];

        if ($status == "อนุมัติ") {
            if ($status_order == "รอรับออเดอร์") {
                $sql = "SELECT * FROM food_order WHERE status = 'รอคนขับ'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $food_id = $row["food_id"];
                    $count = $row["count"];
                    $total_price = $row["total_price"];
                    ///////////////////////////////////////////
                    $sql2 = "SELECT * FROM food WHERE id = '$food_id'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $food_name = $row2["name"];
                    $restaurant_id = $row2["restaurant_id"];
                    ///////////////////////////////////////////
                    $sql3 = "SELECT * FROM restaurant WHERE id = '$restaurant_id'";
                    $result3 = $conn->query($sql3);
                    $row3 = $result3->fetch_assoc();
                    $restaurant_name = $row3["restaurant_name"];
                    $restaurant_address = $row3["address"];
                    ///////////////////////////////////////////
                    echo "
                    <div class='card m-2' style='width: 18rem;'>
                        <div class='card-body'>
                            <h2 class='card-title'>ชื่อร้าน : $restaurant_name</h2>
                            <p class='card-text'>ที่อยู่ : $restaurant_address</p>
                            <p class='card-text'>อาหาร : $food_name</p>
                            <p class='card-text'>จำนวน : $count</p>
                            <p class='card-text'>ราคา : $total_price บาท</p>
                        </div>
                        <center>
                            <div class='card-footer'>
                                <form action='' method='post'>
                                    <button class='btn btn-primary mt-1' type='submit' value='$id' name='food_id'>รับออเดอร์</button>
                                </form>
                            </div>
                        </center>
                    </div>
                    ";
                }
            } else {
                echo "<p>คุณต้องส่งออเดอร์ปัจจุบันให้เสร็จก่อน ถึงจะรับออเดอร์ใหม่ได้</p>";
            }
        } else {
            echo "<p>รอการอนุมัติจาก admin ถึงจะรับออเดอร์ลูกค้าได้</p>";
        }
        ?>
    </div>
</body>

</html>