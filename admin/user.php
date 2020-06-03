<?php
$title = 'User';
include "../include/header.php";
?>

<?php
$xcrud->table('user');
$xcrud->table_name('Data User');

$xcrud->change_type('password', 'password', 'sha1', array('maxlength'=>100,'placeholder'=>'Masukan password'));
$xcrud->change_type('foto', 'image');
$xcrud->change_type('akses_level','select','','admin,operator');
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