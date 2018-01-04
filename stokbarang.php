<?

if ($aksi=="Tampilkan") {

	if ($pilihan=="cari" && trim($nama)=="") {
		printmesg("Kata Kunci harus diisi terlebih dahulu");
	} else {
	
		////////// Tampilkan Data ///////////////

		if ($jenis!="semua") {
			$qjenis=" AND IDJENIS='$jenis' ";
			$jjenis=" Jenis = ".$arrayjenis[$jenis].". ";
		}
		if ($merek!="semua") {
			$qmerek=" AND IDMEREK='$merek' ";
			$jmerek=" Merek = ".$arraymerek[$merek].". ";
		}
		if (trim($nama)!="") {
			$jkunci = "Kata kunci = '$nama', Kategori = ".ucfirst(strtolower($kategori)).".  ";
		}
		if ($ha!="") {
			$qha=" AND NAMA LIKE '$ha%' ";
		}
		if ($sort=="") {
			$sort="ID";
		}
		if ($statusstok == 0) { // Banyak
			$jstatusstok="Status Stok = Masih ada. ";
		} elseif($statusstok==1) { //Hampir habis
			$jstatusstok="Status Stok = Hampir habis. ";
		} elseif($statusstok == 2) { //Habis
			$jstatusstok="Status Stok = Habis. ";
		}



	$q="SELECT ID,IDJENIS,IDMEREK,NAMA,SATUANDUS,
		SATUAN,STOKMIN,FILEG
		FROM barang 
		WHERE 
		$kategori LIKE '%$nama%' 
		$qha
		$qjenis
		$qmerek
		ORDER BY $sort";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3>Laporan Stok Barang</h3>
			$jkunci $jjenis $jmerek $jstatusstok
			<BR><BR>
			";
			
			$href="index.php?pilihan=br&aksi=Tampilkan&nama=$nama&kategori=$kategori&jenis=$jenis&merek=$merek&ha=$ha&statusstok=$statusstok";
			echo "
					<table class=data  celpadding=2 cellspacing=1 width=95%>
					<tr class=judulkolom align=center valign=middle>
						<td   width=10>No</td>
						<td ><a href='$href&sort=FILEG'>Gambar</td>
						<td   ><a href='$href&sort=ID'>ID/Kode</td>
						<td   ><a href='$href&sort=IDJENIS'>Jenis</td>
						<td   ><a href='$href&sort=NAMA'>Nama</td>
						<td   >Merek</td>
						<td   >Satuan</td>
						<td   >Jumlah<br>per Dus</td>
						<td   >Stok<BR>Minimum</td>
						<td   >Stok<BR>Gudang</td>
						<td   >Stok<BR>Vendor</td>
						<td   >Stok<BR>Retur</td>
						<td   >Stok<BR>Total</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				
				$stok=jumlahstok($data[ID]);
				$stokv=jumlahstokvendor($data[ID]);
				$stokg=$stok-$stokv;
				$stokretur=jumlahstokretur($data[ID]);
			//	echo $statusstok;
				if ($statusstok == 0) { // Banyak
				//	echo $statusstok;					
					if ($stok <= $data[STOKMIN]) {
						continue;
					}
				} elseif($statusstok==1) { //Hampir habis
					if ($stok > $data[STOKMIN]) {
						continue;
					}
				} elseif($statusstok == 2) { //Habis
					if ($stok >0) {
						continue;
					}
				}
				$kelas=kelas($i);
				
						$css="";
						if ($data[STOKMIN]>=$stok) {
							$css="style='background=#ff8888'";
						}
				echo "
					<tr valign=top  $kelas>
						<td   align=center >$i</td>
						<td >";
						$img="";
						if (trim($data[FILEG])!="") {
							$di=@imgsizeprop("bahan/gambar/$data[FILEG]",60);
							if ($di[0]==0 || $di[1]==0) {
							} else {
								$img="<img border=0  width=$di[0] height=$di[1] src='bahan/gambar/$data[FILEG]'>";
							}
						}
						echo "
						$img</td>
						<td   >$data[ID]</td>
						<td   align=center >".$arrayjenis[$data[IDJENIS]]."</td>
						<td >$data[NAMA]</td>
						<td   align=center >".$arraymerek[$data[IDMEREK]]."</td>
						<td   >$data[SATUAN]</td>
						<td   align=right>$data[SATUANDUS]</td>
						<td  align=right>$data[STOKMIN]</td>
						<td  align=right>$stokg</td>
						<td  align=right>$stokv</td>
						<td  align=right>$stokretur</td>
						<td  align=right $css>".($stok+$stokretur)."</td>
					</tr>";
				$i++;
			}
						
			echo "
				</table></center>
			";
			
		} else {
			$errmesg="
			<center>Laporan Stok Barang tidak ada. <br>
				$jkunci $jjenis $jmerek $jstatusstok
				</center>";
			printmesg($errmesg);
		}
	}
}

else {
echo "
<h3>Laporan Stok Barang</h3>
<form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=20% nowrap>
				Kata Kunci 
			</td>
			<td>
				<input type=text name=nama size=20 value='$nama'>
				Kategori 
				<select name=kategori>	
					<option value=NAMA>Nama</option>
					<option value=CATATAN>Catatan</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Jenis
			</td>
			<td>
				<select name=jenis>";
					echo "<option value=semua>Semua</option>";
					foreach ($arrayjenis as $k=>$v) {
						if ($jenis==$k) {
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
			<td>
				Merek
			</td>
			<td>
				<select name=merek>";
					echo "<option value=semua>Semua</option>";
					foreach ($arraymerek as $k=>$v) {
						if ($merek==$k) {
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
			<td>
				Status Stok
			</td>
			<td>
				<select name=statusstok>";
					echo "<option value=-1>Semua</option>";
					echo "<option value=0>Masih Ada</option>";
					echo "<option value=1>Hampir Habis</option>";
					echo "<option value=2>Habis</option>";
			echo "
				</select>
			</td>
		</tr>

		<tr>
			<td colspan=2>
			<br>
				<input type=submit name=aksi value='Tampilkan'>
				<input type=reset value='Hapus Isian'>
			</td>
		</tr>
	</table>


</form>
";

}

?>