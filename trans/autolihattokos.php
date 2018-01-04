<?
if ($_SESSION[tingkats]!="D") {
    exit;
}

     if ($aksi=="Update") {
      $berhasil=0;
      $idupdate=$idtrans;
      
      if (is_array($pilihupdate)) {
        $idupdate=$idtrans;
        foreach ($pilihupdate as $k=>$v) {

         $q="SELECT * FROM permintaan WHERE IDTRANS='$idupdate' 
         AND (permintaan.STATUS=1) AND ID2='$k'  AND IDSUP='$users'";
         $h=doquery($q,$koneksi);
         if (sqlnumrows($h)>0) {
            $d=sqlfetcharray($h);
            $qf="";
            $statuspermintaan=$statusman=$d[STATUS];
            $idsupdate=$d[ID2];
         		if ($pending!=1) {
        	 		if ($statuspermintaan=='1') {
        				$qf="STATUS='2',";
        				//$qf.="TGLTERIMASUP=CURDATE(),";
        				$tmpstatus="Status : ".$arraystatuspermintaan[2];
        			}
         		} else {
        			$tmpstatus="Status tetap";
        		}
         		 $q="UPDATE permintaan 
        			SET 
        			$qf
        			IDAN='$idan',
         			CATATANS='$catatans',
         			TGLTERIMASUP=IF(TGLTERIMASUP IS NULL,CURDATE(),TGLTERIMASUP),
         			TGLUPDATE=NOW(),
        			UPDATER='$users',
        			HISTORY=CONCAT(IF(HISTORY IS NULL,'',HISTORY),CONCAT(NOW(),' Diupdate oleh Supervisor ($users/$namausers). $tmpstatus \n'))
        
         			WHERE ID2='$idsupdate' AND IDSUP='$users'";
        		doquery($q,$koneksi);
        		if (sqlaffectedrows($koneksi)>0) {
         
                $ketlog="Update Jenis Uji Permintaan, status ke Analis. Kode Permintaan: $idsupdate";
                buatlogiso(15,$ketlog,$q,$users);
         			  $errmesg="Data jenis uji berhasil diupdate";
          		  $berhasil++;
        			//$idupdate=$id;
        		} else {
        			//$errmesg="Data jenis uji tidak diupdate. ";
        		}
         
//        	printmesg($errmesg);


          }
        }
      }
      $errmesg="$berhasil Data jenis uji telah diupdate.";
    	printmesg($errmesg);
      
      unset($arrayanalis);
      $q="SELECT user.ID,user.NAMA, COUNT(permintaan.ID) AS JML 
      FROM user LEFT JOIN permintaan ON user.ID=permintaan.IDAN AND (permintaan.STATUS=2 OR permintaan.STATUS=3)
      
      WHERE user.TINGKAT='E' GROUP BY user.ID ORDER BY COUNT(permintaan.ID) ";
      $h=doquery($q,$koneksi);
      while ($d=sqlfetcharray($h)) {
      	$arrayanalis[$d[ID]]=$d[NAMA]." ( $d[JML] pekerjaan) ";
      }

     }

		 $q="SELECT 
		minta.*,permintaan.*,jenisuji.IDKELOMPOK,
		minta.ID,permintaan.ID AS IDS,
		permintaan.STATUS AS STATUSS,
		DATE_FORMAT(TANGGALDATANG,'%d-%m-%Y') AS TGLMASUK,
 		DATE_FORMAT(TANGGALDEADLINE,'%d-%m-%Y') AS TGLDEADLINE,
		DATE_FORMAT(minta.TANGGALSELESAI,'%d-%m-%Y') AS TGLSELESAI
		 FROM minta ,permintaan LEFT JOIN jenisuji ON jenisuji.ID=permintaan.JENISANALISIS
		WHERE 
		minta.ID=permintaan.IDTRANS AND
		IDSUP='$users' 
		AND (permintaan.STATUS='1' OR permintaan.STATUS='4')
 		ORDER BY minta.ID,jenisuji.IDKELOMPOK,jenisuji.NAMA";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h4 id='2'>Permintaan Analisis yang Harus Ditanggapi</h4>";
			echo("<p class=judulhaltabel>".$judul."</p>");
			
			$i=1;
			$kodelama=$idkelompok="";
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);

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
                   <tr  >
                    <td nowrap>Nama Sampel</td><td nowrap>: <b>$data[CONTOH]</td>
                  </tr>
                  <tr nowrap>
                    <td nowrap>Tanggal Masuk</td><td nowrap>: $data[TGLMASUK]</td>
                  </tr>
                  <tr  nowrap>
                    <td nowrap>Tanggal Deadline</td><td nowrap>: $data[TGLDEADLINE]</td>
                  </tr>
                  </table>
 
                </td>
                <td colspan=5>
                  <table>
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
                				Catatan Supervisor
                			</td>
                			<td>
                				<textarea name=catatans cols=25 rows=2>$catatans</textarea>
                			</td>
                		</tr>
                     		<tr>
                    			<td colspan=2>
                     				<input type=checkbox checked name=pending value=1> Pending (Status tidak diubah), jika tidak dipilih, status akan berubah menjadi : <b>Diperiksa Analis</b> dan data jenis uji akan tidak terlihat di sini karena sudah masuk ke Analis.  Untuk memeriksa hasil update atau hasil dari analis, klik Edit/Lihat hasil.<br>
                    				<input type=submit name=aksi value='Update'>
                    				<input type=reset value='Reset Isian'> 
                     			</td>
                    			</td>
                    		</tr>
                   </table>
                
                </td>
              </tr>
 					<tr class=judulkolom align=center valign=middle>
						<td nowrap >No</td>
						<td nowrap  >Kode</td>
 						<!-- <td nowrap >Kelompok<br>Jenis Uji</td> -->
 						<td nowrap >Jenis Analisis</td>
 						<td nowrap >Output</td>
						<td nowrap >Status</td>
  						<td nowrap >Analis</td>
						<td nowrap >Edit</td>
						<td nowrap >Pilih</td>
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
  					</tr>";
 					$idkelompok=$data[IDKELOMPOK];
        
        }

				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
 						<td nowrap align=center >$data[ID2]</td>
  						<!-- <td  align=left>".$arraykelompokjenisuji[$arraykelompokanalisis[$data[JENISANALISIS]]]."</td> -->
 						<td  align=left>".$arrayanalisis[$data[JENISANALISIS]]."</td>
 						<td  align=left>".$arrayduplo[$data[DUPLO]]."</td>
						<td  align=left>".$arraystatuspermintaan[$data[STATUSS]]."</td>
   						<td  align=left>".getnama($data[IDAN])."</td>
						<td align=center><a href='index.php?pilihan=supdate&idupdate=$data[IDTRANS]&idsupdate=$data[ID2]'>Edit/lihat detil</td>
						<td align=center>
              <input type=checkbox name='pilihupdate[$data[ID2]]' value=1>
            </td>
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
