<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
//include "man.inc";


include "init.php";
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

				if ($pilihan=="" && $tingkats=="F") {
        }
 
				if ($pilihan=="ltambah" ) {
					include "tambahtoko.php";
				}	elseif ($pilihan=="llihat" || $pilihan=="") {
					include "lihattoko.php";
				}	elseif ($pilihan=="lupdate") {
					include "updatetoko.php";
  	 		}	elseif ($pilihan=="laporanadm") {
					include "laporanadm.php";
 	 
				}	elseif ($pilihan=="lauto") {
					include "autolihattoko.php";
				}	elseif ($pilihan=="tagihanawal") {
					include "tagihanawal.php";
 				}	elseif ($pilihan=="laporanadm") {
					include "laporanadm.php";
 				}	elseif ($pilihan=="survey") {
					include "survey.php";
         }			
			?>
		</td>
</tr>
		
<?
printfooter();
?>

