<?PHP
date_default_timezone_set( "Asia/Jakarta" );
//periksaroot();
//////////////////////////////// Inisialisasi Program ////////////////////////////////
$CSS_IKON_FOLDER="css/ikon/";

if (isset($_GET["root"])!="") {
  $root="";
}
if ($_POST["root"]!="") {
  $root="";
}
unset($_GET["root"]); 
unset($_POST["root"]); 

unset($_GET["root"]); 
unset($_POST["root"]); 

////////////////

$namaserver="localhost";
$dirprogram="administrasi/";
$dirgambar=$root."gambar";

	include $root."db.php";
	$koneksi=@mysql_connect($hostsql,$loginsql,$passwordsql);
	if (!$koneksi) {
		echo ("Error koneksi ke basis data. Periksa apakah server basis data telah dihidupkan.  Hubungi Administrator Anda");
		exit;
	}
	mysql_select_db($basisdatasql,$koneksi);

//	include_once "antidos.php";


// SCRIPT YANG DITAMBAHIN //

//if (ini_get('register_globals')==0) { //Register Global Off
  include_once $root."globaloff.php"; 
  include_once $root."validasi.php"; 


	include $root."cadangan.php";
		
	include $root."man.inc";
	//include $root."style.inc";

	include $root."fungsi.php";

$KOTADEFAULT="BANDUNG";
$tahuninstal=2009;
$waktu=getdate(time());
$border="width=100% border=1 style='font-size:10pt;border-collapse:collapse;' ";
//$border="width=95% border=1 style='font-size:8pt;' ";
$maxrow=15;
$max=30;
$maxdata=20;


/////////////////////////////////////////////////////////////////////////////////////// 
// Silakan mengubah isian di bawah ini sesuai dengan keadaan kantor/Instansi Anda    //
///////////////////////////////////////////////////////////////////////////////////////

$judulprogram="Sistem Informasi Laboratorium Kimia";
$namakantor="PUSAT PENELITIAN KIMIA - LIPI";
$alamatkantor="Cisitu-Sangkuriang Bandung";

//////////////////////////////////////////////////////////////////
?>
