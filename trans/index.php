<?php
$root="../";
include $root."sesiuser.php";
include $root."header.php";
//include "man.inc";


include "init.php";
include "initkop.php";
include "aksi.php";

printheader();

include $root."menu.php";

?>

<tr>
	<td id="leftmenu" nowrap>
				<?
				include "submenu.php";
				?>
		</td>
	<td id="content" width="100%">
			<?
 
///////////////////////////////Tabel Jenis Bahan Kimia//////////////////////////////////////////////

				if ($pilihan=="" && $tingkats=="B") {
        }

				if ($pilihan=="" && $tingkats=="C") {
					$pilihan="mauto";
				}
				elseif ($pilihan=="" && $tingkats=="D") {
					$pilihan="sauto";
				}
				elseif ($pilihan=="" && $tingkats=="E") {
					$pilihan="aauto";
				}

				if ($pilihan=="ltambah" ) {
					include "tambahtoko.php";
				}	elseif ($pilihan=="llihat" || $pilihan=="") {
					include "lihattoko.php";
				}	elseif ($pilihan=="lupdate") {
					include "updatetoko.php";
				}	elseif ($pilihan=="mlihat") {
					include "lihattokom.php";
 				}	elseif ($pilihan=="mupdate") {
					include "updatetokom.php";
				}	elseif ($pilihan=="slihat") {
					include "lihattokos.php";
 				}	elseif ($pilihan=="supdate") {
					include "updatetokos.php";
				}	elseif ($pilihan=="alihat") {
					include "lihattokoa.php";
 				}	elseif ($pilihan=="aupdate") {
					include "updatetokoa.php";
 				}	elseif ($pilihan=="laporan") {
					include "laporantrans.php";
 				}	elseif ($pilihan=="laporanadm") {
					include "laporanadm.php";
 				}	elseif ($pilihan=="settingkop") {
					include "kop.php";
 				}	elseif ($pilihan=="settingbiaya") {
					include "biaya.php";
 
				}	elseif ($pilihan=="lauto") {
					include "autolihattoko.php";
				}	elseif ($pilihan=="aauto") {
					include "autolihattokoa.php";
				}	elseif ($pilihan=="mauto") {
					include "autolihattokom.php";
 				}	elseif ($pilihan=="sauto") {
					include "autolihattokos.php";
 				}	elseif ($pilihan=="tagihanawal") {
					include "tagihanawal.php";
 				}	elseif ($pilihan=="survey") {
					include "survey.php";
        }			
			?>
		</td>
</tr>
		
<?
printfooter();
?>

