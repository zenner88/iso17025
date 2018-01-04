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
 						<td nowrap ><b> Berat<br>Contoh = c<br>(mg)</td>
						<td nowrap ><b> Vol. Pelarutan<br>Contoh<br>(mL)</td>
						<td nowrap ><b> Vol. yg <br>direaksikan<br>dgn Luff = b<br>(mL)<br>
 						</td>
						<td nowrap ><b>Vol<br>Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub><br>untuk blanko<br>(mL)</td>
						<td nowrap ><b>Vol<br> Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub><br> untuk sampel<br> (mL)</td>
						<td nowrap ><b>Selisih. Vol <br>Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> <br>untuk sampel = h <br>(Bl-Sp) (mL)</td>
						<td nowrap ><b>Faktor Normalitas<br> Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> <br>
						(N Thio yang dipakai/<br>N Thio 0.1 N)<br> = f</td>
						<td nowrap ><b>mL Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub><br> 0.1 N <br>= f x h</td>
						<td nowrap ><b>Jumlah <br>mg tepung<br>yang didapat <br>dari tabel = a</td>
						<td nowrap ><b>Kadar<br>KH<br>(%)</td>
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
 						<td   align=center>$rumus[c]</td>
						<td   align=center>$rumus[pl]</td>
						<td   align=center>$rumus[b]</td>
						<td   align=center>$rumus[bl]</td>
						<td   align=center>$rumus[sp]</td>
						<td   align=center>".($rumus[bl]-$rumus[sp])."</td>
						<td   align=center>".($rumus[f])."</td>
						<td   align=center>".($rumus[f]*($rumus[bl]-$rumus[sp]))."</td>
						<td   align=center>$rumus[a]</td>
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
			<img src='rumus/rumus6.png' border=1 >
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
		$tmpcetak=str_replace("<--JUDUL-->","PENENTUAN KADAR KARBOHIDRAT MENGGUNAKAN CARA LUFF SCHOORL",$tmpcetak);


?>