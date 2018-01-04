<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";

if ($aksi=="Cetak") {

		////////// Tampilkan Data ///////////////

		if ($jenis!="semua") {
			$qjenis=" AND IDJENIS='$jenis' ";
			$jjenis=" Jenis = ".$arrayjenisbahan[$jenis].". ";
		}
		if ($merek!="semua") {
			$qmerek=" AND IDMEREK='$merek' ";
			$jmerek=" Merek = ".$arraymerek[$merek].". ";
		}
		if (trim($nama)!="") {
			$jkunci = "Kata kunci = '$nama', Kategori = ".ucfirst(strtolower($kategori)).".  ";
		}
		if ($sort=="") {
			$sort="ID";
		}
		$q="SELECT * FROM barang 
		WHERE 
		$kategori LIKE '%$nama%' 
		$qjenis
		$qmerek
		ORDER BY $sort";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<h3>Rincian Data Barang</h3>
			$jkunci $jjenis $jmerek
			<br> ";
			
			echo "
				<table $bordercetakA4P>
					<tr align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap >ID/Kode</td>
						<td nowrap >Jenis</td>
						<td nowrap >Nama</td>
						<td nowrap  >Harga<br>Modal<br>(Rp)</td>
						<td nowrap >Harga<br>Jual<br>(Rp)</td>
						<td nowrap >Total<br>Nilai<br> Awal (Rp)</td>
						<td nowrap >Jenis<br>Harga<br>Modal</td>
						<td nowrap >Merek</td>
						<td nowrap >Satuan</td>
						<td nowrap >Jml<BR>Per<br>Dus</td>
						<td nowrap >Stok<BR>Min</td>
						<td nowrap >Stok<BR>Awal</td>
						<td nowrap >Ket</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				echo "
					<tr valign=top>
						<td nowrap align=center >$i</td>
						<td nowrap >$data[ID]</td>
						<td  align=center >".$arrayjenis[$data[IDJENIS]]."</td>
						<td >$data[NAMA]</td>
						<td align=right>".cetakuang($data[HARGAM])."</td>
						<td align=right>".cetakuang($data[HARGAJ])."</td>
						<td align=right>".cetakuang($data[NILAIAWAL])."</td>
						<td nowrap >$data[JENISHARGAJUAL]</td>
						<td nowrap align=center >".$arraymerek[$data[IDMEREK]]."</td>
						<td nowrap >$data[SATUAN]</td>
						<td nowrap align=right>$data[SATUANDUS]</td>
						<td  align=right>$data[STOKMIN]</td>
						<td  align=right>$data[STOKAWAL]</td>
						<td >$data[CATATAN]</td>
					</tr>";
				$i++;
			}
						
			echo "
				</table>
			";
			
		} else {
			$errmesg="
			<center>Data Barang Kimia tidak ada. <br>
				$jkunci $jjenis $jmerek
				</center>";
			printmesg($errmesg);
		}
}



?>