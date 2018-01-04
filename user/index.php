<?
$root="../";
 include $root."sesiuser.php";
include_once $root."header.php";
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
				printmesg($errmesg);
				if ($pilihan=="tambah" || $pilihan=="") {
					include "tambahuser.php";
				}	elseif ($pilihan=="lihat") {
					include "lihatuser.php";
				}	elseif ($pilihan=="update") {
					include "updateuser.php";
				}		
			
			?>
		</td>
	</tr>
		
<?
printfooter();
?>

