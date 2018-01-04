<?

if ($aksi=="Tampilkan") {

	if ($pilihan=="cari" && trim($nama)=="") {
		printmesg("Kata Kunci harus diisi terlebih dahulu");
	} else {
	
		////////// Tampilkan Data ///////////////

		if ($jenis!="semua") {
			$qjenis=" AND IDJENIS='$jenis' ";
			$jjenis=" Jenis = ".$arrayjenisbahan[$jenis].". ";
		}
		////////// Tampilkan Data ///////////////

		if (trim($idbahan)!="") {
			$qbahan=" AND ID = '$idbahan' ";
			$jbahan=" ID Bahan = $idbahan. ";
		}
		if (trim($nama)!="") {
			$jkunci = "Kata kunci = '$nama', Kategori = ".ucfirst(strtolower($kategori)).".  ";
		}
		if ($ha!="") {
			$qha=" AND NAMA LIKE '$ha%' ";
		}
		if ($sort=="") {
			$sort="NAMA";
		}

		if ($hal=="") {
			$hal=1;
		}
		
		$firstrow=($hal-1)*$maxrow;

	 $q="SELECT COUNT(ID) AS T
		FROM bahankimia 
		WHERE 
		$kategori LIKE '%$nama%' 
		$qha
		$qjenis
		$qmerek
		$qbahan
		ORDER BY $sort";
		$h=doquery($q,$koneksi);
		$d=sqlfetcharray($h);
		$total=$d[T];


	 $q="SELECT ID,IDJENIS,IDMEREK,KEMASAN,CATATAN,JUMLAH,JUMLAHMIN,FILEG,
		NAMA,NAMAK,RUMUS,KATALOG,KEMASAN
		FROM bahankimia 
		WHERE 
		$kategori LIKE '%$nama%' 
		$qha
		$qjenis
		$qmerek
		$qbahan
		ORDER BY $sort LIMIT $firstrow,$maxrow";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			
			$href="index.php?pilihan=br&aksi=Tampilkan&nama=$nama&kategori=$kategori&
			pemakai=$pemakai&lab=$lab&jenis=$jenis&merek=$merek&idbahan=$idbahan&ha=$ha&hal=$hal";

			if ($total > $maxrow) { 
				if ($hal>1) {
					$prev="<a href='$href&hal=".($hal-1)."'><< Sebelumnya</a>";
				}
				$maxhal=ceil($total/$maxrow);
				settype($maxhal,"integer");
				if ($hal< $maxhal) {
					$next="<a href='$href&hal=".($hal+1)."'>Berikutnya >></a>";
				}
				if ($total > $maxrow ) {
					$pagemid=" 
					Halaman $hal dari $maxhal
					<br><br>
";
					for ($i=1;$i<=$maxhal;$i++) {
						if ($i!=$hal) {
							$pagemid.=" <a href='$href&hal=$i'>$i</a> ";
						} else {
							$pagemid.=" <b>$i</b> ";
						}
					}
				}
				$page = "
					<table width=80%>
						<tr valign=bottom>
							<td width=20%>	
								$prev
							</td>
							<td width=* align=center>	
								$pagemid
							</td>
							<td width=20% align=right>$next</td>
						</tr>
					</table>
				";
			}


			echo "<center><h3>Rekapitulasi Persediaan Bahan</h3>
		
			$jkunci $jbahan $jjenis $jmerek $jpemakai $jlab

			<BR><BR>
			
			$page			";


/*
			echo "
				<table $borderdata class=data> 
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap ><a href='$href&sort=FILEG'>Gambar</td>
						<td nowrap ><a href='$href&sort=IDJENIS'>Jenis</td>
						<td nowrap ><a href='$href&sort=NAMA'>Nama<br>Dagang</td>
						<td nowrap ><a href='$href&sort=NAMA'>Nama<br>Kimia</td>
						<td nowrap ><a href='$href&sort=RUMUS'>Rumus</td>
						<td nowrap ><a href='$href&sort=KATALOG'>Katalog</td>
						<td nowrap ><a href='$href&sort=KEMASAN'>Kemasan</td>
						<td nowrap ><a href='$href&sort=IDMEREK'>Merek</td>
						<td nowrap ><a href='$href&sort=CATATAN'>Catatan</td>
						<td nowrap >Stok<br>Minimum</td>
						<td nowrap >Persediaan</td>
					</tr>";
*/			
			$i=1;
			while($data=sqlfetcharray($h)) {
				
				//$kelas=kelas($i);

				$sisa=jumlahstok($data[ID]);

				$kelas=kelasdatautama($i);
				echo "
				<table width=80% $borderdata class=data >
					<tr valign=top class=judulkolom>
						<td nowrap >No</td><td>$i</td>
						<td width=50% align=center><b>Gambar dan Catatan</b>
					</tr>
					<tr valign=top class=datagenap><td >Jenis Bahan</td><td>".$arrayjenisbahan[$data[IDJENIS]]."</td>";
						$img="";
						if (trim($data[FILEG])!="") {
							$di=@imgsizeprop("bahan/gambar/$data[FILEG]",150);
							if ($di[0]==0 || $di[1]==0) {
							} else {
								$img="<img border=0 width=$di[0] height=$di[1] src='bahan/gambar/$data[FILEG]'><br><br>";
							}
						}
				echo "
				
						<td rowspan=9 align=center $kelas>$img $data[CATATAN]</td>
					
					</tr>
					<tr valign=top  class=datagenap><td >Nama Dagang</td><td>$data[NAMA]</td></tr>
					<tr valign=top  class=dataganjil><td >Nama Kimia</td><td>$data[NAMAK]</td></tr>
					<tr valign=top  class=datagenap><td >Rumus</td><td>$data[RUMUS]</td></tr>
					<tr valign=top  class=datagenap><td >Katalog</td><td>$data[KATALOG]</td></tr>
					<tr valign=top  class=dataganjil><td >Merek</td><td>".$arraymerek[$data[IDMEREK]]."</td></tr>
					<tr valign=top  class=datagenap><td >Kemasan</td><td>$data[JUMLAH] $data[KEMASAN]</td></tr>
					<tr valign=top  class=dataganjil><td  >Stok Minimum</td><td>$data[JUMLAHMIN] x $data[JUMLAH] $data[KEMASAN]</td></tr>
					<tr valign=top  class=datagenap><td >Stok Saat Ini</td><td>$sisa x $data[JUMLAH] $data[KEMASAN]</td></tr>
					
				</table>
				<br>";
				$i++;


///////////////////////////////////////////////////////////////////////////////
			}
						
			echo "
				</table>
				
				
				<center>$page</center>
			";
			
		} else {
			$errmesg="
			<center><h3>Data Rekapitulasi Persediaan Bahan tidak ada</h3>
				$jkunci $jbahan $jjenis $jmerek $jpemakai $jlab
				</center>";
			printmesg($errmesg);
		}
	}
}

else {
echo "
<h3>Rekapitulasi Persediaan Bahan </h3>
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=30% nowrap>
				Kata Kunci 
			</td>
			<td>
				<input type=text name=nama size=20 value='$nama'>
				Kategori 
				<select name=kategori>	
					<option value=NAMA>Nama</option>
					<option value=RUMUS>Rumus</option>
					<option value=KATALOG>Katalog</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				ID Bahan
			</td>
			<td>
				<input type=text name=idbahan size=4 value='$idbahan'>
			<a 
			href=\"javascript:daftarbahan('form,wewenang,idbahan',
			document.form.idbahan.value)\">
			Daftar Bahan
			</a>
				
			</td>
		</tr>
		<tr>
			<td>
				Jenis
			</td>
			<td>
				<select name=jenis>";
					echo "<option value=semua>Semua</option>";
					foreach ($arrayjenisbahan as $k=>$v) {
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