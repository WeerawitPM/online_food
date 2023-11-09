<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");

$username = $_SESSION["username"];
$img = $_SESSION["image"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>
        <?= $title ?>
    </title>
</head>

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
            <div class="btn-group">
                <span class="m-auto me-2">
                    <?= $username ?>
                </span>
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="<?= $img ?>" width="40" height="40" class="rounded-circle">
                </a>
                <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="../logout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>