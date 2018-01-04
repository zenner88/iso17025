<?

if ($pilihan=="aupdate") {
	include "updatetokoa2.php";
}

$q="SELECT ID,NAMA FROM user WHERE TINGKAT='C' ORDER BY NAMA";
$h=doquery($q,$koneksi);
while ($d=sqlfetcharray($h)) {
	$arraymanagerteknis[$d[ID]]=$d[NAMA];
}

$q="SELECT ID,NAMA FROM user WHERE TINGKAT='D' ORDER BY NAMA";
$h=doquery($q,$koneksi);
while ($d=sqlfetcharray($h)) {
	$arraysupervisor[$d[ID]]=$d[NAMA];
}
$q="SELECT user.ID,user.NAMA, COUNT(permintaan.ID) AS JML 
FROM user LEFT JOIN permintaan ON user.ID=permintaan.IDAN AND (permintaan.STATUS=2 OR permintaan.STATUS=3)

WHERE user.TINGKAT='E' GROUP BY user.ID ORDER BY COUNT(permintaan.ID) ";
$h=doquery($q,$koneksi);
while ($d=sqlfetcharray($h)) {
	$arrayanalis[$d[ID]]=$d[NAMA]." ( $d[JML] pekerjaan) ";
	$arraynamaanalis[$d[ID]]=$d[NAMA];
}
$q="SELECT ID,NAMA FROM ik ORDER BY ID";
$h=doquery($q,$koneksi);
while ($d=sqlfetcharray($h)) {
	$arrayik[$d[ID]]=$d[ID]." - ".$d[NAMA];
}

?>
