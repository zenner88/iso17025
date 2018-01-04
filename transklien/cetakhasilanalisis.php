<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
include $root."style.inc";
include "init.php";
include "initkop.php";
  include "proseskop.php";
  echo "$tmpkop";

$q="SELECT * FROM minta WHERE ID='$idupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$idklien=$data[IDKLIEN];
	$sampel=$data[SAMPEL];
	$catatan=$data[CATATAN];
	$catatanm=$data[CATATANM];
	$idman=$data[IDMAN];
 	$statusadm=$statuspermintaan=$data[STATUS];
	$tmp=explode("-",$data[TANGGALDATANG]);
	$tglmasuk=$tmp[2];
	$blnmasuk=$tmp[1];
	$thnmasuk=$tmp[0];

	$tmp=explode("-",$data[TANGGALDEADLINE]);
	$tgld=$tmp[2];
	$blnd=$tmp[1];
	$thnd=$tmp[0];

	$tmp=explode("-",$data[TANGGALSELESAI]);
	$tglse=$tmp[2];
	$blnse=$tmp[1];
	$thnse=$tmp[0];

	
	$q="SELECT COUNT(ID) AS JML FROM permintaan WHERE IDTRANS='$idupdate'";
	$h1=doquery($q,$koneksi);
	$d1=sqlfetcharray($h1);

	$q="SELECT COUNT(ID) AS JML FROM permintaan WHERE IDTRANS='$idupdate' AND STATUS='99'";
	$h2=doquery($q,$koneksi);
	$d2=sqlfetcharray($h2);
	if ($d1[JML]==$d2[JML]) {
		$statusakhir="selesai";
	}

if ($jenisanalisis>=10) {
	$styletab="style='width:600px'";
}
$tmpcetak = "

	<center>
 	<h3><--JUDUL--></h3>
 	<table  $styletab>
		<tr>
			<td  width=100  nowrap>
				".$arraybahasa["Jenis Contoh"]."
			</td>
			<td>:</td>
			<td>
				<--CONTOH-->
		</tr>
		<tr>
			<td  width=100  nowrap>
				".$arraybahasa["No. Memo"]."
			</td>
			<td>:</td>
			<td>
				$id
		</tr>
	<tr>
		<td  >".$arraybahasa["Tanggal Datang"]."</td>
					<td>:</td>

		<td>$tglmasuk-$blnmasuk-$thnmasuk
		</td>
	</tr>
 	<tr>
		<td  >".$arraybahasa["Tanggal Pengerjaan"]."</td>
					<td>:</td>

		<td>$tglse-$blnse-$thnse</td> 
	</tr>	 
   	</table>

<br> 
 
";

$cetak="cetak";
printhtml();
if ($jenisanalisis==0) {
	include "cetakkadarair.php";
} elseif ($jenisanalisis==1) {
	include "cetakkadarprotein.php";
} elseif ($jenisanalisis==2) {
	include "cetakkadarlemak.php";
} elseif ($jenisanalisis==3) {
	include "cetakkadarabu.php";
} elseif ($jenisanalisis==5) {
	include "cetakkadarserat.php";
} elseif ($jenisanalisis==6) {
	include "cetakkadarkh.php";
} elseif ($jenisanalisis==7) {
	include "cetakkadargulap.php";
} elseif ($jenisanalisis==8) {
	include "cetakkadargulat.php";
} elseif ($jenisanalisis==9) {
	include "cetakkadarklor.php";
} elseif ($jenisanalisis>9 && $jenisanalisis<=16) {
	include "cetakkadarlogam.php";
} elseif ($jenisanalisis>16 && $jenisanalisis<=23) {
	include "cetakkadarlogam2.php";
} elseif ($jenisanalisis>30) {
	include "cetakkadarujilain.php";
}


 $tmpcetak.= "				<br><br>
				<table $styletab>
					<tr align=center>
						<td width=33%>Manajer Teknis</td>
						<td width=33%>Penyelia</td>
						<td width=33%>Pelaksana</td>
					</tr>
					<tr align=center>
						<td width=33%><br><br><br><br></td>
						<td width=33%></td>
						<td width=33%></td>
					</tr>
					<tr align=center>
						<td width=33%>( ".$arraymanagerteknis[$idman]." )</td>
						<td width=33%>( ".$arraysupervisor[$idsup]." )</td>
						<td width=33%>( ".$arrayanalis[$idan]." )</td>
					</tr>
				</table>
				

	</td>
	</tr>				
	</table>
";

echo $tmpcetak;
}
?>
