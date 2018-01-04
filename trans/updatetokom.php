<?
if ($_SESSION[tingkats]!="C") {
    exit;
}

if ($aksi=="Update") {
	if (trim($id2)=="")	{
		$errmesg="Kode Sampel2 Harus Diisi";
	} else {
		if ($pending!=1) {
			if ($statuspermintaan==0) {
				$qf.="STATUS='1',";
				$tmpstatus="Status : ".$arraystatuspermintaan[1];
	 		}
	 		if ($statuspermintaan=='5' && $updatestatus==1) {
				$qf.="STATUS='$statusman',";
				$tmpstatus="Status : ".$arraystatuspermintaan[$statusman];
			}
	 		if ($statuspermintaan=='8' && $updatestatus==1) {
				$qf.="STATUS='$statusman',";
				$tmpstatus="Status : ".$arraystatuspermintaan[$statusman];
			}
		} else {
			$tmpstatus="Status tetap";
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
			ID2='$id2',
			$qf
			IDSUP='$idsup',
			TGLTERIMAMAN='$thnm-$blnm-$tglm',
			CATATANM='$catatanm',
			IDIK='$idik',
 			TGLUPDATE=NOW(),
			UPDATER='$users',
			HISTORY=CONCAT(IF(HISTORY IS NULL,'',HISTORY),CONCAT(NOW(),' Diupdate oleh Manajer Teknis ($users/$namausers). $tmpstatus \n'))
			WHERE ID='$idsupdate'  AND 
			IDTRANS='$idupdate' AND (STATUS='0' OR STATUS='5' OR STATUS='8') ";
		doquery($q,$koneksi);
 		if (sqlaffectedrows($koneksi)>0) {

      $ketlog="Periksa Hasil Analisis Jenis Uji Permintaan. 
      Kode Permintaan: $idupdate, Kode Jenis Uji: $idsupdate";
      buatlogiso(14,$ketlog,$q,$users);

 
			if ($fileupload!="none") {
				@unlink("file/$filelama");
				move_uploaded_file($fileupload,"file/$idsupdate$namafile");
			}
			$errmesg="Data Sampel berhasil diupdate";
			//$idupdate=$id;
		} else {
			$errmesg="Data Sampel tidak diupdate. ";
		}
	}
	printmesg($errmesg);
}

 $q="SELECT minta.*,
 permintaan.*,
 permintaan.STATUS AS STATUSS, DUPLO,jenisuji.RM
  FROM minta,permintaan LEFT JOIN jenisuji ON jenisuji.ID=permintaan.JENISANALISIS
  WHERE 
	minta.ID=permintaan.IDTRANS
	AND
	IDTRANS='$idupdate' AND permintaan.ID='$idsupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$id2=$data[ID2];
	$idklien=$data[IDKLIEN];
	$idsup=$data[IDSUP];
	$iduser=$data[IDUSER];
	$sampel=$data[SAMPEL];
	$contoh=$data[CONTOH];
	$catatan=$data[CATATAN];
	$catatanm=$data[CATATANM];
	$catatans=$data[CATATANS];
//	$metode=$data[METODE];
	$metode=$data[RM];
	$idik=$data[IDIK];
 	$file=$data[FILE];
	$jenisanalisis=$data[JENISANALISIS];
	$statusman=$statuspermintaan=$data[STATUSS];
	
	$tmp=explode("-",$data[TANGGALDATANG]);
	$tglmasuk=$tmp[2];
	$blnmasuk=$tmp[1];
	$thnmasuk=$tmp[0];

	$tmp=explode("-",$data[TANGGALDEADLINE]);
	$tgld=$tmp[2];
	$blnd=$tmp[1];
	$thnd=$tmp[0];

	if ($data[TGLTERIMAMAN]!="") {
		$tmp=explode("-",$data[TGLTERIMAMAN]);
		$tglm=$tmp[2];
		$blnm=$tmp[1];
		$thnm=$tmp[0];
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
		if ($statuspermintaan>="5") {
      echo "
      <font style='font-size:9pt'>
      <a href='#2'>[Analisis]</a>
      </font>";
    }
echo "
</h3>
<form name=form action=index.php method=post  ENCTYPE=\"MULTIPART/FORM-DATA\">
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
				Kode Permintaan
			</td>
			<td>
				<input type=hidden name=id size=5 value='$id'>$id
				&nbsp;&nbsp; <a href='index.php?idupdate=$id&pilihan=laporan'>Buat Laporan</a>
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
			<td width=150  nowrap>
				Klien
			</td>
			<td>
				".getnamatoko($idklien)."
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
    </table>
  </td>
  <td width=50%>
    	<table $border>



 		<tr>
			<td width=150>
				Sampel
			</td>
			<td>
				$contoh
			</td>
		</tr>
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
				Administrator
			</td>
			<td>
				".getnama($iduser)."
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
				Catatan Supervisor
			</td>
			<td>
				<b>".nl2br($catatans)."
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
			<td>Update terakhir oleh</td>
			<td>".getnama($data[UPDATER]).", $data[TGLUPDATE]
		</tr>
  </table>

  </td>
  </tr>
   </table>

 <br> 
  <table  $border>";
 if ($statuspermintaan==0 || $statuspermintaan==5 || $statuspermintaan==8) {

  echo "
 	<tr>
		<td  >Tanggal Terima</td>
		<td>
			<select class=teksbox name=tglm>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tglm==""){
							$cek="selected";
						}	elseif ($tglm==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blnm>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blnm==""){
							$cek="selected";
						} else						
						if ($i==$blnm) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thnm>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year] && $thnm==""){
							$cek="selected";
						}	 else					
						if ($i==$thnm) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>
	</tr>	
		<tr>
			<td width=150  nowrap>
				Kode Sampel 1
			</td>
			<td>
				$idsupdate
		</tr>";
		if ($id2=="") {
        $id2=$rand=strtoupper(substr(uniqid(rand(),TRUE),0,10));
    }
    echo "
		<tr>
			<td width=150  nowrap>
				Kode Sampel 2
			</td>
			<td>
				<input type=text name=id2 size=15 maxlength=10 value='$id2'>
		</tr>
	<tr>
			<td>
				Supervisor
			</td>
			<td>
				<select name=idsup >
				";
				foreach ($arraysupervisor as $k=>$v) {
					if ($idsup=="$k") {
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
				Catatan Manager Teknis  untuk Supervisor
			</td>
			<td>
				<textarea name=catatanm cols=50 rows=4>$catatanm</textarea>
			</td>
		</tr>
		<tr>
			<td>
				File Referensi/Lampiran Umum
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
  <td>File Referensi/Lampiran Khusus ".$arrayanalisis[$jenisanalisis]." (dari Supervisor)</td>
  <td> ";
  $q="SELECT NAMAFILESUPERVISOR FROM filesupervisor WHERE ID='$id' AND IDTRANS='$idupdate'";
  $hf=doquery($q,$koneksi);
    //echo mysql_error();
  if (sqlnumrows($hf)>0) {
    //echo "MMM";
    $df=sqlfetcharray($hf);
    echo  "
      <a target=_blank href='dlsupervisor.php?id=$id2&idtrans=$idupdate'>$df[NAMAFILESUPERVISOR]</a>
    ";
  }
  
  echo   "
  
  </td>
  </tr>


		";
		
		} else {
    
  echo "
 	<tr>
		<td  >Tanggal Terima</td>
		<td>$tglm-$blnm-$thnm</td>	</tr>	
		<tr>
			<td width=150  nowrap>
				Kode Sampel 1
			</td>
			<td>
				$idsupdate
		</tr>";
		if ($id2=="") {
        $id2=$rand=strtoupper(substr(uniqid(rand(),TRUE),0,10));
    }
    echo "
		<tr>
			<td width=150  nowrap>
				Kode Sampel 2
			</td>
			<td>$id2 
		</tr>
	<tr>
			<td>
				Supervisor
			</td>
			<td>".$arraysupervisor[$idsup]." 
			</td>
		</tr>
	<tr>
			<td>
				Instruksi Kerja
			</td>
			<td>".$arrayik[$idik];
				if ($idik!="") {
					$q="SELECT NAMA, FILE FROM ik WHERE ID='$idik'";
					$hi=doquery($q,$koneksi);
					if (sqlnumrows($hi)>0) {
						$di=sqlfetcharray($hi);
						$hrefik="<a target=_blank href='../ik/file/$di[FILE]'>$idik - $di[NAMA]</a>";
					}
				}
				echo " 
				$hrefik
			</td>
		</tr>


  		<tr>
			<td>
				Catatan Manager Teknis  untuk Supervisor
			</td>
			<td>".nl2br($catatanm)." </td>
		</tr>
		<tr>
			<td>
				File Referensi/Lampiran Umum
			</td>
			<td>
				 ";
        
        if (file_exists("file/$file")) {
        echo " 
				<a href='file/$file' target=_blank>$file</a>";
        }
        echo " 
			</td>
		</tr>
	<tr>	
  <td>File Referensi/Lampiran Khusus ".$arrayanalisis[$jenisanalisis]." (dari Supervisor)</td>
  <td> ";
  $q="SELECT NAMAFILESUPERVISOR FROM filesupervisor WHERE ID='$id' AND IDTRANS='$idupdate'";
  $hf=doquery($q,$koneksi);
    //echo mysql_error();
  if (sqlnumrows($hf)>0) {
    //echo "MMM";
    $df=sqlfetcharray($hf);
    echo  "
      <a target=_blank href='dlsupervisor.php?id=$id2&idtrans=$idupdate'>$df[NAMAFILESUPERVISOR]</a>
    ";
  }
  
  $tmpcetak .= "
  
  </td>
  </tr>


		";
    
    }

		if ($statuspermintaan>=5 ) {
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
   <tr>
  <td>File Hasil Lainnya</td>
  <td>";
  $q="SELECT NAMAFILEANALIS FROM filehasilanalis WHERE ID='$id' AND IDTRANS='$idupdate'";
  $hf=doquery($q,$koneksi);
  if (sqlnumrows($hf)>0) {
    $df=sqlfetcharray($hf);
    $tmpcetak .= "
      <a target=_blank href='dlanalis.php?id=$id2&idtrans=$idupdate'>$df[NAMAFILEANALIS]</a>
    ";
  }
	$tmpcetak .= "
    </td></tr>

      <td>Perubahan Status</td>
      <td>";
			if ($statuspermintaan==5) {
				echo "
				<input type=checkbox name=updatestatus value=1>Update
 				hasil pemeriksaan: 
				<!-- <select name=statusman >
				";
				foreach ($arraystatusman as $k=>$v) {
					if ($statusman=="$k") {
						$cek="selected";
					}
					echo "<option $cek value='$k'>$v</option>";
					$cek="";
				}
				echo "
				</select>
				-->
				";
					if ($statusman!=4 && $statusman!=7) {
					 $statusman=4;
          }
				foreach ($arraystatusman as $k=>$v) {
					if ($statusman=="$k") {
						$cek="checked";
					}
					echo "<input type=radio name=statusman $cek value='$k'>$v ";
					$cek="";
				}
				echo "
				";
			}
			if ($statuspermintaan=="8") {
				echo "
					=> 
					<input type=radio name=statusman value=1 checked> Teruskan ke Supervisor
					<input type=radio name=statusman value=7> Kembali ke Administrasi
					<input type=checkbox name=updatestatus value=1>update
				";
			}
      
      echo "</td>
    </tr>";
			}
    
 if ($statuspermintaan==0 || $statuspermintaan==5 || $statuspermintaan==8) {
    echo "
		<tr>
			<td colspan=2>
			<br>
				<input type=checkbox name=pending value=1> Pending (Status tidak diubah)
				<input type=submit name=aksi value='Update'>
				<input type=reset value='Reset Isian'> 
			<a target=_blank href='his.php?idsupdate=$idsupdate&idupdate=$idupdate'>lihat history
			</td>
			</td>
		</tr>";
	}
  echo "
	</table>


</form name=form>
";
 
?>
