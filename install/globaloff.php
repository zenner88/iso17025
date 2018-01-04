<?php

unset($arraykataterlarang);
$arraykataterlarang[]="SELECT";
//$arraykataterlarang[]="INSERT";
//$arraykataterlarang[]="UPDATE";
$arraykataterlarang[]="DELETE";
$arraykataterlarang[]="GRANT";
$arraykataterlarang[]="DROP";
$arraykataterlarang[]="WHILE";
$arraykataterlarang[]="UNION";
$arraykataterlarang[]="TRUNCATE";

function mstr2_array($arrayinput) {

  foreach ($arrayinput as $k=>$v) {
    if (is_array($v)) {
      $hasil[$k]=mstr2_array($v);
    }  else {
      $hasil[$k]=mstr2($v);      
    }
  }
 return $hasil;
}

function mstr2($value) {
  global $arraykataterlarang;
  // PERIKSA KATA2 TERLARANG SEPERTI
  //  SELECT DROP UNION DELETE UPDATE GRANT INSERT WHILE
  $hasil=$value;
//  $hasil=htmlentities($value);
  foreach ($arraykataterlarang as $v) {
    $hasil=eregi_replace($v,"",$hasil);
  }
  ////////////////////////////////////////////////////
  // Periksa SCRIPT BAWAAN
  //////////////////////////////////////////////////
  if (get_magic_quotes_gpc()) {
    $hasil = stripslashes($hasil);
  }
  $hasil=mysql_real_escape_string($hasil);// Menghilangkan tanda petik
  $hasil=trim($hasil);

  return $hasil;
}

///////////////////////////////////////////////////////////
if (is_array($_GET)) {
  foreach ($_GET as $k=>$v) {
      if (is_array($v)) {
         ${$k}=mstr2_array($v); 
      } else {
         ${$k}=mstr2($v); 
      }
  }
}
if (is_array($_POST)) {
  foreach ($_POST as $k=>$v) {
      if (is_array($v)) {
         ${$k}=mstr2_array($v); 
      } else {
         ${$k}=mstr2($v); 
      }
  }
}
if (is_array($_COOKIE)) {
  foreach ($_COOKIE as $k=>$v) {
      if (is_array($v)) {
         ${$k}=mstr2_array($v); 
      } else {
         ${$k}=mstr2($v); 
      }
  }
}
if (is_array($_SERVER)) {
  foreach ($_SERVER as $k=>$v) {
    ${$k}=$v;
  }
}
if (is_array($_FILES)) {
  foreach ($_FILES as $k=>$v) {
 
    foreach ($v as $kk=>$vv) {
      $str=$k."_".$kk ;
      ${$str}=$vv;
       //echo "$k_$kk =>$vv <br>";
    }
    ${$k}=$v["tmp_name"];
   }
}
?>
