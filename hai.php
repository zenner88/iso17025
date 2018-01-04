<?
/*
<p>TERIMA KASIH ATAS PENGGUNAAN PROGRAM <?=$judulprogram?>.   </p>                                     

Program ini dibuat atas kerjasama SUTEKI TECH dengan CV IFFA.                                                   


<p> ---------- PERHATIAN!! ----------</p>

Jika anda membeli Program <?=$judulprogram?> ini secara LEGAL, maka
anda telah PERTAMA membantu kami dalam memberikan kesempatan untuk mengembangkan program <?=$judulprogram?> ini, KEDUA menghargai HaKI (Hak atas Kekayaan Intelektual) serta KETIGA membayar zakat dari setiap keping CD yang terjual.       Saran dan Kritik mohon disampaikan kepada: suteki_tech@yahoo.com 

*/

	$q="SELECT * FROM projek WHERE STATUS='0'
	";
	$h=doquery($q,$koneksi);
	if (sqlnumrows($h) > 0) {
		printjudulmenu("Data Projek yang Belum Selesai");
		printmesg($errmesg);
		printmesg($jdl);
		echo "
		 	<table>
			<tr class=judulkolom align=center>
				<td>No</td>
				<td>Kode </td>
				<td>Nama Projek</td>
 				<td>Pelanggan</td>
 				<td>Tanggal Mulai</td>
				<td>Tanggal Deadline</td>
  			</tr>
		";
		$i=0;
		while ($data=sqlfetcharray($h)) {
			$i++;
			$class=kelas($i);
			/*
			$q="SELECT COUNT(IDKEGIATAN) AS JML 
			FROM kegiatanprojek WHERE IDPROJEK='$data[ID]' 
			";
			$h2=doquery($q,$koneksi);
			$d2=sqlfetcharray($h2);
			*/
			$css="";
			if ($data[STATUS]==0) {
				$css="style='background=#ff8888'";
 				
			}
			echo "
				<tr   $class>
					<td align=center>$i</td>
					<td align=center>$data[KODE]</td>
					<td  >$data[NAMA]</td>
 					<td  >".getnamatoko($data[IDTOKO])."</td>
 					<td align=center nowrap>$data[TGLMASUK]</td>
					<td align=center nowrap>$data[TGLDEADLINE]</td>
 				</tr>
			";
		}
		echo "
			</table>
		";
	} else {
		$aksi="";
		$errmesg="Data Projek Tidak Ada";
	}
?>