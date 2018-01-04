<?
if ($_SESSION[tingkats]!="C") {
    exit;
}
echo "<h3>Tambah Data Jenis Uji</h3>
";
if ($aksi=="Tambah") {
	if (trim($id)=="" && $id <=30)	{
		$errmesg="ID Jenis Uji Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Jenis Uji Harus Diisi";
	}   else {
   			$q="INSERT INTO jenisuji 
         (ID,NAMA,NAMA2,JMLVAR,RUMUS,HASIL,SATUAN,IDKELOMPOK,RM)
         VALUES('$id','$nama','$nama2','$jmlvar','$rumus','$hasil','$satuan','$idkelompok','$rm')";
			doquery($q,$koneksi);
			if (sqlaffectedrows($koneksi)>0) {
  		  $ketlog="Tambah Jenis Uji. ID=$id, Nama=$nama";
        buatlogiso(22,$ketlog,$q,$users);


				foreach ($var as $k=>$v) {
						$q="INSERT INTO varjenisuji 
            (IDJENISUJI,VAR,NAMA,MANUAL,RUMUS,KONSTANTA)
            VALUES 
						('$id','$v','".$ket[$k]."','".$manual[$k]."','".$rumusnilai[$k]."','".$konstantanilai[$k]."')";
						doquery($q,$koneksi);
				}
 				$errmesg="Data Jenis Uji berhasil ditambahkan";
				$id=$nama=$nama2=$aksi="";
			} else {
				$errmesg="Data Jenis Uji tidak berhasil ditambahkan. ID yang digunakan sudah ada
				di dalam basis data.  Silakan mengganti ID Jenis Uji.";
				$aksi="Lanjut";
			}
 	}
	printmesg($errmesg);
}
if ($aksi=="Lanjut") {
	if (trim($id)=="" && $id <=30)	{
		$errmesg="ID Jenis Uji Harus Diisi";
	} elseif (trim($nama)=="") {
		$errmesg="Nama Jenis Uji Harus Diisi";
	} elseif (trim($jmlvar)<=0) {
		$errmesg="Jumlah Variabel harus diisi";
	} else {
		echo "
		<form name=form action=index.php method=post ENCTYPE=\"MULTIPART/FORM-DATA\">
			<input type=hidden name=pilihan value='$pilihan'>
			<input type=hidden name=id value='$id'>
			<input type=hidden name=idkelompok value='$idkelompok'>
			<input type=hidden name=nama value='$nama'>
			<input type=hidden name=nama2 value='$nama2'>
			<input type=hidden name=jmlvar value='$jmlvar'>
			<table $border>
				<tr>
					<td    nowrap> ID Jenis Uji </td>
					<td>$id </td>
				</tr>
				<tr>
					<td    nowrap> Kelompok </td>
					<td>".$arraykelompokjenisuji[$idkelompok]." </td>
				</tr>
				<tr>
					<td> Nama Lengkap </td>
					<td> $nama </td>
				</tr>
				<tr>
					<td> Nama Singkat </td>
					<td> $nama2 </td>
				</tr>
				";
				/*
				<tr>	
					<td>
						Jumlah Variabel Maksimum
					</td>
					<td>$jmlvar
					</td>
				</tr>
				*/
				echo"

				<tr>	
					<td>
						Variabel
					</td>
					<td>
					<table widtth=100% border=1>
						<tr align=center>
							<td><b>Var</td>
							<td><b>Keterangan</td>
							<td colspan=2><b>Nilai</td>
						</tr>
						
					";
					$kar="A";
					for ($i=0;$i<=$jmlvar-1;$i++) {
							echo "
								<tr align=center>
									<td><input type=text size=5 maxlength=5 name='var[$i]' value='$kar'></td>
									<td nowrap><input type=text size=40 name='ket[$i]' value=''></td>
									<td nowrap><input type=radio value=1 name='manual[$i]' checked> Variabel</td>
 									</td>
									<td nowrap><input type=radio value=2 name='manual[$i]' > Konstanta
									<input type=text size=10 name='konstantanilai[$i]' value=''>
									</td>
								</tr>
							";
							$kar++;
					}
					echo "
					</table>
					</td>
				</tr>
				<tr>
					<td> Rumus Uji </td>
					<td> <input style='font-size:20Pt;' type=text size=30 name='rumus' value=''>
					<ul>
          <li>Untuk tes rumus, isi semua variabel dengan sebuah nilai. <br>
					<li>Untuk data kualitatif, cukup gunakan 1 variabel dan hasilnya diisi dengan nilai kualitatif (bukan angka)
					</ul>          
           </td>
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
						<input type=submit name=aksi value='Tambah'>
						<input type=reset value='Hapus Isian'>
					</td>
				</tr>
			</table>
		
		
		</form name=form>
		";
	}
}

if ($aksi=="") {

  $id=getidjenisujibaru();
	echo "
	<form name=form action=index.php method=post ENCTYPE=\"MULTIPART/FORM-DATA\">
		<input type=hidden name=pilihan value='$pilihan'>
		<table $border>
			<tr>
				<td width=150  nowrap>
					ID Jenis Uji
				</td>
				<td>
					<input type=text name=id size=4 value='$id'>
					(ID harus angka dan bernilai > 30)
					<script>form.id.focus();</script>
				 
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
					Jumlah Variabel Maksimum
				</td>
				<td>
					<input type=text name=jmlvar size=4 value='$jmlvar'>
				</td>
			</tr>
	 		<tr>
				<td colspan=2>
				<br>
					<input type=submit name=aksi value='Lanjut'>
					<input type=reset value='Hapus Isian'>
				</td>
			</tr>
		</table>
	
	
	</form name=form>
	";
}
?>
