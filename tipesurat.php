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
      <div class="collapsible-header grey-text text-darken-2" style="letter-spacing:1px;"><i class="material-icons">dashboard</i>Tambah Tipe Surat</div>
      <div class="collapsible-body white">
      <div class="card z-depth-0" style="margin-top:-3%;">
        <div class="card-content">
          <div class="container">
           <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Tambah Tipe Surat</h3>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="input-field col l12">
              <label for="kode">Kode Tipe Surat</label>
              <input id="kode" type="text" name="kode" class="validate" required>
            </div>
            <div class="input-field col l12">
              <label for="tipe">Nama Tipe</label>
              <input id="tipe" type="text" name="tipe" class="validate" required>
            </div>
            <div class="center">
            <button class="btn btn-large teal lighten-1 waves-effect waves-light" type="submit" name="input" style="margin-top: 3%;"><i class="material-icons left">send</i>Submit</button>
            </div>
            <?php 
              if (isset($_POST['input'])) {
                // @$cari_kd=mysql_query("select max(id_anggota)as kode from anggota"); //mencari kode yang paling besar atau kode yang baru masuk
                // @$tm_cari=mysql_fetch_array(@$cari_kd);
                // @$kode=substr(@$tm_cari['kode'],1,4); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
                // @$tambah=@$kode+1; //kode yang sudah di pecah di tambah 1
                // if(@$tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
                //   @$id="A000".$tambah;
                // }else{
                //   @$id="A00".$tambah;
                // }
                $sql = "INSERT INTO `tbl_tipe_surat`(`kd_tipe_surat`, `tipe`) VALUES ('$_POST[kode]','$_POST[tipe]')";
                 $query = mysql_query($sql) or die(mysql_error());
                 $cek = mysql_fetch_array($query);
                 echo "<script>alert('Tipe Surat Berhasil di tambah!');document.location.href='tipesurat.php'</script>";  
              }
             ?>
          </form>
          </div>
        </div>
      </div>
      </div>
    </li>
    <li>
      <div class="collapsible-header grey-text text-darken-2 active" style="letter-spacing:1px;"><i class="material-icons">mode_edit</i>Kelola Tipe Surat</div>
      <div class="collapsible-body white">
        <div class="card z-depth-0" style="margin-top:-3%;">
        <div class="card-content">
          <div class="container" style="width:90%;">
            <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Kelola Tipe Surat</h3>
            <ul class="collection">
            <?php 
              $sql = mysql_query("SELECT * FROM tbl_tipe_surat") or die(mysql_error());
              while ($anggota = mysql_fetch_array($sql)) {
                
                $deletebutton = "delete_anggota".$anggota['kd_tipe_surat'];
                $updatebutton = "update_anggota".$anggota['kd_tipe_surat'];
                ?>
              <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">bookmark</i>
                    <span class="title" style="font-size: 17px;"><?php echo $anggota['tipe']; ?></span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px"><span class="chip font-mediumfont-light" style="text-transform: capitalize;font-weight: 400;"><?php echo $anggota['kd_tipe_surat']; ?></span>
                    </p>
                    <form action="" method="post">
                    <button name="<?php echo $deletebutton ?>" onclick="return confirm('Anda yakin ingin menghapus  ?');" class="btn-floating waves-effect waves-lightx secondary-content pink accent"><i class="material-icons">delete</i></button>
                    <?php 
                      if (isset($_POST[$deletebutton])) {
                         $sql = "DELETE FROM `tbl_tipe_surat` WHERE kd_tipe_surat = '$anggota[kd_tipe_surat]'";
                         $query = mysql_query($sql) or die(mysql_error());
                echo "<script>alert('Tipe Surat Berhasil di hapus!');document.location.href='tipesurat.php'</script>";
                      }
                     ?>
                    </form>
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
      <!--Import jQuery before materialize.js-->
      <?php 
        include 'library/js.php';
       ?>
    </body>
  </html>