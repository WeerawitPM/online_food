<?php
$title="ข้อมูลส่วนตัว";
include("navbar.php");
?>

<body data-bs-theme="dark">
    <h1>ข้อมูลส่วนตัว</h1>
    <?php
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM customer WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    echo "<img src='" . $row["image"] . "' width='200'>";
    echo "<p>Username: " . $row["username"] . "</p>";
    echo "<p>ชื่อ: " . $row["firstname"] . "</p>";
    echo "<p>นามสกุล: " . $row["lastname"] . "</p>";
    echo "<p>เบอร์โทรศัพท์: " . $row["phone"] . "</p>";
    echo "<p>อีเมล: " . $row["email"] . "</p>";
    echo "<p>ที่อยู่: " . $row["address"] . "</p>";
    ?>
    <a href="edit_profile.php"><button>แก้ไขข้อมูล</button></a>
    <a href="edit_password.php"><button>เปลี่ยนรหัสผ่าน</button></a>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>