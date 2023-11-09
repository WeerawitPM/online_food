<?php
$title = "ข้อมูลส่วนตัว";
include("navbar.php");

$id = $_SESSION["id"];
$sql = "SELECT * FROM customer WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$image = $row["image"];
$username = $row["username"];
$firstname = $row["firstname"];
$lastname = $row["lastname"];
$email = $row["email"];
$phone = $row["phone"];
$address = $row["address"];
?>

<body data-bs-theme="dark">
    <div class="container d-flex justify-content-center my-5">
        <div class="card">
            <div class="card-header text-center">
                <h1>Your Profile</h1>
            </div>
            <div class="card-body fs-5">
                <img src="<?= $image ?>" class="card-img-top mx-auto" style="min-height: 300px; max-width: 300px;">
                <div>Username :
                    <?= $username ?>
                </div>
                <div>Firstname :
                    <?= $firstname ?>
                </div>
                <div>Lastname :
                    <?= $lastname ?>
                </div>
                <div>Email :
                    <?= $email ?>
                </div>
                <div>Phone :
                    <?= $phone ?>
                </div>
                <div>Address :
                    <?= $address ?>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    <a href="edit_profile.php" class="btn btn-warning my-1">Edit Profile</a>
                    <a href="edit_password.php" class="btn btn-danger my-1">Change Password</a>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>