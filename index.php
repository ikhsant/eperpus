<?php
include 'include/database.php';
session_start();


if (isset($_GET['kategori'])) {
  $nama_kategori = $_GET['kategori'];
  $where = "WHERE kategori.nama_kategori = '$nama_kategori' ";
}elseif(isset($_GET['detail'])){
  $id_buku = $_GET['detail'];
  $where = "WHERE buku.id_buku = '$id_buku' ";

  // peminjaman
  $query_peminjaman = mysqli_query($conn,"SELECT * FROM peminjaman JOIN tamu ON tamu.id_tamu = peminjaman.tamu WHERE buku = '$id_buku' ORDER BY tanggal_pinjam DESC ");
  $peminjaman_terakhir = mysqli_fetch_assoc($query_peminjaman);

}else{
  $where = '';
}

$query_buku = mysqli_query($conn,"
  SELECT * FROM buku 
  JOIN kategori ON buku.kategori = kategori.id_kategori 
  JOIN pengarang ON buku.pengarang = pengarang.id_pengarang
  JOIN rak ON rak.id_rak = buku.rak
  $where");

$query_kategori = mysqli_query($conn,"SELECT * FROM kategori");



if (isset($_POST['submit_peminjaman'])) {
  $id_tamu               = $_POST['tamu'];
  $detail_tamu           = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM tamu WHERE id_tamu = '$id_tamu' "));
  $tamu                  = $id_tamu;
  $buku                  = $_POST['buku'];
  $tanggal_pinjam        = $_POST['tanggal_pinjam'];
  $jatuh_tempo           = $_POST['jatuh_tempo'];
  $keterangan_peminjaman = $_POST['keterangan_peminjaman'];

  mysqli_query($conn,"INSERT INTO peminjaman (tamu,buku,tanggal_pinjam,jatuh_tempo,keterangan_peminjaman) VALUES ('$tamu','$buku','$tanggal_pinjam','$jatuh_tempo','$keterangan_peminjaman') ");

  // whatsapp api
    $curl = curl_init();
    $token = "gis0SeZtBRQP1CeMSjACvfe4jnJDu1E4y2131438qjOVoyBe7JZCDCYPDwGHMwkt";
    $data = [
        'phone' => $detail_tamu['hp'],
        'message' => 'Hari ini pengembalian buku ke perpustakaan ya',
        'date' => $jatuh_tempo,
        'time' => '16:20',
    ];

    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array(
            "Authorization: $token",
        )
    );
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/schedule");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    // $result = curl_exec($curl);
    curl_exec($curl);
    curl_close($curl);

    header('Location: index.php?detail='.$id_buku);
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
                <dd class="col-sm-9"><?= $buku['tahun'] ?> </dd>

                <dt class="col-sm-3">Edisi</dt>
                <dd class="col-sm-9"><?= $buku['edisi'] ?> </dd>

                <dt class="col-sm-3">Penerbit</dt>
                <dd class="col-sm-9"><?= $buku['penerbit'] ?> <br></dd>

                <dt class="col-sm-3">RAK</dt>
                <dd class="col-sm-9"><?= $buku['nama_rak'] ?> </dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                  <?= $peminjaman_terakhir['tanggal_pinjam'] ?>
                  <?php if ($peminjaman_terakhir): ?>

                    <?php if ($peminjaman_terakhir['tanggal_kembali']): ?>
                      <span class="label label-success">Tersedia</span>
                    <?php else: ?>
                      <span class="label label-danger">Dipinjam</span>
                    <?php endif ?>

                  <?php else: ?>
                    <span class="label label-success">Tersedia</span>
                  <?php endif ?>
                </dd>
                <br>
                <dt class="col-sm-3">Sinopsis</dt>
                <dd class="col-sm-9"><?= $buku['sinopsis'] ?></dd>


                <?php if (isset($_SESSION['akses_level'])): ?>

                  <div class="col-sm-12">
                    <hr>
                    <h3>Rwayat Peminjaman</h3>
                    <table class="table table-bordered table-striped">
                      <tr>
                        <th>Tanggal</th>
                        <th>Peminjam</th>
                        <th>Lama Pinjaman</th>
                        <th>Kembali</th>
                      </tr>
                      <?php foreach ($query_peminjaman as $peminjaman): ?>
                        <tr>
                          <td><?= $peminjaman['tanggal_pinjam'] ?></td>
                          <td><?= $peminjaman['nama'] ?></td>
                          <td><?= $peminjaman['jatuh_tempo'] ?></td>
                          <td><?= $peminjaman['tanggal_kembali'] ?></td>
                        </tr>
                      <?php endforeach ?>
                    </table>
                  </div>
                  <?php $tamu_query = mysqli_query($conn,"SELECT * FROM tamu") ?>
                  <div class="col-sm-6">
                    <hr>
                    <h3>Input Peminjaman</h3>
                    <?php if ($peminjaman_terakhir['tanggal_kembali'] OR empty($peminjaman_terakhir)): ?>
                      <form method="post">
                        <input type="hidden" name="buku" value="<?= $buku['id_buku'] ?>">
                        <div class="form-group">
                          <label>Peminjam</label>
                          <select name="tamu" class="form-control" required>
                            <?php foreach ($tamu_query as $tamu): ?>
                              <option value="<?= $tamu['id_tamu'] ?>"><?= $tamu['nama'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Tanggal Pinjam</label>
                          <input type="date" name="tanggal_pinjam" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label>Jatuh Tempo</label>
                              <input type="date" name="jatuh_tempo" class="form-control" required>
                        <div class="form-group">
                          <label>Ketearangan</label>
                          <textarea name="keterangan_peminjaman" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-primary" type="submit" name="submit_peminjaman">Submit</button>
                      </form>
                    </div>
                    <?php else: ?>
                      <div class="alert alert-danger">Buku Belum dikembalikan, Jika sudah di kembalikan edit <a href="admin/peminjaman.php">DISINI</a></div>
                    <?php endif ?>

                  <?php endif ?>
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
          <p>Copyright @2020 E-PERPUS</p>  
        </footer>

      </body>
      </html>
