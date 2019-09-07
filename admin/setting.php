<?php

$title = 'Setting';
include "../include/header.php";
?>
<?php 
// notif pesan
if (!empty($_SESSION['pesan'])) { ?>
	<div class="alert alert-success">
		<i class="fa fa-check"></i> <?php echo $_SESSION['pesan']; ?>
	</div>
	<br>
	<?php 
	$_SESSION['pesan'] = '';
} 

// notif pesan ewrror
if (!empty($_SESSION['error'])) { ?>
	<div class="alert alert-danger">
		<i class="fa fa-check"></i> <?php echo $_SESSION['error']; ?>
	</div>
	<br>
	<?php 
	$_SESSION['error'] = '';
} 
?>

<?php  
if(isset($_POST["submit"])) {
	// setting sebelum upload
	$target_dir = "../uploads/logo/";
	$target_file = $target_dir . basename($_FILES["logo"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// cek file di isi
	if(!empty($_FILES["logo"]["name"])){
		// Check file size
		if ($_FILES["logo"]["size"] > 3000000) {
			echo "File Terlalu Besar Max 3MB";
		}else{
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				echo "Format File Tidak di izinkan!";
		}else{
				// cek file sudah ada dan hapus file lama
			if(!empty($setting['logo'])){
				unlink('../uploads/logo/'.$setting['logo']);
			}

				// proses upload dan simpan ke db
			if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
				$nama_website	= $_POST['nama_website'];
				$alamat			= $_POST['alamat'];
				$deskripsi		= $_POST['deskripsi'];
				$theme			= $_POST['theme'];
				$logo			= $_FILES["logo"]["name"];

					// simpan ke database
				mysqli_query($conn,"UPDATE setting SET nama_website='$nama_website',alamat='$alamat',deskripsi='$deskripsi',theme='$theme',logo='$logo'");

					// redirect
				$_SESSION['pesan'] = 'Suskses merubah';
				header('Location: setting.php');

			} else {
				echo "Ada kesalahan dalam Upload Logo";
				header('Location: setting.php');
			}
		}
	}
}else{
	$nama_website	= $_POST['nama_website'];
	$alamat			= $_POST['alamat'];
	$deskripsi		= $_POST['deskripsi'];
	$theme			= $_POST['theme'];

		// simpan ke database
	mysqli_query($conn,"UPDATE setting SET nama_website='$nama_website',alamat='$alamat',deskripsi='$deskripsi',theme='$theme'");

		// redirect
	$_SESSION['pesan'] = 'Suskses merubah';
	header('Location: setting.php');
}
}
?>

<div class="panel panel-default" style="max-width: 500px;margin: auto">
	<div class="panel-heading">
		SETTING
	</div>
<table class="table table-striped"> 
	<tr>
		<th>Logo</th>
		<td><img src="../uploads/logo/<?php echo $setting['logo']; ?>" style="height: 100px"></td>
	</tr>
	<tr>
		<th>Nama Webiste</th>
		<td><?php echo $setting['nama_website']; ?></td>
	</tr>
	<tr>
		<th>Alamat</th>
		<td><?php echo $setting['alamat']; ?></td>
	</tr>
	<tr>
		<th>Deskripsi</th>
		<td><?php echo $setting['deskripsi']; ?></td>
	</tr>
	<tr>
		<th>Theme</th>
		<td class="w3-text-theme"><?php echo $setting['theme']; ?></td>
	</tr>
</table>
<div class="panel-footer">
<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-gear"></i> Ubah Setting</button>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			</div>
			<form method="post" enctype="multipart/form-data">

				<div class="modal-body">
					<div class="form-group">
						<label><b>Logo</b></label>
						<input class="form-control" type="file" name="logo">
					</div>

					<div class="form-group">
						<label><b>Nama Website</b></label>
						<input class="form-control" type="text" name="nama_website" value="<?php echo $setting['nama_website'] ?>">
					</div>

					<div class="form-group">
						<label><b>Alamat</b></label>
						<input class="form-control" type="text" name="alamat" value="<?php echo $setting['alamat'] ?>">
					</div>
					<div class="form-group">
						<label><b>Deskripsi</b></label>
						<input class="form-control" type="text" name="deskripsi" value="<?php echo $setting['deskripsi'] ?>">
					</div>
					<div class="form-group">
						<label><b>Theme</b></label>
						<select class="form-control" type="text" name="theme">
							<option value="green" <?php if($setting['theme'] == 'green'){echo "selected";} ?>>GREEN</option>
							<option value="red" <?php if($setting['theme'] == 'red'){echo "selected";} ?>>RED</option>
							<option value="orange" <?php if($setting['theme'] == 'orange'){echo "selected";} ?>>ORANGE</option>
							<option value="brown" <?php if($setting['theme'] == 'brown'){echo "selected";} ?>>BROWN</option>
						</select>
					</div>

				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				</div>
			</form>
		</div>
	</div>
</div>


</div>
<?php 
include "../include/footer.php";
?>