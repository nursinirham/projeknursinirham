<?php 
	include 'config/koneksi.php';
  session_start();
  if (empty($_SESSION['namahome'])) {
          echo "<script>alert('Anda harus login dahulu!');document.location.href='index.php'</script>";
      }
  if($_GET['bulan'] == "01") {
    $bulans = "Januari";
  }elseif ($_GET['bulan'] == "02") {
    $bulans = "Februari";
  }elseif ($_GET['bulan'] == "03") {
    $bulans = "Maret";
  }elseif ($_GET['bulan'] == "04") {
    $bulans = "April";
  }elseif ($_GET['bulan'] == "05") {
    $bulans = "Mei";
  }elseif ($_GET['bulan'] == "06") {
    $bulans = "Juni";
  }elseif ($_GET['bulan'] == "07") {
    $bulans = "Juli";
  }elseif ($_GET['bulan'] == "08") {
    $bulans = "Agustus";
  }elseif ($_GET['bulan'] == "09") {
    $bulans = "September";
  }elseif ($_GET['bulan'] == "10") {
    $bulans = "Oktober";
  }elseif ($_GET['bulan'] == "11") {
    $bulans = "November";
  }elseif ($_GET['bulan'] == "12") {
    $bulans = "Desember";
  }
 ?>
 <!DOCTYPE html>
  <html>
    <?php 
    	include 'library/head.php';
     ?>

    <body class="font-regular" style="background: #eee;">
  <div class="row">
    <div class="container" style="width: 100%;">
    <div class="card">
      <div class="card-content">
        <div class="" style="text-align: center;">
        <img src="img/logo2.png" width="330px" height="150px" alt="">
        </div>
       <h2 class="grey-text text-darken-3 center" style="font-size: 40px;font-weight: 600;letter-spacing: -2px;text-align: center;">Laporan Surat <span style="text-transform: capitalize;"><?php echo $_GET['status']; ?></span></h2>
       <h6 class="grey-text center font-regular" style="font-size: 22px;font-weight: 300;text-align: center;">Periode : <?php echo $bulans; ?></h6>
           <table class="centered" border="3" style="border: 1px solid #ddd;width: 100%;text-align: center;margin-top: 3%;">
        <thead>
          <tr>
              <th>Kode</th>
              <th>Waktu Datang</th>
              <th>No. Surat</th>
              <th>Tanggal Surat</th>
              <th>Dari</th>
              <th>Kepada</th>
              <th>Subjek</th>
              <th>File</th>
              <th>Tipe</th>
          </tr>
        </thead>

        <tbody>
          <?php 
              $sql = mysql_query("SELECT * FROM tbl_surat where month(waktu_datang)='$_GET[bulan]'") or die(mysql_error());
              while ($anggota = mysql_fetch_array($sql)) {
                $gettipedata = mysql_fetch_array(mysql_query("SELECT * FROM tbl_tipe_surat WHERE kd_tipe_surat = '$anggota[kd_tipe_surat]'"));
                ?>
          <tr>
            <td><?php echo $anggota['kd_surat']; ?></td>
            <td><?php echo date_format(date_create($anggota['waktu_datang']),"d M Y"); ?></td>
            <td><?php echo $anggota['no_surat']; ?></td>
            <td><?php echo date_format(date_create($anggota['tanggal_surat']),"d M Y"); ?></td>
            <td><?php echo $anggota['dari']; ?></td>
            <td><?php echo $anggota['kepada']; ?></td>
            <td><?php echo $anggota['subjek_surat']; ?></td>
            <td><?php echo $anggota['file_surat']; ?></td>
            <td><?php echo $gettipedata['tipe']; ?></td>
          </tr>
          <?php 
          }
           ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
    </div>
      <div class="fixed-action-btn horizontal tooltipped" data-tooltip="Print" data-delay="50" data-position="left" style="bottom: 45px; right: 24px;">
    <a href="print.php?bulan=<?php echo $_GET['bulan']?>&status=<?php echo $_GET['status'] ?>" class="btn-floating btn-large red  ">
      <i class="large material-icons">description</i>
    </a>
  </div>
      <!--Import jQuery before materialize.js-->
      <?php 
      	include 'library/js.php';
       ?>
    </body>
  </html>