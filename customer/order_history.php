<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>ประวัติคำสั่งซื้อ</title>
</head>

<body data-bs-theme="dark">
    <?php include("navbar.php"); ?>
    <h1>ประวัติคำสั่งซื้อ</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ชื่ออาหาร</th>
                <th>จำนวน</th>
                <th>ราคา</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $customer_id = $_SESSION["id"];
            $status = "เสร็จสิ้น";
            $sql = "SELECT * FROM food_order WHERE customer_id = '$customer_id' AND status = '$status'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $food_id = $row["food_id"];
                    $food_count = $row["food_count"];
                    $total_price = $row["total_price"];

                    $sql = "SELECT * FROM food WHERE id = '$food_id'";
                    $result2 = $conn->query($sql);
                    $row2 = $result2->fetch_assoc();
                    $name = $row2["name"];
                    $image = $row2["image"];

                    echo "<tr>";
                    echo "<td>$name</td>";
                    echo "<td>$food_count</td>";
                    echo "<td>$total_price</td>";
                    echo "</tr>";
                }
            } else {
                echo "<h2>ไม่มีประวัติคำสั่งซื้อ</h2>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>