<?php
include 'include/database.php';

if (!isset($_GET['id'])) {
  header('Location: index.php');
}
$id_buku = $_GET['id'];
$buku = mysqli_fetch_assoc(mysqli_query($conn,"
  SELECT * 
  FROM buku 
  JOIN kategori 
  ON buku.kategori = kategori.id_kategori

  "));
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
          <li><a href="index.php?kategori=<?= $kategori['nama_kategori'] ?>"><?= $kategori['nama_kategori'] ?></a></li>
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
      <h1>Detail Buku</h1>
    </div>
    
  </div>
  <hr>
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-body"><img src="uploads/<?= $buku['cover'] ?>" class="img-responsive" style="width:100%" alt="Image"></div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="panel panel-primary">
        <div class="panel-body">
          <h2><?= $buku['judul'] ?></h2>
          <dt class="col-sm-3">Judul</dt>
          <dd class="col-sm-9"><?= $buku['judul'] ?></dd>

          <dt class="col-sm-3">Kategori</dt>
          <dd class="col-sm-9"><a href="index.php?kategori=<?= $buku['nama_kategori'] ?>"><?= $buku['nama_kategori'] ?></a></dd>

          <dt class="col-sm-3">Sinopsis</dt>
          <dd class="col-sm-9"><?= $buku['sinopsis'] ?></dd>

        </div>
      </div>
    </div>
  </div>

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
