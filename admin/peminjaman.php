<?php
$title = 'Peminjaman';
include "../include/header.php";
?>

<?php
$xcrud->table('peminjaman');
$xcrud->table_name('Data Peminjaman');
$xcrud->relation('tamu','tamu','id_tamu','nama');
$xcrud->relation('buku','buku','id_buku','judul');
$xcrud->unset_view();
$xcrud->unset_csv();
// $xcrud->unset_limitlist();
// $xcrud->unset_numbers();
// $xcrud->unset_pagination();
$xcrud->unset_print();
// $xcrud->unset_sortable();
$xcrud->hide_button('save_new');
$xcrud->hide_button('save_edit');
echo $xcrud->render();
?>

<?php 
include "../include/footer.php";
?>