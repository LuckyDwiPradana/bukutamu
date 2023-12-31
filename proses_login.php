<?php
session_start();
require("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query SQL untuk memeriksa keberadaan pengguna dengan username dan password yang sesuai
    $query = "SELECT * FROM tusers WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Memeriksa jumlah baris yang ditemukan
        if (mysqli_num_rows($result) == 1) {
            // Pengguna ditemukan, set session dan arahkan ke halaman yang sesuai
            $_SESSION['username'] = $username;
            header("location: admin.php"); // Sesuaikan dengan halaman yang sesuai
        } else {
            // Jika tidak ada pengguna yang ditemukan, tampilkan pesan kesalahan menggunakan JavaScript
            echo '<script>';
            echo 'alert("Username atau password salah!");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
            exit();
        }
    } else {
        // Jika query gagal dijalankan, tampilkan pesan kesalahan dan redirect ke login.php
        echo "Error: " . mysqli_error($conn);
        header("location: login.php");
        exit();
    }
}
?>
