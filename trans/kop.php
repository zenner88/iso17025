<?php
if ($_SESSION[tingkats]!="B") {
    exit;
}


echo "
<script language='Javascript' type=\"text/javascript\">
 function daftarfont(pfld,pfltr) {
				 if (window.PsnList && window.PsnList.open && !window.PsnList.closed) {
				 		window.PsnList.close();
				 }
				 PsnList = window.open('../trans/font.php?pfld='+pfld+'&pfltr='+pfltr+'&pnama=A', 'List', 'width=500,height=600,scrollbars=yes');
}
</script>
";

    //echo "$aksi2 Wooi";

$d=getsettingkop();

if ($aksi=="simpan") {
  if ($_POST['sessid'] != $_SESSION['token'])
  {
  	$errmesg = token_err_mesg('Setting Kop',SIMPAN_DATA);
  } else{
 	$vldts[] = cekvaliditasfile('File Gambar Logo Kiri',$_FILES['filelogokiri'],0);
	$vldts[] = cekvaliditasfile('File Gambar Logo Kanan',$_FILES['filelogokanan'],0);
  	//$vldts[] = cekvaliditaskode('Latar Warna',$latarfoto,255,false);
	$vldts = array_filter($vldts,'filter_not_empty');
  	if(isset($vldts) && count($vldts) > 0)
  	{
  		$errmesg = val_err_mesg($vldts,2,SIMPAN_DATA);
  		unset($vldts);
  	}else{
  	
				if ($latarfoto!="") {
				    $ext=array_pop(explode('.', $latarfoto_name));
				    if (
              strtolower($ext)=="jpeg" || strtolower($ext)=="jpg" || strtolower($ext)=="gif" ||
              strtolower($ext)=="png" || strtolower($ext)=="bmp"
            ) {

  				    $qlatarfoto=", LATARFOTO='latarfoto.$ext' ";
  				    if ($d[LATARFOTO]!="") {
  				      @unlink("kartu/$d[LATARFOTO]");
  				    }
              move_uploaded_file($latarfoto,"kartu/latarfoto.$ext");
				    }    
    	  }

				if ($filelogokiri!="") {
				    $ext=array_pop(explode('.', $filelogokiri_name));
				    if (
              strtolower($ext)=="jpeg" || strtolower($ext)=="jpg" || strtolower($ext)=="gif" ||
              strtolower($ext)=="png" || strtolower($ext)=="bmp"
            ) {

  				    $qlogokiri=", LOGOKIRI='logokiri.$ext' ";
  				    if ($d[LOGOKIRI]!="") {
  				      @unlink("kartu/$d[LOGOKIRI]");
  				    }
              move_uploaded_file($filelogokiri,"kartu/logokiri.$ext");
				    }    
    	  }


				if ($filelogokiri2!="") {
				    $ext=array_pop(explode('.', $filelogokiri2_name));
				    if (
              strtolower($ext)=="jpeg" || strtolower($ext)=="jpg" || strtolower($ext)=="gif" ||
              strtolower($ext)=="png" || strtolower($ext)=="bmp"
            ) {

  				    $qlogokiri2=", LOGOKIRI2='logokiri2.$ext' ";
  				    if ($d[LOGOKIRI2]!="") {
  				      @unlink("kartu/$d[LOGOKIRI2]");
  				    }
              move_uploaded_file($filelogokiri2,"kartu/logokiri2.$ext");
				    }    
    	  }


				if ($filelogokanan!="") {
				    $ext=array_pop(explode('.', $filelogokanan_name));
				    if (
              strtolower($ext)=="jpeg" || strtolower($ext)=="jpg" || strtolower($ext)=="gif" ||
              strtolower($ext)=="png" || strtolower($ext)=="bmp"
            ) {

  				    $qlogokanan=", LOGOKANAN='logokanan.$ext' ";
  				    if ($d[LOGOKANAN]!="") {
  				      @unlink("kartu/$d[LOGOKANAN]");
  				    }
              move_uploaded_file($filelogokanan,"kartu/logokanan.$ext");
				    }    
    	  }

				if ($filelogokanan2!="") {
				    $ext=array_pop(explode('.', $filelogokanan2_name));
				    if (
              strtolower($ext)=="jpeg" || strtolower($ext)=="jpg" || strtolower($ext)=="gif" ||
              strtolower($ext)=="png" || strtolower($ext)=="bmp"
            ) {

  				    $qlogokanan2=", LOGOKANAN2='logokanan2.$ext' ";
  				    if ($d[LOGOKANAN2]!="") {
  				      @unlink("kartu/$d[LOGOKANAN2]");
  				    }
              move_uploaded_file($filelogokanan2,"kartu/logokanan2.$ext");
				    }    
    	  }


    	  $qdata="";
    	  if (is_array($datakartu)) {
    	     $qdata=", Data='";
    	     foreach ($datakartu as $k=>$v) {
    	       $qdata.="$v ";
           
           }
    	     $qdata.="'";
        }else {
          $qdata=", DATA=''  ";
        }
        //echo $qdata." ".$datakartu;  	  
  $q="UPDATE settingkop SET
     PANJANG='$panjang',LEBAR='$lebar',PANJANGF='$panjangf',LEBARF='$lebarf',ISFOTO='$isfoto',
     LATAR='$latar',LATARWARNA='$latarwarna',
     ISLOGOKIRI='$islogokiri',ISLOGOKANAN='$islogokanan',
     ISLOGOKIRI2='$islogokiri2',ISLOGOKANAN2='$islogokanan2',
     PLKIRI='$plkiri',LLKIRI='$llkiri',
     PLKANAN='$plkanan',LLKANAN='$llkanan',
     PLKIRI2='$plkiri2',LLKIRI2='$llkiri2',
     PLKANAN2='$plkanan2',LLKANAN2='$llkanan2',
     HEADER1='$header1',HEADER2='$header2',HEADER3='$header3',HEADER4='$header4',
     FHEADER1='$fheader1',FHEADER2='$fheader2',FHEADER3='$fheader3',FHEADER4='$fheader4',
     UHEADER1='$uheader1',UHEADER2='$uheader2',UHEADER3='$uheader3',UHEADER4='$uheader4',
     WHEADER1='$wheader1',WHEADER2='$wheader2',WHEADER3='$wheader3',WHEADER4='$wheader4',

     HEADER5='$header5',HEADER6='$header6',HEADER7='$header7',
     FHEADER5='$fheader5',FHEADER6='$fheader6',FHEADER7='$fheader7',
     UHEADER5='$uheader5',UHEADER6='$uheader6',UHEADER7='$uheader7',
     WHEADER5='$wheader5',WHEADER6='$wheader6',WHEADER7='$wheader7',


     ISBARCODE='$isbarcode',
     FDATA='$fdata',UDATA='$udata',WDATA='$wdata'

     
     $qlatarfoto
     $qlogokiri
     $qlogokanan
     $qlogokiri2
     $qlogokanan2
     $qdata
     
     ";
     
     doquery($q,$koneksi);
     echo mysql_error();
     if (sqlaffectedrows($koneksi)>0) {
  		  $ketlog="Simpan Setting Kop Surat.";
        buatlogiso(10,$ketlog,$q,$users);
      $errmesg="Data Setting Kop berhasil disimpan.";
     }
    }    
  }
}

printjudulmenu("Setting Kop Surat");
printmesg($errmesg);
$token = md5(uniqid(rand(),TRUE));
$_SESSION['token'] = $token;

$d=getsettingkop();


echo "
<form name=form action=index.php method=post ENCTYPE='MULTIPART/FORM-DATA'>
		<table class=form border=1>".
		createinputhidden("pilihan",$pilihan,"").
		createinputhidden("sessid",$_SESSION['token'],"").
		createinputhidden("aksi","simpan","")."


 

    <tr class=judulform valign=top>
			<td colspan=2><B>KOP di bawah ini akan muncul pada laporan2 yg dibuat, apabila pilihan Kop Surat dipilih saat pembuatan laporan2 tersebut.</td>
 		</tr>";
    $ceklogokiri="";
		if ($d[ISLOGOKIRI]==1) {
      $ceklogokiri="checked";
    }
    $ceklogokanan="";
		if ($d[ISLOGOKANAN]==1) {
      $ceklogokanan="checked";
    }

    $ceklogokiri2="";
		if ($d[ISLOGOKIRI2]==1) {
      $ceklogokiri2="checked";
    }
    $ceklogokanan2="";
		if ($d[ISLOGOKANAN2]==1) {
      $ceklogokanan2="checked";
    }


    echo "
    <tr class=judulform valign=top>
			<td  >Logo Kiri Ujung</td>
			<td> <input type=checkbox name=islogokiri value=1 $ceklogokiri> Tampilkan , File Gambar
			<input type=file name=filelogokiri class=masukan> 
      PxL=<input type=text name=plkiri value='$d[PLKIRI]' size=2>mm x <input type=text name=llkiri value='$d[LLKIRI]' size=2>mm";
    			if ($d[LOGOKIRI]!="" && file_exists("kartu/$d[LOGOKIRI]")) {
            echo "<br><img src='kartu/$d[LOGOKIRI]' style='width:$d[PLKIRI]mm;height:$d[LLKIRI]mm'>";
          }
      echo "
 			</td>
		</tr>


    <tr class=judulform valign=top>
			<td  >Logo Kiri Tengah</td>
			<td> <input type=checkbox name=islogokiri2 value=1 $ceklogokiri2> Tampilkan , File Gambar
			<input type=file name=filelogokiri2 class=masukan> 
      PxL=<input type=text name=plkiri2 value='$d[PLKIRI2]' size=2>mm x <input type=text name=llkiri2 value='$d[LLKIRI2]' size=2>mm";
    			if ($d[LOGOKIRI2]!="" && file_exists("kartu/$d[LOGOKIRI2]")) {
            echo "<br><img src='kartu/$d[LOGOKIRI2]' style='width:$d[PLKIRI2]mm;height:$d[LLKIRI2]mm'>";
          }
      echo "
 			</td>
		</tr>



    <tr class=judulform valign=top>
			<td  >Logo Kanan Ujung</td>
			<td> <input type=checkbox name=islogokanan value=1 $ceklogokanan> Tampilkan , File Gambar
			<input type=file name=filelogokanan class=masukan> 
      PxL=<input type=text name=plkanan value='$d[PLKANAN]' size=2>mm x <input type=text name=llkanan value='$d[LLKANAN]' size=2>mm";
    			if ($d[LOGOKANAN]!="" && file_exists("kartu/$d[LOGOKANAN]")) {
            echo "<br><img src='kartu/$d[LOGOKANAN]' style='width:$d[PLKANAN]mm;height:$d[LLKANAN]mm'>";
          }
      echo "
 			</td>
		</tr>

    <tr class=judulform valign=top>
			<td  >Logo Kanan Tengah</td>
			<td> <input type=checkbox name=islogokanan2 value=1 $ceklogokanan2> Tampilkan , File Gambar
			<input type=file name=filelogokanan2 class=masukan> 
      PxL=<input type=text name=plkanan2 value='$d[PLKANAN2]' size=2>mm x <input type=text name=llkanan2 value='$d[LLKANAN2]' size=2>mm";
    			if ($d[LOGOKANAN2]!="" && file_exists("kartu/$d[LOGOKANAN2]")) {
            echo "<br><img src='kartu/$d[LOGOKANAN2]' style='width:$d[PLKANAN2]mm;height:$d[LLKANAN2]mm'>";
          }
      echo "
 			</td>
		</tr>

    <tr class=judulform valign=top>
			<td  >Tulisan Header</td>
			<td nowrap>  
          Baris 1 <input type=text size=30 name=header1 value='$d[HEADER1]'>
			     Font 
 			     <input type=text size=10 name=fheader1 value='$d[FHEADER1]' style='font-family:$d[FHEADER1];font-size:12pt;'>
 			     			<a 
			href=\"javascript:daftarfont('form,wewenang,fheader1',
			document.form.fheader1.value)\" >
			daftar font,
			</a>
           Ukuran<input type=text size=2 name=uheader1 value='$d[UHEADER1]'>pt, 
           Warna           <select name=wheader1>";
                  foreach ($arraywarna as $k1=>$v1) {
                    foreach ($arraywarna as $k2=>$v2) {
                      foreach ($arraywarna as $k3=>$v3) {
                          $selected="";
                          if ("$v1$v1$v2$v2$v3$v3"=="$d[WHEADER1]") {
                            $selected="selected";
                          }
									       echo "<option $selected value='$v1$v1$v2$v2$v3$v3' style='background-color:#$v1$v1$v2$v2$v3$v3'>
                         $v1$v1$v2$v2$v3$v3
                         </option>";
                      }
                    }
                  }
          echo "
          </select>
        <br>
          Baris 2 <input type=text size=30 name=header2 value='$d[HEADER2]'>
			     Font 
 			     <input type=text size=10 name=fheader2 value='$d[FHEADER2]' style='font-family:$d[FHEADER2];font-size:12pt;'>
 			     			<a 
			href=\"javascript:daftarfont('form,wewenang,fheader2',
			document.form.fheader2.value)\" >
			daftar font,
			</a>
 
			     Ukuran<input type=text size=2 name=uheader2 value='$d[UHEADER2]'>pt, 
           Warna           <select name=wheader2>";
                  foreach ($arraywarna as $k1=>$v1) {
                    foreach ($arraywarna as $k2=>$v2) {
                      foreach ($arraywarna as $k3=>$v3) {
                          $selected="";
                          if ("$v1$v1$v2$v2$v3$v3"=="$d[WHEADER2]") {
                            $selected="selected";
                          }
									       echo "<option $selected value='$v1$v1$v2$v2$v3$v3' style='background-color:#$v1$v1$v2$v2$v3$v3'>
                         $v1$v1$v2$v2$v3$v3
                         </option>";
                      }
                    }
                  }
          echo "
          </select>
           
           <br>
          Baris 3 <input type=text size=30 name=header3 value='$d[HEADER3]'>
			     Font  
 			     <input type=text size=10 name=fheader3 value='$d[FHEADER3]' style='font-family:$d[FHEADER3];font-size:12pt;'>
 			     			<a 
			href=\"javascript:daftarfont('form,wewenang,fheader3',
			document.form.fheader3.value)\" >
			daftar font,
			</a>
 			     Ukuran<input type=text size=2 name=uheader3 value='$d[UHEADER3]'>pt, 
           Warna           <select name=wheader3>";
                  foreach ($arraywarna as $k1=>$v1) {
                    foreach ($arraywarna as $k2=>$v2) {
                      foreach ($arraywarna as $k3=>$v3) {
                          $selected="";
                          if ("$v1$v1$v2$v2$v3$v3"=="$d[WHEADER3]") {
                            $selected="selected";
                          }
									       echo "<option $selected value='$v1$v1$v2$v2$v3$v3' style='background-color:#$v1$v1$v2$v2$v3$v3'>
                         $v1$v1$v2$v2$v3$v3
                         </option>";
                      }
                    }
                  }
          echo "
          </select>";
          
          for ($ii=4;$ii<=7;$ii++) {
echo "
           <br>
          Baris $ii <input type=text size=30 name=header$ii value='".$d["HEADER$ii"]."'>
			     Font  
 			     <input type=text size=10 name=fheader$ii value='".$d["FHEADER$ii"]."' style='font-family:".$d["FHEADER$ii"].";font-size:12pt;'>
 			     			<a 
			href=\"javascript:daftarfont('form,wewenang,fheader$ii',
			document.form.fheader3.value)\" >
			daftar font,
			</a>
 			     Ukuran<input type=text size=2 name=uheader$ii value='".$d["UHEADER$ii"]."'>pt, 
           Warna           <select name=wheader$ii >";
                  foreach ($arraywarna as $k1=>$v1) {
                    foreach ($arraywarna as $k2=>$v2) {
                      foreach ($arraywarna as $k3=>$v3) {
                          $selected="";
                          if ("$v1$v1$v2$v2$v3$v3"==$d["WHEADER$ii"]) {
                            $selected="selected";
                          }
									       echo "<option $selected value='$v1$v1$v2$v2$v3$v3' style='background-color:#$v1$v1$v2$v2$v3$v3'>
                         $v1$v1$v2$v2$v3$v3
                         </option>";
                      }
                    }
                  }
          echo "
          </select>


";          
          
          }
          
          echo "
			     
  			</td>
		</tr>
     <tr class=judulform>
			<td></td>
			<td>
			<input type=submit  value=Simpan>
			</td>
		</tr>




 

    </table>
</form>
";

   
  echo "
  <br><br>
  <b><i>PREVIEW</i></b>
  <table  width=100%>
  <tr><td  >
  
  ";
     include "proseskop.php";
   echo "$tmpkop</td></tr></table>";
 
/*
<tr class=judulform>
			<td>Foto</td>
			<td>
			<input type=file name=foto class=masukan>
			</td>
		</tr>
*/

?>
