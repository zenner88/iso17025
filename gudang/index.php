<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
//include "man.inc";

printheader();
//include $root."sesiuser.php";
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
				if ($pilihan=="gtambah" ) {
					include "tambahgudang.php";
				}	elseif ($pilihan=="glihat" || $pilihan=="") {
					include "lihatgudang.php";
				}	elseif ($pilihan=="gupdate") {
					include "updategudang.php";
  				}	elseif ($pilihan=="gmasuk"){
					include "transaksi/transaksimasuk.php";
				}	elseif ($pilihan=="gkeluar"){
					include "transaksi/transaksikeluar.php";
				}	elseif ($pilihan=="gtrans"){
					include "transaksi/lihattrans.php";
				}
			?>
		</td>
	</tr>
<?
printfooter();
?>
