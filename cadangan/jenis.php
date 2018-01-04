<?
if ($aksi=="Tambah") {
		$h=doquery("SELECT MAX(ID) AS JML FROM jpegawai",$koneksi);
		$d=sqlfetcharray($h);
		$idbaru=$d[JML]+1;
		$q="INSERT INTO jpegawai VALUES('$idbaru','$nama','$namaen')";
		doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {
			$mesg="Kategori SDM dengan Nama '$nama' berhasil ditambahkan";
		} else {
			$mesg="Kategori SDM dengan Nama '$nama' tidak berhasil ditambahkan";
		}
} elseif ($aksi=="Update") {
		$q="UPDATE jpegawai 
		SET 
		NAMA_IN='$namabaru',
		NAMA_EN='$namabaruen'
		 WHERE ID='$idupdate'";
		doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {
			$mesg="Kategori SDM dengan Nama '$namabaru' berhasil diupdate";
		} else {
			$mesg="Kategori SDM dengan Nama '$namabaru' tidak berhasil diupdate";
		}
} elseif ($aksi=="Hapus") {
		$namahapus= $arrayjenisartikel[$idhapus];
	 	$q="DELETE FROM jpegawai  WHERE ID='$idhapus'";
		doquery($q,$koneksi);
		echo mysql_error();
		if (sqlaffectedrows($koneksi)>0) {
		 	$q="UPDATE pegawai SET JENIS='0'  WHERE JENIS='$idhapus'";
			doquery($q,$koneksi);
			$mesg="Kategori SDM dengan Nama '$namahapus' berhasil dihapus";
		} else {
			$mesg="Kategori SDM dengan Nama '$namahapus' tidak berhasil dihapus";
		}
}

printmesg($mesg);

unset($arrayjenisartikel);
$q="SELECT * FROM jpegawai WHERE ID > 0 ORDER BY NAMA_IN";
$h=doquery($q,$koneksi);
echo mysql_error();
while ($d=sqlfetcharray($h)) {
	$arrayjenisartikel[$d[ID]]=$d[NAMA_IN]." / ".$d[NAMA_EN];
}



echo "
<form action=index.php method=post>
<input type=hidden name=pilihan value='$pilihan'>
";
//baris2("Tambah Kategori");

echo "
<br>
<table width=500 $sttabelkiri>
	<tr>	
		<td class=judulb colspan=2 >
			Tambah Kategori
		</td>
	</tr>
	<tr>	
		<td width=100>
			Nama Kategori Baru
		</td>
		<td>
			<input type=text size=20 name=nama> (indonesia)
			<input type=text size=20 name=namaen> (inggris)
			<input type=submit name=aksi value='Tambah'>
		</td>
	</tr>
</table>
";

//baris2("Update Kategori");
echo "

<br>
<center>
<table width=500 $sttabelkiri>
	<tr>	
		<td class=judulb colspan=2>
			Update Kategori
		</td>
	</tr>
	<tr>	
		<td width=100>
			Kategori 
		</td>
		<td>
			<select name=idupdate>";
				foreach ($arrayjenisartikel as $k=>$v) {
					echo "<option value='$k'>$v</option>";
				}
			echo "</select>
			 diubah menjadi<br>
			<input type=text size=20 name=namabaru> (indonesia) 
			<input type=text size=20 name=namabaruen> (inggris)
			<input type=submit name=aksi value='Update'>
		</td>
	</tr>
</table>
";

//baris2("Hapus Kategori");
echo "
<br>
<table width=500 $sttabelkiri >
	<tr>	
		<td class=judulb colspan=2>
			Hapus Kategori
		</td>
	</tr>
	<tr>	
		<td>
			Kategori 
		</td>
		<td>
			<select name=idhapus>";
				foreach ($arrayjenisartikel as $k=>$v) {
					echo "<option value='$k'>$v</option>";
				}
			echo "</select><br>
			<input type=submit name=aksi value='Hapus'>
		</td>
	</tr>
</table>
";
//baris();
echo "
</form>
";
?>