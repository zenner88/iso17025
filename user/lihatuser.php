<?

if ($aksi=="Tampilkan") {

		///////// Hapus Data User ////////////////

		if ($aksitambahan=="hapus") {
			$q="DELETE FROM pemakai WHERE ID='$idhapus'";
			doquery($q,$koneksi);
			if (sqlaffectedrows($koneksi)>0) {
				printmesg("Data pemakai dengan ID = $idhapus berhasil dihapus.");
			} else {
				printmesg("Data pemakai dengan ID = $idhapus tidak berhasil dihapus.");
			}
		}
	
		////////// Tampilkan Data User ///////////////
		if ($lab!="semua") {
			$qlab=" AND IDLAB='$lab'";
		}
		if ($sort=="") {
			$sort="ID";
		}
		$q="SELECT ID,NAMA, IDLAB FROM pemakai 
		WHERE 
		NAMA LIKE '%$nama%' 
		$qlab
		ORDER BY $sort";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3>Rincian Data Pemakai</h3>";
			
			$href="index.php?pilihan=lihat&aksi=Tampilkan&nama=$nama&lab=$lab";
			echo "
				<table $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap width='10%'><a href='$href&sort=ID'>ID</td>
						<td nowrap ><a href='$href&sort=NAMA'>Nama</td>
						<td nowrap ><a href='$href&sort=IDLAB'>Lab</td>
						<td nowrap colspan=2>Aksi</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				echo "
					<tr $kelas valign=top>
						<td nowrap align=center >$i</td>
						<td nowrap align=center >$data[ID]</td>
						<td nowrap >$data[NAMA]</td>
						<td nowrap >".$arraylab[$data[IDLAB]]."</td>
						<td nowrap ><a href='index.php?pilihan=update&idupdate=$data[ID]'>Update</td>
						<td nowrap ><a onclick=\"return confirm('Hapus data pemakai dengan ID = $data[ID]?');\"
						href='$href&aksitambahan=hapus&idhapus=$data[ID]'>Hapus</td>
					</tr>";
				$i++;
			}
						
			echo "
				</table></center>
			";
			
		} else {
			$errmesg="Data pemakai tidak ada.";
			printmesg($errmesg);
		}
}

else {
echo "
<h3>Lihat Data Pemakai</h3>
<form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=20%>
				Kata Kunci Nama
			</td>
			<td>
				<input type=text name=nama size=30 value='$nama'>
			</td>
		</tr>
		<tr>
			<td>
				Laboratorium
			</td>
			<td>
				<select name=lab>";
						echo "<option $ck value=semua>Semua</option>";
					foreach ($arraylab as $k=>$v) {
						echo "<option $ck value=$k>$v</option>";
					}
			echo "
				</select>
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


</form>
";

}

?>