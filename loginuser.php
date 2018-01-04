<script language=JAVASCRIPT>
	function teslogin (form) {
		if (form.iduser.value=='') {
			alert('ID harus diisi');
			form.iduser.focus();
		}else if (form.password.value=='') {
			alert('Password harus diisi');
			form.password.focus();
		} else {
			return true;
		}
		return false;
	}
</script>
<form name=log action=index.php method=post>

<table width=150  cellpadding=4 cellspacing=0  border=0 style='width:150px;'>
	<tr valign=top  >
		<td align=center colspan=2 class=judulsubmenu id=loginbox_title><b>Login Operator</td>
	</tr>
	<tr><td align=center class=submenu2>
		<table width=150 style='width:150px;' >
		<tr valign=top>
			<td align=right>User ID </td>
			<td>
				<input style='font-size:14pt;' id=inputtext type=text name=iduser  size=20>
			</td>
		</tr>
		<tr valign=top>
			<td align=right >Password </td>
			<td>
				<input  style='font-size:14pt;'  id=inputtext type=password name=password size=20>
			</td>
		</tr>
		<tr valign=top>
			<td align=right >Tipe</td>
			<td>
				<input  style='font-size:14pt;'  id=inputtext type=radio name=jenis value=0 checked>Operator
				<input  style='font-size:14pt;'  id=inputtext type=radio name=jenis value=1>Klien
			</td>
		</tr>
	</table>
	</td></tr>
	<tr valign=top >
		<td colspan=2 align=center  class=submenu2>
			<input id=btn name=aksi type=submit value='  Login  ' onClick="return teslogin(log);">
			<input  id=btn type=reset value=Reset>
		</td>
	</tr>
  </table>
</form>


<?
if ($errlogin!="") {
echo "<SCRIPT>";
if ($errlogin=="id") {
	echo "log.iduser.focus();";
} else {
	echo "log.password.focus();";
}
echo "</SCRIPT>";
}
?>
