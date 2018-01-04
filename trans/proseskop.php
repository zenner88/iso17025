<?
 unset($arraysort);
$arraysort[0]="mahasiswa.IDPRODI";
$arraysort[1]="mahasiswa.ANGKATAN";
$arraysort[2]="mahasiswa.ID";
$arraysort[3]="mahasiswa.NAMA";
$arraysort[4]="mahasiswa.STATUS";
$arraysort[5]="mahasiswa.IDDOSEN";

$konfigkartu=getsettingkop();

/*****Variabel inisiasi*****///
$gambarbackground="";
  
/////////////////////////////// 
 
 
 
	if ($konfigkartu[LATAR]==0) { // WARNA
      $bgkartu="background:#$konfigkartu[LATARWARNA];";
  } else { // FOTO
      $bgkartu="background:url(../trans/kartu/$konfigkartu[LATARFOTO]);background-repeat:no-repeat;background-position: center;";
  }


  		$tmpkop= "
		<table width=100% cellpadding=1 cellspacing=1>
		  <tr>";
      
      if ($konfigkartu[ISLOGOKIRI]==1 && $konfigkartu[LOGOKIRI]!=""&& file_exists("../trans/kartu/$konfigkartu[LOGOKIRI]")) {
        
        $tmpkop.= "
        <td align=left valign=top>
      		<img  src='../trans/kartu/$konfigkartu[LOGOKIRI]' style='width:$konfigkartu[PLKIRI]mm;height:$konfigkartu[LLKIRI]mm;' > 
        </td>
        ";
      
      }

      if ($konfigkartu[ISLOGOKIRI2]==1 && $konfigkartu[LOGOKIRI2]!=""&& file_exists("../trans/kartu/$konfigkartu[LOGOKIRI2]")) {
        
        $tmpkop.= "
        <td align=left valign=top>
      		<img  src='../trans/kartu/$konfigkartu[LOGOKIRI2]' style='width:$konfigkartu[PLKIRI2]mm;height:$konfigkartu[LLKIRI2]mm;' > 
        </td>
        ";
      
      }


      
      $tmpkop.= "
        <td nowrap align=center width=*  valign=top>
        <b>";
        
        if (trim($konfigkartu[HEADER1])!="") {
          $tmpkop.= "
		<font style='font-size:$konfigkartu[UHEADER1]pt;font-family:$konfigkartu[FHEADER1];color:#$konfigkartu[WHEADER1];'>
		$konfigkartu[HEADER1]<br></font> 
          ";
        }
        
         
        if (trim($konfigkartu[HEADER2])!="") {
          $tmpkop.= "
		<font style='font-size:$konfigkartu[UHEADER2]pt;font-family:$konfigkartu[FHEADER2];color:#$konfigkartu[WHEADER2];'>
		$konfigkartu[HEADER2]<br></font> 
          ";
        }
        if (trim($konfigkartu[HEADER3])!="") {
          $tmpkop.= "
		<font style='font-size:$konfigkartu[UHEADER3]pt;font-family:$konfigkartu[FHEADER3];color:#$konfigkartu[WHEADER3];'>
		$konfigkartu[HEADER3]<br></font> 
          ";
        }
        
        for ($ii=4;$ii<=7;$ii++) {

          if (trim($konfigkartu["HEADER$ii"])!="") {
            $tmpkop.= "
  		<font style='font-size:".$konfigkartu["UHEADER$ii"]."pt;font-family:".$konfigkartu["FHEADER$ii"].";color:#".$konfigkartu["WHEADER$ii"].";'>
  		".$konfigkartu["HEADER$ii"]."<br></font> 
            ";
          }
        
        }
        
        $tmpkop.= "
        </td>";
      

      if ($konfigkartu[ISLOGOKANAN2]==1 && $konfigkartu[LOGOKANAN2]!=""&& file_exists("../trans/kartu/$konfigkartu[LOGOKANAN2]")) {
        
        $tmpkop.= "
        <td align=right valign=top>
      		<img  src='../trans/kartu/$konfigkartu[LOGOKANAN2]' style='width:$konfigkartu[PLKANAN2]mm;height:$konfigkartu[LLKANAN2]mm;' > 
        </td>
        ";
      
      }


      if ($konfigkartu[ISLOGOKANAN]==1 && $konfigkartu[LOGOKANAN]!=""&& file_exists("../trans/kartu/$konfigkartu[LOGOKANAN]")) {
        
        $tmpkop.= "
        <td align=right valign=top>
      		<img  src='../trans/kartu/$konfigkartu[LOGOKANAN]' style='width:$konfigkartu[PLKANAN]mm;height:$konfigkartu[LLKANAN]mm;' > 
        </td>
        ";
      
      }
      
      $tmpkop.= "
      </tr>
		</table>
		<hr style='color:#000000;'>
 		 ";
   
?>
