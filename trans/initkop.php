<?php
$arrayfont["Antiqua"]="Antiqua";
$arrayfont["Blackletter"]="Blackletter";
$arrayfont["Calibri"]="Calibri";
$arrayfont["Comic Sans"]="Comic Sans";
$arrayfont["Courier"]="Courier";
$arrayfont["Fraktur"]="Fraktur";
$arrayfont["Garamond"]="Garamond";
$arrayfont["Helvetica"]="Helvetica";
$arrayfont["Palatino"]="Palatino";
$arrayfont["Times"]="Times";

$arraywarna[0]="0";
//$arraywarna[1]="1";
//$arraywarna[2]="2";
$arraywarna[3]="3";
//$arraywarna[4]="4";
//$arraywarna[5]="5";
$arraywarna[6]="6";
//$arraywarna[7]="7";
//$arraywarna[8]="8";
$arraywarna[9]="9";
//$arraywarna[A]="A";
//$arraywarna[B]="B";
$arraywarna[C]="C";
//$arraywarna[D]="D";
//$arraywarna[E]="E";
$arraywarna[F]="F";

function getsettingkop() {
global $koneksi;

$q="SELECT * FROM settingkop";
$h=doquery($q,$koneksi);
if (sqlnumrows($h)<=0) {
  $q="
  INSERT INTO settingkartu 
  (PANJANG,LEBAR,ISFOTO,PANJANGF,LEBARF,LATAR,LATARWARNA,LATARFOTO,UPDATER,LASTUPDATE,
  ISLOGOKIRI,ISLOGOKANAN,LOGOKIRI,LOGOKANAN,ALOGOKIRI,ALOGOKANAN,PLKIRI,LLKIRI,PLKANAN,LLKANAN) 
  VALUES 
  (86,54,1,30,20,0,'FFFFFF','','sistem',NOW(),
  0,0,'','','','',0,0)
  ";
  doquery($q,$koneksi);
  
  $q="SELECT * FROM settingkartu";
  $h=doquery($q,$koneksi);
}

$d=sqlfetcharray($h);

return $d;
}

?>
