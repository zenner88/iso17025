CREATE TABLE IF NOT EXISTS `ik` (
  `ID` varchar(20) NOT NULL default '',
  `NAMA` tinytext,
  `FILE` tinytext,
  PRIMARY KEY  (`ID`)
) ;

 
CREATE TABLE IF NOT EXISTS `jenisuji` (
  `ID` int(10) unsigned NOT NULL default '31',
  `NAMA` tinytext,
  `NAMA2` tinytext,
  `JMLVAR` int(10) unsigned NOT NULL default '0',
  `RUMUS` tinytext,
  `HASIL` tinytext,
  `SATUAN` tinytext,
  `IDKELOMPOK` char(5) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ;

 
INSERT INTO `jenisuji` (`ID`, `NAMA`, `NAMA2`, `JMLVAR`, `RUMUS`, `HASIL`, `SATUAN`, `IDKELOMPOK`) VALUES
(120, 'Kadar Air', 'Air', 4, '100 * ((B-A)-(C-A)) / (B-A)', '% air', '%', '0'),
(121, 'Kadar Protein', 'Protein', 6, 'F * 100 * (A*B*C*14) / (D*E)', '% Protein', '%', '0'),
(122, 'Kadar Lemak cara Soxhlet', 'Lemak', 4, '100 * (D - C) / (B - A)', '% Lemak', '%', '0'),
(123, 'Kadar Abu', 'Abu', 3, '100 * (C - A) / (B - A)', '% Abu', '%', '0'),
(124, 'Kadar Serat Kasar', 'Serat Kasar', 5, '100 * ( D - ( B + C + E ) ) / A', '% Serat', '%', '0'),
(125, 'Kadar KH cara Luff Schoorl', 'KH', 10, '100 * (250/b) * (a/c) * d', '% KH', '%', '0'),
(126, 'Kadar Gula Pereduksi cara Luff Schoorl', 'Gula Pereduksi', 10, '100 * (vPl/b)  * (a/c) * d', '% Gula Pereduksi', '%', '0'),
(127, 'Kadar Gula Total cara Luff Schoorl', 'Gula Total', 12, '100 * (100/b)  * (a/c) * d', '% Gula Total', '%', '0'),
(128, 'Kadar Klorida cara Mohr', 'Klorida', 6, '100 * (A/B) * C * D * E / F', '% Klorida', '%', '0');

 
CREATE TABLE IF NOT EXISTS `kelompokjenisuji` (
  `ID` char(5) NOT NULL,
  `NAMA` varchar(200) NOT NULL,
  PRIMARY KEY  (`ID`)
) ;

 
INSERT INTO `kelompokjenisuji` (`ID`, `NAMA`) VALUES
('0', 'DEFAULT JENIS UJI'),
('GAS', 'UJI PROSES GAS'),
('UTIL', 'UTILITAS');


CREATE TABLE IF NOT EXISTS `minta` (
  `ID` varchar(10) NOT NULL,
  `IDKLIEN` varchar(10) NOT NULL default '',
  `TANGGALDATANG` date default NULL,
  `TANGGALDEADLINE` date default NULL,
  `TANGGALSELESAI` date default NULL,
  `STATUS` smallint(5) unsigned NOT NULL default '0',
  `IDUSER` varchar(10) default NULL,
  `IDMAN` varchar(10) default NULL,
  `TGLUPDATE` datetime default NULL,
  `UPDATER` varchar(10) default NULL,
  `CONTOH` tinytext,
  PRIMARY KEY  (`ID`)
)  ;

 
CREATE TABLE IF NOT EXISTS `nilaibaku` (
  `ID` int(10) unsigned NOT NULL,
  `NILAI` varchar(50) NOT NULL,
  PRIMARY KEY  (`ID`)
)  ;

 
INSERT INTO `nilaibaku` (`ID`, `NILAI`) VALUES
(0, ''),
(1, ''),
(2, ''),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, ''),
(8, ''),
(9, ''),
(10, ''),
(11, ''),
(12, ''),
(13, ''),
(14, ''),
(15, ''),
(16, ''),
(17, ''),
(18, ''),
(19, ''),
(20, ''),
(21, ''),
(22, ''),
(23, ''),
(24, ''),
(25, ''),
(26, ''),
(27, ''),
(28, ''),
(29, ''),
(30, ''),
(31, '70'),
(32, '60'),
(33, '45'),
(34, ''),
(35, ''),
(36, ''),
(37, ''),
(38, ''),
(39, ''),
(40, ''),
(41, ''),
(42, ''),
(43, ''),
(44, ''),
(45, ''),
(46, ''),
(47, ''),
(48, ''),
(49, ''),
(50, ''),
(51, ''),
(52, ''),
(53, ''),
(54, ''),
(55, ''),
(56, ''),
(57, ''),
(58, ''),
(59, ''),
(60, ''),
(61, ''),
(62, ''),
(63, ''),
(64, ''),
(65, ''),
(66, ''),
(67, ''),
(68, ''),
(69, ''),
(70, ''),
(71, ''),
(72, ''),
(73, ''),
(74, ''),
(75, ''),
(76, ''),
(77, ''),
(78, ''),
(79, ''),
(80, ''),
(81, ''),
(82, ''),
(83, ''),
(84, ''),
(85, ''),
(86, ''),
(87, ''),
(88, ''),
(89, ''),
(90, ''),
(91, ''),
(92, ''),
(93, ''),
(94, ''),
(95, ''),
(96, ''),
(97, ''),
(98, ''),
(99, ''),
(100, ''),
(101, ''),
(102, ''),
(103, ''),
(104, ''),
(105, ''),
(106, ''),
(107, ''),
(108, ''),
(109, ''),
(110, ''),
(111, ''),
(112, ''),
(113, ''),
(114, ''),
(115, ''),
(116, ''),
(117, ''),
(118, '');

 
CREATE TABLE IF NOT EXISTS `permintaan` (
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
  PRIMARY KEY  (`ID`,`IDTRANS`)
)  ;

 
CREATE TABLE IF NOT EXISTS `settingkop` (
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
) ;

 
INSERT INTO `settingkop` (`PANJANG`, `LEBAR`, `ISFOTO`, `PANJANGF`, `LEBARF`, `LATAR`, `LATARWARNA`, `LATARFOTO`, `UPDATER`, `LASTUPDATE`, `ISLOGOKIRI`, `LOGOKIRI`, `ISLOGOKANAN`, `LOGOKANAN`, `ALOGOKIRI`, `ALOGOKANAN`, `PLKIRI`, `LLKIRI`, `PLKANAN`, `LLKANAN`, `HEADER1`, `HEADER2`, `HEADER3`, `FHEADER1`, `FHEADER2`, `FHEADER3`, `UHEADER1`, `UHEADER2`, `UHEADER3`, `ISBARCODE`, `WHEADER1`, `WHEADER2`, `WHEADER3`, `DATA`, `FDATA`, `UDATA`, `WDATA`) VALUES
(0, 0, 0, 0, 0, 0, '', 'latarfoto.jpg', 'sistem', '2008-09-12 08:53:22', 1, 'logokiri.png', 0, 'logokanan.jpg', '', '', 25, 25, 15, 15, 'Pusat Penelitian Kimia - LIPI', 'Jl. Cisitu - Sangkuriang Bandung 40135', 'Telp : (022) 2503051 Fax : (022) 2503051', 'Tahoma', 'Tahoma', 'Tahoma', 14, 12, 12, 0, '000000', '000000', '000000', '', '', 0, '');
 
CREATE TABLE IF NOT EXISTS `toko` (
  `ID` varchar(10) NOT NULL default '',
  `NAMA` varchar(50) default NULL,
  `KONTAK` varchar(50) default NULL,
  `TELEPON` varchar(20) default NULL,
  `ALAMAT` tinytext,
  `NPWP` varchar(50) default NULL,
  `JANGKABAYAR` int(10) unsigned NOT NULL default '0',
  `LIMITKREDIT` double(15,2) default NULL,
  PRIMARY KEY  (`ID`)
) ;

 
INSERT INTO `toko` (`ID`, `NAMA`, `KONTAK`, `TELEPON`, `ALAMAT`, `NPWP`, `JANGKABAYAR`, `LIMITKREDIT`) VALUES
('0', 'Contoh Klien', '', '', '', '', 365, NULL),
('KIMLIPI', 'PP KIMIA LIPI', 'Tiny', '0220242402402', 'Cisitu Sangkuriang', '', 0, 0.00);

 
CREATE TABLE IF NOT EXISTS `user` (
  `ID` varchar(10) NOT NULL default '',
  `NAMA` varchar(50) NOT NULL default '',
  `PASSWORD` varchar(50) default NULL,
  `TINGKAT` varchar(10) default NULL,
  PRIMARY KEY  (`ID`)
) ;

 
INSERT INTO `user` (`ID`, `NAMA`, `PASSWORD`, `TINGKAT`) VALUES
('superadmin', 'Administrator', 'ac43724f16e9241d990427ab7c8f4228', 'A'),
('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'B'),
('mt', 'mt', '710998fd1b7c0235170265650770a4b1', 'C'),
('supervisor', 'supervisor', '09348c20a019be0318387c08df7a783d', 'D'),
('analis', 'analis', '6f7cf810b9252805f195bcf981156af6', 'E');

 
CREATE TABLE IF NOT EXISTS `varjenisuji` (
  `IDJENISUJI` int(10) unsigned NOT NULL default '0',
  `VAR` varchar(5) NOT NULL default '',
  `NAMA` tinytext,
  `MANUAL` smallint(5) unsigned NOT NULL default '0',
  `RUMUS` tinytext,
  `KONSTANTA` tinytext,
  PRIMARY KEY  (`IDJENISUJI`,`VAR`)
) ;
 
INSERT INTO `varjenisuji` (`IDJENISUJI`, `VAR`, `NAMA`, `MANUAL`, `RUMUS`, `KONSTANTA`) VALUES
(31, 'A', 'H2', 1, '', ''),
(33, 'A', '% Vol N2', 1, '', ''),
(32, 'A', '% H2', 1, '', ''),
(34, 'A', 'ppm N2', 1, '', ''),
(35, 'A', '% Vol CO2', 1, '', ''),
(36, 'A', '% Mol CO2', 1, '', ''),
(37, 'A', 'ppm CO2', 1, '', ''),
(38, 'A', '% Vol Ar', 1, '', ''),
(39, 'A', '% Mol Ar', 1, '', ''),
(40, 'A', '% Vol CH4', 1, '', ''),
(41, 'A', '% Mol CH4', 1, '', ''),
(42, 'A', 'ppm CH4', 1, '', ''),
(43, 'A', '%Vol NH3', 1, '', ''),
(44, 'A', 'ppm NH3', 1, '', ''),
(45, 'A', '%Weight NH3', 1, '', ''),
(46, 'A', 'Ratio', 1, '', ''),
(47, 'A', '%Mol C2H6', 1, '', ''),
(48, 'A', '%Mol C3H8', 1, '', ''),
(49, 'A', '%Mol i-C4H10', 1, '', ''),
(50, 'A', '%Mol n-C4H10', 1, '', ''),
(51, 'A', '%Mol n-C5H12', 1, '', ''),
(52, 'A', '%Mol C6H14 plus', 1, '', ''),
(53, 'A', 'ppm H2S', 1, '', ''),
(54, 'A', 'Sp. Gr.', 1, '', ''),
(55, 'A', 'GHV', 1, '', ''),
(56, 'A', 'LHV.', 1, '', ''),
(57, 'A', 'Kcal/Nm3', 1, '', ''),
(58, 'A', 'MW', 1, '', ''),
(59, 'A', 'CARBON NOMBER', 1, '', ''),
(60, 'A', 'LEL', 1, '', ''),
(61, 'A', 'PH', 1, '', ''),
(62, 'A', 'Foaming Vol.', 1, '', ''),
(63, 'A', 'Collaps Time', 1, '', ''),
(64, 'A', 'Density', 1, '', ''),
(65, 'A', 'Fe total', 1, '', ''),
(66, 'A', 'MDEA', 1, '', ''),
(67, 'A', 'Piperazine', 1, '', ''),
(68, 'A', 'Total Amine', 1, '', ''),
(69, 'A', 'CO2 Loading', 1, '', ''),
(70, 'A', '%Vol O2', 1, '', ''),
(71, 'A', 'ppm NO', 1, '', ''),
(72, 'A', 'ppm NO2', 1, '', ''),
(73, 'A', 'ppm NOx', 1, '', ''),
(74, 'A', 'ppm SO2', 1, '', ''),
(75, 'A', '%Vol O2 Analyzer', 1, '', ''),
(76, 'A', '%Wt H20', 1, '', ''),
(77, 'A', 'ppm Oil Content', 1, '', ''),
(78, 'A', 'ppm Cl -', 1, '', ''),
(79, 'A', 'PH', 1, '', ''),
(80, 'A', 'Conductivity', 1, '', ''),
(81, 'A', 'ppm Fe total', 1, '', ''),
(82, 'A', 'ppm Cu', 1, '', ''),
(83, 'A', 'ppm Na', 1, '', ''),
(84, 'A', 'ppm SiO2', 1, '', ''),
(85, 'A', 'ppm Cl-', 1, '', ''),
(86, 'A', 'ppm NH4+', 1, '', ''),
(87, 'A', 'ppm TDS', 1, '', ''),
(88, 'A', 'ppm PO4(3-)', 1, '', ''),
(89, 'A', 'Cond. Analyzer', 1, '', ''),
(90, 'A', 'ppb Elimin-Ox', 1, '', ''),
(91, 'A', 'ppm Fe total', 1, '', ''),
(92, 'A', 'ppm PO4', 1, '', ''),
(93, 'A', 'ppb DO', 1, '', ''),
(94, 'A', 'Turbidity', 1, '', ''),
(95, 'A', 'ppm NH3', 1, '', ''),
(96, 'A', 'ppm Cl2 free', 1, '', ''),
(97, 'A', 'ppm Cl2 total', 1, '', ''),
(98, 'A', 'ppm Residual PO4', 1, '', ''),
(99, 'A', 'DP (&ordm;C)', 1, '', ''),
(100, 'A', 'ppm H2O', 1, '', ''),
(101, 'A', 'ppm O2', 1, '', ''),
(102, 'A', '%Vol N2', 1, '', ''),
(103, 'A', 'ppm CH4', 1, '', ''),
(104, 'A', 'ppm CO', 1, '', ''),
(105, 'A', 'ppm CO2', 1, '', ''),
(106, 'A', 'ppm O2 Analyzer', 1, '', ''),
(107, 'A', 'ppm Salinity', 1, '', ''),
(108, 'A', 'ppm p-Alk', 1, '', ''),
(109, 'A', 'ppm M-Alk', 1, '', ''),
(110, 'A', 'ppm Ca Hardness', 1, '', ''),
(111, 'A', 'ppm Mg Hardness', 1, '', ''),
(112, 'A', 'ppm Tot.Hardness', 1, '', ''),
(113, 'A', 'Temperature (&ordm;C)', 1, '', ''),
(114, 'A', 'ppm TSS', 1, '', ''),
(115, 'A', 'ppm NH3 - N', 1, '', ''),
(116, 'A', 'ppm Oil Content', 1, '', ''),
(117, 'A', 'ppm COD', 1, '', ''),
(118, 'A', 'ppm BOD5', 1, '', ''),
(31, 'B', '', 1, '', ''),
(31, 'C', '', 1, '', ''),
(119, 'A', 'Bau', 1, '', ''),
(120, 'A', 'Berat wadah kosong', 1, '', ''),
(120, 'B', 'Berat wadah + contoh', 1, '', ''),
(120, 'C', 'Berat setelah pemanasan', 1, '', ''),
(121, 'A', 'Vol. Pelarut Hasil Destilasi (mL)', 1, '', ''),
(121, 'B', 'HCL (mL)', 1, '', ''),
(121, 'C', 'N HCL', 1, '', ''),
(121, 'D', 'Vol. Pelarut yang dipipet (mL)', 1, '', ''),
(121, 'E', 'Berat contoh (mg)', 1, '', ''),
(121, 'F', 'Faktor Konversi', 1, '', ''),
(122, 'A', 'Berat Wadah (g)', 1, '', ''),
(122, 'B', 'Berat Wadah + Contoh (g)', 1, '', ''),
(122, 'C', 'Berat Labu Kosong (g)', 1, '', ''),
(122, 'D', 'Berat Labu Kosong + Lemak (g)', 1, '', ''),
(123, 'A', 'Berat Cawan Kosong (g)', 1, '', ''),
(123, 'B', 'Berat Cawan + Contoh (g)', 1, '', ''),
(123, 'C', 'Berat Cawan + Contoh setelah pemanasan (g)', 1, '', ''),
(124, 'A', 'Berat Contoh (g)', 1, '', ''),
(124, 'B', 'Berat Cawan Kosong 110oC (g)', 1, '', ''),
(124, 'C', 'Berat Kertas Saring (g)', 1, '', ''),
(124, 'D', 'Berat Cawan + kertas Saring + Residu 110oC (g)', 1, '', ''),
(124, 'E', 'Berat Asbes', 1, '', ''),
(125, 'vPl', 'Vol Pelarutan Contoh (mL)', 1, '', ''),
(125, 'vBl', 'Vol Na2S2O3 u blanko (mL)', 1, '', ''),
(125, 'vSp', 'Vol Na2S2O3 u sampel (mL)', 1, '', ''),
(125, 'h', 'Bl-Sp Selisih Vol penitrasi Na2S2O3 u/ sampel (mL)', 2, '', 'vBl-vSp'),
(125, 'f', 'Faktor Normalitas Na2S2O3', 1, '', ''),
(125, 'fh', 'f x h', 2, '', 'f*h'),
(125, 'a', 'Pembacaan tepung dari Tabel', 1, '', '13'),
(125, 'b', 'Vol yg direaksikan dgn Luff Schoorl', 1, '', ''),
(125, 'c', 'Berat contoh yg ditimbang (mg)', 1, '', ''),
(125, 'd', 'Faktor pengenceran', 1, '', ''),
(126, 'a', 'Hasil pembacaan tepung dari tabel (mg)', 1, '', ''),
(126, 'b', 'Vol yg direaksikan dgn Luff Schoorl', 1, '', ''),
(126, 'c', 'Berat contoh yang ditimbang (mg)', 1, '', ''),
(126, 'd', 'Faktor Pengenceran', 1, '', ''),
(126, 'f', 'Faktor Normalitas Na2S2O3', 1, '', ''),
(126, 'fh', 'f x h Na2S2O3 0.1 N', 2, '', 'f*h'),
(126, 'h', 'Bl-Sp Selisih Vol penitrasi Na2S2O3 u/ sampel  (mL)', 2, '', 'vBl-vSp'),
(126, 'vPl', 'Vol Pelarutan Contoh (mL)', 1, '', ''),
(126, 'vBl', 'Vol Na2S2O3 u blanko (mL)', 1, '', ''),
(126, 'vSp', 'Vol Na2S2O3 u sampel (mL)', 1, '', ''),
(127, 'a', 'Hasil pembacaan tepung dari tabel (mg)', 1, '', ''),
(127, 'b', 'Vol. yang direaksikan dgn Luff Schoorl', 1, '', ''),
(127, 'c', 'Berat contoh yang ditimbang (mg)', 1, '', ''),
(127, 'd', 'Faktor Pengenceran', 2, '', 'e/f'),
(127, 'e', 'Volume Pelarutan Contoh (mL)', 1, '', ''),
(127, 'f', 'Volume Larutan yg diambil u/ inversi (mL)', 1, '', ''),
(127, 'Fh', 'fxh Na2S2O3 0.1 N (mL)', 2, '', 'f*h'),
(127, 'vPl', 'Vol Pelarutan Hasil Inversi (mL)', 1, '', ''),
(127, 'vBl', 'Vol Na2S2O3 u blanko (mL)', 1, '', ''),
(127, 'vSp', 'Vol Na2S2O3 u sampel (mL)', 1, '', ''),
(127, 'h', 'Bl - SP Selisih Vol penitrasi Na2S2O3 u/ sampel  (mL)', 2, '', 'vBl-vSp'),
(128, 'A', 'Volume pelarutan contoh (mL)', 1, '', ''),
(128, 'B', 'Banyaknya contoh yang dititrasi (mL)', 1, '', ''),
(128, 'C', 'Volume larutan penitrasi AgNO3 (mL)', 1, '', ''),
(128, 'D', 'Normalitas Penitrasi', 1, '', ''),
(128, 'E', 'Berat setara C (mg)', 1, '', ''),
(128, 'F', 'Berat contoh (mg)', 1, '', '');


CREATE TABLE IF NOT EXISTS `biaya` (
  `ID` int(10) unsigned NOT NULL,
  `NILAI` FLOAT(12,2) NOT NULL,
  PRIMARY KEY  (`ID`)
);

ALTER TABLE `permintaan` ADD `BIAYA` FLOAT( 12, 2 ) NOT NULL ;

CREATE TABLE IF NOT EXISTS `biaya` (
  `ID` int(10) unsigned NOT NULL,
  `NILAI` FLOAT(12,2) NOT NULL,
  PRIMARY KEY  (`ID`)
);

ALTER TABLE  `minta` ADD  `CATATANMT` MEDIUMTEXT NOT NULL ;

CREATE TABLE `filehasilanalis` (
`ID` VARCHAR( 10 ) NOT NULL ,
`IDTRANS` VARCHAR( 10 ) NOT NULL ,
`FILEANALIS` LONGBLOB NOT NULL ,
`NAMAFILEANALIS` TINYTEXT NOT NULL ,
PRIMARY KEY ( `ID` , `IDTRANS` )
) ;

CREATE TABLE `filesupervisor` (
`ID` VARCHAR( 10 ) NOT NULL ,
`IDTRANS` VARCHAR( 10 ) NOT NULL ,
`FILESUPERVISOR` LONGBLOB NOT NULL ,
`NAMAFILESUPERVISOR` TINYTEXT NOT NULL ,
PRIMARY KEY ( `ID` , `IDTRANS` )
);

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
;

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
ADD `WHEADER7` VARCHAR( 6 ) NOT NULL ;

ALTER TABLE  `jenisuji` ADD  `RM` TINYTEXT NOT NULL ;

ALTER TABLE  `minta` ADD  `NOMER1` VARCHAR( 50 ) NOT NULL ,
ADD  `NOMER2` VARCHAR( 50 ) NOT NULL ;

ALTER TABLE  `minta` ADD  `CATATANTAGIHAN` MEDIUMTEXT NOT NULL ;


ALTER TABLE  `toko` ADD  `PASSWORD` VARCHAR( 100 ) NOT NULL ;


ALTER TABLE  `minta` ADD  `CATATANKLIEN` MEDIUMTEXT NOT NULL ;


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
);

CREATE TABLE IF NOT EXISTS `logdokumen` (
  `ID` int(11) NOT NULL auto_increment,
  `JENISDOKUMEN` text NOT NULL,
  `NAMA` tinytext NOT NULL,
  `PEGAWAI` varchar(100) NOT NULL,
  `WAKTU` datetime NOT NULL,
  `ASAL` varchar(100) NOT NULL,
  `JENISLOG` varchar(100) NOT NULL,
  PRIMARY KEY  (`ID`)
);
