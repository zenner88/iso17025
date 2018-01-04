<?php

printjudulmenu("<b>SURVEY ONLINE</b>");

$q="SELECT ID FROM minta WHERE STATUS=1 AND ID='$idupdate' ";
$h=doquery($q,$koneksi);
if (sqlnumrows($h)>0) {
  $q="SELECT * FROM survey WHERE   ID='$idupdate'  ";
  $h=doquery($q,$koneksi);
  if (sqlnumrows($h)>0) {
   
     $d=sqlfetcharray($h);
    
    echo "
    <center><b>HASIL PENGISIAN SURVEY</b></center>
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
         <td>".$d["JAWAB$k"].". ".$v[J][$d["JAWAB$k"]]."
          </td>
      </tr>
      
      
      ";
    }
    echo "
      <tr>
        <td></td>
        <td  >
        <b>Mohon berikan Saran dan Pendapat untuk peringatan pelayanan kami kedepan :</b>
        <br><br>".(nl2br(str_replace("\\r\\n","\n",$d[CATATAN])))."
         </td>
      </tr>
      <tr>
        <td></td>
        <td  >
         <table>
          <tr>
            <td>
              <b>NAMA</td><td>: $d[NAMA] </td></tr>
          <tr>
            <td>
        <b>PERUSAHAAN/DIVISI</td><td>:  $d[PERUSAHAAN] </td></tr>
          </table>
         </td>
      </tr>
      <tr>
        <td></td>
        <td  >
         <table>
          <tr>
            <td>
              <b>ID PERMINTAAN</td><td>: $d[ID] </td></tr>
          <tr>
          <tr>
            <td>
              <b>ID PENGISI</td><td>: $d[UPDATER] </td></tr>
          <tr>
            <td>
        <b>WAKTU PENGISIAN</td><td>:  $d[LASTUPDATE] </td></tr>
          </table>
         </td>
      </tr>
     
     </table>
     </form>
    ";
     
   } else {
    printmesg("Pengisian survey untuk permintaan analisis dengan ID $idupdate belum dilakukan.");
  }

} else {
printmesg("Permintaan analisis dengan ID $idupdate tidak ada");
}
?>
