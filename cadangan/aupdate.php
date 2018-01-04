<?

if ($aksi==Update) {
			if (!is_array($kegiatan)) {
				$mesg="Data Kegiatan harus dipilih minimal 1";
			} else {
				$datakegiatan=implode(",",$kegiatan);
				$q="UPDATE datang
				SET
				IDANGGOTA='$id',
				NAMA='$nama',
				TELEPON='$telepon',
				TANGGAL='$thn-$bln-$tgl',
				CATATAN='$catatan',
				KEGIATAN='$datakegiatan',
				UPDATER='$users',
				TGLUPDATE=NOW()
				WHERE 
				ID='$idupdate'
				";
				doquery($q,$koneksi);
				if (sqlaffectedrows($koneksi)>0) {
					$mesg="Data Kegiatan berhasil diupdate";
				} else {
					$mesg="Data Kegiatan tidak diupdate";
				}
			}
	$aksi="formupdate";
}



if ($aksi2=="hapus" && $idhapus!="") {
			$h=doquery("DELETE FROM datang
			WHERE 
			ID='$idhapus'",$koneksi);
			if (sqlaffectedrows($koneksi)>0) {
				$mesg="Data Kegiatan Harian berhasil dihapus";
			}
}

echo "
<table border=0 width=640>
<tr  class=judulsm>
<td align=center><b>

</td>
</tr>
</table>
";

printmesg($mesg);
if ($aksi=="Lanjut") {
/////////////
	if (trim($kunci)!="") {
		$where="
			AND ( 
			$kategori LIKE '%$kunci%'
			)
		";
		$jkunci="<br> Kata Kunci : '$kunci', 
		Kategori : '".ucfirst(strtolower($kategori))."'";
	}
	

	if ($id!="") {
		$qid=" AND IDANGGOTA='$id' ";
		$jid="<br>ID Anggota : $id";
	}

	if ($jenisanggota!="semua") {
		if($jenisanggota=="tamu") {
			$qjenisanggota=" AND ID='' ";
			$jjenisanggota="<br>Jenis Keanggotaan: 
			Tamu ";
		} else {	
			$tanggota=", anggota ";
			$whereanggota=" AND anggota.ID=datang.IDANGGOTA ";
			$wherejenisanggota=" AND anggota.JENIS='$jenisanggota' ";
			$jjenisanggota="<br>Jenis Keanggotaan: 
			".$arrayjenisanggota[$jenisanggota]."";
		}
	}

	$qtanggal="
		AND 
		(
			TANGGAL >=DATE_FORMAT('$thnd-$blnd-$tgld','%Y-%m-%d') AND
			TANGGAL <=DATE_FORMAT('$thns-$blns-$tgls','%Y-%m-%d') 
		)
	";
	$jtanggal="<br> Tanggal Kegiatan dari '$tgld-$blnd-$thnd' s.d '$tgls-$blns-$thns'";
	

	if ($sort=="") {
		$sort="TANGGAL,IDANGGOTA";
	}
	
	$q="SELECT IDANGGOTA,ID,NAMA,TELEPON,
	DATE_FORMAT(TANGGAL,'%d-%m-%Y') AS T,
	KEGIATAN,
	CATATAN
	FROM datang $tanggota
	WHERE 1=1
	$whereanggota
	$wherejenisanggota	
	$where 
	$qid
	$qtanggal
	ORDER 
	BY $sort";

	$h=doquery($q,$koneksi);
	echo mysql_error();
	if (sqlnumrows($h)>0) {
		$href="index.php?pilihan=$pilihan&aksi=$aksi&
		kunci=$kunci&kategori=$kategori&
		tgld=$tgld&blnd=$blnd&thnd=$thnd&
		tgls=$tgls&blns=$blns&thns=$thns&
		id=$id&jenisanggota=$jenisanggota";
		echo "
		<b>
		Data Kegiatan Harian
		$jid
		$jjenisanggota
		$jkunci
		$jtanggal
		</b>
		<br>
		<br>
		<table width=600 $sttabelkiri>
			<tr align=center class=judulb>
				<td>No</td>
				<td><a href='$href&sort=TANGGAL'>Tanggal</td>
				<td><a href='$href&sort=IDANGGOTA'>ID Anggota</td>
				<td>Jenis Anggota </td>
				<td><a href='$href&sort=NAMA'>Nama </td>
				<td><a href='$href&sort=TELEPON'>Telepon</td>
				<td><a href='$href&sort=KEGIATAN'>Kegiatan</td>
				<td><a href='$href&sort=CATATAN'>Catatan</td>
				<td colspan=2>Aksi</td>
			</tr>
		";
		$i=0;
		while ($d=sqlfetcharray($h)) {
			$kelas=kelas($i);
			$sl="";
		  $sl="
		  <td align=center>
		  	<a href='index.php?pilihan=aupdate&aksi=formupdate&idupdate=$d[ID]'>Update</a>
		  </td>
		  <td align=center>
		  	<a onclick=\"return confirm('Hapus Kegiatan dengan Tanggal = $d[T] dan Catatan = $d[CATATAN] ?');\"
		  	href='$href&aksi2=hapus&idhapus=$d[ID]'>Hapus</a>
		  </td>
		  ";
			$i++;
			$jenisa="Tamu";			

			if (trim($d[IDANGGOTA])!="") {
				$hh=doquery("SELECT NAMA,TELEPON,JENIS FROM anggota 
				WHERE ID='$d[IDANGGOTA]'",$koneksi);
				if (sqlnumrows($hh)>0) {
					$dd=sqlfetcharray($hh);
					if ($dd[NAMA]!="") {
						$d[NAMA]="<a href='../anggota/index.php?pilihan=lengkap&id=$d[IDANGGOTA]'>".$dd[NAMA]."</a>";
						$d[TELEPON]=$dd[TELEPON];
						
					}
					$jenisa=$arrayjenisanggota[$dd[JENIS]];
				}
			}

				$datakegiatan="";
				$kegiatan=explode(",",$d[KEGIATAN]);
				foreach ($kegiatan as $k=>$v) {
					if ($arraykegiatan[$v]!="") {
						$datakegiatan.=$arraykegiatan[$v].", ";
					}
				}


			echo "
				<tr valign=top $kelas>
						<td align=center>$i</td>
						<td nowrap align=center>$d[T]</td>
						<td align=center>$d[IDANGGOTA]</td>
						<td align=center>$jenisa</td>
						<td>
						$d[NAMA]</td>
						<td align=center>$d[TELEPON]</td>
						<td>$datakegiatan</td>
						<td>$d[CATATAN]</td>
							$sl						

					</tr>
			";
		
		
		}
		echo "</table>";
	} else {
		printmesg("Data Kegiatan yang dicari tidak ada");
	}

//////////////
} elseif($aksi=="formupdate") {


$q="SELECT ID, NAMA 
FROM datang WHERE ID<'$idupdate' 
ORDER BY ID DESC 
LIMIT 0,1";
$h=doquery($q,$koneksi) ;
if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$prev=$data[ID];
	if ($prev!="") {
		$navprev="<a href='index.php?pilihan=$pilihan&aksi=$aksi&idupdate=$prev&idanggota=$idanggota'> << sebelumnya</a>";
	}
}
$q="SELECT ID 
FROM datang WHERE 
ID >'$idupdate' 
ORDER BY ID
LIMIT 0,1";
$h=doquery($q,$koneksi) ;
if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$next=$data[ID];
	if ($next!="") {
		$navnext="<a href='index.php?pilihan=$pilihan&aksi=$aksi&idupdate=$next&idanggota=$idanggota'>berikutnya >></a>";
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
		FROM datang WHERE 
		ID='$idupdate'
		",$koneksi);
		if (sqlnumrows($h)>0) {
			$d=sqlfetcharray($h);
			$id=$d[IDANGGOTA];
			$nama=$d[NAMA];
			$tanggal=$d[TANGGAL];
			$tmp=explode("-",$tanggal);
			$tgl=$tmp[2];
			$thn=$tmp[0];
			$bln=$tmp[1];
			$telepon=$d[TELEPON];
			$catatan=$d[CATATAN];
			$datakegiatan=explode(",",$d[KEGIATAN]);

			

	$aksi2="ok";
	$anggota="tidak";
	if ($id!="") {
		$q="SELECT anggota.ID,anggota.NAMA,anggota.JENIS,
		jenisanggota.FASILITAS 
		FROM 
		anggota,jenisanggota 
		WHERE 
		anggota.JENIS=jenisanggota.ID 
		AND
		anggota.ID='$id'";
		$hd=doquery($q,$koneksi);
		if (sqlnumrows($hd)<=0) {
			$aksi="";
			$aksi2="iderror";
		} else {
			$dd=sqlfetcharray($hd);
			$aksi2="ok";
			$anggota="ya";
			$d[NAMA]=$dd[NAMA];
			$d[JENIS]=$dd[JENIS];
			$d[TELEPON]=$dd[TELEPON];
			//echo $dd[FASILITAS];
			$tingkatakses=explode(",",$dd[FASILITAS]);
		}
	}



			echo "
			$navigasi
			<form ENCTYPE=\"MULTIPART/FORM-DATA\" action=index.php method=post>
			<input type=hidden name=pilihan value='$pilihan'>
			<input type=hidden name=idupdate value='$idupdate'>
			<table   border=1 width=600 class=isian>
		<tr>
			<td align=center class=isianjudul colspan=2>
				<b>Update Data Kegiatan
			</td>
		</tr>";
if ($anggota=="ya") {
echo "
<tr>
	<td  align=right class=isianjudul>
		ID Anggota 
	</td>
	<td>
		<input type=text size=10 name=id value='$id'> $d[NAMA],  (".$arrayjenisanggota[$d[JENIS]].")
	</td>
</tr>";
} else {
echo "
<tr>
	<td  align=right class=isianjudul>
		Nama Tamu
	</td>
	<td>
		<input type=text size=40 name=nama value='$nama'> Khusus Non Anggota
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Telepon
	</td>
	<td>
		<input type=text size=10 name=telepon value='$telepon'>
		 Khusus Non Anggota
	</td>
</tr>";
}
echo "
<tr>
	<td  align=right class=isianjudul>
		Tanggal
	</td>
	<td>
			<select class=masukan name=tgl>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tgl==""){
							$cek="selected";
						}	elseif ($tgl==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=masukan name=bln>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $bln==""){
							$cek="selected";
						} else						
						if ($i==$bln) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=masukan name=thn>
			";
					for ($i=1900;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year] && $thn==""){
							$cek="selected";
						}	 else					
						if ($i==$thn) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>
	</td>
</tr>
	<tr>
		<td  align=right class=isianjudul>Kegiatan yang Dilakukan</td>
		<td>";
if ($anggota=="ya") {
	foreach ($tingkatakses as $k=>$v) {
		if ($arraykegiatan[$v]!="") {
			$cek="";
			if (in_array($v,$datakegiatan)) {
				$cek="checked";
			}
			echo "<input type=checkbox name=kegiatan[$k] 
			value='$v' $cek>".$arraykegiatan[$v]."</option><br>";
		}
	}
} else {
	foreach ($arraykegiatan as $k=>$v) {
		$cek="";
		if (in_array($k,$datakegiatan)) {
			$cek="checked";
		}
		echo "<input type=checkbox 
		name=kegiatan[$k] $cek value='$k' >$v</option><br>";
	}
} 
echo "
	</td>
	</tr>
<tr>
	<td  align=right class=isianjudul>
		Catatan
	</td>
	<td>
		<textarea cols=60 rows=5 name=catatan>$catatan</textarea>
	</td>
</tr>

			</table>
<br><br>


<br>
		<input type=submit name=aksi value=Update>
		<input type=reset>
			</form>
<center>			
$navigasi			
</center>
			";
	}
} else {
echo "
	<form action=index.php  method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	
	<table border=1  class=isian>
		<tr>
			<td align=center class=isianjudul colspan=2>
				<b>Cari Data Kegiatan Harian
			</td>
		</tr>
		<tr>
			<td  align=right class=isianjudul>
				ID Anggota
			</td>
			<td>
				<input type=text size=10 name=id>
			</tr>
		</tr>
		<tr>
			<td  align=right class=isianjudul>
				Jenis Keanggotaan
			</td>
			<td>
					<select class=masukan name=jenisanggota>
						<option value='semua'>Semua</option>
						<option value='tamu'>Tamu</option>					
					";
							foreach ($arrayjenisanggota as $k=>$v) {
								echo "<option value='$k'>$v</option>";
								$cek="";
							}
					echo "
					</select>			
			</td>
		</tr>
		<tr>
			<td  align=right class=isianjudul>
				Kata Kunci 
			</td>
			<td>
				<input type=text size=30 name=kunci>
				Kategori
				<select name=kategori>
					<option value='NAMA'>Nama Tamu
					<option value='TELEPON'>Telepon
					<option value='CATATAN'>Catatan
				</select>
			</td>
		</tr>
		<tr>
			<td  align=right class=isianjudul>
				Tanggal Kegiatan Dari
			</td>
			<td>
					<select class=masukan name=tgld>
					";
							for ($i=1;$i<=31;$i++) {
								if ($i==$waktu[mday]  && $tgld==""){
									$cek="selected";
								}	elseif ($tgld==$i) {
									$cek="selected";
								} 
								echo "<option value=$i $cek>$i</option>";
								$cek="";
							}
					echo "
					</select>-			
					<select class=masukan name=blnd>
					";
							for ($i=1;$i<=12;$i++) {
								if ($i==$waktu[mon] && $blnd==""){
									$cek="selected";
								} else						
								if ($i==$blnd) {
									$cek="selected";
								} 
								echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
								$cek="";
							}
					echo "
					</select>-
					<select class=masukan name=thnd>
					";
							for ($i=1900;$i<=$waktu[year];$i++) {
								if ($i==1900 && $thnd==""){
									$cek="selected";
								}	 else					
								if ($i==$thnd) {
									$cek="selected";
								} 
								echo "<option value='$i' $cek>$i</option>";
								$cek="";
							}
					echo "
					</select>
			</td>
		</tr>
		<tr>
			<td  align=right class=isianjudul>
				Sampai
			</td>
			<td>
					<select class=masukan name=tgls>
					";
							for ($i=1;$i<=31;$i++) {
								if ($i==$waktu[mday]  && $tgls==""){
									$cek="selected";
								}	elseif ($tgls==$i) {
									$cek="selected";
								} 
								echo "<option value=$i $cek>$i</option>";
								$cek="";
							}
					echo "
					</select>-			
					<select class=masukan name=blns>
					";
							for ($i=1;$i<=12;$i++) {
								if ($i==$waktu[mon] && $blns==""){
									$cek="selected";
								} else						
								if ($i==$blns) {
									$cek="selected";
								} 
								echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
								$cek="";
							}
					echo "
					</select>-
					<select class=masukan name=thns>
					";
							for ($i=1900;$i<=$waktu[year];$i++) {
								if ($i==$waktu[year] && $thns==""){
									$cek="selected";
								}	 else					
								if ($i==$thns) {
									$cek="selected";
								} 
								echo "<option value='$i' $cek>$i</option>";
								$cek="";
							}
					echo "
					</select>
			</td>
		</tr>
		<tr>
			<td  align=right class=isianjudul>
			</td>
			<td>
				<input type=submit name=aksi value=Lanjut>
			</td>
		</tr>
	</table>
	
	</form>
	";

}	
	
	echo "

<table border=0 width=630>
<tr  class=judulsm>
<td><b>
&nbsp;
</td>
</tr>
</table>

";
?>