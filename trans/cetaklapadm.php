<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
include $root."style.inc";
include "init.php";
include "initkop.php";

if ($_SESSION[tingkats]!="B") {
    exit;
}



if ($kop==1) {
  include "proseskop.php";
  echo "$tmpkop";
}
if ($desimal<=0) {
  $desimal=2;
}

// CEK DUPLO

$duplo=0;
foreach ($pilihid as $k=>$v) {
  $q="SELECT DUPLO,ID
  FROM permintaan 
  WHERE IDTRANS='$k'  
  ORDER BY ID";
  $h=doquery($q,$koneksi);
  while ($d=sqlfetcharray($h)) {
    if ($d[DUPLO]==1) {
      $duplo=1;
    }
    $arrayduplo[$d[ID]]=$d[DUPLO];
  }
  $datakodepermintaan.="$k,";
}

$ketlog="Buat Laporan. Kode Permintaan: $datakodepermintaan";
buatlogiso(12,$ketlog,$q,$users);

  	
$styletab="style='width:95%'";
 
$qf="(";
foreach ($pilihid as $k=>$v) {
	$qf.=" IDTRANS='$k' OR";
	
	 $q=" SELECT CONTOH, COUNT(IDTRANS) AS JML 
			FROM minta,permintaan 
			WHERE minta.ID='$k'  AND minta.ID=permintaan.IDTRANS 
			GROUP BY minta.ID
			";
	$h=doquery($q,$koneksi);
 	$dh=sqlfetcharray($h);
	$arraynamasampel[$k]=$dh[CONTOH];
	$contoh.=" $dh[CONTOH] ( $dh[JML] ),  ";


	 $q=" SELECT SAMPEL,ID,IDAN
			FROM permintaan 
			WHERE '$k'   =permintaan.IDTRANS 
 			";
	$h=doquery($q,$koneksi);
	unset($arrayanalislap);
 	while ($dh=sqlfetcharray($h)) {
  	$arraynamasampel2["$k"]["$dh[ID]"]="$dh[SAMPEL]";
  	if ($arraynamaanalis[$dh[IDAN]]!="") {
    	$arrayanalislap["$dh[IDAN]"]=$arraynamaanalis[$dh[IDAN]];
    }
  	//echo "Analis:  ".$arraynamaanalis[$dh[IDAN]]." <br>";
  }
		
}
$qf.=")";
$qf=str_replace("OR)",")",$qf);

 $q="SELECT 
DATE_FORMAT(TGLTERIMAMAN,'%d-%m-%Y') AS TGLM  

FROM
permintaan WHERE TGLTERIMAMAN IS NOT NULL AND
$qf ORDER BY TGLTERIMAMAN LIMIT 0,1
";
$h=doquery($q,$koneksi);
//echo mysql_error();
$dm=sqlfetcharray($h);
 
 
/////////////////////////////////////// 
 
$qf="(";
foreach ($pilihid as $k=>$v) {
	$qf.=" ID='$k' OR";
}
$qf.=")";
$qf=str_replace("OR)",")",$qf);

$q="SELECT 
IDMAN,NOMER1,NOMER2,
DATE_FORMAT(TANGGALDATANG,'%d-%m-%Y') AS TGLD,
DATE_FORMAT('$thnlap-$blnlap-$tgllap','%d-%m-%Y') AS TGLS

FROM
minta WHERE $qf ORDER BY TANGGALDATANG LIMIT 0,1
";
$h=doquery($q,$koneksi);

$d=sqlfetcharray($h);
$idman=$d[IDMAN];
$tmpcetak = "
 <center>	
	<h3>".$arraybahasa["LAPORAN HASIL ANALISIS"]."</h3>
 	<table  $styletab>
		<tr valign=top>
			<td  >REPORT NUMBER</td>
						<td>:</td>
		
			<td>$d[NOMER1]</td> 
		</tr>	 
		<tr valign=top>
			<td  nowrap>REFERENCE ORDER NUMBER</td>
						<td>:</td>
		
			<td>$d[NOMER2]</td> 
		</tr>	 
		<tr valign=top>
			<td  >".$arraybahasa["Tanggal Datang"]."</td>
						<td>:</td>
		
			<td>$d[TGLD]</td> 
		</tr>	 
		<tr valign=top>
			<td  >".$arraybahasa["Tanggal Pengerjaan"]."</td>
						<td>:</td>
		
			<td>$dm[TGLM]</td> 
		</tr>	 
<!--		<tr valign=top>
			<td  >Tanggal Selesai</td>
						<td>:</td>
		
			<td>$d[TGLS]</td> 
		</tr>	 
		-->
 		<tr valign=top>
			<td  width=150  nowrap>
				".$arraybahasa["Pelanggan"]."
			</td>
			<td>:</td>
			<td>
				".getnamatoko($idklien)."
		</tr>
		<!--
 		<tr valign=top>
			<td  width=150  nowrap>
				Alamat
			</td>
			<td>:</td>
			<td>
				".getalamattoko($idklien)."
		</tr>
		-->
 		<tr valign=top>
			<td  width=150  nowrap>
				".$arraybahasa["Jenis dan Jumlah Sampel"]."
			</td>
			<td>:</td>
			<td>
				$contoh
		</tr>
 		<tr valign=top>
			<td  width=150  nowrap>
				".$arraybahasa["Analis"]."
			</td>
			<td>:</td>
			<td> ";
			
			if (is_array($arrayanalislap)) {
			foreach ($arrayanalislap as $v) {
        $tmpcetak.="$v, ";
      }
      }
      $tmpcetak.= "
      
       
				 </td>
		</tr>
   	</table>

<br> 
 
";

$cetak="cetak";
printhtml();
 
 if (is_array($pilihid)) {
 	 $tmpcetak.= "<table  $bordercetakA4P     >";

 		if ($jenisl!='0') {
 		 $rowspanx="rowspan=2";
    }

 				if ($jenisl=='0') {
     		 /*
          $tmpcetak.= "
     			<tr align=center valign=middle>
     				<td  $rowspanx><b>".$arraybahasa["Kode Sampel"]."</td>
             
             ";
  				   if ($duplo==1) {
            $colspan="colspan=3"; 
           }
 				
	 				$tmpcetak.= "
	 				<td width=60><b>".$arraybahasa["Kode"]."</td>
   				<!--  <td  ><b>".$arraybahasa["Nama Sampel"]."</td>-->
	 				<td width=*><b>".$arraybahasa["Jenis Analisis"]."</td>
	 				<td  $colspan><b>".$arraybahasa["Hasil"]."</td>
	 				<td  ><b>".$arraybahasa["Nilai Standar"]."</td>
	 				";
       				$tmpcetak.= "
       			</tr>
       		";
       		*/
 				} else {
     		 $tmpcetak.= "
     			<tr align=center valign=middle>
     				<td  $rowspanx><b>".$arraybahasa["Kode Sampel"]." </td>
             
             ";
          $tmpcetak.="	<td  $rowspanx><b>".$arraybahasa["Nama Sampel"]."</td>";

 					$qf="(";
				 	foreach ($pilihid as $k=>$v) {
				 		$qf.=" IDTRANS='$k' OR";
				 	}
 					$qf.=")";
 					$qf=str_replace("OR)",")",$qf);
			 		$q="SELECT DISTINCT JENISANALISIS FROM permintaan WHERE $qf ORDER BY JENISANALISIS";
			 		$h=doquery($q,$koneksi);
			 		if (sqlnumrows($h)>0) {
			 			while ($d=sqlfetcharray($h)) {
			 				$arraykolom[$arrayanalisis2[$d[JENISANALISIS]]."-".$d[JENISANALISIS]]=1;
			 				$satuan="";
               if ($arrayanalisissatuan[$d[JENISANALISIS]]!="") {
                $satuan="<br>( ".$arrayanalisissatuan[$d[JENISANALISIS]]." )";
               }
			 				$arraykolomnama[$arrayanalisis2[$d[JENISANALISIS]]."-".$d[JENISANALISIS]]=$arrayanalisis2[$d[JENISANALISIS]]. " 
              </sup>$satuan";
			 			}
			 		}
			 		foreach ($arraykolom as $k=>$v) {
			 		  if ($duplo==1) {
              $colspan2="colspan=4";
             } else {
              $colspan2="colspan=3";
             }
			 			$tmpcetak.="
			 			<td $colspan2><b>".$arraykolomnama[$k]." </td>
			 			";
			 		}
       				$tmpcetak.= "
       			</tr>
       		";

			 			$tmpcetak.="<tr align=center valign=middle>";
			 		foreach ($arraykolom as $k=>$v) {
			 			$tmpcetak.="
			 			<td   ><b>".$arraybahasa["Data 1"]."</td>
			 			";
			 		  if ($duplo==1) {
  			 			$tmpcetak.="
  			 			<td   width=50%><b>".$arraybahasa["Data 2"]."</td>
  			 			<td   width=50%><b>".$arraybahasa["Rata"]."</td>
  			 			";
             }
			 			$tmpcetak.="
			 			<td   ><b>".$arraybahasa["Nilai Standar"]."</td>
			 			";
			 		}
       				$tmpcetak.= "
       			</tr>
       		";

			 		
 				}
 	foreach ($pilihid as $k=>$v) {
 		if ($jenisl=='0') { /// KOLOM



 		


 		
	 		$q="SELECT permintaan.* ,jenisuji.IDKELOMPOK,jenisuji.RM
       FROM permintaan LEFT JOIN jenisuji ON jenisuji.ID=permintaan.JENISANALISIS
       WHERE IDTRANS='$k' 
       ORDER BY jenisuji.IDKELOMPOK,jenisuji.NAMA";
	 		$h=doquery($q,$koneksi);
	 		if (sqlnumrows($h)>0) {

      $tmpcetak.= "
			<tr class=judulkolom   valign=middle>
				<td nowrap colspan=9 align=left>".$arraybahasa["Kode Sampel"]." : $k /  $arraynamasampel[$k]</td>
			</tr>";

      		 $tmpcetak.= "
     			<tr class=judulkolom    align=center valign=middle>
     			<!--	<td  $rowspanx><b>".$arraybahasa["Kode Sampel"]."</td> -->
             
             ";
  				   if ($duplo==1) {
            $colspan="colspan=3"; 
           }
 				
	 				$tmpcetak.= "
	 				<td width=60><b>".$arraybahasa["Kode"]."</td>
   				<!--  <td  ><b>".$arraybahasa["Nama Sampel"]."</td>-->
	 				<td width=*><b>".$arraybahasa["Jenis Analisis"]."</td>
	 				<td  ><b>".$arraybahasa["Satuan"]." </td>
	 				<td  $colspan><b>".$arraybahasa["Hasil"]." </td>
	 				<td  ><b>".$arraybahasa["Nilai Standar"]."</td>
	 				<td  ><b>".$arraybahasa["Metode"]."</td>
	 				";
       				$tmpcetak.= "
       			</tr>
       		";
  


	 			$ii=1;
	 			 $idkelompok="";
		 		 while ($data=sqlfetcharray($h)) {
		 		 
    				if ($data[IDKELOMPOK]=="") {
              $data[IDKELOMPOK]=0;
            }
    				
    				if ("$idkelompok"!="$data[IDKELOMPOK]") {
              $tmpcetak.= " 
    					<tr class=judulkolom   valign=middle>
     						<td nowrap colspan=8 align=left>KELOMPOK JENIS UJI: ".$arraykelompokjenisuji[$data[IDKELOMPOK]]."</td>
     					</tr>";
     					$idkelompok=$data[IDKELOMPOK];
            
            }
		 		 
		 		   $hasilakhirduplo="-";
		 		   $nilaibaku=$satuan="";
		 		 	$idpermintaan=$namasampel="";
		 		 	if ($ii==1) {
		 		 		$idpermintaan=$k;
		 		 		$namasampel="/".$arraynamasampel[$k];
		 		 	}
		 		 	
						if (!(trim($data[DATA2])=="" || trim($data[DATA2])=="||")) {
							$tmp=explode("||",$data[DATA2]);
							$datax=tekstorumus($tmp[0]);
							$datay=tekstorumus($tmp[1]);
							$hr=reglinear($datax,$datay);
							$rumus[b]=@(($rumus[s]-$hr[b])/$hr[a]);
	 					}
					
					 $rataduplo="";				
					$rumus=tekstorumus($data[DATA]);
					if ($data[JENISANALISIS] <=30) {
            $hasil=hasilanalis($rumus,$data[JENISANALISIS]);
          } else {
					 $hasil=$data[HASIL];
					}
		 		 	if ($data[JENISANALISIS]==1 || $data[JENISANALISIS]==5) {
		 		 		$hasilakhir=$hasil[1];
		 		 	} else {
		 		 		$hasilakhir=$hasil;
		 		 	}
		 		 	$nilaihasilakhir=$hasilakhir;

		 		 	$kuantitatif=1;
		 		 	if (!eregi("Error",$hasilakhir)) {
  		 		 	$kuantitatif=0;
		 		 	  if (is_numeric($hasilakhir)) {
		 		 		  $hasilakhir=number_format($hasilakhir,$desimal)."";
    		 		 	$kuantitatif=1;
		 		 		}  
		 		 		if ($data[JENISANALISIS]<9) {
		 		 			//$hasilakhir.=" % ";
		 		 			$satuan="%";
		 		 		} elseif ($data[JENISANALISIS]>=9 && $data[JENISANALISIS]<=16 ) {
		 		 			//$hasilakhir.=" ppm ";
		 		 			$satuan="ppm";
		 		 		} elseif ( $data[JENISANALISIS]>=17 && $data[JENISANALISIS]<=30 ) {
		 		 			//$hasilakhir.=" mg/L ";
		 		 			$satuan="mg/L";
						} else {
		 		 			//$hasilakhir.=" ".$arrayanalisissatuan[$data[JENISANALISIS]]." ";
     			 		$satuan=$arrayanalisissatuan[$data[JENISANALISIS]];
  
						}
		 		 			if ($data[NILAIBAKU]!="") {
     		 			   if (is_numeric($data[NILAIBAKU])) {
  	      	 		    $nilaibaku=number_format($data[NILAIBAKU],$desimal);
  	             } else {
                  $nilaibaku=$data[NILAIBAKU];
                 }
       	 		  } else {
                $nilaibaku="-";  
              }
		 		 	}
 			 	  if ($data[DUPLO]==1) {
            
  					$rumusduplo=tekstorumus($data[DATADUPLO]);
  					if ($data[JENISANALISIS] <=30) {
    					$hasilduplo=hasilanalis($rumusduplo,$data[JENISANALISIS]);
    				} else {
              $hasilduplo=$data[HASIL2];
            }
  		 		 	if ($data[JENISANALISIS]==1 || $data[JENISANALISIS]==5) {
  		 		 		$hasilakhirduplo=$hasilduplo[1];
  		 		 	} else {
  		 		 		$hasilakhirduplo=$hasilduplo;
  		 		 	}
		 		 	 $nilaihasilduplo=$hasilduplo;
		 		 	 $rataduplo=($nilaihasilduplo+$nilaihasilakhir)/2;
  		 		 	if (!eregi("Error",$hasilakhirduplo)) {
  		 		 	  if (is_numeric($hasilakhirduplo)) {
    		 		 		$hasilakhirduplo=number_format($hasilakhirduplo,$desimal)."";
    		 		 		$rataduplo=number_format($rataduplo,$desimal)."";
  		 		 		}
              if ($data[JENISANALISIS]<9) {
  		 		 			//$hasilakhirduplo.=" % ";
  		 		 			//$rataduplo.=" % ";
  		 		 		} elseif ($data[JENISANALISIS]>=9 && $data[JENISANALISIS]<=16 ) {
  		 		 			//$hasilakhirduplo.=" ppm ";
  		 		 			//$rataduplo.=" ppm ";
  		 		 		} elseif ( $data[JENISANALISIS]<=17 && $data[JENISANALISIS]<=30 ) {
  		 		 			//$hasilakhirduplo.=" mg/L ";
  		 		 			//$rataduplo.=" mg/L ";
  						} else {
  		 		 			//$hasilakhirduplo.=" ".$arrayanalisissatuan[$data[JENISANALISIS]]." ";
  		 		 			//$rataduplo.=" ".$arrayanalisissatuan[$data[JENISANALISIS]]." ";
     
  						}
  		 		 	}
            

    		 		 		if ($rataduplo==0) {
                  if ($kuantitatif==0) {
                    $rataduplo="";
                  }  
                }

            
          }			
 			 				
		 		 $tmpcetak.= "
		 			<tr>
		 				<!-- <td align=center>   </td> -->
             ";
             // $idpermintaan $namasampel - ".$arraynamasampel2["$k"]["$data[ID]"]."
 					$tmpcetak.= "
 					<td align=center>$data[ID]</td>
   				<!-- <td align=center> ".$arraynamasampel["$k"]." - ".$arraynamasampel2["$k"][$data[ID]]." </td> -->
 					<td align=center>".$arrayanalisis2[$data[JENISANALISIS]]."</td>
	 				<td align=center>$satuan </td>
	 				<td align=right>".$hasilakhir." </td>";
	 				if ($duplo==1) {
   					$tmpcetak.= "
       				<td align=right>".$hasilakhirduplo."</td>
       				<td align=right>".$rataduplo."</td>
               ";
	          
           }
 					$tmpcetak.= "
	 				<td align=right>$nilaibaku </td>
	 				<td align=left>$data[RM]</td>
  			 			</tr>
			 		";
			 				   
			 		$ii++;
			 	}
		 	}
		 } else {
		 	foreach ($arraykolom as $kk=>$vv) {
		 		$arraykolom[$kk]="";
		 	}
		 	
		 	unset($arraykolomduplo,$arraykolombaku);
			/// BARIS
	 		$q="SELECT * FROM permintaan WHERE IDTRANS='$k' ORDER BY ID";
	 		$h=doquery($q,$koneksi);
	 		if (sqlnumrows($h)>0) {
	 			$ii=1;
	 			 
		 		 while ($data=sqlfetcharray($h)) {
		 		 	$idpermintaan="";
		 		 	if ($ii==1) {
		 		 		$idpermintaan=$k;
		 		 	}
		 		 	$nilairata="";
						if (!(trim($data[DATA2])=="" || trim($data[DATA2])=="||")) {
							$tmp=explode("||",$data[DATA2]);
							$datax=tekstorumus($tmp[0]);
							$datay=tekstorumus($tmp[1]);
							$hr=reglinear($datax,$datay);
							$rumus[b]=@(($rumus[s]-$hr[b])/$hr[a]);
	 					}
					
					 				
					$rumus=tekstorumus($data[DATA]);
					if ($data[JENISANALISIS] <=30) {
  					$hasil=hasilanalis($rumus,$data[JENISANALISIS]);
  				} else {
            $hasil=$data[HASIL];
          }
		 		 	if ($data[JENISANALISIS]==1 || $data[JENISANALISIS]==5) {
		 		 		$hasilakhir=$hasil[1];
		 		 	} else {
		 		 		$hasilakhir=$hasil;
		 		 	}
		 		 	$nilaihasilakhir=$hasilakhir;
		 		 	$kuantitatif=1;
		 		 	if (!eregi("Error",$hasilakhir)) {
		 		 		  $kuantitatif=0;
		 		 	  if (is_numeric($hasilakhir)) {
  		 		 		$hasilakhir=number_format($hasilakhir,$desimal)."";
		 		 		  $kuantitatif=1;
  		 		 	}
		 		 		if ($data[JENISANALISIS]<9) {
		 		 			//$hasilakhir.=" % ";
		 		 		} elseif ($data[JENISANALISIS]>=9 && $data[JENISANALISIS]<=16 ) {
		 		 			//$hasilakhir.=" ppm ";
		 		 		} elseif ( $data[JENISANALISIS]<=17 && $data[JENISANALISIS]<=30 ) {
		 		 			//$hasilakhir.=" mg/L ";
						} else {
		 		 			//$hasilakhir.=" ".$arrayanalisissatuan[$data[JENISANALISIS]]." ";

						}
		 		 	}
 			 				
 					$arraykolom[$arrayanalisis2[$data[JENISANALISIS]]."-".$data[JENISANALISIS]]= $hasilakhir;
 		 			if (trim($data[NILAIBAKU])!="") {
 		 			   if (is_numeric($data[NILAIBAKU])) {
   	 		       $nilaibaku=number_format($data[NILAIBAKU],$desimal)." ".$arrayanalisissatuan[$data[JENISANALISIS]];
    	 		     } else {
                $nilaibaku= $data[NILAIBAKU];
              }
   	 		  } else {
            $nilaibaku="-";  
          }
 					$arraykolombaku[$arrayanalisis2[$data[JENISANALISIS]]."-".$data[JENISANALISIS]]= $nilaibaku;
 					
          if ($data[DUPLO]==1) {
   					$rumusduplo=tekstorumus($data[DATADUPLO]);
  					if ($data[JENISANALISIS] <=30) {
  					 $hasilduplo=hasilanalis($rumusduplo,$data[JENISANALISIS]);
  					} else {
              $hasilduplo=$data[HASIL2];
            }
   		 		 	if ($data[JENISANALISIS]==1 || $data[JENISANALISIS]==5) {
  		 		 		$hasilakhirduplo=$hasilduplo[1];
  		 		 	} else {
  		 		 		$hasilakhirduplo=$hasilduplo;
  		 		 	}
		 		 	 $nilaihasilduplo=$hasilakhirduplo;
		 		 	 $nilairata=($nilaihasilakhir+$nilaihasilduplo)/2;
  		 		 	if (!eregi("Error",$hasilakhirduplo)) {
  		 		 	  if (is_numeric($hasilakhirduplo)) {
    		 		 		$hasilakhirduplo=number_format($hasilakhirduplo,$desimal)."";
      		 		 	 $nilairata=number_format($nilairata,$desimal)."";;
    		 		 	}
  		 		 		if ($data[JENISANALISIS]<9) {
  		 		 			//$hasilakhirduplo.=" % ";
  		 		 			//$nilairata.=" % ";
  		 		 		} elseif ($data[JENISANALISIS]>=9 && $data[JENISANALISIS]<=16 ) {
  		 		 			//$hasilakhirduplo.=" ppm ";
  		 		 			//$nilairata.=" ppm ";
  		 		 		} elseif ( $data[JENISANALISIS]<=17 && $data[JENISANALISIS]<=30 ) {
  		 		 			//$hasilakhirduplo.=" mg/L ";
  		 		 			//$nilairata.=" mg/L ";
  						} else {
  		 		 			//$hasilakhirduplo.=" ".$arrayanalisissatuan[$data[JENISANALISIS]]." ";
  		 		 			//$nilairata.=" ".$arrayanalisissatuan[$data[JENISANALISIS]]." ";
  
  						}
  		 		 	}
   			 				
   					$arraykolomduplo[$arrayanalisis2[$data[JENISANALISIS]]."-".$data[JENISANALISIS]]= $hasilakhirduplo;
   					$arraykolomrata[$arrayanalisis2[$data[JENISANALISIS]]."-".$data[JENISANALISIS]]= $nilairata;
          
          }

			 				   
			 		$ii++;
			 	}
		 	}
		 	
 		 $tmpcetak.= "
 			<tr>
 				<td align=center>  $k</td>
 				<td align=center>   ".$arraynamasampel[$k]."</td>
         
         ";
		 	foreach ($arraykolom as $kk=>$vv) {
		 	  if (trim($vv)=="") {
          $vv="-";
         }
		 		$tmpcetak.= "<td align=center width=80 >$vv</td>";
		 		if ($duplo==1) {
		 		  $vv2=$vvrata="-";
  		 	  if (trim($arraykolomduplo[$kk])=="") {
            $vv2="-";
            $vvrata="-";
          } else {
            $vv2=$arraykolomduplo[$kk];
            $vvrata=$arraykolomrata[$kk];
          }
  		 		$tmpcetak.= "
           <td align=center width=80 $vv2</td>
           <td align=center width=80 >$vvrata</td>
           ";
         
         }
		 		$tmpcetak.= "<td align=center width=80 >".$arraykolombaku[$kk]."</td>";
		 	}
	 		$tmpcetak.= "
	 			</tr>
	 		";

		 }
 	}
 	 $tmpcetak.= "</table>";
 }
 

 $tmpcetak.= "				
 <br>
				<table $styletab>
					<tr align=left>
						<td >
							".$arraybahasa["Keterangan"]."  
						</td>
					</tr>
					<tr align=left>
						<td >
							".nl2br($keterangan)."
						</td>
					</tr>
					</table>


 <br>
				<table $styletab>
					<tr align=left>
						<td >
							".$arraybahasa["Catatan"]." : 
						</td>
					</tr>
					<tr align=left>
						<td >
							".nl2br($catatan)."
						</td>
					</tr>
					</table>

<br>
				<table $styletab>
					<tr align=left>
						<td width=33%>
						$kotalap, $tgllap-$blnlap-$thnlap
						<br>
						$jabatanttd</td>
						<td width=33%> </td>
						<td width=33%> </td>
					</tr>
					<tr align=left>
						<td width=33%><br><br><br><br></td>
						<td width=33%></td>
						<td width=33%></td>
					</tr>
					<tr align=left>
						<td width=33%>( $namattd ) </td>
						<td width=33%> </td>
						<td width=33%> </td>
					</tr>
				</table>
	</td>
	</tr>				
	</table>

";

echo $tmpcetak;

?>
