<?
		 $q="SELECT 
		ID,ID2,DATA,IDAN,IDSUP,DATA2
		 FROM permintaan 
		WHERE IDTRANS='$idupdate' AND (TRIM(permintaan.DATA2)!='||'
		 AND TRIM(permintaan.DATA2)!='') 
		AND JENISANALISIS='$jenisanalisis'
 		ORDER BY ID  LIMIT 0,1";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
 			$data=sqlfetcharray($h);

					if (trim($data[DATA2])=="" || trim($data[DATA2])=="||") {
						$q="SELECT permintaan.DATA2 FROM permintaan,minta WHERE 
							minta.ID=permintaan.IDTRANS
							AND
							IDTRANS='$idupdate' AND  IDAN='$users' AND JENISANALISIS='$data[JENISANALISIS]'
							AND TRIM(permintaan.DATA2)!='||' AND TRIM(permintaan.DATA2)!='' 
							LIMIT 0,1
							";
							 $h2=doquery($q,$koneksi) ;
							
							if (sqlnumrows($h2)>0) {
								$d2=sqlfetcharray($h2);
								$data[DATA2]=$d2[DATA2];
							}
					}
				
					$tmp=explode("||",$data[DATA2]);
					$datax=tekstorumus($tmp[0]);
					$datay=tekstorumus($tmp[1]);
					$hr=reglinear($datax,$datay);
				 				
				$rumus[b]=@(($rumus[s]-$hr[b])/$hr[a]);
				$rumus=tekstorumus($data[DATA]);
				$hasil=hasilanalis($rumus,$jenisanalisis);
			
				
				$kelas=kelas($i);
 				  $idan=$data[IDAN];
				  $idsup=$data[IDSUP];
				  $sampelcontoh.="$data[SAMPEL]<br>";
 
 			$tmpcetak.= "
				<table  style='width:600px' $bordercetakA4P    >
					<tr   align=center valign=middle>
 						<td nowrap colspan=5><b>Pengukuran Standar</td>
  					</tr>
					<tr   align=center valign=middle>
 						<td nowrap ><b>Std. Logam</td>
 						<td nowrap colspan=2><b>Serapan</td>
 						<td nowrap colspan=2 rowspan=2>$hr[eq]</td>
  					</tr>
					<tr   align=center valign=middle>
 						<td nowrap ><b>(mg/L)</td>
 						<td nowrap ><b></td>
 						<td nowrap ><b>Regresi</td>
  					</tr>
					<tr   valign=middle>
 						<td nowrap width=70 align=center><b>$datax[0]</td>
 						<td nowrap width=70 align=center><b>$datay[0]</td>
 						<td nowrap ><b></td>
 						<td nowrap ><b>Intercept</td>
 						<td nowrap ><b>".number_format($hr[a],4)."</td>
  					</tr>
					<tr   valign=middle>
 						<td nowrap  align=center><b>$datax[1]</td>
 						<td nowrap  align=center><b>$datay[1]</td>
 						<td nowrap ><b></td>
 						<td nowrap ><b>Slope</td>
 						<td nowrap ><b>".number_format($hr[b],4)."</td>
  					</tr>
					<tr   valign=middle>
 						<td nowrap  align=center><b>$datax[2]</td>
 						<td nowrap  align=center><b>$datay[2]</td>
 						<td nowrap ><b></td>
 						<td nowrap ><b>Correlasi</td>
 						<td nowrap ><b>".number_format($hr[r],4)."</td>
  					</tr>
  					
  					";
  					
  					for ($ii=3;$ii<sizeof($datax);$ii++) {
  						$tmpcetak.= "
					<tr   valign=middle>
 						<td nowrap  align=center><b>".$datax[$ii]."</td>
 						<td nowrap  align=center><b>".$datay[$ii]."</td>
  					</tr>
  						";
  					}
			
  			
						
			$tmpcetak.= "
				</table>
				<br>
				<table $styletab>
					<tr>
						<td>Perhitungan : </td>
						<td>
			<img src='rumus/rumus10.png' border=1 >
						</td>
					</tr>
				</table>
				<br>
				<table $styletab>
					<tr>
						<td>Catatan : </td>
						<td>
						<br><br><br><br>
 						</td>
					</tr>
				</table>
				
			";
			
		} 
 $tmpcetak.= "				<br><br>
				<table $styletab>
					<tr align=center>
						<td width=33%>Manajer Teknis</td>
						<td width=33%>Penyelia</td>
						<td width=33%>Pelaksana</td>
					</tr>
					<tr align=center>
						<td width=33%><br><br><br><br></td>
						<td width=33%></td>
						<td width=33%></td>
					</tr>
					<tr align=center>
						<td width=33%>( ".$arraymanagerteknis[$idman]." )</td>
						<td width=33%>( ".$arraysupervisor[$idsup]." )</td>
						<td width=33%>( ".$arrayanalis[$idan]." )</td>
					</tr>
				</table>
				

";

///////////////////////////////////////////////
		 $q="SELECT 
		ID,DATA,DATA2,IDAN,IDSUP,SAMPEL
		 FROM permintaan 
		WHERE IDTRANS='$idupdate' AND JENISANALISIS='$jenisanalisis'
 		ORDER BY ID";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
  			$tmpcetak.= "
  				<p style='page-break-before:always'>
  				<table style='width:600px;font-size:10pt;'><tr><td align=center><b>Pengukuran Contoh</td></tr></table>
  				<br>
				<table style='width:600px' $bordercetakA4P    >
					<tr   align=center valign=middle>
 						<td nowrap ><b>No</td>
 						<td nowrap ><b>Kode<br>Contoh</td>
 						<td nowrap ><b> Serapan</td>
						<td nowrap ><b> Pelarutan <br>
 						(L)</td>
						<td nowrap ><b> Pengenceran<br> (kali) <br>
 						</td>
						<td nowrap ><b>
						Kons.  <br>
 						(mg/L)</td>
						<td nowrap ><b>
						Berat <br> Contoh<br>(mg)</td>
						<td nowrap ><b>Kadar <br>(ppm)</td>
 					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {

				if (!isset($hr)) {
					if (trim($data[DATA2])=="" || trim($data[DATA2])=="||") {
						$q="SELECT permintaan.DATA2 FROM permintaan,minta WHERE 
							minta.ID=permintaan.IDTRANS
							AND
							IDTRANS='$idupdate' AND  IDAN='$users' AND JENISANALISIS='$data[JENISANALISIS]'
							AND TRIM(permintaan.DATA2)!='||' AND TRIM(permintaan.DATA2)!='' 
							LIMIT 0,1
							";
							 $h2=doquery($q,$koneksi) ;
							
							if (sqlnumrows($h2)>0) {
								$d2=sqlfetcharray($h2);
								$data[DATA2]=$d2[DATA2];
							}
					}
				
					$tmp=explode("||",$data[DATA2]);
					$datax=tekstorumus($tmp[0]);
					$datay=tekstorumus($tmp[1]);
					$hr=reglinear($datax,$datay);
				}				
				$rumus[b]=@(($rumus[s]-$hr[b])/$hr[a]);
				$rumus=tekstorumus($data[DATA]);
				$hasil=hasilanalis($rumus,$jenisanalisis);
			
				
				$kelas=kelas($i);
 				  $idan=$data[IDAN];
				  $idsup=$data[IDSUP];
				  $sampelcontoh.="$data[SAMPEL]<br>";
				$tmpcetak.= "
					<tr valign=top $kelas$cetak>
 						<td nowrap align=center >$i</td>
 						<td nowrap align=center >$data[ID]</td>
 						<td   align=center>$rumus[s]</td>
						<td   align=center>$rumus[v]</td>
						<td   align=center>$rumus[c]</td>
						<td   align=center>".number_format($rumus[b],4)."</td>
						<td   align=center>$rumus[bc]</td>
 						<td   align=center>".number_format($hasil,4)."</td>
  					</tr>";
				$i++;
			}
			
 						
			$tmpcetak.= "
				</table>
				<br>
				<table $styletab>
					<tr>
						<td>Kurva Kalibrasi : </td>
						<td>
			<image src='gambardiagram/$idupdate$jenisanalisis.png' >
						</td>
					</tr>
				</table>
				<br>
				<table $styletab>
					<tr>
						<td>Catatan : </td>
						<td>
						<br><br><br><br>
 						</td>
					</tr>
				</table>
				
			";
			
		} else {
			$errmesg="Data Permintaan Analisis tidak ada.";
			printmesg($errmesg);
			$aksi="";
		}
 		$arrayjudullaporan[10]="Penentuan Logam Cd Dalam Air Menggunakan<br>Spektrofotometer Serapan Atom";
		$arrayjudullaporan[11]="Penentuan Logam Pb Dalam Air Menggunakan<br>Spektrofotometer Serapan Atom";
		$arrayjudullaporan[12]="Penentuan Logam Cr Dalam Air Menggunakan<br>Spektrofotometer Serapan Atom";
		$arrayjudullaporan[13]="Penentuan Logam Zn Dalam Air Menggunakan<br>Spektrofotometer Serapan Atom";
		$arrayjudullaporan[14]="Penentuan Logam Cu Dalam Air Menggunakan<br>Spektrofotometer Serapan Atom";
		$arrayjudullaporan[15]="Penentuan Logam Fe Dalam Air Menggunakan<br>Spektrofotometer Serapan Atom";
		$arrayjudullaporan[16]="Penentuan Logam Hg Dalam Air Menggunakan<br>Spektrofotometer Serapan Atom";
		$arrayjudullaporan[17]="Penentuan Logam Cd Dalam Air Menggunakan<br>Cara Ekstraksi";
		$arrayjudullaporan[18]="Penentuan Logam Pb Dalam Air Menggunakan<br>Cara Ekstraksi";
		$arrayjudullaporan[19]="Penentuan Logam Cr Dalam Air Menggunakan<br>Cara Ekstraksi";
		$arrayjudullaporan[20]="Penentuan Logam Zn Dalam Air Menggunakan<br>Cara Ekstraksi";
		$arrayjudullaporan[21]="Penentuan Logam Fe Dalam Air Menggunakan<br>Cara Ekstraksi";
		$arrayjudullaporan[22]="Penentuan Logam Cu Dalam Air Menggunakan<br>Cara Ekstraksi";
		$arrayjudullaporan[23]="Penentuan Logam Mn+ Dalam Air Menggunakan<br>Cara Ekstraksi";
 		$tmpcetak=str_replace("<--CONTOH-->",$sampelcontoh,$tmpcetak);
		$tmpcetak=str_replace("<--JUDUL-->",strtoupper($arrayjudullaporan[$jenisanalisis]),$tmpcetak);


?>