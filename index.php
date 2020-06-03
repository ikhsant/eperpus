<?php
include 'include/database.php';

if (isset($_GET['kategori'])) {
  $nama_kategori = $_GET['kategori'];
  $where = "WHERE kategori.nama_kategori = '$nama_kategori' ";
}elseif(isset($_GET['detail'])){
  $id_buku = $_GET['detail'];
  $where = "WHERE buku.id_buku = '$id_buku' ";
}else{
  $where = '';
}

$query_buku = mysqli_query($conn,"
  SELECT * FROM buku 
  JOIN kategori ON buku.kategori = kategori.id_kategori 
  JOIN pengarang ON buku.pengarang = pengarang.id_pengarang
  $where");

$query_kategori = mysqli_query($conn,"SELECT * FROM kategori");
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
        <li class="active"><a href="?">Home</a></li>
        <?php foreach ($query_kategori as $kategori): ?>
          <li><a href="?kategori=<?= $kategori['nama_kategori'] ?>"><?= $kategori['nama_kategori'] ?></a></li>
        <?php endforeach ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="admin/login.php"><span class="fa fa-sign-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">    
  <div class="row">
    <div class="col-sm-12 text-center">
      <?php if (isset($_GET['kategori'])): ?>
        <h1><?= strtoupper($_GET['kategori']) ?></h1>
        <?php elseif(isset($_GET['detail'])): ?>
          <h1>DETAIL BUKU</h1>
          <?php else: ?>
            <h1>SEMUA BUKU</h1>
          <?php endif ?>
        </div>

      </div>
      <hr>
      <div class="row">
        <?php if (isset($_GET['detail'])): ?>
          <?php $buku = mysqli_fetch_assoc($query_buku) ?>
          <div class="col-sm-4">
            <div class="panel panel-primary">
              <div class="panel-body"><img src="uploads/<?= $buku['cover'] ?>" class="img-responsive" style="width:100%" alt="Image"></div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="panel panel-primary">
              <div class="panel-body">
                
                <dt class="col-sm-12"><h2><?= $buku['judul'] ?></h2></dt>
                <dt class="col-sm-3">Judul</dt>
                <dd class="col-sm-9"><?= $buku['judul'] ?></dd>

                <dt class="col-sm-3">Kategori</dt>
                <dd class="col-sm-9"><a href="index.php?kategori=<?= $buku['nama_kategori'] ?>"><?= $buku['nama_kategori'] ?></a></dd>

                <dt class="col-sm-3">Pengarang</dt>
                <dd class="col-sm-9"><?= $buku['nama_pengarang'] ?></dd>

                <dt class="col-sm-3">Tahun</dt>
                <dd class="col-sm-9"><?= $buku['tahun'] ?></dd>

                <dt class="col-sm-3">Edisi</dt>
                <dd class="col-sm-9"><?= $buku['edisi'] ?></dd>

                <dt class="col-sm-3">Penerbit</dt>
                <dd class="col-sm-9"><?= $buku['penerbit'] ?></dd>

                <dt class="col-sm-3">Sinopsis</dt>
                <dd class="col-sm-9"><?= $buku['sinopsis'] ?></dd>

              </div>
            </div>
          </div>
          <?php else: ?>
            <?php foreach ($query_buku as $buku): ?>
              <div class="col-sm-3">
                <div class="panel panel-primary">
                  <div class="panel-body">
                    <img src="uploads/<?= $buku['cover'] ?>" class="img-responsive" style="width:100%" alt="Image">
                    <h4><?= $buku['judul'] ?></h4>
                    <a href="index.php?detail=<?= $buku['id_buku'] ?>" class="btn btn-success"><i class="fa fa-eye"></i> DETAIL</a>
                  </div>

                </div>
              </div>
            <?php endforeach ?>
          <?php endif ?>

        </div>
      </div><br>


      <footer class="container-fluid text-center">
        <p>Online Store Copyright</p>  
        <form class="form-inline">Get deals:
          <input type="email" class="form-control" size="50" placeholder="Email Address">
          <button type="button" class="btn btn-danger">Sign Up</button>
        </form>
      </footer>

    </body>
    </html>
