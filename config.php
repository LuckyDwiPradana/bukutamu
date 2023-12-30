<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bukutamu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $instansi = mysqli_real_escape_string($conn, $_POST['instansi']);
    $kontak = mysqli_real_escape_string($conn, $_POST['kontak']);

    // Tanggal bisa diisi otomatis atau diisi sesuai dengan kebutuhan
    $tanggal = date("Y-m-d");

    // SQL query to insert data into the ttamu table
    $query = "INSERT INTO ttamu (nama, alamat, instansi, tanggal, kontak) VALUES ('$nama', '$alamat', '$instansi', '$tanggal', '$kontak')";

    if ($conn->query($query) === TRUE) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

?>