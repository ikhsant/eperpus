<?php
include 'include/database.php';
session_start();

$query_kategori = mysqli_query($conn,"SELECT * FROM kategori");

if (isset($_POST['submit'])) {
  $nama              = $_POST['nama'];
  $kelas             = $_POST['kelas'];
  $hp                = $_POST['hp'];
  $tanggal_kunjungan = $_POST['tanggal_kunjungan'];

  mysqli_query($conn,"INSERT INTO tamu (nama,kelas,tanggal_kunjungan,hp) VALUES ('$nama','$kelas','$tanggal_kunjungan','$hp') ");

  $_SESSION['isiBukuTamu'] = true;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Perpus</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/css/font-awesome.css">
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
    .jumbotron {
      padding-top: 10px;
      padding-bottom: 10px;
      margin-bottom: 0;
      background-color: #f2f2f2;
    }

    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

  <div class="jumbotron">
    <div class="container text-center">
     <img src="assets/images/logo.png" alt="Logo">
   </div>
 </div>

 <nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <?php foreach ($query_kategori as $kategori): ?>
          <li><a href="index.php?kategori=<?= $kategori['nama_kategori'] ?>"><?= $kategori['nama_kategori'] ?></a></li>
        <?php endforeach ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="buku_tamu.php"><span class="fa fa-book"></span> Buku Tamu</a></li>
        <li><a href="admin/login.php"><span class="fa fa-sign-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">    
  <div class="row">
    <div class="col-sm-12 text-center">
      <h1>Buku Tamu</h1>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-primary">
        <div class="panel-body">
          <?php if (isset($_SESSION['isiBukuTamu'])): ?>
            <h3>Terimakasih. Anda Sudah mengisi Buku Tamu!!</h3>
          <?php else: ?>
          <form method="post">
            <div class="form-group">
              <label>NAMA</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
              <label>No.Whatsapp</label>
              <input type="number" name="hp" class="form-control" required>
            </div>
            <div class="form-group">
              <label>KELAS</label>
              <input type="text" name="kelas" class="form-control" required>
            </div>
            <div class="form-group">
              <label>TANGGAL KUNJUNGAN</label>
              <input type="text" name="tanggal_kunjungan" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" readonly>
            </div>
            <button class="btn btn-primary" type="submit" name="submit">SIMPAN</button>
        </form>
          <?php endif ?>
          </div>
      </div>
    </div>
  </div>
</div><br>


<footer class="container-fluid text-center">
  <p>Copyright @2020 E-PERPUS</p>  
</footer>

</body>
</html>
