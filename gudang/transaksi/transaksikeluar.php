<?
if ($_SESSION[tingkats]!="C") {
    exit;
}
//if ($aksi=="Masuk") {

echo "
<h3>Tambah Data Transaksi Keluar Bahan Kimia</h3>
<form name=form action=index.php method=post ENCTYPE=\"MULTIPART/FORM-DATA\">
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=150 nowrap>
				Nama Bahan - Satuan
			</td>";	 
			$result=mysql_query("SELECT idbahan, namabahan, satuan FROM bahankimia");
			$num_row=mysql_num_rows($result);
			echo" <td><select name='id' id='id'>";
					if($num_row) {
						for($i=0; $i<$num_row; $i++){
							$dat=mysql_fetch_array($result);
							echo "<option selected value=".$dat[0].">".$dat[1]." - ".$dat[2]."</option>";
						}
					}
			echo"</select>
			</td>
		</tr>
		<tr>
			<td>
				Jumlah Keluar
			</td>
			<td>
				<input type=text name=jumlah size=10 value='$jumlah'>
			</td>
		</tr>
		<tr>
			<td>
				Tanggal Keluar<br/>(yyyy-mm-dd)
			</td>
			<td>
				<input type=text name=tgl size=10 value='$tgl'>
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

	if (trim($jumlah)=="")	{
		$errmesg="Jumlah Bahan yang dimasukkan Harus Diisi";
	} else {
			if (isset($WINDIR)) {
				$fileupload=str_replace("\\\\","\\",$fileupload);
			}
			$namafile=basename($fileupload_name);	
  			$q="INSERT INTO transaksi VALUES ('NULL', '1', '$HTTP_POST_VARS[id]', '', '$jumlah', '$tgl')";
			mysql_query($q);
			if (sqlaffectedrows($koneksi)>0) {
				$ketlog="Tambah Bahan Kimia. ID=$HTTP_POST_VARS[id], Nama=$nama";
				buatlogiso(19,$ketlog,$q,$users);

				move_uploaded_file($fileupload,"file/$HTTP_POST_VARS[id]$namafile");
				$errmesg="Data Transaksi Bahan Kimia berhasil ditambahkan";
				$id=$nama=""; 
				$q2="UPDATE bahankimia SET jumlah = jumlah - '$jumlah' where idbahan = '$HTTP_POST_VARS[id]'";
				mysql_query($q2);
			} else {
				$errmesg="Data Transaksi Bahan Kimia tidak berhasil ditambahkan. ID yang digunakan sudah ada
				di dalam basis data. Silakan mengganti ID Bahan Kimia.";
			}
 	}
	printmesg($errmesg);
//}

?>
