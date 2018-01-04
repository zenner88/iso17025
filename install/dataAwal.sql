-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 21, 2017 at 08:42 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `db_iso17025`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `biaya`
-- 

CREATE TABLE `biaya` (
  `ID` int(10) unsigned NOT NULL,
  `NILAI` float(12,2) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `biaya`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `filehasilanalis`
-- 

CREATE TABLE `filehasilanalis` (
  `ID` varchar(10) NOT NULL,
  `IDTRANS` varchar(10) NOT NULL,
  `FILEANALIS` longblob NOT NULL,
  `NAMAFILEANALIS` tinytext NOT NULL,
  PRIMARY KEY  (`ID`,`IDTRANS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `filehasilanalis`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `filesupervisor`
-- 

CREATE TABLE `filesupervisor` (
  `ID` varchar(10) NOT NULL,
  `IDTRANS` varchar(10) NOT NULL,
  `FILESUPERVISOR` longblob NOT NULL,
  `NAMAFILESUPERVISOR` tinytext NOT NULL,
  PRIMARY KEY  (`ID`,`IDTRANS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `filesupervisor`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ik`
-- 

CREATE TABLE `ik` (
  `ID` varchar(20) NOT NULL,
  `NAMA` tinytext,
  `FILE` tinytext,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `ik`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jenisuji`
-- 

CREATE TABLE `jenisuji` (
  `ID` int(10) unsigned NOT NULL default '31',
  `NAMA` tinytext,
  `NAMA2` tinytext,
  `JMLVAR` int(10) unsigned NOT NULL default '0',
  `RUMUS` tinytext,
  `HASIL` tinytext,
  `SATUAN` tinytext,
  `IDKELOMPOK` char(5) NOT NULL default '0',
  `RM` tinytext NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `jenisuji`
-- 

INSERT INTO `jenisuji` VALUES (120, 'Kadar Air', 'Air', 4, '100 * ((B-A)-(C-A)) / (B-A)', '% air', '%', '0', '');
INSERT INTO `jenisuji` VALUES (121, 'Kadar Protein', 'Protein', 6, 'F * 100 * (A*B*C*14) / (D*E)', '% Protein', '%', '0', '');
INSERT INTO `jenisuji` VALUES (122, 'Kadar Lemak cara Soxhlet', 'Lemak', 4, '100 * (D - C) / (B - A)', '% Lemak', '%', '0', '');
INSERT INTO `jenisuji` VALUES (123, 'Kadar Abu', 'Abu', 3, '100 * (C - A) / (B - A)', '% Abu', '%', '0', '');
INSERT INTO `jenisuji` VALUES (124, 'Kadar Serat Kasar', 'Serat Kasar', 5, '100 * ( D - ( B + C + E ) ) / A', '% Serat', '%', '0', '');
INSERT INTO `jenisuji` VALUES (125, 'Kadar KH cara Luff Schoorl', 'KH', 10, '100 * (250/b) * (a/c) * d', '% KH', '%', '0', '');
INSERT INTO `jenisuji` VALUES (126, 'Kadar Gula Pereduksi cara Luff Schoorl', 'Gula Pereduksi', 10, '100 * (vPl/b)  * (a/c) * d', '% Gula Pereduksi', '%', '0', '');
INSERT INTO `jenisuji` VALUES (127, 'Kadar Gula Total cara Luff Schoorl', 'Gula Total', 12, '100 * (100/b)  * (a/c) * d', '% Gula Total', '%', '0', '');
INSERT INTO `jenisuji` VALUES (128, 'Kadar Klorida cara Mohr', 'Klorida', 6, '100 * (A/B) * C * D * E / F', '% Klorida', '%', '0', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `kelompokjenisuji`
-- 

CREATE TABLE `kelompokjenisuji` (
  `ID` char(5) NOT NULL,
  `NAMA` varchar(200) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `kelompokjenisuji`
-- 

INSERT INTO `kelompokjenisuji` VALUES ('0', 'DEFAULT JENIS UJI');
INSERT INTO `kelompokjenisuji` VALUES ('GAS', 'UJI PROSES GAS');
INSERT INTO `kelompokjenisuji` VALUES ('UTIL', 'UTILITAS');

-- --------------------------------------------------------

-- 
-- Table structure for table `logdokumen`
-- 

CREATE TABLE `logdokumen` (
  `ID` int(11) NOT NULL auto_increment,
  `JENISDOKUMEN` text NOT NULL,
  `NAMA` tinytext NOT NULL,
  `PEGAWAI` varchar(100) NOT NULL,
  `WAKTU` datetime NOT NULL,
  `ASAL` varchar(100) NOT NULL,
  `JENISLOG` varchar(100) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- 
-- Dumping data for table `logdokumen`
-- 

INSERT INTO `logdokumen` VALUES (1, 'Tambah Operator. ID=001,nama=robby', 'INSERT INTO user VALUES(''001'',''robby'',md5(''robby''),''B'')', 'superadmin', '2013-05-21 09:22:57', '127.0.0.1', 'Tambah Operator');
INSERT INTO `logdokumen` VALUES (2, 'Tambah permintaan. ID=000001, Klien=biofarma, Sampel=makanan bayi', 'INSERT INTO minta \r\n 			(ID,IDKLIEN,TANGGALDATANG,TANGGALDEADLINE,STATUS,\r\n 			IDUSER,IDMAN,TGLUPDATE,UPDATER,CONTOH,NOMER1,NOMER2)\r\n 			VALUES(''000001'',''biofarma'',''2013-5-21'',''2013-5-21'',\r\n			''3'',''admin'',''mt'',NOW(),''admin'',''makanan bayi'',''001'',''001'')', 'admin', '2013-05-21 09:32:59', '127.0.0.1', 'Tambah Permintaan');
INSERT INTO `logdokumen` VALUES (3, 'Tambah Jenis Uji Permintaan. ID Jenis Uji=000001, ID Permintaan=000001, Jenis Analisis=Penentuan Cd dgn AAS', 'INSERT INTO permintaan \r\n        		(ID,IDTRANS,JENISANALISIS,STATUS,SAMPEL,CATATAN,TGLUPDATE,UPDATER,HISTORY,NILAIBAKU,DUPLO,BIAYA)\r\n        		VALUES\r\n        		(''000001'',''000001'',''10'',''0'','''',''kerjakan'',NOW(),''admin'',\r\n        		CONCAT(IF(HISTORY IS NULL,', 'admin', '2013-05-21 09:33:36', '127.0.0.1', 'Tambah Jenis Uji Permintaan');
INSERT INTO `logdokumen` VALUES (4, 'Tambah permintaan. ID=000002, Klien=biofarma, Sampel=air limbah', 'INSERT INTO minta \r\n 			(ID,IDKLIEN,TANGGALDATANG,TANGGALDEADLINE,STATUS,\r\n 			IDUSER,IDMAN,TGLUPDATE,UPDATER,CONTOH,NOMER1,NOMER2)\r\n 			VALUES(''000002'',''biofarma'',''2013-5-21'',''2013-5-21'',\r\n			''3'',''admin'',''mt'',NOW(),''admin'',''air limbah'',''002'',''002'')', 'admin', '2013-05-21 09:36:23', '127.0.0.1', 'Tambah Permintaan');
INSERT INTO `logdokumen` VALUES (5, 'Periksa Hasil Analisis Jenis Uji Permintaan. \r\n      Kode Permintaan: 000001, Kode Jenis Uji: 000001', 'UPDATE permintaan \r\n			SET \r\n			ID2=''000001'',\r\n			STATUS=''1'',FILE=''000001Sejarah RCChemLC.doc'',\r\n			IDSUP=''supervisor'',\r\n			TGLTERIMAMAN=''2013-5-21'',\r\n			CATATANM='''',\r\n			IDIK='''',\r\n 			TGLUPDATE=NOW(),\r\n			UPDATER=''mt'',\r\n			HISTORY=CONCAT(IF(HISTORY IS NU', 'mt', '2013-05-21 09:48:11', '127.0.0.1', 'MT: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (6, 'Periksa Hasil Analisis Jenis Uji Permintaan. Kode Permintaan: 000001', 'UPDATE permintaan \r\n			SET \r\n			STATUS=''2'',TGLTERIMASUP=NOW(),FILE=''000001'',\r\n			IDAN=''analis'',\r\n			IDIK='''',\r\n			TGLTERIMASUP=''2013-5-21'',\r\n			CATATANS=''segeraaaaa'',\r\n 			TGLUPDATE=NOW(),\r\n			UPDATER=''supervisor'',\r\n			HISTORY=CONCAT(IF(HISTORY IS NULL,'''',', 'supervisor', '2013-05-21 09:50:22', '127.0.0.1', 'Supervisor: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (7, 'Periksa Hasil Analisis Jenis Uji Permintaan. Kode Permintaan: 000001', 'UPDATE permintaan \r\n			SET \r\n			STATUS=''3'',TGLTERIMAAN=NOW(),\r\n 			 DATA='' s=10;b=;c=10;v=10;bc=5;'', DATA2='' 0=0.1;1=0.2;2=0.3;3=0.4;4=0.5;||0=1;1=2;2=3;3=4;4=5;'',\r\n 			\r\n  			CATATANA='''',\r\n 			TGLTERIMAAN=''2013-5-21'',\r\n			METODE='''',\r\n 			TGLUPDATE=NOW(),', 'analis', '2013-05-21 09:53:18', '127.0.0.1', 'Analis: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (8, 'Periksa Hasil Analisis Jenis Uji Permintaan. Kode Permintaan: 000001', 'UPDATE permintaan \r\n			SET \r\n			STATUS=''4'',TGLTERIMAAN=NOW(),\r\n 			 DATA='' s=10;b=1;c=10;v=10;bc=5;'', DATA2='' 0=0.1;1=0.2;2=0.3;3=0.4;4=0.5;||0=1;1=2;2=3;3=4;4=5;'',\r\n 			\r\n  			CATATANA='''',\r\n 			TGLTERIMAAN=''2013-5-21'',\r\n			METODE='''',\r\n 			TGLUPDATE=NOW()', 'analis', '2013-05-21 09:56:49', '127.0.0.1', 'Analis: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (9, 'Periksa Hasil Analisis Jenis Uji Permintaan. Kode Permintaan: 000001', 'UPDATE permintaan \r\n			SET \r\n			STATUS=''5'',FILE=''000001'',\r\n			IDAN=''analis'',\r\n			IDIK='''',\r\n			TGLTERIMASUP=''2013-5-21'',\r\n			CATATANS=''segeraaaaa'',\r\n 			TGLUPDATE=NOW(),\r\n			UPDATER=''supervisor'',\r\n			HISTORY=CONCAT(IF(HISTORY IS NULL,'''',HISTORY),CONCAT(NOW', 'supervisor', '2013-05-21 10:02:34', '127.0.0.1', 'Supervisor: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (10, 'Tambah permintaan. ID=000003, Klien=KIMLIPI, Sampel=', 'INSERT INTO minta \r\n 			(ID,IDKLIEN,TANGGALDATANG,TANGGALDEADLINE,STATUS,\r\n 			IDUSER,IDMAN,TGLUPDATE,UPDATER,CONTOH,NOMER1,NOMER2)\r\n 			VALUES(''000003'',''KIMLIPI'',''2013-5-22'',''2013-5-22'',\r\n			''3'',''admin'',''mt'',NOW(),''admin'','''',''dasf'',''afda'')', 'admin', '2013-05-22 08:41:42', '127.0.0.1', 'Tambah Permintaan');
INSERT INTO `logdokumen` VALUES (11, 'Simpan Setting Kop Surat.', 'UPDATE settingkop SET\r\n     PANJANG='''',LEBAR='''',PANJANGF='''',LEBARF='''',ISFOTO='''',\r\n     LATAR='''',LATARWARNA='''',\r\n     ISLOGOKIRI=''1'',ISLOGOKANAN=''1'',\r\n     ISLOGOKIRI2='''',ISLOGOKANAN2='''',\r\n     PLKIRI=''25'',LLKIRI=''25'',\r\n     PLKANAN=''15'',LLKANAN=''15'',\r\n   ', 'admin', '2016-08-23 08:17:01', '127.0.0.1', 'Setting Kop');
INSERT INTO `logdokumen` VALUES (12, 'Simpan Setting Kop Surat.', 'UPDATE settingkop SET\r\n     PANJANG='''',LEBAR='''',PANJANGF='''',LEBARF='''',ISFOTO='''',\r\n     LATAR='''',LATARWARNA='''',\r\n     ISLOGOKIRI=''1'',ISLOGOKANAN=''1'',\r\n     ISLOGOKIRI2=''1'',ISLOGOKANAN2='''',\r\n     PLKIRI=''25'',LLKIRI=''25'',\r\n     PLKANAN=''15'',LLKANAN=''15'',\r\n  ', 'admin', '2016-08-23 08:17:14', '127.0.0.1', 'Setting Kop');
INSERT INTO `logdokumen` VALUES (13, 'Simpan Setting Kop Surat.', 'UPDATE settingkop SET\r\n     PANJANG='''',LEBAR='''',PANJANGF='''',LEBARF='''',ISFOTO='''',\r\n     LATAR='''',LATARWARNA='''',\r\n     ISLOGOKIRI=''1'',ISLOGOKANAN=''1'',\r\n     ISLOGOKIRI2=''1'',ISLOGOKANAN2='''',\r\n     PLKIRI=''25'',LLKIRI=''25'',\r\n     PLKANAN=''15'',LLKANAN=''15'',\r\n  ', 'admin', '2016-08-23 08:17:37', '127.0.0.1', 'Setting Kop');
INSERT INTO `logdokumen` VALUES (14, 'Buat Laporan. Kode Permintaan: 000001,000002,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000002''  \r\n  ORDER BY ID', 'admin', '2016-08-23 14:49:02', '127.0.0.1', 'Buat Laporan');
INSERT INTO `logdokumen` VALUES (15, 'Buat Laporan. Kode Permintaan: 000001,000002,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000002''  \r\n  ORDER BY ID', 'admin', '2016-08-23 14:49:32', '127.0.0.1', 'Buat Laporan');
INSERT INTO `logdokumen` VALUES (16, 'Simpan Setting Kop Surat.', 'UPDATE settingkop SET\r\n     PANJANG='''',LEBAR='''',PANJANGF='''',LEBARF='''',ISFOTO='''',\r\n     LATAR='''',LATARWARNA='''',\r\n     ISLOGOKIRI=''1'',ISLOGOKANAN=''1'',\r\n     ISLOGOKIRI2=''1'',ISLOGOKANAN2='''',\r\n     PLKIRI=''25'',LLKIRI=''25'',\r\n     PLKANAN=''15'',LLKANAN=''15'',\r\n  ', 'admin', '2016-08-23 15:04:15', '127.0.0.1', 'Setting Kop');
INSERT INTO `logdokumen` VALUES (17, 'Buat Laporan. Kode Permintaan: 000001,000002,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000002''  \r\n  ORDER BY ID', 'admin', '2016-08-23 15:06:28', '127.0.0.1', 'Buat Laporan');
INSERT INTO `logdokumen` VALUES (18, 'Tambah Operator. ID=0010,nama=test', 'INSERT INTO user VALUES(''0010'',''test'',md5(''test''),''C'')', 'superadmin', '2016-12-02 09:14:05', '127.0.0.1', 'Tambah Operator');
INSERT INTO `logdokumen` VALUES (19, 'Buat Laporan. Kode Permintaan: 000001,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000001''  \r\n  ORDER BY ID', 'admin', '2016-12-02 09:18:30', '127.0.0.1', 'Buat Laporan');

-- --------------------------------------------------------

-- 
-- Table structure for table `minta`
-- 

CREATE TABLE `minta` (
  `ID` varchar(10) NOT NULL,
  `IDKLIEN` varchar(10) NOT NULL,
  `TANGGALDATANG` date default NULL,
  `TANGGALDEADLINE` date default NULL,
  `TANGGALSELESAI` date default NULL,
  `STATUS` smallint(5) unsigned NOT NULL default '0',
  `IDUSER` varchar(10) default NULL,
  `IDMAN` varchar(10) default NULL,
  `TGLUPDATE` datetime default NULL,
  `UPDATER` varchar(10) default NULL,
  `CONTOH` tinytext,
  `CATATANMT` mediumtext NOT NULL,
  `NOMER1` varchar(50) NOT NULL,
  `NOMER2` varchar(50) NOT NULL,
  `CATATANTAGIHAN` mediumtext NOT NULL,
  `CATATANKLIEN` mediumtext NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `minta`
-- 

INSERT INTO `minta` VALUES ('000001', 'biofarma', '2013-05-21', '2013-05-21', NULL, 3, 'admin', 'mt', '2013-05-21 09:32:59', 'admin', 'makanan bayi', '', '001', '001', '', '');
INSERT INTO `minta` VALUES ('000002', 'biofarma', '2013-05-21', '2013-05-21', NULL, 3, 'admin', 'mt', '2013-05-21 09:36:23', 'admin', 'air limbah', '', '002', '002', '', '');
INSERT INTO `minta` VALUES ('000003', 'KIMLIPI', '2013-05-22', '2013-05-22', NULL, 3, 'admin', 'mt', '2013-05-22 08:41:42', 'admin', '', '', 'dasf', 'afda', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `nilaibaku`
-- 

CREATE TABLE `nilaibaku` (
  `ID` int(10) unsigned NOT NULL,
  `NILAI` varchar(50) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `nilaibaku`
-- 

INSERT INTO `nilaibaku` VALUES (0, '');
INSERT INTO `nilaibaku` VALUES (1, '');
INSERT INTO `nilaibaku` VALUES (2, '');
INSERT INTO `nilaibaku` VALUES (3, '');
INSERT INTO `nilaibaku` VALUES (4, '');
INSERT INTO `nilaibaku` VALUES (5, '');
INSERT INTO `nilaibaku` VALUES (6, '');
INSERT INTO `nilaibaku` VALUES (7, '');
INSERT INTO `nilaibaku` VALUES (8, '');
INSERT INTO `nilaibaku` VALUES (9, '');
INSERT INTO `nilaibaku` VALUES (10, '');
INSERT INTO `nilaibaku` VALUES (11, '');
INSERT INTO `nilaibaku` VALUES (12, '');
INSERT INTO `nilaibaku` VALUES (13, '');
INSERT INTO `nilaibaku` VALUES (14, '');
INSERT INTO `nilaibaku` VALUES (15, '');
INSERT INTO `nilaibaku` VALUES (16, '');
INSERT INTO `nilaibaku` VALUES (17, '');
INSERT INTO `nilaibaku` VALUES (18, '');
INSERT INTO `nilaibaku` VALUES (19, '');
INSERT INTO `nilaibaku` VALUES (20, '');
INSERT INTO `nilaibaku` VALUES (21, '');
INSERT INTO `nilaibaku` VALUES (22, '');
INSERT INTO `nilaibaku` VALUES (23, '');
INSERT INTO `nilaibaku` VALUES (24, '');
INSERT INTO `nilaibaku` VALUES (25, '');
INSERT INTO `nilaibaku` VALUES (26, '');
INSERT INTO `nilaibaku` VALUES (27, '');
INSERT INTO `nilaibaku` VALUES (28, '');
INSERT INTO `nilaibaku` VALUES (29, '');
INSERT INTO `nilaibaku` VALUES (30, '');
INSERT INTO `nilaibaku` VALUES (31, '70');
INSERT INTO `nilaibaku` VALUES (32, '60');
INSERT INTO `nilaibaku` VALUES (33, '45');
INSERT INTO `nilaibaku` VALUES (34, '');
INSERT INTO `nilaibaku` VALUES (35, '');
INSERT INTO `nilaibaku` VALUES (36, '');
INSERT INTO `nilaibaku` VALUES (37, '');
INSERT INTO `nilaibaku` VALUES (38, '');
INSERT INTO `nilaibaku` VALUES (39, '');
INSERT INTO `nilaibaku` VALUES (40, '');
INSERT INTO `nilaibaku` VALUES (41, '');
INSERT INTO `nilaibaku` VALUES (42, '');
INSERT INTO `nilaibaku` VALUES (43, '');
INSERT INTO `nilaibaku` VALUES (44, '');
INSERT INTO `nilaibaku` VALUES (45, '');
INSERT INTO `nilaibaku` VALUES (46, '');
INSERT INTO `nilaibaku` VALUES (47, '');
INSERT INTO `nilaibaku` VALUES (48, '');
INSERT INTO `nilaibaku` VALUES (49, '');
INSERT INTO `nilaibaku` VALUES (50, '');
INSERT INTO `nilaibaku` VALUES (51, '');
INSERT INTO `nilaibaku` VALUES (52, '');
INSERT INTO `nilaibaku` VALUES (53, '');
INSERT INTO `nilaibaku` VALUES (54, '');
INSERT INTO `nilaibaku` VALUES (55, '');
INSERT INTO `nilaibaku` VALUES (56, '');
INSERT INTO `nilaibaku` VALUES (57, '');
INSERT INTO `nilaibaku` VALUES (58, '');
INSERT INTO `nilaibaku` VALUES (59, '');
INSERT INTO `nilaibaku` VALUES (60, '');
INSERT INTO `nilaibaku` VALUES (61, '');
INSERT INTO `nilaibaku` VALUES (62, '');
INSERT INTO `nilaibaku` VALUES (63, '');
INSERT INTO `nilaibaku` VALUES (64, '');
INSERT INTO `nilaibaku` VALUES (65, '');
INSERT INTO `nilaibaku` VALUES (66, '');
INSERT INTO `nilaibaku` VALUES (67, '');
INSERT INTO `nilaibaku` VALUES (68, '');
INSERT INTO `nilaibaku` VALUES (69, '');
INSERT INTO `nilaibaku` VALUES (70, '');
INSERT INTO `nilaibaku` VALUES (71, '');
INSERT INTO `nilaibaku` VALUES (72, '');
INSERT INTO `nilaibaku` VALUES (73, '');
INSERT INTO `nilaibaku` VALUES (74, '');
INSERT INTO `nilaibaku` VALUES (75, '');
INSERT INTO `nilaibaku` VALUES (76, '');
INSERT INTO `nilaibaku` VALUES (77, '');
INSERT INTO `nilaibaku` VALUES (78, '');
INSERT INTO `nilaibaku` VALUES (79, '');
INSERT INTO `nilaibaku` VALUES (80, '');
INSERT INTO `nilaibaku` VALUES (81, '');
INSERT INTO `nilaibaku` VALUES (82, '');
INSERT INTO `nilaibaku` VALUES (83, '');
INSERT INTO `nilaibaku` VALUES (84, '');
INSERT INTO `nilaibaku` VALUES (85, '');
INSERT INTO `nilaibaku` VALUES (86, '');
INSERT INTO `nilaibaku` VALUES (87, '');
INSERT INTO `nilaibaku` VALUES (88, '');
INSERT INTO `nilaibaku` VALUES (89, '');
INSERT INTO `nilaibaku` VALUES (90, '');
INSERT INTO `nilaibaku` VALUES (91, '');
INSERT INTO `nilaibaku` VALUES (92, '');
INSERT INTO `nilaibaku` VALUES (93, '');
INSERT INTO `nilaibaku` VALUES (94, '');
INSERT INTO `nilaibaku` VALUES (95, '');
INSERT INTO `nilaibaku` VALUES (96, '');
INSERT INTO `nilaibaku` VALUES (97, '');
INSERT INTO `nilaibaku` VALUES (98, '');
INSERT INTO `nilaibaku` VALUES (99, '');
INSERT INTO `nilaibaku` VALUES (100, '');
INSERT INTO `nilaibaku` VALUES (101, '');
INSERT INTO `nilaibaku` VALUES (102, '');
INSERT INTO `nilaibaku` VALUES (103, '');
INSERT INTO `nilaibaku` VALUES (104, '');
INSERT INTO `nilaibaku` VALUES (105, '');
INSERT INTO `nilaibaku` VALUES (106, '');
INSERT INTO `nilaibaku` VALUES (107, '');
INSERT INTO `nilaibaku` VALUES (108, '');
INSERT INTO `nilaibaku` VALUES (109, '');
INSERT INTO `nilaibaku` VALUES (110, '');
INSERT INTO `nilaibaku` VALUES (111, '');
INSERT INTO `nilaibaku` VALUES (112, '');
INSERT INTO `nilaibaku` VALUES (113, '');
INSERT INTO `nilaibaku` VALUES (114, '');
INSERT INTO `nilaibaku` VALUES (115, '');
INSERT INTO `nilaibaku` VALUES (116, '');
INSERT INTO `nilaibaku` VALUES (117, '');
INSERT INTO `nilaibaku` VALUES (118, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `permintaan`
-- 

CREATE TABLE `permintaan` (
  `ID` varchar(10) NOT NULL,
  `ID2` varchar(10) default NULL,
  `IDTRANS` varchar(10) NOT NULL,
  `TANGGALSELESAI` date default NULL,
  `STATUS` smallint(5) unsigned NOT NULL default '0',
  `JENISANALISIS` smallint(5) unsigned NOT NULL default '0',
  `SAMPEL` mediumtext,
  `CATATAN` mediumtext,
  `CATATANM` mediumtext,
  `CATATANS` mediumtext,
  `CATATANA` mediumtext,
  `IDSUP` varchar(10) default NULL,
  `IDAN` varchar(10) default NULL,
  `TGLTERIMAMAN` date default NULL,
  `TGLTERIMASUP` date default NULL,
  `TGLTERIMAAN` date default NULL,
  `TGLUPDATE` datetime default NULL,
  `UPDATER` varchar(10) default NULL,
  `METODE` varchar(100) default NULL,
  `DATA` mediumtext,
  `IDIK` varchar(20) default NULL,
  `FILE` tinytext,
  `DATA2` text,
  `HISTORY` text,
  `NILAIBAKU` varchar(50) NOT NULL,
  `DUPLO` smallint(5) unsigned NOT NULL default '0',
  `DATADUPLO` mediumtext NOT NULL,
  `DATADUPLO2` text NOT NULL,
  `HASIL` varchar(100) NOT NULL,
  `HASIL2` varchar(100) NOT NULL,
  `RUMUS` varchar(100) NOT NULL,
  `BIAYA` float(12,2) NOT NULL,
  PRIMARY KEY  (`ID`,`IDTRANS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `permintaan`
-- 

INSERT INTO `permintaan` VALUES ('000001', '000001', '000001', NULL, 5, 10, '', 'kerjakan', '', 'segeraaaaa', '', 'supervisor', 'analis', '2013-05-21', '2013-05-21', '2013-05-21', '2013-05-21 10:02:34', 'supervisor', '', ' s=10;b=1;c=10;v=10;bc=5;', '', '000001', ' 0=0.1;1=0.2;2=0.3;3=0.4;4=0.5;||0=1;1=2;2=3;3=4;4=5;', '2013-05-21 09:33:36 Dientri oleh Administrasi\r\n2013-05-21 09:48:11 Diupdate oleh Manajer Teknis (mt/mt). Status : Ada di Supervisor \r\n2013-05-21 09:50:22 Diupdate oleh Supervisor (supervisor/supervisor). Status : Ada di Analis \r\n2013-05-21 09:53:18 Diupdate oleh Analis (analis/analis). Status : Sedang Dianalisis \r\n2013-05-21 09:56:49 Diupdate oleh Analis (analis/analis). Status : Diperiksa Supervisor \r\n2013-05-21 10:02:34 Diupdate oleh Supervisor (supervisor/supervisor). Status : Diperiksa Manager Teknis \r\n', '', 0, '', '', '20', 'Error: Berat contoh = 0', '', 0.00);

-- --------------------------------------------------------

-- 
-- Table structure for table `settingkop`
-- 

CREATE TABLE `settingkop` (
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
  `WDATA` varchar(6) NOT NULL,
  `ISLOGOKIRI2` smallint(5) unsigned NOT NULL,
  `LOGOKIRI2` tinytext NOT NULL,
  `ISLOGOKANAN2` smallint(5) unsigned NOT NULL,
  `LOGOKANAN2` tinytext NOT NULL,
  `ALOGOKIRI2` varchar(100) NOT NULL,
  `ALOGOKANAN2` varchar(100) NOT NULL,
  `PLKIRI2` int(10) unsigned NOT NULL,
  `LLKIRI2` int(10) unsigned NOT NULL,
  `PLKANAN2` int(10) unsigned NOT NULL,
  `LLKANAN2` int(10) unsigned NOT NULL,
  `HEADER4` varchar(100) NOT NULL,
  `HEADER5` varchar(100) NOT NULL,
  `HEADER6` varchar(100) NOT NULL,
  `HEADER7` varchar(100) NOT NULL,
  `FHEADER4` varchar(50) NOT NULL,
  `FHEADER5` varchar(50) NOT NULL,
  `FHEADER6` varchar(50) NOT NULL,
  `FHEADER7` varchar(50) NOT NULL,
  `UHEADER4` smallint(6) NOT NULL,
  `UHEADER5` smallint(6) NOT NULL,
  `UHEADER6` smallint(6) NOT NULL,
  `UHEADER7` smallint(6) NOT NULL,
  `WHEADER4` varchar(6) NOT NULL,
  `WHEADER5` varchar(6) NOT NULL,
  `WHEADER6` varchar(6) NOT NULL,
  `WHEADER7` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `settingkop`
-- 

INSERT INTO `settingkop` VALUES (0, 0, 0, 0, 0, 0, '', 'latarfoto.jpg', 'sistem', '2008-09-12 08:53:22', 1, 'logokiri.jpg', 1, 'logokanan.jpg', '', '', 25, 25, 15, 15, 'Pusat Penelitian Kimia - LIPI', 'Jl. Cisitu - Sangkuriang Bandung 40135', 'Telp : (022) 2503051 Fax : (022) 2503051', 'Tahoma', 'Tahoma', 'Tahoma', 14, 12, 12, 0, '000000', '000000', '000000', '', '', 0, '', 1, 'logokiri2.jpg', 0, '', '', '', 15, 15, 0, 0, '', '', '', '', '', '', '', '', 0, 0, 0, 0, '000000', '000000', '000000', '000000');

-- --------------------------------------------------------

-- 
-- Table structure for table `survey`
-- 

CREATE TABLE `survey` (
  `ID` char(10) NOT NULL,
  `JAWAB1` char(1) NOT NULL,
  `JAWAB2` char(1) NOT NULL,
  `JAWAB3` char(1) NOT NULL,
  `JAWAB4` char(1) NOT NULL,
  `JAWAB5` char(1) NOT NULL,
  `JAWAB6` char(1) NOT NULL,
  `CATATAN` mediumtext NOT NULL,
  `NAMA` tinytext NOT NULL,
  `PERUSAHAAN` tinytext NOT NULL,
  `UPDATER` varchar(20) NOT NULL,
  `LASTUPDATE` datetime NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `survey`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `toko`
-- 

CREATE TABLE `toko` (
  `ID` varchar(10) NOT NULL,
  `NAMA` varchar(50) default NULL,
  `KONTAK` varchar(50) default NULL,
  `TELEPON` varchar(20) default NULL,
  `ALAMAT` tinytext,
  `NPWP` varchar(50) default NULL,
  `JANGKABAYAR` int(10) unsigned NOT NULL default '0',
  `LIMITKREDIT` double(15,2) default NULL,
  `PASSWORD` varchar(100) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `toko`
-- 

INSERT INTO `toko` VALUES ('0', 'Contoh Klien', '', '', '', '', 365, NULL, '');
INSERT INTO `toko` VALUES ('KIMLIPI', 'PP KIMIA LIPI', 'Tiny', '0220242402402', 'Cisitu Sangkuriang', '', 0, 0.00, '');
INSERT INTO `toko` VALUES ('biofarma', 'biofarma', 'ade', '0222503051', 'pasteur', '', 0, 0.00, '04f8752b9a2d86c478101ebbbebf45c0');

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `ID` varchar(10) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) default NULL,
  `TINGKAT` varchar(10) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` VALUES ('superadmin', 'Administrator', 'ac43724f16e9241d990427ab7c8f4228', 'A');
INSERT INTO `user` VALUES ('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'B');
INSERT INTO `user` VALUES ('mt', 'mt', '710998fd1b7c0235170265650770a4b1', 'C');
INSERT INTO `user` VALUES ('supervisor', 'supervisor', '09348c20a019be0318387c08df7a783d', 'D');
INSERT INTO `user` VALUES ('analis', 'analis', '6f7cf810b9252805f195bcf981156af6', 'E');
INSERT INTO `user` VALUES ('001', 'robby', '8d05dd2f03981f86b56c23951f3f34d7', 'B');
INSERT INTO `user` VALUES ('0010', 'test', '098f6bcd4621d373cade4e832627b4f6', 'C');

-- --------------------------------------------------------

-- 
-- Table structure for table `varjenisuji`
-- 

CREATE TABLE `varjenisuji` (
  `IDJENISUJI` int(10) unsigned NOT NULL default '0',
  `VAR` varchar(5) NOT NULL,
  `NAMA` tinytext,
  `MANUAL` smallint(5) unsigned NOT NULL default '0',
  `RUMUS` tinytext,
  `KONSTANTA` tinytext,
  PRIMARY KEY  (`IDJENISUJI`,`VAR`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `varjenisuji`
-- 

INSERT INTO `varjenisuji` VALUES (31, 'A', 'H2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (33, 'A', '% Vol N2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (32, 'A', '% H2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (34, 'A', 'ppm N2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (35, 'A', '% Vol CO2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (36, 'A', '% Mol CO2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (37, 'A', 'ppm CO2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (38, 'A', '% Vol Ar', 1, '', '');
INSERT INTO `varjenisuji` VALUES (39, 'A', '% Mol Ar', 1, '', '');
INSERT INTO `varjenisuji` VALUES (40, 'A', '% Vol CH4', 1, '', '');
INSERT INTO `varjenisuji` VALUES (41, 'A', '% Mol CH4', 1, '', '');
INSERT INTO `varjenisuji` VALUES (42, 'A', 'ppm CH4', 1, '', '');
INSERT INTO `varjenisuji` VALUES (43, 'A', '%Vol NH3', 1, '', '');
INSERT INTO `varjenisuji` VALUES (44, 'A', 'ppm NH3', 1, '', '');
INSERT INTO `varjenisuji` VALUES (45, 'A', '%Weight NH3', 1, '', '');
INSERT INTO `varjenisuji` VALUES (46, 'A', 'Ratio', 1, '', '');
INSERT INTO `varjenisuji` VALUES (47, 'A', '%Mol C2H6', 1, '', '');
INSERT INTO `varjenisuji` VALUES (48, 'A', '%Mol C3H8', 1, '', '');
INSERT INTO `varjenisuji` VALUES (49, 'A', '%Mol i-C4H10', 1, '', '');
INSERT INTO `varjenisuji` VALUES (50, 'A', '%Mol n-C4H10', 1, '', '');
INSERT INTO `varjenisuji` VALUES (51, 'A', '%Mol n-C5H12', 1, '', '');
INSERT INTO `varjenisuji` VALUES (52, 'A', '%Mol C6H14 plus', 1, '', '');
INSERT INTO `varjenisuji` VALUES (53, 'A', 'ppm H2S', 1, '', '');
INSERT INTO `varjenisuji` VALUES (54, 'A', 'Sp. Gr.', 1, '', '');
INSERT INTO `varjenisuji` VALUES (55, 'A', 'GHV', 1, '', '');
INSERT INTO `varjenisuji` VALUES (56, 'A', 'LHV.', 1, '', '');
INSERT INTO `varjenisuji` VALUES (57, 'A', 'Kcal/Nm3', 1, '', '');
INSERT INTO `varjenisuji` VALUES (58, 'A', 'MW', 1, '', '');
INSERT INTO `varjenisuji` VALUES (59, 'A', 'CARBON NOMBER', 1, '', '');
INSERT INTO `varjenisuji` VALUES (60, 'A', 'LEL', 1, '', '');
INSERT INTO `varjenisuji` VALUES (61, 'A', 'PH', 1, '', '');
INSERT INTO `varjenisuji` VALUES (62, 'A', 'Foaming Vol.', 1, '', '');
INSERT INTO `varjenisuji` VALUES (63, 'A', 'Collaps Time', 1, '', '');
INSERT INTO `varjenisuji` VALUES (64, 'A', 'Density', 1, '', '');
INSERT INTO `varjenisuji` VALUES (65, 'A', 'Fe total', 1, '', '');
INSERT INTO `varjenisuji` VALUES (66, 'A', 'MDEA', 1, '', '');
INSERT INTO `varjenisuji` VALUES (67, 'A', 'Piperazine', 1, '', '');
INSERT INTO `varjenisuji` VALUES (68, 'A', 'Total Amine', 1, '', '');
INSERT INTO `varjenisuji` VALUES (69, 'A', 'CO2 Loading', 1, '', '');
INSERT INTO `varjenisuji` VALUES (70, 'A', '%Vol O2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (71, 'A', 'ppm NO', 1, '', '');
INSERT INTO `varjenisuji` VALUES (72, 'A', 'ppm NO2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (73, 'A', 'ppm NOx', 1, '', '');
INSERT INTO `varjenisuji` VALUES (74, 'A', 'ppm SO2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (75, 'A', '%Vol O2 Analyzer', 1, '', '');
INSERT INTO `varjenisuji` VALUES (76, 'A', '%Wt H20', 1, '', '');
INSERT INTO `varjenisuji` VALUES (77, 'A', 'ppm Oil Content', 1, '', '');
INSERT INTO `varjenisuji` VALUES (78, 'A', 'ppm Cl -', 1, '', '');
INSERT INTO `varjenisuji` VALUES (79, 'A', 'PH', 1, '', '');
INSERT INTO `varjenisuji` VALUES (80, 'A', 'Conductivity', 1, '', '');
INSERT INTO `varjenisuji` VALUES (81, 'A', 'ppm Fe total', 1, '', '');
INSERT INTO `varjenisuji` VALUES (82, 'A', 'ppm Cu', 1, '', '');
INSERT INTO `varjenisuji` VALUES (83, 'A', 'ppm Na', 1, '', '');
INSERT INTO `varjenisuji` VALUES (84, 'A', 'ppm SiO2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (85, 'A', 'ppm Cl-', 1, '', '');
INSERT INTO `varjenisuji` VALUES (86, 'A', 'ppm NH4+', 1, '', '');
INSERT INTO `varjenisuji` VALUES (87, 'A', 'ppm TDS', 1, '', '');
INSERT INTO `varjenisuji` VALUES (88, 'A', 'ppm PO4(3-)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (89, 'A', 'Cond. Analyzer', 1, '', '');
INSERT INTO `varjenisuji` VALUES (90, 'A', 'ppb Elimin-Ox', 1, '', '');
INSERT INTO `varjenisuji` VALUES (91, 'A', 'ppm Fe total', 1, '', '');
INSERT INTO `varjenisuji` VALUES (92, 'A', 'ppm PO4', 1, '', '');
INSERT INTO `varjenisuji` VALUES (93, 'A', 'ppb DO', 1, '', '');
INSERT INTO `varjenisuji` VALUES (94, 'A', 'Turbidity', 1, '', '');
INSERT INTO `varjenisuji` VALUES (95, 'A', 'ppm NH3', 1, '', '');
INSERT INTO `varjenisuji` VALUES (96, 'A', 'ppm Cl2 free', 1, '', '');
INSERT INTO `varjenisuji` VALUES (97, 'A', 'ppm Cl2 total', 1, '', '');
INSERT INTO `varjenisuji` VALUES (98, 'A', 'ppm Residual PO4', 1, '', '');
INSERT INTO `varjenisuji` VALUES (99, 'A', 'DP (&amp;amp;ordm;C)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (100, 'A', 'ppm H2O', 1, '', '');
INSERT INTO `varjenisuji` VALUES (101, 'A', 'ppm O2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (102, 'A', '%Vol N2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (103, 'A', 'ppm CH4', 1, '', '');
INSERT INTO `varjenisuji` VALUES (104, 'A', 'ppm CO', 1, '', '');
INSERT INTO `varjenisuji` VALUES (105, 'A', 'ppm CO2', 1, '', '');
INSERT INTO `varjenisuji` VALUES (106, 'A', 'ppm O2 Analyzer', 1, '', '');
INSERT INTO `varjenisuji` VALUES (107, 'A', 'ppm Salinity', 1, '', '');
INSERT INTO `varjenisuji` VALUES (108, 'A', 'ppm p-Alk', 1, '', '');
INSERT INTO `varjenisuji` VALUES (109, 'A', 'ppm M-Alk', 1, '', '');
INSERT INTO `varjenisuji` VALUES (110, 'A', 'ppm Ca Hardness', 1, '', '');
INSERT INTO `varjenisuji` VALUES (111, 'A', 'ppm Mg Hardness', 1, '', '');
INSERT INTO `varjenisuji` VALUES (112, 'A', 'ppm Tot.Hardness', 1, '', '');
INSERT INTO `varjenisuji` VALUES (113, 'A', 'Temperature (&amp;amp;ordm;C)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (114, 'A', 'ppm TSS', 1, '', '');
INSERT INTO `varjenisuji` VALUES (115, 'A', 'ppm NH3 - N', 1, '', '');
INSERT INTO `varjenisuji` VALUES (116, 'A', 'ppm Oil Content', 1, '', '');
INSERT INTO `varjenisuji` VALUES (117, 'A', 'ppm COD', 1, '', '');
INSERT INTO `varjenisuji` VALUES (118, 'A', 'ppm BOD5', 1, '', '');
INSERT INTO `varjenisuji` VALUES (31, 'B', '', 1, '', '');
INSERT INTO `varjenisuji` VALUES (31, 'C', '', 1, '', '');
INSERT INTO `varjenisuji` VALUES (119, 'A', 'Bau', 1, '', '');
INSERT INTO `varjenisuji` VALUES (120, 'A', 'Berat wadah kosong', 1, '', '');
INSERT INTO `varjenisuji` VALUES (120, 'B', 'Berat wadah + contoh', 1, '', '');
INSERT INTO `varjenisuji` VALUES (120, 'C', 'Berat setelah pemanasan', 1, '', '');
INSERT INTO `varjenisuji` VALUES (121, 'A', 'Vol. Pelarut Hasil Destilasi (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (121, 'B', 'HCL (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (121, 'C', 'N HCL', 1, '', '');
INSERT INTO `varjenisuji` VALUES (121, 'D', 'Vol. Pelarut yang dipipet (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (121, 'E', 'Berat contoh (mg)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (121, 'F', 'Faktor Konversi', 1, '', '');
INSERT INTO `varjenisuji` VALUES (122, 'A', 'Berat Wadah (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (122, 'B', 'Berat Wadah + Contoh (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (122, 'C', 'Berat Labu Kosong (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (122, 'D', 'Berat Labu Kosong + Lemak (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (123, 'A', 'Berat Cawan Kosong (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (123, 'B', 'Berat Cawan + Contoh (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (123, 'C', 'Berat Cawan + Contoh setelah pemanasan (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (124, 'A', 'Berat Contoh (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (124, 'B', 'Berat Cawan Kosong 110oC (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (124, 'C', 'Berat Kertas Saring (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (124, 'D', 'Berat Cawan + kertas Saring + Residu 110oC (g)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (124, 'E', 'Berat Asbes', 1, '', '');
INSERT INTO `varjenisuji` VALUES (125, 'vPl', 'Vol Pelarutan Contoh (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (125, 'vBl', 'Vol Na2S2O3 u blanko (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (125, 'vSp', 'Vol Na2S2O3 u sampel (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (125, 'h', 'Bl-Sp Selisih Vol penitrasi Na2S2O3 u/ sampel (mL)', 2, '', 'vBl-vSp');
INSERT INTO `varjenisuji` VALUES (125, 'f', 'Faktor Normalitas Na2S2O3', 1, '', '');
INSERT INTO `varjenisuji` VALUES (125, 'fh', 'f x h', 2, '', 'f*h');
INSERT INTO `varjenisuji` VALUES (125, 'a', 'Pembacaan tepung dari Tabel', 1, '', '13');
INSERT INTO `varjenisuji` VALUES (125, 'b', 'Vol yg direaksikan dgn Luff Schoorl', 1, '', '');
INSERT INTO `varjenisuji` VALUES (125, 'c', 'Berat contoh yg ditimbang (mg)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (125, 'd', 'Faktor pengenceran', 1, '', '');
INSERT INTO `varjenisuji` VALUES (126, 'a', 'Hasil pembacaan tepung dari tabel (mg)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (126, 'b', 'Vol yg direaksikan dgn Luff Schoorl', 1, '', '');
INSERT INTO `varjenisuji` VALUES (126, 'c', 'Berat contoh yang ditimbang (mg)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (126, 'd', 'Faktor Pengenceran', 1, '', '');
INSERT INTO `varjenisuji` VALUES (126, 'f', 'Faktor Normalitas Na2S2O3', 1, '', '');
INSERT INTO `varjenisuji` VALUES (126, 'fh', 'f x h Na2S2O3 0.1 N', 2, '', 'f*h');
INSERT INTO `varjenisuji` VALUES (126, 'h', 'Bl-Sp Selisih Vol penitrasi Na2S2O3 u/ sampel  (mL)', 2, '', 'vBl-vSp');
INSERT INTO `varjenisuji` VALUES (126, 'vPl', 'Vol Pelarutan Contoh (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (126, 'vBl', 'Vol Na2S2O3 u blanko (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (126, 'vSp', 'Vol Na2S2O3 u sampel (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (127, 'a', 'Hasil pembacaan tepung dari tabel (mg)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (127, 'b', 'Vol. yang direaksikan dgn Luff Schoorl', 1, '', '');
INSERT INTO `varjenisuji` VALUES (127, 'c', 'Berat contoh yang ditimbang (mg)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (127, 'd', 'Faktor Pengenceran', 2, '', 'e/f');
INSERT INTO `varjenisuji` VALUES (127, 'e', 'Volume Pelarutan Contoh (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (127, 'f', 'Volume Larutan yg diambil u/ inversi (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (127, 'Fh', 'fxh Na2S2O3 0.1 N (mL)', 2, '', 'f*h');
INSERT INTO `varjenisuji` VALUES (127, 'vPl', 'Vol Pelarutan Hasil Inversi (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (127, 'vBl', 'Vol Na2S2O3 u blanko (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (127, 'vSp', 'Vol Na2S2O3 u sampel (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (127, 'h', 'Bl - SP Selisih Vol penitrasi Na2S2O3 u/ sampel  (mL)', 2, '', 'vBl-vSp');
INSERT INTO `varjenisuji` VALUES (128, 'A', 'Volume pelarutan contoh (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (128, 'B', 'Banyaknya contoh yang dititrasi (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (128, 'C', 'Volume larutan penitrasi AgNO3 (mL)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (128, 'D', 'Normalitas Penitrasi', 1, '', '');
INSERT INTO `varjenisuji` VALUES (128, 'E', 'Berat setara C (mg)', 1, '', '');
INSERT INTO `varjenisuji` VALUES (128, 'F', 'Berat contoh (mg)', 1, '', '');
