<?
if ($_SESSION[tingkats]!="F") {
    exit;
}

 
		///////// Hapus Data User ////////////////

 			$href="index.php?pilihan=$pilihan&aksi=Tampilkan";
	
 
				$qfield.=" AND ID='$idupdate' ";
				$judul.=" ID = $idupdate <br>";
				$href.="&idupdate=$idupdate";
 
 				$qfield.=" AND IDKLIEN='$users' ";
				$judul.=" Klien = ".getnamatoko($users)." <br>";
				$href.="&idklien=$users";
 
  			if ($statuspermintaan!="") {
		  	$qfield.=" AND STATUS='$statuspermintaan' ";
				$judul.=" Status Permintaan = ".$arraystatushasil[$statuspermintaan]." <br>";
				$href.="&statuspermintaan=$statuspermintaan";
			}
 			if ($istglm==1) {
				$qfield.="
				AND 
				( 
					TANGGALDATANG>=DATE_FORMAT('$thnmd-$blnmd-$tglmd','%Y-%m-%d')
					AND
					TANGGALDATANG<=DATE_FORMAT('$thnms-$blnms-$tglms','%Y-%m-%d')
				)
				";
				$judul.="Tanggal Permintaan antara $tglmd-$blnmd-$thnmd s.d $tglms-$blnms-$thnms  <br>";
				$href.="&istglm=$istglm&tglmd=$tglmd&blnmd=$blnmd&thnmd=$thnmd&tglms=$tglms&blnms=$blnms&thnms=$thnms";
			}
			if ($istgld==1) {
				$qfield.="
				AND 
				( 
					TANGGALDEADLINE>=DATE_FORMAT('$thndd-$blndd-$tgldd','%Y-%m-%d')
					AND
					TANGGALDEADLINE<=DATE_FORMAT('$thnds-$blnds-$tglds','%Y-%m-%d')
				)
				";
				$judul.="Tanggal Deadline antara $tgldd-$blndd-$thndd s.d $tglds-$blnds-$thnds  <br>";
				$href.="&istgld=$istgld&tgldd=$tgldd&blndd=$blndd&thndd=$thndd&tglds=$tglds&blnds=$blnds&thnds=$thnds";
			}
			if ($istgls==1) {
				$qfield.="
				AND 
				( 
					TANGGALSELESAI>=DATE_FORMAT('$thnsd-$blnsd-$tglsd','%Y-%m-%d')
					AND
					TANGGALSELESAI<=DATE_FORMAT('$thnss-$blnss-$tglss','%Y-%m-%d')
				)
				";
				$judul.="Tanggal Deadline antara $tglsd-$blnsd-$thnsd s.d $tglss-$blnss-$thnss  <br>";
				$href.="&istgls=$istgls&tglsd=$tglsd&blnsd=$blnsd&thnsd=$thnsd&tglss=$tglss&blnss=$blnss&thnss=$thnss";
			}
		  
	
		////////// Tampilkan Data User ///////////////
		if ($sort=="") {
			$sort="ID";
		}
		 $q="SELECT 
		*,
		DATE_FORMAT(TANGGALDATANG,'%d-%m-%Y') AS TGLMASUK,
		DATE_FORMAT(TANGGALDEADLINE,'%d-%m-%Y') AS TGLDEADLINE,
		DATE_FORMAT(TANGGALSELESAI,'%d-%m-%Y') AS TGLSELESAI
		 FROM minta 
		WHERE IDKLIEN='$users' AND STATUS=1 
		$qfield
		$qtoko
		ORDER BY $sort";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			// PERIKSASURVEY
			$q="SELECT ID FROM survey WHERE ID='$idupdate'";
			$hs=doquery($q,$koneksi);
			echo mysql_error();
			if (sqlnumrows($hs)>0) {
			
			
			echo "<center><h3>LAPORAN HASIL ANALISIS</h3>";
			echo("<p class=judulhaltabel>".$judul."</p>");
			echo "
			<form action=cetaklapadm.php method=POST target=_blank>
				<input type=hidden name=idklien value='$idklien'>
				<table width=95%  $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap width='10%'><a href='$href&sort=ID'>Kode</td>
						<td nowrap width='10%'><a href='$href&sort=NOMER1'>REPORT NUMBER</td>
						<td nowrap width='10%'><a href='$href&sort=NOMER2'>REF. ORDER NUMBER</td>
						<td nowrap width='10%'><a href='$href&sort=SAMPEL'>Sampel</td>
 						<td nowrap ><a href='$href&sort=TANGGALDATANG'>Tgl<br>Masuk</td>
						<td nowrap ><a href='$href&sort=TANGGALDEADLINE'>Tgl<br>Deadline</td>
						<td nowrap ><a href='$href&sort=TANGGALSELESAI'>Tgl<br>Selesai</td>
 						<td nowrap ><a href='$href&sort=STATUS'>Status</td>
 						<td nowrap ><a href='$href&sort=IDUSER'>Adm.</td>
 						<td nowrap ><a href='$href&sort=IDMAN'>Manager<br>Teknis</td>
						<td nowrap  >Pilih</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				echo "
				<input type=hidden name=idklien value='$data[IDKLIEN]'>
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
						<td nowrap align=center >$data[ID]</td>
						<td nowrap align=center >$data[NOMER1]</td>
						<td nowrap align=center >$data[NOMER2]</td>
						<td nowrap align=center >$data[CONTOH]</td>
 						<td   align=center nowrap>$data[TGLMASUK]</td>
						<td   align=center nowrap>$data[TGLDEADLINE]</td>
						<td   align=center nowrap>$data[TGLSELESAI]</td>
 						<td  align=left>".$arraystatushasil[$data[STATUS]]."</td>
 						<td  align=left>".getnama($data[IDUSER])."</td>
 						<td  align=left>".getnama($data[IDMAN])."</td>
						<td nowrap align=center><input checked type=checkbox name=pilihid[$data[ID]] value='1'> </td>
 					</tr>";
				$i++;
			}
						
			echo "
				</table>
				<br>
	<table width=95% $borderdata class=data >
	<tr>
		<td  align=left width=150>Keterangan</td>
		<td align=left>
			<textarea name=keterangan class=teksbox cols=40 rows=3>$keterangan</textarea>
		</td>
		</tr>
	<tr>
		<td  align=left width=150>Catatan</td>
		<td align=left>
			<textarea name=catatan class=teksbox cols=40 rows=3>$catatan</textarea>
		</td>
		</tr>
	<tr>
		<td  align=left width=150>Kota dan Tanggal Laporan</td>
		<td align=left>
		<input type=text class=teksbox name=kotalap size=10 value='$kotalap'>
			<select class=teksbox name=tgllap>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tgllap==""){
							$cek="selected";
						}	elseif ($tgllap==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blnlap>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blnlap==""){
							$cek="selected";
						} else						
						if ($i==$blnlap) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thnlap>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year]  && $thnlap==""){
							$cek="selected";
						}	 else					
						if ($i==$thnlap) {
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
				<td align=left>
					Jenis Laporan
				</td>					
				<td align=left>
				<select name=jenisl>
					<option value='0'>Baris</option>
					<option value='1'>Kolom</option>
				</select>
				</td></tr>

	<tr>
		<td  align=left width=150>Desimal</td>
		<td align=left>
			<input type=text name=desimal value='2' size=1 maxlength=1> angka di belakang koma
		</td>
		</tr>
	<tr>
		<td  align=left  >Cetak Kop Surat</td>
		<td align=left>
			<input type=checkbox checked name=kop value='1'  > Ya
		</td>
		</tr>

	<tr>
		<td  align=left width=150>Penandatangan</td>
		<td align=left>
			Nama : <input type=text name=namattd value='$namattd' size=40 > <br>  
			Jabatan : <input type=text name=jabatanttd value='$jabatanttd' size=40 >  
		</td>
		</tr>


				<tr><td align=left colspan=2>
				<br>
				<input class=masukan 	type=submit value='Cetak Laporan'>
				</td></tr>
				</table>
				</form>
				</center>
				
				
			";
			} else {
		  printjudulmenu("<b>LAPORAN HASIL ANALISIS</b>");
			$errmesg="Anda belum mengisi survey. Untuk melihat laporan hasil analisis, silakan isi survey berikut ini.";
			$aksi="";
			printmesg($errmesg);
        echo "
        <Center><a style='font-size:20pt;' href='index.php?idupdate=$idupdate&pilihan=survey'>ISI SURVEY</a></CENTER>
        ";
      
      }
			
		} else {
		  printjudulmenu("<b>LAPORAN HASIL ANALISIS</b>");
			$errmesg="Status Permintaan Analisis belum selesai.";
			$aksi="";
			printmesg($errmesg);
		}
 

 
?>
