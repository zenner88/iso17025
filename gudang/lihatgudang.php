<?

if ($_SESSION[tingkats]!="C") {
    exit;
}
if ($aksi=="Tampilkan") {

		///////// Hapus Data User ////////////////

		if ($aksitambahan=="hapus") {
			$q="SELECT FILEG FROM bahankimia
			WHERE IDBAHAN='$idhapus' ";
			$h=doquery($q,$koneksi);
			$d=sqlfetcharray($h);
			
			$q="DELETE FROM bahankimia WHERE IDBAHAN='$idhapus'";
			doquery($q,$koneksi);
			if (sqlaffectedrows($koneksi)>0) {
				@unlink("file/$d[FILEG]");
				printmesg("Data Bahan Kimia dengan ID = $idhapus berhasil dihapus.");
  		  $ketlog="Hapus Data Bahan. ID=$idhapus, File=$d[FILEG]";
        buatlogiso(21,$ketlog,$q,$users);

			} else {
				printmesg("Data Bahan Kimia dengan ID = $idhapus tidak berhasil dihapus.");
			}
		}
	
		////////// Tampilkan Data User ///////////////
		if ($sort=="") {
			$sort="ID";
		}
		$q="SELECT * FROM bahankimia WHERE namabahan LIKE '%$nama%'
			OR idbahan LIKE '%$nama%'
			ORDER BY namabahan";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3>Rincian Data Bahan Kimia</h3>";
			
			$href="index.php?pilihan=glihat&aksi=Tampilkan&nama=$nama";
			echo "
				<table $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap width='10%'><a href='$href&sort=IDBAHAN'>ID</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Nama Bahan</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Nama Kimia</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Katalog</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Jumlah</td>
						<td nowrap ><a href='$href&sort=NAMABAHAN'>Satuan</td>
						<td nowrap ><a href='$href&sort=FILEG'>File Referensi</td>
 						<td nowrap colspan=2 width=20%>Aksi</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
						<td nowrap align=center >$data[IDBAHAN]</td>
						<td align=left >$data[NAMABAHAN]</td>
						<td align=left >$data[NAMAKIMIA]</td>
						<td align=left >$data[KATALOG]</td>
						<td align=left >$data[JUMLAH]</td>
						<td align=left >$data[SATUAN]</td>
						<td align=left><a href='file/$data[FILEG]' target=_blank>$data[FILEG]</a></td>
 						<td nowrap align=center><a href='index.php?pilihan=gupdate&idupdate=$data[IDBAHAN]'>Update</td>
						<td nowrap align=center><a 
						onclick=\"return confirm('Hapus data Bahan Kimia dengan ID = $data[IDBAHAN]?');\"
						href='$href&aksitambahan=hapus&idhapus=$data[IDBAHAN]'>Hapus</td>
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
}

if ($aksi=="") {
echo "
<h3>Lihat Data Bahan Kimia</h3>";
printmesg($errmesg);
echo "
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table width=500>
		<tr>
			<td width=20% nowrap>
				Kata Kunci ID/Nama
			</td>
			<td>
				<input type=text name=nama size=30 value='$nama'><script>form.nama.focus();</script>
			</td>
		</tr>
		<tr>
			<td colspan=2>
			<br>
				<input type=submit name=aksi value='Tampilkan'>
				<input type=reset value='Hapus Isian'>
			</td>
		</tr>
	</table>


</form >
";

}

?>
