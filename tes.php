<?php


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
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Buku Tamu - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrapp.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconify-icons/ri@v1.0.3/dist/styles/ri.css">


  


  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/style1.css" rel="stylesheet">


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
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@iconify-icons/ri@v1.0.3/dist/styles/ri.css">


  <!-- =======================================================
  * Template Name: Logis
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Pudam Banyuwangi</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#hero">Beranda</a></li>
          <li><a href="#form">Tabel</a></li>
          <li><a href="#">Kontak</a></li>
          <li><a class="get-a-quote" href="login.php">Login</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2 data-aos="fade-up">Your Lightning Fast Delivery Partner</h2>
          <p data-aos="fade-up" data-aos-delay="100">Facere distinctio molestiae nisi fugit tenetur repellat non praesentium nesciunt optio quis sit odio nemo quisquam. eius quos reiciendis eum vel eum voluptatem eum maiores eaque id optio ullam occaecati odio est possimus vel reprehenderit</p>
        </div>

        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <img src="assets/img/hero-img.svg" class="img-fluid mb-3 mb-lg-0" alt="">
        </div>

      </div>
    </div>
  </section><!-- End Hero Section -->

<!-- ======= Hero Section ======= -->
<section id="form" class="form pt-0 bg-gradient-light">
  <div class="container" data-aos="fade-up" data-aos-delay="500">
  <div class="section-title text-center">
          <h2>Buku Tamu</h2>
          <p>Buku Tamu</p>
        </div>
    <!-- awal row  -->
    <div class="row mt-2">
      <!-- col lg-7 -->
      <div class="col-lg-10 col-md-12 mb-4">
        <div class="card shadow bg-gradient-light" data-aos="fade-up" data-aos-delay="500">
          <!-- card body -->
          <div class="card-body">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Daftar Tamu</h1>
            </div>
            <form class="user mx-auto" method="POST" action="">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" name="nama" placeholder="Masukan Nama Anda" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" name="instansi" placeholder="Instansi" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" name="kontak" placeholder="Kontak" required>
              </div>
              <button type="submit" name="simpan" class="btn btn-primary btn-user btn-block">Simpan</button>
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href="#">By. Pudam Banyuwangi | 2023 - <?= date('Y') ?></a>
            </div>
          </div>
          <!-- end card-box -->
        </div>
      </div>
      <!-- end col lg-7 -->
      </section><!-- End Hero Section -->

      <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
          <h1>Powerful Digital Solutions With Gp<span>.</span></h1>
          <h2>We are team of talented digital marketers</h2>
        </div>
      </div>

      <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
        <div class="col-xl-2 col-md-4">
          <div class="icon-box ">
            <i class="ri-alarm-line"></i>
            <h3><a href="">Hari ini</a></h3>
            <div data-purecounter-start="100" data-purecounter-end="<?php echo $jumlahHariIni; ?>" data-purecounter-duration="1" class="purecounter blue-text" style="font-size: 36px; margin-top:10px;"></div>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri-calendar-todo-line"></i>
            <h3><a href="">Kemarin</a></h3>
            <div data-purecounter-start="100" data-purecounter-end="<?php echo $jumlahKemarin; ?>" data-purecounter-duration="1" class="purecounter blue-text" style="font-size: 36px; margin-top:10px;"></div>

          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri-calendar-event-line"></i>
            <h3><a href="">Minggu ini</a></h3>
            <div data-purecounter-start="100" data-purecounter-end="<?php echo $jumlahSeminggu; ?>" data-purecounter-duration="1" class="purecounter blue-text" style="font-size: 36px; margin-top:10px;"></div>

          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri-calendar-line"></i>
            <h3><a href="">Bulan ini</a></h3>
            <div data-purecounter-start="100" data-purecounter-end="<?php echo $jumlahBulanIni; ?>" data-purecounter-duration="1" class="purecounter blue-text" style="font-size: 36px; margin-top:10px;"></div>

          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri-bar-chart-line"></i>
            <h3><a href="">Keseluruhan</a></h3>
            <div data-purecounter-start="100" data-purecounter-end="<?php echo $jumlahKeseluruhan; ?>" data-purecounter-duration="1" class="purecounter blue-text" style="font-size: 36px; margin-top:10px;"></div>

          </div>
        </div>
      </div>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action" class="call-to-action">
      <div class="container" data-aos="zoom-out">

        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
            <h3>Call To Action</h3>
            <p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <a class="cta-btn" href="https://linktr.ee/pudambanyuwangi" target="_blank">Call To Action</a>
          </div>
        </div>

      </div>
    </section><!-- End Call To Action Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title text-center">
          <h2>Kontak</h2>
          <p>Kontak Kami</p>
        </div>

        <div class="row mt-5">

        <div class="col-lg-8 mt-5 mt-lg-0">

        <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.7246572717045!2d114.36029237373349!3d-8.230419282624355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd15ac8c66262d7%3A0x79f5c192f5b04551!2sPUDAM%20Banyuwangi%20(Perusahaan%20Umum%20Daerah%20Air%20Minum)!5e0!3m2!1sid!2sid!4v1703740660437!5m2!1sid!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        </div>

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>Jl. Adi Sucipto No.44, Sobo, Banyuwangi</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>0333-423615</p>
              </div>

            </div>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.html" class="logo d-flex align-items-center">
            <span>PUDAM Banyuwangi</span>
          </a>
          <p class="align-justify">PUDAM (Perusahaan Umum Daerah Air Minum) merupakan perusahaan milik daerah sebagai sarana penyediaan air bersih bagi masyarakat umum yang diawasi dan dimonitor oleh aparat-aparat eksekutif maupun legislatif daerah.</p>
          <p class="align-justify">Di setiap provinsi, kabupaten, dan kotamadya seluruh Indonesia terdapat PUDAM, dimana air bersih sangat penting dan merupakan kebutuhan yang harus dipenuhi.</p>
          <div class="social-links d-flex mt-4">
            <!-- whatsapp -->
            <a href="https://wa.me/+628113477666?text=Halo+Cs+PUDAM+Banyuwangi" type="button" class="btn btn-floating btn-primary btn-lg"><i class="bi bi-whatsapp"></i></a>
            <!-- instagram -->
            <a href= "https://www.instagram.com/pudam_banyuwangi" type="button" class="btn btn-floating btn-primary btn-lg"><i class="bi bi-instagram"></i></a>
            <!-- browser -->
            <a href= "http://www.pudambanyuwangi.co.id/" type="button" class="btn btn-floating btn-primary btn-lg"><i class="bi bi-browser-chrome"></i></a>
            <!-- youtube -->
            <a href="https://www.youtube.com/@pudambanyuwangi" type="button" class="btn btn-floating btn-primary btn-lg"><i class="bi bi-youtube"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>
            A108 Adam Street <br>
            New York, NY 535022<br>
            United States <br><br>
            <strong>Phone:</strong> +1 5589 55488 55<br>
            <strong>Email:</strong> info@example.com<br>
          </p>

        </div>

      </div>
    </div>

    <div class="container mt-4">
      <div class="copyright">
        &copy; Copyright <strong><span>Logis</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <!-- Vendor JS Files -->



  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
   <!-- Bootstrap core JavaScript-->
   <script src="assets/vendor/jquery/jquery.min.js"></script>


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