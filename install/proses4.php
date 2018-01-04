<?php
periksaroot();

// Cek Koneksi Default Ke MySQL 


if ($_POST["aksi"]=="KEMBALI") {
  $statuskoneksi=0;
  $_POST["pilihan"]=1;
  $_POST["aksi"]="LANJUT";
}
if ($_POST["aksi"]=="INSTALL!") {
  $koneksi=@mysql_connect($_SESSION["host"],$_SESSION["user"],$_SESSION["password"]);
  $statuskoneksi=0; // Default Gagal
  if ($koneksi) {
    $statuskoneksi=1; // Berhasil
    include_once "install/globaloff.php";

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
    $mesgbasisdata="Basis data sudah ada. Gunakan Nama basis data yang lain.";
    $_POST["pilihan"]=1;
    $_POST["aksi"]="LANJUT";
    $_POST["asal"]="";
  } elseif ($statususer==0) {
    $mesguser="ID User MySQL sudah ada. Gunakan ID yang lain.";
    $_POST["pilihan"]=1;
    $_POST["aksi"]="LANJUT";
    $_POST["asal"]="";
  }  else {
    //$mesg="Koneksi berhasil.";

    $waktuawal=time();
		$status_instal_db=0;
		$status_instal_user=0;
		$status_instal_akses=0;
    // BUAT BASIS DATA
		doquery("CREATE database ".$_SESSION["basisdata"]."",$koneksi);
		if (sqlaffectedrows($koneksi)<=0) {
			$mesgbasisdata="Basisdata gagal dibuat";
 		} else {
			$mesgbasisdata="Basisdata berhasil dibuat</b>.";
  		$status_instal_db=1;
    }     
    // BUAT USER MYSQL
		mysql_select_db("mysql",$koneksi);
		doquery("INSERT INTO user (Host, User, Password) 
		values('".$_SESSION["host"]."', '".$_SESSION["user2"]."', password('".$_SESSION["password2"]."'))",$koneksi);
		if (sqlaffectedrows($koneksi)<=0) {
			$mesguser="ID User MySQL gagal dibuat. ";
 		} else {
			$mesguser="ID User MySQL berhasil dibuat. ";
  		$status_instal_user=1;
			// Buat Hak Akses

	    $insertsql  = "insert into db (Host, Db, User, Select_priv, 
	    Insert_priv, Update_priv, ";
	    $insertsql  .= "Delete_priv, Create_priv, Drop_priv,Alter_priv) ";
	    $insertsql  .= "values ('".$_SESSION["host"]."','".$_SESSION["basisdata"]."','".$_SESSION["user2"]."',
	    'Y','Y','Y','Y','Y','Y','Y')";
			
			doquery($insertsql,$koneksi);
			if (sqlaffectedrows($koneksi)<=0) {
				$mesguser.="Hak akses khusus basisdata gagal dibuat";
      } else {
				$mesguser.="Hak akses khusus basisdata berhasil dibuat";
				$status_instal_akses=1;
      }
			
     }
		$flush = mysql_query("FLUSH PRIVILEGES",$koneksi);

     if ($status_instal_akses==1 && $status_instal_db==1 && $status_instal_user==1) {
      // Masukkan Data     

        include "install/prosesdata.php";
     
     
     }


     // UNDO
     
     if ($status_instal_akses==0 || $status_instal_db==0 || $status_instal_user==0) {
      // Ada yg Gagal
      $mesghasil= "Instalasi basis data gagal dilakukan. Silakan ulangi proses instalasi atau hubungi Bantuan Teknis kami untuk melakuakn instalasi.";
      // UNDO
      // Hapus dulu Basis Data
		  doquery("DROP database ".$_SESSION["basisdata"]."",$koneksi);
  		mysql_select_db("mysql",$koneksi);
		  doquery("DELETE FROM user WHERE USER= '".$_SESSION["user2"]."' AND HOST='".$_SESSION["host"]."' ",$koneksi);
		  doquery("DELETE FROM db WHERE USER= '".$_SESSION["user2"]."' AND HOST='".$_SESSION["host"]."' AND DB='".$_SESSION["basisdata"]."' ",$koneksi);
      
      
     } else {
      //SUKSES
      
								    $isifile ="<?php 
                        \$".$var[host]." = '".$_SESSION["host"]."';
												\$".$var[login]." = '".$_SESSION["user2"]."';
												\$".$var[password]." = '".$_SESSION["password2"]."';
												\$".$var[db]." = '".$_SESSION["basisdata"]."'; ?>";
								
								    copy("$filedata", "copy - ".date("d-m-Y")." - $filedata");
                    $fp = fopen("$filedata",'w');
 								    $fw = fwrite($fp, $isifile);
								    fclose($fp);									
								    
        $mesghasil= "<p><b>SELAMAT</b>. Instalasi basis data berhasil dilakukan. Silakan gunakan program <a href='index.php'>di sini</a>. Untuk alasan keamanan dan menghindari instalasi dobel, lebih baik hapus file <b>install.php</b> dan folder <b>install</b>. Suteki tidak bertanggung jawab apabila Anda tidak menghapus dan kemudian ada pihak lain yang mengetahui password admin MySQL kemudian melakukan instalasi ulang.</p>";
        
        
     }
		$flush = mysql_query("FLUSH PRIVILEGES",$koneksi);
		
		$waktuakhir=time();


    echo "
    <h2>Hasil Instalasi</h2>
    $mesghasil
    ";
    print($mesg);

    echo "
    <table  border=1 width=95%>
       <tr class=datagenap>
        <td width=200>User Baru MySQL</td>
        <td><b> ".$_SESSION["user2"]." </td>
        <td> $mesguser </td>
      </tr>
      <tr class=dataganjil>
        <td>Password Baru MySQL</td>
        <td><b>".$_SESSION["password2"]."</td>
      </tr>
       <tr class=datagenap>
        <td>Nama Basis Data</td>
        <td><b>".$_SESSION["basisdata"]." </td>
        <td> $mesgbasisdata</td>
      </tr>
       <tr class=dataganjil>
        <td>Waktu Instalasi</td>
        <td>".($waktuakhir-$waktuawal)." detik</td>
        <td> </td>
      </tr>
     </table>
     ";
     // Langkah2:
     //1. Buat Database
     
     
         
  }
}

?>
