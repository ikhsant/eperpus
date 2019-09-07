<?php
$title = 'Pasien';
include "../include/header.php";
?>

<?php
$xcrud->table('pasien');
$xcrud->table_name('Data Pasien');
$xcrud->relation('id_dokter','user','id_user','nama_user','akses_level = "dokter"');
$xcrud->change_type('jenis_kelamin','select','','L,P');
$xcrud->label('id_dokter','Dokter yang Menangani');
$xcrud->fields('diagnosis',true);
$xcrud->button('resep.php?id_pasien={id_pasien}','Resep','fa fa-stethoscope');
$xcrud->unset_view();

echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>