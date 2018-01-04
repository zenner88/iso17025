<?
if ($_SESSION[tingkats]!="C") {
    exit;
}

     if ($aksi=="Update Tanpa Ganti Status") {
        		 $q="UPDATE minta SET CATATANMT='$catatanmt',
      			TANGGALDEADLINE='$thnd-$blnd-$tgld',
       			TGLUPDATE=NOW(),
      			UPDATER='$users' 
             WHERE ID='$idtrans'";
        		doquery($q,$koneksi);
        		if (sqlaffectedrows($koneksi)>0) {
            $ketlog="Update Permintaan. Kode Permintaan: $idtrans";
            buatlogiso(14,$ketlog,$q,$users);
              $errmesg="Permintaan analisis telah diupdate.";
            	printmesg($errmesg);
            
            }
     }

     if ($aksi=="Update dan Kembalikan ke Admin") {
        		$q="UPDATE minta SET CATATANMT='$catatanmt',
        		STATUS='3',
      			TANGGALDEADLINE='$thnd-$blnd-$tgld',
       			TGLUPDATE=NOW(),
      			UPDATER='$users' 
             WHERE ID='$idtrans'";
        		doquery($q,$koneksi);
        		if (sqlaffectedrows($koneksi)>0) {
            $ketlog="Update Permintaan. Ganti Status kembali ke Administrasi. Kode Permintaan: $idtrans";
            buatlogiso(14,$ketlog,$q,$users);
              $errmesg="Permintaan analisis telah diupdate dan dikembalikan ke Administrasi.";
            	printmesg($errmesg);
            
            }
     }


     if ($aksi=="Update") {
     
      if (is_array($pilihkelompok)) {
        $qkelompok=" AND  (";
        foreach ($pilihkelompok as $k=>$v) {
          $qkelompok.=" jenisuji.IDKELOMPOK='$k' OR";
          if ("$k"=="0") {
            $qkelompok.=" jenisuji.IDKELOMPOK IS NULL OR";
          }
        }
        $qkelompok.=")";
        $qkelompok=str_replace("OR)",")",$qkelompok);
     
      $berhasil=0;
      $idupdate=$idtrans;
     $q="SELECT permintaan.* FROM permintaan 
     LEFT JOIN jenisuji ON jenisuji.ID=permintaan.JENISANALISIS
     WHERE IDTRANS='$idupdate' AND (permintaan.STATUS='0' OR permintaan.STATUS='8') 
     $qkelompok
     ";
     $h=doquery($q,$koneksi);
     if (sqlnumrows($h)>0) {
        while ($d=sqlfetcharray($h)) {
            $qf="";
            $statuspermintaan=$statusman=$d[STATUS];
            $idsupdate=$d[ID];
            $filelama=$d[FILE];
            
            $id2=$rand=strtoupper(substr(uniqid(rand(),TRUE),0,10));
            //echo  $id2."<br>";    		
             $errmesg="Kode Sampel2 Harus Diisi";
         		if ($pending!=1) {
        			if ($statuspermintaan==0) {
        				$qf.="STATUS='1',";
        				$tmpstatus="Status : ".$arraystatuspermintaan[1];
        	 		}
         		} else {
        			$tmpstatus="Status tetap";
        		}
        		if ($fileupload!="") {
        			if (isset($WINDIR)) {
        				$fileupload=str_replace("\\\\","\\",$fileupload);
        			}
        			$namafile=basename($fileupload_name);	
        			$qf.="FILE='$idsupdate$namafile',";
        		}
        		$q="UPDATE permintaan 
        			SET 
        			ID2=IF(ID2 IS NULL OR ID2='','$id2',ID2),
        			$qf
        			IDSUP='$idsup',
        			TGLTERIMAMAN=CURDATE(),
        			CATATANM='$catatanm',
        			IDIK='$idik',
         			TGLUPDATE=NOW(),
        			UPDATER='$users',
        			HISTORY=CONCAT(IF(HISTORY IS NULL,'',HISTORY),CONCAT(NOW(),' Diupdate oleh Manajer Teknis ($users/$namausers). $tmpstatus \n'))
        			WHERE ID='$idsupdate'  AND 
        			IDTRANS='$idupdate'  ";
        		doquery($q,$koneksi);
        		
        		//echo mysql_error();
         		if (sqlaffectedrows($koneksi)>0) {
         
        			if ($fileupload!="") {
        				@unlink("file/$filelama");
        				move_uploaded_file($fileupload,"file/$idsupdate$namafile");
        			}
                $ketlog="Update Jenis Uji Permintaan, status ke Supervisor. Kode Permintaan: $idupdate, Kode Jenis Uji: $idsupdate";
                buatlogiso(14,$ketlog,$q,$users);
          		  $berhasil++;
        		}  
         }
      }
      $errmesg="$berhasil Data jenis uji telah diupdate.";
    	printmesg($errmesg);
    	} else {
    	   $errmesg="Kelompok Jenis Uji Harus Dipilih!!";
    	 printmesg($errmesg);
      
      }
    }
    
 
		 $q="SELECT 
		minta.*,permintaan.*,jenisuji.IDKELOMPOK,
		minta.ID,permintaan.ID AS IDS,
		permintaan.STATUS AS STATUSS,
		DATE_FORMAT(TANGGALDATANG,'%d-%m-%Y') AS TGLMASUK,
 		DATE_FORMAT(minta.TANGGALDEADLINE,'%d-%m-%Y') AS TGLDEADLINE,
 		DATE_FORMAT(minta.TANGGALSELESAI,'%d-%m-%Y') AS TGLSELESAI
		 FROM minta ,permintaan LEFT JOIN jenisuji ON jenisuji.ID=permintaan.JENISANALISIS
		WHERE 
		minta.ID=permintaan.IDTRANS AND
		IDMAN='$users' AND (permintaan.STATUS='0' OR permintaan.STATUS='5' OR permintaan.STATUS='8')
		AND minta.STATUS=0 
 		ORDER BY minta.ID,jenisuji.IDKELOMPOK,jenisuji.NAMA";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<h4 id='2'>Analisis Yang Harus Ditanggapi</h4>";
			echo("<p class=judulhaltabel>".$judul."</p>");
			
			$i=1;
			$kodelama=$idkelompok="";
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);

    	$tmp=explode("-",$data[TANGGALDEADLINE]);
    	$tgld=$tmp[2];
    	$blnd=$tmp[1];
    	$thnd=$tmp[0];

				
				if ($kodelama!=$data[IDTRANS]) {
    			if ($kodelama!="") {
            echo "
    				</table>
            </form><hr>
    			   ";
          }
    			echo "
          <form action=index.php  method=post ENCTYPE=\"MULTIPART/FORM-DATA\">
            <input type=hidden name=pilihan value='$pilihan'>
            <input type=hidden name=idtrans value='$data[IDTRANS]'>
    				<table width=100% $borderdata class=data>
    				  <tr valign=top >
                <td colspan=4>
                <table width=100%>
                  <tr>
                    <td  nowrap>Kode Transaksi </td><td>: <b>$data[IDTRANS]</td>
                  </tr>
                  <tr>
                    <td >Klien </td><td>: <b>".getnamatoko($data[IDKLIEN])."</td>
                  </tr>
                  <tr>
                    <td nowrap>Nama Sampel</td><td>: <b>$data[CONTOH]</td>
                  </tr>
                  <tr>
                    <td>Tanggal Masuk</td><td>: $data[TGLMASUK]</td>
                  </tr>
   	<tr>
		<td  >Tanggal Deadline</td>
		<td nowrap>: 
			<select class=teksbox name=tgld>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tgld==""){
							$cek="selected";
						}	elseif ($tgld==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blnd>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blnd==""){
							$cek="selected";
						} else						
						if ($i==$blnd) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thnd>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year] && $thnd==""){
							$cek="selected";
						}	 else					
						if ($i==$thnd) {
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
                				Catatan Manager Teknis untuk Administrasi
                			</td>
                			<td>
                				<textarea name=catatanmt cols=25 rows=4>$data[CATATANMT]</textarea>
                			</td>
                		</tr>
                     		<tr>
                    			<td colspan=2 nowrap>
                     				<input type=submit name=aksi value='Update dan Kembalikan ke Admin'>
                     				<input type=submit name=aksi value='Update Tanpa Ganti Status'>
                      			</td>
                 </table>
                </td>
                <td colspan=6>
                  <table>
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
                				Catatan Manager Teknis untuk Supervisor <br>
                				(sekaligus untuk semua jenis uji)
                			</td>
                			<td>
                				<textarea name=catatanm cols=25 rows=2>$catatanm</textarea>
                			</td>
                		</tr>
                		<tr>
                			<td>
                				File Referensi/Lampiran
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
                    			<td colspan=2>
                     				<input type=checkbox checked name=pending value=1> Pending (Status tidak diubah), jika tidak dipilih, status akan berubah menjadi : <b>Diperiksa Supervisor</b> dan data jenis uji akan tidak terlihat di sini karena sudah masuk ke Supervisor. Proses Update akan membuat Kode Sampe 2 secara acak. Untuk memeriksa hasil update atau hasil dari analis, klik Edit/Lihat hasil.<br>
                    				<input type=submit name=aksi value='Update'>
                    				<input type=reset value='Reset Isian'> 
                     			</td>
                     		</tr>
                   </table>
                
                </td>
              </tr>
    					<tr class=judulkolom align=center valign=middle>
    						<td nowrap width=10>No</td>
    						<td nowrap >Kode Jenis Uji</td>
    						<td nowrap  >Kode 2</td>
    						<!-- 
                <td nowrap >Klien</td>
    						<td nowrap >Tgl<br>Masuk</td>
    						<td nowrap >Tgl<br>Deadline</td>
     						<td nowrap >Kelompok Jenis Uji</td>
    						-->
     						<td nowrap >Jenis Uji</td>
     						<td nowrap >Output</td>
    						<td nowrap >Status</td>
      						<td nowrap >Supervisor</td>
    						<td  >Edit</td>
    						<td  >Pilih Kelompok Update</td>
    					</tr>";
        
            $kodelama=$data[IDTRANS];            
            $idkelompok="";
            $i=1;
        }
        
				if ($data[IDKELOMPOK]=="") {
          $data[IDKELOMPOK]=0;
        }
				
				if ("$idkelompok"!="$data[IDKELOMPOK]") {
          echo "
					<tr class=judulkolom   valign=middle>
 						<td nowrap colspan=8 align=left>KELOMPOK JENIS UJI: ".$arraykelompokjenisuji[$data[IDKELOMPOK]]."</td>
						<td nowrap align=center><input type=checkbox name='pilihkelompok[$data[IDKELOMPOK]]' value=1></td>
 					</tr>";
 					$idkelompok=$data[IDKELOMPOK];
        
        }
				
        
				
				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
						<td  align=center >$data[IDS]</td>
						<td nowrap align=center >$data[ID2]</td>
						<!-- 
            <td  >".getnamatoko($data[IDKLIEN])."</td>
						<td   align=center nowrap>$data[TGLMASUK]</td>
						<td   align=center nowrap>$data[TGLDEADLINE]</td>
 						<td  align=left>".$arraykelompokjenisuji[$arraykelompokanalisis[$data[JENISANALISIS]]]."</td>
						-->
 						<td  align=left>".$arrayanalisis[$data[JENISANALISIS]]."</td>
 						<td  align=left>".$arrayduplo[$data[DUPLO]]."</td>
						<td  align=left>".$arraystatuspermintaan[$data[STATUSS]]."</td>
  						<td  align=left>".getnama($data[IDSUP])."</td>
						<td nowrap align=center><a href='index.php?pilihan=mupdate&idupdate=$data[ID]&idsupdate=$data[IDS]'>Edit/lihat hasil</td>
						<td align=center>-</td>
 					</tr>";



				$i++;
			}
    			echo "
    				</table></form></center>
    			";
						
			
		} else {
			echo $errmesg="Data Permintaan Analisis tidak ada.";
			$aksi="";
		}
?>
