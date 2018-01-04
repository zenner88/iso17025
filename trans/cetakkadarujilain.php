<?
		 $q="SELECT 
		  DUPLO
		 FROM permintaan 
		WHERE IDTRANS='$idupdate' AND JENISANALISIS='$jenisanalisis'
 		ORDER BY ID";
		$h=doquery($q,$koneksi);
		$duplo=0;
    while ($d=sqlfetcharray($h)) {
      if ($d[DUPLO]==1) {
        $duplo=1;
      }
    }
    if ($duplo==1) {
      $rowspan="rowspan=2";
    }
 
		 $q="SELECT 
		ID,DATA,IDAN,IDSUP,SAMPEL,DATADUPLO,HASIL,HASIL2,RUMUS
		 FROM permintaan 
		WHERE IDTRANS='$idupdate' AND JENISANALISIS='$jenisanalisis'
 		ORDER BY ID";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
				$q="SELECT * FROM jenisuji WHERE ID='$jenisanalisis' ";
					$h2=doquery($q,$koneksi);
					$d2=sqlfetcharray($h2);
					$hasilakhir=$d2[HASIL];


				$q="SELECT * FROM varjenisuji WHERE IDJENISUJI='$jenisanalisis' ORDER BY VAR";
					$h2=doquery($q,$koneksi);
					$i=0;
					while ($d2=sqlfetcharray($h2)) {
						$arrayvar[]=$d2;
					}

  			$tmpcetak.= "
				<table  $bordercetak    >
					<tr   align=center valign=middle>
 						<td nowrap $rowspan><b>No</td>
 						<td nowrap $rowspan><b>Kode<br>Contoh</td> ";
 						
 						if ($duplo==1) {
 						   $colspan=count($arrayvar)+1;
        			$tmpcetak.= "
     						<td nowrap colspan='$colspan'><b>Data 1</td>
     						<td nowrap colspan='$colspan'><b>Data 2</td>
        			 
                </tr>
                <tr align=center valign=middle>
              ";
             }
 						
 						
 						foreach ($arrayvar as $kv=>$dv) {
 								$tmpcetak.="
 								<td   ><b>$dv[NAMA] <br>( $dv[VAR] )</td>
 								";
 						}
 						$tmpcetak.= "
						<td nowrap ><b>$hasilakhir </td>";
 						
 						if ($duplo==1) {
     						foreach ($arrayvar as $kv=>$dv) {
     								$tmpcetak.="
     								<td   ><b>$dv[NAMA] <br>( $dv[VAR] )</td>
     								";
     						}
   						$tmpcetak.= "
  						<td nowrap ><b>$hasilakhir </td>";
             
             }
            echo "
 					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				$rumusanalisis=$data[RUMUS];
				$rumus=tekstorumus($data[DATA]);
				$rumusduplo=tekstorumus($data[DATADUPLO]);
				  //$hasil=hasilanalis($rumus,$jenisanalisis);
				  //$hasilduplo=hasilanalis($rumusduplo,$jenisanalisis);
				  $hasil=$data[HASIL];
				  $hasilduplo=$data[HASIL2];
				  $idan=$data[IDAN];
				  $idsup=$data[IDSUP];
				  $sampelcontoh.="$data[SAMPEL]<br>";
				$tmpcetak.= "
					<tr valign=top $kelas$cetak>
 						<td nowrap align=center >$i</td>
 						<td nowrap align=center >$data[ID]</td>";
 						foreach ($arrayvar as $kv=>$dv) {
 								$tmpcetak.="
 								<td align=center  >".$rumus["$dv[VAR]"]."</td>
 								";
 						}
 						$tmpcetak.="
 						<td   align=center><b>".cetakhasil($hasil)."</td>";
 						if ($duplo==1) {
   						foreach ($arrayvar as $kv=>$dv) {
   								$tmpcetak.="
   								<td align=center  >".$rumusduplo["$dv[VAR]"]."</td>
   								";
   						}
   						$tmpcetak.="
   						<td   align=center><b>".cetakhasil($hasilduplo)."</td>";
             
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
						<td width=150>Perhitungan : </td>
						<td style='font-size:20pt'><b>".$rumusanalisis."
			 
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
		$tmpcetak=str_replace("<--JUDUL-->",$arrayanalisis[$jenisanalisis],$tmpcetak);


?>
