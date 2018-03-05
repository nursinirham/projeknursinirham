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
    <div class="container" style="width: 95%;">
      <div class="card">
        <div class="card-content">
          <h1 class="grey-text text-darken-2 center" style="font-weight: 600;letter-spacing: -2px;">Selamat Datang di Kearsipan <br> <span class="teal-text text-lighten-1">SMK Negeri 6 Kota Bekasi</span></h1>
        </div>
      </div>
    </div>
  </div>
    <div class="fixed-action-btn toolbar">
    <a class="btn-floating btn-large pink tooltipped" data-delay="50" data-tooltip="Settings" data-position="top">
      <i class="large material-icons">settings</i>
    </a>
    <ul>
      <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">insert_chart</i></a></li>
      <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">format_quote</i></a></li>
      <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">publish</i></a></li>
      <li class="waves-effect waves-light"><a href="#!"><i class="material-icons">attach_file</i></a></li>
    </ul>
  </div>
      <!--Import jQuery before materialize.js-->
      <?php 
        include 'library/js.php';
       ?>
    </body>
  </html>