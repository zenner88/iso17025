<?
if ($_SESSION[tingkats]!="C") {
    exit;
}

if ($aksi=="Tampilkan") {

		///////// Hapus Data User ////////////////

		if ($aksitambahan=="hapus") {
		  $q="SELECT COUNT(ID) AS JML FROM permintaan WHERE JENISANALISIS ='$idhapus'";
		  $h=doquery($q,$koneksi);
		  $d=sqlfetcharray($h);
		  $jml=$d[JML]+0;
		  
		  if ($jml>0) {
  				printmesg("Data Jenis Uji dengan ID = $idhapus tidak dihapus karena sudah dipakai pada permintaan analisis.");
      } else {
  			$q="SELECT FILE FROM jenisuji 
  			WHERE ID='$idhapus' ";
  			$h=doquery($q,$koneksi);
  			$d=sqlfetcharray($h);
  			
  			$q="DELETE FROM jenisuji WHERE ID='$idhapus'";
  			doquery($q,$koneksi);
  			if (sqlaffectedrows($koneksi)>0) {
  				@unlink("file/$d[FILE]");
  				$q="DELETE FROM varjenisuji WHERE IDJENISUJI='$idhapus'";
  				doquery($q,$koneksi);
  				printmesg("Data Jenis Uji dengan ID = $idhapus berhasil dihapus.");
      		  $ketlog="Hapus Jenis Uji. ID=$idhapus ";
            buatlogiso(24,$ketlog,$q,$users);


  			} else {
  				printmesg("Data Jenis Uji dengan ID = $idhapus tidak berhasil dihapus.");
  			}
  		}
		}
	
		////////// Tampilkan Data User ///////////////
		if ($sort=="") {
			$sort="IDKELOMPOK,NAMA";
		}
		if ($idkelompok!="") {
      $qfield="AND IDKELOMPOK = '$idkelompok'";
    }
		$q="SELECT * FROM jenisuji 
		WHERE 
		(NAMA LIKE '%$nama%' OR ID LIKE '%$nama%')
		$qtoko
		$qfield
		ORDER BY $sort";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3>Rincian Data Jenis Uji</h3>";
			
			$href="index.php?pilihan=llihat&aksi=Tampilkan&nama=$nama";
			echo "
				<table $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<!--<td nowrap width='10%'><a href='$href&sort=ID'>ID</td>-->
						<td nowrap ><a href='$href&sort=IDKELOMPOK'>Kelompok</td>
						<td nowrap ><a href='$href&sort=NAMA'>Nama Lengkap</td>
						<td nowrap ><a href='$href&sort=NAMA2'>Nama Singkat</td>
						<td nowrap ><a href='$href&sort=RUMUS'>Rumus</td>
						<td nowrap ><a href='$href&sort=RUMUS'>Hasil</td>
						<td nowrap ><a href='$href&sort=RUMUS'>Satuan</td>
						<td nowrap ><a href='$href&sort=RM'>Ref. Method</td>
 						<td nowrap colspan=2  >Aksi</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
						<!--<td nowrap align=center >$data[ID]</td>-->
						<td nowrap align=left>".$arraykelompokjenisuji[$data[IDKELOMPOK]]."</td>
						<td align=left >$data[NAMA]</td>
						<td align=left >$data[NAMA2]</td>
						<td align=center ><b>$data[RUMUS]</td>
						<td align=center ><b>$data[HASIL]</td>
						<td align=center ><b>$data[SATUAN]</td>
						<td align=center ><b>$data[RM]</td>
 						<td nowrap align=center><a href='index.php?pilihan=lupdate&idupdate=$data[ID]'>Update</td>
						<td nowrap align=center><a 
						onclick=\"return confirm('Hapus data Jenis Uji dengan ID = $data[ID]?');\"
						href='$href&aksitambahan=hapus&idhapus=$data[ID]'>Hapus</td>
					</tr>";
				$i++;
			}
						
			echo "
				</table></center>
			";
			
		} else {
			$errmesg="Data Jenis Uji tidak ada.";
			$aksi="";
		}
}

if ($aksi=="") {
echo "
<h3>Lihat Data Jenis Uji</h3>";
printmesg($errmesg);
echo "
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table width=500>
		<tr>
			<td width=20%  nowrap>
				Kata Kunci ID/Nama
			</td>
			<td>
				<input type=text name=nama size=30 value='$nama'><script>form.nama.focus();</script>
			</td>
		</tr>
			<tr>
				<td>
					Kelompok
				</td>
				<td>
				<select name=idkelompok>
				  ";
            echo "<option value=''>Semua</option>";
				  foreach ($arraykelompokjenisuji as $k=>$v) {
            echo "<option value='$k'>$v</option>";
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


</form >
";

}

?>
