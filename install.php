<?php
session_start();
include_once "install/data.php";
include_once "install/fungsi.php";

echo "
<html>
<head>
<title>INSTALASI BASIS DATA $namaprogram</title>
<link rel=\"stylesheet\" href=\"install/indexc.css\" type=\"text/css\" /> 
</head>
<body>

<h1>INSTALASI BASIS DATA $namaprogram</h1>
<table class=data border=1 width=95%>
  <tr class=juduldata>
    <td colspan=2 width=200>INFO UMUM SERVER</td>
   </tr>
  <tr class=datagenap>
    <td width=200>Waktu Eksekusi Maksimum</td>
    <td>".ini_get("max_execution_time")." detik</td>
  </tr>
  <tr class=dataganjil>
    <td>Batasan Memori</td>
    <td>".ini_get("memory_limit")."</td>
  </tr>
  <tr  class=datagenap>
    <td>Ukuran file instalasi</td>
    <td>".number_format(filesize("install/data.sql")/(1024*1024),2)."M</td>
  </tr>
 </table>
";

if ($_POST["pilihan"]==3) {
  // HALAMAN 4, INSTAL!!
  include_once "install/proses4.php";
}
if ($_POST["pilihan"]==2) {
  // HALAMAN 3, Konfirmasi Instalasi
  include_once "install/proses3.php";
}
if ($_POST["pilihan"]==1) {
  // HALAMAN 2, Membuat User Basis Data
  include_once "install/proses2.php";
}
if ($_POST["pilihan"]=="") {
  // HALAMAN 1 , Minta akses ke MySQL
  include_once "install/proses1.php";
}

echo "
<br>
		<div id=\"siteInfo\">
				$namaprogram &copy; Suteki-Tech (<a class=glink style=\"border:none\"  
				href='http://www.suteki.co.id'>www.suteki.co.id</a>).  
				 Saran dan kritik yang membangun, kirimkan ke info@suteki.co.id
				 
			</div><!--siteInfo -->
";

?>
