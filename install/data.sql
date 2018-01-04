-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 03, 2012 at 04:20 PM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `iso17025`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `bahankimia`
-- 

CREATE TABLE `bahankimia` (
  `IDBAHAN` varchar(10) character set latin1 collate latin1_general_ci NOT NULL,
  `NAMABAHAN` varchar(50) default NULL,
  `NAMAKIMIA` varchar(50) default NULL,
  `KATALOG` varchar(100) default NULL,
  `JUMLAH` int(25) NOT NULL,
  `SATUAN` varchar(50) default NULL,
  `JUMLAHMIN` int(11) default NULL,
  `CATATAN` text,
  `FILEG` text,
  PRIMARY KEY  (`IDBAHAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `bahankimia`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `biaya`
-- 

CREATE TABLE `biaya` (
  `ID` int(10) unsigned NOT NULL,
  `NILAI` float(12,2) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `biaya`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `filehasilanalis`
-- 

CREATE TABLE `filehasilanalis` (
  `ID` varchar(10) collate latin1_general_ci NOT NULL,
  `IDTRANS` varchar(10) collate latin1_general_ci NOT NULL,
  `FILEANALIS` longblob NOT NULL,
  `NAMAFILEANALIS` tinytext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`,`IDTRANS`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `filehasilanalis`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `filesupervisor`
-- 

CREATE TABLE `filesupervisor` (
  `ID` varchar(10) collate latin1_general_ci NOT NULL,
  `IDTRANS` varchar(10) collate latin1_general_ci NOT NULL,
  `FILESUPERVISOR` longblob NOT NULL,
  `NAMAFILESUPERVISOR` tinytext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`,`IDTRANS`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `filesupervisor`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ik`
-- 

CREATE TABLE `ik` (
  `ID` varchar(20) collate latin1_general_ci NOT NULL default '',
  `NAMA` tinytext collate latin1_general_ci,
  `FILE` tinytext collate latin1_general_ci,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `ik`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jenistrans`
-- 

CREATE TABLE `jenistrans` (
  `IDTRANS` int(10) NOT NULL auto_increment,
  `NAMA` varchar(25) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`IDTRANS`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `jenistrans`
-- 

INSERT INTO `jenistrans` VALUES (1, 'Transaksi Keluar');
INSERT INTO `jenistrans` VALUES (2, 'Transaksi Masuk');

-- --------------------------------------------------------

-- 
-- Table structure for table `jenisuji`
-- 

CREATE TABLE `jenisuji` (
  `ID` int(10) unsigned NOT NULL default '31',
  `NAMA` tinytext collate latin1_general_ci,
  `NAMA2` tinytext collate latin1_general_ci,
  `JMLVAR` int(10) unsigned NOT NULL default '0',
  `RUMUS` tinytext collate latin1_general_ci,
  `HASIL` tinytext collate latin1_general_ci,
  `SATUAN` tinytext collate latin1_general_ci,
  `IDKELOMPOK` char(5) collate latin1_general_ci NOT NULL default '0',
  `RM` tinytext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `jenisuji`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `kelompokjenisuji`
-- 

CREATE TABLE `kelompokjenisuji` (
  `ID` char(5) collate latin1_general_ci NOT NULL,
  `NAMA` varchar(200) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `kelompokjenisuji`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `logdokumen`
-- 

CREATE TABLE `logdokumen` (
  `ID` int(11) NOT NULL auto_increment,
  `JENISDOKUMEN` text collate latin1_general_ci NOT NULL,
  `NAMA` tinytext collate latin1_general_ci NOT NULL,
  `PEGAWAI` varchar(100) collate latin1_general_ci NOT NULL,
  `WAKTU` datetime NOT NULL,
  `ASAL` varchar(100) collate latin1_general_ci NOT NULL,
  `JENISLOG` varchar(100) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=78 ;

-- 
-- Dumping data for table `logdokumen`
-- 

INSERT INTO `logdokumen` VALUES (1, 'Tambah Bahan Kimia. ID=6, Nama=1, Kimia=, Katalog= ,File=template_main.jpg', 'INSERT INTO bahankimia VALUES(''6'', '''', '''', ''1'', '''', '''', '''', ''kg'', '''', '''', ''6template_main.jpg'')', 'mt', '2012-09-21 16:39:16', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (2, 'Tambah Bahan Kimia. ID=2, Nama=1, Kimia=, Katalog= ,File=template_main.jpg', 'INSERT INTO bahankimia VALUES(''2'', '''', '''', ''1'', '''', '''', '''', ''kg'', '''', '''', ''2template_main.jpg'')', 'mt', '2012-09-21 16:39:58', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (3, 'Tambah IK. ID=12, Nama=nama instruksi kerja, File=', 'INSERT INTO ik VALUES(''12'',''nama instruksi kerja'',''12'')', 'mt', '2012-09-21 16:41:37', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (4, 'Tambah Bahan Kimia. ID=5, Nama=1, Kimia=, Katalog= ,File=', 'INSERT INTO bahankimia VALUES(''5'', '''', '''', ''1'', '''', '''', '''', ''g'', '''', '''', ''5'')', 'mt', '2012-09-21 16:42:36', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (5, 'Tambah Bahan Kimia. ID=9, Nama=re, Kimia=, Katalog= ,File=', 'INSERT INTO bahankimia VALUES(''9'', '''', '''', ''re'', '''', '''', '''', ''g'', '''', '''', ''9'')', 'mt', '2012-09-21 16:51:52', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (6, 'Tambah Bahan Kimia. ID=7, Nama=qwe, Kimia=asd, Katalog=katalog ,File=', 'INSERT INTO bahankimia(IDBAHAN,IDMEREK,IDJENIS,NAMABAHAN,NAMAKIMIA,KATALOG,JUMLAH,KEMASAN,JUMLAHMIN,CATATAN,FILEG) VALUES (\r\n''7'', NULL , NULL ,  ''qwe'',  ''asd'',  ''katalog'',  ''123'', ''g'', ''1'', NULL , ''7'')', 'mt', '2012-09-21 17:23:26', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (7, 'Tambah Bahan Kimia. ID=6, Nama=bhn, Kimia=kim, Katalog=log ,File=template_main.jpg', 'INSERT INTO bahankimia(IDBAHAN,IDMEREK,IDJENIS,NAMABAHAN,NAMAKIMIA,KATALOG,JUMLAH,KEMASAN,JUMLAHMIN,CATATAN,FILEG) VALUES (\r\n''6'', NULL , NULL ,  ''bhn'',  ''kim'',  ''log'',  ''98'', ''g'', ''1'', NULL , ''6template_main.jpg'')', 'mt', '2012-09-21 17:25:30', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (8, 'Hapus Data Bahan. ID=7, File=7', 'DELETE FROM bahankimia WHERE IDBAHAN=''7''', 'mt', '2012-09-25 14:47:36', '127.0.0.1', 'Hapus Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (9, 'Update Data Bahan Kimia. ID=4, Nama=nama, File=', 'UPDATE bahankimia SET 			idbahan=''4'',\r\n											idmerek='''',\r\n											idjenis='''',\r\n											namabahan=''nama'',\r\n											namakimia=''kimia'',\r\n											katalog=''katalog'',\r\n											jumlah=''2.00'',\r\n											kemasan=''kg'',\r\n											jumlahmin=''''', 'mt', '2012-09-25 15:20:58', '127.0.0.1', 'Update Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (10, 'Update Data Bahan Kimia. ID=5, Nama=qwe, File=', 'UPDATE bahankimia SET 			idbahan=''5'',\r\n											idmerek='''',\r\n											idjenis='''',\r\n											namabahan=''qwe'',\r\n											namakimia=''asd'',\r\n											katalog=''katalog'',\r\n											jumlah=''123.00'',\r\n											kemasan=''g'',\r\n											jumlahmin='''',\r', 'mt', '2012-09-25 15:21:50', '127.0.0.1', 'Update Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (11, 'Hapus Data Bahan. ID=4, File=', 'DELETE FROM bahankimia WHERE IDBAHAN=''4''', 'mt', '2012-09-25 15:22:04', '127.0.0.1', 'Hapus Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (12, 'Update Data Bahan Kimia. ID=3, Nama=nama, File=', 'UPDATE bahankimia SET 			idbahan=''3'',\r\n											idmerek='''',\r\n											idjenis='''',\r\n											namabahan=''nama'',\r\n											namakimia=''kimia'',\r\n											katalog=''kat'',\r\n											jumlah=''9.00'',\r\n											kemasan=''bungkus'',\r\n											jumlahmin=''', 'mt', '2012-09-25 15:22:53', '127.0.0.1', 'Update Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (13, 'Tambah permintaan. ID=000001, Klien=0, Sampel=air', 'INSERT INTO minta \r\n 			(ID,IDKLIEN,TANGGALDATANG,TANGGALDEADLINE,STATUS,\r\n 			IDUSER,IDMAN,TGLUPDATE,UPDATER,CONTOH,NOMER1,NOMER2)\r\n 			VALUES(''000001'',''0'',''2012-9-26'',''2012-9-30'',\r\n			''3'',''admin'',''mt'',NOW(),''admin'',''air'',''123'',''456'')', 'admin', '2012-09-26 21:42:08', '127.0.0.1', 'Tambah Permintaan');
INSERT INTO `logdokumen` VALUES (14, 'Tambah Jenis Uji Permintaan. ID Jenis Uji=000001, ID Permintaan=000001, Jenis Analisis=Kadar Abu', 'INSERT INTO permintaan \r\n        		(ID,IDTRANS,JENISANALISIS,STATUS,SAMPEL,CATATAN,TGLUPDATE,UPDATER,HISTORY,NILAIBAKU,DUPLO,BIAYA)\r\n        		VALUES\r\n        		(''000001'',''000001'',''123'',''0'','''',''sgr'',NOW(),''admin'',\r\n        		CONCAT(IF(HISTORY IS NULL,'''',H', 'admin', '2012-09-26 21:42:47', '127.0.0.1', 'Tambah Jenis Uji Permintaan');
INSERT INTO `logdokumen` VALUES (15, 'Periksa Hasil Analisis Jenis Uji Permintaan. \r\n      Kode Permintaan: 000001, Kode Jenis Uji: 000001', 'UPDATE permintaan \r\n			SET \r\n			ID2=''1993850631'',\r\n			STATUS=''1'',FILE=''000001'',\r\n			IDSUP=''supervisor'',\r\n			TGLTERIMAMAN=''2012-9-26'',\r\n			CATATANM='''',\r\n			IDIK='''',\r\n 			TGLUPDATE=NOW(),\r\n			UPDATER=''mt'',\r\n			HISTORY=CONCAT(IF(HISTORY IS NULL,'''',HISTORY),C', 'mt', '2012-09-26 21:46:05', '127.0.0.1', 'MT: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (16, 'Periksa Hasil Analisis Jenis Uji Permintaan. Kode Permintaan: 1993850631', 'UPDATE permintaan \r\n			SET \r\n			STATUS=''2'',TGLTERIMASUP=NOW(),FILE=''1993850631'',\r\n			IDAN=''analis'',\r\n			IDIK='''',\r\n			TGLTERIMASUP=''2012-9-26'',\r\n			CATATANS='''',\r\n 			TGLUPDATE=NOW(),\r\n			UPDATER=''supervisor'',\r\n			HISTORY=CONCAT(IF(HISTORY IS NULL,'''',HISTOR', 'supervisor', '2012-09-26 21:46:38', '127.0.0.1', 'Supervisor: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (17, 'Periksa Hasil Analisis Jenis Uji Permintaan. Kode Permintaan: 1993850631', 'UPDATE permintaan \r\n			SET \r\n			STATUS=''4'',TGLTERIMAAN=NOW(),\r\n 			 DATA='' A=10.02;B=20;C=11;'',\r\n 			\r\n  			CATATANA='''',\r\n 			TGLTERIMAAN=''2012-9-26'',\r\n			METODE='''',\r\n 			TGLUPDATE=NOW(),\r\n			UPDATER=''analis'',\r\n			HISTORY=CONCAT(IF(HISTORY IS NULL,'''',HIST', 'analis', '2012-09-26 21:47:21', '127.0.0.1', 'Analis: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (18, 'Periksa Hasil Analisis Jenis Uji Permintaan. Kode Permintaan: 1993850631', 'UPDATE permintaan \r\n			SET \r\n			FILE=''1993850631'',\r\n			IDAN=''analis'',\r\n			IDIK='''',\r\n			TGLTERIMASUP=''2012-9-26'',\r\n			CATATANS='''',\r\n 			TGLUPDATE=NOW(),\r\n			UPDATER=''supervisor'',\r\n			HISTORY=CONCAT(IF(HISTORY IS NULL,'''',HISTORY),CONCAT(NOW(),'' Diupdate ole', 'supervisor', '2012-09-26 21:48:16', '127.0.0.1', 'Supervisor: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (19, 'Periksa Hasil Analisis Jenis Uji Permintaan. Kode Permintaan: 1993850631', 'UPDATE permintaan \r\n			SET \r\n			STATUS=''5'',FILE=''1993850631'',\r\n			IDAN=''analis'',\r\n			IDIK='''',\r\n			TGLTERIMASUP=''2012-9-26'',\r\n			CATATANS='''',\r\n 			TGLUPDATE=NOW(),\r\n			UPDATER=''supervisor'',\r\n			HISTORY=CONCAT(IF(HISTORY IS NULL,'''',HISTORY),CONCAT(NOW(),'' D', 'supervisor', '2012-09-26 21:48:38', '127.0.0.1', 'Supervisor: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (20, 'Periksa Hasil Analisis Jenis Uji Permintaan. \r\n      Kode Permintaan: 000001, Kode Jenis Uji: 000001', 'UPDATE permintaan \r\n			SET \r\n			ID2=''1993850631'',\r\n			STATUS=''7'',FILE=''000001'',\r\n			IDSUP=''supervisor'',\r\n			TGLTERIMAMAN=''2012-9-26'',\r\n			CATATANM='''',\r\n			IDIK='''',\r\n 			TGLUPDATE=NOW(),\r\n			UPDATER=''mt'',\r\n			HISTORY=CONCAT(IF(HISTORY IS NULL,'''',HISTORY),C', 'mt', '2012-09-26 21:49:12', '127.0.0.1', 'MT: Update Data/Status Permintaan');
INSERT INTO `logdokumen` VALUES (21, 'Buat Laporan. Kode Permintaan: 000001,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000001''  \r\n  ORDER BY ID', 'admin', '2012-09-26 21:49:52', '127.0.0.1', 'Buat Laporan');
INSERT INTO `logdokumen` VALUES (22, 'Buat Laporan. Kode Permintaan: 000001,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000001''  \r\n  ORDER BY ID', 'admin', '2012-09-26 21:50:57', '127.0.0.1', 'Buat Laporan');
INSERT INTO `logdokumen` VALUES (23, 'Buat Laporan. Kode Permintaan: 000001,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000001''  \r\n  ORDER BY ID', 'admin', '2012-09-26 21:51:14', '127.0.0.1', 'Buat Laporan');
INSERT INTO `logdokumen` VALUES (24, 'Buat Laporan. Kode Permintaan: 000001,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000001''  \r\n  ORDER BY ID', 'admin', '2012-09-26 21:51:26', '127.0.0.1', 'Buat Laporan');
INSERT INTO `logdokumen` VALUES (25, 'Tambah Bahan Kimia. ID=, Nama=6', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''1234-09-12'', '''')', 'mt', '2012-09-30 21:00:49', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (26, 'Tambah Bahan Kimia. ID=, Nama=6', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''1234-09-12'', '''')', 'mt', '2012-09-30 21:01:30', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (27, 'Tambah Bahan Kimia. ID=, Nama=2', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''1234-12-21'', '''')', 'mt', '2012-09-30 21:01:42', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (28, 'Tambah Bahan Kimia. ID=, Nama=2', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''1234-12-21'', '''')', 'mt', '2012-09-30 21:03:10', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (29, 'Tambah Bahan Kimia. ID=, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''65'', '''')', 'mt', '2012-09-30 21:03:25', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (30, 'Tambah Bahan Kimia. ID=, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''12'', '''')', 'mt', '2012-09-30 21:04:34', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (31, 'Tambah Bahan Kimia. ID=, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''12'', ''12-04-2005'')', 'mt', '2012-09-30 21:06:06', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (32, 'Tambah Bahan Kimia. ID=, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''12'', ''2005-09-02'')', 'mt', '2012-09-30 21:06:25', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (33, 'Tambah Bahan Kimia. ID=, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''12'', ''2005-09-02'')', 'mt', '2012-09-30 21:07:02', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (34, 'Tambah Bahan Kimia. ID=, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''12'', ''2005-09-02'')', 'mt', '2012-09-30 21:08:25', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (35, 'Tambah Bahan Kimia. ID=, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', '''', ''12'', ''2005-09-02'')', 'mt', '2012-09-30 21:08:28', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (36, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''12'', ''2005-09-02'')', 'mt', '2012-09-30 21:09:38', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (37, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''12'', ''2005-09-02'')', 'mt', '2012-09-30 21:11:06', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (38, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''12'', ''2005-09-02'')', 'mt', '2012-09-30 21:11:17', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (39, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''12'', ''2005-09-02'')', 'mt', '2012-09-30 21:11:59', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (40, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''1'', ''2005-09-02'')', 'mt', '2012-09-30 21:14:05', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (41, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''1'', ''2005-09-02'')', 'mt', '2012-09-30 21:35:58', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (42, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''1'', ''2005-09-02'')', 'mt', '2012-09-30 21:41:33', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (43, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''1'', ''2005-09-02'')', 'mt', '2012-09-30 21:44:47', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (44, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''1'', ''2005-09-02'')', 'mt', '2012-09-30 21:46:03', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (45, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''1'', ''2005-09-02'')', 'mt', '2012-09-30 21:46:18', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (46, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''13'', ''2005-09-02'')', 'mt', '2012-09-30 21:48:04', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (47, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''10'', ''2005-09-02'')', 'mt', '2012-09-30 22:05:44', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (48, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''10'', ''2005-09-02'')', 'mt', '2012-09-30 22:08:28', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (49, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''10'', ''2005-09-02'')', 'mt', '2012-09-30 22:08:53', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (50, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''10'', ''2005-09-02'')', 'mt', '2012-09-30 22:09:38', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (51, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', 2, ''8'', ''12-04-2005'')', 'mt', '2012-09-30 22:40:23', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (52, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', 2, ''8'', ''12-04-2005'')', 'mt', '2012-09-30 22:40:33', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (53, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''1'', ''10'', ''2012-10-01'')', 'mt', '2012-10-01 03:19:00', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (54, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''1'', ''10'', ''2012-10-01'')', 'mt', '2012-10-01 03:19:24', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (55, 'Tambah Bahan Kimia. ID=6, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''6'', ''1'', ''10'', ''2012-10-01'')', 'mt', '2012-10-01 03:19:35', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (56, 'Tambah Bahan Kimia. ID=4, Nama=hehee, Kimia=co2, Katalog=katalog ,File=', 'INSERT INTO bahankimia(IDBAHAN,NAMABAHAN,NAMAKIMIA,KATALOG,SATUAN,JUMLAHMIN,CATATAN,FILEG) VALUES (''4'', ''hehee'', ''co2'', ''katalog'', ''kg'', ''1'', NULL , ''4'')', 'mt', '2012-10-01 03:21:10', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (57, 'Update Data Bahan Kimia. ID=6, Nama=bhn, File=', 'UPDATE bahankimia SET 			idbahan=''6'',\r\n											namabahan=''bhn'',\r\n											namakimia=''kim'',\r\n											katalog=''log'',\r\n											jumlah=''100'',\r\n											satuan=''g'',\r\n											jumlahmin='''',\r\n											catatan='''',\r\n											fileg=''''\r\n										', 'mt', '2012-10-01 04:00:15', '127.0.0.1', 'Update Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (58, 'Hapus Data Bahan. ID=6, File=', 'DELETE FROM bahankimia WHERE IDBAHAN=''6''', 'mt', '2012-10-01 04:00:36', '127.0.0.1', 'Hapus Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (59, 'Tambah Bahan Kimia. ID=4, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''4'', ''1'', ''1'', '''')', 'mt', '2012-10-01 04:03:19', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (60, 'Tambah Bahan Kimia. ID=4, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''4'', ''1'', ''1000'', '''')', 'mt', '2012-10-01 04:15:45', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (61, 'Tambah permintaan. ID=000001, Klien=1, Sampel=Oksigen', 'INSERT INTO minta \r\n 			(ID,IDKLIEN,TANGGALDATANG,TANGGALDEADLINE,STATUS,\r\n 			IDUSER,IDMAN,TGLUPDATE,UPDATER,CONTOH,NOMER1,NOMER2)\r\n 			VALUES(''000001'',''1'',''2012-10-2'',''2012-10-2'',\r\n			''3'',''admin'',''mt'',NOW(),''admin'',''Oksigen'',''001'',''01'')', 'admin', '2012-10-02 11:21:45', '127.0.0.1', 'Tambah Permintaan');
INSERT INTO `logdokumen` VALUES (62, 'Tambah Jenis Uji Permintaan. ID Jenis Uji=000001, ID Permintaan=000001, Jenis Analisis=Penentuan Cu dgn AAS', 'INSERT INTO permintaan \r\n        		(ID,IDTRANS,JENISANALISIS,STATUS,SAMPEL,CATATAN,TGLUPDATE,UPDATER,HISTORY,NILAIBAKU,DUPLO,BIAYA)\r\n        		VALUES\r\n        		(''000001'',''000001'',''14'',''0'','''','''',NOW(),''admin'',\r\n        		CONCAT(IF(HISTORY IS NULL,'''',HISTO', 'admin', '2012-10-02 11:22:12', '127.0.0.1', 'Tambah Jenis Uji Permintaan');
INSERT INTO `logdokumen` VALUES (63, 'Update Jenis Uji Permintaan. ID Jenis Uji=000001, ID Permintaan=000001, Jenis Analisis=Penentuan Cu dgn AAS', 'Update permintaan \r\n		SET\r\n		JENISANALISIS=''14'',\r\n		\r\n		SAMPEL='''',\r\n		CATATAN='''',\r\n		DUPLO=''0'',\r\n		TGLUPDATE=NOW(),\r\n		UPDATER=''admin'',\r\n			HISTORY=CONCAT(IF(HISTORY IS NULL,'''',HISTORY),CONCAT(NOW(),'' Diupdate oleh Administrasi (admin/admin).  \n''))\r\n\r\n		W', 'admin', '2012-10-02 11:22:57', '127.0.0.1', 'Tambah Jenis Uji Permintaan');
INSERT INTO `logdokumen` VALUES (64, 'Buat Laporan. Kode Permintaan: 000001,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000001''  \r\n  ORDER BY ID', 'admin', '2012-10-02 11:27:02', '127.0.0.1', 'Buat Laporan');
INSERT INTO `logdokumen` VALUES (65, 'Buat Laporan. Kode Permintaan: 000001,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000001''  \r\n  ORDER BY ID', 'admin', '2012-10-02 11:31:15', '127.0.0.1', 'Buat Laporan');
INSERT INTO `logdokumen` VALUES (66, 'Buat Laporan. Kode Permintaan: 000001,', 'SELECT DUPLO,ID\r\n  FROM permintaan \r\n  WHERE IDTRANS=''000001''  \r\n  ORDER BY ID', 'admin', '2012-10-02 11:31:40', '127.0.0.1', 'Buat Laporan');
INSERT INTO `logdokumen` VALUES (67, 'Tambah Bahan Kimia. ID=1, Nama=Oksigen, Kimia=O2, Katalog=NP1 ,File=', 'INSERT INTO bahankimia(IDBAHAN,NAMABAHAN,NAMAKIMIA,KATALOG,SATUAN,JUMLAHMIN,CATATAN,FILEG) VALUES (''1'', ''Oksigen'', ''O2'', ''NP1'', ''kg'', ''1'', NULL , ''1'')', 'mt', '2012-10-03 08:39:26', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (68, 'Tambah Bahan Kimia. ID=1, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''1'', ''1'', ''100'', ''2012-10-03'')', 'mt', '2012-10-03 08:39:59', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (69, 'Tambah Bahan Kimia. ID=1, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''1'', ''1'', ''10'', '''')', 'mt', '2012-10-03 08:40:21', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (70, 'Tambah Bahan Kimia. ID=2, Nama=Air, Kimia=CO2, Katalog= ,File=', 'INSERT INTO bahankimia(IDBAHAN,NAMABAHAN,NAMAKIMIA,KATALOG,SATUAN,JUMLAHMIN,CATATAN,FILEG) VALUES (''2'', ''Air'', ''CO2'', '''', ''liter'', ''1'', NULL , ''2'')', 'mt', '2012-10-03 08:40:50', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (71, 'Tambah Bahan Kimia. ID=2, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''2'', ''1'', ''90'', '''')', 'mt', '2012-10-03 08:40:58', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (72, 'Tambah Bahan Kimia. ID=2, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''2'', ''1'', ''10'', '''')', 'mt', '2012-10-03 08:41:13', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (73, 'Tambah Bahan Kimia. ID=2, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''2'', ''1'', ''1'', '''')', 'mt', '2012-10-03 08:41:26', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (74, 'Hapus Data Bahan. ID=2, File=2', 'DELETE FROM bahankimia WHERE IDBAHAN=''2''', 'mt', '2012-10-03 08:59:56', '127.0.0.1', 'Hapus Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (75, 'Tambah Bahan Kimia. ID=A2, Nama=Air, Kimia=CO2, Katalog=KAT2 ,File=Chrysanthemum.jpg', 'INSERT INTO bahankimia(IDBAHAN,NAMABAHAN,NAMAKIMIA,KATALOG,SATUAN,JUMLAHMIN,CATATAN,FILEG) VALUES (''A2'', ''Air'', ''CO2'', ''KAT2'', ''liter'', ''1'', NULL , ''A2Chrysanthemum.jpg'')', 'mt', '2012-10-03 11:38:16', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (76, 'Tambah Bahan Kimia. ID=A2, Nama=', 'INSERT INTO transaksi VALUES (''NULL'', ''A2'', ''1'', ''2'', ''2012-10-03'')', 'mt', '2012-10-03 11:38:30', '127.0.0.1', 'Tambah Instruksi Kerja');
INSERT INTO `logdokumen` VALUES (77, 'Hapus Data Bahan. ID=2, File=A2Chrysanthemum.jpg', 'DELETE FROM bahankimia WHERE IDBAHAN=''2''', 'mt', '2012-10-03 15:19:43', '127.0.0.1', 'Hapus Instruksi Kerja');

-- --------------------------------------------------------

-- 
-- Table structure for table `minta`
-- 

CREATE TABLE `minta` (
  `ID` varchar(10) collate latin1_general_ci NOT NULL,
  `IDKLIEN` varchar(10) collate latin1_general_ci NOT NULL default '',
  `TANGGALDATANG` date default NULL,
  `TANGGALDEADLINE` date default NULL,
  `TANGGALSELESAI` date default NULL,
  `STATUS` smallint(5) unsigned NOT NULL default '0',
  `IDUSER` varchar(10) collate latin1_general_ci default NULL,
  `IDMAN` varchar(10) collate latin1_general_ci default NULL,
  `TGLUPDATE` datetime default NULL,
  `UPDATER` varchar(10) collate latin1_general_ci default NULL,
  `CONTOH` tinytext collate latin1_general_ci,
  `CATATANMT` mediumtext collate latin1_general_ci NOT NULL,
  `NOMER1` varchar(50) collate latin1_general_ci NOT NULL,
  `NOMER2` varchar(50) collate latin1_general_ci NOT NULL,
  `CATATANTAGIHAN` mediumtext collate latin1_general_ci NOT NULL,
  `CATATANKLIEN` mediumtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `minta`
-- 

INSERT INTO `minta` VALUES ('000001', '1', '2012-10-02', '2012-10-02', NULL, 3, 'admin', 'mt', '2012-10-02 11:21:45', 'admin', 'Oksigen', '', '001', '01', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `nilaibaku`
-- 

CREATE TABLE `nilaibaku` (
  `ID` int(10) unsigned NOT NULL,
  `NILAI` varchar(50) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `nilaibaku`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `permintaan`
-- 

CREATE TABLE `permintaan` (
  `ID` varchar(10) collate latin1_general_ci NOT NULL,
  `ID2` varchar(10) collate latin1_general_ci default NULL,
  `IDTRANS` varchar(10) collate latin1_general_ci NOT NULL,
  `TANGGALSELESAI` date default NULL,
  `STATUS` smallint(5) unsigned NOT NULL default '0',
  `JENISANALISIS` smallint(5) unsigned NOT NULL default '0',
  `SAMPEL` mediumtext collate latin1_general_ci,
  `CATATAN` mediumtext collate latin1_general_ci,
  `CATATANM` mediumtext collate latin1_general_ci,
  `CATATANS` mediumtext collate latin1_general_ci,
  `CATATANA` mediumtext collate latin1_general_ci,
  `IDSUP` varchar(10) collate latin1_general_ci default NULL,
  `IDAN` varchar(10) collate latin1_general_ci default NULL,
  `TGLTERIMAMAN` date default NULL,
  `TGLTERIMASUP` date default NULL,
  `TGLTERIMAAN` date default NULL,
  `TGLUPDATE` datetime default NULL,
  `UPDATER` varchar(10) collate latin1_general_ci default NULL,
  `METODE` varchar(100) collate latin1_general_ci default NULL,
  `DATA` mediumtext collate latin1_general_ci,
  `IDIK` varchar(20) collate latin1_general_ci default NULL,
  `FILE` tinytext collate latin1_general_ci,
  `DATA2` text collate latin1_general_ci,
  `HISTORY` text collate latin1_general_ci,
  `NILAIBAKU` varchar(50) collate latin1_general_ci NOT NULL,
  `DUPLO` smallint(5) unsigned NOT NULL default '0',
  `DATADUPLO` mediumtext collate latin1_general_ci NOT NULL,
  `DATADUPLO2` text collate latin1_general_ci NOT NULL,
  `HASIL` varchar(100) collate latin1_general_ci NOT NULL,
  `HASIL2` varchar(100) collate latin1_general_ci NOT NULL,
  `RUMUS` varchar(100) collate latin1_general_ci NOT NULL,
  `BIAYA` float(12,2) NOT NULL,
  PRIMARY KEY  (`ID`,`IDTRANS`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `permintaan`
-- 

INSERT INTO `permintaan` VALUES ('000001', NULL, '000001', NULL, 0, 14, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2012-10-02 11:22:57', 'admin', NULL, NULL, NULL, NULL, NULL, '2012-10-02 11:22:12 Dientri oleh Administrasi\n2012-10-02 11:22:57 Diupdate oleh Administrasi (admin/admin).  \n', '', 0, '', '', '', '', '', 0.00);

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
  `LATARWARNA` char(6) collate latin1_general_ci NOT NULL,
  `LATARFOTO` tinytext collate latin1_general_ci NOT NULL,
  `UPDATER` varchar(20) collate latin1_general_ci NOT NULL,
  `LASTUPDATE` datetime NOT NULL,
  `ISLOGOKIRI` smallint(6) NOT NULL,
  `LOGOKIRI` tinytext collate latin1_general_ci NOT NULL,
  `ISLOGOKANAN` smallint(6) NOT NULL,
  `LOGOKANAN` tinytext collate latin1_general_ci NOT NULL,
  `ALOGOKIRI` varchar(100) collate latin1_general_ci NOT NULL,
  `ALOGOKANAN` varchar(100) collate latin1_general_ci NOT NULL,
  `PLKIRI` int(10) unsigned NOT NULL,
  `LLKIRI` int(10) unsigned NOT NULL,
  `PLKANAN` int(10) unsigned NOT NULL,
  `LLKANAN` int(10) unsigned NOT NULL,
  `HEADER1` varchar(100) collate latin1_general_ci NOT NULL,
  `HEADER2` varchar(100) collate latin1_general_ci NOT NULL,
  `HEADER3` varchar(100) collate latin1_general_ci NOT NULL,
  `FHEADER1` varchar(50) collate latin1_general_ci NOT NULL,
  `FHEADER2` varchar(50) collate latin1_general_ci NOT NULL,
  `FHEADER3` varchar(50) collate latin1_general_ci NOT NULL,
  `UHEADER1` smallint(6) NOT NULL,
  `UHEADER2` smallint(6) NOT NULL,
  `UHEADER3` smallint(6) NOT NULL,
  `ISBARCODE` smallint(6) NOT NULL,
  `WHEADER1` varchar(6) collate latin1_general_ci NOT NULL default '000000',
  `WHEADER2` varchar(6) collate latin1_general_ci NOT NULL default '000000',
  `WHEADER3` varchar(6) collate latin1_general_ci NOT NULL default '000000',
  `DATA` tinytext collate latin1_general_ci NOT NULL,
  `FDATA` varchar(100) collate latin1_general_ci NOT NULL,
  `UDATA` smallint(6) NOT NULL,
  `WDATA` varchar(6) collate latin1_general_ci NOT NULL,
  `ISLOGOKIRI2` smallint(5) unsigned NOT NULL,
  `LOGOKIRI2` tinytext collate latin1_general_ci NOT NULL,
  `ISLOGOKANAN2` smallint(5) unsigned NOT NULL,
  `LOGOKANAN2` tinytext collate latin1_general_ci NOT NULL,
  `ALOGOKIRI2` varchar(100) collate latin1_general_ci NOT NULL,
  `ALOGOKANAN2` varchar(100) collate latin1_general_ci NOT NULL,
  `PLKIRI2` int(10) unsigned NOT NULL,
  `LLKIRI2` int(10) unsigned NOT NULL,
  `PLKANAN2` int(10) unsigned NOT NULL,
  `LLKANAN2` int(10) unsigned NOT NULL,
  `HEADER4` varchar(100) collate latin1_general_ci NOT NULL,
  `HEADER5` varchar(100) collate latin1_general_ci NOT NULL,
  `HEADER6` varchar(100) collate latin1_general_ci NOT NULL,
  `HEADER7` varchar(100) collate latin1_general_ci NOT NULL,
  `FHEADER4` varchar(50) collate latin1_general_ci NOT NULL,
  `FHEADER5` varchar(50) collate latin1_general_ci NOT NULL,
  `FHEADER6` varchar(50) collate latin1_general_ci NOT NULL,
  `FHEADER7` varchar(50) collate latin1_general_ci NOT NULL,
  `UHEADER4` smallint(6) NOT NULL,
  `UHEADER5` smallint(6) NOT NULL,
  `UHEADER6` smallint(6) NOT NULL,
  `UHEADER7` smallint(6) NOT NULL,
  `WHEADER4` varchar(6) collate latin1_general_ci NOT NULL,
  `WHEADER5` varchar(6) collate latin1_general_ci NOT NULL,
  `WHEADER6` varchar(6) collate latin1_general_ci NOT NULL,
  `WHEADER7` varchar(6) collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `settingkop`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `survey`
-- 

CREATE TABLE `survey` (
  `ID` char(10) collate latin1_general_ci NOT NULL,
  `JAWAB1` char(1) collate latin1_general_ci NOT NULL,
  `JAWAB2` char(1) collate latin1_general_ci NOT NULL,
  `JAWAB3` char(1) collate latin1_general_ci NOT NULL,
  `JAWAB4` char(1) collate latin1_general_ci NOT NULL,
  `JAWAB5` char(1) collate latin1_general_ci NOT NULL,
  `JAWAB6` char(1) collate latin1_general_ci NOT NULL,
  `CATATAN` mediumtext collate latin1_general_ci NOT NULL,
  `NAMA` tinytext collate latin1_general_ci NOT NULL,
  `PERUSAHAAN` tinytext collate latin1_general_ci NOT NULL,
  `UPDATER` varchar(20) collate latin1_general_ci NOT NULL,
  `LASTUPDATE` datetime NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `survey`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `toko`
-- 

CREATE TABLE `toko` (
  `ID` varchar(10) collate latin1_general_ci NOT NULL default '',
  `NAMA` varchar(50) collate latin1_general_ci default NULL,
  `KONTAK` varchar(50) collate latin1_general_ci default NULL,
  `TELEPON` varchar(20) collate latin1_general_ci default NULL,
  `ALAMAT` tinytext collate latin1_general_ci,
  `NPWP` varchar(50) collate latin1_general_ci default NULL,
  `JANGKABAYAR` int(10) unsigned NOT NULL default '0',
  `LIMITKREDIT` double(15,2) default NULL,
  `PASSWORD` varchar(100) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `toko`
-- 

INSERT INTO `toko` VALUES ('1', 'Klien1', 'Nurul', '0227835688', 'Jalan Cibatu Mulya', '', 0, 0.00, 'a340e9534c757a315eea8fdfc2a2820b');

-- --------------------------------------------------------

-- 
-- Table structure for table `transaksi`
-- 

CREATE TABLE `transaksi` (
  `ID` int(10) NOT NULL auto_increment,
  `IDTRANS` int(10) NOT NULL,
  `IDBAHAN` varchar(10) collate latin1_general_ci NOT NULL,
  `JENIS` int(5) NOT NULL,
  `JUMLAH` int(15) NOT NULL,
  `TANGGAL` date NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `transaksi`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `ID` varchar(10) collate latin1_general_ci NOT NULL default '',
  `NAMA` varchar(50) collate latin1_general_ci NOT NULL default '',
  `PASSWORD` varchar(50) collate latin1_general_ci default NULL,
  `TINGKAT` varchar(10) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` VALUES ('superadmin', 'Administrator', '17c4520f6cfd1ab53d8745e84681eb49', 'A');
INSERT INTO `user` VALUES ('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'B');
INSERT INTO `user` VALUES ('mt', 'mt', '710998fd1b7c0235170265650770a4b1', 'C');
INSERT INTO `user` VALUES ('supervisor', 'supervisor', '09348c20a019be0318387c08df7a783d', 'D');
INSERT INTO `user` VALUES ('analis', 'analis', '6f7cf810b9252805f195bcf981156af6', 'E');

-- --------------------------------------------------------

-- 
-- Table structure for table `varjenisuji`
-- 

CREATE TABLE `varjenisuji` (
  `IDJENISUJI` int(10) unsigned NOT NULL default '0',
  `VAR` varchar(5) collate latin1_general_ci NOT NULL default '',
  `NAMA` tinytext collate latin1_general_ci,
  `MANUAL` smallint(5) unsigned NOT NULL default '0',
  `RUMUS` tinytext collate latin1_general_ci,
  `KONSTANTA` tinytext collate latin1_general_ci,
  PRIMARY KEY  (`IDJENISUJI`,`VAR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `varjenisuji`
-- 

