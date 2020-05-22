<?php
$title = 'Pengarang';
include "../include/header.php";
?>

<?php
$xcrud->table('pengarang');
$xcrud->table_name('Data Pengarang');
echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>