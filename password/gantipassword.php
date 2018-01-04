<?
@cekuser("");
if ($aksi=="ganti") {
	$ok=true;
	if (trim($iduser)=="") {
		$ok=false;
		$errmesg="User ID harus diisi";
	} elseif (trim($passlama)=="") {
		$ok=false;
		$errmesg="Password lama harus diisi";
	} elseif (trim($pass=="") || strlen($pass) <4 ) {
		$ok=false;
		$errmesg="Password baru harus diisi minimum 4 karakter";
	} elseif (trim($pass2=="") || strlen($pass2) <4) {
		$ok=false;
		$errmesg="Konfirmasi password baru harus diisi minimum 4 karakter";
	} elseif ($pass!=$pass2) {
		$ok=false;
		$errmesg="Password baru dan konfirmasi password baru harus sama";
	} else {
		$pass=str_replace("'","\'",$pass);
		$pass2=str_replace("'","\'",$pass2);
		$passlama=str_replace("'","\'",$passlama);
		
    if ($jenisusers==0) {
      $query ="UPDATE user SET PASSWORD=md5('$pass') WHERE ID='$iduser' AND PASSWORD=md5('$passlama')";
    } elseif($jenisusers==1) {
      $query ="UPDATE toko SET PASSWORD=md5('$pass') WHERE ID='$iduser' AND PASSWORD=md5('$passlama')";
    }
		doquery($query,$koneksi);
		if (sqlaffectedrows($koneksi)==1) {
  		  $ketlog="Ganti password.";
        buatlogiso(3,$ketlog,"",$users);
			$errmesg="Password Anda telah diganti dengan yang baru. Terima kasih";
			$iduser="";
			$passlama="";
			$pass="";
			$pass2="";
		} else {
			$errmesg="User ID dan password Anda tidak sesuai. Silakan ulangi penggantian password";
			buatlog(5,$iduser);
			$passlama="";
			$pass="";
			$pass2="";
		}
	}
}



if ($errmesg!="") {
	if ($pgl!="") {
		$errmesg="$pgl. ".$errmesg;
	}
}
printmesg($errmesg);




?>

<?
//printman($mangantipassword);
?>
<form action=index.php method=post>
<input type=hidden name=aksi value="ganti">
<table >
			<input type=hidden name=iduser value=<?=$users?>>
	</tr>
	<tr valign=top>
		<td >Password lama</td>
		<td>
			<input type=password name=passlama size=20 value=<?=$passlama?>>
		</td>
	</tr>
	<tr valign=top>
		<td >Password baru</td>
		<td>
			<input type=password name=pass size=20 value=<?=$pass?>>
		</td>
	</tr>
	<tr valign=top>
		<td >Konfirmasi password baru</td>
		<td>
			<input type=password name=pass2 size=20 value=<?=$pass2?>>
		</td>
	</tr>
	<tr valign=top>
		<td colspan=2 align=center >
			<input type=submit value='  Ganti  '>
			<input type=reset value=Reset>
		</td>
	</tr>
</table>
</form>

