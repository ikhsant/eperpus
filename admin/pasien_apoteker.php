<?php
$title = 'Pasien';
include "../include/header.php";
?>

<?php
$xcrud->table('pasien');
$xcrud->table_name('Pasien');
$xcrud->relation('id_dokter','user','id_user','nama_user','akses_level = "dokter"');
$xcrud->change_type('jenis_kelamin','select','','L,P');
$xcrud->label('id_dokter','Dokter yang Menangani');
$xcrud->columns('no_rm,nama_pasien,umur,jenis_kelamin,diagnosis,id_dokter',false);
$xcrud->fields('nama_pasien,diagnosis,id_dokter',false);
$xcrud->button('resep.php?id_pasien={id_pasien}','Resep','fa fa-stethoscope');
$xcrud->readonly('nama_pasien');
$xcrud->unset_add();
$xcrud->unset_edit();
$xcrud->unset_remove();
$xcrud->unset_view();
echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>