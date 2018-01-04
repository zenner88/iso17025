<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";

printhtmlcetak();
$cetak=$aksi="cetak";
$border=" border=1 width=600 "; 

if ($aksi2=="Cetak") {
	include "proseslogdokumen.php";
}  
?>
