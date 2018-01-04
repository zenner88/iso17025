<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
//include "man.inc";


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
 			if ($pilihan=="atambah" || $pilihan=="") {
				include "atambah.php";
			} elseif($pilihan=="aupdate") {
				include "aupdate.php";
			} elseif($pilihan=="perbaiki") {
				include "perbaiki.php";
			} elseif($pilihan=="rupdate") {
				include "restore.php";
			} elseif($pilihan=="btambah") {
				include "btambah.php";
			} elseif($pilihan=="bupdate") {
				include "bupdate.php";
			} elseif($pilihan=="konfig") {
				include "konfig.php";
			} elseif($pilihan=="logdokumen") {
				include "logdokumen.php";
			}

			
			?>
		</td>
	</tr>
		
<?
printfooter();
?>

