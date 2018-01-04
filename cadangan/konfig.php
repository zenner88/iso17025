<?
 printjudulmenu("Konfigurasi Cadangan Data Otomatis");
if ($aksi=="Simpan") {


		$f=fopen("konfig","w");
		$dircadangan=str_replace("\\\\","\\",$dircadangan);
		fwrite($f,"$dircadangan",strlen("$dircadangan"));
		fwrite($f,"\n",1);
		fwrite($f,"$wcadangan",strlen("$wcadangan"));
		fwrite($f,"\n",1);
	
		fwrite($f,"$hari",strlen("$hari"));
		fclose($f);
		
		$errmesg="Data konfigurasi pembuatan cadangan data berhasil disimpan";
}
printmesg($errmesg);

$konfigfile=file("konfig");
$dircadangan=trim($konfigfile[0]);
if (trim($konfigfile[1])=="M") {
	$cekm="checked";
	$idhari=trim($konfigfile[2]);
} else {
	$cekh="checked";
}


echo "

<form action=index.php method=post>
<input type=hidden name=pilihan value=konfig>
<table class=form> 
<tr valign=top>
	<td class=juduldata>
		Waktu Pembuatan Cadangan Data
	</td>
	<td>
		<input type=radio class=masukan name=wcadangan value=H $cekh> Setiap Hari<br>
		<input type=radio class=masukan name=wcadangan value=M $cekm> Setiap Minggu pada Hari
		<select name=hari class=masukan>";
			foreach ($arrayhari as $k=>$v) {
				if ($k==$idhari) {
					$select="selected";
				}
				echo "<option value=$k $select>$v</option>";
				$select="";
			}
echo "
		</select>
	</td>
</tr>
<tr valign=top>
	<td >
		Direktori Cadangan Data
	</td>
	<td>
		<input type=text class=masukan name=dircadangan value='$dircadangan'> \
	</td>
</tr>
<tr valign=top>
	<td colspan=2  class=isianjudul>
	 
		<input class=tombol type=submit name=aksi value='Simpan'>
		<input class=tombol  type=reset>
		<br><br>
	</td>
</tr>
</table>
</form>

";






?>