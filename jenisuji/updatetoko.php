<?
if ($_SESSION[tingkats]!="C") {
    exit;
}
if ($aksi2=="Tambah Var Baru") {
	if ($varbaru=="") {
		$errmesg="Nama Variabel Baru harus diisi";
	} else {
		
		 $q="INSERT INTO varjenisuji (IDJENISUJI,VAR,NAMA,MANUAL,RUMUS,KONSTANTA)
		VALUES ('$id','$varbaru','$ketbaru','$manualbaru','$rumusnilaibaru','$konstantanilaibaru')";
		doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {
  		  $ketlog="Update Jenis Uji. ID=$id, variabel=$varbaru";
        buatlogiso(23,$ketlog,$q,$users);
			$errmesg="Variabel Baru sudah disimpan";
		} else {
			$errmesg="Nama Variabel Baru sudah ada. Variabel tidak berhasil disimpan.";
		}
	}
}

if ($aksi=="Update") {
	if (trim($id)=="" && $id <=30)	{
		$errmesg="ID Jenis Uji Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Jenis Uji Harus Diisi";
	} else {
				foreach ($var as $k=>$v) {
				  if ($varhapus[$k]==1) {
            $q="DELETE FROM varjenisuji  
							WHERE
							IDJENISUJI='$id' AND VAR='$v'";
          } else {						
            $q="UPDATE varjenisuji SET
								VAR='".$var2[$k]."',
								NAMA='".$ket[$k]."',
								MANUAL='".$manual[$k]."',
								KONSTANTA='".$konstantanilai[$k]."',
								RUMUS='".$rumusnilai[$k]."'
							WHERE
							IDJENISUJI='$id' AND VAR='$v'";
					} 
						doquery($q,$koneksi);
				}
		
		 		$q="UPDATE jenisuji 
			SET 
			IDKELOMPOK='$idkelompok',
			NAMA='$nama',
			NAMA2='$nama2',
			HASIL='$hasil',
			SATUAN='$satuan',
			RM='$rm',
			RUMUS='$rumus'
 			WHERE ID='$idupdate'";
		doquery($q,$koneksi);
		

		if (sqlaffectedrows($koneksi)>0) {
  		  $ketlog="Update Jenis Uji. ID=$idupdate, Nama=$nama";
        buatlogiso(23,$ketlog,$q,$users);
 
 			$errmesg="Data Jenis Uji berhasil diupdate";
			$idupdate=$id;
		} else {
			$errmesg="Data Jenis Uji tidak diupdate.";
		}
 			$errmesg="Data Jenis Uji berhasil diupdate";
	}
}
	printmesg($errmesg);

$q="SELECT * FROM jenisuji WHERE ID='$idupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$nama=$data[NAMA];
	$nama2=$data[NAMA2];
	$rumus=$data[RUMUS];
	$hasil=$data[HASIL];
	$satuan=$data[SATUAN];
	$rm=$data[RM];
	$idkelompok=$data[IDKELOMPOK];
 
}

echo "
<h3>Update Data Jenis Uji</h3>
<form name=form action=index.php method=post ENCTYPE=\"MULTIPART/FORM-DATA\">
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=idupdate value='$idupdate'>
 
	<table $border>
		<tr>
			<td width=100  nowrap>
				ID Jenis Uji
			</td>
			<td>$id
				<input type=hidden name=id  value='$id'>
			</td>
		</tr>

			<tr>
				<td>
					Kelompok
				</td>
				<td>
				<select name=idkelompok>
				  ";
				  foreach ($arraykelompokjenisuji as $k=>$v) {
				    $cek="";
            if ($k==$idkelompok) {
              $cek="selected";
            }
            echo "<option value='$k' $cek>$v</option>";
          }
          echo "
				</select>
 				</td>
			</tr>

		<tr>
			<td>
				Nama Lengkap
			</td>
			<td>
				<input type=text name=nama size=40 value='$nama'>
			</td>
		</tr>
		<tr>
			<td>
				Nama Singkat
			</td>
			<td>
				<input type=text name=nama2 size=20 value='$nama2'>
			</td>
		</tr>
	
				<tr>	
					<td>
						Variabel
					</td>
					<td>
					<table border=1 width=100%>
						<tr align=center>
							<td><b>Variabel</td>
							<td><b>Keterangan</td>
							<td colspan=2><b>Nilai</td>
							<td><b>Tes</td>
							<td><b>Hapus</td>
						</tr>
						
					";
 
					$q="SELECT * FROM varjenisuji WHERE IDJENISUJI='$id' ORDER BY VAR";
					$h2=doquery($q,$koneksi);
					$i=0;
					while ($d2=sqlfetcharray($h2)) {
									$cek0="";
									$cek1="";
									$cek2="";
							if ($d2[MANUAL]==0) {
									$cek0="checked";
							} else if ($d2[MANUAL]==1){
									$cek1="checked";
							} else {
									$cek2="checked";
							}
							echo "
								<tr align=center>
									<td>
                  <input type=text size=5 maxlength=5 name='var2[$i]' value='$d2[VAR]'>
                  <b><input type=hidden  name='var[$i]' value='$d2[VAR]'></td>
									<td><input type=text size=30 name='ket[$i]' value='$d2[NAMA]'></td>
									<td nowrap><input type=radio value=1 name='manual[$i]' $cek1 > Variabel</td>
 									<td nowrap><input type=radio value=2 name='manual[$i]' $cek2 > Konstanta
									<input type=text size=10 name='konstantanilai[$i]' value='$d2[KONSTANTA]'>
									</td>
									<td nowrap>
									<input type=text size=5 name='nilaites[$d2[VAR]]' value='".$nilaites["$d2[VAR]"]."'>
									</td>
									<td nowrap>
									<input type=checkbox  name='varhapus[$i]' value=1>
									</td>
								</tr>
							";
							$i++;
					}
					echo "
								<tr align=center>
									<td><input type=text maxlength=5 size=5 name='varbaru'  ></td>
									<td><input type=text size=20 name='ketbaru'  ></td>
									<td nowrap><input type=radio value=1 name='manualbaru' checked> Variabel</td>
 									<td nowrap><input type=radio value=2 name='manualbaru' > Konstanta
									<input type=text size=10 name='konstantanilaibaru'><br>
									<input type=submit name=aksi2 value='Tambah Var Baru'>
									</td>
									<td>
									<input type=submit name=aksi2 value='Tes Rumus'>
									</td>								
									</tr>					
					</table>
					</td>
				</tr>	
				<tr>
					<td> Rumus Uji </td>
					<td> <input style='font-size:20Pt;' type=text size=30 name='rumus' value='$rumus'> <br>
					<ul>
          <li>Untuk tes rumus, isi semua variabel dengan sebuah nilai. <br>
					<li>Untuk data kualitatif, cukup gunakan 1 variabel dan hasilnya diisi dengan nilai kualitatif (bukan angka)
					</ul>";
					if ($aksi2=="Tes Rumus") {
							echo "
							<b>Hasil Tes Rumus = ".rumustohasil($rumus,$nilaites)." </b>
							";
					}
					
					echo "</td>
				</tr>	 
 
 				<tr>
					<td> Hasil yg Diinginkan</td>
					<td> <input type=text size=30 name='hasil' value='$hasil'> </td>
				</tr>		 		
				<tr>
					<td> Satuan</td>
					<td> <input type=text size=30 name='satuan' value='$satuan'> </td>
				</tr>		 		
				<tr>
					<td> Reference Method</td>
					<td> <input type=text size=50 name='rm' value='$rm'> </td>
				</tr>		 		

		<tr>
			<td colspan=2>
			<br>
				<input type=submit name=aksi value='Update'>
				<input type=reset value='Reset Isian'>
			</td>
		</tr>
	</table>


</form name=form>
";
 
?>
