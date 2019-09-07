<?php
include '../include/header.php';
$id_user = $_SESSION['id_user'];
?>
<script type="text/javascript" src="../assets/js/Chart.min.js"></script>

<!-- query -->
<?php 
$jumlah_user     = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user"));
$jumlah_dokter   = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user WHERE akses_level = 'dokter' "));
$jumlah_pegawai  = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user WHERE akses_level = 'pegawai' "));
$jumlah_apoteker = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM user WHERE akses_level = 'apoteker' "));
$jumlah_pasien   = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pasien"));
$diagnosis_pasien   = mysqli_query($conn,"SELECT diagnosis, COUNT(diagnosis) as jumlah FROM pasien GROUP BY diagnosis");
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
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span style="font-size: 50px">
                                <?php echo $jumlah_user ?>
                            </span>
                            <div><b>Total Pengguna</b></div>
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
                                <?php echo $jumlah_dokter ?>
                            </span>
                            <div><b>Dokter</b></div>
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
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span style="font-size: 50px">
                                <?php echo $jumlah_pegawai ?>
                            </span>
                            <div><b>Pegawai</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span style="font-size: 50px">
                                <?php echo $jumlah_apoteker ?>
                            </span>
                            <div><b>Apoteker</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if($_SESSION['akses_level'] == "admin" | $_SESSION['akses_level'] == "pegawai"){ ?>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span style="font-size: 50px">
                                <?php echo $jumlah_pasien ?>
                            </span>
                            <div><b>Total Pasien</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h4>Chart</h4>
    <div class="panel panel-default">
        <div class="panel-heading">
            Chart Diagnosis
        </div>
        <div class="panel-body">
            <canvas id="diagnosis" height="150px"></canvas>
        </div>
    </div>
    <script>
        var ctx = document.getElementById("diagnosis").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                <?php foreach ($diagnosis_pasien as $row1) {
                  echo "'".$row1['diagnosis']."',";
              } ?>
              ],
              datasets: [{
                label: ['# Diagnosis','ASD'],
                data: [
                <?php foreach ($diagnosis_pasien as $row2) {
                    echo "'".$row2['jumlah']."',";
                } ?>
                ],
                backgroundColor: [
                <?php foreach ($diagnosis_pasien as $row3) {
                  $randomcolor = '#' . dechex(rand(0,10000000));
                  echo '"'.$randomcolor.'",';
              } ?>
              ]
          }]
      },
  });
</script>
<?php } ?>


<!-- dokter -->
<?php if($_SESSION['akses_level'] == "dokter"){ ?>
    <?php 
    $id_dokter = $_SESSION['id_user'];
    $jumlah_pasien_dokter = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pasien WHERE id_dokter = '$id_dokter' "));
    ?>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <span style="font-size: 50px">
                                <?php echo $jumlah_pasien_dokter ?>
                            </span>
                            <div><b>Total Pasien</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<!-- apoteker -->
<?php if($_SESSION['akses_level'] == "apoteker"){
    header('Location: pasien_apoteker.php');
} 
?>

<?php  
include '../include/footer.php';
?>