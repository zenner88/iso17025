<?

if ($aksi=="Tambah") {
	if (trim($id)=="")	{
		$errmesg="ID Pemakai Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Pemakai Harus Diisi";
	} else {
		$q="INSERT INTO pemakai VALUES('$id','$nama','$lab')";
		doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {
			$errmesg="Data Pemakai berhasil ditambahkan";
			$id="";
			$nama="";
			$lab="";
		} else {
			$errmesg="Data Pemakai tidak berhasil ditambahkan. ID yang digunakan sudah ada
			di dalam basis data.  Silakan mengganti ID pemakai.";
		}
	}
	printmesg($errmesg);
}

echo "
<h3>Tambah Data Pemakai</h3>
<form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
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
				<input type=submit name=aksi value='Tambah'>
				<input type=reset value='Hapus Isian'>
			</td>
		</tr>
	</table>


</form>
";

?>