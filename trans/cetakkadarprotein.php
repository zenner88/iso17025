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
 						<td nowrap ><b>Berat <br>Contoh<br>
 						(mg)
 						</td>
						<td nowrap ><b>
						Vol. Pelarutan <br>Hasil<br>Destilasi <br> (mL)</td>
						<td nowrap ><b>
						Vol. Larutan <br>yg Dipipet <br>untuk <br>Keperluan <br>Destilasi <br> (mL) </td>
						<td nowrap ><b>
						Larutan <br>Penitrasi HCl<br>(mL)</td>
						<td nowrap ><b>
						Normalitas Larutan <br>Penitrasi (N)</td>
						<td nowrap ><b>
						Faktor<br>Konversi</td>
						<td nowrap ><b>
						Kadar <br>Protein<br>(%)</td>
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
 						<td   align=center>$rumus[bc]</td>
						<td   align=center>$rumus[vold]</td>
						<td   align=center>$rumus[volp]</td>
						<td   align=center>$rumus[hcl]</td>
						<td   align=center>$rumus[nhcl]</td>
						<td   align=center>$rumus[F]</td>
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
			<img src='rumus/rumus1.png' border=1  >
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
		$tmpcetak=str_replace("<--JUDUL-->","PENENTUAN N-TOTAL/PROTEIN (CARA KJELDAHL) DALAM BAHAN MAKANAN",$tmpcetak);


?>