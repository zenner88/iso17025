<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
//include "man.inc";
$border="width=100%";



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

