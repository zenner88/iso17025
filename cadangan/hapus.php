<?
if ($aksi=="Hapus")  {
	if ($kategori!="semua") {
		$where2="
			AND JENIS='$kategori'
		";
		$jkategori="Kategori ".$arrayjenisartikel[$kategori]."";
	}
		$h=doquery("SELECT ID,GAMBAR FROM pegawai 
		WHERE MONTH(TANGGAL)='$bulan'
		AND YEAR(TANGGAL)='$tahun'
		$where2",$koneksi);
		if (sqlnumrows($h)>0) {
			while($d=sqlfetcharray($h)) {
				$h2=doquery("DELETE FROM pegawai WHERE ID='$d[ID]'",$koneksi);
				if (sqlaffectedrows($koneksi)>0) {
					@unlink("gambar/$d[GAMBAR]");
				}
			}
			$mesg="SDM bulan ".$arraybulan[($bulan-1)]." 
			$tahun  $jkategori berhasil dihapus";
		}
}

echo "
<table border=0 width=630>
<tr  class=judulsm>
<td align=center><b>
Hapus SDM
</td>
</tr>
</table>
";

printmesg($mesg);
echo "
	<form action=index.php  method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	
	<table>
		<tr>
			<td>
				Kategori
			</td>
			<td>
				<select name=kategori>";
				
				echo "<option value=semua>Semua</option>";
				foreach($arrayjenisartikel as $k=>$v) {
					echo "<option value='$k'>$v</option>";
				}
				
		echo "		</select>
			</td>
		</tr>
		<tr>
			<td>
				Bulan dan Tahun SDM
			</td>
			<td>
			
			<select name=bulan>";
			for ($i=1;$i<=12;$i++) {
				$cek="";
				if ($i==$waktu[mon]) {
					$cek="selected";
				}
				echo "<option value=$i $cek>".$arraybulan[($i-1)]."</option>";
			}
		echo "
			</select>
			
			<select name=tahun>";
			for ($i=$tahuninstal;$i<=$waktu[year];$i++) {
				echo "<option value=$i>$i</option>";
			}
		echo "
			</select>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				<input type=submit name=aksi value=Hapus>
			</td>
		</tr>
	</table>
	
	</form>
	";

	
	echo "

<table border=0 width=630>
<tr  class=judulsm>
<td><b>
&nbsp;
</td>
</tr>
</table>

";
?>