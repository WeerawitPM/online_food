<?php
//ตรวจสอบว่าประเภทของผู้ใช้เป็น customer หรือไม่ ถ้าไม่ใช่ให้กลับไปหน้า index.php
if ($_SESSION["type"] != "customer") {
    header("Location: ../index.php");
}
?>