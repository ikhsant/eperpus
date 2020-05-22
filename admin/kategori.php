<?php
$title = 'Kategori';
include "../include/header.php";
?>

<?php
$xcrud->table('kategori');
$xcrud->table_name('Data Kategori');
echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>