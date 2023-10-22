<?php
//ตรวจสอบว่ามีการเข้าสู่ระบบแล้วหรือไม่ ถ้าไม่มีให้กลับไปหน้า index.php
if (isset($_SESSION["id"]) == false) {
    header('Location: ../index.php');
    exit;
}
?>
