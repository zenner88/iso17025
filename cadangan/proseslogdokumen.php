<?
 	$href="index.php?pilihan=$pilihan&aksi=tampilkan&";
	if ($jenislog!="") {
		$qfield.=" AND JENISLOG='".$arraylogiso[$jenislog]."'";
		$qjudul.=" Jenis Log '".$arraylogiso[$jenislog]."' <br>";
		$qinput.=" <input type=hidden name=jenislog value='$jenislog'>";
		$href.="jenislog=$jenislog&";
	}
	if (trim($kunci)!="") {
		$kunci=trim($kunci);
		$qfield.=" AND (JENISDOKUMEN  LIKE '%$kunci%' OR NAMA LIKE '%$kunci%' OR PEGAWAI LIKE '%$kunci%') ";
		$qjudul.=" Kata kunci '$kunci' <br>";
		$qinput.=" <input type=hidden name=kunci value='$kunci'>";
		$href.="kunci=$kunci&";
	}
  	if ($istglbayar==1) {
 		$qfield.="
 			AND 
 			(
 				DATE_FORMAT(WAKTU,'%Y-%m-%d') >= DATE_FORMAT('$tglbayar[thn]-$tglbayar[bln]-$tglbayar[tgl]','%Y-%m-%d')
 				AND
 				DATE_FORMAT(WAKTU,'%Y-%m-%d') <= DATE_FORMAT('$tglbayar2[thn]-$tglbayar2[bln]-$tglbayar2[tgl]','%Y-%m-%d')
 			)
 		";
		$qjudul.=" Periode  $tglbayar[tgl]-$tglbayar[bln]-$tglbayar[thn] s.d
		 $tglbayar2[tgl]-$tglbayar2[bln]-$tglbayar2[thn] 
		 <br>";
		$qinput.=" 
			<input type=hidden name=istglbayar value='$istglbayar'>
			<input type=hidden name=tglbayar[thn] value='$tglbayar[thn]'>
			<input type=hidden name=tglbayar[bln] value='$tglbayar[bln]'>
			<input type=hidden name=tglbayar[tgl] value='$tglbayar[tgl]'>
			<input type=hidden name=tglbayar2[thn] value='$tglbayar2[thn]'>
			<input type=hidden name=tglbayar2[bln] value='$tglbayar2[bln]'>
			<input type=hidden name=tglbayar2[tgl] value='$tglbayar2[tgl]'>
		";
		$href.="tglbayar[tgl]=$tglbayar[tgl]&tglbayar[bln]=$tglbayar[bln]&tglbayar[thn]=$tglbayar[thn]&
		tglbayar2[tgl]=$tglbayar2[tgl]&tglbayar2[bln]=$tglbayar2[bln]&tglbayar2[thn]=$tglbayar2[thn]&istglbayar=$istglbayar&";
 	}
	
	if ($sort=="") {
		$sort=" ID";
	}
		$qinput.=" <input type=hidden name=sort value='$sort'>";

	$q="SELECT *,WAKTU AS TANGGAL FROM logdokumen 
	WHERE 1=1
	$qfield
	ORDER BY $sort";
	$h=doquery($q,$koneksi);
	if (sqlnumrows($h) > 0) {
		if ($aksi!="cetak") {
			printjudulmenu("Data Log Aktivitas");
			printmesg($qjudul);
		} else {
			printjudulmenucetak("Data Log Aktivitas");
			printmesgcetak($qjudul);
		}

 /*
		if ($aksi!="cetak") {
			echo "
				<table class=form >
				<tr><td>
			<form target=_blank action='cetaklogdokumen.php'>
 				<input type=submit name=aksi2 class=tombol value='Cetak'>
  				$qinput
			</form>
				</td></tr></table>";
		}
		*/
		echo "
 			<table $border class=data$aksi width=100%>
			<tr class=juduldata$aksi align=center>
				<td>No</td>
				<td><a class='$cetak' href='$href"."sort=TANGGAL'>Tanggal</td>
				<td><a class='$cetak' href='$href"."sort=PEGAWAI'>ID Operator</td>
				<td><a class='$cetak' href='$href"."sort=JENISLOG'>Jenis Log</td>
				<td><a class='$cetak' href='$href"."sort=JENISDOKUMEN'>Keterangan</td>
 				<td><a class='$cetak' href='$href"."sort=ASAL'>Asal</td>
			</tr>
		";
		$i=1;
		while ($d=sqlfetcharray($h)) {
			$kelas=kelas($i);
			echo "
				<tr valign=top align=center $kelas$aksi>
					<td>$i</td>
 					<td align=left nowrap>$d[TANGGAL]</td>
 					<td align=left>$d[PEGAWAI]</td>
					<td align=left   >$d[JENISLOG]</td>
					<td align=left   >$d[JENISDOKUMEN]</td>
  					<td align=center>$d[ASAL]</td> 
 				</tr>
			";
			$i++;
		}
		echo "</table>";
		$aksi="tampilkan";
	} else {
		$errmesg="Data Log Tidak Ada";
		$aksi="";
	}
?>
