<?php
periksaroot();

// Cek Koneksi Default Ke MySQL 
if ($_POST[asal]==1) {
  $_SESSION["host"]="localhost";
  $_SESSION["user"]="root";
  $_SESSION["password"]="";
}


$koneksi=@mysql_connect($_SESSION["host"],$_SESSION["user"],$_SESSION["user"]);
$statuskoneksidefault=0; // Default Gagal
if ($koneksi) {
  $statuskoneksidefault=1; // Berhasil
}

if ($statuskoneksidefault==1) {
  $mesg="<p style='color:#FF0000;'>Koneksi default menggunakan user root tanpa password berhasil dilakukan. Server basis data Anda kurang aman karena user root pada server MySQL tidak memiliki password. Untuk meningkatkan keamanan data, Anda sebaiknya mengubah password root server MySQL. Namun proses instalasi masih tetap dapat Anda lakukan.</p>
  ";
} 
echo "

<div id=info>
<p>Selamat datang di proses Instalasi Basis Data program $namaprogram. Silakan ikuti instruksi di bawah untuk melakukan instalasi basis data. </p>

<p>Dalam melakukan instalasi, kami asumsikan Anda memiliki pengetahuan dasar tentang MySQL server. Apabila Anda tidak mengerti apa-apa, silakan minta didampingi oleh teman Anda yang lebih paham atau hubungi bantuan teknis di mana Anda memperoleh program ini.</p>

<p>Informasi yang Anda masukkan akan diolah secara lokal dan tidak akan disebarkan ke siapapun. 
</p>
</div>

<h2>LANGKAH 1. Login Administrator MySQL</h2>";
print($mesg);

echo "
 <form action=install.php method=POST>
<input type=hidden name=pilihan value=1>
<input type=hidden name=asal value=1>

<table  border=1 width=95%>
  <tr valign=top  class=datagenap>
    <td width=200>Komputer Host</td>
    <td><input type=text name='sqlhost' value='".$_SESSION["host"]."' size=20></td>
    <td>Lokasi/alamat komputer server MySQL. Biasanya sama dengan server web (localhost). Untuk kasus server data berbeda dengan server web, apabila ada masalah, lebih baik lakukan instalasi manual.</td>
  </tr>
  <tr valign=top  class=dataganjil>
    <td>User ID MySQL</td>
    <td><input type=text name='sqluser' value='".$_SESSION["user"]."' size=20></td>
    <td>User ID/Admin untuk koneksi ke server MySQL. Biasanya adalah root.</td>
  </tr>
  <tr  class=datagenap>
    <td>Password MySQL</td>
    <td><input type=password name='sqlpassword' value='".$_SESSION["password"]."' size=20></td>
    <td>Password untuk koneksi ke server MySQL</td>
  </tr>
  <tr   class=dataganjil>
    <td> </td>
    <td><input type=submit name='aksi' value='LANJUT'  ></td>
  </tr>
</table>
</form>
";

?>
