<?

		 $q="SELECT 
		DUPLO
		 FROM permintaan 
		WHERE IDTRANS='$idupdate' AND JENISANALISIS='$jenisanalisis'
 		ORDER BY ID";
		$h=doquery($q,$koneksi);
		$duplo=0;
 		if (sqlnumrows($h)>0) {
			while($data=sqlfetcharray($h)) {
			 if ($data[DUPLO]==1) {
         $duplo=1;
        }
			}
    }
    
    if ($duplo==1) {
      $rownspan="rowspan=2";
    }
 		 $q="SELECT 
		ID,DATA,IDAN,IDSUP,SAMPEL,DUPLO,DATADUPLO
		 FROM permintaan 
		WHERE IDTRANS='$idupdate' AND JENISANALISIS='$jenisanalisis'
 		ORDER BY ID";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
  			$tmpcetak.= "
				<table  $bordercetak    >
					<tr   align=center valign=middle>
 						<td nowrap $rownspan><b>No</td>
 						<td nowrap $rownspan><b>Kode<br>Contoh</td>";
 						
 						if ($duplo==1) {
        			$tmpcetak.= "
      						<td nowrap colspan=4><b>Data 1</td>
      						<td nowrap colspan=4><b>Data 2</td>
                 </tr>
                <tr align=center valign=middle>
              ";
             
             }
 						
             $tmpcetak.= "
 						<td nowrap ><b>Berat Wadah + <br>
 						Contoh (b) <br>
 						(g)
 						</td>
						<td nowrap ><b>
						Berat Wadah  <br>
 						Kosong (a) <br>
 						(g)</td>
						<td nowrap ><b>
						Berat  <br> Setelah <br>
 						Pemanasan (c) <br>
 						(g)</td>
						<td nowrap ><b>Kadar<br>Air<br>(%)</td>";
						
						if ($duplo==1) {
             $tmpcetak.= "
 						<td nowrap ><b>Berat Wadah + <br>
 						Contoh (b) <br>
 						(g)
 						</td>
						<td nowrap ><b>
						Berat Wadah  <br>
 						Kosong (a) <br>
 						(g)</td>
						<td nowrap ><b>
						Berat  <br> Setelah <br>
 						Pemanasan (c) <br>
 						(g)</td>
						<td nowrap ><b>Kadar<br>Air<br>(%)</td>";
            
            }
						
						
            $tmpcetak.= "
 					</tr>";
 					
 					
 					
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				$rumus=tekstorumus($data[DATA]);
				$hasil=hasilanalis($rumus,$jenisanalisis);
				$rumusduplo=tekstorumus($data[DATADUPLO]);
				$hasilduplo=hasilanalis($rumusduplo,$jenisanalisis);


				  $idan=$data[IDAN];
				  $idsup=$data[IDSUP];
				  $sampelcontoh.="$data[SAMPEL]<br>";
				$tmpcetak.= "
					<tr valign=top $kelas$cetak>
 						<td nowrap align=center >$i</td>
 						<td nowrap align=center >$data[ID]</td>
 						<td   align=center>$rumus[b]</td>
						<td   align=center>$rumus[a]</td>
						<td   align=center>$rumus[c]</td>
 						<td   align=center>".cetakhasil($hasil)."</td>";
 						
 						if ($duplo==1) {
              if ($data[DUPLO]==1) {
      				$tmpcetak.= "
        						<td   align=center>$rumusduplo[b]</td>
      						<td   align=center>$rumusduplo[a]</td>
      						<td   align=center>$rumusduplo[c]</td>
       						<td   align=center>".cetakhasil($hasilduplo)."</td>";
              } else {
      				$tmpcetak.= "
        						<td   align=center>-</td>
      						<td   align=center>-</td>
      						<td   align=center>-</td>
       						<td   align=center>-</td>";
              }
             
             }
 						
             echo "
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
			<img src='rumus/rumus0.png' border=1 >
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
		$tmpcetak=str_replace("<--JUDUL-->","PENENTUAN KADAR AIR DALAM BAHAN MAKANAN",$tmpcetak);


?>
