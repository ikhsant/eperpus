<?php
$title = 'Kategori';
include "../include/header.php";
?>

<?php
$xcrud->table('kategori');
$xcrud->table_name('Data Kategori');
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