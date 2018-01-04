<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
include $root."style.inc";
include "init.php";

		 $q="SELECT 
		minta.*,HISTORY,SAMPEL,JENISANALISIS,HASIL,HASIL2,DUPLO
		 FROM permintaan,minta 
		WHERE 
		permintaan.IDTRANS=minta.ID AND 
		IDTRANS='$idupdate'
 		AND permintaan.ID='$idsupdate'";
		$h=doquery($q,$koneksi);
		echo mysql_error();
 		if (sqlnumrows($h)>0) {
 		
 			$d=sqlfetcharray($h);
 			
 			
 			echo "
	<table cellpadding=2 cellspacing=2 width=600 $border style='font-family: Arial;font-size:12pt;'>
		<tr>
			<td width=150  nowrap>
				Kode Permintaan
			</td>
			<td>
				$idupdate
		</tr>
		<tr>
			<td width=150  nowrap>
				Status
			</td>
			<td>
				".$arraystatushasil[$d[STATUS]].""; 
 		echo "
		</tr>
		<tr>
			<td width=150  nowrap>
				ID Klien
			</td>
			<td>
				$d[IDKLIEN] / ".getnamatoko($d[IDKLIEN])."
			</td>
		</tr>
		<tr>
			<td width=150  nowrap>
				Sampel
			</td>
			<td>
				$d[SAMPEL]
			</td>
		</tr>
		<tr>
			<td width=150  nowrap>
				Jenis Analisis
			</td>
			<td>
				".$arrayanalisis[$d[JENISANALISIS]]."
			</td>
		</tr>
		<tr>
			<td width=150  nowrap>
				Hasil (Single)
			</td>
			<td>
				$d[HASIL]
			</td>
		</tr>";
		if ($d[DUPLO]==1) {
    echo "
		<tr>
			<td width=150  nowrap>
				Hasil (Duplo)
			</td>
			<td>
				$d[HASIL2]
			</td>
		</tr>    
    ";
    }
    echo "
		<tr valign=top>
			<td width=150  nowrap>
				History
			</td>
			<td nowrap>
				".nl2br($d[HISTORY])."
			</td>
		</tr>
		</table> 			
 			";
 		
 		}

?>
