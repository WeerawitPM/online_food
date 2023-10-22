<?php
//ตรวจสอบว่าประเภทของผู้ใช้เป็น admin หรือไม่ ถ้าไม่ใช่ให้กลับไปหน้า index.php
if (($_SESSION["type"]) != "admin") {
    header("Location: ../index.php");
    exit;
}
?>