<?

include "header.php";
$errdh="id";

if (trim($aksi)=="Login") {

	if (trim($iduser=="")) {
		$errmesg="ID User harus diisi";
		//buatlog(9,$idadmin);
		$errlogin="id";
	} elseif (trim($password=="")) {
		//echo $iduser;
		$errmesg="Password harus diisi";
		$errlogin="password";
		//buatlog(9,$idadmin);
	} else {
    if ($jenis==0) {		
  		$query = "SELECT NAMA,TINGKAT FROM user WHERE ID='$iduser' AND PASSWORD=md5('$password')";
  		$hasil=doquery($query,$koneksi);
  		if (sqlnumrows($hasil)>0) {
  			$data=sqlfetcharray($hasil);
  			session_start();
  			session_register("users");
  			session_register("namausers");
  			session_register("tingkats");
  			session_register("jenisusers");
  			$users=$iduser;
  			$namausers=$data[NAMA];
  			$tingkats=$data[TINGKAT];
  			$jenisusers=0;
  				$URLS=str_replace("index.php","",$SCRIPT_FILENAME);
  
			$_SESSION["users"]=$users;
          $_SESSION["namausers"]=$namausers;
          $_SESSION["tingkats"]=$tingkats;
          $_SESSION["jenisusers"]=0;
  		    $_SESSION["URLS"]=$URLS;
   
  			if (trim($tingkats)=="A") {
  				$go="operator";
  			} else {
  				$go="trans";
  			}
  			mysql_close();Header("Location:$go/index.php");
//  		  $ketlog="Operator Login.";
//        buatlogiso(4,$ketlog,"",$users);

  			exit;
  		} else {
  			$errmesg="Maaf, ID dan Password Anda tidak sesuai.";
  			$errlogin="id";
  		}
		} elseif ($jenis==1) {

  		$query = "SELECT NAMA FROM toko WHERE ID='$iduser' AND PASSWORD=md5('$password')";
  		$hasil=doquery($query,$koneksi);
  		if (sqlnumrows($hasil)>0) {
  			$data=sqlfetcharray($hasil);
  			session_start();
  			session_register("users");
  			session_register("namausers");
  			session_register("jenisusers");
  			session_register("tingkats");
   			$users=$iduser;
  			$namausers=$data[NAMA];
  			$jenisusers=1;
  			$tingkats="F";
   				$URLS=str_replace("index.php","",$SCRIPT_FILENAME);
  
  				$_SESSION["users"]=$users;
          $_SESSION["namausers"]=$namausers;
          $_SESSION["jenisusers"]=1;
          $_SESSION["tingkats"]=$tingkats;
   		    $_SESSION["URLS"]=$URLS;
   
  			mysql_close();Header("Location:transklien/index.php");
//  		  $ketlog="Klien Login.";
//        buatlogiso(4,$ketlog,"",$users);
  			exit;
  		} else {
  			$errmesg="Maaf, ID dan Password Anda tidak sesuai.";
  			$errlogin="id";
  		}

    
    }
	}
	/* <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> */
}
?><!doctype html>
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
		<H3 style="line-height:24px;padding:0;margin:0;font-size:18pt;"><?=$judulprogram?></H3>
		<h4 style="line-height:24px;padding:0;margin:0;font-size:14pt;"><?=$namakantor?></h4>
            <h4 style="line-height:24px;padding:0;margin:0;font-size:14pt;"><?=$alamatkantor?></h4></p>


	 <div id=errlog><? printmesg($errmesg); ?></div>
			<div id=loginbox><?
				include "loginuser.php";
				?>
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

