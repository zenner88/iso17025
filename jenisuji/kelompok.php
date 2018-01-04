<?
if ($_SESSION[tingkats]!="C") {
    exit;
}
echo "<h3>Kelompok Jenis Uji</h3>
";

 	$ok = false;
	
	if ($aksi=="Update") {
			$i=0;
		if (is_array($idupdate)) {
			$i=0;
			foreach ($idupdate as $k=>$v) {
				if(trim($ket[$k])!="") {
					$query = "UPDATE kelompokjenisuji SET 
						NAMA='".$ket[$k]."'
						WHERE ID='$k'";
						$hasil = doquery($query, $koneksi);
						echo mysql_error();
						$i++;
      		  $ketlog="Update Kelompok Jenis Uji. ID=$k, NAMA=".$ket[$k]." ";
            buatlogiso(27,$ketlog,$query,$users);

				}
			}
			if ($i>0) {
				$errmesg="Update data Kelompok Jenis Uji berhasil dilakukan.";
			} else {
				$errmesg="Update data Kelompok Jenis Uji tidak berhasil dilakukan.";
			}
		}
	}
	
	if ($aksi=="Hapus") {
		if (is_array($idhapus)) {
			$i=0;
			foreach ($idhapus as $k=>$v) {
				$query = "DELETE FROM kelompokjenisuji  WHERE ID='$k' AND ID!='0'";
				$hasil = doquery($query, $koneksi);
				if (sqlaffectedrows($koneksi)>0) {
      		  $ketlog="Hapus Kelompok Jenis Uji. ID=$k  ";
            buatlogiso(28,$ketlog,$query,$users);
					$i++;
				}
			}
			if ($i>0) {
				$errmesg="Penghapusan data Kelompok Jenis Uji   berhasil dilakukan.";
			} else {
				$errmesg="Penghapusan data Kelompok Jenis Uji tidak dilakukan.";
			}
		}		
	} 
	
	if ($aksi=="Tambah") {
		if(trim($id)=="") {
			$errmesg="ID Kelompok Jenis Uji harus diisi";
	  } else
		if(trim($ket)=="") {
			$errmesg="Data Kelompok Jenis Uji harus diisi";
		} else {
 			$query = "INSERT INTO kelompokjenisuji VALUES('$id','$ket' )";
			$hasil = doquery($query, $koneksi);
			if (sqlaffectedrows($koneksi)>0) {
      		  $ketlog="Tambah Kelompok Jenis Uji. ID=$id, NAMA=$ket ";
            buatlogiso(26,$ketlog,$query,$users);
				$errmesg= "Penambahan data Kelompok Jenis Uji berhasil dilakukan.";
			} else {
				$errmesg="Penambahan data  Kelompok Jenis Uji gagal dilakukan.";
			}
		}
		$aksi="";
	}

					printmesg($errmesg);
					echo("<b>Tambah Data Kelompok Jenis Uji</b>");
				
				?>
				<form action=index.php method=post>
					<input type=hidden name=aksi value="Tambah">
					<input type=hidden name=pilihan value=kelompok>
					<table  >
						<tr>
							<td  >
								ID Kelompok Jenis Uji
							</td>
							<td>
								<input class=masukan type=text size=5  name=id maxlength=5>
							</td>
						</tr>
						<tr>
							<td  >
								Nama Kelompok Jenis Uji
							</td>
							<td>
								<input class=masukan type=text size=60  name=ket>
							</td>
						</tr>

						<tr valign=top>
							<td colspan=2 ><br>
								<input class=tombol type=submit value='  Tambah  '>
								<input class=tombol type=reset value=Reset>
							</td>
						</tr>
					</table>
				</form>
 

<?

			$query = "SELECT ID,NAMA FROM kelompokjenisuji ORDER BY NAMA";
			$hasil = doquery($query, $koneksi);
			echo mysql_error();
			if (sqlnumrows($hasil)>0) {
				printjudulmenukecil("<b>Daftar  Kelompok Jenis Uji</b>");
				echo "
							<form action=index.php method=post>
							<input type=hidden name=pilihan value=kelompok>
				";
				echo "
					<table class=data>
						<tr align=center >
							<td colspan=3>
							</td>
							<td>
									<input type=submit name=aksi value='Update' class=tombol>
							</td>
							<td>
									<input type=submit name=aksi value='Hapus' class=tombol onclick=\"return confirm('Hapus Kelompok Jenis Uji  ?');\">
							</td>
						</tr>
						<tr align=center class=juduldata>
							<td width=10>
								No
							</td>
							<td>
								ID
							</td>
							<td>
								Nama Kelompok Jenis Uji
							</td>
							<td width=50 >
								Pilih<BR>Update
							</td>
							<td width=50 >
								Pilih<BR>Hapus
							</td>
						</tr>
				";
				$i = 0;
				settype($i,"integer");

				while ($datauser=sqlfetcharray($hasil)) {
					if ($i % 2 ==0) {
						$kelas="class=datagenap";
					} else {
						$kelas="class=dataganjil";
					}
					$ket = $datauser[NAMA];
					$kelompokjenisuji = $datauser[ID];
					$gol=$datauser[GOL];
					$subgol=$datauser[SUBGOL];
					$i++;
					echo "
						<tr valign=top $kelas>
							<td align=center>
								$i
							</td>
							<td align=center>
								$kelompokjenisuji
							</td>
							<td align=center >
								<input type=text name=ket[$kelompokjenisuji] value='$ket' size=50  class=masukan>
							</td>


							<td align=center >
								<input type=checkbox name=idupdate[$kelompokjenisuji] value=1 class=tombol >
							</td>
  
							<td align=center >";
							if ($kelompokjenisuji!="0") {
              echo "
									<input type=checkbox name=idhapus[$kelompokjenisuji] value=1 class=tombol >
									";
							}
									echo "
							</td>

	
						</tr>
					";
				}
				echo "
					</table>
							</form>

				";
			} else {
				printmesg("Daftar Kelompok Jenis Uji tidak ada.");
				$aksi="";
			}
		

?>
<br>
