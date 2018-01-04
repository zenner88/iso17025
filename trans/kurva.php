<?
//$seed=mt_srand(make_seed());
$xx=mt_rand();
$xx="$idupdate$jenisanalisis";
$folder="gambardiagram/";
/////////////////////////////////////////////////////////////////////


$datatabel[panjang]=400;
$datatabel[lebar]=250;
$datatabel[jarakbingkai]=30;
$datatabel[minx]=0;
$datatabel[miny]=0;
$datatabel[maxx]=max($datax);
$datatabel[maxy]=max($datay);

$pembagiy=getpembagiinteger($datatabel[maxy]);
$pembagix=getpembagiinteger($datatabel[maxx]);
$datatabel[jmltitiky]=$pembagiy;
$datatabel[jmltitikx]=$pembagix;
$datatabel[jarakbatang]=2;

$ombangambing=0;
/// data Dummi ///////


unset($datareal);
foreach ($datax as $k=>$v) {
  	$datareal[$k][x]=$datax[$k];
 	$datareal[$k][y]=$datay[$k];
 	$data[$datax[$k]]=$datay[$k];
	//$datanx[$datax[$k]]=$datax[$k];
}

$juduldiagram[1][nama]="Kurva Kalibrasi";
$juduldiagram[2][nama]="";
$juduldiagram[x][nama]="Std. Logam";
$juduldiagram[y][nama]="Serapan";
$juduldiagram[x][font]=1;
$juduldiagram[y][font]=1;
$juduldiagram[1][font]=4;
$juduldiagram[2][font]=3;
$juduldiagram[ny][font]=1;
$juduldiagram[nx][font]=1;
/////////////////////////////////////////////////////////////////
//// Warna/////////////////////
/*
	$juduldiagram[warna][latar][R]=255;
	$juduldiagram[warna][latar][G]=255;
	$juduldiagram[warna][latar][B]=255;
	$juduldiagram[warna][latartabel][R]=33;
	$juduldiagram[warna][latartabel][G]=33;
	$juduldiagram[warna][latartabel][B]=255;
	$juduldiagram[warna][garis][R]=22;
	$juduldiagram[warna][garis][G]=22;
	$juduldiagram[warna][garis][B]=22;
	$juduldiagram[warna][tabel][R]=255;
	$juduldiagram[warna][tabel][G]=0;
	$juduldiagram[warna][tabel][B]=0;
*/

//////////////////////////////

$xx=creatediagrambatang($datatabel,$data,$datanx,$datareal,$juduldiagram,$folder,$xx,$hr);
 	$kurva = "
		<image src='$folder"."$xx' >
	";
 
?>