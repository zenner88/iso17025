<?
if ($tabaksi=="update") {
if ($aksi=="Update") {
	if (trim($nama)=="") {
		$errmesg="Nama Lengkap Anggota Harus Diisi";
	} else {
		if ($fileupload!="none") {
			if (isset($WINDIR)) {
				$fileupload=str_replace("\\\\","\\",$fileupload);
			}
			$namafile=basename($fileupload_name);	
			$qf.="FOTO='$idupdate$namafile',";
		}
  			$q="UPDATE anggota SET
 			NIP='$nip',
 			$qf
 			NAMA='$nama',
 			PANGGILAN='$panggilan',
 			KELAMIN='$kelamin',
 			ANAKKE='$anakke',
 			GOLDARAH='$goldarah',
 			AGAMA='$agama',
 			STATUSMARITAL='$statusmarital',
 			TEMPATKAWIN='$tempatkawin',
 			TANGGALKAWIN='$thnkawin-$blnkawin-$tglkawin',
 			SUKUBANGSA='$sukubangsa',
 			WARNAKULIT='$warnakulit',
 			JENISRAMBUT='$jenisrambut',
 			WARNARAMBUT='$warnarambut',
 			TINGGI='$tinggi',
 			BERAT='$berat',
 			STATUS='$status',
 			KETERANGAN='$keterangan',
 			UPDATER='$users',
 			TANGGALUPDATE=NOW()
 			WHERE ID='$idupdate'
 			";
			doquery($q,$koneksi);
			echo mysql_error();
			if (sqlaffectedrows($koneksi)>0) {
				if ($fileupload!="none") {
					@unlink("foto/$fotolama");
					move_uploaded_file($fileupload,"foto/$idupdate$namafile");
				}
				$errmesg="Data Biodata Anggota berhasil diupdate";
				$ok="";
  			} else {
				$errmesg="Data Biodata Anggota tidak  diupdate";
			}
 	}	
}
}
if ($tabaksi=="form") {

$q="SELECT FOTO,NIP,NAMA,PANGGILAN,KELAMIN,ANAKKE,GOLDARAH,AGAMA,STATUSMARITAL,
 			TEMPATKAWIN,TANGGALKAWIN,SUKUBANGSA,WARNAKULIT,JENISRAMBUT,
 			WARNARAMBUT,TINGGI,BERAT,STATUS,KETERANGAN
 			
  FROM anggota WHERE ID='$idupdate'";
$h=doquery($q,$koneksi);
if (sqlnumrows($h)>0) {
	$d=sqlfetcharray($h);
	$nip=$d[NIP];
	$nama=$d[NAMA];
	$panggilan=$d[PANGGILAN];
	$kelamin=$d[KELAMIN];
	$anakke=$d[ANAKKE];
	$goldarah=$d[GOLDARAH];
	$agama=$d[AGAMA];
	$statusmarital=$d[STATUSMARITAL];
	$tempatkawin=$d[TEMPATKAWIN];
	$tmp=explode("-",$d[TANGGALKAWIN]);
	$tglkawin=$tmp[2];
	$blnkawin=$tmp[1];
	$thnkawin=$tmp[0];
	
	$sukubangsa=$d[SUKUBANGSA];
	$warnakulit=$d[WARNAKULIT];
	$jenisrambut=$d[JENISRAMBUT];
	$warnarambut=$d[WARNARAMBUT];
	$tinggi=$d[TINGGI];
	$berat=$d[BERAT];
	$status=$d[STATUS];
	$ket=$d[KET];
	$FOTO=$d[FOTO];
	
	if ($status==1) {
		$cekstatus="checked";
	} else {
		$cekstatus="";
	}
	
	
	
	
echo "
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=idupdate value='$idupdate'>
	<input type=hidden name=tab value='$tab'>
	<input type=hidden name=tabaksi value='update'>
	<input type=hidden name=fotolama value='$foto'>
	<table class=form >
		<tr>
			<td width=100  nowrap>
				NIP/NRP
			</td>
			<td>
				<input class=masukan type=text name=nip size=10 value='$nip'>
				<script>form.nip.focus();</script>
			 
			</td>
		</tr>
		<tr>
			<td>
				Nama Lengkap
			</td>
			<td>
				<input  class=masukan type=text name=nama size=30 value='$nama'>
			</td>
		</tr>
		<tr>
			<td>
				Panggilan
			</td>
			<td>
				<input  class=masukan type=text name=panggilan size=30 value='$panggilan'>
			</td>
		</tr>
		<tr>
			<td>
				Jenis Kelamin
			</td>
			<td>
 						<select name=kelamin class=masukan>
						";
						foreach ($arraykelamin as $k=>$v) {
							$cek="";
							if ($kelamin==$k) {
								$cek="selected";
							}
							echo "<option $cek value='$k'>$v</option>";
						}
						echo "
						</select>
  			</td>
		</tr>
		<tr>
			<td>
				Anak ke
			</td>
			<td>
				<input  class=masukan type=text name=anakke size=2 value='$anakke'>
			</td>
		</tr>
		<tr>
			<td>
				Gol. Darah
			</td>
			<td>
 						<select name=goldarah class=masukan>
						";
						foreach ($arraygoldarah as $k=>$v) {
							$cek="";
							if ($goldarah==$k) {
								$cek="selected";
							}
							echo "<option $cek value='$k'>$v</option>";
						}
						echo "
						</select>
			</td>
		</tr>
		<tr>
			<td>
				Agama
			</td>
			<td>
 						<select name=agama class=masukan>
						";
						foreach ($arrayagama as $k=>$v) {
							$cek="";
							if ($agama==$k) {
								$cek="selected";
							}
							echo "<option $cek value='$k'>$v</option>";
						}
						echo "
						</select>
			</td>
		</tr>
		<tr>
			<td>
				Status Marital
			</td>
			<td>
 						<select name=statusmarital class=masukan>
						";
						foreach ($arraystatusnikah as $k=>$v) {
							$cek="";
							if ($statusmarital==$k) {
								$cek="selected";
							}
							echo "<option $cek value='$k'>$v</option>";
						}
						echo "
						</select>
			</td>
		</tr>
		<tr>
			<td>
				Tempat Kawin
			</td>
			<td>
				<input  class=masukan type=text name=tempatkawin size=20 value='$tempatkawin'>
			</td>
		</tr>
	<tr>
		<td  >Tanggal Kawin</td>
		<td>
			<select  name=tglkawin class=masukan>
			";
					for ($i=1;$i<=31;$i++) {
						if ($i==$waktu[mday]  && $tglkawin==""){
							$cek="selected";
						}	elseif ($tglkawin==$i) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>-			
			<select   name=blnkawin class=masukan>
			";
					for ($i=1;$i<=12;$i++) {
						if ($i==$waktu[mon] && $blnkawin==""){
							$cek="selected";
						} else						
						if ($i==$blnkawin) {
							$cek="selected";
						} 
						echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
						$cek="";
					}
			echo "
			</select>-
			<select   name=thnkawin class=masukan>
			";
					for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
						if ($i==$waktu[year] && $thnkawin==""){
							$cek="selected";
						}	 else					
						if ($i==$thnkawin) {
							$cek="selected";
						} 
						echo "<option value='$i' $cek>$i</option>";
						$cek="";
					}
			echo "
			</select>
	</tr>
		<tr>
			<td>
				Suku Bangsa
			</td>
			<td>
				<input  class=masukan type=text name=sukubangsa size=20 value='$sukubangsa'>
			</td>
		</tr>
		<tr>
			<td>
				Warna Kulit
			</td>
			<td>
				<input  class=masukan type=text name=warnakulit size=20 value='$warnakulit'>
			</td>
		</tr>
		<tr>
			<td>
				Jenis Rambut
			</td>
			<td>
				<input  class=masukan type=text name=jenisrambut size=20 value='$jenisrambut'>
			</td>
		</tr>
		<tr>
			<td>
				Warna Rambut
			</td>
			<td>
				<input  class=masukan type=text name=warnarambut size=20 value='$warnarambut'>
			</td>
		</tr>
		<tr>
			<td>
				Tinggi
			</td>
			<td>
				<input  class=masukan type=text name=tinggi size=5 value='$tinggi'> cm
			</td>
		</tr>
		<tr>
			<td>
				Berat
			</td>
			<td>
				<input  class=masukan type=text name=berat size=5 value='$berat'> Kg
			</td>
		</tr>
		<tr>
			<td>
				Diskontinyu
			</td>
			<td>
			<input $cekstatus class=masukan type=checkbox name=status   value='0'> 
				Keterangan
				<input  class=masukan type=text name=ket size=40 value='$ket'>
			</td>
		</tr>
		<tr>
			<td>
				Foto Baru
			</td>
			<td>
				<input class=masukan type=file name=fileupload > 
 			</td>
		</tr>
		<tr>
			<td colspan=2>
			<br>
				<input class=tombol type=submit name=aksi value='Update'>
				<input class=tombol type=reset value='Reset Isian'>
			</td>
		</tr>
	</table>


";

} else {
	printmesg("Tidak ada anggota yang diupdate degan nomer urut $id");
}

}
?>