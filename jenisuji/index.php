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
				}	elseif ($pilihan=="kelompok") {
					include "kelompok.php";
				}	elseif ($pilihan=="baku") {
					include "baku.php";
  				}	elseif ($pilihan=="test"){
					include "baku.php";
				}

			
			?>
		</td>
	</tr>
		
<?
printfooter();
?>

