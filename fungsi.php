<?php
include $root."statistik.php";

function printhtmlcetak(){	
	global $root;
	include $root."css/style.inc";
	echo "
	<html>
		<head>
			$style
		</head>
		<body class=cetak>
 	";

}

function createform($nama,$metod,$action,$attr) {
	$tmp="
		<form method='$metod' name='$nama' action='$action' $attr>
			<--isi-->
		</form>
	";
	return $tmp;
}
 
function createinputtext($nama,$value,$attr) {
	$tmp ="
		<input type=text name='$nama' value='$value' $attr>
	";
	return $tmp;
}

function createinputtextarea($nama,$value,$attr) {
	$tmp ="
		<textarea name='$nama'  $attr>$value</textarea>
	";
	return $tmp;
}

function createinputpassword($nama,$value,$attr) {
	$tmp ="
		<input type=password name='$nama' value='$value' $attr>
	";
	return $tmp;
}

function createinputcek($nama,$value,$ket,$cek,$attr) {
	$tmp ="
		<input type=checkbox name='$nama' $cek value='$value' $attr>$ket
	";
	return $tmp;
}
function createinputcekarray($nama,$tabelvalue,$tabelkey,$attr) {
		foreach ($tabelvalue as $k=>$v) {
			if (@in_array($k,$tabelkey)) {
				$cek="checked";
			}
			$tmp.= "
			<input name=$nama"."[$k] type=checkbox value='$k' $cek $attr>$v</option><br>
			";
			$cek="";
		}
	return $tmp;
}

function createinputradio($nama,$value,$ket,$cek,$attr) {
	$tmp ="
		<input type=radio name='$nama' $cek value='$value' $attr>$ket
	";
	return $tmp;
}
function createinputradioarray($nama,$tabelvalue,$key,$attr) {
		foreach ($tabelvalue as $k=>$v) {
			if ($k==$key) {
				$cek="checked";
			}
			$tmp.= "
			<input name='$nama' type=radio value='$k' $cek $attr>$v</option><br>
			";
			$cek="";
		}
	return $tmp;
}

function createinputselect($nama,$tabelvalue,$key,$multiple,$attr) {
	$tmp ="
		<select name='$nama' $attr $multiple>";
		foreach ($tabelvalue as $k=>$v) {
			if ($key==$k && trim($multiple)!="multiple") {
				$cek="selected";
			} elseif ((@in_array($k,$key) && trim($multiple)=="multiple")) {
				$cek="selected";
			}
			$tmp.= "
			<option value='$k' $cek>$v</option>
			";
			$cek="";
		}
	$tmp.="
		</select>
	";
	return $tmp;
}
function createinputtanggalblank($nama,$value,$attr) {
	global $arraybulan;
	$waktu=getdate();
	$tmp ="
		<select name='".$nama."[tgl]' $attr>
		<option value='' >tgl</option>
		";
		for ($i=1;$i<=31;$i++) {
			if ($value[tgl]==$i && $value[tgl]!="") {
				$cek="selected";
			} 
			$tmp.= "
			<option value='$i' $cek>$i</option>
			";
			$cek="";
		}
	$tmp.="
		</select>
	";
	$tmp .="
		<select name='".$nama."[bln]' $attr>
		<option value='' >bln</option>
		";
		for ($i=1;$i<=12;$i++) {
			if ($value[bln]==$i && $value[bln]!="") {
				$cek="selected";
			}  
			$tmp.= "
			<option value='$i' $cek>".$arraybulan[($i-1)]."</option>
			";
			$cek="";
		}
	$tmp.="
		</select>
	";
	$tmp .="
		<select name='".$nama."[thn]' $attr>
		<option value='' >thn</option>
		";
		for ($i=1900;$i<=$waktu[year]+5;$i++) {
			if ($value[thn]==$i && $value[thn]!="") {
				$cek="selected";
			}  
			$tmp.= "
			<option value='$i' $cek>$i</option>
			";
			$cek="";
		}
	$tmp.="
		</select>
	";
	return $tmp;
}

function createinputbulantahun($nama,$value,$attr) {
	global $arraybulan;
	$waktu=getdate();
	$tmp ="
		<select name='".$nama."[bln]' $attr>
 		";
		for ($i=1;$i<=12;$i++) {
			if ($value[bln]==$i && $value[bln]!="") {
				$cek="selected";
			} else 
			if ($waktu[mon]==$i && $value[bln]=="") {
				$cek="selected";
			}
			$tmp.= "
			<option value='$i' $cek>".$arraybulan[($i-1)]."</option>
			";
			$cek="";
		}
	$tmp.="
		</select>
	";
	$tmp .="
		<select name='".$nama."[thn]' $attr>
 		";
		for ($i=1900;$i<=$waktu[year]+5;$i++) {
			if ($value[thn]==$i && $value[thn]!="") {
				$cek="selected";
			} else 
			if ($waktu[year]==$i && $value[thn]=="") {
				$cek="selected";
			}
			$tmp.= "
			<option value='$i' $cek>$i</option>
			";
			$cek="";
		}
	$tmp.="
		</select>
	";
	return $tmp;
}


function createinputtanggal($nama,$value,$attr) {
	global $arraybulan;
	$waktu=getdate();
	$tmp ="
		<select name='".$nama."[tgl]' $attr>
 		";
		for ($i=1;$i<=31;$i++) {
			if ($value[tgl]==$i && $value[tgl]!="") {
				$cek="selected";
			}else if ($waktu[mday]==$i && $value[tgl]=="") {
				$cek="selected";
			}
			$tmp.= "
			<option value='$i' $cek>$i</option>
			";
			$cek="";
		}
	$tmp.="
		</select>
	";
	$tmp .="
		<select name='".$nama."[bln]' $attr>
 		";
		for ($i=1;$i<=12;$i++) {
			if ($value[bln]==$i && $value[bln]!="") {
				$cek="selected";
			} else 
			if ($waktu[mon]==$i && $value[bln]=="") {
				$cek="selected";
			}
			$tmp.= "
			<option value='$i' $cek>".$arraybulan[($i-1)]."</option>
			";
			$cek="";
		}
	$tmp.="
		</select>
	";
	$tmp .="
		<select name='".$nama."[thn]' $attr>
 		";
		for ($i=1900;$i<=$waktu[year]+5;$i++) {
			if ($value[thn]==$i && $value[thn]!="") {
				$cek="selected";
			} else 
			if ($waktu[year]==$i && $value[thn]=="") {
				$cek="selected";
			}
			$tmp.= "
			<option value='$i' $cek>$i</option>
			";
			$cek="";
		}
	$tmp.="
		</select>
	";
	return $tmp;
}

function createinputtahun($nama,$value,$attr) {
	global $arraybulan;
	$waktu=getdate();
	$tmp .="
		<select name='".$nama."' $attr>";
		for ($i=1900;$i<=$waktu[year]+5;$i++) {
			if ($value==$i && $value!="") {
				$cek="selected";
			} else 
			if ($waktu[year]==$i && $value=="") {
				$cek="selected";
			}
			$tmp.= "
			<option value='$i' $cek>$i</option>
			";
			$cek="";
		}
	$tmp.="
		</select>
	";
	return $tmp;
}


function getbiaya($id){
  global $koneksi;
  $q="SELECT NILAI FROM biaya WHERE ID='$id'" ;
  $h=doquery($q,$koneksi);
   $d=sqlfetcharray($h);
  $hasil=$d[NILAI];
  return $hasil;
  
}


function strtokimia($str) {

  $count=strlen($str);
  $hasil="";
  $last="";
  $startatas=0;
  for ($i=0;$i<$count;$i++) {
    if (is_numeric($str[$i]) && $startatas!=1) {
        $hasil.="<sub>".$str[$i]."</sub>";
    } else if ($str[$i]=="(" || $startatas==1) {
        if ($str[$i]=="(") {
          $hasil.="<sup>".$str[$i];
        } else {
          $hasil.=$str[$i];
        }
        $startatas=1;
    } else if ($str[$i]==")") {
           $hasil.=$str[$i]."</sup>";
           $startatas=0;
    } else {
      $hasil.=$str[$i];
    }
    $last=$str[$i];
  }
  return $hasil;
}


function createinputhidden($nama,$value,$attr) {
	$tmp ="
		<input type=hidden name='$nama' value='$value' $attr>
	";
	return $tmp;
}



function getnilaibaku($id){
  global $koneksi;
  $q="SELECT NILAI FROM nilaibaku WHERE ID='$id'" ;
  $h=doquery($q,$koneksi);
   $d=sqlfetcharray($h);
  $hasil=$d[NILAI];
  return $hasil;
  
}

function getidjenisujibaru() {
  global $koneksi;
  $q="SELECT MAX(ID)+0 AS JML FROM jenisuji" ;
  $h=doquery($q,$koneksi);
  $d=sqlfetcharray($h);
  $hasil=$d[JML]+1;
  return $hasil;
}

function tekstorumus($s) {
	$tmp=explode(";",$s);
	foreach ($tmp as $v) {
		$tmp2=explode("=",$v);
		$var=trim($tmp2[0]);
		$val=trim($tmp2[1]);
		$rumus[$var]=$val;
	}
	return $rumus;
}


function parse_rumus($rumus) {


  $proses_operator=0; // 
  $open_bracket=0;
  $arrayrumus= array();
  $count=strlen($rumus);
  $ii=$i=0;
  $var="";
  $lasttoken="";
  while ($i<$count) {
    $char = $rumus[$i];
    if (!ereg("[ \s]",$char)) {
      $ii++;
       //echo $char;
       
       if ($char=="(") { // BUKA
          $proses_operator=1; // 
          $open_bracket++;
          @array_push($arrayrumus,$char);
          $i++;
          $var="";
          $lasttoken=$char;
       } elseif ($char==")") { //TUTUP
          $proses_operator=1; // 
          @array_push($arrayrumus,$char);
          $i++;
          $var="";
          $open_bracket--;
          $lasttoken=$char;
       } elseif ($char=="*") { //OPERATOR
          $proses_operator=1; // 
          @array_push($arrayrumus,$char);
          $i++;
          $var="";
          $lasttoken=$char;
       } elseif ($char=="/") { //OPERATOR
          $proses_operator=1; // 
          @array_push($arrayrumus,$char);
          $i++;
          $var="";
          $lasttoken=$char;
       } elseif ($char=="+") { //OPERATOR
          $proses_operator=1; // 
          @array_push($arrayrumus,$char);
          $i++;
          $var="";
       } elseif ($char=="-") { //OPERATOR
          $proses_operator=1; // 
          @array_push($arrayrumus,$char);
          $i++;
          $var="";
          $lasttoken=$char;
       } elseif (ereg("[a-zA-Z0-9.]",$char)) { //VARIABEL
       
           $proses_operator=0; // 
          $var=$char;
          while ($proses_operator==0) {
            $i++;
            $char=$rumus[$i];
            if (ereg("[a-zA-Z0-9.]",$char)) { // VARIABEL
              $var.=$char;
            } else {
              
              array_push($arrayrumus,$var);
              $proses_operator=1; // 
            }
          }
          $lasttoken=$var;
        }  else {
          return -1; // BUKAN VARIABEL
        }
       
    } else { // SKIP WHITE SPACE
      $proses_operator=-1; // 
      $i++;
    }
  }
  if ($open_bracket!=0) {
    //echo $open_bracket;
    return -2; // BRACKET TIDAK IMBANG
  }
   return $arrayrumus;
}

function rumustohasil($rumus,$data=array()) {
  $arrayopr = array ('*','/','+','-');
  $arrayrumustmp=parse_rumus($rumus);
   
  if (!is_array($arrayrumustmp)) {
    return "RUMUS ERROR";
  } else {
  
  // REPLACE VARIABEL DGN NILAI
  unset($arrayrumus);
  foreach ($arrayrumustmp as $k=>$v) {
    if (ereg("[a-zA-Z]","$v")) {
      $arrayrumus[]=$data["$v"];
    } else {  
      $arrayrumus[]=$v;
    }
  }
  
  $stack=array();
  $stacktmp=array();
  $hasil=$tmphasil=0;
  foreach ($arrayrumus as $k=>$v) {
    //echo "$k=>$v <br>";
    
    if ($v=="(") { // BUKA
       @array_push($stack,$v);
    } elseif ($v==")") { // TUTUP
      $tmphasil=0;
      unset($stacktmp);
      $stacktmp=array();
      $tmp=array_pop($stack);
      while ($tmp!="" && $tmp!="(") {
        //$stacktmp[]=$tmp;
        array_push($stacktmp,$tmp);
        
         
        $tmp=array_pop($stack);
       } 
   
  
      $tmp=array_pop($stacktmp);
       $tmphasil=$tmp;
       $operator="";
       while ($tmp!="") {
   
         if (in_array($tmp,$arrayopr)) {
           $operator=$tmp;
          } else {
          if ($operator=='*') { //KALI
            $tmphasil*=$tmp;
          } elseif ($operator=='/') { //KALI
            if ($tmp==0) {
              return "Error, pembagian dgn nol (0)";
            }
            $tmphasil/=$tmp;
          } elseif ($operator=='+') { //KALI
            $tmphasil+=$tmp;
          } elseif ($operator=='-') { //KALI
            $tmphasil-=$tmp;
          }
         }
         $tmp=array_pop($stacktmp);
       } 
    
       array_push($stack,$tmphasil);
      
        
    } elseif (in_array($v,$arrayopr)) { // OPERATOR
       @array_push($stack,$v);
    } else { //  VARIABEL/ANGKA
       @array_push($stack,$v);
    }
  }
  
  
   //echo "<br>";
  //echo $hasil;
         $tmphasil=0;
       $operator="";
       foreach ($stack as $tmp) {
   
         if (in_array($tmp,$arrayopr)) {
           $operator=$tmp;
          } else {
          if ($operator=='*') { //KALI
            $tmphasil*=$tmp;
          } elseif ($operator=='/') { //BAGI
            if ($tmp==0) {
              return "Error, pembagian dgn nol (0)";
            }
            $tmphasil/=$tmp;
          } elseif ($operator=='+') { //KALI
            $tmphasil+=$tmp;
          } elseif ($operator=='-') { //KALI
            $tmphasil-=$tmp;
          } else {
            $tmphasil=$tmp;
          }
         }
         $tmp=array_pop($stacktmp);
       } 


  return $tmphasil;
}

}


/*

function rumustohasil($rumus,$data) {
	$hasil=0;
	$rumusuji=str_replace(" ","",trim($rumus));
	$count=strlen($rumusuji);
	unset($stak);
	$i=0;
	$karprev=$rumusuji[$i];
	$tmp=0;
 
	for ($i=0;$i<$count;$i++) {
			$kar=$rumusuji[$i];
			if ($kar=="(" ) { // PUSH
					$stak[]=$kar;
			} elseif ($kar==")" ) { // POP
				unset($array2);
				$tmp=0;
				$karpop=array_pop($stak);
				while ($karpop!="(" && $karpop!="") {
					$array2[]=$karpop;
					$karpop=array_pop($stak);
				}
				@krsort($array2);
				if ($karpop=="(") { //STOP
/////////////////////
							if (is_array($array2)) {
									$tmp2=0;
									$lastkar2="";
									foreach ($array2 as $k=>$kar2) {
										if ($kar2=="+" || $kar2=="-" || $kar2=="*" || $kar2=="/" ) {
											 $lastkar2=$kar2;
										} else {
						 						$tmp2=$kar2;
												if ($lastkar2=="+") {
														$tmp+=$tmp2;
												} else if ($lastkar2=="-") {
														$tmp-=$tmp2;
												} else if ($lastkar2=="*") {
														$tmp*=$tmp2;
												} else if($lastkar2=="/") {
														if ($tmp2==0) {
															$hasil="Error: Pembagian dengan nilai 0";
															return $hasil;
														} else {
															$tmp= $tmp/$tmp2 ;
														}
												} else {
													$tmp=$kar2;
												}
										}
						 			}
						
							}

////////////////////					
					$stak[]=$tmp;
				} else if ($karpop=="") {
					break;
				}
				
			} elseif ($kar=="+" || $kar=="-" || $kar=="*" || $kar=="/" ) {
 					$stak[]=$kar;
			} else {// Variabel
 					$stak[]=$data[$kar];
 			}
			$karprev=$rumusuji[$i];
		 
	}

	if (is_array($stak)) {
			$tmp=0;
			$lastkar="";
			foreach ($stak as $k=>$kar) {
				 
 				if (($kar=="+" || $kar=="-" || $kar=="*" || $kar=="/") && $kar!="") {
					  $lastkar=$kar;
				} else {
 							$tmp=$kar;
						if ($lastkar=="+") {
								$hasil+=$tmp;
						} else if ($lastkar=="-") {
								$hasil-=$tmp;
						} else if ($lastkar=="*") {
								$hasil*=$tmp;
						} else if($lastkar=="/") {
				 
								if ($tmp!=0) {
									$hasil= $hasil/$tmp ;
								} else {
									$hasil="Error: Pembagian dengan nilai 0";
									return $hasil;
								}
						} else {
							$hasil=$kar;
						}
				}
 			}

	}
	return $hasil;
}

*/

function hasilanalis($rumus,$jenis) {
	global $arrayanalisisrumus;
	//$hasil=0;
	if ($jenis==0) { ////////////// Kadar Air
		if ($rumus[b]-$rumus[a]!=0) {
			$hasil=100*(($rumus[b]-$rumus[a])-($rumus[c]-$rumus[a]))/($rumus[b]-$rumus[a]);
		} else {
			$hasil="Error: Berat contoh (b - a) = 0";
		}
	} else
	if ($jenis==1) { ////////////// Kadar Protein
		if ($rumus[bc]!=0 && $rumus[volp]!=0) {
			$hasil[0]=100*$rumus[vold]*14*$rumus[hcl]*$rumus[nhcl]/($rumus[bc]*$rumus[volp]);
			$hasil[1]=$hasil[0]*$rumus[F];
		} else {
			$hasil[0]="Error: Berat contoh  = 0 atau Vol. Larutan yang dipipet = 0";
		}
	} 
	else if ($jenis==2) { ////////////// Kadar Lemak 
		if ($rumus[B]-$rumus[A]!=0) {
			$hasil=100*(($rumus[D]-$rumus[C])/($rumus[B]-$rumus[A])); 
		} else {
			$hasil="Error: Berat contoh ( B - A ) = 0";
		}
	} 
	else if ($jenis==3) { ////////////// Kadar Abu
		if ($rumus[B]-$rumus[A]!=0) {
			$hasil=100*(($rumus[C]-$rumus[A])/($rumus[B]-$rumus[A])); 
		} else {
			$hasil="Error: Berat contoh ( B - A ) = 0";
		}
	} 
	else if ($jenis==4) { ////////////// Kadar Mineral
		if ($rumus[a]!=0) {
			$hasil=100*(50*$rumus[b]*$rumus[c])/($rumus[a]*1000000); 
		} else {
			$hasil="Error: Berat contoh  = 0";
		}
	} 
	else if ($jenis==5) { ////////////// Kadar Serat
		if ($rumus[a]!=0) {
			$hasil[0]=($rumus[d]-($rumus[b]+$rumus[c]+$rumus[e])); 
			$hasil[1]=100*$hasil[0]/$rumus[a];
		} else {
			$hasil[0]="Error: Berat contoh  (A) = 0";
		}
	} 
	else if ($jenis==6) { ////////////// Kadar KH
		if ($rumus[b]!=0 && $rumus[c]!=0) {
 			$hasil=100*($rumus[pl]*$rumus[a]*$rumus[d])/($rumus[b]*$rumus[c]); 
 		} else {
			$hasil="Error: Volume contoh (b) atau Berat contoh (c) = 0";
		}
	} 
	else if ($jenis==7) { ////////////// Kadar Gula Pereduksi
		if ($rumus[b]!=0 && $rumus[c]!=0 && $rumus[f]!=0) {
			 $hasil=100*($rumus[pl]*$rumus[a]*$rumus[d])/($rumus[b]*$rumus[c]); 
		} else {
			$hasil="Error: b atau c atau f = 0";
		}
	} 
	else if ($jenis==8) { ////////////// Kadar Gula Total
		if ($rumus[b]!=0 && $rumus[c]!=0) {
			$hasil=100*(100*$rumus[a]*($rumus[e]/$rumus[f]))/($rumus[b]*$rumus[c]); 
		} else {
			$hasil="Error: b atau c = 0";
		}
	} 
	else if ($jenis==9) { ////////////// Kadar Klor
		if ($rumus[b]!=0 && $rumus[f]!=0) {
			$hasil=100*(($rumus[a]/$rumus[b])*$rumus[c]*$rumus[d]*$rumus[e])/($rumus[f]); 
		} else {
			$hasil="Error: b atau f = 0";
		}
	} 
	else if ($jenis>=10 && $jenis<=16) { ////////////// Kadar Cd, Pb, Cr, Zn, Cu, Fe, Hg dgn AAS
		if ($rumus[bc]!=0) {
			$hasil=($rumus[b]*$rumus[c]*$rumus[v])/($rumus[bc]); 
		} else {
			$hasil="Error: Berat contoh = 0";
		}
	} 
	else if ($jenis>=17 && $jenis<=23) { ////////////// Kadar Cd, Pb, Cr, Zn, Cu, Fe, Mn+ dgn Ekstraksi
		if ($rumus[v]!=0) {
			$hasil=($rumus[b]*$rumus[c])/($rumus[v]); 
		} else {
			$hasil="Error: Volume MIBK = 0";
		}
	} 
	
if ($jenis > 30 ) {
		$hasil=rumustohasil($arrayanalisisrumus[$jenis],$rumus);
		
}
	return $hasil;
}

////////////////////////////////////////////////////////////////////////////
function buatsatuan($str) {
	$count=strlen($str);
	$tmp="";
	for ($i=0;$i<$count;$i++) {
		if (ereg("[0-9]",$str[$i])) {
			$tmp.="<sup>".$str[$i]."</sup>";
		} else {
			$tmp.=$str[$i];
		}
	}
	return $tmp;
}

function printhtml(){
	global $style;
	echo "
	<html>
		<head>
			$style
		</head>
		<body style='background-color: #ffffff; '>
 	";

}
function printjudulmenukecil($judul) {
	echo "
	<p>
	<table class=judulmenukecil>
		<tr align=left>
			<td>
		 
			$judul
	 
			</td>
		</tr>
	</table>
	</p>
	";
}
function printjudulmenu($judul) {
	echo "
	<br>
	<table class=judulmenu >
		<tr align=center>
			<td class=judulmenu>
		 
			$judul
	 
			</td>
		</tr>
	</table>
 	<br>
	";
}


function getnewid($tabel) {
	global $koneksi;
	$q="SELECT MAX(ID)+1 AS IDBARU FROM $tabel";
	$h=doquery($q,$koneksi);
	if (sqlnumrows($h)>0) {
		$d=sqlfetcharray($h) ;
		$idbaru=$d[IDBARU];
		if ($idbaru=="") {
			$idbaru=1;
		}
	}
	
	return $idbaru;
	
}
function getnewidsyarat($field,$tabel,$where) {
	global $koneksi;
	 $q="SELECT MAX($field)+1 AS IDBARU FROM $tabel $where";
	$h=doquery($q,$koneksi);
	//echo mysql_error();
	$idbaru=0;
	if (sqlnumrows($h)>0) {
		$d=sqlfetcharray($h) ;
		$idbaru=$d[IDBARU];
	}
	
	return $idbaru;
	
}
function isadabawah($id) {
	global $koneksi;
	$q="SELECT COUNT(ID) AS JML FROM akun WHERE SUBID='$id'";
	$h=doquery($q,$koneksi);
	$d=sqlfetcharray($h);
	//echo $d[JML];
	$hasil=false;
	if ($d[JML]>0) {
		$hasil = true;
	} 
	return $hasil;
}
function isadaatas($id,$idbawah) {
	global $koneksi;
	$hasil=false;

	$q="SELECT SUBID FROM akun WHERE ID='$idbawah' ";
	$h=doquery($q,$koneksi);
	if (sqlnumrows($h)>0) {
		$d=sqlfetcharray($h);
	}
	if ($d[SUBID]!=$id) {
		while ($d[SUBID]!=$id && $d[SUBID]!="") {
			$q="SELECT SUBID FROM akun WHERE ID='$d[SUBID]' ";
			$h=doquery($q,$koneksi);
			if (sqlnumrows($h)>0) {
				$d=sqlfetcharray($h);
			}
		}
		if ($d[SUBID]==$id) {
			$hasil=true;
		} 
	} else {
		$hasil=true;
	}
	return $hasil;
}
function getnamaakun($id) {
	global $koneksi;
	$q="SELECT NAMA FROM akun WHERE ID='$id'";
	$h=mysql_query($q,$koneksi);
	if (mysql_num_rows($h)>0) {
		$d=mysql_fetch_array($h);
		$hasil=$d[NAMA];
	} 
return $hasil;
}
function getawalakun($id) {
	global $koneksi;
	 $q="SELECT AWAL,TGLAWAL FROM akun WHERE ID='$id'";
	$h=mysql_query($q,$koneksi);
	if (mysql_num_rows($h)>0) {
		$d=mysql_fetch_array($h);
		$hasil=$d;
	} 
return $hasil;
}

function getawalsubakun($id,$tanggaldari) {
	global $koneksi;
	   $q="SELECT SUM(AWAL) AS HASIL FROM akun WHERE SUBID='$id'
	AND TGLAWAL < '$tanggaldari[thn]-$tanggaldari[bln]-$tanggaldari[tgl]'";
	$h=mysql_query($q,$koneksi);
	if (mysql_num_rows($h)>0) {
		$d=mysql_fetch_array($h);
		$hasil=$d;
	} 
return $hasil;
}

	$spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$br="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

function listakunneracaaktiva(&$list) {
	global $koneksi,$spasi,$br;
	$q="SELECT DISTINCT a.SUBID AS SB
	 FROM akun as a, akun as b 
	 WHERE 
	 a.SUBID=b.ID AND
	 b.SUBUNTUKNERACA='1' AND
	 a.TINGKAT='1' AND
	 a.UNTUKNERACA='0' AND
	 a.UNTUK='0'
	 ORDER BY a.SUBID";
	$h=mysql_query($q,$koneksi);
	echo mysql_error();
	if (mysql_num_rows($h)>0) {
		while ($d=mysql_fetch_array($h)) {
			$list[$d[SB]][OK]=1;
			//echo $d[SB]."<br>";
			$q="SELECT ID FROM akun WHERE SUBID='$d[SB]'";
			echo mysql_error();
			$h2=doquery($q,$koneksi);
			if (sqlnumrows($h2)>0) { 	
				while ($d2=sqlfetcharray($h2)) {
					unset($list[$d2[ID]]);
				}
			}	
		}
	}
	$q="SELECT ID
	 FROM akun 
	 WHERE 
	 	UNTUKNERACA='1' OR
		UNTUK='1'
	 ORDER BY ID";
	$h=mysql_query($q,$koneksi);
	echo mysql_error();
	if (mysql_num_rows($h)>0) {
		while ($d=mysql_fetch_array($h)) {
			unset($list[$d[ID]]);
		}
	}
}

function listakunneracaekuitas(&$list) {
	global $koneksi,$spasi,$br;
	$q="SELECT DISTINCT a.SUBID AS SB
	 FROM akun as a, akun as b 
	 WHERE 
	 a.SUBID=b.ID AND
	 b.SUBUNTUKNERACA='1' AND
	 a.TINGKAT='1' AND
	 a.UNTUKNERACA='1' AND
	 a.UNTUK='0'
	 ORDER BY a.SUBID";
	$h=mysql_query($q,$koneksi);
	echo mysql_error();
	if (mysql_num_rows($h)>0) {
		while ($d=mysql_fetch_array($h)) {
			$list[$d[SB]][OK]=1;
			//echo $d[SB]."<br>";
			$q="SELECT ID FROM akun WHERE SUBID='$d[SB]'";
			echo mysql_error();
			$h2=doquery($q,$koneksi);
			if (sqlnumrows($h2)>0) { 	
				while ($d2=sqlfetcharray($h2)) {
					unset($list[$d2[ID]]);
				}
			}	
		}
	}
	
	$q="SELECT ID
	 FROM akun 
	 WHERE 
	 	UNTUKNERACA='0' OR
		UNTUK='1'
	 ORDER BY ID";
	$h=mysql_query($q,$koneksi);
	echo mysql_error();
	if (mysql_num_rows($h)>0) {
		while ($d=mysql_fetch_array($h)) {
			unset($list[$d[ID]]);
		}
	}
	
	
}

function listakunrugilaba(&$list) {
	global $koneksi,$spasi,$br;
	$q="SELECT DISTINCT a.SUBID AS SB
	 FROM akun as a, akun as b 
	 WHERE 
	 a.SUBID=b.ID AND
	 b.SUBUNTUKNERACA='1' AND
	 a.TINGKAT='1' AND
	 a.UNTUK='1'
	 ORDER BY a.SUBID";
	$h=mysql_query($q,$koneksi);
	echo mysql_error();
	if (mysql_num_rows($h)>0) {
		while ($d=mysql_fetch_array($h)) {
			$list[$d[SB]][OK]=1;
			//echo $d[SB]."<br>";
			$q="SELECT ID FROM akun WHERE SUBID='$d[SB]'";
			echo mysql_error();
			$h2=doquery($q,$koneksi);
			if (sqlnumrows($h2)>0) { 	
				while ($d2=sqlfetcharray($h2)) {
					unset($list[$d2[ID]]);
				}
			}	
		}
	}
	
	$q="SELECT ID
	 FROM akun 
	 WHERE 
	 	UNTUK='0'
	 ORDER BY ID";
	$h=mysql_query($q,$koneksi);
	echo mysql_error();
	if (mysql_num_rows($h)>0) {
		while ($d=mysql_fetch_array($h)) {
			unset($list[$d[ID]]);
		}
	}
	
	
}


function listsubakun($id,&$list,$s,$level) {
	global $koneksi,$spasi,$br;
	$q="SELECT ID,NAMA,TINGKAT,KONTRAID,
	SUBUNTUKNERACA,UNTUKNERACA,UNTUK,UNTUKRUGILABA
	 FROM akun 
	 WHERE SUBID='$id' ORDER BY ID";
	$h=mysql_query($q,$koneksi);
	if (mysql_num_rows($h)>0) {
		while ($d=mysql_fetch_array($h)) {
			$list[$d[ID]][ID]=$d[ID];
			$list[$d[ID]][NAMA]=$d[NAMA];
			$list[$d[ID]][LEVEL]=$level;
			$list[$d[ID]][KONTRAID]=$d[KONTRAID];
			$list[$d[ID]][NAMAPANJANG2]=$s."$br".$d[NAMA];
			$list[$d[ID]][NAMAPANJANG]=$s." ".$d[ID]."$br".$d[NAMA];
			$list[$d[ID]][TINGKAT]=$d[TINGKAT];
			$list[$d[ID]][UNTUKNERACA]=$d[UNTUKNERACA];
			$list[$d[ID]][UNTUK]=$d[UNTUK];
			$list[$d[ID]][UNTUKRUGILABA]=$d[UNTUKRUGILABA];
			$list[$d[ID]][SUBUNTUKNERACA]=$d[SUBUNTUKNERACA];
			if ($d[TINGKAT]==0) {
				listsubakun($d[ID],$list,$s.$spasi,$level+1);
			}
		}
	}
}

function listakun() {
	global $koneksi,$spasi,$br;
	$q="SELECT ID,NAMA,TINGKAT,KONTRAID,
	SUBUNTUKNERACA,UNTUKNERACA,UNTUK,UNTUKRUGILABA 
	FROM akun WHERE SUBID=''  ORDER BY ID";
	$h=mysql_query($q,$koneksi);
	if (mysql_num_rows($h)>0) {
		while ($d=mysql_fetch_array($h)) {
			$slistakun[$d[ID]][ID]=$d[ID];
			$slistakun[$d[ID]][LEVEL]=0;
			$slistakun[$d[ID]][NAMA]=$d[NAMA];
			$slistakun[$d[ID]][KONTRAID]=$d[KONTRAID];
			$slistakun[$d[ID]][NAMAPANJANG2]=$br.$d[NAMA];
			$slistakun[$d[ID]][NAMAPANJANG]=$d[ID]."$br".$d[NAMA];
			$slistakun[$d[ID]][KONTRAID]=$d[KONTRAID];
			$slistakun[$d[ID]][SUBUNTUKNERACA]=$d[SUBUNTUKNERACA];
			$slistakun[$d[ID]][TINGKAT]=$d[TINGKAT];
			$slistakun[$d[ID]][UNTUKNERACA]=$d[UNTUKNERACA];
			$slistakun[$d[ID]][UNTUK]=$d[UNTUK];
			$slistakun[$d[ID]][UNTUKRUGILABA]=$d[UNTUKRUGILABA];
			if ($d[TINGKAT]==0) {
				listsubakun($d[ID],$slistakun,$spasi,1);
			}
		}
	}
	return $slistakun;
}

function cetakdigitnol($n,$d) {
	$l=strlen("".$n."");
	$hasil="";
	if ($l < $d) {
		for ($i=0;$i<$d-$l;$i++) {
			$hasil.="0";
		}
		$hasil=$hasil."$n";
	} else {
		$hasil="$n";
	}
	return $hasil;
}

function getalamattoko($toko) {
	global $koneksi;
	$q="SELECT ALAMAT FROM toko WHERE ID='$toko'";
	$h=doquery($q,$koneksi);
	echo mysql_error();
	if (sqlnumrows($h)>0) {
		$d=sqlfetcharray($h);
		$hasil=$d[ALAMAT];
	}
	return $hasil;
}

function getnamatoko($toko) {
	global $koneksi;
	$q="SELECT NAMA FROM toko WHERE ID='$toko'";
	$h=doquery($q,$koneksi);
	echo mysql_error();
	if (sqlnumrows($h)>0) {
		$d=sqlfetcharray($h);
		$hasil=$d[NAMA];
	}
	return $hasil;
}

function getnpwptoko($toko) {
	global $koneksi;
	$q="SELECT NPWP FROM toko WHERE ID='$toko'";
	$h=doquery($q,$koneksi);
	echo mysql_error();
	if (sqlnumrows($h)>0) {
		$d=sqlfetcharray($h);
		$hasil=$d[NPWP];
	}
	return $hasil;
}


function satuanjumlah($satuan,$jumlah,$satuandus) {
	if ($satuan==0) {
		$hasil=$jumlah;
	} elseif($satuan==1) {
		$hasil=$jumlah*12;
	} else {
		$hasil=$satuandus*$jumlah;
	}
	return $hasil;
	
}

function jumlahuangsblmtanggal($tanggal,$status,$jenis) {
	global $koneksi;
		if ($status!="semua") {
			$qstatus=" AND STATUS='$status' ";
			$jstatus=" Status = ".$arraystatusuang[$status].". ";
		}
		if ($jenis!="semua") {
			$qjenis=" AND JENIS='$jenis' ";
			$jjenis=" Jenis = ".$arraystatusjenisuang[$jenis].". ";
		}
				$q="SELECT SUM(JUMLAH) AS M 
				FROM keuangan 
				WHERE
				JENISU='1' AND
				TANGGAL < '$tanggal'
				$qstatus
				$qjenis
				";
				$hs=doquery($q,$koneksi);
				
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$masuk=$d[M];
				} else {
					$masuk=0;
				}

				$q="SELECT SUM(JUMLAH) AS M 
				FROM keuangan 
				WHERE
				JENISU='0' AND
				TANGGAL < '$tanggal'
				$qstatus
				$qjenis
				";
				$hs=doquery($q,$koneksi);
				
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$keluar=$d[M];
				} else {
					$keluar=0;
				}

			return	$sisa=$masuk-$keluar;
}


function jumlahstoksblmtanggal($idbahan,$tanggal) {
	global $koneksi;
				$q="SELECT SUM(JUMLAH*NILAISATUAN) AS M 
				FROM penerimaan 
				WHERE IDBAHAN='$idbahan' AND
				TGLMASUK < '$tanggal'
				";
				$hs=doquery($q,$koneksi);
				
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$masuk=$d[M];
				} else {
					$masuk=0;
				}

				$q="SELECT SUM(JUMLAH*NILAISATUAN) AS M 
				FROM pengeluaran 
				WHERE IDBAHAN='$idbahan'  AND
				TGL < '$tanggal'";
				$hs=doquery($q,$koneksi);
				
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$keluar=$d[M];
				} else {
					$keluar=0;
				}

				$q="SELECT SUM(JUMLAH*NILAISATUAN) AS M 
				FROM retur 
				WHERE IDBAHAN='$idbahan'  AND
				TGL < '$tanggal'";
				$hs=doquery($q,$koneksi);
				
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$keluar=$d[M];
				} else {
					$keluar=0;
				}


			return	$sisa=$masuk-$keluar+$retur;
}

function statuskegiatan($idprojek,$idkeg,$volume) {
	global $koneksi;
				 $q="SELECT KOEFISIEN,IDJENIS 
				FROM jenisbarangkegiatan 
				WHERE 
				 IDKEGIATAN='$idkeg'";
				
				$kebutuhan=0;
				$hs=doquery($q,$koneksi);
				if (sqlnumrows($hs)>0) {
					while($ds=sqlfetcharray($hs)) {
						$kebutuhan+=($volume*$ds[KOEFISIEN]);
					}
				} else {
					$kebutuhan=0;
				}
 
				$q="SELECT SUM(JUMLAH) AS M 
				FROM detilkirimbarangprojek ,kirimbarangprojek 
				WHERE 
				detilkirimbarangprojek.IDPESANAN=kirimbarangprojek.ID
				AND STATUS='1'
				AND IDKEGIATAN='$idkeg' AND IDPROJEK='$idprojek'";
				$hs=doquery($q,$koneksi);
				if (sqlnumrows($hs)>0) {
					$ds=sqlfetcharray($hs);
					$terkirim=$ds[M];
				} else {
					$terkirim=0;
				}
				$statusk=100*$terkirim/$kebutuhan;
				if ($statusk > 100) {
					$statusk=100;
				}
				return $statusk;
}

function jumlahstok($idbahan) {
	global $koneksi;
				$q="SELECT STOKAWAL  
				FROM barang 
				WHERE ID='$idbahan'";
				$hs=doquery($q,$koneksi);
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$masuk=$d[STOKAWAL];
				} 
				$q="SELECT SUM((JUMLAH*NILAISATUAN)-JUMLAHKELUAR) AS M 
				FROM penerimaan 
				WHERE IDBARANG='$idbahan'";
				$hs=doquery($q,$koneksi);
				
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$masuk+=$d[M];
				}  
 				$q="SELECT SUM(JUMLAH) AS M 
				FROM detilkirimbarangprojek ,kirimbarangprojek 
				WHERE 
				detilkirimbarangprojek.IDPESANAN=kirimbarangprojek.ID
				AND
				IDBARANG='$idbahan' AND STATUS='1'";
				$hs=doquery($q,$koneksi);
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$masuk-=$d[M];
				} else {
					$masuk-=0;
				}

			return	$masuk+0;
}
function jumlahstokvendor($idbahan) {
	global $koneksi;
 				$q="SELECT SUM(JUMLAH) AS M 
				FROM detilkirimbarangprojek ,kirimbarangprojek 
				WHERE 
				detilkirimbarangprojek.IDPESANAN=kirimbarangprojek.ID
				AND
				IDBARANG='$idbahan' AND STATUS='1' AND GUDANG='0'";
				$hs=doquery($q,$koneksi);
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$masuk-=$d[M];
				} else {
					$masuk-=0;
				}

			return	$masuk+0;
}

function jumlahstokretur($idbahan) {
	global $koneksi;

////////////////// Diperbaiki.................
				$q="SELECT SUM(JUMLAH*NILAISATUAN) AS M 
				FROM retur 
				WHERE IDBARANG='$idbahan'";
				$hs=doquery($q,$koneksi);
				echo mysql_error();
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$retur=$d[M];
				} else {
					$retur=0;
				}
				$q="SELECT SUM(JUMLAH*NILAISATUAN) AS M 
				FROM returbeli 
				WHERE IDBARANG='$idbahan'";
				$hs=doquery($q,$koneksi);
				echo mysql_error();
				if (sqlnumrows($hs)>0) {
					$d=sqlfetcharray($hs);
					$returbeli=$d[M];
				} else {
					$returbeli=0;
				}
			$sisa=$retur-$returbeli;
			if ($sisa <0) { $sisa=0;}
			return $sisa	;
}

function kelasdatautama($i) {
				if ($i % 2 ==0) {
					$kelas=" class=datautamagenap";
				} else {
					$kelas=" class=datautamaganjil";
				}
				return $kelas;

}

function kelas($i) {
				if ($i % 2 ==0) {
					$kelas=" class=datagenap";
				} else {
					$kelas=" class=dataganjil";
				}
				return $kelas;

}
function kelassm($i) {
				if ($i % 2 ==0) {
					$kelas=" class=datagenapsm";
				} else {
					$kelas=" class=dataganjilsm";
				}
				return $kelas;

}

function createsubmenu($judul,$arraysubmenu) {
	global $tingkats,$users,$borderdata;
echo "
<div id='leftmenu_title'>&nbsp;$judul</div>
						<ul id='leftmenu_item' >
	
";
	$j=0;
	foreach ($arraysubmenu as $i=>$v) {
		
		if (session_is_registered("tingkats") && (ereg($tingkats,$v[t]) || ($v[t]==""))) {
			$reg=str_replace("?","\?",$v[href]);
		
		$kelas=kelassm($j);
			echo "
			<li>";
				if (trim($v[href])!="") {
					echo "
					<a  href='$v[href]'>
						&nbsp;$v[Judul]
					</a>";
				} else {
					echo "
					<b>&nbsp;$v[Judul]</b>
					";
				}
				echo "
				</li>
		";
 			$td="";
			$ta="";
			
			$j++;
		}
	}
	
	echo "
</ul>
</td>
";




}


		function cetakuang($n) {
			return number_format($n,2,',','.');
		}
		function cetakhasil($n) {
			if (!eregi("Error",$n)) {
				return number_format($n,2);
			} else {
				return $n;
			}
		}

function cekisidatang($id) {
	global $koneksi;
	$q="SELECT JAMDATANG FROM presensi WHERE IDUSER='$id' AND TANGGAL=NOW()";
	$h=doquery($q,$koneksi);
	if (sqlnumrows($h) > 0) {
		$d=sqlfetcharray($h);
	}
	if (trim($d[JAMDATANG])!="") {
		return true;
	} else {
		return false;
	}
}
function cekisipulang($id) {
	global $koneksi;
	$q="SELECT JAMPULANG FROM presensi WHERE IDUSER='$id' AND TANGGAL=NOW()";
	$h=doquery($q,$koneksi);
	if (sqlnumrows($h) > 0) {
		$d=sqlfetcharray($h);
	}
	if (trim($d[JAMPULANG])!="") {
		return true;
	} else {
		return false;
	}
}

function angkatoteks($a) {
	global $angka;
	if ($angka[$a]!="")	{
		if ($a!=0) {
			$teks=$angka[$a];
		}
	} else {
		// Tes belasan
		if ($a > 11 && $a < 20) {
			$t1=$a / 10;
			$t2=$a % 10;
			if ($t2>0) {
				$teks= $angka[$t2]." Belas";
			}
		} elseif ($a >= 20 && $a < 100) {
			$t1=floor($a / 10);
			$t2=$a % 10;
			$teks= $angka[$t1]." Puluh ";
			if ($t2>0) {
				$teks.= $angka[$t2];
			}
		} elseif ($a > 100 && $a < 1000) {
			$t1=floor($a / 100);
			$t2=$a % 100;
			if ($t1 > 1) {
				$teks= $angka[$t1]." Ratus ";
			} else {
				$teks= "Seratus ";
			}
			if ($t2>0) {
				$teks .=angkatoteks($t2);
			}
		} elseif ($a > 1000 && $a < 1000000) {
			$t1=floor($a / 1000);
			$t2=$a % 1000;
			if ($t1 > 1) {
				$teks= angkatoteks($t1)." Ribu ";
			} else {
				$teks= "Seribu ";
			}
			if ($t2>0) {
				$teks .=angkatoteks($t2);
			}
		} elseif ($a >= 1000000 && $a < 1000000000) {
			$t1=floor($a / 1000000);
			$t2=$a % 1000000;
			$teks= angkatoteks($t1)." Juta ";
			if ($t2>0) {
				$teks .=angkatoteks($t2);
			}
		} elseif ($a >= 1000000000.0 && $a < 1000000000000.0) {
			$t1=$a / 1000000000;
			 $t1=floor($t1);
			$t2=$a-($t1*1000000000);
			$teks= angkatoteks($t1)." Milyar ";
			if ($t2>0) {
				$teks .=angkatoteks($t2);
			}
		} elseif ($a >= 1000000000000 && $a < 1000000000000000.0) {
			$t1=$a / 1000000000000;
			 $t1=floor($t1);
			$t2=$a-($t1*1000000000000);
			$teks= angkatoteks($t1)." Trilyun ";
			if ($t2>0) {
				$teks .=angkatoteks($t2);
			}
		} elseif ($a >= 1000000000000000 && $a < 1000000000000000000.0) {
			$t1=$a / 1000000000000000;
			 $t1=floor($t1);
			$t2=$a-($t1*1000000000000000);
			$teks= angkatoteks($t1)." Bilyun ";
			if ($t2>0) {
				$teks .=angkatoteks($t2);
			}
		}
	}
	return $teks;	
}
function getasal() {
	global $REMOTE_ADDR;
	return "$REMOTE_ADDR";
}

function imgsizeprop($img,$w) {
	if ($w=="") {
		$wi=100;
	} else {
		$wi=$w;
	}
	$img=@getimagesize($img);
	$h1=$img[1];
	$w1=$img[0];
	$w2=$wi;
	$h2=$h1*@($w2/$w1);
	settype($h2,"integer");
	
	$i[0]=$w2;
	$i[1]=$h2;
	return $i;
}
function imgsizeproph($img,$h) {
	if ($h=="") {
		$hi=100;
	} else {
		$hi=$h;
	}
	$img=@getimagesize($img);
	$h1=$img[1];
	$w1=$img[0];
	$h2=$hi;
	$w2=$w1*@($h2/$h1);
	settype($w2,"integer");
	
	$i[0]=$w2;
	$i[1]=$h2;
	return $i;
}

$namaserver="server-pegawai";
include $root."array.php";

function cekuser($t) {
	global $tingkats;
	if (session_is_registered("tingkats")) {
		if ($t=="") {
		} elseif (!ereg($tingkats,$t)) {
			die("<h1 align=center>X?!@&(%$^VTYEPO+_^</h1>");
		}
	} else {
		die("<h1 align=center>X?!@&(%$^VTYEPO+_^</h1>");
	}
}
function cekjabatan($j) {
	global $jabatans;
	if (session_is_registered("jabatans")) {
		if ($jabatans!=$j) {
			die("<h1 align=center>X?!@&(%$^VTYEPO+_^</h1>");
		}
	}
}


function getnama($id) 
{
	global $koneksi;
	$q="SELECT NAMA FROM user WHERE ID='$id'";
	$h=doquery($q,$koneksi);
	echo mysql_error();
	if (sqlnumrows($h)>0) {
		$d=sqlfetcharray($h);
	}
	return $d[NAMA];
}

function getnip($id) 
{
	global $koneksi;
	$q="SELECT NIP FROM user WHERE ID='$id'";
	$h=doquery($q,$koneksi);
	echo mysql_error();
	if (sqlnumrows($h)>0) {
		$d=sqlfetcharray($h);
	}
	return $d[NIP];
}


function pf($m) {
	return "<font color=black style=\"font-size:10pt;\">".$m."</font>" ;
}

function buatlog($i,$id) {
	global $REMOTE_ADDR,$datalog; 
	$tgl=date("d/m/y h:m:s",time());
	$f=fopen("log","a+");
	fwrite($f,$tgl.";ID=$id;ASAL=$REMOTE_ADDR;KET=".$datalog[$i]."\n");
	fclose($f);
}

function printid($id) {
		return $id;
}

function jumlahpegawai() {
	global $koneksi;
	$query="SELECT COUNT(ID) AS JML FROM user WHERE ID!='superadmin'";
	$hasil=doquery($query,$koneksi);
	$data=sqlfetcharray($hasil);
	return $data[JML];
}

function jamtodetik($j,$m,$d) {
	return ($j*3600+$m*60+$d);
}

function detiktojamlembur($s) {
	$tmp=$s;
	settype($tmp,"integer");
	$j=$tmp/3600;
	settype($j,"integer");
	$tj=$tmp%3600;
	settype($tj,"integer");
	$m=($tj/60);
	settype($m,"integer");
	return "$j jam $m mnt";
}

function islibur() {
	global $koneksi;
	$now=getdate(time());
	
			$tgl=$now[year]."-".$now[mon]."-".$now[mday];
			$query ="SELECT COUNT(TGLLIBUR) AS JML FROM libur WHERE TGLLIBUR='$tgl'";
			$h=doquery($query,$koneksi);
			$jnslibur=sqlfetcharray($h);
			$jml=$jnslibur[JML];
			if ($jml==1) {
				return true;
			} else {
				return false;
			}
}

function isharilibur($tgl,$bln,$thn) {
	global $koneksi;
//	$now=getdate(time());
		$w=getdate(Mktime(0,0,0,$bln,$tgl,$thn));	
			$tgl=$w[year]."-".$w[mon]."-".$w[mday];
			$query ="SELECT COUNT(TGLLIBUR) AS JML FROM libur WHERE TGLLIBUR='$tgl'";
			$h=doquery($query,$koneksi);
			$jnslibur=sqlfetcharray($h);
			$jml=$jnslibur[JML];
			if ($jml==1) {
				return true;
			} else {
				return false;
			}
}


function printconfirmjs ($c) {
	echo "onclick=\"return confirm('$c')\"";
}
function printman($man) {
	echo "
	<center>
		<table width=100%>
			<tr>
				<td align=center>
					<font style='font-size:10pt;font-family:Arial;' color=#000000>$man</font>
				</td>
			</tr>
		</table>
	</center>";
}

function printmutiara($man) {
//	if (trim($man)!="") {
//		echo "<hr>";
//	}
	echo "
	<center>
		<table width=100%>
			<tr>
				<td align=center>
					<font style='font-size:11pt;' color=#0055ff>$man</font>
				</td>
			</tr>
		</table>
	</center>";
}

function printfooter() {
	global $border,$judulprogram,$root;
	echo "

<tr>
	<td  colspan='2' id='footer'>&copy; M. Ricky Sauqi 
		</td>
</tr>
</table>	

</body>
</html>
";

	mysql_close();
}

function getpanggilan ($iduser) {
	global $koneksi;
	$pgl="";
		$query="SELECT NAMA, KELAMIN, 
			(YEAR(NOW())-YEAR(TGLLAHIR)) AS USIA
			FROM user WHERE ID = '$iduser' ";
		$hasil=doquery($query,$koneksi);
		if (sqlnumrows($hasil)==1) {
			$datauser=sqlfetcharray($hasil);
			if ($datauser[USIA] < 25) {
				if ($datauser[KELAMIN]=="L") {
					$pgl="Mas";
				}
				elseif ($datauser[KELAMIN]=="P") {
					$pgl="Mbak";
				}
			} else {
				if ($datauser[KELAMIN]=="L") {
					$pgl="Bapak";
				}
				elseif ($datauser[KELAMIN]=="P") {
					$pgl="Ibu";
				}
			}
		}
		if ($pgl!="") {
			$pgl=$pgl." ".$datauser[NAMA];
		}
	return $pgl;
}

function printheader() {
	global $users,$namausers,$arraybulan,$arrayhari,
	$judul,$namakantor,$namakantor2,$root,$HTTP_HOST, $style,
	$koneksi,$dirgambar,$tabellatar,$border,$judulprogram,
	$versi,$namadistributor,$fnhead;

echo "
 <!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'
'http://www.w3.org/TR/html4/loose.dtd'>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
<meta name='author' content='Ahmad Maulana Yahya'>
<meta name='author' content='Ricky Sauqi'>
<meta name='author' content='Suteki-Tech'>
<meta name='author' content='PP KIMIA LIPI'>
<meta name='geo.country' content='ID'>
<meta name='geo.placename' content='Bandung'>
<meta name='geo.placename' content='Dago'>
<meta name='dc.language' content='en'>
<meta name='copyright' content='Copyright � 2005 Suteki-tech.com for PP KIMIA LIPI'>
<meta name='description' content='ISO 17025 Administration Certification Web Based Application '>
<meta name='keywords' content='chemical certification, php, mysql, chemical, pp kimia lipi'>
<link rel='stylesheet' href='../style.css' type='text/css' > 
<title>::administrasi iso 17025::</title>
<script language='Javascript'>
<!--
function daftarakun(pfld,pfltr) {
				 if (window.PsnList && window.PsnList.open && !window.PsnList.closed) {
				 		window.PsnList.close();
				 }
				 PsnList = window.open('../lib/listakun.php?pfld='+pfld+'&pfltr='+pfltr+'&pnama=A', 'List', 'width=390,height=450,scrollbars=yes');
}
function daftarkelompokakun(pfld,pfltr) {
				 if (window.PsnList && window.PsnList.open && !window.PsnList.closed) {
				 		window.PsnList.close();
				 }
				 PsnList = window.open('../lib/listklpakun.php?pfld='+pfld+'&pfltr='+pfltr+'&pnama=A', 'List', 'width=390,height=450,scrollbars=yes');
}
function daftarbahan(pfld,pfltr) {
				 if (window.PsnList && window.PsnList.open && !window.PsnList.closed) {
				 		window.PsnList.close();
				 }
				 PsnList = window.open('../lib/listbahan.php?pfld='+pfld+'&pfltr='+pfltr+'&pnama=A', 'List', 'width=390,height=450,scrollbars=yes');
}
function daftartoko(pfld,pfltr) {
				 if (window.PsnList && window.PsnList.open && !window.PsnList.closed) {
				 		window.PsnList.close();
				 }
				 PsnList = window.open('../lib/listtoko.php?pfld='+pfld+'&pfltr='+pfltr+'&pnama=A', 'List', 'width=390,height=450,scrollbars=yes');
}
function daftarbahanmasuk(pfld,pfltr) {
				 if (window.PsnList && window.PsnList.open && !window.PsnList.closed) {
				 		window.PsnList.close();
				 }
				 PsnList = window.open('../lib/listbahanmasuk.php?pfld='+pfld+'&pfltr='+pfltr+'&pnama=A', 'List', 'width=390,height=450,scrollbars=yes');
}

// -->
</script></head>
<body>

<table width='100%' cellpadding='0' cellspacing='0' border='0'>
<tr>
	<td id='titlebar'>
		<div id='title'>$judulprogram</div>
		</td>
	</tr>
</table>	
	";

}

function printmesg($errmesg) {
if ($errmesg!="") {
	echo "<center>
	<table width=80% cellspacing=2 cellpadding=2 >
		<tr valign=middle>
			<td align=center style='background:#FF0000;color:#FFFF00;text-decoration:bold;'>
				$errmesg
			</td>
		</tr>
	</table>
	</center>
	<BR>
	";
}
}

function printadmin() {
	global $admin, $namaadmin;
	echo "
	<table width=100% cellspacing=2 cellpadding=0 bgcolor=#22366>
		<tr valign=middle>
			<td>
				&nbsp;
				<font size=2>Anda login sebagai $admin ($namaadmin)</font>
			</td>
		</tr>
	</table>
	";
}
function printuser() {
	global $user, $namauser,$waktu,$arraybulan,$arrayhari;
	echo "
	<table width=100%>
		<tr>
		<td>
		</td>
		<td align=right>
			".$arrayhari[$waktu[wday]].", $waktu[mday] ".$arraybulan[$waktu[mon]-1]." $waktu[year]
		</td>
		</tr>
	</table>
	
	";
}
	
function printjudul($judul) {
	global $koneksi,$tabellatar,$namausers,$users;
if ($users!="") {
 	echo "
	<table >
		<tr valign=middle>
			<td >
					<font style='font-size:9pt;font-family: Arial;'>
					Selamat datang, <b> $namausers ( ".printid($users)." ) </b>
					$pesan
					</font>
			</td>
		</tr>
	</table>
	";
}
}

function printjudul2($judul) {
	global $tabeljudul;

if ($judul!="") {
	echo "
	<table width=100% $tabelpengumuman>
		<tr valign=middle>
			<td >
				<font  style='font-size:10pt;font-family: Arial;'><b>$judul</b></font>
			</td>
		</tr>
	</table>
	";
}
}


	function sqlnumrows($hasil) {
		return mysql_num_rows($hasil);
	}
	function doquery($query,$koneksi) {
		return mysql_query($query,$koneksi);
//		return mysql_error();
	}
	
	function sqlfetcharray($hasil) {
		return mysql_fetch_array($hasil);
	}

	function sqlaffectedrows($koneksi) {
		return mysql_affected_rows($koneksi);
	}
	
	function koneksiBD() {
		$konek = mysql_connect($hostsql,$loginsql,$passwordsql);
		return $konek;
	}
	
	function isemail($email) {	
		return (ereg("^[^@ \t]+@[^@ \t]+\.[^@ \t]+",$email));
	}
	
	function isintegerpositif ($angka) {
		return (ereg("^[0-9][0-9]*$",$angka));
	}
	
	function isangka($angka) {
		return (ereg("^[0-9]+$",$angka));
	}

	function istahun($tahun) {
		return (isintegerpositif($tahun) && ereg("[0-9]{4}",$tahun) && $tahun > 1900);
	}

	
	function iskabisat($tahun) {
		return (($tahun % 100 != 0 && $tahun % 4 == 0) || ($tahun % 100 == 0 && $tahun % 400 == 0)  );
	}
	
	function istanggal($tanggal,$bulan,$tahun,$komentar) {
		if (!isintegerpositif($tanggal)) {
			//echo "Tanggal $komentar harus diisi dengan bilangan bulat 1 s.d 31<br>";
			return 0;
		}
		if (!isintegerpositif($bulan) || ($bulan > 12 || $bulan < 1)) {
			//echo "Bulan $komentar harus diisi bilangan bulat 1 s.d 12<br>";
			return 0;
		}
		if (!isintegerpositif($tahun) || $tahun < 1900) {
			//echo "Tahun $komentar harus diisi bilangan bulat 4 digit > 1900<br>";
			return 0;
		}
		
		if ($bulan == 4 ||
			$bulan == 6 ||
			$bulan == 9 ||
			$bulan == 11
		) {
			if ($tanggal > 30) {
				//echo "Tanggal $komentar untuk bulan 4, 6, 9, dan 11 harus diisi bilangan bulat 1 s.d 30<br>";
		//		exit;
			return 0;
			}
		} elseif ($bulan == 2) {
			if ($tanggal > 28 && !iskabisat($tahun)) {
				//echo "Tanggal $komentar untuk bukan tahun kabisat ($tahun) harus diisi bilangan bulat 1. s.d 28<br>";
			//	exit;
				return 0;
			}
		} else {
			if ($tanggal > 31) {
				//echo "Tanggal $komentar untuk bulan 1, 3 , 5, 7 , 8, 10, dan 12 harus diisi bilangan bulat 1 s.d 31<br>";
				return 0;
			}
		}
		return 1;
	}
	
	function isarraysama($array1,$array2) {
		if (count($array1)!=count($array2)) {
			return false;
		} else {
			$sama=true;
			for ($i=0;$i<count($array1);$i++) {
				if ($array[$i]!=$array2[$i]) {
					$sama=false;
					break;
				}
			}
			return $sama;
		}
	}

	function hasilquerytoarray ($hasil,$i) {
		//$hasil;
		while ($row = sqlfetcharray($hasil)) {
			$hasil[]=$row[$i];
			echo "$row[$i]";
		}
		return $hasil;
	}		
	



	
	function addnol($nilai,$banyakdigit) {
		
		$tmp="";
		for ($d=$banyakdigit-1;$d>=1;$d--) {
			if ($nilai/pow(10,$d) >= 1) {
			  break;
			} else {
				$tmp.="0";
			}
		}
		return "$tmp$nilai";
	}
	





	function locktabel($daftartabel) {
		global $koneksi;
		doquery("LOCK TABLE $daftartabel",$koneksi);
		echo mysql_error();
	}


	function unlocktabel() {
		global $koneksi;
		doquery("UNLOCK TABLE",$koneksi);
	}

	function getkode() {
		global $koneksi;
		$q="SELECT PASSWORD(PASSWORD(DATE_FORMAT(NOW(),'%d%m%Y'))) AS HASIL";
		$h=doquery($q,$koneksi);
		$d=sqlfetcharray($h);
		return $d[HASIL];
	}

	function istgl_lebih($tgl1,$tgl2) {
		if ($tgl1[thn]>$tgl2[thn]) {
			//echo "$tgl1[thn] > $tgl2[thn]";
			return true;
		} else if ($tgl1[thn]<$tgl2[thn]) {
			return false;
		} else {
			if ($tgl1[bln]>$tgl2[bln]) {
				return true;
			} else if ($tgl1[bln]<$tgl2[bln]) {
				return false;
			} else {
				if ($tgl1[tgl]>$tgl2[tgl]) {
					return true;
				} else if ($tgl1[tgl]<$tgl2[tgl]) {
					return false;
				} else {
					return false;
				}
			}
		}
	}

	function istgl_sama($tgl1,$tgl2) {
		if ($tgl1[thn]=$tgl2[thn] && $tgl1[bln]=$tgl2[bln] && $tgl1[tgl]=$tgl2[tgl]) {
			return true;
		} else {
			return false;
		} 
	}

	function istgl_kurang($tgl1,$tgl2) {
		if (!istgl_sama($tgl1,$tgl2) && !istgl_lebih($tgl1,$tgl2)) {
			return true;
		} else {
			return false;
		} 
	}


?>
