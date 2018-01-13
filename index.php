<?php 
$judulprogram="Sistem Informasi Laboratorium Kimia";
$namakantor="PUSAT PENELITIAN KIMIA - LIPI";
$alamatkantor="Cisitu-Sangkuriang Bandung";
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name='author' content='Ahmad Maulana Yahya'>
<meta name='author' content='Ricky Sauqi'>
<meta name='author' content='Suteki-Tech'>
<meta name='author' content='PP KIMIA LIPI'>
<meta name='geo.country' content='ID'>
<meta name='geo.placename' content='Bandung'>
<meta name='geo.placename' content='Dago'>
<meta name='dc.language' content='en'>
<meta name='copyright' content='Copyright © 2005 Suteki-tech.com for PP KIMIA LIPI'>
<meta name='description' content='ISO 17025 Administration Certification Web Based Application '>
<meta name='keywords' content='chemical certification, php, mysql, chemical, pp kimia lipi'>
<link rel="stylesheet" href="style.css" type="text/css" > 
<title>iso 17025</title>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="0">

<!--<tr>
	<td colspan="2" id="FP_titlebar">
		<div id="FPtitle"><?=$judulprogram?></div>
	</td>
	</tr>-->
<tr id="FP_main">
	<td id="FP_img">
	</td>
	<td id="FP_contentarea">
		<!--<p><img src="images/logo-kimia-pps.png" width="64" height="64"> -->
		<H3 style="line-height:24px;padding:0;margin:0;font-size:18pt;"><?php echo $judulprogram?></H3>
		<h4 style="line-height:24px;padding:0;margin:0;font-size:14pt;"><?php echo $namakantor?></h4>
            <h4 style="line-height:24px;padding:0;margin:0;font-size:14pt;"><?php echo $alamatkantor?></h4></p>


			<div id=loginbox><?php include "loginuser.php"; ?>
				</div> 	 
	</td>
	</tr>
<tr>
	<td colspan="2" id="footer">
		&copy; suteki global informatika - PP Kimia LIPI, www.suteki-tech.com&nbsp;&nbsp;
		</td>
	</tr>
</table>

</body>
</html>

