<?
if ($_SESSION[tingkats]!="C") {
    exit;
}
if ($aksi=="Tambah") {
	if (trim($id)=="")	{
		$errmesg="ID Bahan Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Bahan Kimia Harus Diisi";
	} elseif ($fileupload=="none") {
		$errmesg="File Referensi Harus Diisi";
	} else {
			if (isset($WINDIR)) {
				$fileupload=str_replace("\\\\","\\",$fileupload);
			}
			$namafile=basename($fileupload_name);	
  			$q="INSERT INTO bahankimia(IDBAHAN,NAMABAHAN,NAMAKIMIA,KATALOG,SATUAN,CATATAN,FILEG) VALUES ('$id', '$nama', '$kimia', '$katalog', '$satuan', NULL , '$id$namafile')";
			mysql_query($q);
			if (sqlaffectedrows($koneksi)>0) {
		$ketlog="Tambah Bahan Kimia. ID=$id, Nama=$nama, Kimia=$kimia, Katalog=$katalog ,File=$namafile";
        buatlogiso(19,$ketlog,$q,$users);


				move_uploaded_file($fileupload,"file/$id$namafile");
				$errmesg="Data Bahan Kimia berhasil ditambahkan";
				$id=$nama=""; 

			} else {
				$errmesg="Data Bahan Kimia tidak berhasil ditambahkan. ID yang digunakan sudah ada
				di dalam basis data.  Silakan mengganti ID Bahan Kimia.";
			}
 	}
	printmesg($errmesg);
}

echo "
<h3>Tambah Data Bahan Kimia</h3>
<form name=form action=index.php method=post ENCTYPE=\"MULTIPART/FORM-DATA\">
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=150  nowrap>
				ID Bahan Kimia
			</td>
			<td>
				<input type=text name=id size=10 value='$id'><script>form.id.focus();</script>	 
			</td>
		</tr>
		<tr>
			<td>
				Nama Bahan Kimia
			</td>
			<td>
				<input type=text name=nama size=30 value='$nama'>
			</td>
		</tr>
		<tr>
			<td>
				Nama Kimia
			</td>
			<td>
				<input type=text name=kimia size=30 value='$kimia'>
			</td>
		</tr>
		<tr>
			<td>
				No. Katalog / CAS System
			</td>
			<td>
				<input type=text name=katalog size=30 value='$katalog'>
			</td>
		</tr>
		<tr>
			<td>
				Satuan
			</td>
			<td>
				<input type=text name=satuan size=20 value='$satuan'>
			</td>
		</tr>
		<tr>
			<td>
				File Referensi
			</td>
			<td>
				<input type=file name=fileupload >
			</td>
		</tr>
 		<tr>
			<td colspan=2>
			<br>
				<input type=submit name=aksi value='Tambah'>
				<input type=reset value='Hapus Isian'>
			</td>
		</tr>
	</table>

</form name=form>

";
?>
