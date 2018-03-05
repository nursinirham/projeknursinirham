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
      <div class="collapsible-header grey-text text-darken-2" style="letter-spacing:1px;"><i class="material-icons">search</i>Cari Surat Keluar</div>
      <div class="collapsible-body white">
      <div class="card z-depth-0" style="margin-top:-3%;">
        <div class="card-content">
          <div class="container">
           <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Cari Surat Keluar</h3>
             <form method="post">
             <div class="container" style="width: 90%;">
               <div class="row">
               <div class="input-field col l6">
                <label for="tanggalawal">Tanggal Awal</label>
                <input id="tanggalawal" type="date" name="tanggalawal" class="datepicker" required>
              </div>
              <div class="input-field col l6">
                <label for="tanggalakhir">Tanggal Akhir</label>
                <input id="tanggalakhir" type="date" name="tanggalakhir" class="datepicker" required>
              </div>
            <div class="center">
            <button class="btn btn-large teal lighten-1 waves-effect waves-light" type="submit" name="search" style="margin-top: 3%;"><i class="material-icons left">search</i>Cari Surat</button>
            <?php 
              if (isset($_POST['search'])) {
                echo "<script>document.location.href='suratmasuk.php?tanggalawal=$_POST[tanggalawal]&tanggalakhir=$_POST[tanggalakhir]'</script>";
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
      <div class="collapsible-header grey-text text-darken-2" style="letter-spacing:1px;"><i class="material-icons">add</i>Tambah Surat Keluar</div>
      <div class="collapsible-body white">
      <div class="card z-depth-0" style="margin-top:-3%;">
        <div class="card-content">
          <div class="container">
           <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Tambah Surat Keluar</h3>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="input-field col l12">
              <label for="nosurat">No Surat</label>
              <input id="nosurat" type="text" name="nosurat" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="tanggalsurat">Tanggal Surat</label>
              <input id="tanggalsurat" type="date" name="tanggalsurat" class="datepicker" required>
            </div>
            <div class="input-field col l12">
              <label for="dari">Dari</label>
              <input id="dari" type="text" name="dari" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="kepada">Kepada</label>
              <input id="kepada" type="text" name="kepada" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="subjeksurat">Subjek Surat</label>
              <input id="subjeksurat" type="text" name="subjeksurat" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="deskripsi">Deskripsi</label>
              <textarea class="materialize-textarea" name="deskripsi" id="deskripsi" required></textarea>
            </div>
            <div class="file-field col input-field s12">
                  <div class="btn teal lighten-1">
                    <span><i class="material-icons">attachment</i></span>
                    <input type="file" name="file" required>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" id="foto" placeholder="File Surat" type="text" style="border-bottom: 1px solid #e0e0e0;">
                  </div>
                </div>
            <div class="input-field col l12">
              <select class="browser-defaults" name="tipesurat" required>
                <option disabled selected>Pilih Tipe Surat</option>
                <?php 
                  $sql = mysql_query("SELECT * FROM tbl_tipe_surat") or die(mysql_error());
                  while ($tipe = mysql_fetch_array($sql)) {
                    ?>
                    <option value="<?php echo $tipe['kd_tipe_surat'] ?>"><?php echo $tipe['kd_tipe_surat']; ?> - <?php echo $tipe['tipe']; ?></option>
                <?php
                  }
                 ?>
              </select>
            </div>
            <div class="center">
            <button class="btn btn-large teal lighten-1 waves-effect waves-light" type="submit" name="input" style="margin-top: 3%;"><i class="material-icons left">send</i>Submit</button>
            </div>
            <?php 
              if (isset($_POST['input'])) {
                @$cari_kd=mysql_query("select max(kd_surat)as kode from tbl_surat"); //mencari kode yang paling besar atau kode yang baru masuk
                @$tm_cari=mysql_fetch_array(@$cari_kd);
                @$kode=substr(@$tm_cari['kode'],1,4); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
                @$tambah=@$kode+1; //kode yang sudah di pecah di tambah 1
                if(@$tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
                  @$id="S000".$tambah;
                }else{
                  @$id="S00".$tambah;
                }
                @$filename = $_FILES['file']['name'];
                @$filetmp = $_FILES['file']['tmp_name'];
                $waktu_datang = date_timestamp_get();
                $sql = "INSERT INTO `tbl_surat`(`kd_surat`, `waktu_datang`, `no_surat`, `tanggal_surat`, `dari`, `kepada`, `subjek_surat`, `deskripsi`, `status_surat`, `file_surat`, `kd_tipe_surat`, `kd_user`) VALUES ('$id',null,'$_POST[nosurat]','$_POST[tanggalsurat]','$_POST[dari]','$_POST[kepada]','$_POST[subjeksurat]','$_POST[deskripsi]','keluar','$filename','$_POST[tipesurat]','$_SESSION[idadmin]')";
                 $query = mysql_query($sql) or die(mysql_error());
                 move_uploaded_file($filetmp, 'img/'.$filename);
                 $cek = mysql_fetch_array($query);
                 echo "<script>alert('Surat Keluar Berhasil di tambah!');document.location.href='suratkeluar.php'</script>";  
              }
             ?>
          </form>
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
            if (empty($_GET['tanggalawal'])) {
              $sqlex = "SELECT * FROM tbl_surat WHERE status_surat = 'keluar' ORDER BY waktu_datang DESC";
            } else {
              $sqlex = "SELECT * FROM tbl_surat WHERE  status_surat = 'keluar' AND waktu_datang between '$_GET[tanggalawal]' AND '$_GET[tanggalakhir]' ORDER BY waktu_datang DESC";
            }
              $sql = mysql_query($sqlex) or die(mysql_error());
              if (mysql_num_rows($sql) == 0) {
                echo '<div class="center" style="margin-top: 5%;"><span class="center grey-text text-darken-2 font-regular" style="font-size: 20px;">Tidak ada surat yang waktu datangnya sesuai dengan periode yang anda input</span></div>';
              }
              while ($anggota = mysql_fetch_array($sql)) {
                $deletebutton = "delete_anggota".$anggota['kd_surat'];
                $updatebutton = "update_anggota".$anggota['kd_surat'];
                $updatefilebutton = "updatefile_anggota".$anggota['kd_surat'];
                $disposisibutton = "adddisposisi".$anggota['kd_surat'];
                ?>
                <tr>
                <td class="grey-text text-darken-2 font-regular"><?php echo $anggota['kd_surat']; ?></td>
                <td class="grey-text text-darken-2 font-regular"><?php echo date_format(date_create($anggota['waktu_datang']),"d M"); ?>, <?php echo date_format(date_create($anggota['waktu_datang']),"H:i:s"); ?></td>
                <td class="grey-text text-darken-2 font-regular"><?php echo $anggota['dari']; ?></td>
                <td class="grey-text text-darken-2 font-regular"><?php echo $anggota['kepada']; ?></td>
                <td>
                    <form action="" method="post">
                    <button name="<?php echo $deletebutton ?>" onclick="return confirm('Anda yakin ingin menghapus  ?');" class="btn-floating waves-effect waves-light secondary-content pink accent tooltipped" data-position="top" data-delay="50" style="margin-right: 3%;" data-tooltip="Hapus Surat"><i class="material-icons">delete</i></button>
                    <a href="#editsuratmasuk<?php echo $anggota['kd_surat'] ?>" class="modal-trigger btn-floating indigo secondary-content accent waves-effect waves-light hide-on-med-and-down tooltipped" data-position="top" data-delay="50" data-tooltip="Edit Surat" style="margin-right: 3%;"><i class="material-icons">mode_edit</i></a>
                    <a href="lihatsurat.php?kd_surat=<?php echo $anggota['kd_surat'] ?>" class="modal-trigger btn-floating teal lighten-1 secondary-content accent waves-effect waves-light hide-on-med-and-down tooltipped" data-position="top" data-delay="50" data-tooltip="Lihat Surat" style="margin-right: 3%;"><i class="material-icons">visibility</i></a>
                    <?php 
                      if (isset($_POST[$deletebutton])) {
                         $sql = "DELETE FROM `tbl_surat` WHERE kd_surat = '$anggota[kd_surat]'";
                         $query = mysql_query($sql) or die(mysql_error());
                echo "<script>alert('Surat Masuk Berhasil di hapus!');document.location.href='suratmasuk.php'</script>";
                      }
                     ?>
                    </form>
                </td>
                </tr>
                <div id="editsuratmasuk<?php echo $anggota['kd_surat'] ?>" class="modal modal-fixed-footer">
                      <div class="modal-content">
                        <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Edit Surat Masuk</h3>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="input-field col l12">
              <label for="nosurat">No Surat</label>
              <input id="nosurat" type="text" name="nosurat" value="<?php echo $anggota['no_surat'] ?>" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="tanggalsurat">Tanggal Surat</label>
              <input id="tanggalsurat" type="date" name="tanggalsurat" value="<?php echo $anggota['tanggal_surat'] ?>" class="datepicker" required>
            </div>
            <div class="input-field col l12">
              <label for="dari">Dari</label>
              <input id="dari" type="text" name="dari" value="<?php echo $anggota['dari'] ?>" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="kepada">Kepada</label>
              <input id="kepada" type="text" name="kepada" value="<?php echo $anggota['kepada'] ?>" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="subjeksurat">Subjek Surat</label>
              <input id="subjeksurat" type="text" value="<?php echo $anggota['subjek_surat'] ?>" name="subjeksurat" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="deskripsi">Deskripsi</label>
              <textarea class="materialize-textarea" name="deskripsi" id="deskripsi" required><?php echo $anggota['deskripsi']; ?></textarea>
            </div>
            <div class="center">
            <button class="btn btn-large teal lighten-1 waves-effect waves-light" type="submit" name="<?php echo $updatebutton ?>" style="margin-top: 3%;"><i class="material-icons left">send</i>Submit</button>
            </div>
            <?php 
              if (isset($_POST[$updatebutton])) {
                $sql = "UPDATE `tbl_surat` SET `no_surat`='$_POST[nosurat]',`tanggal_surat`='$_POST[tanggalsurat]',`dari`='$_POST[dari]',`kepada`='$_POST[kepada]',`subjek_surat`='$_POST[subjeksurat]',`deskripsi`='$_POST[deskripsi]' WHERE kd_surat = '$anggota[kd_surat]'";
                 $query = mysql_query($sql) or die(mysql_error());
                 $cek = mysql_fetch_array($query);
                 echo "<script>alert('Berhasil di edit!');document.location.href='suratmasuk.php'</script>";  
              }
             ?>
          </form>
          <div class="divider" style="margin-top: 5%;margin-bottom: 3%;"></div>
                 <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Edit File Surat</h3>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="file-field col input-field s12">
                  <div class="btn teal lighten-1">
                    <span><i class="material-icons">attachment</i></span>
                    <input type="file" name="file" required>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" id="foto" value="<?php echo $anggota['file_surat'] ?>" placeholder="File Surat" type="text" style="border-bottom: 1px solid #e0e0e0;">
                  </div>
                </div>
            <div class="center">
            <button class="btn btn-large teal lighten-1 waves-effect waves-light" type="submit" name="<?php echo $updatefilebutton ?>" style="margin-top: 3%;"><i class="material-icons left">send</i>Submit</button>
            </div>
            <?php 
              if (isset($_POST[$updatefilebutton])) {
                @$filename = $_FILES['file']['name'];
                @$filetmp = $_FILES['file']['tmp_name'];
                $sql = "UPDATE `tbl_surat` SET `file_surat`='$filename' WHERE kd_surat = '$anggota[kd_surat]'";
                 $query = mysql_query($sql) or die(mysql_error());
                 move_uploaded_file($filetmp, 'img/'.$filename);
                 $cek = mysql_fetch_array($query);
                 echo "<script>alert('Berhasil di edit!');document.location.href='suratmasuk.php'</script>";  
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
       </script>
    </body>
  </html>