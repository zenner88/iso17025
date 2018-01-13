<?php include "../head.php" ?>
<table>
	<tr>
	<td id="leftmenu" nowrap>
				<?php include "submenu.php"; ?>
	</td>
	<td id="content" style="
    width: 100%;
">

		<?php 
		if ($_GET['pilihan']=='home') {
			include "autolihattoko.php";
		} elseif ($_GET['pilihan']=="ltambah" ) {
					include "tambahtoko.php";
				} else {

	} ?>
		</td>
</tr>	
</table>
<?php include "../footer.php" ?>