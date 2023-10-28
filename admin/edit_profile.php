<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

if (isset($_POST["firstname"])) {
    $id = $_SESSION["id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $email = $_POST["email"];

    $sql = "UPDATE admin SET firstname = '$firstname', lastname = '$lastname', phone = '$phone', email = '$email' WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "
                <script>
                    alert('แก้ไขข้อมูลสำเร็จ');
                    window.location = 'profile.php';
                </script>
            ";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลส่วนตัว</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>แก้ไขข้อมูลส่วนตัว</h1>
    <form action="edit_profile.php" enctype="multipart/form-data" method="post">
        <?php
        $id = $_SESSION["id"];
        $sql = "SELECT * FROM admin WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $username = $row["username"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $phone = $row["phone"];
        $email = $row["email"];

        echo "
            <p>
                <label for='username'>Username</label>
                <input type='text' name='username' id='username' value='$username' disabled>
            </p>
            <p>
                <label for='firstname'>ชื่อ</label>
                <input type='text' name='firstname' id='firstname' value='$firstname' required>
            </p>
            <p>
                <label for='lastname'>นามสกุล</label>
                <input type='text' name='lastname' id='lastname' value='$lastname' required>
            </p>
            <p>
                <label for='phone'>เบอร์โทรศัพท์</label>
                <input type='text' name='phone' id='phone' value='$phone' required>
            </p>
            <p>
                <label for='email'>อีเมล</label>
                <input type='email' name='email' id='email' value='$email'>
            </p>
            <button type='submit'>บันทึก</button>
        ";
        $conn->close();
        ?>
    </form>
</body>

</html>