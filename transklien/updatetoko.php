<?
if ($_SESSION[tingkats]!="F") {
    exit;
}
 $q="SELECT STATUS FROM minta WHERE ID='$idupdate' AND IDKLIEN='$users'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	 $statusadministrasi=$data[STATUS];
}


if ($aksitambahan=="hapus" && $idhapus!="" && $idupdate!=""  ) {
	if ($statusadministrasi!=0) {
  
  $q="DELETE FROM permintaan WHERE ID='$idhapus' AND IDTRANS='$idupdate' AND STATUS=100";
	doquery($q,$koneksi);
 		if (sqlaffectedrows($koneksi)>0) {
   		  $ketlog="Hapus Jenis Uji Permintaan. ID Jenis Uji=$idhapus, ID Permintaan=$idupdate, Klien=$users ";
        buatlogiso(9,$ketlog,$q,$users);
			$errmesg="Data uji berhasil dihapus";
		} else {
			$errmesg="Data uji tidak berhasil dihapus";
		}
	} else {
    $errmesg="Maaf Anda tidak dapat mengubah data apabila Status Permintaan adalah Sedang Dianalisis. ";
  }
}
if ($aksi2=="sampel") {
 if ($statusadministrasi!=0) {
	if ($aksi=="Tambah" && $statusadministrasi==4) {
	 if ($pilihaninput==0) {
    	 // PERIKSA APAKAH SUDAH ADA ATAU TIDAK
    	 $q="SELECT ID FROM permintaan WHERE IDTRANS='$idupdate' AND JENISANALISIS='$jenisanalisis' ";
    	 $h=doquery($q,$koneksi);
    	 if (sqlnumrows($h)>0) {
        			$errmesg="Data jenis uji tidak dimasukkan. Jenis uji yg sama sudah digunakan untuk sampel ini.";
       } else {
          	$q="SELECT MAX(ID)+1 AS IDBARU FROM permintaan WHERE IDTRANS='$idupdate'";
          	$h=doquery($q,$koneksi);
          	$d=sqlfetcharray($h);
          	$ids=$d[IDBARU];
          	if ($ids=="") {
          		$ids=1;
          	}
          	$ids=addnol($ids,6);
    	
        	 $q="INSERT INTO permintaan 
        		(ID,IDTRANS,JENISANALISIS,STATUS,SAMPEL,CATATAN,TGLUPDATE,UPDATER,HISTORY,DUPLO,BIAYA)
        		VALUES
        		('$ids','$idupdate','$jenisanalisis','100','$sampel','$catatan',NOW(),'$users',
        		CONCAT(IF(HISTORY IS NULL,'',HISTORY),CONCAT(NOW(),' Dientri oleh Klien\n')),
            '$duplo','".getbiaya($jenisanalisis)."')";
        		doquery($q,$koneksi);
        		//echo mysql_error();
         		if (sqlaffectedrows($koneksi)>0) {
         		  $ketlog="Tambah Jenis Uji Permintaan. ID Jenis Uji=$ids, ID Permintaan=$idupdate, Jenis Analisis=".$arrayanalisis[$jenisanalisis].", Klien=$users ";
              buatlogiso(7,$ketlog,$q,$users);
        			$errmesg="Data uji berhasil dimasukkan";
        		} else {
        			$errmesg="Data uji tidak berhasil dimasukkan";
        		}
        }
    } else {
    // INPUT SEKALIGUS BANYAK
    //  $idkelompoksaatini
    $berhasil=0;
		foreach ($arrayanalisis as $k=>$v) {
		  if ($idkelompoksaatini==$arraykelompokanalisis[$k]) {
   	 // PERIKSA APAKAH SUDAH ADA ATAU TIDAK
    	 $q="SELECT ID FROM permintaan WHERE IDTRANS='$idupdate' AND JENISANALISIS='$k'";
    	 $h=doquery($q,$koneksi);
    	 if (sqlnumrows($h)<=0)  {
          	$q="SELECT MAX(ID)+1 AS IDBARU FROM permintaan WHERE IDTRANS='$idupdate'";
          	$h=doquery($q,$koneksi);
          	$d=sqlfetcharray($h);
          	$ids=$d[IDBARU];
          	if ($ids=="") {
          		$ids=1;
          	}
          	$ids=addnol($ids,6);
    	
        	 $q="INSERT INTO permintaan 
        		(ID,IDTRANS,JENISANALISIS,STATUS,SAMPEL,CATATAN,TGLUPDATE,UPDATER,HISTORY,DUPLO,BIAYA)
        		VALUES
        		('$ids','$idupdate','$k','100','$sampel','$catatan',NOW(),'$users',
        		CONCAT(IF(HISTORY IS NULL,'',HISTORY),CONCAT(NOW(),' Dientri oleh Klien\n')),
            '$duplo','".getbiaya($k)."')";
        		doquery($q,$koneksi);
        		//echo mysql_error();
         		if (sqlaffectedrows($koneksi)>0) {
        			//$errmesg="Data uji berhasil dimasukkan";
         		  $ketlog="Tambah Jenis Uji Permintaan. ID Jenis Uji=$ids, ID Permintaan=$idupdate, Jenis Analisis=".$arrayanalisis[$k].", Klien=$users ";
              buatlogiso(7,$ketlog,$q,$users);
        			$berhasil++;
        		}  
         }
			}
			if ($berhasil>0) {
        $errmesg="$berhasil data uji berhasil dimasukkan";
      }
 		}


    }
	}
	elseif ($aksi=="Update") {
		if ($statusan==99) {
				$qf="
				TANGGALSELESAI='$thnsl-$blnsl-$tglsl',
				STATUS='$statusadm',";
				$tmpstatus="Status : ".$arraystatuspermintaan[$statusadm];
		}

		 $q="Update permintaan 
		SET
		JENISANALISIS='$jenisanalisis',
		$qf
		SAMPEL='$sampel',
		CATATAN='$catatan',
		DUPLO='$duplo',
		TGLUPDATE=NOW(),
		UPDATER='$users',
			HISTORY=CONCAT(IF(HISTORY IS NULL,'',HISTORY),CONCAT(NOW(),' Diupdate oleh Klien ($users/$namausers). $tmpstatus \n'))

		WHERE 
		ID='$ids' AND
		IDTRANS='$idupdate'";
		doquery($q,$koneksi);
		//echo mysql_error();
 		if (sqlaffectedrows($koneksi)>0) {
			$errmesg="Data uji berhasil diupdate";
		} else {
			$errmesg="Data uji tidak berhasil diupdate";
			$idsupdate=$ids;
			$aksitambahan="update";
		}
 	}

 } else {
  $errmesg="Maaf Anda tidak dapat mengubah data apabila Status Permintaan adalah Sedang Dianalisis. ";
 }

}


if ($aksi=="Update" && $aksi2=="") {
	if (trim($id)=="")	{
		$errmesg="Kode Permintaan Analisis Harus Diisi";
  	} else {
 		/*
 		if ($statuspermintaan>=7 && $updatestatus==1) {
			  $qf.="STATUS='$statusadm',";
			  if ($statusadm==99) {
				  $qf.="TANGGALSELESAI=NOW(),";
			  } else {
				  $qf.="TANGGALSELESAI=NULL,";
			  }
		}
		*/
		if ($ifubahstatus==1) {
 				$qf.="
 				STATUS='$statusminta',";
   }
 		  $q="UPDATE minta 
			SET 
			$qf
  			TANGGALDATANG='$thnmasuk-$blnmasuk-$tglmasuk',
			TANGGALDEADLINE='$thnd-$blnd-$tgld',
 			IDMAN='$idman',
 			NOMER1='$nomer1',
 			NOMER2='$nomer2',
 			CONTOH='$contoh',
 			CATATANKLIEN='$catatanklien',
 			TGLUPDATE=NOW(),
			UPDATER='$users'
			WHERE ID='$idupdate' AND IDKLIEN='$users' AND (STATUS=4 OR STATUS=1)";
		doquery($q,$koneksi);
		//echo mysql_error();
		if (sqlaffectedrows($koneksi)>0) {
   		  $ketlog="Update permintaan. ID=$idupdate, Klien=$users, Sampel=$contoh, Status=".$arraystatushasil[$statusminta]."";
        buatlogiso(5,$ketlog,$q,$users);

			$errmesg="Data Permintaan Analisis berhasil diupdate";
      if ($statusminta==3) {
        $q="UPDATE permintaan SET STATUS='0' WHERE (STATUS=100) AND IDTRANS='$idupdate'";
        doquery($q,$koneksi);
      }			
			//$idupdate=$id;
		} else {
			$errmesg="Data Permintaan Analisis tidak diupdate.";
		}
	}
 }

$q="SELECT * FROM minta WHERE ID='$idupdate' AND IDKLIEN='$users'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$idklien=$data[IDKLIEN];
	$sampel=$data[SAMPEL];
	$catatan=$data[CATATAN];
	$catatanm=$data[CATATANM];
	$idman=$data[IDMAN];
	$contoh=$data[CONTOH];
	$jenisanalisis=$data[JENISANALISIS];
	$statusadministrasi=$statusadm=$statuspermintaan=$data[STATUS];
	$catatanmt=$data[CATATANMT];
	$catatanklien=$data[CATATANKLIEN];

	$nomer1=$data[NOMER1];
	$nomer2=$data[NOMER2];


	$tmp=explode("-",$data[TANGGALDATANG]);
	$tglmasuk=$tmp[2];
	$blnmasuk=$tmp[1];
	$thnmasuk=$tmp[0];

	$tmp=explode("-",$data[TANGGALDEADLINE]);
	$tgld=$tmp[2];
	$blnd=$tmp[1];
	$thnd=$tmp[0];

	$tmp=explode("-",$data[TANGGALSELESAI]);
	$tglse=$tmp[2];
	$blnse=$tmp[1];
	$thnse=$tmp[0];

	
	$q="SELECT COUNT(ID) AS JML FROM permintaan WHERE IDTRANS='$idupdate'";
	$h1=doquery($q,$koneksi);
	$d1=sqlfetcharray($h1);

	$q="SELECT COUNT(ID) AS JML FROM permintaan WHERE IDTRANS='$idupdate' AND STATUS='99'";
	$h2=doquery($q,$koneksi);
	  $d2=sqlfetcharray($h2);
	if ($d1[JML]==$d2[JML]) {
		 $statusakhir="selesai";
	}
 }

if ($ok==1 && $idupdate!="") {
	$errmesg="Data permintaan analisis telah dimasukkan. Silahkan mengentri data uji";
}
$inputupdate=$pilihanjudul="";
if ($aksitambahan=="update" && $idsupdate!="" && $idupdate!="") {
	$judul="Update";
	$inputupdate="	<input type=hidden name=ids value='$idsupdate'>";
} else {
  $judul="Tambah";
  $pilihanjudul="				<input type=radio name=pilihaninput value=0 checked>  satu jenis uji
				<input type=radio name=pilihaninput value=1> semua jenis uji dalam kategori yang sama
";
}
echo "
<h3>Update Data Permintaan Analisis 
<font style='font-size:9pt'>
<a href='#2'>[$judul jenis analisis]</a>
<a href='#3'>[Daftar jenis analisis]</a>
<a href='index.php?pilihan=laporanadm&aksi=Tampilkan&idupdate=$idupdate'>[Lihat Laporan]</a>
<a href='index.php?pilihan=tagihanawal&idupdate=$idupdate'>[Lihat Tagihan]</a>
</font>

</h3>";
printmesg($errmesg);
echo "
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=statuspermintaan value='$statuspermintaan'>
	<input type=hidden name=idupdate value='$idupdate'>
	<input type=hidden name=statusakhir value='$statusakhir'>
	
  <table width=95%>
  <tr valign=top><td width=50%>
  
	<table $border>
		<tr>
			<td width=150  nowrap>
				Kode Permintaan
			</td>
			<td>
				<input type=hidden name=id size=5 value='$id'>$id
		</tr>
		<tr>
			<td width=150  nowrap>
				Status
			</td>
			<td>
				<b>".$arraystatushasil[$statuspermintaan].""; 
 		echo "
		</tr>
 

		<tr>
			<td width=150  nowrap>
				ID Klien
			</td>
			<td>$users / $namausers
 			</td>
		</tr>
		<tr>
			<td width=150  nowrap>
				Nama Sampel
			</td>
			<td>
				<input type=text name=contoh size=30 value='$contoh'> 
			</td>
		</tr>
	</table>

  </td>
  <td>
    	<table $border>
	<tr>
		<td  >Tanggal Permintaan</td>
		<td nowrap>$tglmasuk ".$arraybulan[$blnmasuk-1]." $thnmasuk
 	</tr>
	<tr>
		<td  >Deadline Selesai</td>
		<td nowrap>
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
  
  
  ";		
	if ($d1[JML]==$d2[JML]) {
		echo "
	<tr>
		<td  >Tanggal Selesai</td>
		<td>$tglse-$blnse-$thnse
 	</tr>		";
	}

	echo "

 		<tr>
			<td>Catatan Klien</td>
			<td>
      <textarea name=catatanklien cols=30 rows=3>$catatanklien</textarea> </td>
		</tr>


       </table>
  </td>
  </tr>";
  unset($arraystatushasil);
  $arraystatushasil[3]="Administrasi";
  //$arraystatushasil[4]="Klien";
  echo "
		<tr>
			<td colspan=2>
			 <input type=checkbox name=ifubahstatus value=1> Ubah Status Menjadi : 
						<select name=statusminta >
						";
						foreach ($arraystatushasil as $k=>$v) {
							$cek="";
							if ($statusminta==$k) {
								$cek="selected";
							}
							echo "<option $cek value='$k'>$v</option>";
						}
						echo "
						</select>
 				<input type=submit name=aksi value='Update'>
				<input type=reset value='Reset Isian'>
			</td>
		</tr>
  </table>

</form name=form>
";



$errmesg="";

if ($aksitambahan=="update" && $idsupdate!="" && $idupdate!="") {
	$judul="Update";
	$q="SELECT ID,SAMPEL,CATATAN,JENISANALISIS,STATUS ,DUPLO
	FROM permintaan WHERE IDTRANS='$idupdate' AND ID='$idsupdate'";
	$h=doquery($q,$koneksi);
	$d=sqlfetcharray($h);
	$ids=$d[ID];
	$jenisanalisis=$d[JENISANALISIS];
	$sampel=$d[SAMPEL];
	$catatan=$d[CATATAN];
	$duplo=$d[DUPLO];
	$statusadm=$statusan=$d[STATUS];
	if ($data[TANGGALSELESAI]!="") {
		$tmp=explode("-",$data[TANGGALSELESAI]);
		$tglsl=$tmp[2];
		$blnsl=$tmp[1];
		$thnsl=$tmp[0];
	}

} else {
	$judul="Tambah";
	$q="SELECT MAX(ID)+1 AS IDBARU FROM permintaan WHERE IDTRANS='$idupdate'";
	$h=doquery($q,$koneksi);
	$d=sqlfetcharray($h);
	$ids=$d[IDBARU];
	if ($ids=="") {
		$ids=1;
	}
	$ids=addnol($ids,6);
}

if ($idkelompoksaatini=="") {
  $idkelompoksaatini=$arraykelompokanalisis[$jenisanalisis];
  if ($idkelompoksaatini=="") {
    $idkelompoksaatini="0";
  }
}

 echo "
<h4 id='2'>$judul Jenis Uji</h4>";
printmesg($errmesg);
echo "
<form name=form2 action=index.php?#2 method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=statuspermintaan value='$statuspermintaan'>
	<input type=hidden name=idupdate value='$idupdate'>
	<input type=hidden name=aksi2 value='sampel'>
	<input type=hidden name=statusan value='$statusan'>
  $inputupdate
	<table $border>
<!--				<tr>
					<td width=150  nowrap>
						Kode
					</td>
					<td>
						<input readonly type=text name=ids size=10 value='$ids'>
				</tr>
-->
 	<tr>
			<td>
				Jenis Uji
			</td>
			<td>
			 <b>
          ";
          if (($statusadm==100 && $judul=="Update") || $judul=="Tambah") {
          echo "
          Kelompok Jenis Uji : 
				<select name=idkelompoksaatini>
				  ";
				  foreach ($arraykelompokjenisuji as $k=>$v) {
				    $cek="";
            if ($k==$idkelompoksaatini) {
              $cek="selected";
            }
            echo "<option value='$k' $cek>$v</option>";
          }
          echo "
				</select> <input type=submit name=aksi2 value='Ganti Kelompok'>


<hr>
				Jenis Uji : <select name=jenisanalisis >
				";
				foreach ($arrayanalisis as $k=>$v) {
				  if ($idkelompoksaatini==$arraykelompokanalisis[$k]) {
  					if ($k==$jenisanalisis) {
  						$cek="selected";
  					}
  					echo "<option $cek value='$k'>$v</option>";
  				}
					$cek="";
				}
				echo "
				</select>";
				} else {
          echo " 
          Kelompok Jenis Uji : ".$arraykelompokjenisuji[$idkelompoksaatini]." <br>
          Jenis Uji : ".$arrayanalisis[$jenisanalisis]."
           ";
        }
        echo "
			</td>
		</tr>
		<!--
 		<tr>
			<td>
				Catatan untuk Sampel
			</td>
			<td>
				<textarea name=sampel cols=50 rows=2>$sampel</textarea>
			</td>
		</tr>
 		<tr>
			<td>
				Catatan untuk Manager Teknis
			</td>
			<td>
				<textarea name=catatan cols=50 rows=2>$catatan</textarea>
			</td>
		</tr> 
		-->
 		<tr>
			<td>
				Jenis Output Data
			</td>
			<td>
<select name=duplo >
				";
				foreach ($arrayduplo as $k=>$v) {
   					if ($k==$duplo) {
  						$cek="selected";
  					}
  					echo "<option $cek value='$k'>$v</option>";
 					$cek="";
				}
				echo "
				</select>			</td>
		</tr>    
    ";
		if ($statusan==7 || $statusan==99) {
		echo "
		
	<tr>
		<td  >Tanggal Selesai</td>
		<td>
			<select class=teksbox name=tglsl>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tglsl==""){
							$cek="selected";
						}	elseif ($tglsl==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blnsl>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blnsl==""){
							$cek="selected";
						} else						
						if ($i==$blnsl) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thnsl>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year] && $thnsl==""){
							$cek="selected";
						}	 else					
						if ($i==$thnsl) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>
	</tr>
	<tr>
		<td>Status Akhir</td>
		<td>
				<select name=statusadm >
				";
				foreach ($arraystatusadm as $k=>$v) {
					if ($statusadm=="$k") {
						$cek="selected";
					}
					echo "<option $cek value='$k'>$v</option>";
					$cek="";
				}
				echo "
				</select>
		</td>
	</tr>		
		";
		}
		
		echo "
 		<tr>
 		   <td></td>
			<td  >
 				<input type=submit name=aksi value='$judul'>
 				$pilihanjudul
 			</td>
		</tr>
	</table>


</form >
 ";
 $updatebiaya=0;
 $errmesg="";
  if ($aksiadmin=="Update") {
   if ($statusadministrasi!=0) {
     $q="UPDATE permintaan SET STATUS='$statusadmakhir' WHERE STATUS=99 AND IDTRANS='$idupdate'";
      doquery($q,$koneksi);
      if (sqlaffectedrows($koneksi)>0) {
          $errmesg.="Status diupdate.";
      }
    } else {
        $errmesg="Maaf Anda tidak dapat mengubah data apabila Status Permintaan adalah Sedang Dianalisis. ";

   }  
    
  }
   if ($aksiadmin=="Hapus Pilihan") {
  	if ($statusadministrasi!=0) {

      $updatebiaya=0;
     if (is_array($pilihhapus)) {
      foreach ($pilihhapus as $k=>$v) {
        	$q="DELETE FROM permintaan WHERE ID='$k' AND IDTRANS='$idupdate' AND STATUS=100";
          doquery($q,$koneksi);
          if (sqlaffectedrows($koneksi)>0) {
       		  $ketlog="Hapus Jenis Uji Permintaan. ID Jenis Uji=$k, ID Permintaan=$idupdate, Klien=$users ";
            buatlogiso(9,$ketlog,$q,$users);
            $updatebiaya++;  
          }
      }
      
      if ($updatebiaya > 0 ) {
        $errmesg="$updatebiaya Data uji berhasil dihapus.";
      }
    }
   } else {
        $errmesg="Maaf Anda tidak dapat mengubah data apabila Status Permintaan adalah Sedang Dianalisis. ";

   }  
  }


		 $q="SELECT 
		permintaan.*,jenisuji.IDKELOMPOK,
		DATE_FORMAT(TANGGALSELESAI,'%d-%m-%Y') AS TGLSELESAI
		 FROM permintaan LEFT JOIN jenisuji ON jenisuji.ID=permintaan.JENISANALISIS
		WHERE IDTRANS='$idupdate'
 		ORDER BY jenisuji.IDKELOMPOK,jenisuji.NAMA";
		$h=doquery($q,$koneksi);
		echo mysql_error();

    printmesg($errmesg);		
    if (sqlnumrows($h)>0) {
			
			echo "<h4 id='3'>Daftar Jenis Uji</h4>";
 			echo "
            <form name=form action=index.php?#3 method=post>
				<table width=100% $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
 						<td nowrap colspan=10 align=right>
            	<input type=hidden name=pilihan value='$pilihan'>
            	<input type=hidden name=statuspermintaan value='$statuspermintaan'>
            	<input type=hidden name=idupdate value='$idupdate'>
            	<input type=hidden name=statusakhir value='$statusakhir'>

             Update Status, dari Selesai menjadi : 				<select name='statusadmakhir' >
				";
				foreach ($arraystatusklien as $k=>$v) {
					if ($statusadm=="$k") {
						$cek="selected";
					}
					echo "<option $cek value='$k'>$v</option>";
					$cek="";
				}
				echo "
				</select>
        <input type=submit name='aksiadmin' value='Update'>
        <input type=submit name='aksiadmin' value='Hapus Pilihan'>
             </td>
 					</tr>
					<tr class=judulkolom align=center valign=middle>
 						<td nowrap >Kode</td>
 						<td nowrap >Tgl<br>Selesai</td>
						<!-- <td nowrap >Kelompok<br>Jenis Uji</td> -->
						<td nowrap >Jenis<br>Uji</td>
						<td nowrap >Status</td>
						<!-- <td nowrap >Catatan Sampel</td>-->
						<td nowrap >Output</td>
						<td nowrap >Biaya</td>
 						<td nowrap >History</td>
    					<td nowrap >Hapus</td>
					</tr>
          ";
			$totalbiaya=0;
			$i=1;
			$idkelompok="";
			while($data=sqlfetcharray($h)) {
			 
				$kelas=kelas($i);
				$stradm="";
				
				if ($data[IDKELOMPOK]=="") {
          $data[IDKELOMPOK]=0;
        }
				
				if ("$idkelompok"!="$data[IDKELOMPOK]") {
          echo "
					<tr class=judulkolom   valign=middle>
 						<td nowrap colspan=9 align=left>KELOMPOK JENIS UJI: ".$arraykelompokjenisuji[$data[IDKELOMPOK]]."</td>
 					</tr>";
 					$idkelompok=$data[IDKELOMPOK];
        
        }
				
				
				if ($data[STATUS]==8) {
          $stradm="<font style='color:#FF0000;'>";
        } elseif ($data[STATUS]==7) {
          $stradm="<font style='color:#FF00FF;'>";
        }elseif ($data[STATUS]==99) {
          $stradm="<font style='color:#008800;'>";
        }
				echo "
					<tr valign=top $kelas>
 						<td nowrap align=center >$data[ID]</td>
 						<td nowrap  align=center>$data[TGLSELESAI]</td>
						<!-- <td  align=left>".$arraykelompokjenisuji[$arraykelompokanalisis[$data[JENISANALISIS]]]."</td> -->
						<td  align=left>".$arrayanalisis[$data[JENISANALISIS]]."</td>
						<td  align=left>$stradm ".$arraystatuspermintaan[$data[STATUS]]."</td>
 						<!-- <td   align=center>".nl2br($data[SAMPEL])."</td>-->
						<td  align=center>".$arrayduplo[$data[DUPLO]]."</td>
						<td  align=right>".cetakuang($data[BIAYA])."</td>
 						<td   align=center><a target=_blank href='../trans/his.php?idsupdate=$data[ID]&idupdate=$idupdate'>lihat</td>
  						<td nowrap align=center>
            ";
            if ($statusadm==4) {
            echo "<!-- <a 
						onclick=\"return confirm('Hapus data Uji/Sampel dengan Kode = $data[ID]?');\"
						href='index.php?pilihan=$pilihan&aksitambahan=hapus&idhapus=$data[ID]&idupdate=$idupdate'>Hapus -->
						
						<input type=checkbox name='pilihhapus[$data[ID]]' value=1>
						
            ";
            } else {
              echo "-";
            }
            echo "
            </td>
					</tr>";
					$totalbiaya+=$data[BIAYA];
				$i++;
			}
						
			echo "
					<tr class=judulkolom align=center valign=middle>
 						<td nowrap colspan=5>Total</td>
  						<td nowrap align=right> ".cetakuang($totalbiaya)."</td>
  						<td nowrap colspan=3><a target=blank href='tagihan.php?idupdate=$idupdate'>[Lihat Tagihan]</a></td>
 					</tr>
				</table></center>
        </form>
			";
			
		} else {
			$errmesg="Data Jenis Uji tidak ada.";
			printmesg($errmesg);
			$aksi="";
		}
?>
