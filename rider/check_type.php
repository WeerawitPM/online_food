<?php
//ตรวจสอบว่าประเภทของผู้ใช้เป็น rider หรือไม่ ถ้าไม่ใช่ให้กลับไปหน้า index.php
if ($_SESSION["type"] != "rider") {
    header("Location: ../index.php");
    exit();
}
?>