<?php
require("koneksi.php");

// Fungsi untuk mendapatkan data berdasarkan rentang tanggal
//mengambl data berdasarkan tanggal filter 
function getDataByDateRange($conn, $startDate, $endDate) {
    $startDate = mysqli_real_escape_string($conn, $startDate);
    $endDate = mysqli_real_escape_string($conn, $endDate);
    // Query SQL untuk memilih data dari tabel ttamu berdasarkan rentang tanggal
    $query = "SELECT * FROM ttamu WHERE tanggal BETWEEN '$startDate' AND '$endDate'";
    //eksekusi
    $result = mysqli_query($conn, $query);
    
     // Memeriksa hasil query SELECT
    if ($result) {
        // Mengembalikan hasil query sebagai objek hasil (result)
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

// Memeriksa aksi edit
//Dilakukan pengecekan apakah terdapat parameter query string dengan nama 'aksi' dan nilai 'edit'.
if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit') {
    // Mengambil nilai 'id' dari parameter query string
    $id = $_GET['id'];
    header("Location: edit_formrekap.php?id=$id");
    //berhentiiii
    exit();

}

// Memeriksa aksi delete
//pengecekan apakah terdapat parameter query string dengan nama 'aksi' dan nilai 'delete'.
if (isset($_GET['aksi']) && $_GET['aksi'] == 'delete') {
    // Mengambil nilai 'id' dari parameter query string
    $id = $_GET['id'];
    // Query SQL untuk menghapus data dari tabel ttamu berdasarkan nilai 'id'
    $queryDelete = "DELETE FROM ttamu WHERE id = $id";
    // Menjalankan query DELETE dan memeriksa hasilnya
    if (mysqli_query($conn, $queryDelete)) {
        // alert setelah berhasil menghapus
        echo '<script>';
        echo 'alert("Data berhasil dihapus!");';
        echo 'window.location.href = "' . $_SERVER['PHP_SELF'] . '";';
        echo '</script>';
        exit();
    } else {
        //jika ada salah pesan error 
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicons -->
    <link href="assets/img/logopudam.png" rel="icon">
    <link href="assets/img/logopudam.png" rel="icon-logo">
    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <title>Rekapitulasi Pengunjung</title>
</head>

<body class="bg-gradient-primary">
    <!-- Awal container -->
    <div class="container">
        <!-- Awal row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow bg-gradient-light mx-lg-5">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary text-center">Rekapitulasi Pengunjung</h4>
                    </div>
                    <div class="card-body">
                        <!-- Formulir untuk memfilter data berdasarkan tanggal -->
                        <form method="POST" action="">
                            <div class="form-group row">
                                <label for="start_date" class="col-sm-2 col-form-label">Dari Tanggal</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $startDate; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="end_date" class="col-sm-2 col-form-label">Hingga Tanggal</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $endDate; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                                </div>
                            </div>
                        </form>

                        <!-- Tampilkan tabel data pengunjung -->
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                <thead>
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
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($dataRentangTanggal)) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['tanggal'] ?></td>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['alamat'] ?></td>
                                            <td><?= $data['instansi'] ?></td>
                                            <td><?= $data['kontak'] ?></td>
                                            <td>
                                            <!-- Tombol Edit dan Hapus) -->
                                    <a href="?aksi=edit&id=<?= $data['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>Edit</a>
                                    <a href="?aksi=delete&id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i>Hapus</a>
                                    </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tombol untuk kembali -->
                        <a href="admin.php" class="btn btn-secondary">Kembali</a>
                         <!-- Tombol untuk mengekspor data ke Excel -->
                         <center>
                            <form method="POST" action="export_excel.php">
                                <input type="hidden" name="start_date" value="<?= @$_POST['start_date']?>">
                                <input type="hidden" name="end_date" value="<?= @$_POST['end_date']?>">
                                <button type="submit" class="btn btn-success"><i class="fas fa-download"></i>Ekspor ke Excel</button>
                            </form>
                         </center>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir row -->
    </div>
    <!-- Akhir container -->

    <!-- Tambahkan tag-script dan tautan ke file JavaScript atau jQuery jika diperlukan -->
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
