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
 						<td nowrap ><b>No</td>
 						<td nowrap ><b>Kode<br>Contoh</td>
 						<td nowrap ><b> Berat Cawan  <br> Kosong (A) <br>
 						(g)</td>
						<td nowrap ><b> Berat Cawan +<br> Contoh (B) <br>
 						(g)</td>
						<td nowrap ><b> Berat  Contoh<br> (B-A)<br> (g) <br>
 						</td>
						<td nowrap ><b>
						Berat Cawan + Contoh <br> Setelah 
 						Pemanasan (C)  <br>
 						(g)</td>
						<td nowrap ><b>
						Berat Abu (C-A)  <br>
 						(g)</td>
						<td nowrap ><b>Kadar<br>Abu<br>(%)</td>
 					</tr>";
			
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
						<td   align=center>".($rumus[C]-$rumus[A])."</td>
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
			<img src='rumus/rumus3.png' border=1 >
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
		$tmpcetak=str_replace("<--JUDUL-->","PENENTUAN KADAR ABU DALAM BAHAN MAKANAN",$tmpcetak);


?>