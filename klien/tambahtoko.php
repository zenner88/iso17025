<?
if ($_SESSION[tingkats]!="B") {
    exit;
}

if ($aksi=="Tambah") {
	if (trim($id)=="")	{
		$errmesg="ID Klien Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Klien Harus Diisi";
  } elseif (trim($pwd)==""  ) {
      $errmesg="Password harus diisi";
  } elseif (trim($pwd)!="" && trim($pwd)!=trim($pwd2)) {
      $errmesg="Password harus sama";
 	} else {
 			$q="INSERT INTO toko VALUES('$id','$nama','$kontak',
			'$telepon','$alamat','$npwp','$jangkabayar','$limit',MD5('".trim($pwd)."'))";
			doquery($q,$koneksi);
			if (sqlaffectedrows($koneksi)>0) {
				$errmesg="Data Klien berhasil ditambahkan";
 			} else {
				$errmesg="Data Klien tidak berhasil ditambahkan. ID yang digunakan sudah ada
				di dalam basis data.  Silakan mengganti ID Klien.";
			}
 	}
	printmesg($errmesg);
}

echo "
<h3>Tambah Data Klien</h3>
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=150  nowrap>
				ID Klien
			</td>
			<td>
				<input type=text name=id size=20 value='$id'><script>form.id.focus();</script>
			 
			</td>
		</tr>
		<tr>
			<td>
				Password
			</td>
			<td>
				<input type=password name=pwd size=30  > 
			</td>
		</tr>
		<tr>
			<td>
				Konfirm Password
			</td>
			<td>
				<input type=password name=pwd2 size=30  >
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
				Kontak Personal
			</td>
			<td>
				<input type=text name=kontak size=30 value='$kontak'>
			</td>
		</tr>
		<tr>
			<td>
				Telepon
			</td>
			<td>
				<input type=text name=telepon size=15 value='$telepon'>
			</td>
		</tr>
		<tr>
			<td>
				Alamat
			</td>
			<td>
				<textarea name=alamat cols=50 rows=4>$alamat</textarea>
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
/*
		<tr>
			<td>
				NPWP
			</td>
			<td>
				<input type=text name=npwp size=25 value='$npwp'>
			</td>
		</tr>
		<tr>
			<td>
				Jangka Waktu Pembayaran
			</td>
			<td>
				<input type=text name=jangkabayar size=4 value='$jangkabayar'> hari
			</td>
		</tr>
		<tr>
			<td>
				Limit Kredit
			</td>
			<td>
				Rp. <input type=text name=limit size=10 value='$limit'> 
			</td>
		</tr>
*/
?>
