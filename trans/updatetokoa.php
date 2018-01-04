<?
if ($_SESSION[tingkats]!="E") {
    exit;
}
if ($aksi=="Update") {
 			$qf.="STATUS='$statusanalis',";
			$tmpstatus="Status : ".$arraystatuspermintaan[$statusanalis];
			$qf.="TGLTERIMAAN=NOW(),";
		if (is_array($rumus)) {
			$qr=" DATA=' ";
			foreach ($rumus as $k=>$v) {
				$qr.="$k=$v;";
			}
			$qr.="',";
		}

		if (is_array($rumusduplo)) {
			$qrduplo=" DATADUPLO=' ";
			foreach ($rumusduplo as $k=>$v) {
				$qrduplo.="$k=$v;";
			}
			$qrduplo.="',";
		}

 		if (is_array($datax) && is_array($datay)) {
			$count=sizeof($datax);
			for ($ii=0;$ii<10;$ii++) {
				if (trim($datax[$ii])=="") {
					unset($datax[$ii]);
					unset($datay[$ii]);
				}
				if (trim($datay[$ii])=="") {
					unset($datax[$ii]);
					unset($datay[$ii]);
				}
			}
	 		if (is_array($datax) && is_array($datay)) {
				$qr.=" DATA2=' ";
				foreach ($datax as $k=>$v) {
					$qr.="$k=$v;";
				}
				$qr.="||";
				foreach ($datay as $k=>$v) {
					$qr.="$k=$v;";
				}
				$qr.="',";
 				//include "kurva.php";
			}
		}


       if ($fileupload!="") {
      		//$errmesg="File Perbaikan Program harus diisi";

           $q="SELECT  
            permintaan.ID FROM permintaan WHERE 
           	IDTRANS='$idupdate' AND permintaan.ID2='$idsupdate' ";
           $h=doquery($q,$koneksi) ;
          
          if (sqlnumrows($h)>0) {
              $d=sqlfetcharray($h);
            $idminta=$d[ID];
          }

    	   $str=file_get_contents($fileupload);

      		$q="
      		INSERT INTO filehasilanalis (ID,IDTRANS,NAMAFILEANALIS,FILEANALIS)
      		VALUES
          ('$idminta','$idupdate','$fileupload_name','".mysql_real_escape_string($str)."')      		
          ";
          doquery($q,$koneksi) ;
          if (sqlaffectedrows($koneksi)<=0) {
        		$q="
        		UPDATE filehasilanalis 
            SET
            NAMAFILEANALIS='$fileupload_name',
            FILEANALIS='".mysql_real_escape_string($str)."'
            WHERE
            ID='$idminta' AND IDTRANS='$idupdate'
            
             ";
            doquery($q,$koneksi) ;
          
          }          
                $ketlog="Upload file hasil. Kode Permintaan: $idupdate,Kode Jenis Uji: $idminta. Nama file: $fileupload_name";
                buatlogiso(18,$ketlog,"",$users);

        } 


		$q="UPDATE permintaan 
			SET 
			$qf
 			$qr
 			$qrduplo
  			CATATANA='$catatana',
 			TGLTERIMAAN='$thna-$blna-$tgla',
			METODE='$metode',
 			TGLUPDATE=NOW(),
			UPDATER='$users',
			HISTORY=CONCAT(IF(HISTORY IS NULL,'',HISTORY),CONCAT(NOW(),' Diupdate oleh Analis ($users/$namausers). $tmpstatus \n'))

 			WHERE ID2='$idsupdate' AND IDAN='$users'  AND (STATUS='2' OR STATUS='3' OR STATUS='6')";
		doquery($q,$koneksi);
//			NILAIBAKU='$nilaibaku',

		//echo mysql_error();
		if (sqlaffectedrows($koneksi)>0) {
 			$errmesg="Data Permintaan Analisis berhasil diupdate";
                $ketlog="Periksa Hasil Analisis Jenis Uji Permintaan. Kode Permintaan: $idsupdate";
                buatlogiso(16,$ketlog,$q,$users);
 		} else {
			$errmesg="Data Permintaan Analisis tidak diupdate. ";
		}
 
}


 $q="SELECT minta.*,
  permintaan.*,
  permintaan.STATUS AS STATUSS ,jenisuji.RM
  FROM minta,permintaan LEFT JOIN jenisuji ON jenisuji.ID=permintaan.JENISANALISIS 
  WHERE 
	minta.ID=permintaan.IDTRANS
	AND
	IDTRANS='$idupdate' AND permintaan.ID2='$idsupdate' AND IDAN='$users'";
 $h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$idminta=$data[ID];
	$id=$data[ID2];
	$idsup=$data[IDSUP];
  	$sampel=$data[SAMPEL];
  	$contoh=$data[CONTOH];
	$catatan=$data[CATATAN];
	$catatanm=$data[CATATANM];
	$catatans=$data[CATATANS];
	$catatana=$data[CATATANA];
	//$metode=$data[METODE];
	$metode=$data[RM];
	$jenisanalisis=$data[JENISANALISIS];
	$statusanalis=$statuspermintaan=$data[STATUSS];
	$idik=$data[IDIK];
 	$file=$data[FILE];
	$tmp=explode("-",$data[TANGGALDATANG]);
	$tglmasuk=$tmp[2];
	$blnmasuk=$tmp[1];
	$thnmasuk=$tmp[0];

	$tmp=explode("-",$data[TANGGALDEADLINE]);
	$tgld=$tmp[2];
	$blnd=$tmp[1];
	$thnd=$tmp[0];

	$tmp=explode("-",$data[TANGGALSELESAI]);
	$tgls=$tmp[2];
	$blns=$tmp[1];
	$thns=$tmp[0];
	if ($tgls>0) { 	
		$tglselesai="$tgls-$blns-$thns";
	} else {
		$tglselesai="-";
	}

 		$tmp=explode("-",$data[TGLTERIMASUP]);
		$tgls=$tmp[2];
		$blns=$tmp[1];
		$thns=$tmp[0];
 
	if ($data[TGLTERIMAAN]!="") {
		$tmp=explode("-",$data[TGLTERIMAAN]);
		$tgla=$tmp[2];
		$blna=$tmp[1];
		$thna=$tmp[0];
	}
	if (trim($data[DATA2])=="" || trim($data[DATA2])=="||") {
		$q="SELECT permintaan.DATA2 FROM permintaan,minta WHERE 
			minta.ID=permintaan.IDTRANS
			AND
			IDTRANS='$idupdate' AND  IDAN='$users' AND JENISANALISIS='$data[JENISANALISIS]'
			AND (TRIM(permintaan.DATA2)!='||' AND TRIM(permintaan.DATA2)!='')
			LIMIT 0,1
			";
			 $h2=doquery($q,$koneksi) ;
			
			if (sqlnumrows($h2)>0) {
				$d2=sqlfetcharray($h2);
				$data[DATA2]=$d2[DATA2];
			}
	}

	if (trim($data[DATA2])!="" && trim($data[DATA2])!="||") {
		$q="
			UPDATE permintaan SET DATA2='$data[DATA2]' WHERE
			IDTRANS='$idupdate' AND  JENISANALISIS='$data[JENISANALISIS]'
		";
		doquery($q,$koneksi) ;
	}

	$tmp=explode("||",$data[DATA2]);
	$datax=tekstorumus($tmp[0]);
	$datay=tekstorumus($tmp[1]);
	$rumus=tekstorumus($data[DATA]);
	$rumusduplo=tekstorumus($data[DATADUPLO]);
	$duplo=$data[DUPLO];
 	//echo $rumus[b]."<br>";
	if ($jenisanalisis>=10 && $jenisanalisis<=23) {
			$hr=reglinear($datax,$datay);
			$rumus[b]=@(($rumus[s]-$hr[b])/$hr[a]);
	}
 	//echo $rumus[b];

	$hasil=hasilanalis($rumus,$jenisanalisis);
	$hasilduplo=hasilanalis($rumusduplo,$jenisanalisis);
	$nilaibaku=$data[NILAIBAKU];

		$q="UPDATE permintaan 
			SET 
      HASIL='$hasil'  ,
      HASIL2='$hasilduplo',
      RUMUS='$rumusanalisis'
 			WHERE ID2='$idsupdate' AND IDAN='$users'";
		doquery($q,$koneksi);
		echo mysql_error();


}

printmesg($errmesg);

$tmpcetak .= "
<h3>Update Data Permintaan Analisis
<font style='font-size:9pt'>
<a href='#2'>[Analisis]</a>
</font>

</h3>";

 
$tmpcetak .= "
<form ENCTYPE=\"MULTIPART/FORM-DATA\" name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=idupdate value='$idupdate'>
	<input type=hidden name=idsupdate value='$idsupdate'>
 	<input type=hidden name=jenisanalisis value='$jenisanalisis'>


  <table  cellpadding=0 cellspacing=0 width=95%>
  <tr valign=top>
  <td width=50% align=left>

   	<table $border>
		<tr>
			<td width=150  nowrap>
				Kode
			</td>
			<td>
				<input type=hidden name=id size=5 value='$id'><b>$id
		</tr>
		<tr>
			<td width=150  nowrap>
				Sampel
			</td>
			<td>
			<b>$contoh
		</tr>
		<tr>
			<td width=150  nowrap>
				Status
			</td>
			<td>
				".$arraystatuspermintaan[$statuspermintaan]."
		</tr>
 	<tr>
		<td  >Tanggal Permintaan</td>
		<td>$tglmasuk-$blnmasuk-$thnmasuk
	</tr>
	<tr>
		<td  >Deadlile Selesai</td>
		<td>$tgld-$blnd-$thnd

	</tr>		
	<tr>
		<td  >Tanggal Selesai</td>
		<td>$tglselesai

	</tr>		
	<tr>
			<td>
				Kelompok Jenis Uji
			</td>
			<td>".$arraykelompokjenisuji[$arraykelompokanalisis[$jenisanalisis]]."			
			</td>
		</tr>
	<tr>
			<td>
				Jenis Analisis
			</td>
			<td>".$arrayanalisis[$jenisanalisis]."			
			</td>
		</tr>
<!-- 		<tr>
			<td>
				Catatan untuk Sampel
			</td>
			<td>
				".nl2br($sampel)."
			</td>
		</tr> -->
     </table>
  </td>
  <td width=50%>
  	<table $border>
		<tr>
			<td>
				Output
			</td>
			<td>
				".$arrayduplo[$duplo]."
			</td>
		</tr>
  		<tr>
			<td>
				Supervisor
			</td>
			<td>
				".getnama($idsup)."
			</td>
		</tr>
	<tr>
		<td  >Tanggal Terima</td>
		<td>$tgls-$blns-$thns

	</tr>		
	<tr>
			<td>
				Instruksi Kerja
			</td>
			<td>
 				";
 				if ($idik!="") {
					$q="SELECT NAMA, FILE FROM ik WHERE ID='$idik'";
					$hi=doquery($q,$koneksi);
					if (sqlnumrows($hi)>0) {
						$di=sqlfetcharray($hi);
						$hrefik="<a target=_blank href='../ik/file/$di[FILE]'>$idik - $di[NAMA]</a>";
					} else {
						$hrefik=" - ";
					}
				}
				$tmpcetak .= "
				$hrefik
			</td>
		</tr>	 		
 		<tr>
			<td>
				Metode yang digunakan
			</td>
			<td>
				$metode
			</td>
		</tr>
 		<tr>
			<td>
				Catatan Supervisor
			</td>
			<td>
				<b>".nl2br($catatans)."
			</td>
		</tr>
		<tr>
			<td>
				File Referensi/Lampiran Umum
			</td>
			<td>";
        
        if (file_exists("file/$file")) {
        $tmpcetak .= " 
 				<a href='file/$file' target=_blank>$file</a>";
         }
         $tmpcetak .= "
			</td>
		</tr>
	<tr>	
  <td>File Referensi/Lampiran Khusus ".$arrayanalisis[$jenisanalisis]."</td>
  <td> ";
  $q="SELECT NAMAFILESUPERVISOR FROM filesupervisor WHERE ID='$idminta' AND IDTRANS='$idupdate'";
  $hf=doquery($q,$koneksi);
  //echo mysql_error();
  if (sqlnumrows($hf)>0) {
    //echo "MMM";
    $df=sqlfetcharray($hf);
    $tmpcetak .= "
      <a target=_blank href='dlsupervisor.php?id=$id&idtrans=$idupdate'>$df[NAMAFILESUPERVISOR]</a>
    ";
  }
  
  $tmpcetak .= "
  
  </td>
  </tr>


		 


 		<tr>
			<td>Update terakhir oleh</td>
			<td>".getnama($data[UPDATER]).", $data[TGLUPDATE]</td>
		</tr>
    </table>

  </td>
  </tr>
   </table>


";
	if ($statuspermintaan==2 || $statuspermintaan==3 || $statuspermintaan==6) {
	 	$tmpcetak .= "
 <br> 
  <table  $border>
	<tr>
		<td colspan=2>
			<hr>
		</td>
	</tr>	 	
	<tr>
		<td  >Tanggal Terima</td>
		<td>
			<select class=teksbox name=tgla>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tgla==""){
							$cek="selected";
						}	elseif ($tgla==$i) {
							$cek="selected";
						} 
						$tmpcetak .= "<option value=$i $cek>$i</option>";
						$cek="";
					}
			$tmpcetak .= "
			</select>-			
			<select class=teksbox name=blna>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blna==""){
							$cek="selected";
						} else						
						if ($i==$blna) {
							$cek="selected";
						} 
						$tmpcetak .= "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			$tmpcetak .= "
			</select>-
			<select class=teksbox name=thna>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year] && $thna==""){
							$cek="selected";
						}	 else					
						if ($i==$thna) {
							$cek="selected";
						} 
						$tmpcetak .= "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			$tmpcetak .= "
			</select>
	</tr>		
	<tr>
				<td>
					Catatan Analis
				</td>
				<td>
					<textarea name=catatana cols=50 rows=4>$catatana</textarea>
				</td>
			</tr>
 			<tr>
				<td colspan=2><b id='2'>Analisis</td>
			</tr>
      
      ";

      
	 		include "analisis.php";
			
			$tmpcetak .= "
					$analisis

  <tr>
  <td>File Hasil Lainnya</td>
  <td><input type=file name=fileupload >";
  $q="SELECT NAMAFILEANALIS FROM filehasilanalis WHERE ID='$idminta' AND IDTRANS='$idupdate'";
  $hf=doquery($q,$koneksi);
  if (sqlnumrows($hf)>0) {
    $df=sqlfetcharray($hf);
    $tmpcetak .= "
      <a target=_blank href='dlanalis.php?id=$id&idtrans=$idupdate'>$df[NAMAFILEANALIS]</a>
    ";
  }
  
  $tmpcetak .= "
  
  </td>
  </tr>
  
	<tr>
				<td>
					Status Analisis
				</td>
				<td>
 					<!-- <select name=statusanalis >
					";
					foreach ($arraystatusanalis as $k=>$v) {
						if ($statusanalis=="$k") {
							$cek="selected";
						}
						$tmpcetak .= "<option $cek value='$k'>$v</option>";
						$cek="";
					}
					$tmpcetak .= "
					</select>
					-->
					";
					if ($statusanalis!=3 && $statusanalis!=4) {
					 $statusanalis=3;
          }
					foreach ($arraystatusanalis as $k=>$v) {
						if ($statusanalis=="$k") {
							$cek="checked";
						}
						$tmpcetak .= "<input type=radio name=statusanalis $cek value='$k'>$v ";
						$cek="";
					}
					$tmpcetak .= "

				</td>
			</tr>
		<tr>
			<tr>
				<td colspan=2>
				<br>
 					<input type=submit name=aksi value='Update'>
					<input type=reset value='Reset Isian'>
				</td>
			</tr>
			
			";
			
			
			
			
			
		} else {
	 	$tmpcetak .= "
 <br> 
  <table  $border>
  	 		<tr>
				<td>
					Tanggal Terima
				</td>
				<td>
					$tgls-$blna-$thna
				</td>
			</tr>
 	 		<tr>
				<td>
					Catatan Analis
				</td>
				<td>
					".nl2br($catatana)."
				</td>
			</tr>
			<tr>
				<td colspan=2><b id='2'>Analisis</td>
			</tr>";
			include "formanalisis.php";

	$tmpcetak .= "
		$fanalisis

 
  <tr>
  <td>File Hasil Lainnya</td>
  <td>";
  $q="SELECT NAMAFILEANALIS FROM filehasilanalis WHERE ID='$idminta' AND IDTRANS='$idupdate'";
  $hf=doquery($q,$koneksi);
  if (sqlnumrows($hf)>0) {
    $df=sqlfetcharray($hf);
    $tmpcetak .= "
      <a target=_blank href='dlanalis.php?id=$id&idtrans=$idupdate'>$df[NAMAFILEANALIS]</a>
    ";
  }
	$tmpcetak .= "
    </td></tr>
  ";

		}



	$tmpcetak .= "
	</table>


</form name=form>
";


echo $tmpcetak;
/*
		<tr>
			<td>
				NPWP
			</td>
			<td>
				<input type=text name=npwp size=25 value='$npwp'>
			</td>
		</tr>
		<tr>
			<td>
				Jangka Waktu Pembayaran
			</td>
			<td>
				<input type=text name=jangkabayar size=4 value='$jangkabayar'> hari
			</td>
		</tr>
		<tr>
			<td>
				Limit Kredit
			</td>
			<td>
				Rp. <input type=text name=limit size=10 value='$limit'> 
			</td>
		</tr>
*/
?>
