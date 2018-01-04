<?

if ($aksi=="Tampilkan") {

			$href="index.php?pilihan=mlihat&aksi=Tampilkan";
	
		if (trim($id)!="") {
			$qfield.=" AND minta.ID='$id' ";
			$judul.=" Kode = '$id' <br>";
			$href.="&id=$id";
		} else {
			if ($idklien!="") {
				$qfield.=" AND IDKLIEN='$idklien' ";
				$judul.=" Klien = ".getnamatoko($idklien)." <br>";
				$href.="&idklien=$idklien";
			}
			if ($jenisanalisis!="") {
				$qfield.=" AND JENISANALISIS='$jenisanalisis' ";
				$judul.=" Jenis Analisis = ".$arrayanalisis[$jenisanalisis]." <br>";
				$href.="&jenisanalisis=$jenisanalisis";
			}
			if ($statuspermintaan!="") {
				$qfield.=" AND permintaan.STATUS='$statuspermintaan' ";
				$judul.=" Status Permintaan = ".$arraystatuspermintaan[$statuspermintaan]." <br>";
				$href.="&statuspermintaan=$statuspermintaan";
			}
			if (trim($kunci)!="") {
				$qfield.=" AND (SAMPEL LIKE '%$kunci%' OR CATATAN LIKE '%$kunci%') ";
				$judul.=" Kata kunci sampel/catatan = '$kunci' <br>";
				$href.="&kunci=$kunci";
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
					permintaan.TANGGALSELESAI>=DATE_FORMAT('$thnsd-$blnsd-$tglsd','%Y-%m-%d')
					AND
					permintaan.TANGGALSELESAI<=DATE_FORMAT('$thnss-$blnss-$tglss','%Y-%m-%d')
				)
				";
				$judul.="Tanggal Selesai antara $tglsd-$blnsd-$thnsd s.d $tglss-$blnss-$thnss  <br>";
				$href.="&istgls=$istgls&tglsd=$tglsd&blnsd=$blnsd&thnsd=$thnsd&tglss=$tglss&blnss=$blnss&thnss=$thnss";
			}
		} 
	
		////////// Tampilkan Data User ///////////////
		if ($sort=="") {
			$sort="minta.ID";
		}
		 $q="SELECT COUNT(permintaan.ID) AS JML  
		 FROM permintaan,minta 
		WHERE 
		minta.ID=permintaan.IDTRANS AND IDMAN='$users'
 		$qfield
		$qtoko
		";
		$h=doquery($q,$koneksi);	
		$d=sqlfetcharray($h);
		 $total=$d[JML];
		
 		
		include $root."paginating.php";				

		 $q="SELECT 
		*,
		permintaan.ID AS IDS,
		permintaan.STATUS AS STATUSS,
		DATE_FORMAT(TANGGALDATANG,'%d-%m-%Y') AS TGLMASUK,
		DATE_FORMAT(TANGGALDEADLINE,'%d-%m-%Y') AS TGLDEADLINE,
		DATE_FORMAT(minta.TANGGALSELESAI,'%d-%m-%Y') AS TGLSELESAI
		 FROM permintaan,minta 
		WHERE 
		minta.ID=permintaan.IDTRANS AND IDMAN='$users'
 		$qfield
		$qtoko
		ORDER BY $sort
		$qlimit";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3>Rincian Permintaan Analisis</h3>";
			echo("<p class=judulhaltabel>".$judul."</p>");
			echo "			$tpage $tpage2

				<table $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap width='10%'><a href='$href&sort=ID'>Kode</td>
						<td nowrap  ><a href='$href&sort=ID2'>Kode 2</td>
						<td nowrap ><a href='$href&sort=IDKLIEN'>Klien</td>
						<td nowrap ><a href='$href&sort=TANGGALDATANG'>Tgl Masuk</td>
						<td nowrap ><a href='$href&sort=TANGGALDEADLINE'>Tgl Deadline</td>
						<td nowrap >Tgl Selesai</td>
 						<td nowrap >Kelompok<br>Jenis Uji</td>
						<td nowrap ><a href='$href&sort=JENISANALISIS'>Jenis Analisis</td>
						<td nowrap ><a href='$href&sort=permintaan.STATUS'>Status</td>
  						<td nowrap ><a href='$href&sort=IDSUP'>Supervisor</td>
						<td nowrap >Aksi</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
        $labelaksi="Lihat";
				if ($data[STATUSS]==0 || $data[STATUSSS]==5 || $data[STATUSSS]==8) {
          $labelaksi="Update";
        }
				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
						<td  align=center >$data[IDTRANS]-$data[IDS]</td>
						<td nowrap align=center >$data[ID2]</td>
						<td  >".getnamatoko($data[IDKLIEN])."</td>
						<td  nowrap align=center >$data[TGLMASUK]</td>
						<td  nowrap align=center >$data[TGLDEADLINE]</td>
						<td  nowrap align=center>$data[TGLSELESAI]</td>
 						<td  align=left>".$arraykelompokjenisuji[$arraykelompokanalisis[$data[JENISANALISIS]]]."</td>
						<td  align=left>".$arrayanalisis[$data[JENISANALISIS]]."</td>
						<td  align=left>".$arraystatuspermintaan[$data[STATUSS]]."</td>
  						<td  align=left>".getnama($data[IDSUP])."</td>
						<td nowrap align=center><a href='index.php?pilihan=mupdate&idupdate=$data[ID]&idsupdate=$data[IDS]'>$labelaksi</td>
 					</tr>";
				$i++;
			}
						
			echo "
				</table></center>
			";
			
		} else {
			$errmesg="Data Permintaan Analisis tidak ada.";
			$aksi="";
		}
}

if ($aksi=="") {
echo "
<h3>Update Permintaan Analisis

<!-- 
<font style='font-size:9pt'>
<a href='#2'>[Analisis harus ditanggapi]</a>
</font>
-->
</h3>";
printmesg($errmesg);
echo "
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table $border>
		<tr>
			<td width=20%  nowrap>
				Kode Permintaan
			</td>
			<td>
				<input type=text name=id size=5 value='$id'>
			</td>
		</tr>
		<tr>
			<td width=20%  nowrap>
				ID Klien
			</td>
			<td>
				<input type=text name=idklien size=5 value='$idklien'>
			 <a 
						href=\"javascript:daftartoko('form,wewenang,idklien',
						document.form.idklien.value)\">
						Daftar Klien
						</a>
				
			</td>
		</tr>
	<tr>
			<td>
				Jenis Analisis
			</td>
			<td>
				<select name=jenisanalisis >
				<option value=''>Semua</option>
				";
				foreach ($arrayanalisis as $k=>$v) {
					echo "<option value='$k'>$v</option>";
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
				foreach ($arraystatuspermintaan as $k=>$v) {
					echo "<option value='$k'>$v</option>";
				}
				echo "
				</select>
			</td>
		</tr>
		<tr>
			<td width=20%  nowrap>
				Kata Kunci Sampel/Catatan Administrasi
			</td>
			<td>
				<input type=text name=kunci size=30 value='$kunci'>
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


</form name=form>
";

//include "autolihattokom.php";

}

?>
