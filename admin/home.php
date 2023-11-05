<?php
session_start();
include("check_login.php");
include("check_type.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>หน้าแรก</title>
</head>

<body data-bs-theme="dark">
    <?php include("navbar.php"); ?>
</body>

</html>