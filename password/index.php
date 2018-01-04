<?
$root="../";
include $root."sesiuser.php";
include $root."header.php";
//include "man.inc";

$waktu=getdate(time());
//echo $users;
printheader();
//echo "Hooi";
include $root."menu.php";
?>

	<tr valign=top>
	<td colspan=2 id="content" width="100%">
			<?
				printmesg($errmesg);
					include "gantipassword.php";
			
			?>
		</td>
	</tr>
		
<?
printfooter();
?>
