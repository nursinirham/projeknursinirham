*Kode
**@$cari_kd=mysql_query("select max(nota)as kode from tbl_transaksi"); //mencari kode yang paling besar atau kode yang baru masuk
    @$tm_cari=mysql_fetch_array(@$cari_kd);
    @$kode=substr(@$tm_cari['kode'],1,4); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
    @$tambah=@$kode+1; //kode yang sudah di pecah di tambah 1
    if(@$tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
      @$id="N000".$tambah;
    }else{
      @$id="N00".$tambah;
    }
 function anti_injection($data)
		{
			$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
			return $filter;
		}
