<?
		 $q="SELECT 
		ID,DATA,IDAN,IDSUP,SAMPEL
		 FROM permintaan 
		WHERE IDTRANS='$idupdate' AND JENISANALISIS='$jenisanalisis'
 		ORDER BY ID";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
  			$tmpcetak.= "
				<table  $bordercetak    >
					<tr   align=center valign=middle>
 						<td nowrap rowspan=2><b>No</td>
 						<td nowrap rowspan=2><b>Kode<br>Contoh</td>
 						<td nowrap  colspan=3><b>
 						Data Penimbangan Contoh Lemak (g)
 						</td>
						<td nowrap  rowspan=2><b>
						Berat <br>Labu <br>Kosong (C)<br>
 						(g)</td>
						<td nowrap  rowspan=2><b>
						Berat  Labu <br>Kosong +<br> Minyak (D)<br>
 						(g)</td>
						<td nowrap  rowspan=2><b>
						Berat <br>Minyak (D-C)  <br>
 						(g)</td>
						<td nowrap  rowspan=2><b>Kadar<br>Lemak<br>(%)</td>
 					</tr>
					<tr   align=center valign=middle>
  						<td nowrap ><b> Berat<br>Wadah (A) <br>
 						(g)</td>
						<td nowrap ><b> Berat Wadah +<br> Contoh (B) <br>
 						(g)</td>
						<td nowrap ><b> Berat  Contoh<br> (B-A)<br> (g) <br>
 						</td>
  					</tr>  ";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				$rumus=tekstorumus($data[DATA]);
				$hasil=hasilanalis($rumus,$jenisanalisis);
				  $idan=$data[IDAN];
				  $idsup=$data[IDSUP];
				  $sampelcontoh.="$data[SAMPEL]<br>";
				$tmpcetak.= "
					<tr valign=top $kelas$cetak>
 						<td nowrap align=center >$i</td>
 						<td nowrap align=center >$data[ID]</td>
 						<td   align=center>$rumus[A]</td>
						<td   align=center>$rumus[B]</td>
						<td   align=center>".($rumus[B]-$rumus[A])."</td>
						<td   align=center>$rumus[C]</td>
						<td   align=center>$rumus[D]</td>
						<td   align=center>".($rumus[D]-$rumus[C])."</td>
 						<td   align=center>".cetakhasil($hasil)."</td>
  					</tr>";
				$i++;
			}
						
			$tmpcetak.= "
				</table>
				<br>
				<table>
					<tr>
						<td>Perhitungan : </td>
						<td>
			<img src='rumus/rumus2.png' border=1 >
						</td>
					</tr>
				</table>
				
			";
			
		} else {
			$errmesg="Data Permintaan Analisis tidak ada.";
			printmesg($errmesg);
			$aksi="";
		}
		$tmpcetak=str_replace("<--CONTOH-->",$sampelcontoh,$tmpcetak);
		$tmpcetak=str_replace("<--JUDUL-->","PENENTUAN KADAR LEMAK DALAM BAHAN MAKANAN
		DENGAN CARA HIDROLISA DAN EKSTRAKSI SOXHLET",$tmpcetak);


?>