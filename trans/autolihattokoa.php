<?
if ($_SESSION[tingkats]!="E") {
    exit;
}
		 $q="SELECT 
		*,
		minta.ID,permintaan.ID AS IDS,
		permintaan.STATUS AS STATUSS,
		DATE_FORMAT(TANGGALDATANG,'%d-%m-%Y') AS TGLMASUK,
		DATE_FORMAT(TANGGALDEADLINE,'%d-%m-%Y') AS TGLDEADLINE,
		DATE_FORMAT(minta.TANGGALSELESAI,'%d-%m-%Y') AS TGLSELESAI
		 FROM permintaan,minta 
		WHERE 
		minta.ID=permintaan.IDTRANS AND
		IDAN='$users' AND (permintaan.STATUS='2' OR permintaan.STATUS='3' OR permintaan.STATUS='6')
		$qfield
		$qtoko
		ORDER BY TANGGALDEADLINE";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3 id='2'>Permintaan Analisis yang Harus Ditanggapi</h3>";
			echo("<p class=judulhaltabel>".$judul."</p>");
			echo "
				<table $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap >Kode</td>
						<td nowrap >Sampel</td>
 						<td nowrap >Tgl Masuk</td>
						<td nowrap >Tgl Deadline</td>
 						<td nowrap >Kelompok<br>Jenis Uji</td>
 						<td nowrap >Jenis Analisis</td>
						<td nowrap >Output</td>
						<td nowrap >Status</td>
  						<td nowrap >Supervisor</td>
						<td nowrap >Aksi</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
 						<td nowrap align=center >$data[ID2]</td>
 						<td nowrap align=center >$data[CONTOH]</td>
 						<td   align=center >$data[TGLMASUK]</td>
						<td   align=center >$data[TGLDEADLINE]</td>
 						<td  align=left>".$arraykelompokjenisuji[$arraykelompokanalisis[$data[JENISANALISIS]]]."</td>
 						<td  align=left >".$arrayanalisis[$data[JENISANALISIS]]."</td>
 						<td  align=left>".$arrayduplo[$data[DUPLO]]."</td>
						<td  align=left>".$arraystatuspermintaan[$data[STATUSS]]."</td>
   						<td  align=left >".getnama($data[IDSUP])."</td>
						<td nowrap align=center><a href='index.php?pilihan=aupdate&idupdate=$data[IDTRANS]&idsupdate=$data[ID2]'>Update</td>
 					</tr>";
				$i++;
			}
						
			echo "
				</table></center>
			";
			
		} else {
			echo $errmesg="Data Permintaan Analisis tidak ada.";
			$aksi="";
		}
?>
