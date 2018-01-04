<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
include $root."style.inc";
include "init.php";
include "initkop.php";

if ($_SESSION[tingkats]!="B") {
    exit;
}

$ketlog="Buat Tagihan. Kode Permintaan: $idupdate";
buatlogiso(13,$ketlog,$q,$users);

   include "proseskop.php";
  echo "$tmpkop";
 
 
$q="SELECT * FROM minta WHERE ID='$idupdate'";
$h=doquery($q,$koneksi) ;

if (sqlnumrows($h)>0) {
	$data=sqlfetcharray($h);
	$id=$data[ID];
	$nomer1=$data[NOMER1];
	$nomer2=$data[NOMER2];
	$catatantagihan=$data[CATATANTAGIHAN];
	$idklien=$data[IDKLIEN];
	$sampel=$data[SAMPEL];
	$catatan=$data[CATATAN];
	$catatanm=$data[CATATANM];
	$idman=$data[IDMAN];
	$contoh=$data[CONTOH];
	$jenisanalisis=$data[JENISANALISIS];
	$statusadm=$statuspermintaan=$data[STATUS];
	$tmp=explode("-",$data[TANGGALDATANG]);
	$tglmasuk=$tmp[2];
	$blnmasuk=$tmp[1];
	$thnmasuk=$tmp[0];

	$tmp=explode("-",$data[TANGGALDEADLINE]);
	$tgld=$tmp[2];
	$blnd=$tmp[1];
	$thnd=$tmp[0];

	$tmp=explode("-",$data[TANGGALSELESAI]);
	$tglse=$tmp[2];
	$blnse=$tmp[1];
	$thnse=$tmp[0];

	
	$q="SELECT COUNT(ID) AS JML FROM permintaan WHERE IDTRANS='$idupdate'";
	$h1=doquery($q,$koneksi);
	$d1=sqlfetcharray($h1);

	$q="SELECT COUNT(ID) AS JML FROM permintaan WHERE IDTRANS='$idupdate' AND STATUS='99'";
	$h2=doquery($q,$koneksi);
	  $d2=sqlfetcharray($h2);
	if ($d1[JML]==$d2[JML]) {
		 $statusakhir="selesai";
	}
 }

if ($ok==1 && $idupdate!="") {
	$errmesg="Data permintaan analisis telah dimasukkan. Silahkan mengentri data uji";
}

 echo "
<h3>INVOICE</h3>";
printmesg($errmesg);
echo "
    
	<table border=0 $border>
		<tr>
			<td  nowrap>
				REPORT NUMBER
			</td>
			<td>$nomer1
 		</tr>
		<tr>
			<td  nowrap>
				REFERENCE ORDER NUMBER
			</td>
			<td>$nomer2
 		</tr>
		<tr>
			<td  nowrap>
				".$arraybahasa["Kode Sampel"]."
			</td>
			<td>
				<input type=hidden name=id size=5 value='$id'>$id
		</tr>
 		<tr>
			<td width=150  nowrap>
				".$arraybahasa["Pelanggan"]."
			</td>
			<td>
				$idklien / ".getnamatoko($idklien)."
			</td>
		</tr>
		<tr>
			<td width=200  nowrap>
				".$arraybahasa["Nama Sampel"]."
			</td>
			<td>
				 $contoh
			</td>
		</tr>
 	<tr>
		<td  >".$arraybahasa["Tanggal Datang"]."</td>
		<td nowrap>$tglmasuk-$blnmasuk-$thnmasuk
		</td>
 	</tr>
	<tr>
		<td  >".$arraybahasa["Tanggal Deadline"]."</td>
		<td nowrap>$tgld-$blnd-$thnd
		</td>
 	</tr>";		
	if ($d1[JML]==$d2[JML]) {
		echo "
	<tr>
		<td  >Tanggal Selesai</td>
		<td>$tglse-$blnse-$thnse </td>
	</tr>		";
	}

	echo "
        </table><br> 
 
 ";
 
 
 
 
		 $q="SELECT 
		*,
		DATE_FORMAT(TANGGALSELESAI,'%d-%m-%Y') AS TGLSELESAI
		 FROM permintaan 
		WHERE IDTRANS='$idupdate'
 		ORDER BY ID";
		$h=doquery($q,$koneksi);
		//echo mysql_error();
		if (sqlnumrows($h)>0) {
			
     printmesg($errmesg);
 			echo "
  				<table width=95% $border class=data>
 					<tr class=judulkolom align=center valign=middle>
  					<td nowrap ><b>".$arraybahasa["Kelompok Jenis Uji"]."</td>
						<td nowrap ><b>".$arraybahasa["Jenis Analisis"]."</td>
 						<td nowrap ><b>".$arraybahasa["Biaya"]." ($matauang)</td>
 					</tr>
          ";
			$totalbiaya=0;
			$i=1;
			while($data=sqlfetcharray($h)) {
			 
				$kelas=kelas($i);
        $biaya=$data[BIAYA];
        $tduang="<td  align=right>".number_format($biaya,0)."</td>";
				if ($matauang=="USD") {
          $biaya=@($data[BIAYA]/$konversi);
          $tduang="<td  align=right>".cetakuang($biaya)."</td>";
        }
 				echo "
					<tr valign=top $kelas>
 						<td  align=left>".$arraykelompokjenisuji[$arraykelompokanalisis[$data[JENISANALISIS]]]."</td>
						<td  align=left>".$arrayanalisis[$data[JENISANALISIS]]."</td>
  						$tduang
  					</tr>";
					$totalbiaya+=$biaya;
				$i++;
			}
						
      $tduang="<td  align=right><b>".number_format($totalbiaya,0)."</td>";
			if ($matauang=="USD") {
        $biaya=@($data[BIAYA]/$konversi);
        $tduang="<td nowrap align=right><b> ".cetakuang($totalbiaya)."</td>";
      }
			echo "
					<tr class=judulkolom align=center valign=middle>
 						<td nowrap colspan=2 align=right>SUM</td>
  						$tduang
  					</tr>
				</table></center>
  			";
			
		}  
		
		
 echo  "				
 <br>
 Note: $catatantagihan
 <br><br>
 				<table border=0 $border>
					<tr align=left>
						<td width=33%>
						 $KOTADEFAULT, $w[mday]-$w[mon]-$w[year]
						<br>
						Manajer Teknis</td>
						<td width=33%> </td>
						<td width=33%> </td>
					</tr>
					<tr align=left>
						<td width=33%><br><br><br><br></td>
						<td width=33%></td>
						<td width=33%></td>
					</tr>
					<tr align=left>
						<td width=33%>(.......................... ) </td>
						<td width=33%> </td>
						<td width=33%> </td>
					</tr>
				</table>
	</td>
	</tr>				
	</table>

";
		
		
 
?>
