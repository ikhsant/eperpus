<?php
session_start();
require '../include/database.php';
// query setting
$setting = mysqli_fetch_assoc(mysqli_query($conn,'SELECT * FROM setting LIMIT 1'));
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login <?php echo $setting['nama_website']; ?> | <?php echo $setting['deskripsi']; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.css">
</head>
<style type="text/css">
  .container-body{
    background: grey; 
    /*background-image: url('../bg.jpg');*/
  }
  .container-form{
    max-width: 350px; 
    margin-top: 150px;
    margin: auto; 
    margin-top: 50px; 
    background: white; 
    padding: 10px; 
    border-radius: 10px; 
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }
</style>
<body class="container-body">
	<form method="post"  class="container-form">
    <p class="text-center"><img class="w3-padding" src="../uploads/logo/<?php echo $setting['logo']; ?>" style="width: 100px"></p>
    <h3 class="text-center"><?php echo $setting['nama_website']; ?></h3>
    <!-- notif pesan success -->
    <?php if (!empty($_SESSION['sukses'])) { ?>
    <div class="alert alert-success">
        <i class="fa fa-check"></i>
        <?php echo $_SESSION['sukses']; ?>
        <?php $_SESSION['sukses'] = ''; ?>
    </div>
    <br>
    <?php } ?>
    <?php if (!empty($_SESSION['error'])) { ?>
    <div class="alert alert-danger">
        <i class="fa fa-check"></i>
        <?php echo $_SESSION['error']; ?>
        <?php $_SESSION['error'] = ''; ?>
    </div>
    <br>
    <?php } ?>
    
    <?php
    if(isset($_POST['submit'])){
      $user = mysqli_real_escape_string($conn,$_POST["user"]);
      $pass = mysqli_real_escape_string($conn,sha1($_POST['pass']));
      $result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$user' AND password = '$pass' ");
      $row = mysqli_fetch_assoc($result);

      // cek di db user
      if(mysqli_num_rows($result) > 0){
        $_SESSION['username'] = $user;
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['foto'] = $row['foto'];
        $_SESSION['nama'] = $row['nama_user'];
        $_SESSION['akses_level'] = $row['akses_level'];
        $_SESSION['pesan'] = 'Selamat Datang '.$row['nama_user'].' !';
        // Redirect user to index.php
        echo '<script language="javascript">
                window.location.href = "index.php"
              </script>';
      }else{
        echo '
        <div class="alert alert-danger"><i class="fa fa-warning"></i> Username atau Password Salah</div>
        ';
        mysqli_close($conn);
      }
    }
    ?>
    <div class="form-group">
     <label>Username</label>
     <input class="form-control" type="text" name="user" placeholder="Masukan Username" required>
   </div>
   <div class="form-group">
     <label>Password</label>
     <input class="form-control" type="password" name="pass" placeholder="Masukan Password" required>
   </div>
     <button class="btn btn-primary" type="submit" name="submit" ><i class="fa fa-sign-in"></i> Login</button>
 </form>
</body>
</html>