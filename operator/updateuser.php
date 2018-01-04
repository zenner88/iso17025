<?

if ($aksi=="Update") {
	if (trim($id)=="")	{
		$errmesg="ID Operator Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Operator Harus Diisi";
	} elseif (trim($pwd1)!=trim($pwd2) && (trim($pwd1!="") || trim($pwd2!=""))) {
		$errmesg="Kedua Password Harus Sama";
	} else {
		if (trim($pwd1)!="") {
			$password="PASSWORD=md5('$pwd1'),";
		}
		$q="UPDATE user 
			SET 
 			NAMA='$nama',$password
			TINGKAT='$tingkat'
			WHERE ID='$idupdate'";
		doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {

		  $ketlog="Update Operator. ID=$id,nama=$nama";
      buatlogiso(1,$ketlog,$q,$users);

 			$errmesg="Data Operator berhasil diupdate";
			$idupdate=$id;

			$pwd1="";
			$pwd2="";


		} else {
			$errmesg="Data Operator tidak diupdate.";
		}
	}
	printmesg($errmesg);
}

$q="SELECT ID,NAMA,TINGKAT FROM user WHERE ID='$idupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$nama=$data[NAMA];
	$tingkat=$data[TINGKAT];
}

echo "
<h3>Update Data Operator</h3>
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=idupdate value='$idupdate'>
	<table $border>
		<tr>
			<td width=20%>
				ID Operator
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
				Password
			</td>
			<td>
				<input type=password name=pwd1 size=10 value='$pwd1'> Kosongkan password jika password tidak hendak diubah
			</td>
		</tr>
		<tr>
			<td>
				Konfirmasi Password
			</td>
			<td>
				<input type=password name=pwd2 size=10  value='$pwd2'>
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
				<input type=submit name=aksi value='Update'>
				<input type=reset value='Reset Isian'>
			</td>
		</tr>
	</table>


</form name=form>
";

?>
