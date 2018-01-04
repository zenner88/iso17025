<?
if ($_SESSION[tingkats]!="B") {
    exit;
}

if ($aksi=="Tampilkan") {

		///////// Hapus Data User ////////////////

 			$href="index.php?pilihan=$pilihan&aksi=Tampilkan";
	
 			if ($idupdate!="") {
				$qfield.=" AND ID='$idupdate' ";
				$judul.=" ID = $idupdate <br>";
				$href.="&idupdate=$idupdate";
			}
 			if ($idklien!="") {
				$qfield.=" AND IDKLIEN='$idklien' ";
				$judul.=" Klien = ".getnamatoko($idklien)." <br>";
				$href.="&idklien=$idklien";
			}
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
		WHERE 1=1
		$qfield
		$qtoko
		ORDER BY $sort";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3>Buat Laporan Administrasi</h3>";
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
			$errmesg="Data Permintaan Analisis tidak ada.";
			$aksi="";
		}
}

if ($aksi=="") {
echo "
<h3>Buat Laporan Administrasi</h3>";
printmesg($errmesg);
echo "
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
 		<tr>
			<td width=20%  nowrap>
				Klien
			</td>
			<td>
				<select name=idklien  >";
				$q="SELECT ID,NAMA FROM toko ORDER BY NAMA";
				$h=doquery($q,$koneksi);
				if (sqlnumrows($h)>0) {
					while ($d=sqlfetcharray($h)) {
						echo "<option value='$d[ID]'>$d[NAMA]</optiom>";
					}
				}
				echo "
				</select>
				
			</td>
		</tr>
 	<tr>
			<td>
				Status Permintaan
			</td>
			<td>
				<select name=statuspermintaan >
				<option value=''>Semua</option>
				";
				foreach ($arraystatushasil as $k=>$v) {
					echo "<option value='$k'>$v</option>";
				}
				echo "
				</select>
			</td>
		</tr>
 	<tr>
		<td  >Tanggal Permintaan Dari</td>
		<td>
			<select class=teksbox name=tglmd>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tglmd==""){
							$cek="selected";
						}	elseif ($tglmd==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blnmd>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blnmd==""){
							$cek="selected";
						} else						
						if ($i==$blnmd) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thnmd>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year]-5 && $thnmd==""){
							$cek="selected";
						}	 else					
						if ($i==$thnmd-5) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select> 
			s.d
			<select class=teksbox name=tglms>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tglms==""){
							$cek="selected";
						}	elseif ($tglms==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blnms>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blnms==""){
							$cek="selected";
						} else						
						if ($i==$blnms) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thnms>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year] && $thnms==""){
							$cek="selected";
						}	 else					
						if ($i==$thnms) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>			
			<input type=checkbox name=istglm value=1> filter
		</td>
	</tr>		
	<tr>
		<td  >Tanggal Deadline Dari</td>
		<td>
			<select class=teksbox name=tgldd>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tgldd==""){
							$cek="selected";
						}	elseif ($tgldd==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blndd>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blndd==""){
							$cek="selected";
						} else						
						if ($i==$blndd) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thndd>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year]-5 && $thndd==""){
							$cek="selected";
						}	 else					
						if ($i==$thndd-5) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select> 
			s.d
			<select class=teksbox name=tglds>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tglds==""){
							$cek="selected";
						}	elseif ($tglds==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blnds>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blnds==""){
							$cek="selected";
						} else						
						if ($i==$blnds) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thnds>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year]+5;$i++) {
						if ($i==$waktu[year]+5 && $thnds==""){
							$cek="selected";
						}	 else					
						if ($i==$thnds+5) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>			
			<input type=checkbox name=istgld value=1> filter
		</td>
	</tr>			
	<tr>
		<td  >Tanggal Selesai Dari</td>
		<td>
			<select class=teksbox name=tglsd>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tglsd==""){
							$cek="selected";
						}	elseif ($tglsd==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blnsd>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blnsd==""){
							$cek="selected";
						} else						
						if ($i==$blnsd) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thnsd>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year]-5 && $thnsd==""){
							$cek="selected";
						}	 else					
						if ($i==$thnsd-5) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select> 
			s.d
			<select class=teksbox name=tglss>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tglss==""){
							$cek="selected";
						}	elseif ($tglss==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select class=teksbox name=blnss>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blnss==""){
							$cek="selected";
						} else						
						if ($i==$blnss) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select class=teksbox name=thnss>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year]+5;$i++) {
						if ($i==$waktu[year]+5 && $thnss==""){
							$cek="selected";
						}	 else					
						if ($i==$thnss+5) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>			
			<input type=checkbox name=istgls value=1> filter
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
include "autolihattoko.php";

}

?>
