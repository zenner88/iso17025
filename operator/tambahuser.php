<?

if ($aksi=="Tambah") {
	if (trim($id)=="")	{
		$errmesg="ID Operator Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Operator Harus Diisi";
	} elseif (trim($pwd1)=="") {
		$errmesg="Password Harus Diisi";
	} elseif (trim($pwd1)!=trim($pwd2)) {
		$errmesg="Kedua Password Harus Sama";
	} else {
		$q="INSERT INTO user VALUES('$id','$nama',md5('$pwd1'),'$tingkat')";
		doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {
		  $ketlog="Tambah Operator. ID=$id,nama=$nama";
      buatlogiso(0,$ketlog,$q,$users);

			$errmesg="Data Operator berhasil ditambahkan";
			$id="";
			$nama="";
			$tingkat="";
			$pwd1="";
			$pwd2="";
			
		} else {
			$errmesg="Data Operator tidak berhasil ditambahkan. ID yang digunakan sudah ada
			di dalam basis data.  Silakan mengganti ID Operator.";
		}
	}
	printmesg($errmesg);
}

echo "
<h3>Tambah Data Operator</h3>
<form name=form action=index.php method=get>
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=30%>
				ID Operator
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
				Password
			</td>
			<td>
				<input type=password name=pwd1 size=10 value='$pwd1'>
			</td>
		</tr>
		<tr>
			<td>
				Konfirmasi Password
			</td>
			<td>
				<input type=password name=pwd2 size=10 value='$pwd2'>
			</td>
		</tr>
		<tr>
			<td>
				Tingkat
			</td>
			<td>
				<select name=tingkat>";
				unset($arraytingkat[F]);
					foreach ($arraytingkat as $k=>$v) {
						if ($tingkat==$k) {
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


</form name=form>
";

?>
