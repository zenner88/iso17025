<?php
include '../db.php';
if (empty($_POST['pilihan'])) {
	# code...
} else {
	if ($_POST['pilihan'] == "ltambah") {
		$id = $_POST['id'];
		$idklien = $_POST['idklien'];
		$thnmasuk = $_POST['']
		$q="INSERT INTO minta 
 			(ID,IDKLIEN,TANGGALDATANG,TANGGALDEADLINE,STATUS,
 			IDUSER,IDMAN,TGLUPDATE,UPDATER,CONTOH,NOMER1,NOMER2)
 			VALUES('$id','$idklien','$thnmasuk-$blnmasuk-$tglmasuk','$thnd-$blnd-$tgld',
			'3','$users','$idman',NOW(),'$users','$contoh','$nomer1','$nomer2')";
			doquery($q,$koneksi);
			echo mysql_error();
			if (sqlaffectedrows($koneksi)>0) {
  		  		$ketlog="Tambah permintaan. ID=$id, Klien=$idklien, Sampel=$contoh";
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
