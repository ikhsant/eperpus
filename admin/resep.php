<?php
$title = 'Resep';
include "../include/header.php";
$id_pasien = $_GET['id_pasien'];
$pasien = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM pasien WHERE id_pasien = '$id_pasien' "));
?>
<button class="btn btn-primary" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>
<?php
$xcrud->table('resep');
$xcrud->table_name('RESEP PASIEN '.$pasien['nama_pasien']);
$xcrud->where('id_pasien =',$id_pasien);
$xcrud->fields('id_pasien',true);
$xcrud->columns('id_pasien',true);
$xcrud->pass_var('id_pasien',$id_pasien);
$xcrud->change_type('pembayaran','select','','BPJS,Non BPJS');
$xcrud->unset_view();
if ($_SESSION['akses_level'] == 'apoteker' | $_SESSION['akses_level'] == 'pegawai') {
	$xcrud->unset_remove();
	$xcrud->unset_edit();
	$xcrud->unset_add();
}
echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>