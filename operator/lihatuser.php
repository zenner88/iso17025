<?

if ($aksi=="Tampilkan") {

		///////// Hapus Data User ////////////////

		if ($aksitambahan=="hapus") {
			$q="DELETE FROM user WHERE ID='$idhapus'";
			doquery($q,$koneksi);
			if (sqlaffectedrows($koneksi)>0) {

  		  $ketlog="Hapus Operator. ID=$idhapus";
        buatlogiso(2,$ketlog,$q,$users);
				printmesg("Data Operator dengan ID = $idhapus berhasil dihapus.");
			} else {
				printmesg("Data Operator dengan ID = $idhapus tidak berhasil dihapus.");
			}
		}
	
		////////// Tampilkan Data User ///////////////
		if ($tingkat!="semua") {
			$qtingkat=" AND TINGKAT='$tingkat'";
		}
		if ($sort=="") {
			$sort="ID";
		}
		$q="SELECT ID,NAMA, TINGKAT FROM user 
		WHERE 
		NAMA LIKE '%$nama%' 
		$qtingkat
		AND ID!='superadmin'
		ORDER BY $sort";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3>Rincian Data Operator</h3>";
			
			$href="index.php?pilihan=lihat&aksi=Tampilkan&nama=$nama&tingkat=$tingkat";
			echo "
				<table $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap width='10%'><a href='$href&sort=ID'>ID</td>
						<td nowrap ><a href='$href&sort=NAMA'>Nama</td>
						<td nowrap ><a href='$href&sort=TINGKAT'>Tingkat</td>
						<td nowrap colspan=2>Aksi</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
						<td nowrap align=center >$data[ID]</td>
						<td nowrap >$data[NAMA]</td>
						<td nowrap >".$arraytingkat[$data[TINGKAT]]."</td>
						<td nowrap ><a href='index.php?pilihan=update&idupdate=$data[ID]'>Update</td>
						<td nowrap ><a onclick=\"return confirm('Hapus data Operator dengan ID = $data[ID]?');\"
						href='$href&aksitambahan=hapus&idhapus=$data[ID]'>Hapus</td>
					</tr>";
				$i++;
			}
						
			echo "
				</table></center>
			";
			
		} else {
			$errmesg="Data Operator tidak ada.";
			$aksi="";
		}
}

if ($aksi=="") {
echo "
<h3>Lihat Data Operator</h3>";
printmesg($errmesg);
echo "
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=20%>
				Kata Kunci Nama
			</td>
			<td>
				<input type=text name=nama size=30 value='$nama'><script>form.nama.focus();</script>
			</td>
		</tr>
		<tr>
			<td>
				Tingkat
			</td>
			<td>
				<select name=tingkat>";
						echo "<option $ck value=semua>Semua</option>";
					foreach ($arraytingkat as $k=>$v) {
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


</form name=form>
";

}

?>
