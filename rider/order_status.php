<?php
session_start();
include("check_login.php");
include("check_type.php");
include("../db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการส่งอาหาร</title>
</head>

<body>
    <?php include("navbar.php"); ?>
    <h1>สถานะการส่งอาหาร</h1>
    <?php
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM food_order WHERE rider_id = '$id'";
    ?>
</body>

</html>