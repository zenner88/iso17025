<?
	$arraymenu[12][Judul]="Permintaan Analisis";
	$arraymenu[0][Judul]="Permintaan Analisis";
	$arraymenu[8][Judul]="Gudang";
	$arraymenu[4][Judul]="Instruksi Kerja";
	$arraymenu[11][Judul]="Data Jenis Uji Tambahan";
	$arraymenu[1][Judul]="Data Klien";
//	$arraymenu[2][Judul]="Laporan Transaksi";
	$arraymenu[3][Judul]="Operator";
//	$arraymenu[5][Judul]="Tabel";
	$arraymenu[6][Judul]="Ganti Password";
	$arraymenu[9][Judul]="Cadangan Data";
	$arraymenu[7][Judul]="Keluar";




	$arraymenu[12][href]="transklien/index.php";
	$arraymenu[0][href]="trans/index.php";
	$arraymenu[1][href]="klien/index.php";
//	$arraymenu[2][href]="laporan/index.php";
	$arraymenu[3][href]="operator/index.php";
	$arraymenu[4][href]="ik/index.php";
//	$arraymenu[5][href]="tabel/index.php";
	$arraymenu[6][href]="password/index.php";
	$arraymenu[7][href]="user/index.php?aksi=logout";
	$arraymenu[8][href]="gudang/index.php";
	$arraymenu[9][href]="cadangan/index.php";
	$arraymenu[11][href]="jenisuji/index.php";

	$arraymenu[0][t]="BCDE";
	$arraymenu[1][t]="B";
//	$arraymenu[2][t]="ABCE";
	$arraymenu[3][t]="A";
	$arraymenu[4][t]="C";
//	$arraymenu[5][t]="ACE";
	$arraymenu[6][t]="";
	$arraymenu[7][t]="";
	$arraymenu[9][t]="A";
	$arraymenu[11][t]="C";
	$arraymenu[12][t]="F";
	//$arraymenu[10][t]="C";
	$arraymenu[8][t]="C";

$jumlahmenu=count($arraymenu);

	echo "
<table width='100%' cellpadding='0' cellspacing='0' border='0'>

<tr>
	<td colspan='2' id='menubar'>
 		<ul id='tabs'>
					
					";
					$k=0;
	foreach ($arraymenu as $i=>$v) {
		if  (session_is_registered("tingkats") && (ereg($tingkats,$v[t]) || ($v[t]==""))) {
			if (($v[j]!="" && session_is_registered("jabatans") && $jabatans==$v[j]) || $v[j]=="") {
 					$reg=str_replace("?","\?",$v[href]);
					if (ereg("($reg)",$REQUEST_URI)) {
 						$ta="id='active'";
 					} else {
						$ta="id='inactive'";
					}
					echo "
					<li> <a  $ta href='../$v[href]'> $b $v[Judul] $tb &nbsp;&nbsp;&nbsp;&nbsp;</a> </li>";
					$t="";
					$ta="";
					$td="";
						$b="";
						$tb="";
			}
		}
		$k ++;
	}
	echo "</ul></td></tr>

";
 
	echo "

		<tr >
		<td class=welcome colspan=2  height=25>
			
			  &nbsp;
			".$arrayhari[$waktu[wday]].", $waktu[mday] ".$arraybulan[$waktu[mon]-1]." $waktu[year],
		Selamat Datang $users/$namausers (".$arraytingkat[$tingkats].")
		</td>
		</tr>
	
	";
 	
?>

