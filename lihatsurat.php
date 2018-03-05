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
  <div class="row">
    <div class="container">
      <ul class="collapsible" data-collapsible="accordion">
    <li>
      <div class="collapsible-header grey-text text-darken-2 active" style="letter-spacing:1px;"><i class="material-icons">mode_edit</i>Lihat Surat : <?php echo $_GET['kd_surat']; ?></div>
      <div class="collapsible-body white">
        <div class="card z-depth-0" style="margin-top:-3%;">
        <div class="card-content">
          <div class="container" style="width:90%;">
            <h3 class="grey-text text-darken-2 center" style="font-weight: 300;letter-spacing: -2px;">Lihat Surat : <span style="font-weight: 600;"><?php echo $_GET['kd_surat']; ?></span></h3>
            <ul class="collection">
            <?php 
              $sql = mysql_query("SELECT * FROM tbl_surat WHERE kd_surat = '$_GET[kd_surat]'") or die(mysql_error());
              while ($anggota = mysql_fetch_array($sql)) {
                ?>
              <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Kode Surat</span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 500;"><?php echo $anggota['kd_surat']; ?></span></span>
                    </p>
                  </li>
              <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Waktu Datang</span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 500;"><?php echo date_format(date_create($anggota['waktu_datang']),"d M Y");?></span></span><span class="chip">Pukul : <?php echo date_format(date_create($anggota['waktu_datang']),"H:i:s");?></span>
                    </p>
                  </li>
              <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">No Surat</span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 500;"><?php echo $anggota['no_surat']; ?></span></span>
                    </p>
                  </li>
                <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Tanggal Surat</span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 500;"><?php echo date_format(date_create($anggota['tanggal_surat']),"d M Y");?></span></span>
                    </p>
                  </li>
                <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Dari</span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 500;"><?php echo $anggota['dari']; ?></span></span>
                    </p>
                  </li>
                <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Kepada</span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 500;"><?php echo $anggota['kepada']; ?></span></span>
                    </p>
                  </li>
                <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Subjek Surat</span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class=" font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 300;">"<?php echo $anggota['subjek_surat']; ?>"</span></span>
                    </p>
                  </li>
                <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Deskripsi</span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;font-weight: 300;"><span class=" font-medium font-light" style="text-transform: capitalize;font-weight: 300;"><span style="font-weight: 300;"><?php echo $anggota['deskripsi']; ?></span></span>
                    </p>
                  </li>
                <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Status Surat</span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 500;">Surat <?php echo $anggota['status_surat']; ?></span></span>
                    </p>
                  </li>
                <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">File Surat</span><br>
                    <a target="_blank" href="<?php echo 'img/'.$anggota['file_surat'] ?>" class="regular-font" style="font-size: 15px;margin-top: 1%;"><span class="font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 500;"><?php echo $anggota['file_surat']; ?></span></span>
                    </a>
                  </li>
                <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Tipe Surat</span>
                    <?php 
                      $gettipe = mysql_fetch_array(mysql_query("SELECT * FROM tbl_tipe_surat WHERE kd_tipe_surat = '$anggota[kd_tipe_surat]'"));
                     ?>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><span style="font-weight: 500;"><?php echo $anggota['kd_tipe_surat']; ?> - <?php echo $gettipe['tipe']; ?></span></span>
                    </p>
                  </li>
                <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">view_headline</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Sekretaris yang menginput</span>
                    <?php 
                      $gettipe = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE kd_user = '$anggota[kd_user]'"));
                     ?>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;"><img src="img/user.svg"><span style="font-weight: 500;"><?php echo $gettipe['nama']; ?></span></span>
                    </p>
                  </li>
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
  <!-- <div class="fixed-action-btn">
    <a href="#disposisikan<?php echo $_GET['kd_surat'] ?>" class="btn-floating modal-trigger btn-large deep-orange tooltipped" data-delay="50" data-tooltip="Disposisikan" data-position="left">
      <i class="large material-icons">forward</i>
    </a>
  </div> -->
  <div id="disposisikan<?php echo $_GET['kd_surat'] ?>" class="modal modal-fixed-footer">
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
                $sql = "INSERT INTO `tbl_disposisi`(`kd_disposisi`, `tanggal_disposisi`, `dibalas_kepada`, `deskripsi`, `notifikasi`, `status`, `kd_surat`, `kd_user`, `kd_disposisi_terusan`) VALUES ('$id',null,'$kd_manager','$_POST[deskripsi]','$_POST[notifikasi]','belum','$_GET[kd_surat]','$_SESSION[idadmin]','')";
                 $query = mysql_query($sql) or die(mysql_error());
                 $cek = mysql_fetch_array($query);
                 echo "<script>alert('Berhasil di disposisikan kepada $namamanager!');document.location.href='lihatsurat.php?kd_surat=$_GET[kd_surat]'</script>";  
              }
             ?>
          </form>
                      </div>
                      <div class="modal-footer">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
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