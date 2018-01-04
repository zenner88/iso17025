<?php
if ($_SESSION[tingkats]!="B") {
    exit;
}

if ($aksi=="Tampilkan") {

		///////// Hapus Data User ////////////////

		if ($aksitambahan=="Update") {
		  if (is_array($daftarnilai)) {
        foreach ($daftarnilai as $k=>$v) {
          $q="INSERT INTO biaya (ID,NILAI) VALUES ('$k','$v') ";
          doquery($q,$koneksi);
          if (sqlaffectedrows($koneksi)<=0) {
            $q="UPDATE biaya SET NILAI='$v' WHERE ID='$k'";
            doquery($q,$koneksi);
            if (sqlaffectedrows($koneksi)>0) {
        		  $ketlog="Simpan Setting Biaya Uji. ID=$k, Biaya=$v";
              buatlogiso(11,$ketlog,$q,$users);
              $berhasil++;
            }
          } else {
      		  $ketlog="Simpan Setting Biaya Uji. ID=$k, Biaya=$v";
            buatlogiso(11,$ketlog,$q,$users);
            $berhasil++;
          }
        }
        $errmesg="$berhasil data biaya telah disimpan.";
        
      }
      
 		}
	
		////////// Tampilkan Data User ///////////////
		if ($sort=="") {
			$sort="ID";
		}
		if ($idkelompok!="") {
      $qfield="AND IDKELOMPOK = '$idkelompok'";
    }
/*		$q="SELECT * FROM jenisuji 
		WHERE 
		(NAMA LIKE '%$nama%' OR ID LIKE '%$nama%')
		$qtoko
		$qfield
		ORDER BY $sort";
		$h=doquery($q,$koneksi);
		echo mysql_error();
		if (sqlnumrows($h)>0) {
		*/
		
		if (is_array($arrayanalisis)) {
			
			echo "<center><h3>Update Biaya per Parameter Jenis Uji</h3>";
			printmesg($errmesg);
			$href="index.php?pilihan=llihat&aksi=Tampilkan&nama=$nama";
			echo "
      <form name=form action=index.php method=post>
      	<input type=hidden name=pilihan value='$pilihan'>
      	<input type=hidden name=nama value='$nama'>
      	<input type=hidden name=idkelompok value='$idkelompok'>
      	<input type=hidden name=aksi value='$aksi'>


				<table $borderdata class=data>
					<tr class=judulkolom align=right valign=middle >
  						<td nowrap colspan=7><input type=submit name=aksitambahan value='Update'></td>
					</tr>					
          <tr class=judulkolom align=center valign=middle>
						<td nowrap width=10>No</td>
						<td nowrap width='10%'><a href='$href&sort=ID'>ID</td>
						<td nowrap ><a href='$href&sort=IDKELOMPOK'>Kelompok</td>
						<td nowrap ><a href='$href&sort=NAMA'>Nama Lengkap</td>
 						<td nowrap ><a href='$href&sort=RUMUS'>Hasil</td>
						<td nowrap ><a href='$href&sort=RUMUS'>Satuan</td>
 						<td nowrap >Biaya</td>
					</tr>";
			
			$i=1;
			
			//while($data=sqlfetcharray($h)) {
			foreach ($arrayanalisis as $k=>$v) {
			  $hasil=1; 
			  if ($nama!="") {
			   if (!eregi($nama,$v)) {
			     $hasil=0;
         }
			  }
    		if ($idkelompok!="") {
    		  if ($arraykelompokanalisis[$k]!=$idkelompok) {
            $hasil=0;
          }
         }
			  if ($hasil==1) {
  				$kelas=kelas($i);
  				echo "
  					<tr valign=top $kelas>
  						<td nowrap align=center >$i</td>
  						<td nowrap align=center >$k</td>
  						<td nowrap align=left>".$arraykelompokjenisuji[$arraykelompokanalisis[$k]]."</td>
  						<td align=left >$v</td>
   						<td align=center ><b>".$arrayanalisishasil[$k]."</td>
  						<td align=center ><b>".$arrayanalisissatuan[$k]."</td>
   						<td align=center ><input type=text size=15 name='daftarnilai[$k]' value='".getbiaya($k)."'></td>
   					</tr>";
  				$i++;
				}
			}
						
			echo "
				</table>
        </form>
        </center>
			";
			
		} else {
			$errmesg="Data Jenis Uji tidak ada.";
			$aksi="";
		}
}


if ($aksi=="") {
echo "
<h3>Biaya per Parameter Jenis Uji</h3>";
printmesg($errmesg);
echo "
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<table width=500>
		<tr>
			<td width=20%  nowrap>
				Kata Kunci Nama
			</td>
			<td>
				<input type=text name=nama size=30 value='$nama'><script>form.nama.focus();</script>
			</td>
		</tr>
			<tr>
				<td>
					Kelompok
				</td>
				<td>
				<select name=idkelompok>
				  ";
            echo "<option value=''>Semua</option>";
				  foreach ($arraykelompokjenisuji as $k=>$v) {
            echo "<option value='$k'>$v</option>";
          }
          echo "
				</select>
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


</form >
";


}
?>
