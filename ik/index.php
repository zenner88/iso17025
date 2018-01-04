<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
//include "man.inc";



printheader();

include $root."menu.php";
?>

<tr>
	<td id="leftmenu"  >
				<?
				include "submenu.php";
				?>
		</td>
	<td id="content" >
			<?
				printmesg($errmesg);

///////////////////////////////Tabel Jenis Bahan Kimia//////////////////////////////////////////////
				if ($pilihan=="ltambah" ) {
					include "tambahtoko.php";
				}	elseif ($pilihan=="llihat" || $pilihan=="") {
					include "lihattoko.php";
				}	elseif ($pilihan=="lupdate") {
					include "updatetoko.php";
  				}		

			
			?>
		</td>
	</tr>
		
<?
printfooter();
?>

