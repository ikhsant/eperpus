<?php  
include '../include/header.php';

$peminjaman = mysqli_query($conn,"
	SELECT * FROM peminjaman 
	join buku ON buku.id_buku = peminjaman.buku
	join tamu ON tamu.id_tamu = peminjaman.tamu
	ORDER BY jatuh_tempo DESC ")
	?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>List Peminjaman</h3>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>NO</th>
						<th>DEADLINE</th>
						<th>PEMINJAM</th>
						<th>BUKU</th>
						<th>AKSI</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($peminjaman as $row): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $row['jatuh_tempo'] ?></td>
						<td><?= $row['nama'] ?></td>
						<td><?= $row['judul'] ?></td>
						<td>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?= $row['id_peminjaman'] ?>"> KIRIM NOTIF</button>

							<!-- The Modal -->
							<div class="modal" id="myModal<?= $row['id_peminjaman'] ?>">
								<div class="modal-dialog">
									<div class="modal-content">

										<!-- Modal Header -->
										<div class="modal-header">
											<h4 class="modal-title">Pesan</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

										<form method="post" action="wa.php">
											<input type="hidden" name="hp" value="<?= $row['hp'] ?>">

											<!-- Modal body -->
											<div class="modal-body">
												<div class="form-group">
													<label>Pesan</label>
													<textarea class="form-control" name="pesan" required>Hi, Silahkan kembalikan buku yang akan kamu pinjam!</textarea>
												</div>
											</div>

											<!-- Modal footer -->
											<div class="modal-footer">
												<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-send"></i> KIRIM</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
											</div>

										</form>

									</div>
								</div>
							</div>

						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>


<?php  
include '../include/footer.php';
?>