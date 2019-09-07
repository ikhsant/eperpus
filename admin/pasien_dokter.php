<?php
$title = 'Pasien Dokter';
include "../include/header.php";
$id_dokter = $_SESSION['id_user'];
?>

<?php
$xcrud->table('pasien');
$xcrud->where('id_dokter', $id_dokter);
$xcrud->table_name('Pasien Dokter '.$_SESSION['nama']);
$xcrud->relation('id_dokter','user','id_user','nama_user','akses_level = "dokter"');
$xcrud->change_type('jenis_kelamin','select','','L,P');
$xcrud->label('id_dokter','Dokter yang Menangani');
$xcrud->columns('no_rm,nama_pasien,umur,jenis_kelamin,diagnosis',false);
$xcrud->fields('nama_pasien,diagnosis',false);
$xcrud->button('resep.php?id_pasien={id_pasien}','Resep','fa fa-stethoscope');
$xcrud->readonly('nama_pasien');
$xcrud->unset_remove();
$xcrud->unset_view();
echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>