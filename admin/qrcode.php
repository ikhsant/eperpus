<?php
include '../include/header.php';
include "../phpqrcode/qrlib.php"; 

if (!isset($_GET['buku'])) {
	header('Location: buku.php');
}

$id_buku = $_GET['buku'];

$buku = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM buku WHERE id_buku = '$id_buku' "));
$judul_buku = $buku['judul'];

$tempdir = "temp/"; 
if (!file_exists($tempdir)) mkdir($tempdir);

    //isi qrcode jika di scan
$codeContents = 'https://localhost/eperpus/index.php?detal='.$id_buku; 

 //simpan file kedalam folder temp dengan nama 001.png
QRcode::png($codeContents,$tempdir.$id_buku.".png",QR_ECLEVEL_H,6); 


echo '<h2>'.$judul_buku.'</h2>';
 //menampilkan file qrcode 
echo '<img src="'.$tempdir.$id_buku.'.png" />';
?>
<br>
<a href="buku.php" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>