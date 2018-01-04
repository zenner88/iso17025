<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
include "init.php";

$idupdate=$idtrans;
   $q="SELECT  
    permintaan.ID FROM permintaan WHERE 
   	IDTRANS='$idupdate' AND permintaan.ID2='$id' ";
   $h=doquery($q,$koneksi) ;
  
  if (sqlnumrows($h)>0) {
      $d=sqlfetcharray($h);
     $idminta=$d[ID];
  }
 
	$q="SELECT NAMAFILEANALIS AS NAMAFILE,FILEANALIS AS FILE FROM filehasilanalis 
  WHERE ID='$idminta' AND IDTRANS='$idupdate'";
	$h=doquery($q,$koneksi);
  $d=sqlfetcharray($h);
  $namafile=$d[NAMAFILE];
  $file=$d[FILE];

if ($namafile!="" && strlen($file)>0) {
  $name=$namafile;
  if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
    $name = preg_replace('/\./', '%2e', $name, substr_count($name, '.') - 1);
    ini_set( 'zlib.output_compression','Off' );
  }
   header("Cache-Control: no-store, no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Pragma: no-cache");
  //Part2
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/force-download\n");
  header('Content-Disposition: attachment; filename="'.$name.'"');
//  header('Content-Length: '.filesize("$FOLDERFILEPESAN"."/$namafile"));

  echo $file; 
    
 exit;
       }  
   
?>
