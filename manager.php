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

    <body class="font-regular" style="background: #eee;">
	  <?php 
      include 'library/navbar.php';
     ?>
  <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
  <div class="row" style="margin-left: 300px;">
    <div class="container" style="width: 85%;">
       <h1 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Notifikasi</h1>
            <?php 
              $sql = mysql_query("SELECT * FROM tbl_disposisi WHERE dibalas_kepada = '$_SESSION[idadmin]' AND status = 'belum' ORDER BY tanggal_disposisi DESC") or die(mysql_error());
              if (mysql_num_rows($sql) == 0) {
                echo '<div class="center" style="margin-top: 5%;"><span class="center grey-text text-darken-2 font-regular" style="font-size: 20px;">Tidak ada surat yang belum di baca</span></div>';
              }
              while ($anggota = mysql_fetch_array($sql)) {
                $getsuratdata = mysql_fetch_array(mysql_query("SELECT * FROM tbl_surat WHERE kd_surat = '$anggota[kd_surat]'"));
                $gettipedata = mysql_fetch_array(mysql_query("SELECT * FROM tbl_tipe_surat WHERE kd_tipe_surat = '$getsuratdata[kd_tipe_surat]'"));
                $getuser = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE kd_user = '$anggota[kd_user]'"));
                $deletebutton = "delete_anggota".$anggota['kd_disposisi'];
                $updatebutton = "update_anggota".$anggota['kd_disposisi'];
                ?>
     <div class="card">
        <div class="card-content" style="padding: 10px;">
            <ul class="collection" style="border: 0px;">
              <li class="collection-item avatar" style="border-bottom: 0px;">
                   <i class="material-icons circle teal lighten-1">archive</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Dari : <span class="deep-orange-text" style="font-weight: 600;"><?php echo $getuser['nama']; ?></span></span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;margin-bottom: 1%;">Tanggal : <span style="font-weight: 500;"><?php echo date_format(date_create($anggota['tanggal_disposisi']),"d M Y"); ?></span>, Pukul : <span style="font-weight: 500;"><?php echo date_format(date_create($anggota['tanggal_disposisi']),"H:i:s"); ?></span></span> <span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;margin-bottom: 1%;">Tipe : <span style="font-weight: 500;"><?php echo $gettipedata['tipe']; ?></span></span> <br>
                      "<?php echo $anggota['notifikasi'] ?>"
                    </p>
                    <form action="" method="post">
                    <button type="submit" name="<?php echo $updatebutton ?>" class="modal-trigger btn-floating teal lighten-1 secondary-content accent waves-effect waves-light hide-on-med-and-down tooltipped" data-position="left" data-delay="50" data-tooltip="Lihat Surat" style="margin-right:5.5%;"><i class="material-icons">visibility</i></button>
                    <button name="<?php echo $deletebutton ?>" class="btn-floating waves-effect waves-light secondary-content pink accent tooltipped" data-position="right" data-delay="50" data-tooltip="Hapus Surat"><i class="material-icons">delete</i></button>
                    <?php 
                      if (isset($_POST[$deletebutton])) {
                         $sql = "UPDATE `tbl_disposisi` SET `status`='dibaca' WHERE kd_disposisi = '$anggota[kd_disposisi]'";
                         $query = mysql_query($sql) or die(mysql_error());
                echo "<script>document.location.href='manager.php'</script>";
                      }
                      if (isset($_POST[$updatebutton])) {
                         $sql = "UPDATE `tbl_disposisi` SET `status`='dibaca' WHERE kd_disposisi = '$anggota[kd_disposisi]'";
                         $query = mysql_query($sql) or die(mysql_error());
                echo "<script>document.location.href='lihatsurat.php?kd_surat=$anggota[kd_surat]'</script>";
                      }
                     ?>
                    </form>
                  </li>
                <div id="disposisikan<?php echo $anggota['kd_disposisi'] ?>" class="modal modal-fixed-footer">
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
                $sql = "INSERT INTO `tbl_disposisi`(`kd_disposisi`, `tanggal_disposisi`, `dibalas_kepada`, `deskripsi`, `notifikasi`, `status`, `kd_surat`, `kd_user`, `kd_disposisi_terusan`) VALUES ('$id',null,'$kd_manager','$_POST[deskripsi]','$_POST[notifikasi]','belum','$anggota[kd_surat]','$_SESSION[idadmin]','')";
                $updatedisposisiterusan = mysql_query("UPDATE `tbl_disposisi` SET `kd_disposisi_terusan`='$id' WHERE kd_disposisi = '$anggota[kd_disposisi]'") or die(mysql_error());
                 $query = mysql_query($sql) or die(mysql_error());
                 echo "<script>alert('Berhasil di disposisikan kepada $namamanager!');document.location.href='kotaksurat.php'</script>";  
              }
             ?>
          </form>
                      </div>
                      <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
                      </div>
                  </div>
                 </ul>
        </div>
      </div>
              <?php
              }
             ?>
    </div>
  </div>
      <!--Import jQuery before materialize.js-->
      <?php 
      	include 'library/js.php';
       ?>
    </body>
  </html>