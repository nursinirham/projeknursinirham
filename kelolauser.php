<?php 
	include 'config/koneksi.php';
  session_start();
  if (empty($_SESSION['namahome'])) {
          echo "<script>alert('Anda harus login dahulu!');document.location.href='index.php'</script>";
      }
 ?>
 <!DOCTYPE html>
  <html>
    <?php 
    	include 'library/head.php';
     ?>

    <body class="font-medium" style="background: #eee;">
	  <?php 
      include 'library/navbar.php';
     ?>
  <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
  <div class="row" style="margin-left: 300px;">
    <div class="container" style="width: 95%;">
      <ul class="collapsible" data-collapsible="accordion">
        <li>
      <div class="collapsible-header grey-text text-darken-2" style="letter-spacing:1px;"><i class="material-icons">dashboard</i>Cari User</div>
      <div class="collapsible-body white">
      <div class="card z-depth-0" style="margin-top:-3%;">
        <div class="card-content">
          <div class="container">
           <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Cari Surat Masuk</h3>
             <form method="post">
             <div class="container" style="width: 90%;">
               <div class="row">
               <div class="input-field col l12">
                <label for="tanggalawal">Ketik disini</label>
                <input id="tanggalawal" type="text" name="search" class="validate" required>
              </div>
            <div class="center">
            <button class="btn btn-large teal lighten-1 waves-effect waves-light" type="submit" name="search" style="margin-top: 3%;"><i class="material-icons left">search</i>Cari User</button>
            
            <?php 
              if (isset($_POST['search'])) {
                echo "<script>document.location.href='kelolauser.php?search=$_POST[search]'</script>";
              }
             ?>
            </div>
               </div>
             </div>
           </form>
          </div>
        </div>
      </div>
      </div>
    </li>
    <li>
      <div class="collapsible-header grey-text text-darken-2" style="letter-spacing:1px;"><i class="material-icons">dashboard</i>Tambah User</div>
      <div class="collapsible-body white">
      <div class="card z-depth-0" style="margin-top:-3%;">
        <div class="card-content">
          <div class="container">
           <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Tambah User</h3>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="input-field col l12">
              <label for="username">Username</label>
              <input id="username" type="text" name="username" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="nama">Nama</label>
              <input id="nama" type="text" name="nama" class="validate" required>
            </div>
            <div class="input-field col l12">
              <select class="browser-defaults" name="jabatan" required>
                <option disabled selected>Pilih jabatan</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="sekretaris">Sekretaris</option>
              </select>
            </div>
             <div class="input-field col l12">
              <label for="password">Password</label>
              <input id="password" type="password" name="password" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="repassword">Confirm Password</label>
              <input id="repassword" type="password" name="repassword" class="validate" required>
            </div>
            <div class="center">
            <button class="btn btn-large teal lighten-1 waves-effect waves-light" type="submit" name="input" style="margin-top: 3%;"><i class="material-icons left">send</i>Submit</button>
            </div>
            <?php 
              if (isset($_POST['input'])) {
                @$cari_kd=mysql_query("select max(kd_user)as kode from tbl_user"); //mencari kode yang paling besar atau kode yang baru masuk
                @$tm_cari=mysql_fetch_array(@$cari_kd);
                @$kode=substr(@$tm_cari['kode'],1,4); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
                @$tambah=@$kode+1; //kode yang sudah di pecah di tambah 1
                if(@$tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
                  @$id="K000".$tambah;
                }else{
                  @$id="K00".$tambah;
                }
                if ($_POST['repassword'] == $_POST['password']) {
                 $sql = "INSERT INTO `tbl_user`(`kd_user`, `username`, `password`, `nama`, `hak_akses`) VALUES ('$id','$_POST[username]','$_POST[password]','$_POST[nama]','$_POST[jabatan]')";
                 $query = mysql_query($sql) or die(mysql_error());
                 $cek = mysql_fetch_array($query);
                 echo "<script>alert('User Berhasil di tambah!');document.location.href='kelolauser.php'</script>"; 
                }else {
                  echo "<script>alert('Confirm Password nya belum cocok!');document.location.href='kelolauser.php'</script>";
                } 
              }
             ?>
          </form>
          </div>
        </div>
      </div>
      </div>
    </li>
    <li>
      <div class="collapsible-header grey-text text-darken-2 active" style="letter-spacing:1px;"><i class="material-icons">mode_edit</i>Kelola User</div>
      <div class="collapsible-body white">
        <div class="card z-depth-0" style="margin-top:-3%;">
        <div class="card-content">
          <div class="container" style="width:90%;">
            <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Kelola User</h3>
            <ul class="collection">
            <?php 
             if (empty($_GET['search'])) {
              $sqlex = "SELECT * FROM tbl_user";
            } else {
              $sqlex = "SELECT * FROM tbl_user WHERE username LIKE '%$_GET[search]%' OR nama LIKE '%$_GET[search]%'";
            }
              $sql = mysql_query($sqlex) or die(mysql_error());
              if (mysql_num_rows($sql) == 0) {
                echo '<div class="center" style="margin-top: 5%;"><span class="center grey-text text-darken-2 font-regular" style="font-size: 20px;">Tidak ada user yang sesuai dengan yang anda cari!</span></div>';
              }
              while ($anggota = mysql_fetch_array($sql)) {
                $deletebutton = "delete_anggota".$anggota['kd_user'];
                $updatebutton = "update_anggota".$anggota['kd_user'];
                ?>
              <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">archive</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;"><span class="grey-text text-darken-3" style="font-weight: 600;"><?php echo $anggota['nama']; ?> <span style="font-weight: 300;">( <?php echo $anggota['username']; ?> )</span></span></span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 500;"><?php echo $anggota['hak_akses']; ?></span></span>
                    </p>
                    <form action="" method="post">
                    <a href="#editsuratmasuk<?php echo $anggota['kd_user'] ?>" class="modal-trigger btn-floating indigo secondary-content accent waves-effect waves-light hide-on-med-and-down tooltipped" data-position="top" data-delay="50" data-tooltip="Edit User" style="margin-right:5.5%;"><i class="material-icons">mode_edit</i></a>
                    <button name="<?php echo $deletebutton ?>" onclick="return confirm('Anda yakin ingin menghapus  ?');" class="btn-floating waves-effect waves-light secondary-content pink accent tooltipped" data-position="right" data-delay="50" data-tooltip="Hapus User"><i class="material-icons">delete</i></button>
                    <?php 
                      if (isset($_POST[$deletebutton])) {
                         $sql = "DELETE FROM `tbl_user` WHERE kd_user = '$anggota[kd_user]'";
                         $query = mysql_query($sql) or die(mysql_error());
                echo "<script>alert('User Berhasil di hapus!');document.location.href='kelolauser.php'</script>";
                      }
                     ?>
                    </form>
                  </li>
                    <div id="editsuratmasuk<?php echo $anggota['kd_user'] ?>" class="modal modal-fixed-footer">
                      <div class="modal-content">
                        <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Edit Surat Masuk</h3>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="input-field col l12">
              <label for="username">Username</label>
              <input id="username" type="text" name="username" value="<?php echo $anggota['username'] ?>" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="nama">Nama</label>
              <input id="nama" type="text" name="nama" value="<?php echo $anggota['nama'] ?>" class="validate" required>
            </div>
            <div class="input-field col l12">
              <select class="browser-defaults" name="jabatan" required>
                <option value="<?php echo $anggota['hak_akses'] ?>" selected style="text-transform: capitalize;">Jabatan : <?php echo $anggota['hak_akses']; ?></option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="sekretaris">Sekretaris</option>
              </select>
            </div>
             <div class="input-field col l12">
              <label for="password">Password</label>
              <input id="password" type="password" value="<?php echo $anggota['password'] ?>" name="password" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="repassword">Confirm Password</label>
              <input id="repassword" type="password" value="<?php echo $anggota['password'] ?>" name="repassword" class="validate" required>
            </div>
            <div class="center">
            <button class="btn btn-large teal lighten-1 waves-effect waves-light" type="submit" name="<?php echo $updatebutton ?>" style="margin-top: 3%;"><i class="material-icons left">send</i>Submit</button>
            </div>
            <?php 
              if (isset($_POST[$updatebutton])) {
                if ($_POST['repassword'] == $_POST['password']) {
                 $sql = "UPDATE `tbl_user` SET `username`='$_POST[username]',`password`='$_POST[password]',`nama`='$_POST[nama]',`hak_akses`='$_POST[jabatan]' WHERE kd_user = '$anggota[kd_user]'";
                 $query = mysql_query($sql) or die(mysql_error());
                 $cek = mysql_fetch_array($query);
                 echo "<script>alert('Berhasil di edit!');document.location.href='kelolauser.php'</script>";  
                }else {
                  echo "<script>alert('Confirm Password nya belum cocok!')</script>";
                }
              }
             ?>
          </form>
                      </div>
                      <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
                      </div>
                  </div>
                <div id="disposisikan<?php echo $anggota['kd_surat'] ?>" class="modal modal-fixed-footer">
                      <div class="modal-content">
                        <h3 class="grey-text text-darken-2 center" style="font-weight: 300;letter-spacing: -2px;">Disposisikan Surat <span style="font-weight: 600;"><?php echo $anggota['kd_surat']; ?></span></h3>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="input-field col l12">
              <label for="kepada">Disposisikan Kepada..</label>
              <input id="kepada" type="text" name="kepada" class="autocomplete font-regular" required>
            </div>
            <div class="input-field col l12">
              <label for="deskripsi">Deskripsi</label>
              <textarea class="materialize-textarea" name="deskripsi" id="deskripsi" required></textarea>
            </div>
            <div class="input-field col l12">
              <label for="notifikasi">Notifikasi</label>
              <input id="notifikasi" type="text" name="notifikasi" class="validate" required>
            </div>
            <div class="center">
            <button class="btn btn-large teal lighten-1 waves-effect waves-light" type="submit" name="<?php echo $disposisibutton ?>" style="margin-top: 3%;"><i class="material-icons left">send</i>Submit</button>
            </div>
            <?php 
              if (isset($_POST[$disposisibutton])) {
                @$cari_kd=mysql_query("select max(kd_disposisi)as kode from tbl_disposisi"); //mencari kode yang paling besar atau kode yang baru masuk
                @$tm_cari=mysql_fetch_array(@$cari_kd);
                @$kode=substr(@$tm_cari['kode'],1,4); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
                @$tambah=@$kode+1; //kode yang sudah di pecah di tambah 1
                if(@$tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
                  @$id="D000".$tambah;
                }else{
                  @$id="D00".$tambah;
                }
                $kd_manager = substr($_POST['kepada'], 0,6);
                $namamanager = substr($_POST['kepada'], 7);
                $waktu_disposisi = date_timestamp_get();
                $sql = "INSERT INTO `tbl_disposisi`(`kd_disposisi`, `tanggal_disposisi`, `dibalas_kepada`, `deskripsi`, `notifikasi`, `status`, `kd_surat`, `kd_user`, `kd_disposisi_terusan`) VALUES ('$id',null,'$kd_manager','$_POST[deskripsi]','$_POST[notifikasi]','belum','$anggota[kd_surat]','$_SESSION[idadmin]','')";
                 $query = mysql_query($sql) or die(mysql_error());
                 $cek = mysql_fetch_array($query);
                 echo "<script>alert('Berhasil di disposisikan kepada $namamanager!');document.location.href='suratmasuk.php'</script>";  
              }
             ?>
          </form>
                      </div>
                      <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
                      </div>
                  </div>
              <?php
              }
             ?>
              </ul>
          </div>
        </div>
      </div>
      </div>
    </li>
  </ul>
    </div>
  </div>
      <!--Import jQuery before materialize.js-->
      <?php 
      	include 'library/js.php';
       ?>
       <script type="text/javascript">
             $(document).ready(function() {
    $('input.autocomplete').autocomplete({
    data: {
      <?php 
        $sql = mysql_query("SELECT * FROM tbl_user WHERE hak_akses = 'manager'") or die(mysql_error());
        while ($namaanggota = mysql_fetch_array($sql)) {
          ?>
      "<?php echo $namaanggota['kd_user'] ?> - <?php echo $namaanggota['nama'] ?>": null,
      <?php
        }
       ?>
    },
    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
    onAutocomplete: function(val) {
      // Callback function when value is autcompleted.
    },
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
        });
      });
       </script>
    </body>
  </html>