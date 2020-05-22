<?php
$title = 'Peminjaman';
include "../include/header.php";
?>

<?php
$xcrud->table('peminjaman');
$xcrud->table_name('Data Peminjaman');
$xcrud->relation('tamu','tamu','id_tamu','nama');
$xcrud->relation('buku','buku','id_buku','judul');

echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>