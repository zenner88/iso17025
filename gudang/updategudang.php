<?
if ($_SESSION[tingkats]!="C") {
    exit;
}

if ($aksi=="Update") {
	if (trim($id)=="")	{
		$errmesg="ID Bahan Kimia Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Bahan Kimia Harus Diisi";
	} else {
		if ($fileupload!="none") {
			if (isset($WINDIR)) {
				$fileupload=str_replace("\\\\","\\",$fileupload);
			}
			$namafile=basename($fileupload_name);	
			$qf="FILE='$id$namafile',";
		}
		$q="UPDATE bahankimia SET 			idbahan='$id',
											namabahan='$nama',
											namakimia='$kimia',
											katalog='$katalog',
											jumlah='$jumlah',
											satuan='$satuan',
											catatan='$cat',
											fileg='$file'
											where idbahan='$idupdate'";
		doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {
  		  $ketlog="Update Data Bahan Kimia. ID=$idupdate, Nama=$nama, File=$file";
        buatlogiso(20,$ketlog,$q,$users);
			if ($fileupload!="none") {
				@unlink("file/$filelama");
				move_uploaded_file($fileupload,"file/$id$namafile");
			}
			/*
			$q="UPDATE akun SET ID='$id', NAMA='Piutang Dagang $nama' 
			WHERE ID='$idupdate'"; 
			doquery($q,$koneksi);
  			*/
			$errmesg="Data Bahan Kimia berhasil diupdate";
			$idupdate=$id;
		} else {
			$errmesg="Data Bahan Kimia tidak diupdate.";
		}
	}
	printmesg($errmesg);
}

$q="SELECT * FROM bahankimia WHERE IDBAHAN='$idupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[IDBAHAN];
	$nama=$data[NAMABAHAN];
	$kimia=$data[NAMAKIMIA];
	$katalog=$data[KATALOG];
	$jumlah=$data[JUMLAH];
	$satuan=$data[SATUAN];
 	$file=$data[FILEG];
}

echo "
<h3>Update Data Bahan Kimia</h3>
<form name=form action=index.php method=post ENCTYPE=\"MULTIPART/FORM-DATA\">
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=idupdate value='$idupdate'>
	<input type=hidden name=filelama value='$file'>
	<table $border>
		<tr>
			<td width=150  nowrap>
				ID Bahan Kimia
			</td>
			<td>
				<input type=text name=id size=5 value='$id'><script>form.id.focus();</script>
			</td>
		</tr>
		<tr>
			<td>
				Nama Bahan
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
				Jumlah - Satuan
			</td>
			<td>
				<input type=text name=jumlah size=10 value='$jumlah'> <input type=text name=satuan size=20 value='$satuan'>
			</td>
		</tr>
		<tr>
			<td>
				File Referensi
			</td>
			<td>
				<input type=file name=fileupload ><br>
				<a href='file/$file' target=_blank>$file</a>
			</td>
		</tr>
		<tr>
			<td colspan=2>
			<br>
				<input type=submit name=aksi value='Update'>
				<input type=reset value='Hapus Isian'>
			</td>
		</tr>
	</table>


</form name=form>
";
 
?>
