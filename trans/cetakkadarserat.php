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
 						<td nowrap ><b> Berat <br>Contoh (A) <br>
 						(g)</td>
						<td nowrap ><b> Berat Cawan <br> Kosong 110<sup>o</sup>C (B) <br>
 						(g)</td>
						<td nowrap ><b> Berat  Kertas<br>Saring (C)<br> (g) <br>
 						</td>
						<td nowrap ><b>
						Berat Asbes<br>(E)  <br>
 						(g)</td>
						<td nowrap ><b>
						Berat Cawan + <br>Kertas Saring + <br>Residu 110<sup>o</sup>C<br>(D)  <br>
 						(g)</td>
						<td nowrap ><b>
						Residu (F)  <br>
 						(g)</td>
						<td nowrap ><b>Kadar<br>Serat<br>(%)</td>
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
 						<td   align=center>$rumus[a]</td>
						<td   align=center>$rumus[b]</td>
						<td   align=center>$rumus[c]</td>
						<td   align=center>$rumus[e]</td>
						<td   align=center>$rumus[d]</td>
 						<td   align=center>".cetakhasil($hasil[0])."</td>
 						<td   align=center>".cetakhasil($hasil[1])."</td>
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
			<img src='rumus/rumus5.png' border=1 >
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
		$tmpcetak=str_replace("<--JUDUL-->","PENENTUAN KADAR SERAT KASAR",$tmpcetak);


?>