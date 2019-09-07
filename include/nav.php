        <div class="row-container" style="margin-top: 30px">
            <div class="col-md-2 no-print">
                <div class="list-group">
                    <a href="#" class="list-group-item text-center" style="height: 100%">
                        <img src="../uploads/logo/<?php echo $setting['logo']; ?>" width="100%">
                        <b><?php echo $setting['nama_website']; ?></b>
                        <br>
                        <?php echo $_SESSION['nama'] ?>
                        <br>
                        <span class="label label-info"><?php echo $_SESSION['akses_level'] ?></span>
                    </a>
                    <a href="index.php" class="list-group-item"><i class="fa fa-star"></i> Dashboard</a>
                    <?php if($_SESSION['akses_level'] == "admin"){ ?>
                        <a href="pasien.php" class="list-group-item"><i class="fa fa-users"></i> Pasien</a>
                        <a href="user.php" class="list-group-item"><i class="fa fa-users"></i> Pengguna</a>
                    <a href="setting.php" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Setting</a>
                    <?php  } ?>
                    <?php if($_SESSION['akses_level'] == "pegawai"){ ?>
                        <a href="pasien.php" class="list-group-item"><i class="fa fa-users"></i> Pasien</a>
                    <?php  } ?>
                    <?php if($_SESSION['akses_level'] == "dokter"){ ?>
                        <a href="pasien_dokter.php" class="list-group-item"><i class="fa fa-users"></i> Pasien</a>
                    <?php  } ?>
                    <a href="logout.php" class="list-group-item" onclick="return confirm('Yakin Keluar?')"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                </div>
            </div>
            <div class="col-md-10">
                <!-- notif pesan success -->
                <?php if (!empty($_SESSION['pesan'])) { ?>
                    <div class="alert alert-success">
                        <i class="fa fa-check"></i>
                        <?php echo $_SESSION['pesan']; ?>
                        <?php $_SESSION['pesan'] = ''; ?>
                    </div>
                    <br>
                <?php } ?>
                <!-- end notif pesan success -->
                <!-- notif pesan ewrror -->
                <?php if (!empty($_SESSION['error'])) { ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-check"></i>
                        <?php echo $_SESSION['error']; ?>
                        <?php $_SESSION['error'] = ''; ?>
                    </div>
                    <br>
                <?php } ?>
<!-- end notif pesan ewrror -->