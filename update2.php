<?
/*
ALTER TABLE keuangan ADD DEBIT VARCHAR(128);
ALTER TABLE keuangan ADD KREDIT VARCHAR(128);
ALTER TABLE keuangan ADD JENISU CHAR(1);
update keuangan SET JENISU='0';
*/
/*
ALTER TABLE transterima ADD DEBIT VARCHAR(128);
ALTER TABLE transkeluar ADD DEBIT VARCHAR(128);
ALTER TABLE transretur ADD DEBIT VARCHAR(128);
ALTER TABLE transterima ADD KREDIT VARCHAR(128)
ALTER TABLE transkeluar ADD KREDIT VARCHAR(128)
ALTER TABLE transretur ADD KREDIT VARCHAR(128);

*/
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
<form action=update2.php>
<h3>Update Distro IFFA</h3>
<p>
Jika anda hendak mengupdate distro IFFA, silakan klik tombol Update yang
ada di sebelah bawah dan tunggu sampai selesai. Terima kasih
</p>
<p><input type=submit name=aksi value=Update></p>
</form>
</center>
	

";
}
elseif ($aksi=="Update") {


echo "
<center style='color:#ffffff'>
<h3>Update $judulprogram dari versi 1.1 ke versi 2.0</h3>
</center>
<div style='color:#ffffff'>";


$sql[]="ALTER TABLE transterima ADD DEBIT VARCHAR(128)";
$sql[]="ALTER TABLE transkeluar ADD DEBIT VARCHAR(128)";
$sql[]="ALTER TABLE transretur ADD DEBIT VARCHAR(128)";
$sql[]="ALTER TABLE transterima ADD KREDIT VARCHAR(128)";
$sql[]="ALTER TABLE transkeluar ADD KREDIT VARCHAR(128)";
$sql[]="ALTER TABLE transretur ADD KREDIT VARCHAR(128)";
$sql[]="alter table penerimaan modify HARGA DECIMAL(15,2)";
$sql[]="alter table pengeluaran modify HARGA DECIMAL(15,2)";
$sql[]="alter table retur modify HARGA DECIMAL(15,2)";

$sql[]="
	CREATE TABLE transtk (
  ID int(10) unsigned NOT NULL default '0',
  IDDISTRIBUTOR varchar(10) default NULL,
  TANDABUKTI varchar(30) default NULL,
  TANGGALM date default NULL,
  TANGGALJ smallint(5) unsigned NOT NULL default '0',
  STATUS smallint(5) unsigned NOT NULL default '0',
  DISKON decimal(4,2) default NULL,
  CATATAN tinytext,
  DEBIT varchar(128) default NULL,
  KREDIT varchar(128) default NULL,
  PRIMARY KEY (ID)
) TYPE=MyISAM";

$sql[]="
CREATE TABLE transtg (
  ID int(10) unsigned NOT NULL default '0',
  IDTOKO varchar(10) default NULL,
  IDSALES varchar(10) default NULL,
  TANDABUKTI varchar(30) default NULL,
  TANGGALM date default NULL,
  TANGGALJ smallint(5) unsigned NOT NULL default '0',
  STATUS smallint(5) unsigned NOT NULL default '0',
  DISKON decimal(4,2) default NULL,
  CATATAN tinytext,
  DEBIT varchar(128) default NULL,
  KREDIT varchar(128) default NULL,
  PRIMARY KEY (ID)
) TYPE=MyISAM";


$sql[]="
CREATE TABLE tg (
  ID int(10) unsigned NOT NULL default '0',
  IDTRANS int(10) unsigned NOT NULL default '0',
  IDBARANG varchar(15) default NULL,
  JUMLAH smallint(5) unsigned NOT NULL default '0',
  SATUAN smallint(5) unsigned NOT NULL default '0',
  NILAISATUAN smallint(5) unsigned default '1',
  HARGA decimal(15,2) default NULL,
  PRIMARY KEY (ID,IDTRANS)
) TYPE=MyISAM";
$sql[]="
CREATE TABLE tk (
  ID int(10) unsigned NOT NULL default '0',
  IDTRANS int(10) unsigned NOT NULL default '0',
  IDBARANG varchar(15) default NULL,
  JUMLAH smallint(5) unsigned NOT NULL default '0',
  SATUAN smallint(5) unsigned NOT NULL default '0',
  NILAISATUAN smallint(5) unsigned default '1',
  HARGA decimal(15,2) default NULL,
  PRIMARY KEY (ID,IDTRANS)
) TYPE=MyISAM";


$sql[]="
CREATE TABLE akun (
  ID varchar(128) NOT NULL default '',
  NAMA tinytext,
  SUBID varchar(128) default NULL,
  UNTUK char(1) default NULL,
  UNTUKNERACA char(1) default NULL,
  KONTRAID varchar(128) default NULL,
  TINGKAT char(1) default NULL,
  SUBUNTUKNERACA CHAR(1),
  UNTUKRUGILABA CHAR(1),
  PRIMARY KEY (ID)
) TYPE=MyISAM
";

$sql[]="INSERT INTO akun VALUES ('1','Aktiva','','0','0','','0','0',NULL)";
$sql[]=" INSERT INTO akun VALUES ('10','Aktiva Lancar','1','0','0','','0','0',NULL)";
$sql[]=" INSERT INTO akun VALUES ('10.XX.XX','Kas','10','0','0','','0','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('10.10.01','Kas Besar','10.XX.XX','0','0','','1',NULL,NULL)";
$sql[]=" INSERT INTO akun VALUES ('11.XX.XX','Piutang Dagang','10','0','0','','0','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('20','Aktiva Tetap','1','0','0','','0','0',NULL)";
$sql[]=" INSERT INTO akun VALUES ('11.10.01','Piutang Dagang Toko','11.XX.XX','0','0','','1',NULL,NULL)";
$sql[]=" INSERT INTO akun VALUES ('10.10.02','Kas Kecil','10.XX.XX','0','0','','1',NULL,NULL)";
$sql[]=" INSERT INTO akun VALUES ('22.10.00','Kendaraan','20','0','0','22.10.01','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('20.10.00','Tanah','20','0','0','','1',NULL,NULL)";
$sql[]=" INSERT INTO akun VALUES ('21.10.00','Gedung','20','0','0','21.10.00','1',NULL,NULL)";
$sql[]=" INSERT INTO akun VALUES ('21.10.01','Akumulasi Penyusutan - Gedung','20','0','0','','1',NULL,NULL)";
$sql[]=" INSERT INTO akun VALUES ('10.20.01','Bank BCA','10.XX.XX','0','0','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('10.20.02','Bank Mandiri','10.XX.XX','0','0','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('10.00.00','Pos Silang','10','0','0','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('11.10.02','Piutang Dagang Pim','11.XX.XX','0','0','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('11.10.03','Piutang Dagang Rumah Sakit','11.XX.XX','0','0','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('22.10.01','Akumulasi Penyusutan - Kendaraan','20','0','0','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('23.10.00','Peralatan Kantor','20','0','0','23.10.01','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('23.10.01','Akumulasi Penyusutan - Peralatan Kantor','20','0','0','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('30','Aktiva Lain-lain','1','0','0','','0','0',NULL)";
$sql[]=" INSERT INTO akun VALUES ('30.10.00','Jaminan Bank','30','0','0','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('30.20.00','Pendapatan Ditangguhkan','30','0','0','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('40','Kewajiban Lancar','1','0','1','','0','0',NULL)";
$sql[]=" INSERT INTO akun VALUES ('40.XX.XX','Utang Dagang','40','0','1','','0','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('40.10.01','Utang Dagang - Depot','40.XX.XX','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('41.10.00','Utang Bank','40','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('42.XX.XX','Utang Pajak','40','0','1','','0','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('42.10.01','Utang Pajak - Pph 21','42.XX.XX','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('42.10.02','Utang Pajak - Pph Badan','42.XX.XX','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('43.10.00','PPN Keluaran','40','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('44.10.00','Beban ymh Dibayar','40','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('45.10.00','Pendapatan diterima dimuka','40','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('46.10.00','Utang Lain-Lain','40','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('50','Kewajiban Jangka Panjang','1','0','1','','0','0',NULL)";
$sql[]=" INSERT INTO akun VALUES ('50.10.00','Utang Bank','50','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('60','Ekuitas','1','0','1','','0','0',NULL)";
$sql[]=" INSERT INTO akun VALUES ('60.10.00','Modal Disetor','60','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('60.20.00','Laba Ditahan','60','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('60.30.00','Koreksi Laba Ditahan Tahun Lalu','60','0','1','','1','1',NULL)";
$sql[]=" INSERT INTO akun VALUES ('2','Rugi Laba','','1','0','','0','1','1')";
$sql[]=" INSERT INTO akun VALUES ('70','Pendapatan Penjualan','2','1','0','','0','0','0')";
$sql[]=" INSERT INTO akun VALUES ('80','Harga Pokok Penjualan','2','1','0','','0','0','1')";
$sql[]=" INSERT INTO akun VALUES ('90','Beban Penjualan','9','1','0','','0','0','1')";
$sql[]=" INSERT INTO akun VALUES ('91','Beban Administrasi','9','1','0','','0','0','1')";
$sql[]=" INSERT INTO akun VALUES ('92','Pendapatan Lain-lain','2','1','0','','0','0','0')";
$sql[]=" INSERT INTO akun VALUES ('93','Beban Lain-lain','2','1','0','','0','0','1')";
$sql[]=" INSERT INTO akun VALUES ('93.10.01','Administrasi Bank','93','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('93.10.02','Rugi Penjualan Aktiva Tetap','93','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('94.00.00','Pajak Penghasilan','93','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('95.00.00','Ikhtisar Laba','93','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('92.10.01','Bunga Deposito','92','1','0','','1','1','0')";
$sql[]=" INSERT INTO akun VALUES ('92.10.02','Jasa Rekening Koran','92','1','0','','1','1','0')";
$sql[]=" INSERT INTO akun VALUES ('92.10.03','Laba Penjualan Aktiva Tetap','92','1','0','','1','1','0')";
$sql[]=" INSERT INTO akun VALUES ('91.10.01','Gaji Staf Administrasi','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('91.10.021','Telepon dan Fax','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('91.10.022','Listrik','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('91.10.03','Perlengkapan Kantor','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('91.10.04','Sewa','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('91.10.05','Piutang Tak Tertagih','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('91.10.06','Penyusutan Peralatan','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('91.10.07','Penyusutan Kendaraan','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('91.10.08','Pph 21','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('91.10.09','Pph 23','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('91.10.10','Rupa-rupa','91','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('90.10.01','Gaji Bagian Penjualan','90','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('90.10.02','Komisi','90','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('90.10.03','Promosi','90','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('90.10.04','Transportasi','90','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('90.10.05','Penyusutan Peralatan','90','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('90.10.06','Penyusutan Kendaraan','90','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('90.10.07','Rupa-rupa','90','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('80.10.01','Harga Pokok Penjualan Barang','80','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('81.10.00','Diskon Pembelian','80','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('82.10.00','Retur Pembelian','80','1','0','','1','1','1')";
$sql[]=" INSERT INTO akun VALUES ('70.XX.XX','Penjualan','70','1','0','','0','1','0')";
$sql[]=" INSERT INTO akun VALUES ('70.10.01','Pendapatan Penjualan Barang','70.XX.XX','1','0','','1','1','0')";
$sql[]=" INSERT INTO akun VALUES ('71.10.00','Diskon Penjualan','70','1','0','','1','1','0')";
$sql[]=" INSERT INTO akun VALUES ('72.10.00','Retur Penjualan','70','1','0','','1','1','0')";
$sql[]=" INSERT INTO akun VALUES ('9','Beban Operasional','2','1','0','','0','0','1')";
$sql[]=" INSERT INTO akun VALUES ('12','Inventori','10','0','0','','0','1','0')";
$sql[]=" INSERT INTO akun VALUES ('12.10.00','Persediaan Barang','12','0','0','','1','1','0')";



$sql[]="
CREATE TABLE keuangan (
  ID int(10) unsigned NOT NULL default '0',
  TANGGAL date default NULL,
  JUMLAH decimal(15,2) default NULL,
  STATUS char(1) default NULL,
  JENIS char(1) default NULL,
  BUKTI varchar(50) default NULL,
  CATATAN tinytext,
  DEBIT varchar(128) default NULL,
  KREDIT varchar(128) default NULL,
  JENISU char(1) default NULL,
  PRIMARY KEY (ID)
) TYPE=MyISAM
";

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

$q="DELETE FROM keuangan";
$h=doquery($q,$koneksi);

$q="SELECT * FROM penerimaanu";
$h=doquery($q,$koneksi);
if (sqlnumrows($h)>0) {
	$i=0;
	while ($d=sqlfetcharray($h)) {
		echo ($i+1).".  ";
		echo $q="INSERT INTO keuangan VALUES
		('$i','$d[TANGGAL]','$d[JUMLAH]','$d[STATUS]','$d[JENIS]','$d[BUKTI]','$d[CATATAN]','','','1')
		";
		$h2=doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {
			echo "<br>Query OK<br><br>";
		} else {
			echo "<br>Query Gagal<br><br>";
		}
		$i++;
	}
}

$q="SELECT * FROM pengeluaranu";
$h=doquery($q,$koneksi);
if (sqlnumrows($h)>0) {
	//$i=0;
	while ($d=sqlfetcharray($h)) {
		echo ($i+1).".  ";
		echo $q="INSERT INTO keuangan VALUES
		('$i','$d[TANGGAL]','$d[JUMLAH]','$d[STATUS]','$d[JENIS]','$d[BUKTI]','$d[CATATAN]','','','0')
		";
		$h2=doquery($q,$koneksi);
		if (sqlaffectedrows($koneksi)>0) {
			echo "<br>Query OK<br><br>";
		} else {
			echo "<br>Query Gagal<br><br>";
		}
		$i++;
	}
}


echo "
<p>Proses update selesai.  Silakan klik <a style='color:#ffddcc' href='index.php'>disini</a> untuk menggunakan program seperti biasa.</p>

</center>
";

}
echo "
</body>";
?>  