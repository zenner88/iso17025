<?
	if ($jenisanalisis==0) {
 	 		$analisis .= "
						<tr>
							<td width=100>
								Rumus
							</td>
							<td align=center valign=middle>
								<img src='rumus/rumus0.png' border=1>
							</td>
						</tr>
 	 	<tr>
 	 	  <td>Data 1 (Single)</td>
 	 	  <td>
 
					
					<table width=100%>
 						<tr>
							<td >a</td>
							<td><input type=text name=rumus[a] value='$rumus[a]' size=6> g ( Berat wadah kosong )</td>
						</tr>
						<tr>
							<td >b</td>
							<td><input type=text name=rumus[b] value='$rumus[b]' size=6> g ( Berat wadah + contoh )</td>
						</tr>
						<tr>
							<td >c</td>
							<td><input type=text name=rumus[c] value='$rumus[c]' size=6> g ( Berat setelah pemanasan )</td>
						</tr>
						<tr>
							<td ><b>% Kadar Air</td>
							<td><b>$hasil</td>
						</tr>
					</table>
					

     </td>
     </tr>
      ";
      
     if ($duplo==1) {
     
 	 		$analisis .= "
 	 	<tr>
 	 	  <td>Data 2 (Duplo)</td>
 	 	  <td>
 
					
					<table width=100%>
						<tr>
							<td >a</td>
							<td><input type=text name=rumusduplo[a] value='$rumusduplo[a]' size=6> g ( Berat wadah kosong )</td>
						</tr>
						<tr>
							<td >b</td>
							<td><input type=text name=rumusduplo[b] value='$rumusduplo[b]' size=6> g ( Berat wadah + contoh )</td>
						</tr>
						<tr>
							<td >c</td>
							<td><input type=text name=rumusduplo[c] value='$rumusduplo[c]' size=6> g ( Berat setelah pemanasan )</td>
						</tr>
						<tr>
							<td ><b>% Kadar Air</td>
							<td><b>$hasilduplo</td>
						</tr>
					</table>
					

     </td>
     </tr>
      ";

     
     } 

				if ($nilaibaku=="") {
          $nilaibaku=getnilaibaku($jenisanalisis);
        }
      $analisis.="
				<tr>
					<td><b> Nilai Baku/Standar</td>
					<td style='font-size:16pt;'>
					$nilaibaku
          
          </td>
				</tr>
      ";			
/*          <input style='font-size:16pt;' name='nilaibaku' type=text size=10 value='$nilaibaku'>  %
*/

      
	} else
	if ($jenisanalisis==1) {
		//foreach ($rumus as $k=>$v) {
		//	$analisis .= "$k=>$v;";
		//}
			if ($rumus[vold]=="") {
				$rumus[vold]=50;
			}
			if ($rumus[volp]=="") {
				$rumus[volp]=5;
			}
 	 		$analisis .= "
	 		<tr>
				<td>
					Analisis Kadar Protein
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td width=150>
								Rumus
							</td>
							<td>

								<img src='rumus/rumus1.png' border=1 >

							</td>
						</tr>
						<tr>
							<td >Vol. Pelarutan Hasil Destilasi</td>
							<td><input type=text name=rumus[vold] value='$rumus[vold]' size=6> mL </td>
						</tr>
						<tr>
							<td >Vol. Larutan yg Dipipet</td>
							<td><input type=text name=rumus[volp] value='$rumus[volp]' size=6> mL</td>
						</tr>
						<tr>
							<td >HCl</td>
							<td><input type=text name=rumus[hcl] value='$rumus[hcl]' size=6> mL</td>
						</tr>
						<tr>
							<td >N HCl</td>
							<td><input type=text name=rumus[nhcl] value='$rumus[nhcl]' size=6></td>
						</tr>
						<tr>
							<td >Berat contoh</td>
							<td><input type=text name=rumus[bc] value='$rumus[bc]' size=6> mg</td>
						</tr>
						<tr>
							<td >Faktor Konversi</td>
							<td><input type=text name=rumus[F] value='$rumus[F]' size=6></td>
						</tr>
						<tr>
							<td >% N</td>
							<td>$hasil[0]</td>
						</tr>
						<tr>
							<td ><b>% Protein</td>
							<td><b>$hasil[1]</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}	else
	if ($jenisanalisis==2) {
		//foreach ($rumus as $k=>$v) {
		//	$analisis .= "$k=>$v;";
		//}
 	 		$analisis .= "
	 		<tr>
				<td>
					Analisis Kadar Lemak<br>Cara Soxhlet
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								<img src='rumus/rumus2.png' border=1>
							</td>
						</tr>
						<tr>
							<td >Berat Wadah (A)</td>
							<td><input type=text name=rumus[A] value='$rumus[A]' size=6> g</td>
						</tr>
						<tr>
							<td >Berat Wadah + Contoh (B)</td>
							<td><input type=text name=rumus[B] value='$rumus[B]' size=6> g</td>
						</tr>
						<tr>
							<td >Berat Labu Kosong (C)</td>
							<td><input type=text name=rumus[C] value='$rumus[C]' size=6> g</td>
						</tr>
						<tr>
							<td nowrap >Berat Labu Kosong + Minyak/Lemak (D)</td>
							<td><input type=text name=rumus[D] value='$rumus[D]' size=6> g</td>
						</tr>
						<tr>
							<td ><b>% Lemak</td>
							<td><b>$hasil
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}	
	else if ($jenisanalisis==3) {
  	 		$analisis .= "
	 		<tr>
				<td>
					Analisis Kadar Abu
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								<img src='rumus/rumus3.png' border=1>
							</td>
						</tr>
						<tr>
							<td >Berat Cawan Kosong (A)</td>
							<td><input type=text name=rumus[A] value='$rumus[A]' size=6> g</td>
						</tr>
						<tr>
							<td >Berat Cawan + Contoh (B)</td>
							<td><input type=text name=rumus[B] value='$rumus[B]' size=6> g</td>
						</tr>
						<tr>
							<td >Berat Cawan + Contoh setelah Pemanasan (C)</td>
							<td><input type=text name=rumus[C] value='$rumus[C]' size=6> g</td>
						</tr>
						<tr>
							<td ><b>% Abu</td>
							<td><b>$hasil
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}	
	else if ($jenisanalisis==4) {
  	 		$analisis .= "
	 		<tr>
				<td>
					Analisis Mineral dgn AAS
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								<img src='rumus/rumus4.png' border=1>

							</td>
						</tr>
						<tr>
							<td >a</td>
							<td><input type=text name=rumus[a] value='$rumus[a]' size=6> 
							( Berat contoh ) </td>
						</tr>
						<tr>
							<td >b</td>
							<td><input type=text name=rumus[b] value='$rumus[b]' size=6>
							( Konstanta contoh yang didapat dari kurva kalibrasi )</td>
						</tr>
						<tr>
							<td >c</td>
							<td><input type=text name=rumus[c] value='$rumus[c]' size=6>
							( Faktor pengenceran contoh ) </td>
						</tr>
						<tr>
							<td >% Logam</td>
							<td>$hasil
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}		

	else if ($jenisanalisis==5) {
  	 		$analisis .= "
	 		<tr>
				<td>
					Penentuan Serat Kasar
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								<img src='rumus/rumus5.png' border=1>
							</td>
						</tr>
						<tr>
							<td >A</td>
							<td><input type=text name=rumus[a] value='$rumus[a]' size=6> g
							( Berat Contoh )
							 </td>
						</tr>
						<tr>
							<td >B</td>
							<td><input type=text name=rumus[b] value='$rumus[b]' size=6> g 
							( Berat Cawan Kosong 110<sup>o</sup> C )
							 </td>
						</tr>
						<tr>
							<td >C</td>
							<td><input type=text name=rumus[c] value='$rumus[c]' size=6> g
							( Berat Kertas Saring )
							 </td>
						</tr>
						<tr>
							<td >D</td>
							<td><input type=text name=rumus[d] value='$rumus[d]' size=6> g
							 ( Berat Cawan + Kertas Saring + Residu 110<sup>o</sup> C ) 
							 </td>
						</tr>
						<tr>
							<td >E</td>
							<td><input type=text name=rumus[e] value='$rumus[e]' size=6> g
							( Berat Asbes )
							 </td>
						</tr>
						<tr>
							<td >F</td> 
							<td>$hasil[0] g
							( Berat Residu )
							 </td>
						</tr>
						<tr>
							<td >% Serat</td>
							<td>$hasil[1]
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}		else if ($jenisanalisis==6) {
  	 		$analisis .= "
	 		<tr>
				<td>
					Penentuan Kadar KH cara Luff Schoorl
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								<img src='rumus/rumus6.png' border=1>
							</td>
						</tr>
						<tr>
							<td >Pl</td>
							<td>";
							if ($rumus[pl]=="") {
								$rumus[pl]=250;
							}
							$analisis .= "<input type=text name=rumus[pl] value='$rumus[pl]' size=6> mL
							 ( Vol Pelarutan Contoh)
							 </td>
						</tr>
						<tr>
							<td >Bl</td>
							<td><input type=text name=rumus[bl] value='$rumus[bl]' size=6> mL
							 ( Vol Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ blanko )
							 </td>
						</tr>
						<tr>
							<td >Sp</td>
							<td><input type=text name=rumus[sp] value='$rumus[sp]' size=6> mL
							 ( Vol Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ sampel )
							 </td>
						</tr>
						<tr>
							<td >Bl - SP (h)</td>
							<td>".($rumus[bl]-$rumus[sp])."  mL
							 ( Selisih Vol penitrasi Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ sampel )
							 </td>
						</tr>
						<tr>
							<td> f</td>
							<td><input type=text name=rumus[f] value='$rumus[f]' size=6>
							 ( Faktor Normalitas Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> )
							 </td>
						</tr>
						<tr>
							<td >f x h</td>
							<td>".($rumus[f]*($rumus[bl]-$rumus[sp]))."  mL
							 (   Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub>  0.1 N )
							 </td>
						</tr>
						<tr>
							<td >a</td>
							<td><input type=text name=rumus[a] value='$rumus[a]' size=6> 
							 ( Hasil pembacaan mg tepung dari tabel )
							 </td>
						</tr>
						<tr>
							<td >b</td>
							<td><input type=text name=rumus[b] value='$rumus[b]' size=6>
							 ( Vol.  yang direaksikan dgn Luff Schoorl )
							 </td>
						</tr>
						<tr>
							<td >c</td>
							<td><input type=text name=rumus[c] value='$rumus[c]' size=6> mg
							 ( Berat contoh yang ditimbang )
							 </td>
						</tr>
						<tr>
							<td >d</td>
							<td><input type=text name=rumus[d] value='$rumus[d]' size=6>
							( Faktor Pengenceran )
							 </td>
						</tr>
 						<tr>
							<td >% KH</td>
							<td>$hasil
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}	else if ($jenisanalisis==7) {
  	 		$analisis .= "
	 		<tr>
				<td>
					Penentuan Gula Preduksi cara Luff Schoorl
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								<img src='rumus/rumus7.png' border=1>
							</td>
						</tr>
						<tr>
							<td >Pl</td>
							<td>";
							if ($rumus[pl]=="") {
								$rumus[pl]=250;
							}
							$analisis .= "<input type=text name=rumus[pl] value='$rumus[pl]' size=6> mL
							 ( Vol Pelarutan Contoh)
							 </td>
						</tr>
						<tr>
							<td >Bl</td>
							<td><input type=text name=rumus[bl] value='$rumus[bl]' size=6> mL
							 ( Vol Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ blanko )
							 </td>
						</tr>
						<tr>
							<td >Sp</td>
							<td><input type=text name=rumus[sp] value='$rumus[sp]' size=6> mL
							 ( Vol Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ sampel )
							 </td>
						</tr>
						<tr>
							<td >Bl - SP (h)</td>
							<td>".($rumus[bl]-$rumus[sp])."  mL
							 ( Selisih Vol penitrasi Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ sampel )
							 </td>
						</tr>
						<tr>
							<td> f</td>
							<td><input type=text name=rumus[f] value='$rumus[f]' size=6>
							 ( Faktor Normalitas Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> )
							 </td>
						</tr>
						<tr>
							<td >f x h</td>
							<td>".($rumus[f]*($rumus[bl]-$rumus[sp]))."  mL
							 (   Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub>  0.1 N )
							 </td>
						</tr>
						<tr>
							<td >a</td>
							<td><input type=text name=rumus[a] value='$rumus[a]' size=6> 
							 ( Hasil pembacaan mg tepung dari tabel )
							 </td>
						</tr>
						<tr>
							<td >b</td>
							<td><input type=text name=rumus[b] value='$rumus[b]' size=6>
							 ( Vol.  yang direaksikan dgn Luff Schoorl )
							 </td>
						</tr>
						<tr>
							<td >c</td>
							<td><input type=text name=rumus[c] value='$rumus[c]' size=6> mg
							 ( Berat contoh yang ditimbang )
							 </td>
						</tr>
						<tr>
							<td >d</td>
							<td><input type=text name=rumus[d] value='$rumus[d]' size=6>
							( Faktor Pengenceran )
							 </td>
						</tr>
 						<tr>
							<td >% KH</td>
							<td>$hasil
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}	else if ($jenisanalisis==8) {
  	 		$analisis .= "
	 		<tr>
				<td>
					Penentuan Gula Total cara Luff Schoorl
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								<img src='rumus/rumus8.png' border=1>
							</td>
						</tr>
						<tr>
							<td >Pl</td>
							<td>";
							if ($rumus[pl]=="") {
								$rumus[pl]=100;
							}
							$analisis .= "<input type=text name=rumus[pl] value='$rumus[pl]' size=6> mL
							 ( Vol Pelarutan Hasil Inversi)
							 </td>
						</tr>
						<tr>
							<td >Bl</td>
							<td><input type=text name=rumus[bl] value='$rumus[bl]' size=6> mL
							 ( Vol Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ blanko )
							 </td>
						</tr>
						<tr>
							<td >Sp</td>
							<td><input type=text name=rumus[sp] value='$rumus[sp]' size=6> mL
							 ( Vol Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ sampel )
							 </td>
						</tr>
						<tr>
							<td >Bl - SP (h)</td>
							<td>".($rumus[bl]-$rumus[sp])."  mL
							 ( Selisih Vol penitrasi Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ sampel )
							 </td>
						</tr>
						<tr>
							<td> F</td>
							<td><input type=text name=rumus[F] value='$rumus[F]' size=6>
							 ( Faktor Normalitas Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> )
							 </td>
						</tr>
						<tr>
							<td >F x h</td>
							<td>".($rumus[F]*($rumus[bl]-$rumus[sp]))."  mL
							 (   Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub>  0.1 N )
							 </td>
						</tr>
						<tr>
							<td >a</td>
							<td><input type=text name=rumus[a] value='$rumus[a]' size=6> 
							 ( Hasil pembacaan mg tepung dari tabel )
							 </td>
						</tr>
						<tr>
							<td >b</td>
							<td><input type=text name=rumus[b] value='$rumus[b]' size=6>
							 ( Vol.  yang direaksikan dgn Luff Schoorl )
							 </td>
						</tr>
						<tr>
							<td >c</td>
							<td><input type=text name=rumus[c] value='$rumus[c]' size=6> mg
							 ( Berat contoh yang ditimbang )
							 </td>
						</tr>
						<tr>
							<td >e</td>
							<td><input type=text name=rumus[e] value='$rumus[e]' size=6> mL
							 ( Volume Pelarutan Contoh )
							 </td>
						</tr>
						<tr>
							<td >f</td>
							<td>";
							if ($rumus[f]=="") {
								$rumus[f]=1;
							}
							$analisis .= "<input type=text name=rumus[f] value='$rumus[f]' size=6> mL
							 ( Volume Larutan yg diambil u/ inversi )
							 </td>
						</tr>
							<tr>
							<td >d = e/f</td>
							<td>".($rumus[e]/$rumus[f])."
							( Faktor Pengenceran )
							 </td>
						</tr>
 						<tr>
							<td >% Gula Pereduksi</td>
							<td>$hasil
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	} else if ($jenisanalisis==9) {
  	 		$analisis .= "
	 		<tr>
				<td>
					Penentuan Klorida cara Mohr
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								<img src='rumus/rumus9.png' border=1>
							</td>
						</tr>
						<tr>
							<td >a</td>
							<td><input type=text name=rumus[a] value='$rumus[a]' size=6> mL
							(Volume pelarutan contoh)
 							 </td>
						</tr>
						<tr>
							<td >b</td>
							<td><input type=text name=rumus[b] value='$rumus[b]' size=6> mL
							(Banyaknya contoh yang dititrasi)
 							 </td>
						</tr>
						<tr>
							<td >c</td>
							<td><input type=text name=rumus[c] value='$rumus[c]' size=6> mL
							(Volume larutan penitrasi AgNO<sub>3</sub>)
 							 </td>
						</tr>
						<tr>
							<td >d</td>
							<td><input type=text name=rumus[d] value='$rumus[d]' size=6>
							(Normalitas Penitrasi)
 							 </td>
						</tr>
						<tr>
							<td >e</td>
							<td>";
							
							if ($rumus[e]=="") {
								$rumus[e]=35.5;
							}
							$analisis .= "<input type=text name=rumus[e] value='$rumus[e]' size=6>
 							 (Berat setara Cl)
 							 </td>
						</tr>
						<tr>
							<td >f</td>
							<td><input type=text name=rumus[f] value='$rumus[f]' size=6> mg
							(Berat contoh)
 							 </td>
						</tr>
 						<tr>
							<td >% Klor</td>
							<td>$hasil
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}	else if ($jenisanalisis>=10 && $jenisanalisis<=16) {

  	 		$analisis .= "
	 		<tr>
				<td>
					".$arrayanalisis[$jenisanalisis]."
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td colspan=2>
 									<table  border=1 style='border-collapse:collapse;'>
										<tr align=center>
											<td><b>X</td>
 									";
									for ($ii=0;$ii<10;$ii++) {
										$analisis .= "
 											<td><input type=text size=2 name=datax[$ii] value='$datax[$ii]'></td>
										";
									}
									$analisis .= "
									</tr>
										<tr align=center>
											<td><b>Y</td>
 									";
									for ($ii=0;$ii<10;$ii++) {
										$analisis .= "
 											<td><input type=text size=2 name=datay[$ii] value='$datay[$ii]'></td>
										";
									}
									
									
									$analisis .= "
									</tr>
 									</table><br>
 									<table border=1 style='border-collapse:collapse;'>
										<tr>
										<td>Slope = a</td>
										<td>".number_format($hr[a],4)."</td>
										</tr>
										<tr>
										<td>Intercept = b</td>
										<td>".number_format($hr[b],4)."</td>
										</tr>
										<tr>
										<td>Rumus Regresi</td>
										<td>$hr[eq]</td>
										</tr>
										<tr>
										<td>Correlation = R</td>
										<td>".number_format($hr[r],4)."</td>
										</tr>
										<tr>
										<td>R<sip>2</sup></td>
										<td>".number_format(($hr[r]*$hr[r]),4)."</td>
										</tr>
									</table>
 									<hr>
 									";
 									include "kurva.php";
 									$analisis .= "$kurva
							</td>
						</tr>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								<img src='rumus/rumus10.png' border=1>
							</td>
						</tr>
 						<tr>
							<td >Serapan</td>
							<td><input type=text name=rumus[s] value='$rumus[s]' size=6>
  							 </td>
						</tr>
 						<tr>
							<td >B</td>
							<td><input type=hidden name=rumus[b] value='$rumus[b]' size=6>
							".number_format($rumus[b],4)."
							( Konsentrasi contoh dari kurva kalibrasi )
 							 </td>
						</tr>
						<tr>
							<td >C</td>
							<td><input type=text name=rumus[c] value='$rumus[c]' size=6>
							( Faktor pengenceran contoh )
 							 </td>
						</tr>
 						<tr>
							<td >V</td>
							<td><input type=text name=rumus[v] value='$rumus[v]' size=6> mL
							( Vol. Pelarutan )
 							 </td>
						</tr>
 						<tr>
							<td >Berat Contoh</td>
							<td><input type=text name=rumus[bc] value='$rumus[bc]' size=6> mg
 							 </td>
						</tr>
  						<tr>
							<td >Kadar Logam</td>
							<td><b>".number_format($hasil,4)." ppm
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}	else if ($jenisanalisis>=17 && $jenisanalisis<=23) {
  	 		$analisis .= "
	 		<tr>
				<td>
					".$arrayanalisis[$jenisanalisis]."
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td colspan=2>
 									<table  border=1 style='border-collapse:collapse;'>
										<tr align=center>
											<td><b>X</td>
 									";
									for ($ii=0;$ii<10;$ii++) {
										$analisis .= "
 											<td><input type=text size=2 name=datax[$ii] value='$datax[$ii]'></td>
										";
									}
									$analisis .= "
									</tr>
										<tr align=center>
											<td><b>Y</td>
 									";
									for ($ii=0;$ii<10;$ii++) {
										$analisis .= "
 											<td><input type=text size=2 name=datay[$ii] value='$datay[$ii]'></td>
										";
									}
									
									
									$analisis .= "
									</tr>
 									</table><br>
 									<table border=1 style='border-collapse:collapse;'>
										<tr>
										<td>Slope = a</td>
										<td>".number_format($hr[a],4)."</td>
										</tr>
										<tr>
										<td>Intercept = b</td>
										<td>".number_format($hr[b],4)."</td>
										</tr>
										<tr>
										<td>Rumus Regresi</td>
										<td>$hr[eq]</td>
										</tr>
										<tr>
										<td>Correlation = R</td>
										<td>".number_format($hr[r],4)."</td>
										</tr>
										<tr>
										<td>R<sip>2</sup></td>
										<td>".number_format(($hr[r]*$hr[r]),4)."</td>
										</tr>
									</table>
 									<hr>
 									";
 									include "kurva.php";
 									$analisis .= "$kurva
							</td>
						</tr>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								 
								<img src='rumus/rumus17.png' border=1>
							</td>
						</tr>
 						<tr>
							<td >Serapan</td>
							<td><input type=text name=rumus[s] value='$rumus[s]' size=6>
  							 </td>
						</tr>
 						<tr>
							<td >B</td>
							<td><input type=hidden name=rumus[b] value='$rumus[b]' size=6>
							".number_format($rumus[b],4)."
							( Konsentrasi contoh dari kurva kalibrasi )
 							 </td>
						</tr>
						<tr>
							<td >D</td>
							<td><input type=text name=rumus[c] value='$rumus[c]' size=6> mL
							( Vol. Sampel )
 							 </td>
						</tr>
 						<tr>
							<td >C</td>
							<td><input type=text name=rumus[v] value='$rumus[v]' size=6> mL
							( Vol. MIBK)
 							 </td>
						</tr>
  						<tr>
							<td >Kadar Logam</td>
							<td><b>".number_format($hasil,4)." mg/L
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}								
	
	if ($jenisanalisis > 30) {
		 	 		$analisis .= "
		 	 <tr>
        
        <td> Data 1 (Single)</td>
        <td> 
      <table>  		
	 		<tr>
				<td>
					<b> ".$arrayanalisis[$jenisanalisis]."
				</td>
				<td>                                                    
					<table border=1>
						<tr align=center>
							<td><b>Variabel</td>
							<td><b>Keterangan</td>
							<td ><b>Nilai</td>
 						</tr>
						
					";
 
 					/*$q="SELECT * FROM varjenisuji WHERE IDJENISUJI='$jenisanalisis' AND MANUAL=2 ORDER BY VAR";
					$h2=doquery($q,$koneksi);
					$i=0;
					while ($d2=sqlfetcharray($h2)) {
									$rumus["$d2[VAR]"]= rumustohasil($d2[KONSTANTA],$rumus) ;
          }
          */
 					$q="SELECT * FROM varjenisuji WHERE IDJENISUJI='$jenisanalisis' ORDER BY VAR";
					$h2=doquery($q,$koneksi);
					$i=0;
					while ($d2=sqlfetcharray($h2)) {
									$cek0="";
									$cek1="";
							if ($d2[MANUAL]==0) {
									$cek0="checked";
							} else {
									$cek1="checked";
							}
							$analisis .= "
								<tr align=center>
									<td><b>$d2[VAR]<input type=hidden  name='var[$i]' value='$d2[VAR]'></td>
									<td>$d2[NAMA]</td>
									";
									if ($d2[MANUAL]==1) {  
										$analisis.="
											<td>
												<input type=text name='rumus[$d2[VAR]]'  value='".$rumus["$d2[VAR]"]."'>
											</td>
 										";
									} elseif ($d2[MANUAL]==0) {
									$rumus["$d2[VAR]"]= rumustohasil($d2[RUMUS],$rumus) ;
										$analisis.="
											<td>".$rumus["$d2[VAR]"]."
											<input type=hidden name='rumus[$d2[VAR]]'  
											value='".$rumus["$d2[VAR]"]."'>	
												</td>
									<td>
									<b>$d2[RUMUS]
									</td>
										";
									} elseif ($d2[MANUAL]==2) {
									//$rumus["$d2[VAR]"]= $d2[KONSTANTA];
									$rumus["$d2[VAR]"]= rumustohasil($d2[KONSTANTA],$rumus) ;
										$analisis.="
											<td>".$rumus["$d2[VAR]"]."
											<input type=hidden name='rumus[$d2[VAR]]'  
											value='".$rumus["$d2[VAR]"]."'>	
												</td>
 										";
									}
									$analisis.= "
								</tr>
							";
							$i++;
					}
					$analisis .= "
			</table>				
					</td>
			</tr>
				<tr>
					<td><b> Rumus Uji </td>
					<td style='font-size:16pt;'>
          <input type=hidden name=rumusanalisis value='".$arrayanalisisrumus[$jenisanalisis]."'>
          <b>".$arrayanalisisrumus[$jenisanalisis]."</td>
				</tr>	 					
				<tr>
					<td><b> ".$arrayanalisishasil[$jenisanalisis]."</td>
					<td style='font-size:16pt;'><b>".hasilanalis($rumus,$jenisanalisis)." ".$arrayanalisissatuan[$jenisanalisis]."</td>
				</tr> 
        </table> 
       </td>
       </tr> 
			";
			$hasil1=hasilanalis($rumus,$jenisanalisis);
			
			if ($duplo==1) {
      
		 	 		$analisis .= "
		 	 <tr>
        
        <td> Data 2 (Duplo)</td>
        <td>";


		 	 		$analisis .= "
      <table>  		
	 		<tr>
				<td>
					<b> ".$arrayanalisis[$jenisanalisis]."
				</td>
				<td>                                                    
					<table border=1>
						<tr align=center>
							<td><b>Variabel</td>
							<td><b>Keterangan</td>
							<td ><b>Nilai</td>
 						</tr>
						
					";
 
					$q="SELECT * FROM varjenisuji WHERE IDJENISUJI='$jenisanalisis' ORDER BY VAR";
					$h2=doquery($q,$koneksi);
					$i=0;
					while ($d2=sqlfetcharray($h2)) {
									$cek0="";
									$cek1="";
							if ($d2[MANUAL]==0) {
									$cek0="checked";
							} else {
									$cek1="checked";
							}
							$analisis .= "
								<tr align=center>
									<td><b>$d2[VAR]<input type=hidden  name='varduplo[$i]' value='$d2[VAR]'></td>
									<td>$d2[NAMA]</td>
									";
									if ($d2[MANUAL]==1) {  
										$analisis.="
											<td>
												<input type=text name='rumusduplo[$d2[VAR]]'  value='".$rumusduplo["$d2[VAR]"]."'>
											</td>
 										";
									} elseif ($d2[MANUAL]==0) {
									$rumusduplo["$d2[VAR]"]= rumustohasil($d2[RUMUS],$rumusduplo) ;
										$analisis.="
											<td>".$rumusduplo["$d2[VAR]"]."
											<input type=hidden name='rumusduplo[$d2[VAR]]'  
											value='".$rumusduplo["$d2[VAR]"]."'>	
												</td>
									<td>
									<b>$d2[RUMUS]
									</td>
										";
									} elseif ($d2[MANUAL]==2) {
									//$rumusduplo["$d2[VAR]"]= $d2[KONSTANTA];
									$rumusduplo["$d2[VAR]"]= rumustohasil($d2[KONSTANTA],$rumusduplo) ;
										$analisis.="
											<td>".$rumusduplo["$d2[VAR]"]."
											<input type=hidden name='rumusduplo[$d2[VAR]]'  
											value='".$rumusduplo["$d2[VAR]"]."'>	
												</td>
 										";
									}
									$analisis.= "
								</tr>
							";
							$i++;
					}
					$analisis .= "
			</table>				
					</td>
			</tr>
				<tr>
					<td><b> Rumus Uji </td>
					<td style='font-size:16pt;'><b>".$arrayanalisisrumus[$jenisanalisis]."</td>
				</tr>	 					
				<tr>
					<td><b> ".$arrayanalisishasil[$jenisanalisis]."</td>
					<td style='font-size:16pt;'><b>".hasilanalis($rumusduplo,$jenisanalisis)." ".$arrayanalisissatuan[$jenisanalisis]."</td>
				</tr> 
         </table> 
       </td>
       </tr> 
			";
			
      $hasil2=hasilanalis($rumusduplo,$jenisanalisis);
      if (is_numeric($hasil2)) {
        $nilairata=($hasil1+$hasil2)/2;
      }  
      $analisis.="
				<tr>
					<td><b> Nilai Rata-rata</td>
					<td style='font-size:16pt;'>
					$nilairata ".$arrayanalisissatuan[$jenisanalisis]."
           </td>
				</tr>
      ";			

      
      }

				if ($nilaibaku=="") {
          $nilaibaku=getnilaibaku($jenisanalisis);
        }
      $analisis.="
				<tr>
					<td><b> Nilai Baku/Standar</td>
					<td style='font-size:16pt;'>
          $nilaibaku ".$arrayanalisissatuan[$jenisanalisis]."
          </td>
				</tr>
      ";			
//          <input style='font-size:16pt;' name='nilaibaku' type=text size=10 value='$nilaibaku'> ".$arrayanalisissatuan[$jenisanalisis]."

	}																													
?>
