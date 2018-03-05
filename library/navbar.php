<ul id="slide-out" class="side-nav fixed">
    <li><div class="user-view">
      <div class="background" style="background-image: url(img/wallpaper2.jpeg);background-size: cover;background-position: center;">
          <ul id='dropdown1' class='dropdown-content' style="overflow-x: hidden;">
    <li><a href="logout.php" onclick="return confirm('Anda yakin ingin log out?')"><i class="material-icons left">power_settings_new</i>Log Out</a></li>
  </ul>
      </div>  
      <a href="#!user"><img class="circle" src="img/user.svg"></a>
      <a href="#!name"><span class="white-text name waves-effect dropdown-button" data-activates='dropdown1' style="font-weight: 600;letter-spacing: -1px;font-size: 17px;"><?php echo $_SESSION['namahome']; ?><i class="material-icons right">keyboard_arrow_down</i></span></a>
      <a href="#!email"><span class="white-text email" style="font-weight: 300 !important;text-transform: capitalize;"><?php echo $_SESSION['role']; ?></span></a>
    </div></li>
    <?php 
      if ($_SESSION['role'] == "sekretaris") {
        ?>
    <li><a class="subheader">Pengelolaan Surat</a></li>
    <li><a href="suratmasuk.php" class="waves-effect waves-red" style="font-weight: 300;font-size: 15px;"><i class="material-icons">archive</i>Surat Masuk</a></li>
    <li><a href="suratkeluar.php" class="waves-effect waves-red" style="font-weight: 300;font-size: 15px;"><i class="material-icons">mail</i>Surat Keluar</a></li>
    <li><a href="riwayatdisposisi.php" class="waves-effect waves-red" style="font-weight: 300;font-size: 15px;"><i class="material-icons">forward</i>Riwayat Disposisi</a></li>
    <li><a href="tipesurat.php" class="waves-effect waves-red" style="font-weight: 300;font-size: 15px;"><i class="material-icons">turned_in</i>Tipe Surat</a></li>
      <?php
      }elseif ($_SESSION['role'] == "admin") {
      ?>
      <li><a class="subheader">Pengelolaan User</a></li>
    <li><a href="kelolauser.php" class="waves-effect waves-red" style="font-weight: 300;font-size: 15px;"><i class="material-icons">supervisor_account</i>Kelola User</a></li>
      <?php
      }elseif ($_SESSION['role'] == "manager") {
        $countdata = mysql_num_rows(mysql_query("SELECT * FROM tbl_disposisi WHERE dibalas_kepada = '$_SESSION[idadmin]' AND status = 'belum'"));
        ?>
      <li><a class="subheader">Pemantauan Surat</a></li>
    <li><a href="manager.php" class="waves-effect waves-red" style="font-weight: 300;font-size: 15px;"><i class="material-icons">weekend</i>Home</a></li>
    <li><a href="kotaksurat.php" class="waves-effect waves-red" style="font-weight: 300;font-size: 15px;"><i class="material-icons">markunread_mailbox</i>Kotak Surat<span class="badge new white-text"><?php echo $countdata; ?></span></a></li>
    <li><a href="laporan.php" class="waves-effect waves-red" style="font-weight: 300;font-size: 15px;"><i class="material-icons">book</i>Laporan</a></li>
      <?php
      }
     ?>
    
  </ul>