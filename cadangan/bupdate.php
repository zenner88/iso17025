<?



echo "
<table border=0 width=640>
<tr  class=judulsm>
<td align=center><b>
</td>
</tr>
</table>";

printmesg($mesg);

if ($aksi=="Kembalikan Data") {

	if ($sql_file=="" || $sql_file=="none") {
		$mesg="File cadangan harus diisi";
		$aksi="";
	} else {
		$i = 0;
		$tables[0] = "rutin";
		$tables[1] = "nonrutin";
		
		$i = 0;
		$num_tables = count($tables);
	    while($i < $num_tables)
	    { 
	        $table = $tables[$i];
			doquery("DELETE FROM $table",$koneksi);
			$i++;
	    }
		include "fungsi.php";
		if(!empty($sql_file) && $sql_file != "none" && ereg("^php[0-9A-Za-z_.-]+$", basename($sql_file)))
		{
		    $sql_query = addslashes(fread(fopen($sql_file, "r"), filesize($sql_file)));
		}
		
		$pieces  = split_sql($sql_query);
		
		if (count($pieces) == 1 && !empty($pieces[0]))
		   {
		   $sql_query = trim($pieces[0]);
		   //include ("sql.php");
		   //exit;
		   }
		
//		include("header.inc.php");
		for ($i=0; $i<count($pieces); $i++)
		{
		    $pieces[$i] = stripslashes(trim($pieces[$i]));
		    if(!empty($pieces[$i]) && $pieces[$i] != "#")
		    {
		        $result = mysql_db_query ($basisdatasql, $pieces[$i]);
		    }
		}
		
		$sql_query = stripslashes($sql_query);
		$mesg = "Data dari file $sql_file_name berhasil dikembalikan";
		$aksi="";
	}
}

if ($aksi=="") {

	printmesg($mesg);

echo "
<form ENCTYPE=\"MULTIPART/FORM-DATA\" action=index.php method=post
onSubmit=\"return confirm('Anda yakin hendak mengembalikan data cadangan? ')\">
<input type=hidden name=pilihan value='$pilihan'>
<table   border=1 width=500 class=isian>
<tr>
	<td align=center class=isianjudul colspan=2>
		<b>Kembalikan/<i>Restore</i>  Data Keuangan/Anggota/Dll
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Nama File Cadangan
	</td>
	<td>
		<input type=file size=40 name=sql_file >
	</td>
</tr>
</table>
<br>
<br>
		<input type=submit name=aksi value='Kembalikan Data'>
		<input type=reset>

</form>

";


}
?>