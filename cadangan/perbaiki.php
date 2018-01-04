<?
 printjudulmenu("Perbaiki Tabel Data");

if ($aksi=="Perbaiki") {
	
	$q="SHOW TABLES";

	$h=doquery($q,$koneksi);
	echo mysql_error();
	if (sqlnumrows($h)>0) {
		printjudulmenukecil("Daftar Tabel yang diperbaiki");
		echo "
		<table class=data>
			<tr align=center class=juduldata>
				<td>No</td>
				<td>Nama Tabel</td>
				<td>Status Perbaikan</td>
			</tr>
		";
		$i=0;
		while ($d=sqlfetcharray($h)) {
			if ($i%2==0) {
				$kelas="dataganjil";
			} else {
				$kelas="datagenap";
			}
			$i++;
			$status="";
				$hh=doquery("REPAIR TABLE $d[0]",$koneksi);
				echo mysql_error();
				if (sqlnumrows($hh)>0) {
					$dd=sqlfetcharray($hh);
					$status=$dd[3];
				}

			echo "
				<tr valign=top class=$kelas>
						<td align=center>$i</td>
						<td nowrap >$d[0]</td>
						<td align=center>$status</td>
					</tr>
			";
		
		
		}
		echo "</table>";
	} else {
		printmesg("Tabel tidak ada");
		$aksi="";
	}

//////////////
}  
if ($aksi=="") {
echo "
	<form action=index.php  method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	
	<table class=form>
		<tr>
			<td align=center>
				<p><br></p>
				<p>
				Jika Anda yakin hendak memperbaiki tabel-tabel basis data,<br>
				silakan tekan tombol <b>Perbaiki</b>
				</p>
				<p></p>
			</td>
		</tr>
		<tr>
			<td align=center>
				<input class=tombol type=submit name=aksi value=Perbaiki>
			</td>
		</tr>
	</table>
	
	</form>
	";

}	
	

?>