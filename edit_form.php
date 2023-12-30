<?php
require("koneksi.php");



// Check if the form is submitted for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $instansi = mysqli_real_escape_string($conn, $_POST['instansi']);
    $kontak = mysqli_real_escape_string($conn, $_POST['kontak']);

    $queryUpdate = "UPDATE ttamu SET nama='$nama', alamat='$alamat', instansi='$instansi', kontak='$kontak' WHERE id='$id'";

    if (mysqli_query($conn, $queryUpdate)) {
        echo '<script>';
        echo 'alert("Data berhasil diperbarui!");';
        echo 'window.location.href = "admin.php";';
        echo '</script>';
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch data for the selected record
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $querySelect = "SELECT * FROM ttamu WHERE id='$id'";
    $result = mysqli_query($conn, $querySelect);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching record: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Tambahkan tag head sesuai kebutuhan (misalnya, tautan ke CSS) -->
    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <title>Edit Tamu</title>
</head>

<body class="bg-gradient-primary">
  <!-- Awal container -->
<div class="container">
    <!-- Awal row -->
    <div class="row">
        <div class="col-md-12">
        <?php
                // Tampilkan peringatan edit berhasil jika berhasil diedit
                if (!empty($successMessage)) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            ' . $successMessage . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                }
                ?>
            <div class="card shadow bg-gradient-light mx-lg-5">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Tamu</h6>
                </div>
                <div class="card-body">
                    <!-- Formulir untuk mengedit data tamu -->
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="instansi" class="col-sm-2 col-form-label">Instansi</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="instansi" name="instansi" value="<?php echo $data['instansi']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kontak" class="col-sm-2 col-form-label">Kontak</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="kontak" name="kontak" value="<?php echo $data['kontak']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="btn-sm">
                            <a href="admin.php" class="btn btn-secondary btn-block">Kembali</a>
                            </div>
                            <div class="btn-sm">
                            <button type="submit" name="update" class="btn btn-primary btn-block">Perbarui</button>
                            </div>
                        </div>
                    </form>
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
</body>

</html>

