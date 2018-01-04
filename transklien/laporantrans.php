<?
if ($_SESSION[tingkats]!="C") {
    exit;
}
 
$q="SELECT * FROM minta WHERE ID='$idupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$idklien=$data[IDKLIEN];
	$sampel=$data[SAMPEL];
	$catatan=$data[CATATAN];
	$catatanm=$data[CATATANM];
	$idman=$data[IDMAN];
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
}

if ($ok==1 && $idupdate!="") {
	$errmesg="Data permintaan analisis telah dimasukkan. Silahkan mengentri data uji/sampel";
}
echo "
<h3>Laporan Hasil Analisis</h3>";
printmesg($errmesg);
echo "
 	<table $border>
		<tr>
			<td width=150  nowrap>
				Kode Permintaan
			</td>
			<td>
				<b> $id 
		</tr>
		<tr>
			<td width=150  nowrap>
				Status
			</td>
			<td>
				".$arraystatushasil[$statuspermintaan]." 
		</tr>
		<tr>
			<td width=150  nowrap>
				ID Klien
			</td>
			<td>
				$idklien (".getnamatoko($idklien).")
			</td>
		</tr>
	<tr>
		<td  >Tanggal Permintaan</td>
		<td>$tglmasuk-$blnmasuk-$thnmasuk
		</td>
	</tr>
	<tr>
		<td  >Deadline Selesai</td>
		<td>$tgld-$blnd-$thnd</td>
	</tr> 
	<tr>
		<td  >Tanggal Selesai</td>
		<td>$tglse-$blnse-$thnse</td> 
	</tr>	 
		 	<tr>
					<td>
						Manager Teknis
					</td>
					<td>".$arraymanagerteknis[$idman]." 
					</td>
				</tr>
 		<tr>
			<td>Update terakhir oleh</td>
			<td>".getnama($data[UPDATER]).", $data[TGLUPDATE]</td>
		</tr>
 	</table>


 
";



  
 
		 $q="SELECT 
		JENISANALISIS,COUNT(JENISANALISIS) AS JML
		 FROM permintaan 
		WHERE IDTRANS='$idupdate'
		GROUP BY JENISANALISIS
 		ORDER BY JENISANALISIS";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<h4>Data Jenis Analisis</h4>";
 			echo "
				<table $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
 						<td nowrap >Jenis Analisis</td>
 						<td nowrap >Jumlah</td>
						<td nowrap >Laporan</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				echo "
					<tr valign=top $kelas>
						<td  align=left>".$arrayanalisis[$data[JENISANALISIS]]."</td>
 						<td nowrap align=center >$data[JML]</td>
 						<td nowrap align=center><a target=_blank 
 						href='cetakhasilanalisis.php?idman=$idman&jenisanalisis=$data[JENISANALISIS]&idupdate=$idupdate'>cetak</td>
					</tr>";
				$i++;
			}
						
			echo "
				</table></center>
			";
			
		} else {
			$errmesg="Data Permintaan Analisis tidak ada.";
			printmesg($errmesg);
			$aksi="";
		}
?>
