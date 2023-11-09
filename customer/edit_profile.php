<?php
$title = "แก้ไขข้อมูลส่วนตัว";
include("navbar.php");

$id = $_SESSION["id"];
$sql = "SELECT * FROM customer WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$image = $row["image"];
$username = $row["username"];
$firstname = $row["firstname"];
$lastname = $row["lastname"];
$phone = $row["phone"];
$address = $row["address"];
$email = $row["email"];

if (isset($_POST["firstname"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    if ($_FILES["image"]["name"]) {
        //ลบรูปเก่าออกจากโฟลเดอร์ images
        unlink($image);
        //อัปโหลดไฟล์รูปไปยังโฟลเดอร์ images
        $target_dir = "images/"; //โฟลเดอร์ที่เก็บไฟล์รูป
        $target_file = $target_dir . basename($_FILES["image"]["name"]); //ไฟล์รูปที่อัปโหลด
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //นามสกุลไฟล์รูป
        $image = $target_dir . $username . "." . $imageFileType; //ไฟล์รูปที่จะเก็บลงในฐานข้อมูล
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) { //อัปโหลดไฟล์รูป
            $sql = "UPDATE customer SET firstname = '$firstname', lastname = '$lastname', phone = '$phone', address = '$address', image = '$image' WHERE id = '$id'";
            if ($conn->query($sql) === TRUE) {
                $_SESSION["image"] = $image;
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
        } else {
            echo "<script>alert('อัปโหลดรูปไม่สำเร็จ')</script>";
        }
    } else {
        $sql = "UPDATE customer SET firstname = '$firstname', lastname = '$lastname', phone = '$phone', address = '$address' WHERE id = '$id'";
        if ($conn->query($sql) === TRUE) {
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
    }
    $conn->close();
}
?>

<body data-bs-theme="dark">
    <div class="container d-flex justify-content-center my-5">
        <div class="card">
            <div class="card-header text-center">
                <h1>Edit Profile</h1>
            </div>
            <form action="edit_profile.php" enctype="multipart/form-data" method="post">
                <div class="card-body fs-5">
                    <div class="text-center">
                        <img src="<?= $image; ?>" class="card-img-top" style="min-height: 300px; max-width: 300px;">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Picture</label>
                        <input type="file" name="image" id="image" class="form-control form-control-lg">
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="w-100 me-1">
                            <label for="firstname" class="form-label">Firstname</label>
                            <input type="text" name="firstname" id="firstname" value="<?= $firstname ?>"
                                class="form-control form-control-lg" required>
                        </div>
                        <div class="w-100 ms-1">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" name="lastname" id="lastname" value="<?= $lastname ?>"
                                class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" value="<?= $phone; ?>"
                            class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" value="<?= $address; ?>"
                            class="form-control form-control-lg" required>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="profile.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>