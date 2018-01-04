<center>
<?

if ($aksi2=="hapus" && $idanak!="" && $idanggota!="") {
		$h=doquery("SELECT NAMA,GAMBAR 
		FROM anak 
		WHERE 
		IDANGGOTA='$idanggota'
		AND ID='$idanak'",$koneksi);
		if (sqlnumrows($h)>0) {
			$d=sqlfetcharray($h);
			$h=doquery("DELETE FROM anak 
			WHERE 
			IDANGGOTA='$idanggota'
			AND ID='$idanak'",$koneksi);
			if (sqlaffectedrows($koneksi)>0) {
				@unlink("gambara/$d[GAMBAR]");
				$mesg="Data Anak dengan Nama <b>$d[NAMA]</b> dan 
				ID Anggota = $idanggota berhasil dihapus";
				printmesg($mesg);
			}
		}
}



$q="SELECT ID, NAMA 
FROM anggota WHERE ID<'$id' ORDER BY ID DESC 
LIMIT 0,1";
$h=doquery($q,$koneksi) ;
if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$prev=$data[ID];
	if ($prev!="") {
		$navprev="($data[NAMA]) <a href='index.php?pilihan=$pilihan&aksi=$aksi&id=$prev'> << sebelumnya</a>";
	}
}
$q="SELECT ID , NAMA
FROM anggota WHERE ID>'$id' 
ORDER BY ID
LIMIT 0,1";
$h=doquery($q,$koneksi) ;
if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$next=$data[ID];
	if ($next!="") {
		$navnext="<a href='index.php?pilihan=$pilihan&aksi=$aksi&id=$next'>berikutnya >></a>  ($data[NAMA])";
	}
}
$navigasi="
<b>
$navprev ......
$navnext
</b>
<br><br>
";

		$h=doquery("SELECT *
		FROM anggota WHERE ID='$id'",$koneksi);
		if (sqlnumrows($h)>0) {
			$d=sqlfetcharray($h);
			$id=$d[ID];
			$nama=$d[NAMA];
			$jeniskelamin=$d[KELAMIN];
			$tempat=$d[TEMPAT];
			$tanggal=$d[TANGGAL];
			$tmp=explode("-",$tanggal);
			$tgl=$tmp[2];
			$thn=$tmp[0];
			$bln=$tmp[1];
			$pekerjaan=$d[PEKERJAAN];
			$jabatan=$d[JABATAN];
			$alamat=$d[ALAMAT];
			$telepon=$d[TELEPON];
			$alamatk=$d[ALAMATK];
			$teleponk=$d[TELEPONK];
			$email=$d[EMAIL];
			$gambar=$d[GAMBAR];
			
			
			$namap=$d[NAMAP];
			$tempatp=$d[TEMPATP];
			$tanggal=$d[TANGGALP];
			$tmp=explode("-",$tanggal);
			$tglp=$tmp[2];
			$thnp=$tmp[0];
			$blnp=$tmp[1];
			$pekerjaanp=$d[PEKERJAANP];
			$jabatanp=$d[JABATANP];
			$alamatkp=$d[ALAMATKP];
			$teleponkp=$d[TELEPONKP];
			$emailp=$d[EMAILP];
			$gambarp=$d[GAMBARP];

			$id=$d[ID];

			if ($d[GAMBAR]!="") {
			$di=@imgsizeproph("gambar/$d[GAMBAR]",150);
			$rowgambar= "
						<img border=0 width=$di[0] height=$di[1] src='gambar/$d[GAMBAR]'>
					
			";
			}

			if ($d[GAMBARP]!="") {
			$di=@imgsizeproph("gambarp/$d[GAMBARP]",150);
			$rowgambarp= "
						<img border=0 width=$di[0] height=$di[1] src='gambarp/$d[GAMBARP]'>

			";
			}

			echo "
			$navigasi
			<center>
			<table   border=1 width=600 class=isian>
		<tr>
			<td align=center class=isianjudul colspan=3>
				<b>Rincian Data Anggota
			</td>
		</tr>
<tr>
	<td width=150  align=right class=isianjudul>
		ID Anggota 
	</td>
	<td width=250>
		$id
	</td>
	<td rowspan=11 align=center>
		$rowgambar
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Nama Kepala Keluarga
	</td>
	<td>
		$nama
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Jenis Kelamin
	</td>
	<td>
		$jeniskelamin
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Tempat dan Tanggal Lahir
	</td>
	<td>
		$tempat, $tgl-$bln-$thn
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Pekerjaan
	</td>
	<td>
		$pekerjaan
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Jabatan
	</td>
	<td>
		$jabatan
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Alamat Rumah
	</td>
	<td>
		$alamat
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Telepon Rumah
	</td>
	<td>
		$telepon
	</td>
</tr>

<tr>
	<td  align=right class=isianjudul>
		Alamat Kantor
	</td>
	<td>
		$alamatk
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Telepon Kantor
	</td>
	<td>
		$teleponk
	</td>
</tr>


<tr>
	<td  align=right class=isianjudul>
		E-mail
	</td>
	<td>
		$email
	</td>
</tr>

			</table>
<br>

<table   border=1 width=600 class=isian>
<tr>
	<td align=center class=isianjudul colspan=3>
		<b>Data Pasangan (Istri/Suami)

	</td>
</tr>
<tr>
	<td  width=150  align=right class=isianjudul>
		Nama Pasangan
	</td>
	<td width=250>
		$namap
	</td>
	<td rowspan=7 align=center>
		$rowgambarp
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Tempat dan Tanggal Lahir
	</td>
	<td>
		$tempatp, $tglp-$blnp-$thnp
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Pekerjaan
	</td>
	<td>
		$pekerjaanp
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Jabatan
	</td>
	<td>
		$jabatanp
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Alamat Kantor
	</td>
	<td>
		$alamatkp
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Telepon Kantor
	</td>
	<td>
		$teleponkp
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		E-mail
	</td>
	<td>
		$emailp
	</td>
</tr>


</table>
<br>
<center>	
<b>
[
<a href='index.php?pilihan=update&aksi=formupdate&idupdate=$id'>Update</a>
 ]</b>
<br>
<br>	

";

	$q="SELECT IDANGGOTA,ID,NAMA,TEMPAT,GAMBAR,
	DATE_FORMAT(TANGGAL,'%d-%m-%Y') AS T,PENDIDIKAN ,
	KELAMIN,
  	(YEAR(NOW())-YEAR(TANGGAL)) +  
  	IF(MONTH(NOW())>MONTH(TANGGAL),
  		0,
  		IF(MONTH(NOW())<MONTH(TANGGAL),
  			-1,
  			IF(DAYOFMONTH(NOW())>=DAYOFMONTH(TANGGAL),
  				0,
  				-1
  			)
  		)
  	) 
  	AS USIA	
	FROM anak 
	WHERE IDANGGOTA='$id'
	ORDER 
	BY TANGGAL";

	$h=doquery($q,$koneksi);
	echo mysql_error();
	if (sqlnumrows($h)>0) {
		echo "
		<b>
		Data Anak
		</b>
		<br>
		<br>
		<table border=1 width=600 class=isian $sttabelkiri>
		";
		$i=0;
		while ($d=sqlfetcharray($h)) {
			$rowgambar="";
			if ($d[GAMBAR]!="") {
			$di=@imgsizeproph("gambara/$d[GAMBAR]",100);
			$rowgambar= "
						<img border=0 width=$di[0] height=$di[1] src='gambara/$d[GAMBAR]'>
					
			";
			}


			$kelas=kelas($i);
			$sl="";
		  $slu="<br>
		  	<a href='index.php?pilihan=aupdate&aksi=formupdate&idupdate=$d[ID]&idanggota=$d[IDANGGOTA]'>Update</a>
		
		  	<a onclick=\"return confirm('Hapus Anak dengan ID Anggota = $d[IDANGGOTA] dan Nama Anak = $d[NAMA] ?');\"
		  	href='index.php?pilihan=$pilihan&id=$id&aksi2=hapus&idanak=$d[ID]&idanggota=$d[IDANGGOTA]'>Hapus</a>
		  
		  ";
			$i++;
			
			$h2=doquery("SELECT NAMA FROM anggota WHERE ID='$d[IDANGGOTA]'",$koneksi);
			if (sqlnumrows($h2)>0) {
				$d2=sqlfetcharray($h2);
			}

			echo "
			<tr>
				<td  colspan=3 class=isianjudul>
					 &nbsp;
				</td>
			</tr>
			<tr>
				<td  width=150  align=right class=isianjudul>
					Nama Anak
				</td>
				<td width=250>
					$d[NAMA]
				</td>
				<td rowspan=5 align=center>
					$rowgambar
					$slu
				</td>
			</tr>
			<tr>
				<td  align=right class=isianjudul>
					Jenis Kelamin
				</td>
				<td>
					$d[KELAMIN]
				</td>
			</tr>
			<tr>
				<td  align=right class=isianjudul>
					Tempat dan Tanggal Lahir
				</td>
				<td>
					$d[TEMPAT], $d[T]
				</td>
			</tr>
			<tr>
				<td  align=right class=isianjudul>
					Usia
				</td>
				<td>
					$d[USIA] tahun
				</td>
			</tr>
			<tr>
				<td  align=right class=isianjudul>
					Pendidikan
				</td>
				<td>
					$d[PENDIDIKAN]
				</td>
			</tr>
			
			";

		
		}
		echo "</table>";
	} else {
		printmesg("Data Anak  tidak ada");
	}


echo "
<br><br>	
$navigasi			
</center>
			";
	}
?>