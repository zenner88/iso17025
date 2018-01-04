<?php
periksaroot();

// Cek Koneksi Default Ke MySQL 

if ($_POST["aksi"]=="KEMBALI") {
  $statuskoneksi=0;
  $_POST["pilihan"]="";
  //$_POST["aksi"]="LANJUT";
}


if ($_POST["aksi"]=="LANJUT") {
  $koneksi=@mysql_connect($_SESSION["host"],$_SESSION["user"],$_SESSION["password"]);
  $statuskoneksi=0; // Default Gagal
  if ($koneksi) {
    $statuskoneksi=1; // Berhasil
    include_once "install/globaloff.php";

    $_SESSION["user2"]=$_POST["sqluser"];
    $_SESSION["password2"]=$_POST["sqlpassword"];
    $_SESSION["basisdata"]=$_POST["sqlbasisdata"];

  // Periksa Database
    $q="show databases";
    $h=doquery($q,$koneksi);
    $statusbasisdata=1; // OK, basis data belum ada
    if (sqlnumrows($h)>0) {
      while ($d=sqlfetcharray($h)) {
        //echo "$d[Database] <br>";
        if ($d[Database]==$_SESSION["basisdata"]) { 
          $statusbasisdata=0; // Error basis data sudah ada
          break;
        }
      }
    }  
  // Periksa User Baru
	 mysql_select_db("mysql",$koneksi);
   $q="SELECT user FROM user WHERE user='".$_SESSION["user2"]."'"; 
   $h=doquery($q,$koneksi);
   $statususer=1; // OK. user belum ada
   if (sqlnumrows($h)>0) { // Error User sudah ada
     $statususer=0; // Error. user sudah ada
   }
   
  }

  if ($statuskoneksi==0) {
    $mesg="Koneksi gagal.";
    $_POST["pilihan"]="";
  } elseif ($statusbasisdata==0) {
    $mesgbasisdata="<p style='color:#FF0000;'>Basis data sudah ada. Gunakan Nama basis data yang lain.</p>";
    $_POST["pilihan"]=1;
    $_POST["aksi"]="LANJUT";
    $_POST["asal"]="";
  } elseif ($statususer==0) {
    $mesguser="<p style='color:#FF0000;'>ID User MySQL sudah ada. Gunakan ID yang lain.</p>";
    $_POST["pilihan"]=1;
    $_POST["aksi"]="LANJUT";
    $_POST["asal"]="";
  } else {
    //$mesg="Koneksi berhasil.";
    echo "
    <h2>LANGKAH 3: Konfirmasi Instalasi</h2>";

    print($mesg);

    echo "
     <form action=install.php method=POST>
    <input type=hidden name=pilihan value=3>
    <table  border=1 width=95%>
       <tr class=datagenap>
        <td width=200> User Baru MySQL</td>
        <td><b> ".$_SESSION["user2"]." </td>
      </tr>
      <tr class=dataganjil>
        <td>Password Baru MySQL</td>
        <td><b>".$_SESSION["password2"]."</td>
      </tr>
       <tr class=datagenap>
        <td>Nama Basis Data</td>
        <td><b>".$_SESSION["basisdata"]."</td>
      </tr>
      <tr class=dataganjil>
        <td></td>
        <td>
        <p>Data di atas adalah data yang telah Anda isikan untuk melakukan instalasi basis data $namaprogram. Berikut ini adalah apa yang akan dilakukan oleh proses instalasi:
          <ul>
            <li>User MySQL dengan ID  '".$_SESSION["user2"]."' dan Password '".$_SESSION["password2"]."' akan dibuat      </li>
            <li>Basis data MySQL dengan nama  '".$_SESSION["basisdata"]."' akan dibuat      </li>
            <li>User MySQL dengan ID  '".$_SESSION["user2"]."' akan diberi hak untuk mengakses basis data '".$_SESSION["basisdata"]."'</li>
            <li>Data dasar untuk menggunakan $namaprogram akan diinstal ke dalam basis data '".$_SESSION["basisdata"]."'</li>
          </ul>
        
        Apabila Anda sudah yakin dengan data yg Anda masukkan di atas, silakan klik tombol INSTALL di bawah ini. Tidak akan ada data lama yang dihapus atau dirusak oleh proses ini.
        
        </p>
        <input type=submit name='aksi' value='KEMBALI'  > <input type=submit name='aksi' value='INSTALL!'  ></td>
      </tr>
    </table>
    </form>
    ";
  }
}

?>
