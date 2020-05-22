<?php
include '../include/header.php';
$id_user = $_SESSION['id_user'];
?>
<script type="text/javascript" src="../assets/js/Chart.min.js"></script>

<!-- query -->
<?php 
$jumlah_user     = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user"));
$jumlah_buku   = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM buku"));
$jumlah_tamu  = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM tamu"));
$jumlah_peminjaman = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM peminjaman"));
?>
<!-- end query -->
<!-- user -->
<?php if($_SESSION['akses_level'] == "admin"){ ?>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-book fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span style="font-size: 50px">
                                <?php echo $jumlah_buku ?>
                            </span>
                            <div><b>Total Buku</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span style="font-size: 50px">
                                <?php echo $jumlah_tamu ?>
                            </span>
                            <div><b>Tamu</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bookmark fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span style="font-size: 50px">
                                <?php echo $jumlah_peminjaman ?>
                            </span>
                            <div><b>Peminjaman</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<?php  
include '../include/footer.php';
?>