<!-- <nav>
    <a href="home.php">หน้าแรก</a>
    <a href="order_status.php">สถานะคำสั่งซื้อ</a>
    <a href="order_history.php">ประวัติคำสั่งซื้อ</a>
    <a href="profile.php">ข้อมูลส่วนตัว</a>
    <a href="../logout.php">ออกจากระบบ</a>
</nav> -->
<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

$username = $_SESSION["username"];
$img = $_SESSION["image"];
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">FoodDelivery</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order_status.php">สถานะคำสั่งซื้อ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order_history.php">ประวัติคำสั่งซื้อ</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $username ?>
                        <img src="<?php echo $img ?>" width="40" height="40" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../logout.php">Sign out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>