<?
include "header.php";
echo "
<html>
<head>
	<style>
		
	</style>
</head>
<body>
";
if ($aksi=="") {
echo "
<center  >
<form action=hapus.php>
<h3>Hapus Data Distro Surya Graha</h3>
<p>
Jika anda hendak menghapus data distro  SG, silakan klik tombol Update yang
ada di sebelah bawah dan tunggu sampai selesai. Terima kasih
</p>
<p><input type=submit name=aksi value=Update></p>
</form>
</center>
	

";
}
elseif ($aksi=="Update") {


echo "
<center  >
<h3>Hapus Data $judulprogram</h3>";

 
 
 
$sql[]="DELETE FROM detilkirimbarangprojek";
$sql[]="DELETE FROM bobotkegiatanprojek";
$sql[]="DELETE FROM kirimbarangprojek";
$sql[]="DELETE FROM kegiatanprojek";
$sql[]="DELETE FROM kegiatan";
$sql[]="DELETE FROM kasbonmandor";
$sql[]="DELETE FROM jenisbarangkegiatan";
$sql[]="DELETE FROM rinciankegiatanprojek";
$sql[]="DELETE FROM projek";
$sql[]="DELETE FROM mandorprojek";
//$sql[]="DELETE FROM piutang";
//$sql[]="DELETE FROM pengeluaranu";
//$sql[]="DELETE FROM pengeluaran";
//$sql[]="DELETE FROM penerimaanu";
//$sql[]="DELETE FROM jenis";
//$sql[]="DELETE FROM hutangretur";
//$sql[]="DELETE FROM hutang";
//$sql[]="DELETE FROM distributor";
//$sql[]="DELETE FROM barang";
//$sql[]="DELETE FROM penerimaan";
//$sql[]="DELETE FROM merek";
//$sql[]="DELETE FROM lokasi";
//$sql[]="DELETE FROM keuangan";
//$sql[]="DELETE FROM transterima";
//$sql[]="DELETE FROM transkeluar";
//$sql[]="DELETE FROM transretur";
//$sql[]="DELETE FROM toko";
//$sql[]="DELETE FROM sales";
//$sql[]="DELETE FROM retur";


$i=1;
foreach($sql as $q) {
	$h=doquery($q,$koneksi);
	echo "$i. $q <br>";
	if (mysql_error()!="") {
		echo "<p>Update gagal, ".mysql_error()."</p>";
	} else {
		echo "<p>Update OK. </p>";
	}
	$i++;
}


echo "
<p>Proses update selesai.  Silakan klik <a style='color:#ffddcc' href='index.php'>disini</a> untuk menggunakan program seperti biasa.</p>

</center>
";

}
echo "
</body>";
?>  