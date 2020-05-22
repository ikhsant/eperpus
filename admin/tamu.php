<?php
$title = 'Tamu';
include "../include/header.php";
?>

<?php
$xcrud->table('tamu');
$xcrud->table_name('Data Tamu');
echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>