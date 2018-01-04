<?
if ($_SESSION[tingkats]!="B") {
    exit;
}


$q="SELECT ID FROM minta WHERE STATUS='0'";
$h=doquery($q,$koneksi);
if (sqlnumrows($h)>0) {
	while ($d=sqlfetcharray($h)) {
		$q="SELECT COUNT(ID) AS JML FROM permintaan WHERE IDTRANS='$d[ID]' AND (STATUS='7' OR STATUS='99')";
		 $h2=doquery($q,$koneksi);
		$d2=sqlfetcharray($h2);
		$jmlstatusakhir=$d2[JML]+0;

		$q="SELECT COUNT(ID) AS JML FROM permintaan WHERE IDTRANS='$d[ID]'";
		$h2=doquery($q,$koneksi);
		$d2=sqlfetcharray($h2);
		$jmlsampel=$d2[JML]+0;
		
		

		if ($jmlstatusakhir>=$jmlsampel && $jmlsampel>0) {
			$q="UPDATE permintaan SET STATUS='99' WHERE IDTRANS='$d[ID]'";
			doquery($q,$koneksi);
			$q="UPDATE minta SET STATUS='1' WHERE ID='$d[ID]'";
			doquery($q,$koneksi);
		} 
	}
}


if ($aksi=="Tampilkan") {

		///////// Hapus Data User ////////////////

		if ($aksitambahan=="hapus") {
 			
 				$q="DELETE FROM minta WHERE ID='$idhapus' AND STATUS!=0 AND STATUS!=1";
				doquery($q,$koneksi);
				if (sqlaffectedrows($koneksi)>0) {
    		  $ketlog="Hapus permintaan. ID=$idhapus";
          buatlogiso(6,$ketlog,$q,$users);

					printmesg("Data Permintaan Analisis dengan ID = $idhapus berhasil dihapus.");
	 				$q="DELETE FROM permintaan WHERE IDTRANS='$idhapus'";
					doquery($q,$koneksi);
 				} else {
					printmesg("Data Permintaan Analisis dengan ID = $idhapus tidak berhasil dihapus. Permintaan Analisis sedang dikerjakan atau sudah selesai.");
				}
 		}
			$href="index.php?pilihan=llihat&aksi=Tampilkan";
	
		if (trim($id)!="") {
			$qfield.=" AND ID='$id' ";
			$judul.=" Kode = '$id' <br>";
			$href.="&id=$id";
		} else {
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
			if (trim($kunci)!="") {
				$qfield.=" AND (CONTOH LIKE '%$kunci%' ) ";
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
					TANGGALSELESAI>=DATE_FORMAT('$thnsd-$blnsd-$tglsd','%Y-%m-%d')
					AND
					TANGGALSELESAI<=DATE_FORMAT('$thnss-$blnss-$tglss','%Y-%m-%d')
				)
				";
				$judul.="Tanggal Deadline antara $tglsd-$blnsd-$thnsd s.d $tglss-$blnss-$thnss  <br>";
				$href.="&istgls=$istgls&tglsd=$tglsd&blnsd=$blnsd&thnsd=$thnsd&tglss=$tglss&blnss=$blnss&thnss=$thnss";
			}
		} 
	
		////////// Tampilkan Data User ///////////////
		if ($sort=="") {
			$sort="minta.ID";
		}
		 $q="SELECT COUNT(ID) AS JML  
		 FROM minta 
		WHERE STATUS!=4
		$qfield
		$qtoko
		";
		$h=doquery($q,$koneksi);	
		$d=sqlfetcharray($h);
		 $total=$d[JML];
		
 		
		include $root."paginating.php";				

		  $q="SELECT 
		*,
		DATE_FORMAT(TANGGALDATANG,'%d-%m-%Y') AS TGLMASUK,
		DATE_FORMAT(TANGGALDEADLINE,'%d-%m-%Y') AS TGLDEADLINE,
		DATE_FORMAT(TANGGALSELESAI,'%d-%m-%Y') AS TGLSELESAI
		 FROM minta 
		WHERE  STATUS!=4
		$qfield
		$qtoko
		ORDER BY $sort
		$qlimit";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
			
			echo "<center><h3>Rincian Data Permintaan Analisis</h3>";
			echo("<p class=judulhaltabel>".$judul."</p>");
			echo "	$tpage $tpage2
				<table width=95% $borderdata class=data>
					<tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap  >Permintaan</td>
 						<td nowrap ><a href='$href&sort=STATUS'>Status</td>
						<td nowrap colspan=2  >Aksi</td>
					</tr>";
			
			$i=1;
			while($data=sqlfetcharray($h)) {
				$kelas=kelas($i);
				$q="SELECT JENISANALISIS,STATUS,IDKELOMPOK 
        FROM permintaan LEFT JOIN jenisuji ON jenisuji.ID=permintaan.JENISANALISIS
        WHERE IDTRANS='$data[ID]' ORDER BY jenisuji.IDKELOMPOK,jenisuji.NAMA";
				$h2=doquery($q,$koneksi);
					$statusan="";
				if (sqlnumrows($h2)>0) {
				  $idkelompok="";
					while ($d2=sqlfetcharray($h2)) {

    				if ($d2[IDKELOMPOK]=="") {
              $d2[IDKELOMPOK]=0;
            }
    				
    				if ("$idkelompok"!="$d2[IDKELOMPOK]") {

   					   if ("$idkelompok"!="") {
      						$statusan.="</ul>";
               }
  						$statusan.="
              <b>".$arraykelompokjenisuji[$d2[IDKELOMPOK]]."</b>
              <ul>";
  						$idkelompok=$d2[IDKELOMPOK];
					  }
						$statusan.="<li>".$arrayanalisis[$d2[JENISANALISIS]]." (<b>".$arraystatuspermintaan[$d2[STATUS]]."</b>)</li>";
					}
				}
				echo "
					<tr valign=top $kelas>
						<td nowrap align=center >$i</td>
						<td nowrap align=left>
            <table  >
            <tr>
              <td>REPORT NUMBER </td><td>:</td><td> <a href='$href&sort=NOMER1'> $data[NOMER1]</a></td> 
            </tr>
            <tr>
              <td>REF. ORDER NUMBER </td><td>:</td><td> <a href='$href&sort=NOMER2'> $data[NOMER2]</a></td> 
            </tr>
            <tr>
              <td>ID </td><td>:</td><td> <a href='$href&sort=ID'> $data[ID]</a></td> 
            </tr>
            <tr>
              <td>Klien</td><td>:</td><td> <a href='$href&sort=IDKLIEN'>".getnamatoko($data[IDKLIEN])."</a></td>
            </tr>

            <tr>
              <td>Sampel</td><td>:</td><td> <a href='$href&sort=CONTOH'>".nl2br($data[CONTOH])."</a></td>
            </tr>
            <tr>
              <td>Tanggal Masuk</td><td>:</td><td> <a href='$href&sort=TANGGALDATANG'>$data[TGLMASUK]</a></td>
            </tr>
            <tr>
              <td>Tanggal Deadline</td><td>:</td><td> <a href='$href&sort=TANGGALDEADLINE'>$data[TGLDEADLINE]</a></td>
            </tr>
            <tr>
              <td>Tanggal Selesai</td><td>:</td><td> <a href='$href&sort=TANGGALSELESAI'>$data[TGLSELESAI]</a></td>
            </tr>
            <tr>
  						<td nowrap >Manajer Teknis</td><td>:</td><td><a href='$href&sort=IDMAN'>".getnama($data[IDMAN])."</a></td>
  					</tr>
            </table>
 						<td  nowrap align=left><b>".$arraystatushasil[$data[STATUS]]."</b> <hr>$statusan</td>
 						<td nowrap align=center><a href='index.php?pilihan=lupdate&idupdate=$data[ID]'>Update</td>
						<td nowrap align=center><a 
						onclick=\"return confirm('Hapus data Permintaan Analisis dengan ID = $data[ID]?');\"
						href='$href&aksitambahan=hapus&idhapus=$data[ID]'>Hapus</td>
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

$q="SELECT COUNT(*) AS JML FROM minta WHERE STATUS='3'  "; // ADMINISTRASI


// $q="SELECT COUNT(*) AS JML FROM minta LEFT JOIN survey ON minta.ID=survey.ID
//WHERE minta.STATUS='3' OR (minta.STATUS='1'  AND survey.ID  IS NULL) "; // 

$h=doquery($q,$koneksi);
$d=sqlfetcharray($h);
$errmesg2="Ada $d[JML] permintaan analisis yang harus diproses. Silakan <a href='index.php?pilihan=$pilihan&statuspermintaan=3&aksi=Tampilkan'>klik di sini </a>untuk melihat data tersebut.";
printmesg($errmesg2);


echo "
<h3>Lihat Data Permintaan Analisis</h3>";
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
				<input type=text name=id size=10 value='$id'>
			</td>
		</tr>
		<tr>
			<td width=20%  nowrap>
				ID Klien
			</td>
			<td>
				<input type=text name=idklien size=10 value='$idklien'>
			 <a 
						href=\"javascript:daftartoko('form,wewenang,idklien',
						document.form.idklien.value)\">
						Daftar Klien
						</a>
				
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
             $cek="'selected'";
 					echo "<option value='$k'  >$v</option>";
				}
				echo "
				</select>
			</td>
		</tr>
		<tr>
			<td width=20%  nowrap>
				Kata Kunci Sampel/Catatan
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
//include "autolihattoko.php";

}

?>
