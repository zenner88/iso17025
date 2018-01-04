<?php

 
$q="SELECT * FROM minta WHERE ID='$idupdate' AND IDKLIEN='$users' ";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$nomer1=$data[NOMER1];
	$nomer2=$data[NOMER2];
	$catatantagihan=$data[CATATANTAGIHAN];
	$idklien=$data[IDKLIEN];
	$sampel=$data[SAMPEL];
	$catatan=$data[CATATAN];
	$catatanm=$data[CATATANM];
	$idman=$data[IDMAN];
	$contoh=$data[CONTOH];
	$jenisanalisis=$data[JENISANALISIS];
	$statusadm=$statuspermintaan=$data[STATUS];
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

 
 echo "
<h3>INVOICE</h3>";
printmesg($errmesg);
echo "
<!--   <form method=post target=_blank action=tagihan.php> 
   <input type=submit name='aksi' value='Cetak'>
   Mata Uang : 
   <input type=radio name=matauang value='IDR' checked>IDR 
   <input type=radio name=matauang value='USD' >USD, $1 = Rp <input type=text size=20 name=konversi value=''> 
   <input type=hidden name='idupdate' value='$idupdate'>
    
    </form>
    <hr> -->
<!--    <form method=post  action=index.php> 
   <input type=hidden name='idupdate' value='$idupdate'>
   <input type=hidden name='pilihan' value='$pilihan'>
	<table border=0 $border>
		<tr>
			<td  nowrap>
				REPORT NUMBER
			</td>
			<td><input type=text size=30 name=nomer1 value='$nomer1'></td>
 		</tr>
		<tr>
			<td  nowrap>
				REFERENCE ORDER NUMBER
			</td>
			<td><input type=text size=30 name=nomer2 value='$nomer2'></td>
 		</tr>
		<tr>
			<td  width=200 nowrap>
				CATATAN/NOTE INVOICE
			</td>
			<td><textarea cols=50 rows=3 name=catatantagihan>$catatantagihan</textarea></td>
 		</tr>
		<tr>
			<td  width=200 nowrap>
 			</td>
			<td><input type=submit name=aksi value='Simpan'></td>
 		</tr>
 		</table>
    </form>
 		<hr> -->
 		<table>
		<tr>
			<td  nowrap>
				".$arraybahasa["Kode Sampel"]."
			</td>
			<td>
				<input type=hidden name=id size=5 value='$id'>$id
		</tr>
 		<tr>
			<td width=200  nowrap>
				".$arraybahasa["Pelanggan"]."
			</td>
			<td>
				$idklien / ".getnamatoko($idklien)."
			</td>
		</tr>
		<tr>
			<td width=200  nowrap>
				".$arraybahasa["Nama Sampel"]."
			</td>
			<td>
				 $contoh
			</td>
		</tr>
 	<tr>
		<td  >".$arraybahasa["Tanggal Datang"]."</td>
		<td nowrap>$tglmasuk-$blnmasuk-$thnmasuk
		</td>
 	</tr>
	<tr>
		<td  >".$arraybahasa["Tanggal Deadline"]."</td>
		<td nowrap>$tgld-$blnd-$thnd
		</td>
 	</tr>";		
	if ($d1[JML]==$d2[JML]) {
		echo "
	<tr>
		<td  >Tanggal Selesai</td>
		<td>$tglse-$blnse-$thnse </td>
	</tr>		";
	}

	echo "
        </table><br> 
 
 ";
 
 
 
 
		 $q="SELECT 
		*,
		DATE_FORMAT(TANGGALSELESAI,'%d-%m-%Y') AS TGLSELESAI
		 FROM permintaan 
		WHERE IDTRANS='$idupdate'
 		ORDER BY ID";
		$h=doquery($q,$koneksi);
		//echo mysql_error();
		if (sqlnumrows($h)>0) {
			
     printmesg($errmesg);
 			echo "
  				<table width=95% $border class=data>
 					<tr class=judulkolom align=center valign=middle>
  					<td nowrap ><b>".$arraybahasa["Kelompok Jenis Uji"]."</td>
						<td nowrap ><b>".$arraybahasa["Jenis Analisis"]."</td>
 						<td nowrap ><b>".$arraybahasa["Biaya"]."</td>
 					</tr>
          ";
			$totalbiaya=0;
			$i=1;
			while($data=sqlfetcharray($h)) {
			 
				$kelas=kelas($i);
 				echo "
					<tr valign=top $kelas>
 						<td  align=left>".$arraykelompokjenisuji[$arraykelompokanalisis[$data[JENISANALISIS]]]."</td>
						<td  align=left>".$arrayanalisis[$data[JENISANALISIS]]."</td>
  						<td  align=right>".cetakuang($data[BIAYA])."</td>
  					</tr>";
					$totalbiaya+=$data[BIAYA];
				$i++;
			}
						
			echo "
					<tr class=judulkolom align=center valign=middle>
 						<td nowrap colspan=2 align=right>Total</td>
  						<td nowrap align=right><b> ".cetakuang($totalbiaya)."</td>
  					</tr>
				</table></center>
  			";
			
		}  
 } else {
 printmesg("Data permintaan tidak ada.");
 }

?>
