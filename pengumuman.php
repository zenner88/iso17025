<table <?=$tabelpengumuman?>>
<tr valign=top>
<td >
<center><h3 style='font-family:Arial'><b>Berita Terbaru dan Pengumuman</b></h3></center>
<?

$query="SELECT NAMA,KELAMIN, YEAR(NOW())-YEAR(TGLLAHIR) AS USIA FROM
	user WHERE DAYOFMONTH(TGLLAHIR) = DAYOFMONTH(NOW()) AND MONTH(TGLLAHIR)=MONTH(NOW()) ";
$hasil=doquery($query,$koneksi);
echo mysql_error();
if (sqlnumrows($hasil)>0) {
	$daftar="";
	while ($data=sqlfetcharray($hasil)) {
		$daftar.="$data[NAMA]";
		if ($data[KELAMIN]=="L") {
			$daftar.= " yang ke $data[USIA], ";
		} else {
			$daftar.=", ";
		}
	}
	echo "<table width=95% style='font-size:12pt;color:#000088'>
	<tr valign=middle align=center>
	<td>
	Selamat Ulang Tahun kepada $daftar semoga panjang umur, sehat, dan sukses 
	selalu. Amin.</td></tr></table><br>";

}

if ($aksi==detil) {
	$query="SELECT ID,DATE_FORMAT(TANGGAL,'%d-%m-%Y %H:%i:%s') AS TGL,JUDUL,
	SUBSTRING(RINCIAN,1,LENGTH(RINCIAN)+1) AS RINCIAN2,
	 IF(TO_DAYS(TANGGAL)>=TO_DAYS(NOW())-3,'Baru,','') AS BARU,LOKASI  FROM
		pengumuman WHERE ID=$id";
} else {
	
$query="SELECT ID,DATE_FORMAT(TANGGAL,'%d-%m-%Y %H:%i:%s') AS TGL,JUDUL,
SUBSTRING(RINCIAN,1,500) AS RINCIAN2,
IF(LENGTH(RINCIAN)>500,1,0) AS P, 
 IF(TO_DAYS(TANGGAL)>=TO_DAYS(NOW())-3,'Baru,','') AS BARU,LOKASI  FROM
	pengumuman ORDER BY TANGGAL DESC LIMIT 0,11";
}
$hasil=doquery($query,$koneksi);
echo mysql_error();
if (sqlnumrows($hasil)>0) {
//	echo "<ol>";
	$i=1;
	while ($data=sqlfetcharray($hasil)) {
		if ($i>10) {break;}
		if (file_exists("pengumuman/gambar/".$data[ID].".txt")) {
			$logo=file("pengumuman/gambar/".$data[ID].".txt");
			$filelogo=$logo[0];
			$size=imgsizeprop("pengumuman/gambar/$filelogo",120);
			$img="<img  align=left height=$size[1] width=$size[0] src='pengumuman/gambar/$filelogo'>";
			
		}
		$selengkapnya="";
		if ($data[P]==1) {
			$selengkapnya="<a style='font-size:9pt;font-family:Arial' href='index.php?pilihan=berita&aksi=detil&id=$data[ID]'><h5 >Lihat selengkapnya</h5></a>";
		}
		echo "
		<table >
		<tr>
		<td>
		<h4 style='font-family:Arial'>$data[JUDUL]</h4>
		<p align=justify>
		$img <font style='font-size:11pt;'>$data[RINCIAN2]... </font>(<font style='font-size:8pt;'><b style='color:#000088'>$data[BARU]</b>".$arraylokasi[$data[LOKASI]].",  $data[TGL]</font>)
		</p>
		$selengkapnya
		</td>
		</tr>
		</table>
		<hr size=1>";
		$img="";
		$filelogo="";
		$i++;
	}
//	echo "</ol>";
	if ($i>10 && sqlnumrows($hasil)>10) {	
		echo "<center><a target=_blank style='color:#000066;' href='daftarpengumuman.php'>Lihat pengumuman sebelumnya...</a></center>";
	}

} else {
	echo "<center>Tidak ada pengumuman...</center>";
}
?>
</td>
</tr>
</table>
<SCRIPT>
	setTimeout("history.go(0)",1000*60);
</SCRIPT>