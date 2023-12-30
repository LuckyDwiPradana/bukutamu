<?php
session_start();

function cekSession() {
    if (empty($_SESSION['username'])) {
        header("location: login.php");
        exit();
    }
}

// Memanggil fungsi cekSession
cekSession();


require("koneksi.php");



// Memeriksa apakah formulir telah disubmit
if (isset($_POST['simpan'])) {
    // Mengambil data dari formulir
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $instansi = mysqli_real_escape_string($conn, $_POST['instansi']);
    $kontak = mysqli_real_escape_string($conn, $_POST['kontak']);
    // Query SQL untuk menyimpan data ke tabel ttamu dengan tanggal otomatis
    $query = "INSERT INTO ttamu (nama, alamat, instansi, kontak, tanggal) VALUES ('$nama', '$alamat', '$instansi', '$kontak', NOW())";
     // Menjalankan query dan memeriksa apakah berhasil
     if (mysqli_query($conn, $query)) {
        // Jika berhasil, lakukan redirect ke halaman yang sama untuk menghindari masalah reload
        echo '<script>';
        echo 'alert("Data berhasil ditambahkan!");';
        echo 'window.location.href = "' . $_SERVER['PHP_SELF'] . '";';
        echo '</script>';
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}


// Fungsi untuk mendapatkan jumlah data berdasarkan tanggal
function getJumlahData($conn, $tanggalCondition) {
    $query = "SELECT COUNT(*) as jumlah FROM ttamu WHERE $tanggalCondition";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['jumlah'];
    } else {
        return 0;
    }
}

// Mendapatkan jumlah data hari ini
$jumlahHariIni = getJumlahData($conn, "DATE(tanggal) = CURDATE()");

// Mendapatkan jumlah data kemarin
$jumlahKemarin = getJumlahData($conn, "DATE(tanggal) = CURDATE() - INTERVAL 1 DAY");

// Mendapatkan jumlah data dalam satu minggu
$jumlahSeminggu = getJumlahData($conn, "DATE(tanggal) BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE()");

// Mendapatkan jumlah data bulan ini
$jumlahBulanIni = getJumlahData($conn, "MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE())");

// Mendapatkan jumlah data keseluruhan
$jumlahKeseluruhan = getJumlahData($conn, "1");


// Memeriksa aksi edit
if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit') {
    $id = $_GET['id'];
    header("Location: edit_form.php?id=$id");
    exit(); // Ensure that no further code is executed after the redirect

}

// Memeriksa aksi delete
if (isset($_GET['aksi']) && $_GET['aksi'] == 'delete') {
    $id = $_GET['id'];
    $queryDelete = "DELETE FROM ttamu WHERE id = $id";
    if (mysqli_query($conn, $queryDelete)) {
        // Redirect atau lakukan sesuatu setelah berhasil menghapus
        echo '<script>';
        echo 'alert("Data berhasil dihapus!");';
        echo 'window.location.href = "' . $_SERVER['PHP_SELF'] . '";';
        echo '</script>';
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


?>







<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Buku Tamu </title>
    <link rel="icon" href="assets/img/logo2.png" type="icon">

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <style>
        body {
            background: url('assets/img/background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white; 
        }
    </style>

</head>

<body class="bg-gradient-white">
         
                  <!-- DataTales Example -->
                  <div class="container mt-3">
                  <div class="card shadow col-md-12 mb-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari ini  [<?=date('d-m-y')?>]</h6>
                        </div>
                        <div class="card-body">
                        <form method="post" action="login.php">
                            <!-- Tombol Rekapitulasi Pengunjung -->
                            <a href="rekapitulasi_pengunjung.php" class="btn btn-success mb-3"><i class="fa fa-table"></i>
                            Rekapitulasi Pengunjung
                            </a>
                            <!-- Tombol Logout -->
                            <button  class="btn btn-danger mb-3" type="submit" name="logout" onclick="return confirm('Apakah Anda yakin ingin logout?')"><i class="fas fa-sign-out-alt"></i>Keluar</button>
                            </form>
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Instansi</th>
                                            <th>Kontak</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $tanggal_hari_ini = date("Y-m-d");
                                    $tampil = mysqli_query($conn, "SELECT * FROM ttamu WHERE tanggal = '$tanggal_hari_ini' ORDER BY id DESC");                            $no = 1;
                            while ($data = mysqli_fetch_array($tampil)) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['tanggal'] ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['alamat'] ?></td>
                                    <td><?= $data['instansi'] ?></td>
                                    <td><?= $data['kontak'] ?></td>
                                    <td>
                                    <a href="?aksi=edit&id=<?= $data['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>Edit</a>
                                    <a href="?aksi=delete&id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i>Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>
    


</body>

</html>