<?

if ($_SESSION[tingkats]!="C") {
    exit;
}
//if ($aksi=="Tampilkan") {

		///////// Hapus Data User ////////////////

		// if ($aksitambahan=="hapus") {
			// $q="SELECT bhn.*, trans.jumlah, trans.tanggal, jns.nama
			// FROM bahankimia bhn, transaksi trans, jenistrans jns
			// WHERE trans.idtrans = jns.idtrans
			// SELECT FILEG FROM bahankimia
			// WHERE IDBAHAN='$idhapus' ";
			// $h=doquery($q,$koneksi);
			// $d=sqlfetcharray($h);
			
			// $q="DELETE FROM bahankimia WHERE IDBAHAN='$idhapus'";
			// doquery($q,$koneksi);
			// if (sqlaffectedrows($koneksi)>0) {
				// @unlink("file/$d[FILEG]");
				// printmesg("Data Bahan Kimia dengan ID = $idhapus berhasil dihapus.");
  		  // $ketlog="Hapus Data Bahan. ID=$idhapus, File=$d[FILEG]";
        // buatlogiso(21,$ketlog,$q,$users);

			// } else {
				// printmesg("Data Bahan Kimia dengan ID = $idhapus tidak berhasil dihapus.");
			// }
		// }
	
		////////// Tampilkan Data User ///////////////
		if ($sort=="") {
			$sort="ID";
		}
		$q="SELECT bhn.*, trans.idtrans as ID, trans.jumlah AS JUMLAH, DATE_FORMAT(trans.tanggal, '%d-%m-%Y') as TANGGAL, jns.nama AS NAMA
			FROM bahankimia bhn, transaksi trans, jenistrans jns
			WHERE trans.idtrans = jns.idtrans
			AND trans.idbahan = bhn.idbahan
			ORDER BY trans.idtrans";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
						
			echo "<center><h3>Rincian Transaksi Data Bahan Kimia</h3>";
			
			$href="index.php?pilihan=gtrans&aksi=Tampilkan&nama=$nama";
			echo "
				<table $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap width='10%'><a href='$href&sort=ID'>ID</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Nama Bahan</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Nama Kimia</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Katalog</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Jumlah</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Satuan</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Tanggal</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Nama Transaksi</td>
						<td nowrap ><a href='$href&sort=FILEG'>File Referensi</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
						<td nowrap align=center >$data[ID]</td>
						<td align=left >$data[NAMABAHAN]</td>
						<td align=left >$data[NAMAKIMIA]</td>
						<td align=left >$data[KATALOG]</td>
						<td align=left >$data[JUMLAH]</td>
						<td align=left >$data[SATUAN]</td>
						<td align=left >$data[TANGGAL]</td>
						<td align=left >$data[NAMA]</td>
						<td align=left><a href='file/$data[FILEG]' target=_blank>$data[FILEG]</a></td>
					</tr>";
				$i++;
			}
						
			echo "
				</table></center>
			";
			
		} else {
			$errmesg="Data Bahan Kimia tidak ada.";
			$aksi="";
		}



?>
