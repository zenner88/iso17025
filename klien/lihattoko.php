<?
if ($_SESSION[tingkats]!="B") {
    exit;
}

if ($aksi=="Tampilkan") {

		///////// Hapus Data User ////////////////

		if ($aksitambahan=="hapus") {
 				$q="DELETE FROM toko WHERE ID='$idhapus'";
				doquery($q,$koneksi);
				if (sqlaffectedrows($koneksi)>0) {
					printmesg("Data Klien dengan ID = $idhapus berhasil dihapus.");
 				} else {
					printmesg("Data Klien dengan ID = $idhapus tidak berhasil dihapus.");
				}
 		}
	
		////////// Tampilkan Data User ///////////////
		if ($sort=="") {
			$sort="ID";
		}
		$q="SELECT * FROM toko 
		WHERE 
		NAMA LIKE '%$nama%' 
		$qtoko
		ORDER BY $sort";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3>Rincian Data Klien</h3>";
			
			$href="index.php?pilihan=llihat&aksi=Tampilkan&nama=$nama";
			echo "
				<table $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap width='10%'><a href='$href&sort=ID'>ID</td>
						<td nowrap ><a href='$href&sort=NAMA'>Nama</td>
						<td nowrap ><a href='$href&sort=KONTAK'>Kontak</td>
						<td nowrap ><a href='$href&sort=TELEPON'>Telepon</td>
						<td nowrap ><a href='$href&sort=ALAMAT'>Alamat</td>
						<td nowrap colspan=2 width=20%>Aksi</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
						<td nowrap align=center >$data[ID]</td>
						<td  >$data[NAMA]</td>
						<td   >$data[KONTAK]</td>
						<td   >$data[TELEPON]</td>
						<td  >$data[ALAMAT]</td>
						<td nowrap align=center><a href='index.php?pilihan=lupdate&idupdate=$data[ID]'>Update</td>
						<td nowrap align=center><a 
						onclick=\"return confirm('Hapus data Klien dengan ID = $data[ID]?');\"
						href='$href&aksitambahan=hapus&idhapus=$data[ID]'>Hapus</td>
					</tr>";
				$i++;
			}
						
			echo "
				</table></center>
			";
			
		} else {
			$errmesg="Data Klien tidak ada.";
			$aksi="";
		}
}

if ($aksi=="") {
echo "
<h3>Lihat Data Klien</h3>";
printmesg($errmesg);
echo "
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=20%  nowrap>
				Kata Kunci Nama
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


</form name=form>
";

}

?>
