<?php
require("koneksi.php");

// Fungsi untuk mendapatkan data berdasarkan rentang tanggal
function getDataByDateRange($conn, $startDate, $endDate) {
    // Query SQL untuk memilih data dari tabel ttamu berdasarkan rentang tanggal
    $query = "SELECT * FROM ttamu WHERE tanggal BETWEEN '$startDate' AND '$endDate'";
    //eksekusi
    $result = mysqli_query($conn, $query);
    
    // Memeriksa hasil query SELECT
    if ($result) {
        return $result;
    } else {
    // Jika terdapat kesalahan dalam query SELECT, mengembalikan array kosong
        return [];
    }
}

// Menginisialisasi variabel untuk rentang tanggal awal dan akhir
$startDate = date('Y-m-d', strtotime('-1 month'));
$endDate = date('Y-m-d');

// Memeriksa apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data tanggal dari formulir
    $startDate = mysqli_real_escape_string($conn, $_POST['start_date']);
    $endDate = mysqli_real_escape_string($conn, $_POST['end_date']);
}

// Mendapatkan data dalam rentang waktu tertentu
$dataRentangTanggal = getDataByDateRange($conn, $startDate, $endDate);

// Membuat file Excel
$filename = "export_pengunjung_" . date('Ymd') . ".xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");

echo '<table border="1">';
echo '<thead>';
echo '<tr>';
echo '<th>No</th>';
echo '<th>Tanggal</th>';
echo '<th>Nama</th>';
echo '<th>Alamat</th>';
echo '<th>Instansi</th>';
echo '<th>Kontak</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

//Menginisialisasi variabel $no dengan nilai 1 
//loop while data $dataRentangTanggal.
//disimpan di $data
$no = 1;
while ($data = mysqli_fetch_array($dataRentangTanggal)) {
    echo '<tr>';
    echo '<td>' . $no++ . '</td>';
    echo '<td>' . $data['tanggal'] . '</td>';
    echo '<td>' . $data['nama'] . '</td>';
    echo '<td>' . $data['alamat'] . '</td>';
    echo '<td>' . $data['instansi'] . '</td>';
    echo '<td>' . $data['kontak'] . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
?>
