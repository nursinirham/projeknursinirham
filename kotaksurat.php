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
      <div class="collapsible-header grey-text text-darken-2 active" style="letter-spacing:1px;"><i class="material-icons">mode_edit</i>Kotak Surat</div>
      <div class="collapsible-body white">
        <div class="card z-depth-0" style="margin-top:-3%;">
        <div class="card-content">
          <div class="container" style="width:90%;">
            <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Kotak Surat</h3>
            <ul class="collection">
            <?php 
              $sql = mysql_query("SELECT * FROM tbl_disposisi WHERE dibalas_kepada = '$_SESSION[idadmin]' AND status = 'belum'") or die(mysql_error());
              if (mysql_num_rows($sql) == 0) {
                echo '<div class="center" style="margin-top: 5%;"><span class="center grey-text text-darken-2 font-regular" style="font-size: 20px;">Tidak ada surat yang belum di baca</span></div>';
              }
              while ($anggota = mysql_fetch_array($sql)) {
                $getsuratdata = mysql_fetch_array(mysql_query("SELECT * FROM tbl_surat WHERE kd_surat = '$anggota[kd_surat]'"));
                $gettipedata = mysql_fetch_array(mysql_query("SELECT * FROM tbl_tipe_surat WHERE kd_tipe_surat = '$getsuratdata[kd_tipe_surat]'"));
                $deletebutton = "delete_anggota".$anggota['kd_disposisi'];
                $updatebutton = "update_anggota".$anggota['kd_disposisi'];
                $disposisibutton = "adddisposisi".$anggota['kd_disposisi'];
                ?>
              <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">archive</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Surat <span class="grey-text text-darken-3" style="font-weight: 600;"><?php echo $anggota['kd_surat']; ?></span>, Dari : <span class="deep-orange-text" style="font-weight: 600;"><?php echo $getsuratdata['dari']; ?></span></span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;">Masuk Pada : <span style="font-weight: 500;"><?php echo date_format(date_create($anggota['tanggal_disposisi']),"d M Y"); ?></span>, Pukul : <span style="font-weight: 500;"><?php echo date_format(date_create($anggota['tanggal_disposisi']),"H:i:s"); ?></span></span> <br>
                      <span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;">Subjek : <span style="font-weight: 500;"><?php echo $getsuratdata['subjek_surat']; ?></span></span> <br>
                      <span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;">Tipe Surat : <span style="font-weight: 500;"><?php echo $gettipedata['tipe']; ?></span></span> <br>
                      <?php 
                        if (!empty($anggota['kd_disposisi_terusan'])) {
                          $getdisposdata = mysql_fetch_array(mysql_query("SELECT * FROM tbl_disposisi WHERE kd_disposisi = '$anggota[kd_disposisi_terusan]'"));
                          $getuser = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE kd_user = '$getdisposdata[kd_user]'"));
                          ?>
                      <span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;">Telah di teruskan ke : <span style="font-weight: 500;"><?php echo $getuser['nama']; ?></span></span>
                      <?php
                        }
                       ?>
                    </p>
                    <form action="" method="post">
                    <button type="submit" name="<?php echo $updatebutton ?>" class="modal-trigger btn-floating teal lighten-1 secondary-content accent waves-effect waves-light hide-on-med-and-down tooltipped" data-position="left" data-delay="50" data-tooltip="Lihat Surat" style="margin-right:11%;"><i class="material-icons">visibility</i></button>
                    <a href="#disposisikan<?php echo $anggota['kd_disposisi'] ?>" class="modal-trigger btn-floating deep-orange secondary-content accent waves-effect waves-light hide-on-med-and-down tooltipped" data-position="top" data-delay="50" data-tooltip="Disposisikan" style="margin-right:5.5%;"><i class="material-icons">forward</i></a>
                    <button name="<?php echo $deletebutton ?>" onclick="return confirm('Anda yakin ingin menghapus  ?');" class="btn-floating waves-effect waves-light secondary-content pink accent tooltipped" data-position="right" data-delay="50" data-tooltip="Hapus Surat"><i class="material-icons">delete</i></button>
                    <?php 
                      if (isset($_POST[$deletebutton])) {
                         $sql = "DELETE FROM `tbl_disposisi` WHERE kd_disposisi = '$anggota[kd_disposisi]'";
                         $query = mysql_query($sql) or die(mysql_error());
                echo "<script>alert('Surat Masuk Berhasil di hapus!');document.location.href='kotaksurat.php'</script>";
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
<div class="card">
      <div class="card-content">
         <!-- <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Kelola Surat Masuk</h3> -->
           <table id="kelolasuratmasuk" class="table">
            <thead>
            <tr>
                <th class="grey-text text-darken-3">Kode Surat</th>
                <th class="grey-text text-darken-3">Waktu Datang</th>
                <th class="grey-text text-darken-3">Dari</th>
                <th class="grey-text text-darken-3">Kepada</th>
                <th class="grey-text text-darken-3">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php 
              $sql = mysql_query("SELECT * FROM tbl_disposisi WHERE dibalas_kepada = '$_SESSION[idadmin]' AND status = 'dibaca'") or die(mysql_error());
              while ($anggota = mysql_fetch_array($sql)) {
                $getsuratdata = mysql_fetch_array(mysql_query("SELECT * FROM tbl_surat WHERE kd_surat = '$anggota[kd_surat]'"));
                $gettipedata = mysql_fetch_array(mysql_query("SELECT * FROM tbl_tipe_surat WHERE kd_tipe_surat = '$getsuratdata[kd_tipe_surat]'"));
                $deletebutton = "delete_disposisi".$anggota['kd_disposisi'];
                $disposisibuttonz = "adddisposisiz".$anggota['kd_disposisi'];
                $updatebutton = "updatedisposisi".$anggota['kd_disposisi'];
                ?>
                <tr>
                <td class="grey-text text-darken-2 font-regular"><?php echo $getsuratdata['kd_surat']; ?></td>
                <td class="grey-text text-darken-2 font-regular"><?php echo date_format(date_create($getsuratdata['waktu_datang']),"d M"); ?>, <?php echo date_format(date_create($getsuratdata['waktu_datang']),"H:i:s"); ?></td>
                <td class="grey-text text-darken-2 font-regular"><?php echo $getsuratdata['dari']; ?></td>
                <td class="grey-text text-darken-2 font-regular"><?php echo $getsuratdata['kepada']; ?></td>
                <td>
                    <form action="" method="post">
                    <button name="<?php echo $deletebutton ?>" onclick="return confirm('Anda yakin ingin menghapus  ?');" class="btn-floating waves-effect waves-light secondary-content pink accent tooltipped" data-position="top" data-delay="50" style="margin-right: 3%;" data-tooltip="Hapus Surat"><i class="material-icons">delete</i></button>
                    <a href="#disposisikanz<?php echo $anggota['kd_disposisi'] ?>" class="modal-trigger btn-floating deep-orange secondary-content accent waves-effect waves-light hide-on-med-and-down tooltipped" data-position="top" data-delay="50" data-tooltip="Disposisikan" style="margin-right: 3%;"><i class="material-icons">forward</i></a>
                    <a href="lihatsurat.php?kd_surat=<?php echo $anggota['kd_surat'] ?>" class="modal-trigger btn-floating teal lighten-1 secondary-content accent waves-effect waves-light hide-on-med-and-down tooltipped" data-position="top" data-delay="50" data-tooltip="Lihat Surat" style="margin-right: 3%;"><i class="material-icons">visibility</i></a>
                    <?php 
                      if (isset($_POST[$deletebutton])) {
                         $sql = "DELETE FROM `tbl_disposisi` WHERE kd_disposisi = '$anggota[kd_disposisi]'";
                         $query = mysql_query($sql) or die(mysql_error());
                echo "<script>alert('Surat Masuk Berhasil di hapus!');document.location.href='kotaksurat.php'</script>";
                      }
                     ?>
                    </form>
                </td>
                </tr>
                <div id="disposisikanz<?php echo $anggota['kd_disposisi'] ?>" class="modal modal-fixed-footer">
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
              if (isset($_POST[$disposisibuttonz])) {
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
                <?php 
                  }
                ?>
                </tbody>
                  </table>
      </div>
    </div>
    </div>
  </div>
      <!--Import jQuery before materialize.js-->
      <?php 
      	include 'library/js.php';
       ?>
       <script type="text/javascript">
        $(document).ready(function(){
        $('#kelolasuratmasuk').DataTable();
        $('select').material_select();
      });
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