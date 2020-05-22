<?php
$title = 'Rak';
include "../include/header.php";
?>

<?php
$xcrud->table('rak');
$xcrud->table_name('Data Rak');
echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>