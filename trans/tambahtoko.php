<?php
include '../db.php';
$border="width=100% border=1 style='font-size:10pt;border-collapse:collapse;' ";
$arraybulan[0]="Januari";
$arraybulan[1]="Februari";
$arraybulan[2]="Maret";
$arraybulan[3]="April";
$arraybulan[4]="Mei";
$arraybulan[5]="Juni";
$arraybulan[6]="Juli";
$arraybulan[7]="Agustus";
$arraybulan[8]="September";
$arraybulan[9]="Oktober";
$arraybulan[10]="November";
$arraybulan[11]="Desember";
function addnol($nilai,$banyakdigit) {
		
		$tmp="";
		for ($d=$banyakdigit-1;$d>=1;$d--) {
			if ($nilai/pow(10,$d) >= 1) {
			  break;
			} else {
				$tmp.="0";
			}
		}
		return "$tmp$nilai";
	}

 	echo "
	<h3>Tambah Data Permintaan Analisis</h3>";
 
	$q="SELECT MAX(ID+0)+1 AS IDBARU FROM minta";
	$h=mysql_query($q);
	$d=mysql_fetch_array($h);
	$id=$d['IDBARU'];
	if ($id=="") {
		$id=1;
	}
	$id=addnol($id,6);
	 	
		
		echo "<form name=form action=aksi.php method=post>
			<input type=hidden name=pilihan value='$_GET[pilihan]'>
			<table $border>
				<tr>
					<td width=150  nowrap>
						Kode Permintaan
					</td>
					<td>
						<input type=hidden name=id size=5 value='$id'>$id
				</tr>
				<tr>
					<td width=150  nowrap>
						ID Klien
					</td>
					<td>
						<input type=text name=idklien size=10 value=''><script>form.idklien.focus();</script>
					 <a 
								href=\"javascript:daftartoko('form,wewenang,idklien',
								document.form.idklien.value)\">
								Daftar Klien
								</a>
					</td>
				</tr>

				<tr>
					<td width=150  nowrap>
						REPORT NUMBER
					</td>
					<td>
						<input type=text name=nomer1 size=30 value=''>  					
          </td>
				</tr>
				<tr>
					<td width=150  nowrap>
						REF. ORDER NUMBER
					</td>
					<td>
						<input type=text name=nomer2 size=30 value=''>  					
          </td>
				</tr>

			<tr>
				<td  >Tanggal Permintaan</td>
				<td>
					<select class=teksbox name=tglmasuk>
					";
							for ($i=1;$i<=31;$i++) {
								if ($i==$waktu[mday]  && $tglmasuk==""){
									$cek="selected";
								}	elseif ($tglmasuk==$i) {
									$cek="selected";
								} 
								echo "<option value=$i $cek>$i</option>";
								$cek="";
							}
					echo "
					</select>-			
					<select class=teksbox name=blnmasuk>
					";
							for ($i=1;$i<=12;$i++) {
								if ($i==$waktu[mon] && $blnmasuk==""){
									$cek="selected";
								} else						
								if ($i==$blnmasuk) {
									$cek="selected";
								} 
								echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
								$cek="";
							}
					echo "
					</select>-
					<select class=teksbox name=thnmasuk>
					";
							for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
								if ($i==$waktu[year] && $thnmasuk==""){
									$cek="selected";
								}	 else					
								if ($i==$thnmasuk) {
									$cek="selected";
								} 
								echo "<option value='$i' $cek>$i</option>";
								$cek="";
							}
					echo "
					</select>
			</tr>
			<tr>
				<td  >Deadline Selesai</td>
				<td>
					<select class=teksbox name=tgld>
					";
							for ($i=1;$i<=31;$i++) {
								if ($i==$waktu[mday]  && $tgld==""){
									$cek="selected";
								}	elseif ($tgld==$i) {
									$cek="selected";
								} 
								echo "<option value=$i $cek>$i</option>";
								$cek="";
							}
					echo "
					</select>-			
					<select class=teksbox name=blnd>
					";
							for ($i=1;$i<=12;$i++) {
								if ($i==$waktu[mon] && $blnd==""){
									$cek="selected";
								} else						
								if ($i==$blnd) {
									$cek="selected";
								} 
								echo "<option value=$i $cek>".$arraybulan[$i-1]."</option>";
								$cek="";
							}
					echo "
					</select>-
					<select class=teksbox name=thnd>
					";
							for ($i=$waktu[year]-5;$i<=$waktu[year];$i++) {
								if ($i==$waktu[year] && $thnd==""){
									$cek="selected";
								}	 else					
								if ($i==$thnd) {
									$cek="selected";
								} 
								echo "<option value='$i' $cek>$i</option>";
								$cek="";
							}
					echo "
					</select>
			</tr>		
			<tr>
				<td width=150  nowrap>
					Nama Sampel
				</td>
				<td>
					<input type=text name=contoh size=30 value='$contoh'> 
				</td>
			</tr>
		 	<tr>
					<td>
						Manager Teknis
					</td>
					<td>
						<select name=idman >
						";
						foreach ($arraymanagerteknis as $k=>$v) {
							echo "<option value='$k'>$v</option>";
						}
						echo "
						</select>
					</td>
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
 
?>
