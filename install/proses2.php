<?php
periksaroot();

 
if ($_POST[asal]==1) {
  $_SESSION["user2"]="iso17025";
  $_SESSION["password2"]="rahasia";
  $_SESSION["basisdata"]="$namadbdefault";
}
if ($_POST["aksi"]=="LANJUT") {
  
  if ($_POST["asal"]==1) {
    $_SESSION["host"]=$_POST["sqlhost"];
    $_SESSION["user"]=$_POST["sqluser"];
    $_SESSION["password"]=$_POST["sqlpassword"];
  }
  $koneksi=@mysql_connect($_SESSION["host"],$_SESSION["user"],$_SESSION["password"]);
  $statuskoneksi=0; // Default Gagal
  if ($koneksi) {
    $statuskoneksi=1; // Berhasil
    include_once "install/globaloff.php";
  }

  if ($statuskoneksi==0) {
    $mesg="<p style='color:#FF0000;'>Koneksi ke server MySQL  gagal dilakukan. Mungkin passsword atau user ID yang Anda masukkan salah</b>";
    $_POST["pilihan"]="";
  } else {
    $mesg="
    <p>
    Koneksi ke server MySQL berhasil dilakukan. Silakan isi form di bawah ini untuk melanjutkan proses instalasi. 
    </p>
    ";
    echo "
    <h2>LANGKAH 2: Membuat User ID dan Basis data MySQL</h2>";

    print($mesg);

    echo "
     <form action=install.php method=POST>
    <input type=hidden name=pilihan value=2>
    <input type=hidden name=asal value=1>
    <table  border=1 width=95%>
       <tr valign=top class=datagenap>
        <td width=200>User Baru MySQL</td>
        <td><input type=text name='sqluser' value='".$_SESSION["user2"]."' size=20> </td>
        <td>User yg akan dibuat untuk mengakses basis data program $namaprogram. $mesguser</td>
      </tr>
      <tr valign=top class=dataganjil>
        <td>Password Baru MySQL</td>
        <td><input type=text name='sqlpassword' value='".$_SESSION["password2"]."' size=20></td>
        <td>Password untuk mengakses basis data program $namaprogram. Gunakan password yang unik dan sulit ditebak, biasakan untuk tidak menggunakan password default.</td>
      </tr>
       <tr valign=top class=datagenap>
        <td>Nama Basis Data</td>
        <td><input type=text name='sqlbasisdata' value='".$_SESSION["basisdata"]."' size=20> </td>
        <td>Nama basis data yang akan dibuat dan digunakan oleh program $namaprogram. $mesgbasisdata</td>
      </tr>
      <tr class=dataganjil>
        <td></td>
        <td nowrap><input type=submit name='aksi' value='KEMBALI'  > <input type=submit name='aksi' value='LANJUT'  ></td>
      </tr>
    </table>
    </form>
    ";
  }
}

?>
