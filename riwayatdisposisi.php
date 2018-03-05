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
      <div class="collapsible-header grey-text text-darken-2 active" style="letter-spacing:1px;"><i class="material-icons">mode_edit</i>Riwayat Disposisi</div>
      <div class="collapsible-body white">
        <div class="card z-depth-0" style="margin-top:-3%;">
        <div class="card-content">
          <div class="container" style="width:90%;">
            <h3 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Riwayat Disposisi</h3>
            <ul class="collection">
            <?php 
              $sql = mysql_query("SELECT * FROM tbl_disposisi ORDER BY tanggal_disposisi DESC") or die(mysql_error());
              while ($anggota = mysql_fetch_array($sql)) {
                $getuser = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE kd_user = '$anggota[dibalas_kepada]'"));
                if ($anggota['status'] == "dibaca") {
                  $pesan = "Sudah di Baca";
                  $color = "green white-text";
                }elseif ($anggota['status'] == "belum") {
                  $pesan = "Belum di Baca";
                  $color = "indigo white-text";
                }
                ?>
              <li class="collection-item avatar">
                   <i class="material-icons circle teal lighten-1">forward</i>
                    <span class="title" style="font-size: 17px;font-weight: 300;">Surat <span class="grey-text text-darken-3" style="font-weight: 600;"><?php echo $anggota['kd_surat']; ?></span> kepada <span class="deep-orange-text text-lighten-1" style="font-weight: 600;"><?php echo $getuser['nama']; ?></span></span>
                    <p class="grey-text text-darken-1 regular-font" style="font-size: 15px;margin-top: 1%;"><span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;">
                      <span class="chip font-medium font-light" style="text-transform: capitalize;font-weight: 400;">Waktu Disposisi : <span style="font-weight: 500;"><?php echo date_format(date_create($anggota['tanggal_disposisi']),"d M Y"); ?></span>, Pukul : <span style="font-weight: 500;"><?php echo date_format(date_create($anggota['tanggal_disposisi']),"H:i:s"); ?></span></span></span> <span class="chip <?php echo $color ?> font-medium font-light" style="font-weight: 400;"><span style="font-weight: 300;"><?php echo $pesan; ?></span></span>
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