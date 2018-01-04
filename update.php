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
<form action=update.php>
<h3>Update Iso 17025</h3>
<p>
Jika anda hendak mengupdate program ISO 17025, silakan klik tombol Update yang
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
<h3>Update Iso 17025 </h3>";

/* 
 
$sql[]=" CREATE TABLE `kelompokjenisuji` (
`ID` CHAR( 5 ) NOT NULL ,
`NAMA` VARCHAR( 200 ) NOT NULL ,
PRIMARY KEY ( `ID` )
) ";

$sql[]=" ALTER TABLE `jenisuji` ADD `IDKELOMPOK` CHAR( 5 ) NOT NULL DEFAULT '0'";

$sql[]=" CREATE TABLE `nilaibaku` (
`ID` INT UNSIGNED NOT NULL ,
`NILAI` VARCHAR( 50 ) NOT NULL ,
PRIMARY KEY ( `ID` )
)";

$sql[]=" ALTER TABLE `permintaan` CHANGE `ID` `ID` VARCHAR( 10 )  NOT NULL ,
CHANGE `ID2` `ID2` VARCHAR( 10 ) DEFAULT NULL ,
CHANGE `IDTRANS` `IDTRANS` VARCHAR( 10 ) NOT NULL ";

$sql[]="  ALTER TABLE `minta` CHANGE `ID` `ID` VARCHAR( 10 ) NOT NULL";
$sql[]="  ALTER TABLE `permintaan` ADD `NILAIBAKU` VARCHAR( 50 ) NOT NULL" ;

$sql[]="  ALTER TABLE `permintaan` ADD `DUPLO` SMALLINT UNSIGNED NOT NULL DEFAULT '0',
ADD `DATADUPLO` MEDIUMTEXT NOT NULL ,
ADD `DATADUPLO2` TEXT NOT NULL ";

$sql[]="  CREATE TABLE IF NOT EXISTS `settingkop` (
  `PANJANG` int(10) unsigned NOT NULL,
  `LEBAR` int(10) unsigned NOT NULL,
  `ISFOTO` smallint(5) unsigned NOT NULL,
  `PANJANGF` int(10) unsigned NOT NULL,
  `LEBARF` int(10) unsigned NOT NULL,
  `LATAR` smallint(5) unsigned NOT NULL,
  `LATARWARNA` char(6) NOT NULL,
  `LATARFOTO` tinytext NOT NULL,
  `UPDATER` varchar(20) NOT NULL,
  `LASTUPDATE` datetime NOT NULL,
  `ISLOGOKIRI` smallint(6) NOT NULL,
  `LOGOKIRI` tinytext NOT NULL,
  `ISLOGOKANAN` smallint(6) NOT NULL,
  `LOGOKANAN` tinytext NOT NULL,
  `ALOGOKIRI` varchar(100) NOT NULL,
  `ALOGOKANAN` varchar(100) NOT NULL,
  `PLKIRI` int(10) unsigned NOT NULL,
  `LLKIRI` int(10) unsigned NOT NULL,
  `PLKANAN` int(10) unsigned NOT NULL,
  `LLKANAN` int(10) unsigned NOT NULL,
  `HEADER1` varchar(100) NOT NULL,
  `HEADER2` varchar(100) NOT NULL,
  `HEADER3` varchar(100) NOT NULL,
  `FHEADER1` varchar(50) NOT NULL,
  `FHEADER2` varchar(50) NOT NULL,
  `FHEADER3` varchar(50) NOT NULL,
  `UHEADER1` smallint(6) NOT NULL,
  `UHEADER2` smallint(6) NOT NULL,
  `UHEADER3` smallint(6) NOT NULL,
  `ISBARCODE` smallint(6) NOT NULL,
  `WHEADER1` varchar(6) NOT NULL default '000000',
  `WHEADER2` varchar(6) NOT NULL default '000000',
  `WHEADER3` varchar(6) NOT NULL default '000000',
  `DATA` tinytext NOT NULL,
  `FDATA` varchar(100) NOT NULL,
  `UDATA` smallint(6) NOT NULL,
  `WDATA` varchar(6) NOT NULL
) ";

 
$sql[]="  INSERT INTO `settingkop` (`PANJANG`, `LEBAR`, `ISFOTO`, `PANJANGF`, `LEBARF`, `LATAR`, `LATARWARNA`, `LATARFOTO`, `UPDATER`, `LASTUPDATE`, `ISLOGOKIRI`, `LOGOKIRI`, `ISLOGOKANAN`, `LOGOKANAN`, `ALOGOKIRI`, `ALOGOKANAN`, `PLKIRI`, `LLKIRI`, `PLKANAN`, `LLKANAN`, `HEADER1`, `HEADER2`, `HEADER3`, `FHEADER1`, `FHEADER2`, `FHEADER3`, `UHEADER1`, `UHEADER2`, `UHEADER3`, `ISBARCODE`, `WHEADER1`, `WHEADER2`, `WHEADER3`, `DATA`, `FDATA`, `UDATA`, `WDATA`) VALUES
(0, 0, 0, 0, 0, 0, '', 'latarfoto.jpg', 'sistem', '2008-09-12 08:53:22', 1, 'logokiri.png', 0, 'logokanan.jpg', '', '', 25, 25, 15, 15, 'PT. KALTIM PARNA INDUSTRI', 'Laboratory Section', 'Phone : (0548) 41091, 41092, ext. 5114, 5116, Fax. 41093', 'Tahoma', 'Tahoma', 'Tahoma', 14, 12, 12, 0, '000000', '000000', '000000', '', '', 0, '');
";

$sql[]=" ALTER TABLE `permintaan` ADD `HASIL` VARCHAR( 100 ) NOT NULL ,
ADD `HASIL2` VARCHAR( 100 ) NOT NULL ,
ADD `RUMUS` VARCHAR( 100 ) NOT NULL ";

$sql[]=" ALTER TABLE `permintaan` ADD `BIAYA` FLOAT( 12, 2 ) NOT NULL ";

$sql[]="CREATE TABLE IF NOT EXISTS `biaya` (
  `ID` int(10) unsigned NOT NULL,
  `NILAI` FLOAT(12,2) NOT NULL,
  PRIMARY KEY  (`ID`)
)";

*/

$sql[]="ALTER TABLE  `minta` ADD  `CATATANMT` MEDIUMTEXT NOT NULL ";
$sql[]="
CREATE TABLE `filehasilanalis` (
`ID` VARCHAR( 10 ) NOT NULL ,
`IDTRANS` VARCHAR( 10 ) NOT NULL ,
`FILEANALIS` LONGBLOB NOT NULL ,
`NAMAFILEANALIS` TINYTEXT NOT NULL ,
PRIMARY KEY ( `ID` , `IDTRANS` )
) 
";

$sql[]="CREATE TABLE `filesupervisor` (
`ID` VARCHAR( 10 ) NOT NULL ,
`IDTRANS` VARCHAR( 10 ) NOT NULL ,
`FILESUPERVISOR` LONGBLOB NOT NULL ,
`NAMAFILESUPERVISOR` TINYTEXT NOT NULL ,
PRIMARY KEY ( `ID` , `IDTRANS` )
)"; 

$sql[]="
ALTER TABLE `settingkop` ADD `ISLOGOKIRI2` SMALLINT UNSIGNED NOT NULL ,
ADD `LOGOKIRI2` TINYTEXT NOT NULL ,
ADD `ISLOGOKANAN2` SMALLINT UNSIGNED NOT NULL ,
ADD `LOGOKANAN2` TINYTEXT NOT NULL ,
ADD `ALOGOKIRI2` VARCHAR( 100 ) NOT NULL ,
ADD `ALOGOKANAN2` VARCHAR( 100 ) NOT NULL ,
ADD `PLKIRI2` INT UNSIGNED NOT NULL ,
ADD `LLKIRI2` INT UNSIGNED NOT NULL ,
ADD `PLKANAN2` INT UNSIGNED NOT NULL ,
ADD `LLKANAN2` INT UNSIGNED NOT NULL 
";

$sql[]="
ALTER TABLE `settingkop` ADD `HEADER4` VARCHAR( 100 ) NOT NULL ,
ADD `HEADER5` VARCHAR( 100 ) NOT NULL ,
ADD `HEADER6` VARCHAR( 100 ) NOT NULL ,
ADD `HEADER7` VARCHAR( 100 ) NOT NULL ,
ADD `FHEADER4` VARCHAR( 50 ) NOT NULL ,
ADD `FHEADER5` VARCHAR( 50 ) NOT NULL ,
ADD `FHEADER6` VARCHAR( 50 ) NOT NULL ,
ADD `FHEADER7` VARCHAR( 50 ) NOT NULL ,
ADD `UHEADER4` SMALLINT NOT NULL ,
ADD `UHEADER5` SMALLINT NOT NULL ,
ADD `UHEADER6` SMALLINT NOT NULL ,
ADD `UHEADER7` SMALLINT NOT NULL ,
ADD `WHEADER4` VARCHAR( 6 ) NOT NULL ,
ADD `WHEADER5` VARCHAR( 6 ) NOT NULL ,
ADD `WHEADER6` VARCHAR( 6 ) NOT NULL ,
ADD `WHEADER7` VARCHAR( 6 ) NOT NULL ";

$sql[]="
ALTER TABLE  `jenisuji` ADD  `RM` TINYTEXT NOT NULL ";

$sql[]="
ALTER TABLE  `minta` ADD  `NOMER1` VARCHAR( 50 ) NOT NULL ,
ADD  `NOMER2` VARCHAR( 50 ) NOT NULL ";

$sql[]="
ALTER TABLE  `minta` ADD  `CATATANTAGIHAN` MEDIUMTEXT NOT NULL ";

$sql[]="
ALTER TABLE  `toko` ADD  `PASSWORD` VARCHAR( 100 ) NOT NULL ";

$sql[]="ALTER TABLE  `minta` ADD  `CATATANKLIEN` MEDIUMTEXT NOT NULL ";

$sql[]="
CREATE TABLE IF NOT EXISTS  `survey` (
`ID` CHAR( 10 ) NOT NULL ,
`JAWAB1` CHAR( 1 ) NOT NULL ,
`JAWAB2` CHAR( 1 ) NOT NULL ,
`JAWAB3` CHAR( 1 ) NOT NULL ,
`JAWAB4` CHAR( 1 ) NOT NULL ,
`JAWAB5` CHAR( 1 ) NOT NULL ,
`JAWAB6` CHAR( 1 ) NOT NULL ,
`CATATAN` MEDIUMTEXT NOT NULL ,
`NAMA` TINYTEXT NOT NULL ,
`PERUSAHAAN` TINYTEXT NOT NULL ,
`UPDATER` VARCHAR( 20 ) NOT NULL ,
`LASTUPDATE` DATETIME NOT NULL,
PRIMARY KEY(ID)
) ";

$sql[]="
CREATE TABLE IF NOT EXISTS `logdokumen` (
  `ID` int(11) NOT NULL auto_increment,
  `JENISDOKUMEN` text NOT NULL,
  `NAMA` tinytext NOT NULL,
  `PEGAWAI` varchar(100) NOT NULL,
  `WAKTU` datetime NOT NULL,
  `ASAL` varchar(100) NOT NULL,
  `JENISLOG` varchar(100) NOT NULL,
  PRIMARY KEY  (`ID`)
)";

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
