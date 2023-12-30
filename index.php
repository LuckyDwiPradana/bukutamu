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

    <div class="container">
<!-- head -->
        <div class="head text-center" style="margin-top: 20px; margin-bottom: 60px">
            <img src="assets/img/logo2.png" alt="logo" width="200">
            <h2 class="text-white" style="margin-bottom: 10px">Sistem Informasi Buku Tamu<br>Pudam Banyuwangi</h2>
        </div>
        
<!-- end head -->

<!-- awal row  -->
         <div class="row mt-2"> 
            <!-- col lg-7 -->
            <div class="col-lg-7 col-md-12 mb-3">
                <div class="card shadow bg-gradient-light">
                    <!-- card body -->
                    <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Daftar Tamu</h1>
                            </div>
                            <form class="user" method="POST" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control
                                    form-control-user" name="nama" placeholder="Masukan Nama Anda" required> 
                                    </div>
                                <div class="form-group">
                                    <input type="text" class="form-control
                                    form-control-user" name="alamat" placeholder="Alamat" required> 
                                    </div>
                                <div class="form-group">
                                    <input type="text" class="form-control
                                    form-control-user" name="instansi" placeholder="Instansi" required> 
                                    </div>
                                <div class="form-group">
                                    <input type="text" class="form-control
                                    form-control-user" name="kontak" placeholder="Kontak" required> 
                                    </div>
                                    <button type="submit" name="simpan" class="btn btn-primary btn-user btn-block">Simpan</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">By. Pudam Banyuwangi | 2023 - <?=date('Y')?></a>
                            </div>
                    </div>
                    <!-- end card-box -->
                </div>
            </div>
            <!-- end col lg-7 -->
<!-- col lg-5 -->
<div class="col-lg-5 col-md-12 mb-3 ">
    <!-- card -->
    <div class="card shadow ">
        <!-- card body -->
        <div class="card-body">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
            </div>
            <table class="table table-borderless">
                <tr>
                    <td><i class="fas fa-calendar-day text-primary"></i> Hari ini</td>
                    <td>: <?php echo $jumlahHariIni; ?></td>
                </tr>
                <tr>
                    <td><i class="fas fa-calendar-alt text-success"></i> Kemarin</td>
                    <td>: <?php echo $jumlahKemarin; ?></td>
                </tr>
                <tr>
                    <td><i class="fas fa-calendar-week text-warning"></i> Seminggu terakhir</td>
                    <td>: <?php echo $jumlahSeminggu; ?></td>
                </tr>
                <tr>
                    <td><i class="fas fa-calendar-alt text-info"></i> Bulan ini</td>
                    <td>: <?php echo $jumlahBulanIni; ?></td>
                </tr>
                <tr>
                    <td><i class="fas fa-calendar text-danger"></i> Keseluruhan</td>
                    <td>: <?php echo $jumlahKeseluruhan; ?></td>
                </tr>
            </table>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>
<!-- end col lg-5 -->


        </div>
<!-- end row -->


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