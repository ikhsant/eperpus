<?php
include '../include/auth.php';
include '../include/database.php';
include "../operator/xcrud.php";
include '../include/function.php';
$xcrud = Xcrud::get_instance();

// active menu
$url       = $_SERVER['REQUEST_URI'];
$parts     = parse_url($url);
$page_name = basename($parts['path']);

// query setting
$setting = mysqli_fetch_assoc(mysqli_query($conn,'SELECT * FROM setting LIMIT 1'));

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php if(isset($title)){echo $title.' - '; }?><?php echo $setting['nama_website']; ?> | <?php echo $setting['deskripsi']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="../logo.png">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/font-awesome.css">
	<link rel="stylesheet" href="../assets/css/custom.css">
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
</head>
<body>
	<?php include 'nav.php'; ?>