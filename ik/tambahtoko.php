<?

if ($_SESSION[tingkats]!="C") {
    exit;
}
if ($aksi=="Tambah") {
	if (trim($id)=="")	{
		$errmesg="ID Instruksi Kerja Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Instruksi Kerja Harus Diisi";
	} elseif ($fileupload=="none") {
		$errmesg="File Referensi Harus Diisi";
	} else {
			if (isset($WINDIR)) {
				$fileupload=str_replace("\\\\","\\",$fileupload);
			}
			$namafile=basename($fileupload_name);	
  			$q="INSERT INTO ik VALUES('$id','$nama','$id$namafile')";
			doquery($q,$koneksi);
			if (sqlaffectedrows($koneksi)>0) {
  		  $ketlog="Tambah IK. ID=$id, Nama=$nama, File=$namafile";
        buatlogiso(19,$ketlog,$q,$users);


				move_uploaded_file($fileupload,"file/$id$namafile");
				$errmesg="Data Instruksi Kerja berhasil ditambahkan";
				$id=$nama="";

			} else {
				$errmesg="Data Instruksi Kerja tidak berhasil ditambahkan. ID yang digunakan sudah ada
				di dalam basis data.  Silakan mengganti ID Instruksi Kerja.";
			}
 	}
	printmesg($errmesg);
}

echo "
<h3>Tambah Data Instruksi Kerja</h3>
<form name=form action=index.php method=post ENCTYPE=\"MULTIPART/FORM-DATA\">
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=150  nowrap>
				ID Instruksi Kerja
			</td>
			<td>
				<input type=text name=id size=10 value='$id'><script>form.id.focus();</script>
			 
			</td>
		</tr>
		<tr>
			<td>
				Nama
			</td>
			<td>
				<input type=text name=nama size=30 value='$nama'>
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
