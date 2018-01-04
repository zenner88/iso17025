<?php

printjudulmenu("<b>ISI SURVEY ONLINE</b>");

$q="SELECT ID FROM minta WHERE STATUS=1 AND ID='$idupdate' AND IDKLIEN='$users'";
$h=doquery($q,$koneksi);
if (sqlnumrows($h)>0) {
  $q="SELECT ID FROM survey WHERE   ID='$idupdate'  ";
  $h=doquery($q,$koneksi);
  if (sqlnumrows($h)<=0) {
    if ($aksi=="Simpan") {
      $q="INSERT INTO survey (ID, NAMA,PERUSAHAAN, JAWAB1,JAWAB2,JAWAB3,JAWAB4,JAWAB5,JAWAB6,
      CATATAN,LASTUPDATE,UPDATER)
      VALUES
      ('$idupdate','$namasurvey','$perusahaansurvey',
      '$jawab[1]','$jawab[2]','$jawab[3]','$jawab[4]','$jawab[5]','$jawab[6]',
      '".str_replace("\\r\\n","\n",$saran)."',NOW(),'$users')";
      //echo $q;
      doquery($q,$koneksi);
      echo mysql_error();
      if (sqlaffectedrows($koneksi)>0) {
        echo "
        Terima kasih Anda telah mengisi survey online. Silakan melihat laporan hasil analisis di <a href='index.php?pilihan=laporanadm&aksi=Tampilkan&idupdate=$idupdate'>SINI</a>.
        ";
      } else {
        echo "
        Terima kasih. Anda sudah pernah mengisi survey online. Silaka melihat laporan hasil analisis di <a href='index.php?pilihan=laporanadm&aksi=Tampilkan&idupdate=$idupdate'>SINI</a>.
        ";
      
      }
    }
  
    if ($aksi=="Lanjutkan") {
    // PERIKSA BENAR TIDAK
    $mesg="";
    for ($i=1;$i<=6;$i++) {
      if ($jawab[$i]=="") {
        $mesg.="Jawaban No $i kosong.  Harus diisi.<br>";
      }
    }
    if (trim($saran)=="") {
      $mesg.="Saran dan Pendapat kosong. Harus diisi.<br>";
    }
    if (trim($namasurvey)=="") {
      $mesg.="Nama kosong. Harus diisi.<br>";
    }
    if (trim($perusahaansurvey)=="") {
      $mesg.="Perusahaan/Divisi kosong. Harus diisi.<br>";
    }
     
    if ($mesg!="") {
      $aksi="";
    } else {
    
    
    echo "
    <center><b>KONFIRMASI PENGISIAN SURVEY</b></center>
    <BR> 
    <form method=post action=index.php>
      <input type=hidden name=pilihan value='$pilihan'>
      <input type=hidden name=idupdate value='$idupdate'>
    <table width=100% border=1>";
    foreach ($arraysurvey as $k=>$v) {
      echo "
      <tr>
        <td rowspan=2 align=center width=30>$k.</td>
        <td>
        <b>$v[P]
        </td>
      </tr>
      <tr>
         <td>".$jawab[$k].". ".$v[J][$jawab[$k]]."
         <input type=hidden name='jawab[$k]' value='".$jawab[$k]."'>
         </td>
      </tr>
      
      
      ";
    }
    echo "
      <tr>
        <td></td>
        <td  >
        <b>Mohon berikan Saran dan Pendapat untuk peringatan pelayanan kami kedepan :</b>
        <br><br>".(nl2br(str_replace("\\r\\n","\n",$saran)))."
        <input type=hidden name=saran value='".str_replace("\\r\\n","\n",$saran)."'>
        </td>
      </tr>
      <tr>
        <td></td>
        <td  >
        <input type=hidden name=namasurvey value='$namasurvey'>
        <input type=hidden name=perusahaansurvey value='$perusahaansurvey'>
        <table>
          <tr>
            <td>
              <b>NAMA</td><td>: $namasurvey </td></tr>
          <tr>
            <td>
        <b>PERUSAHAAN/DIVISI</td><td>:  $perusahaansurvey </td></tr>
          </table>
         </td>
      </tr>
      <tr>
        <td></td>
        <td  >
        <input style='font-size:16pt;' type=submit name=aksi2 value=Kembali>
        <input style='font-size:16pt;' type=submit name=aksi value=Simpan>
         </td>
      </tr>
    
     </table>
     </form>
    ";
    }
    	
    }
    
    if ($aksi=="") {
    printmesg($mesg);
    echo "
    <form method=post action=index.php>
      <input type=hidden name=pilihan value='$pilihan'>
      <input type=hidden name=idupdate value='$idupdate'>
    <table width=100% border=1>";
    foreach ($arraysurvey as $k=>$v) {
      echo "
      <tr>
        <td rowspan=2 align=center width=30>$k.</td>
        <td>
        <b>$v[P]
        </td>
      </tr>
      <tr>
         <td>";
         foreach ($v[J] as $kk=>$vv) {
          $cek="";
          if ($jawab[$k]==$kk) {
            $cek="checked";
          }
          echo "<input $cek type=radio name='jawab[$k]' value='$kk'>$kk. $vv <br>";
         }
         echo "
         </td>
      </tr>
      
      
      ";
    }
    echo "
      <tr>
        <td></td>
        <td  >
        <b>Mohon berikan Saran dan Pendapat untuk peringatan pelayanan kami kedepan :</b>
        <textarea name=saran cols=60 rows=5>".str_replace("\\r\\n","\n",$saran)."</textarea>
        </td>
      </tr>

      <tr>
        <td></td>
        <td  >
        <table>
          <tr>
            <td>
              <b>NAMA</td><td>: <input type=text name=namasurvey size=50 value='$namasurvey'> </td></tr>
          <tr>
            <td>
        <b>PERUSAHAAN/DIVISI</td><td>:  <input type=text name=perusahaansurvey size=50 value='$perusahaansurvey'> </tr>
          </table>
         </td>
      </tr>

      <tr>
        <td></td>
        <td  >
        <input style='font-size:16pt;' type=submit name=aksi value=Lanjutkan>
         </td>
      </tr>
    
     </table>
     </form>
    ";
    
    }
  } else {
    printmesg("Pengisian survey untuk permintaan analisis dengan ID $idupdate sudah pernah dilakukan.
    <br> Silakan lihat hasil laporan <a href='index.php?pilihan=laporanadm&aksi=Tampilkan&idupdate=$idupdate'>di sini</a>");
  }

} else {
printmesg("Permintaan analisis dengan ID $idupdate tidak ada");
}
?>
