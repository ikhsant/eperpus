<?php
$title = 'User';
include "../include/header.php";
?>

<?php
$xcrud->table('user');
$xcrud->table_name('Data User');

$xcrud->change_type('password', 'password', 'sha1', array('maxlength'=>100,'placeholder'=>'Masukan password'));
$xcrud->change_type('foto', 'image');
$xcrud->change_type('akses_level','select','','admin,dokter,pegawai,apoteker');
echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>