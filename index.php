<?php 
	include 'config/koneksi.php';
	@session_start();
 ?>
 <!DOCTYPE html>
  <html>
    <?php 
    	include 'library/head.php';
     ?>

    <body class="font-medium" style="background-image: url(img/wallpaper2.jpeg);background-size: cover;background-position: center;">
	  <div class="container" style="width: 30%;">
	  	<div class="card" style="margin-top: 20%;padding-bottom: 3%;padding-top: 5%;">
	  		<div class="card-content">
	  			<div class="container" style="width: 90%;">
	  			<form action="" method="post" enctype="multipart/form-data">
	  				<img src="img/logo2.png" class="responsive-img" alt="">
	  				<div class="input-field col l12">
	  					<label for="email">Username</label>
	  					<input id="email" type="text" name="email" class="validate">
	  				</div>
	  				<div class="input-field col l12">
	  					<label for="password">Password</label>
	  					<input id="password" type="password" name="password" class="validate">
	  				</div>
	  				<button class="btn btn-large teal lighten-1 waves-effect waves-light" style="width: 100%;margin-top: 3%;" type="submit" name="login">Login</button>
	  				<?php 
	  					if (isset($_POST['login'])) {
	  						$sql = "SELECT * FROM tbl_user WHERE username = '$_POST[email]' AND password = '$_POST[password]'";
	  						$query = mysql_query($sql) or die(mysql_error());
	  						$cek = mysql_fetch_array($query);
            if($cek == TRUE){
              @$username = $cek['username'];
              @$nama = $cek['nama'];
              @$_SESSION['usernamehome'] = $username;
              @$_SESSION['namahome'] = $nama;
              @$_SESSION['idadmin'] = $cek['kd_user'];
              @$_SESSION['role'] = $cek['hak_akses'];
              if ($cek['hak_akses'] == "sekretaris") {
              	echo "<script>alert('Selamat Datang $nama!');document.location.href='sekretaris.php'</script>";
              }elseif ($cek['hak_akses'] == "manager") {
              	echo "<script>alert('Selamat Datang $nama!');document.location.href='manager.php'</script>";
              }elseif ($cek['hak_akses'] == "admin") {
              	echo "<script>alert('Selamat Datang $nama!');document.location.href='admin.php'</script>";
              }
              
            }else{
              echo "<script>alert('Username atau password yang Anda masukan salah');document.location.href='index.php'</script>";  
            }
	  					}
	  				 ?>
	  			</form>
	  			</div>
	  		</div>
	  	</div>
	  </div>
      <!--Import jQuery before materialize.js-->
      <?php 
      	include 'library/js.php';
       ?>
    </body>
  </html>