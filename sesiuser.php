<?
  if (!($root=="../")) {
    $root="./";
  }

session_start();


// SCRIPT YANG DITAMBAHIN //

include $root."db.php";
$koneksi=@mysql_connect($hostsql,$loginsql,$passwordsql);
if (!$koneksi) {
	echo ("Error koneksi ke basis data. Periksa apakah server basis data telah dihidupkan.  Hubungi Administrator Anda");
	exit;
}
mysql_select_db($basisdatasql,$koneksi);


//if (ini_get('register_globals')==0) { //Register Global Off
  if (is_array($_SESSION)) {
     foreach ($_SESSION as $k=>$v) {
         ${$k}=$v;
        //echo "$k=>$v  <br>";
    }
  } 

  //if (is_array($_COOKIE)) {
  //   foreach ($_COOKIE as $k=>$v) {
  //       //${$k}=$v;
  //      echo "$k=>$v  <br>";
  //  }
  //}
 //echo session_id()."=".$_COOKIE["PHPSESSID"]; 
 //exit;
   
  include $root."globaloff.php";
//}
//exit;
// END SCRIPT YANG DITAMBAHIN //


if (
!(session_is_registered("users") && session_is_registered("namausers")
&& session_is_registered("URLS")
&& ereg($URLS,$SCRIPT_FILENAME) 
&& session_id()==$PHPSESSID
)
) {
//  		  $ketlog="Logout.";
//        buatlogiso(5,$ketlog,"",$users);

 	session_destroy();
	@mysql_close();Header("Location:".$root."index.php");
	exit;
}
if ($aksi=="logout") {
	//buatlog(10,$admin);
//	session_unregister("user");
//	session_unregister("namauser");



//	  $ketlog="Logout.";
 //   buatlogiso(5,$ketlog,"",$users);
	session_destroy();

	@mysql_close();Header("Location:".$root."index.php");
} 
session_regenerate_id();

?>
