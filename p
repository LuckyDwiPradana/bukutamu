require("koneksi.php");

@$pass = md5($_POST['password']);
@$username = mysqli_escape_string($conn, $_POST['username']);
@$password = mysqli_escape_string($conn, $pass);

$login = mysqli_query($conn, "SELECT * FROM tuser WHERE username = '$username' AND password = '$password'");

$data = mysqli_fetch_array($login);

if($data){
    $_SESSION['id_user']=$data['id_user'];
    $_SESSION['username']=$data['username'];
    $_SESSION['password']=$data['password'];

    header('location:admin.php');}
    else{echo "<script>alert('maaf')</script>";

}


CREATE TABLE IF NOT EXISTS tusers (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

                         <!-- <a href="export_excel.php?start_date=<?= $startDate ?>&end_date=<?= $endDate ?>" class="btn btn-success"> <i class="fas fa-download"></i>Export to Excel</a> -->
