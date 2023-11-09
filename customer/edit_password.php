<?php
$title = "เปลี่ยนรหัสผ่าน";
include("navbar.php");

if (isset($_POST["old_password"])) {
    $id = $_SESSION["id"];
    $old_password = md5($_POST["old_password"]);
    $new_password = md5($_POST["new_password"]);
    $confirm_password = md5($_POST["confirm_password"]);

    $sql = "SELECT * FROM customer WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($old_password != $row["password"]) {
        echo "<script>alert('รหัสผ่านเดิมไม่ถูกต้อง')</script>";
    } else if ($new_password != $confirm_password) {
        echo "<script>alert('รหัสผ่านใหม่ไม่ตรงกัน')</script>";
    } else {
        $sql = "UPDATE customer SET password = '$new_password' WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            echo "
                <script>
                    alert('เปลี่ยนรหัสผ่านสำเร็จ');
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
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card fs-5">
            <div class="card-header text-center">
                <h1 class="mx-5">Change Password</h1>
            </div>
            <form action="" method="post">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Old Password</label>
                        <input type="password" name="old_password" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control form-control-lg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control form-control-lg" required>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-success">Save</button>
                    <a href="profile.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>