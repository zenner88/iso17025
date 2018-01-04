<?
include "header.php";
echo "
<html>
<head>
	<style>
		$style
	</style>
</head>
<body>
";
if ($aksi=="") {
echo "
<center style='color:#ffffff'>
<form action=repair.php>
<h3>Perbaiki Distro IFFA</h3>
<p>
Jika anda hendak memperbaiki distro IFFA, silakan klik tombol Perbaiki yang
ada di sebelah bawah dan tunggu sampai selesai. Terima kasih
</p>
<p><input type=submit name=aksi value=Perbaiki></p>
</form>
</center>
	

";
}
elseif ($aksi=="Perbaiki") {


echo "
<center style='color:#ffffff'>
<h3>Perbaiki $judulprogram </h3>";

$sql[]="REPAIR TABLE toko";
$sql[]="REPAIR TABLE barang";
$sql[]="REPAIR TABLE distributor";
$sql[]="REPAIR TABLE jenis";
$sql[]="REPAIR TABLE merek";
$sql[]="REPAIR TABLE penerimaan";
$sql[]="REPAIR TABLE penerimaanu";
$sql[]="REPAIR TABLE pengeluaran";
$sql[]="REPAIR TABLE pengeluaranu";
$sql[]="REPAIR TABLE retur";
$sql[]="REPAIR TABLE sales";
$sql[]="REPAIR TABLE toko";
$sql[]="REPAIR TABLE transkeluar";
$sql[]="REPAIR TABLE transretur";
$sql[]="REPAIR TABLE transterima";
$sql[]="REPAIR TABLE user";
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

$i=1;
foreach($sql as $q) {
	$h=doquery($q,$koneksi);
	echo "$i. $q <br>";
	if (mysql_error()!="") {
		echo "<p>Perbaikan gagal, ".mysql_error()."</p>>";
	} else {
		echo "<p>Perbaikan OK. </p>";
	}
	$i++;
}


echo "
<p>Proses perbaikan selesai.  Silakan klik <a style='color:#ffddcc' href='index.php'>disini</a> untuk menggunakan program seperti biasa.</p>

</center>
";

}
echo "
</body>";
?>  