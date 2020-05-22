<?php
$title = 'Buku';
include "../include/header.php";
?>

<?php
$xcrud->table('buku');
$xcrud->table_name('Data Buku');
$xcrud->relation('pengarang','pengarang','id_pengarang','nama_pengarang');
$xcrud->relation('kategori','kategori','id_kategori','nama_kategori');
$xcrud->relation('rak','rak','id_rak','nama_rak');
$xcrud->change_type('cover','image');

echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>