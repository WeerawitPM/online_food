<?php
if (isset($_SESSION["id"])) {
    if ($_SESSION["type"] == "customer") {
        header('Location: customer/home.php');
        exit;
    } else if ($_SESSION["type"] == "restaurant") {
        header('Location: restaurant/home.php');
        exit;
    } else if ($_SESSION["type"] == "rider") {
        header('Location: rider/home.php');
        exit;
    } else if ($_SESSION['type'] == 'admin') {
        header('Location: admin/home.php');
        exit;
    } else {
        header('Location: index.php');
        exit;
    }
}
?>