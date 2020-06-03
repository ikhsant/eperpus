<?php
$title = 'Buku';
include "../include/header.php";
?>

<?php
$xcrud->table('buku');
$xcrud->table_name('Data Buku');
$xcrud->relation('pengarang','pengarang','id_pengarang','nama_pengarang');
$xcrud->relation('kategori','kategori','id_kategori','nama_kategori');
$xcrud->relation('rak','rak','id_rak','nama_rak');
$xcrud->change_type('cover','image');
$xcrud->button('qrcode.php?buku={id_buku}','QRCODE','fa fa-qrcode');

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