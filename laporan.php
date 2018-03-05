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
    <div class="container" style="width: 50%;">
       <h1 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Cetak Laporan</h1>
     <div class="card" style="margin-top: 8%;">
        <div class="card-content" style="padding: 10px;">
           <form method="post">
             <div class="container" style="width: 90%;">
               <div class="row">
               <div class="input-field col l6">
                <select class="browser-defaults" name="bulan" required>
                <option disabled selected>Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
              </select>
              </div>
              <div class="input-field col l6">
                <select class="browser-defaults" name="tahun" required>
                <option disabled selected>Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
              </select>
              </div>
              <div class="input-field col l12">
              <select class="browser-defaults" name="tipesurat" required>
                <option disabled selected>Pilih Status Surat</option>
                    <option value="masuk">Surat Masuk</option>
                    <option value="keluar">Surat Keluar</option>
              </select>
            </div>
            <div class="center">
            <button class="btn btn-large teal lighten-1 waves-effect waves-light" type="submit" name="input" style="margin-top: 3%;"><i class="material-icons left">description</i>Generate</button>
            <?php 
              if (isset($_POST['input'])) {
                echo "<script>document.location.href='cetak.php?bulan=$_POST[bulan]&status=$_POST[tipesurat]'</script>";
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
      <!--Import jQuery before materialize.js-->
      <?php 
      	include 'library/js.php';
       ?>
    </body>
  </html>