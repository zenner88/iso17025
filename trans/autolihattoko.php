<?
		 $q="SELECT 
		minta.*,permintaan.STATUS AS STATUSS,
		DATE_FORMAT(TANGGALDATANG,'%d-%m-%Y') AS TGLMASUK,
		DATE_FORMAT(TANGGALDEADLINE,'%d-%m-%Y') AS TGLDEADLINE,
		DATE_FORMAT(minta.TANGGALSELESAI,'%d-%m-%Y') AS TGLSELESAI
		 FROM minta, permintaan
		WHERE 
		minta.ID=permintaan.IDTRANS AND
		minta.STATUS='0' 
		GROUP BY IDKLIEN
		HAVING
		SUM(IF(permintaan.STATUS=7,1,0))=COUNT(permintaan.ID)
 		ORDER BY TANGGALDEADLINE";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3>Permintaan yang Sudah Selesai Dianalisis</h3>";
			echo("<p class=judulhaltabel>".$judul."</p>");
			echo "
				<table $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap width='10%'><a href='$href&sort=ID'>Kode</td>
						<td nowrap ><a href='$href&sort=IDKLIEN'>Klien</td>
						<td nowrap ><a href='$href&sort=TANGGALDATANG'>Tgl Masuk</td>
						<td nowrap ><a href='$href&sort=TANGGALDEADLINE'>Tgl Deadline</td>
 						<td nowrap ><a href='$href&sort=minta.STATUS'>Status</td>
 						<td nowrap ><a href='$href&sort=permintaan.STATUS'>Status<br>Analisis</td>
  						<td nowrap ><a href='$href&sort=IDMAN'>Manager Teknis</td>
						<td nowrap colspan=2 width=20%>Aksi</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
						<td nowrap align=center >$data[ID]</td>
						<td  >".getnamatoko($data[IDKLIEN])."</td>
						<td   align=center >$data[TGLMASUK]</td>
						<td   align=center >$data[TGLDEADLINE]</td>
 						<td  align=left>".$arraystatushasil[$data[STATUS]]."</td>
 						<td  align=left>".$arraystatuspermintaan[$data[STATUSS]]."</td>
  						<td  align=left>".getnama($data[IDMAN])."</td>
						<td nowrap align=center><a href='index.php?pilihan=lupdate&idupdate=$data[ID]'>Update</td>
						<td nowrap align=center><a 
						onclick=\"return confirm('Hapus data Permintaan Analisis dengan ID = $data[ID]?');\"
						href='$href&aksitambahan=hapus&idhapus=$data[ID]'>Hapus</td>
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
