echo "<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
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
				<input type=text name=idklien size=5 value='$idklien'><script>form.idklien.focus();</script>
			 <a 
						href=\"javascript:daftartoko('form,wewenang,idklien',
						document.form.idklien.value)\">
						Daftar Klien
						</a>
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
			<td>
				Jenis Analisis
			</td>
			<td>
				<select name=jenisanalisis >
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
				Sampel yang diberikan
			</td>
			<td>
				<textarea name=sampel cols=50 rows=4>$sampel</textarea>
			</td>
		</tr>
 		<tr>
			<td>
				Catatan lain-lain
			</td>
			<td>
				<textarea name=catatan cols=50 rows=4>$catatan</textarea>
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
 
 
 
 echo "
<h3>Update Data Permintaan Analisis</h3>";
printmesg($errmesg);
echo "
<form name=form action=index.php method=post>
	<input type=hidden name=pilihan value='$pilihan'>
	<input type=hidden name=statuspermintaan value='$statuspermintaan'>
	<input type=hidden name=idupdate value='$idupdate'>
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
				Status
			</td>
			<td>
				".$arraystatuspermintaan[$statuspermintaan]."";
			if ($statuspermintaan>="7") {
				echo "
				,
				Hasil akhir: 
				<select name=statusadm >
				";
				foreach ($arraystatusadm as $k=>$v) {
					if ($statusadm=="$k") {
						$cek="selected";
					}
					echo "<option $cek value='$k'>$v</option>";
					$cek="";
				}
				echo "
				</select>
				<input type=checkbox name=updatestatus value=1>update
				";
			}
		echo "
		</tr>
		<tr>
			<td width=150  nowrap>
				ID Klien
			</td>
			<td>
				<input type=text name=idklien size=5 value='$idklien'><script>form.idklien.focus();</script>
			 <a 
						href=\"javascript:daftartoko('form,wewenang,idklien',
						document.form.idklien.value)\">
						Daftar Klien
						</a>
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
			<td>
				Jenis Analisis
			</td>
			<td>
				<select name=jenisanalisis >
				";
				foreach ($arrayanalisis as $k=>$v) {
					if ($k==$jenisanalisis) {
						$cek="selected";
					}
					echo "<option $cek value='$k'>$v</option>";
					$cek="";
				}
				echo "
				</select>
			</td>
		</tr>
 		<tr>
			<td>
				Sampel yang diberikan
			</td>
			<td>
				<textarea name=sampel cols=50 rows=4>$sampel</textarea>
			</td>
		</tr>
 		<tr>
			<td>
				Catatan lain-lain
			</td>
			<td>
				<textarea name=catatan cols=50 rows=4>$catatan</textarea>
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
					if ($k==$idman) {
						$cek="selected";
					}
					echo "<option $cek value='$k'>$v</option>";
					$cek="";
				}
				echo "
				</select>
			</td>
		</tr>";
		
		if ($statusadm=="7") {
			echo "
				<tr>
					<td>Catatan Manager Teknis</td>
					<td>".nl2br($catatanm)."</td>
				</tr>
			";
		}
		
		echo "
		<tr>
			<td>Update terakhir oleh</td>
			<td>".getnama($data[UPDATER]).", $data[TGLUPDATE]</td>
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