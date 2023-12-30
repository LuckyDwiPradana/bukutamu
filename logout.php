<?php
session_start();

// Hapus semua data sesi
session_destroy();

// Redirect ke halaman login setelah logout
header("location: login.php");
exit();
?>
