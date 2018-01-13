<?php
if (empty($_POST["iduser"]) && empty($_POST["password"]) && empty($_POST['jenis'])) {
  header("Location: index.php");
} else {
  include 'db.php';
$username = mysql_escape_string($_POST["iduser"]);
$password = md5(mysql_escape_string($_POST["password"]));
$jenis = mysql_escape_string($_POST['jenis']);
if ($jenis==0) {
  $query = mysql_query("SELECT * FROM user WHERE NAMA='$username' AND PASSWORD='$password'");
  $baris=mysql_num_rows($query);
  $data=mysql_fetch_array($query);
  if ($baris > 0) {
    session_start();
    $users = $data['ID'];
    $namausers = $data['NAMA'];
    $tingkat = $data['TINGKAT'];
    $jenisusers =$jenis;
    $_SESSION["users"]=$users;
    $_SESSION["namausers"]=$namausers;
    $_SESSION["tingkats"]=$tingkat;
    $_SESSION["jenisusers"]=0;
    if ($tingkats=="A") {
          $go="operator";
        } else {
          $go="trans";
          header("Location: trans/index.php?pilihan=home");
        }
        
        exit;
  }
}
}



?>