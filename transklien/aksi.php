<?
if ($aksi=="Tambah" && $pilihan=="ltambah") {
	if (trim($id)=="")	{
		$errmesg="Kode Permintaan Analisis Harus Diisi";
  	} else {
  			  $q="INSERT INTO minta 
 			(ID,IDKLIEN,TANGGALDATANG,TANGGALDEADLINE,STATUS,
 			IDUSER,IDMAN,TGLUPDATE,UPDATER,CONTOH,NOMER1,NOMER2)
 			VALUES('$id','$users',CURDATE(),'$thnd-$blnd-$tgld',
			'4','$users','$idman',NOW(),'$users','$contoh','$nomer1','$nomer2')";
			doquery($q,$koneksi);
			echo mysql_error();
			if (sqlaffectedrows($koneksi)>0) {
  		  $ketlog="Tambah permintaan. ID=$id, Klien=$users, Sampel=$contoh";
        buatlogiso(4,$ketlog,$q,$users);
				$errmesg="Data Permintaan Analisis berhasil ditambahkan. 
				Silakan lanjutkan dengan penambahan Sampel Data yang hendak diuji";
 				Header("Location: index.php?pilihan=lupdate&idupdate=$id&ok=1");
				exit;
			} else {
				$errmesg="Data Permintaan Analisis tidak berhasil ditambahkan.";
				$aksi="";
			}
 	}
}
?>
