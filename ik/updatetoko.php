<?
if ($_SESSION[tingkats]!="C") {
    exit;
}

if ($aksi=="Update") {
	if (trim($id)=="")	{
		$errmesg="ID Instruksi Kerja Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Instruksi Kerja Harus Diisi";
	} else {
		if ($fileupload!="none") {
			if (isset($WINDIR)) {
				$fileupload=str_replace("\\\\","\\",$fileupload);
			}
			$namafile=basename($fileupload_name);	
			$qf="FILE='$id$namafile',";
		}
		$q="UPDATE ik 
			SET 
			ID='$id',
			$qf
			NAMA='$nama'
 			WHERE ID='$idupdate'";
		doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {
  		  $ketlog="Update IK. ID=$idupdate, Nama=$nama, File=$namafile";
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
			$errmesg="Data Instruksi Kerja berhasil diupdate";
			$idupdate=$id;
		} else {
			$errmesg="Data Instruksi Kerja tidak diupdate.";
		}
	}
	printmesg($errmesg);
}

$q="SELECT * FROM ik WHERE ID='$idupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$nama=$data[NAMA];
 	$file=$data[FILE];
}

echo "
<h3>Update Data Instruksi Kerja</h3>
<form name=form action=index.php method=post ENCTYPE=\"MULTIPART/FORM-DATA\">
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=idupdate value='$idupdate'>
	<input type=hidden name=filelama value='$file'>
	<table $border>
		<tr>
			<td width=150  nowrap>
				ID Instruksi Kerja
			</td>
			<td>
				<input type=text name=id size=5 value='$id'><script>form.id.focus();</script>
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
				<input type=file name=fileupload ><br>
				<a href='file/$file' target=_blank>$file</a>
			</td>
		</tr>
 
		<tr>
			<td colspan=2>
			<br>
				<input type=submit name=aksi value='Update'>
				<input type=reset value='Reset Isian'>
			</td>
		</tr>
	</table>


</form name=form>
";
 
?>
