<?

if ($aksi=="Update") {
	if (trim($id)=="")	{
		$errmesg="ID Pemakai Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Pemakai Harus Diisi";
	} else {
		$q="UPDATE pemakai 
			SET 
			ID='$id',
			NAMA='$nama',
			IDLAB='$lab'
			WHERE ID='$idupdate'";
		doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {

			$q="UPDATE pengeluaran SET IDPEMAKAI='$id' WHERE IDPEMAKAI='$idupdate'"; 
			doquery($q,$koneksi);


			$errmesg="Data Pemakai berhasil diupdate";
			$idupdate=$id;
		} else {
			$errmesg="Data Pemakai tidak diupdate.";
		}
	}
	printmesg($errmesg);
}

$q="SELECT ID,NAMA,IDLAB FROM pemakai WHERE ID='$idupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$nama=$data[NAMA];
	$lab=$data[IDLAB];
}

echo "
<h3>Update Data Pemakai</h3>
<form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=idupdate value='$idupdate'>
	<table $border>
		<tr>
			<td width=20%>
				ID Pemakai
			</td>
			<td>
				<input type=text name=id size=5 value='$id'>
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
				Laboratorium
			</td>
			<td>
				<select name=lab>";
					foreach ($arraylab as $k=>$v) {
						if ($lab==$k) {
							$ck="selected";
						} else {
							$ck="";
						}
						echo "<option $ck value=$k>$v</option>";
					}
			echo "
				</select>
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


</form>
";

?>