<?
if ($aksi=="hapus") {
  if (isset($_SESSION['token']) &&
          $tokenc == $_SESSION['token'])
      {
      if ($tahunhapus!="") {
        
        $q="DELETE FROM logdokumen WHERE 
            YEAR(WAKTU)='$tahunhapus'
         
           ";
        //echo $q;
        doquery($q,$koneksi);
        if (sqlaffectedrows($koneksi)>0) {
          $errmesg="Data log tahun $tahunhapus berhasil dihapus";
        } else {
          $errmesg="Data log  tahun $tahunhapus tidak dihapus";
        
        }
      } else {
        $errmesg="Tahun harus diisi.";
      }
  }  
  $aksi="";
}


if ($aksi=="tampilkan") {
	$aksi=" ";
	include "proseslogdokumen.php";
}

if ($aksi=="") { 
	printjudulmenu("Lihat Data Log");
	printmesg($errmesg);
	 $arraylog2=$arraylogiso;
	  asort($arraylog2);
	echo "
		<form name=form action=index.php method=post>
			<input type=hidden name=pilihan value='$pilihan'>
			<input type=hidden name=aksi value='tampilkan'>
		<table class=form>
 			<tr>	
				<td>
					Jenis Log 
				</td>
				<td>
					<select class=masukan name=jenislog>
						<option value=''>Semua</option>";
						foreach ($arraylog2 as $k=>$v) {
							echo "<option value='$k'>$v</option>";
						}
						echo "
					</select>
				</td>
			</tr>
		<tr >
			<td>Periode</td>
			<td nowrap>
			<input checked type=checkbox name=istglbayar value=1>
			".createinputtanggal("tglbayar",$tglbayar," class=masukan")."
			s.d 
			".createinputtanggal("tglbayar2",$tglbayar2," class=masukan")."
			</td>
			</tr>				
 			<tr>
 		<tr class=judulform>
			<td nowrap>Kata kunci keterangan</td>
			<td>".
		createinputtext("kunci",$kunci," class=masukan  size=20").

			"
			
			</td>
		</tr>
				<td colspan=2>
					<input type=submit value='Tampilkan' class=masukan>
				</td>
			</tr>
		</table>
		</form>
 	";




	printjudulmenu("Hapus Data Log");
    $token = md5(uniqid(rand(), TRUE));
    $_SESSION['token'] = $token;
 	echo "
		<form name=form action=index.php method=post 
    onSubmit=\"return confirm('Hapus data log? Data tidak akan bisa dikembalikan lagi');\">
			<input type=hidden name=pilihan value='$pilihan'>
			<input type=hidden name=aksi value='hapus'>
  		".createinputhidden("tokenc",$token,"")."
		<table class=form>
 		<tr >
			<td width=100>Tahun Log</td>
			<td nowrap>
			<input type=text size=4 name=tahunhapus value=''>
 			</td>
			</tr>				
 			<tr>
  				<td colspan=2>
					<input type=submit value='Hapus' class=masukan>
				</td>
			</tr>
		</table>
		</form>
 	";

}

?>
