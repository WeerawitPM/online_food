<?php
//เริ่มต้นการทำงานของ session
session_start();
//ล้างค่า session ทั้งหมด
session_destroy();
//ย้อนกลับไปหน้า index.php
header('Location: index.php');
exit;
?>