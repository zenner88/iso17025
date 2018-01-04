<?
if ($_SESSION[tingkats]!="B") {
    exit;
}

if ($aksi=="Update") {
	if (trim($id)=="")	{
		$errmesg="ID Klien Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Klien Harus Diisi";
  } elseif (trim($pwd)!="" && trim($pwd)!=trim($pwd2)) {
      $errmesg="Password harus sama";
	} else {
	   $qp="";
     if (trim($pwd)!="" && trim($pwd)==trim($pwd2)) {
      $qp="PASSWORD=MD5('".trim($pwd)."'), ";
//			ID='$id',
	   }
		 $q="UPDATE toko 
			SET 
			$qp
			NAMA='$nama',
			KONTAK='$kontak',
			ALAMAT='$alamat',
			NPWP='$npwp',
			JANGKABAYAR='$jangkabayar',
			LIMITKREDIT='$limit',
			TELEPON='$telepon'
			WHERE ID='$idupdate'";
		doquery($q,$koneksi);
  		if (sqlaffectedrows($koneksi)>0) {
    
  			$errmesg="Data Klien berhasil diupdate";
  			$idupdate=$id;
  		} else {
  			$errmesg="Data Klien tidak diupdate.";
  		}
     
	}
 }

$q="SELECT * FROM toko WHERE ID='$idupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$nama=$data[NAMA];
	$kontak=$data[KONTAK];
	$telepon=$data[TELEPON];
	$alamat=$data[ALAMAT];
	$npwp=$data[NPWP];
	$jangkabayar=$data[JANGKABAYAR];
}

echo "
<h3>Update Data Klien</h3>";
printmesg($errmesg);

echo "
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=idupdate value='$idupdate'>
	<table $border>
		<tr>
			<td width=150  nowrap>
				ID Klien
			</td>
			<td>
				<input type=text name=id size=20 value='$id' readonly><script>form.id.focus();</script>
			</td>
		</tr>
		<tr>
			<td>
				Password
			</td>
			<td>
				<input type=password name=pwd size=30  > Password lama tidak akan berubah jika tidak diisi
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
				<input type=submit name=aksi value='Update'>
				<input type=reset value='Reset Isian'>
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
