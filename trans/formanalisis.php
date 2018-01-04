<?

	if ($jenisanalisis==0) {
 	 		$fanalisis .= "
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
							<td>$rumus[a]  g ( Berat wadah kosong )</td>
						</tr>
						<tr>
							<td >b</td>
							<td>$rumus[b]  g ( Berat wadah + contoh )</td>
						</tr>
						<tr>
							<td >c</td>
							<td>$rumus[c] g ( Berat setelah pemanasan )</td>
						</tr>
						<tr>
							<td ><b>% Kadar Air</td>
							<td><b>$hasil</td>
						</tr>
					</table>
 				</td>
			</tr>";
			
			if ($duplo==1) {
        $fanalisis.="	 	
        <tr>
 	 	  <td>Data 2 (Duplo)</td>
 	 	  <td>
 
					
					<table width=100%>
 						<tr>
							<td >a</td>
							<td>$rumusduplo[a]  g ( Berat wadah kosong )</td>
						</tr>
						<tr>
							<td >b</td>
							<td>$rumusduplo[b]  g ( Berat wadah + contoh )</td>
						</tr>
						<tr>
							<td >c</td>
							<td>$rumusduplo[c] g ( Berat setelah pemanasan )</td>
						</tr>
						<tr>
							<td ><b>% Kadar Air</td>
							<td><b>$hasilduplo</td>
						</tr>
					</table>
 				</td>
			</tr>";
      
      }

			$fanalisis.="
				<tr>
					<td> Nilai Baku/Standar</td>
					<td style='font-size:14pt;'>
            $nilaibaku %
          </td>
				</tr>	 					
      ";

			
	} else
	if ($jenisanalisis==1) {
		//foreach ($rumus as $k=>$v) {
		//	$fanalisis .= "$k=>$v;";
		//}
 	 		$fanalisis .= "
	 		<tr>
				<td>
					Analisis Kadar Protein
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td width=100>
								Rumus
							</td>
							<td>
								<img src='rumus/rumus1.png' border=1>
							</td>
						</tr>
						<tr>
							<td >Vol. Pelarutan Hasil Destilasi</td>
							<td>$rumus[vold] mL </td>
						</tr>
						<tr>
							<td >Vol. Larutan yg Dipipet</td>
							<td>$rumus[volp] mL</td>
						</tr>
						<tr>
							<td >HCl</td>
							<td>$rumus[hcl] mL</td>
						</tr>
						<tr>
							<td >N HCl</td>
							<td>$rumus[nhcl]</td>
						</tr>
						<tr>
							<td >Berat contoh</td>
							<td>$rumus[bc] mg</td>
						</tr>
						<tr>
							<td >Faktor Konversi</td>
							<td>$rumus[F]</td>
						</tr>
						<tr>
							<td >% N</td>
							<td>$hasil[0]</td>
						</tr>
						<tr>
							<td ><b><b>% Protein</td>
							<td><b><b>$hasil[1]</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}	else
	if ($jenisanalisis==2) {
		//foreach ($rumus as $k=>$v) {
		//	$fanalisis .= "$k=>$v;";
		//}
 	 		$fanalisis .= "
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
							<td>$rumus[A] g</td>
						</tr>
						<tr>
							<td >Berat Wadah + Contoh (B)</td>
							<td>$rumus[B] g</td>
						</tr>
						<tr>
							<td >Berat Contoh (B-A)</td>
							<td>".($rumus[B]-$rumus[A])." g</td>
						</tr>
						<tr>
							<td >Berat Labu Kosong (C)</td>
							<td>$rumus[C] g</td>
						</tr>
						<tr>
							<td nowrap >Berat Labu Kosong + Minyak/Lemak (D)</td>
							<td>$rumus[D] g</td>
						</tr>
						<tr>
							<td >Berat Minyak/Lemak (D-C)</td>
							<td>".($rumus[D]-$rumus[C])." g</td>
						</tr>
						<tr>
							<td ><b>% Lemak</td>
							<td><b>$hasil
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}	else
	if ($jenisanalisis==3) {
		//foreach ($rumus as $k=>$v) {
		//	$fanalisis .= "$k=>$v;";
		//}
 	 		$fanalisis .= "
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
							<td>$rumus[A] g</td>
						</tr>
						<tr>
							<td >Berat Cawan + Contoh (B)</td>
							<td>$rumus[B] g</td>
						</tr>
						<tr>
							<td >Berat Contoh (B-A)</td>
							<td>".($rumus[B]-$rumus[A])." g</td>
						</tr>
						<tr>
							<td >Berat Cawan + Contoh setelah Pemanasan (C)</td>
							<td>$rumus[C] g</td>
						</tr>
						<tr>
							<td >Berat Abu (C-A)</td>
							<td>".($rumus[C]-$rumus[A])." g</td>
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
  	 		$fanalisis .= "
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
							<td>$rumus[a]
							( Berat contoh ) </td>
						</tr>
						<tr>
							<td >b</td>
							<td>$rumus[b]
							( Konstanta contoh yang didapat dari kurva kalibrasi )</td>
						</tr>
						<tr>
							<td >c</td>
							<td>$rumus[c]
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
  	 		$fanalisis .= "
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
							<td>$rumus[a] g
							( Berat Contoh ) 
							 </td>
						</tr>
						<tr>
							<td >B</td>
							<td>$rumus[b] g 
							( Berat Cawan Kosong 110<sup>o</sup> C )
							 </td>
						</tr>
						<tr>
							<td >C</td>
							<td>$rumus[c] g
							( Berat Kertas Saring )
							 </td>
						</tr>
						<tr>
							<td >D</td>
							<td>$rumus[d] g
							 ( Berat Cawan + Kertas Saring + Residu 110<sup>o</sup> C ) 
							 </td>
						</tr>
						<tr>
							<td >E</td>
							<td>$rumus[e] g
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
	}	else if ($jenisanalisis==6) {
  	 		$fanalisis .= "
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
							<td>$rumus[pl] mL
							 ( Vol Pelarutan Hasil Inversi)
							 </td>
						</tr>
						<tr>
							<td >Bl</td>
							<td>$rumus[bl] mL
							 ( Vol Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ blanko )
							 </td>
						</tr>
						<tr>
							<td >Sp</td>
							<td>$rumus[sp] mL
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
							<td>$rumus[f]
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
							<td>$rumus[a]
							 ( Hasil pembacaan mg tepung dari tabel )
							 </td>
						</tr>
						<tr>
							<td >b</td>
							<td>$rumus[b]
							( Vol.  yang direaksikan dgn Luff Schoorl )
							 </td>
						</tr>
						<tr>
							<td >c</td>
							<td>$rumus[c]
							 ( Berat contoh yang ditimbang {mg} )
							 </td>
						</tr>
						<tr>
							<td >d</td>
							<td>$rumus[d]
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
  	 		$fanalisis .= "
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
							<td>$rumus[pl] mL
							 ( Vol Pelarutan Hasil Inversi)
							 </td>
						</tr>
						<tr>
							<td >Bl</td>
							<td>$rumus[bl] mL
							 ( Vol Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ blanko )
							 </td>
						</tr>
						<tr>
							<td >Sp</td>
							<td>$rumus[sp] mL
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
							<td>$rumus[f]
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
							<td>$rumus[a]
							 ( Hasil pembacaan mg tepung dari tabel )
							 </td>
						</tr>
						<tr>
							<td >b</td>
							<td>$rumus[b]
							( Vol.  yang direaksikan dgn Luff Schoorl )
							 </td>
						</tr>
						<tr>
							<td >c</td>
							<td>$rumus[c]
							 ( Berat contoh yang ditimbang {mg} )
							 </td>
						</tr>
						<tr>
							<td >d</td>
							<td>$rumus[d]
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
	} else if ($jenisanalisis==8) {
  	 		$fanalisis .= "
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
							<td>$rumus[pl] mL
							 ( Vol Pelarutan Hasil Inversi)
							 </td>
						</tr>
						<tr>
							<td >Bl</td>
							<td>$rumus[bl] mL
							 ( Vol Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> u/ blanko )
							 </td>
						</tr>
						<tr>
							<td >Sp</td>
							<td>$rumus[sp] mL
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
							<td>$rumus[F]
							 ( Faktor Normalitas Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub> )
							 </td>
						</tr>
						<tr>
							<td >f x h</td>
							<td>".($rumus[F]*($rumus[bl]-$rumus[sp]))."  mL
							 (   Na<sub>2</sub>S<sub>2</sub>O<sub>3</sub>  0.1 N )
							 </td>
						</tr>
						<tr>
							<td >a</td>
							<td>$rumus[a]
							 ( Hasil pembacaan mg tepung dari tabel )
							 </td>
						</tr>
						<tr>
							<td >b</td>
							<td>$rumus[b]
							 ( Vol.  yang direaksikan dgn Luff Schoorl )
							 </td>
						</tr>
						<tr>
							<td >c</td>
							<td>$rumus[c] mg
							 ( Berat contoh yang ditimbang )
							 </td>
						</tr>
						<tr>
							<td >e</td>
							<td>$rumus[e] mL
							 ( Volume Pelarutan Contoh )
							 </td>
						</tr>
						<tr>
							<td >f</td>
							<td>$rumus[f] mL
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
	}	else if ($jenisanalisis==9) {
  	 		$fanalisis .= "
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
							<td>$rumus[a]  mL
							(Volume pelarutan contoh)
 							 </td>
						</tr>
						<tr>
							<td >b</td>
							<td>$rumus[b] mL
							(Banyaknya contoh yang dititrasi)
 							 </td>
						</tr>
						<tr>
							<td >c</td>
							<td>$rumus[c] mL
							(Volume larutan penitrasi AgNO<sub>3</sub>)
 							 </td>
						</tr>
						<tr>
							<td >d</td>
							<td>$rumus[d] (Normalitas Penitrasi)
 							 </td>
						</tr>
						<tr>
							<td >e</td>
							<td>$rumus[e] (Berat setara Cl)
 							 </td>
						</tr>
						<tr>
							<td >f</td>
							<td>$rumus[f] mg
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
	}else if ($jenisanalisis>=10 && $jenisanalisis<=16) {
  	 		$fanalisis .= "
	 		<tr>
				<td>
					".$arrayanalisis[$jenisanalisis]."
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td colspan=2>
 									<table  border=1>
										<tr align=center>
											<td><b>X</td>
 									";
									for ($ii=0;$ii<10;$ii++) {
										$fanalisis .= "
 											<td>$datax[$ii]</td>
										";
									}
									$fanalisis .= "
									</tr>
										<tr align=center>
											<td><b>Y</td>
 									";
									for ($ii=0;$ii<10;$ii++) {
										$fanalisis .= "
 											<td>$datay[$ii]</td>
										";
									}
									
									
									$fanalisis .= "
									</tr>
 									</table><br>
 									<table border=1>
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
 									$fanalisis .= "<image src='gambardiagram/$idupdate$jenisanalisis.png' >
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
							<td>$rumus[s]
  							 </td>
						</tr>
 						<tr>
							<td >B</td>
							<td> 
							".number_format($rumus[b],4)."
							( Konsentrasi contoh dari kurva kalibrasi )
 							 </td>
						</tr>
 						<tr>
							<td >C</td>
							<td>$rumus[c]
							( Faktor pengenceran contoh )
 							 </td>
						</tr>
 						<tr>
							<td >V</td>
							<td>$rumus[v] mL
							( Vol. Pelarutan )
 							 </td>
						</tr>
  						<tr>
							<td >Berat Contoh</td>
							<td>$rumus[bc] mg
 							 </td>
						</tr>
 						<tr>
							<td >Kadar Logam</td>
							<td>".number_format($hasil,4)." ppm
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}	else if ($jenisanalisis>=17 && $jenisanalisis<=23) {
  	 		$fanalisis .= "
	 		<tr>
				<td>
					".$arrayanalisis[$jenisanalisis]."
				</td>
				<td>

					
					<table width=90%>
						<tr>
							<td colspan=2>
 									<table  border=1>
										<tr align=center>
											<td><b>X</td>
 									";
									for ($ii=0;$ii<10;$ii++) {
										$fanalisis .= "
 											<td>$datax[$ii]</td>
										";
									}
									$fanalisis .= "
									</tr>
										<tr align=center>
											<td><b>Y</td>
 									";
									for ($ii=0;$ii<10;$ii++) {
										$fanalisis .= "
 											<td>$datay[$ii]</td>
										";
									}
									
									
									$fanalisis .= "
									</tr>
 									</table><br>
 									<table border=1>
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
 									$fanalisis .= "<image src='gambardiagram/$idupdate$jenisanalisis.png' >
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
							<td>$rumus[s]
  							 </td>
						</tr>
 						<tr>
							<td >B</td>
							<td> 
							".number_format($rumus[b],4)."
							( Konsentrasi contoh dari kurva kalibrasi )
 							 </td>
						</tr>
 						<tr>
							<td >D</td>
							<td>$rumus[c] mL
							( Vol. Sampel )
 							 </td>
						</tr>
 						<tr>
							<td >C</td>
							<td>$rumus[v] mL
							( Vol. MIBK )
 							 </td>
						</tr>
 
 						<tr>
							<td >Kadar Logam</td>
							<td>".number_format($hasil,4)." mg/L
							</td>
						</tr>
					</table>
					

				</td>
			</tr>";
	}															
	
	if ($jenisanalisis > 30) {

		 	 		$fanalisis .= "
		 	 <tr>
        
        <td> Data 1 (Single)</td>
        <td> 
		 	<table width=100%>
	 		<tr>
				<td>
					".$arrayanalisis[$jenisanalisis]."
				</td>
				<td> 
					<table border=1 width=95%>
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
							$fanalisis .= "
								<tr align=center>
									<td><b>$d2[VAR]<input type=hidden  name='var[$i]' value='$d2[VAR]'></td>
									<td>$d2[NAMA]</td>
									";
									if ($d2[MANUAL]==1) {  
										$fanalisis.="
											<td>
												".$rumus["$d2[VAR]"]."
											</td>
 										";
									} elseif ($d2[MANUAL]==0) {
									
									if ($rumusanalisis!="") {
                    $d2[RUMUS]=$rumusanalisis;
                  }
									
									$rumus["$d2[VAR]"]= rumustohasil($d2[RUMUS],$rumus) ;
										$fanalisis.="
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
										$fanalisis.="
											<td>".$rumus["$d2[VAR]"]."
											<input type=hidden name='rumus[$d2[VAR]]'  
											value='".$rumus["$d2[VAR]"]."'>	
												</td>
 										";
									}
									$fanalisis.= "
								</tr>
							";
							$i++;
					}
					$fanalisis .= "
			</table>				
					</td>
			</tr>
				<tr>
					<td> Rumus Uji </td>
					<td style='font-size:16pt;'><b>".$rumusanalisis."</td>
				</tr>	 					
				<tr>
					<td> ".$arrayanalisishasil[$jenisanalisis]."</td>
					<td style='font-size:16pt;'><b>".$hasil." ".$arrayanalisissatuan[$jenisanalisis]."</td>
				</tr>	 					
        </table> 
       </td>
       </tr> 
			";


			if ($duplo==1) {

		 	 		$fanalisis .= "
		 	 <tr>
        
        <td> Data 2 (Duplo)</td>
        <td> 
		 	<table width=100%>
	 		<tr>
				<td>
					".$arrayanalisis[$jenisanalisis]."
				</td>
				<td> 
					<table width=95% border=1>
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
							$fanalisis .= "
								<tr align=center>
									<td><b>$d2[VAR]<input type=hidden  name='varduplo[$i]' value='$d2[VAR]'></td>
									<td>$d2[NAMA]</td>
									";
									if ($d2[MANUAL]==1) {  
										$fanalisis.="
											<td>
												".$rumusduplo["$d2[VAR]"]."
											</td>
 										";
									} elseif ($d2[MANUAL]==0) {

									if ($rumusanalisis!="") {
                    $d2[RUMUS]=$rumusanalisis;
                  }

									$rumusduplo["$d2[VAR]"]= rumustohasil($d2[RUMUS],$rumusduplo) ;
										$fanalisis.="
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
										$fanalisis.="
											<td>".$rumusduplo["$d2[VAR]"]."
											<input type=hidden name='rumusduplo[$d2[VAR]]'  
											value='".$rumusduplo["$d2[VAR]"]."'>	
												</td>
 										";
									}
									$fanalisis.= "
								</tr>
							";
							$i++;
					}
					$fanalisis .= "
			</table>				
					</td>
			</tr>
				<tr>
					<td> Rumus Uji </td>
					<td style='font-size:16pt;'><b>".$rumusanalisis."</td>
				</tr>	 					
				<tr>
					<td> ".$arrayanalisishasil[$jenisanalisis]."</td>
					<td style='font-size:16pt;'><b>".$hasilduplo." ".$arrayanalisissatuan[$jenisanalisis]."</td>
				</tr>	 					
        </table> 
       </td>
       </tr> 
			";

			$hasil1=hasilanalis($rumus,$jenisanalisis);
      $hasil2=hasilanalis($rumusduplo,$jenisanalisis);
      if (is_numeric($hasil2)) {
        $nilairata=($hasil1+$hasil2)/2;
      }  


			$fanalisis.="
				<tr>
					<td> Nilai Rata-rata</td>
					<td style='font-size:14pt;'>
					$nilairata ".$arrayanalisissatuan[$jenisanalisis]."
          </td>
				</tr>	 					
      ";


      }

			
			$fanalisis.="
				<tr>
					<td> Nilai Baku/Standar</td>
					<td style='font-size:14pt;'>
            $nilaibaku ".$arrayanalisissatuan[$jenisanalisis]."
          </td>
				</tr>	 					
      ";
			
	}																										
	?>
