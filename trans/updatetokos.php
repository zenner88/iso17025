<?
if ($_SESSION[tingkats]!="D") {
    exit;
}

if ($aksi=="Update") {
		if ($pending!=1) {
	 		if ($statuspermintaan=='1') {
				$qf="STATUS='2',";
				$qf.="TGLTERIMASUP=NOW(),";
				$tmpstatus="Status : ".$arraystatuspermintaan[2];
			}
	 		if ($statuspermintaan=='4' && $updatestatus==1) {
				$qf.="STATUS='$statussup',";
				$tmpstatus="Status : ".$arraystatuspermintaan[$statussup];
			}
		} else {
			$tmpstatus="Status tetap";
		}

       if ($fileupload2!="") {
      		//$errmesg="File Perbaikan Program harus diisi";

           $q="SELECT  
            permintaan.ID FROM permintaan WHERE 
           	IDTRANS='$idupdate' AND permintaan.ID2='$idsupdate' ";
           $h=doquery($q,$koneksi) ;
          
          if (sqlnumrows($h)>0) {
              $d=sqlfetcharray($h);
            $idminta=$d[ID];
          }

    	   $str=file_get_contents($fileupload2);

      		$q="
      		INSERT INTO filesupervisor (ID,IDTRANS,NAMAFILESUPERVISOR,FILESUPERVISOR)
      		VALUES
          ('$idminta','$idupdate','$fileupload2_name','".mysql_real_escape_string($str)."')      		
          ";
          doquery($q,$koneksi) ;
          if (sqlaffectedrows($koneksi)<=0) {
        		$q="
        		UPDATE filesupervisor 
            SET
            NAMAFILESUPERVISOR='$fileupload2_name',
            FILESUPERVISOR='".mysql_real_escape_string($str)."'
            WHERE
            ID='$idminta' AND IDTRANS='$idupdate'
            
             ";
            doquery($q,$koneksi) ;
          
          }          
                $ketlog="Upload file referensi khusus. Kode Permintaan: $idupdate,Kode Jenis Uji: $idminta. Nama file: $fileupload2_name";
                buatlogiso(17,$ketlog,"",$users);

        } 



		if ($fileupload!="none") {
			if (isset($WINDIR)) {
				$fileupload=str_replace("\\\\","\\",$fileupload);
			}
			$namafile=basename($fileupload_name);	
			$qf.="FILE='$idsupdate$namafile',";
		}
		 $q="UPDATE permintaan 
			SET 
			$qf
			IDAN='$idan',
			IDIK='$idik',
			TGLTERIMASUP='$thns-$blns-$tgls',
			CATATANS='$catatans',
 			TGLUPDATE=NOW(),
			UPDATER='$users',
			HISTORY=CONCAT(IF(HISTORY IS NULL,'',HISTORY),CONCAT(NOW(),' Diupdate oleh Supervisor ($users/$namausers). $tmpstatus \n'))

 			WHERE ID2='$idsupdate' AND IDSUP='$users' AND (STATUS='1' OR STATUS='4')";
		doquery($q,$koneksi);
		echo mysql_error();
		if (sqlaffectedrows($koneksi)>0) {
 
			if ($fileupload!="none") {
				@unlink("file/$filelama");
				move_uploaded_file($fileupload,"file/$idsupdate$namafile");
			}
			$errmesg="Data Permintaan Analisis berhasil diupdate";

                $ketlog="Periksa Hasil Analisis Jenis Uji Permintaan. Kode Permintaan: $idsupdate";
                buatlogiso(15,$ketlog,$q,$users);

			//$idupdate=$id;
		} else {
			$errmesg="Data Permintaan Analisis tidak diupdate. ";
		}
 
	printmesg($errmesg);
}

 $q="SELECT minta.*,
 permintaan.*,permintaan.STATUS AS STATUSS ,jenisuji.RM
 FROM minta,permintaan LEFT JOIN jenisuji ON jenisuji.ID=permintaan.JENISANALISIS 
 WHERE 
	minta.ID=permintaan.IDTRANS
	AND
	IDTRANS='$idupdate' AND permintaan.ID2='$idsupdate'";
//$q="SELECT * FROM permintaan WHERE ID2='$idupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$idminta=$data[ID];
	$id=$data[ID2];
	$idklien=$data[IDKLIEN];
	$idan=$data[IDAN];
	$idman=$data[IDMAN];
	$sampel=$data[SAMPEL];
	$contoh=$data[CONTOH];
	$catatan=$data[CATATAN];
	$catatanm=$data[CATATANM];
	$catatans=$data[CATATANS];
	$catatana=$data[CATATANA];
	$metode=$data[RM];
	$idik=$data[IDIK];
 	$file=$data[FILE];
	$jenisanalisis=$data[JENISANALISIS];
	$statussup=$statuspermintaan=$data[STATUSS];
	$tmp=explode("-",$data[TANGGALDATANG]);
	$tglmasuk=$tmp[2];
	$blnmasuk=$tmp[1];
	$thnmasuk=$tmp[0];

	$tmp=explode("-",$data[TANGGALDEADLINE]);
	$tgld=$tmp[2];
	$blnd=$tmp[1];
	$thnd=$tmp[0];

	$tmp=explode("-",$data[TGLTERIMAMAN]);
	$tglm=$tmp[2];
	$blnm=$tmp[1];
	$thnm=$tmp[0];

	if ($data[TGLTERIMASUP]!="") {
		$tmp=explode("-",$data[TGLTERIMASUP]);
		$tgls=$tmp[2];
		$blns=$tmp[1];
		$thns=$tmp[0];
	}


	$tmp=explode("||",$data[DATA2]);
	$datax=tekstorumus($tmp[0]);
	$datay=tekstorumus($tmp[1]);
	$rumus=tekstorumus($data[DATA]);
	$rumusduplo=tekstorumus($data[DATADUPLO]);
	$duplo=$data[DUPLO];

	if ($jenisanalisis>=10 && $jenisanalisis<=23) {
			$hr=reglinear($datax,$datay);
			$rumus[b]=@(($rumus[s]-$hr[b])/$hr[a]);
	}

	if ($jenisanalisis<=30) {
  	$hasil=hasilanalis($rumus,$jenisanalisis);
	   $hasilduplo=hasilanalis($rumusduplo,$jenisanalisis);
	} else {
  	$hasil=$data[HASIL];
	 $hasilduplo=$data[HASIL2];
  }
	$nilaibaku=$data[NILAIBAKU];
	$rumusanalisis=$data[RUMUS];


}

echo "  
<h3>Update Data Permintaan Analisis";
		if ($statuspermintaan>=4 || $statuspermintaan==1) {
      echo "
      <font style='font-size:9pt'>
      <a href='#2'>[Analisis]</a>";
    }
echo "
</font>

</h3>
<form name=form action=index.php method=post ENCTYPE=\"MULTIPART/FORM-DATA\">
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=idupdate value='$idupdate'>
	<input type=hidden name=idsupdate value='$idsupdate'>
	<input type=hidden name=statuspermintaan value='$statuspermintaan'>
	<input type=hidden name=filelama value='$file'>
	
  <table  cellpadding=0 cellspacing=0 width=95%>
  <tr valign=top>
  <td width=50% align=left>

	<table   $border>
 		<tr>
			<td width=150  nowrap>
				Kode Sampel
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
				".$arraystatuspermintaan[$statuspermintaan]."";
		echo "
		  </td>
		</tr>
 	<tr>
		<td  >Tanggal Permintaan</td>
		<td>$tglmasuk-$blnmasuk-$thnmasuk
	</tr>
	<tr>
		<td  >Deadline Selesai</td>
		<td>$tgld-$blnd-$thnd

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
		<!--
 		<tr>
			<td>
				Catatan untuk Sampel
			</td>
			<td>
				".nl2br($sampel)."
			</td>
		</tr>
		-->
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
				Catatan Administrasi
			</td>
			<td>
				<b>".nl2br($catatan)."
			</td>
		</tr>
 		<tr>
			<td>
				Manager Teknis
			</td>
			<td>
				<b>".getnama($idman)."
			</td>
		</tr>
		<tr>
			<td  >Tanggal Terima</td>
			<td>$tglm-$blnm-$thnm
	
		</tr>		
 		<tr>
			<td>
				Catatan Manager Teknis
			</td>
			<td>
				<b>".nl2br($catatanm)." 
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
    
    ";
		

		
		echo "
		<tr>
			<td>Update terakhir oleh</td>
			<td>".getnama($data[UPDATER]).", $data[TGLUPDATE]</td>
		</tr>
    </table>

  </td>
  </tr>
   </table>

 <br> 
  <table  $border>
 
 ";
 
 if ($statuspermintaan==1 || $statuspermintaan==4) {
 
 echo "
 	
	<tr>
		<td  >Tanggal Terima</td>
		<td>
			<select class=teksbox name=tgls>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tgls==""){
							$cek="selected";
						}	elseif ($tgls==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blns>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blns==""){
							$cek="selected";
						} else						
						if ($i==$blns) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thns>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year] && $thns==""){
							$cek="selected";
						}	 else					
						if ($i==$thns) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>
	</tr>	
 	<tr>
			<td>
				Analis 
			</td>
			<td>
				<select name=idan >
				";
				foreach ($arrayanalis as $k=>$v) {
					if ($idan=="$k") {
						$cek="selected";
					}
					echo "<option $cek value='$k'>$v</option>";
					$cek="";
				}
				echo "
				</select>
			</td>
		</tr>
	<tr>
			<td>
				Instruksi Kerja
			</td>
			<td>
				<select name=idik >
				<option value=''>Tidak ada</option>
				";
				foreach ($arrayik as $k=>$v) {
					if ($idik=="$k") {
						$cek="selected";
					}
					echo "<option $cek value='$k'>$v</option>";
					$cek="";
				}
				if ($idik!="") {
					$q="SELECT NAMA, FILE FROM ik WHERE ID='$idik'";
					$hi=doquery($q,$koneksi);
					if (sqlnumrows($hi)>0) {
						$di=sqlfetcharray($hi);
						$hrefik="<a target=_blank href='../ik/file/$di[FILE]'>$idik - $di[NAMA]</a>";
					}
				}
				echo "
				</select><br>
				$hrefik
			</td>
		</tr>
 		<tr>
			<td>
				Catatan Supervisor
			</td>
			<td>
				<textarea name=catatans cols=50 rows=4>$catatans</textarea>
			</td>
		</tr> 
		<tr>
			<td>
				File Referensi/Lampiran (Umum)
			</td>
			<td>
				<input type=file name=fileupload >";
        
        if (file_exists("file/$file")) {
        echo "<br>
				<a href='file/$file' target=_blank>$file</a>";
				}
        echo "
			</td>
		</tr>
  <tr>
  <td>File Referensi/Lampiran Khusus ".$arrayanalisis[$jenisanalisis]."</td>
  <td><input type=file name=fileupload2 >";
  $q="SELECT NAMAFILESUPERVISOR FROM filesupervisor WHERE ID='$idminta' AND IDTRANS='$idupdate'";
  $hf=doquery($q,$koneksi);
  //echo mysql_error();
  if (sqlnumrows($hf)>0) {
    //echo "MMM";
    $df=sqlfetcharray($hf);
    echo "
      <a target=_blank href='dlsupervisor.php?id=$id&idtrans=$idupdate'>$df[NAMAFILESUPERVISOR]</a>
    ";
  }
  
  echo "
   </td>
  </tr>


		";
		
} else {
    // TIDAK BOLEH DIUPDATE
 echo "
 	
	<tr>
		<td  >Tanggal Terima</td>
		<td> $tgls-$blns-$thns </td>
 	</tr>	
 	<tr>
			<td>
				Analis 
			</td>
			<td>".$arrayanalis[$idan]."
 			</td>
		</tr>
	<tr>
			<td>
				Instruksi Kerja
			</td>
			<td>".$arrayik[$idik]." 
				$hrefik
			</td>
		</tr>
 		<tr>
			<td>
				Catatan Supervisor
			</td>
			<td>".nl2br($catatans)."
 			</td>
		</tr> 
		<tr>
			<td>
				File Referensi/Lampiran (Umum)
			</td>
			<td>
				 ";
        
        if (file_exists("file/$file")) {
        echo "<br>
				<a href='file/$file' target=_blank>$file</a>";
				}
        echo "
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
    echo "
      <a target=_blank href='dlsupervisor.php?id=$id&idtrans=$idupdate'>$df[NAMAFILESUPERVISOR]</a>
    ";
  }
  
  echo "
   </td>
  </tr>


		";
		
}		

		if ($statuspermintaan>=4 ) {
	 		echo "
 		<tr>
		<td colspan=2>
			<hr>
		</td>
	</tr>	 	
			<tr>
				<td colspan=2><b id='2'>Analisis</td>
			</tr>
 	 		<tr>
				<td>
					Catatan Analis 
				</td>
				<td>
					".nl2br($catatana)." 
					
				</td>
			</tr>
			";
			include "formanalisis.php";
		echo "
		$fanalisis

  <tr>
  <td>File Hasil Lainnya</td>
  <td>";
   $q="SELECT NAMAFILEANALIS FROM filehasilanalis WHERE ID='$idminta' AND IDTRANS='$idupdate'";
  $hf=doquery($q,$koneksi);
  if (sqlnumrows($hf)>0) {
    $df=sqlfetcharray($hf);
    echo  "
      <a target=_blank href='dlanalis.php?id=$id&idtrans=$idupdate'>$df[NAMAFILEANALIS]</a>
    ";
  }


	echo "
    </td></tr>

		 ";
		 }
			if ($statuspermintaan==4  ) {
     echo "
		
		<tr>
		  <td>Perubahan Status</td>
		  <td>";
				echo "
				<input type=checkbox name=updatestatus value=1>Update
 				hasil pemeriksaan: 
 				<!--
				<select name=statussup >
				";
				foreach ($arraystatussup as $k=>$v) {
					if ($statussup=="$k") {
						$cek="selected";
					}
					echo "<option $cek value='$k'>$v</option>";
					$cek="";
				}
				echo "
				</select>
				-->
				";
					if ($statussup!=5 && $statussup!=6) {
					 $statussup=6;
          }
				foreach ($arraystatussup as $k=>$v) {
					if ($statussup=="$k") {
						$cek="checked";
					}
					echo "<input type=radio $cek value='$k' name=statussup>$v ";
					$cek="";
				}
				echo "
				";
       echo "
      
      </td>
		</tr>";
					}


 if ($statuspermintaan==1 || $statuspermintaan==4) {
    echo "
		
		<tr>
			<td colspan=2>
			<br>
				<input type=checkbox name=pending value=1> Pending
				<input type=submit name=aksi value='Update'>
				<input type=reset value='Reset Isian'>
			</td>
		</tr>";
		}
    echo "
	</table>


</form name=form>
";
 
?>
