<?
 printjudulmenu("Kembalikan/<i>Restore</i>  Data");

if ($aksi=="Kembalikan Data") {

	if ($sql_file=="" || $sql_file=="none") {
		$mesg="File cadangan harus diisi";
		$aksi="";
	} else {
		$tes=file($sql_file);
		if ("# Nama Basis Data : $basisdatasql"==trim($tes[0])) {
 			$tables = mysql_list_tables($basisdatasql);
			
			$i = 0;
			$num_tables = @mysql_numrows($tables);
		    while($i < $num_tables)
		    { 
		        $table = mysql_tablename($tables, $i);
				doquery("DROP TABLE $table",$koneksi);
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
			    		//echo htmlspecialchars($pieces[$i])."<br>";
			        $result = mysql_db_query ($basisdatasql, htmlspecialchars($pieces[$i]));
			    }
			}
			
			$sql_query = stripslashes($sql_query);
			$mesg = "Data dari file $sql_file_name berhasil dikembalikan";
			$aksi="";
		} else {
			$mesg = "File $sql_file_name bukanlah data cadangan <b> $judulprogram </b>!!!!";
		}
	}
}

	printmesg($mesg);

echo "
<form onsubmit='return confirm(\"Anda yakin? Data lama akan dihapus dan diganti dengan data baru\")' ENCTYPE=\"MULTIPART/FORM-DATA\" action=index.php method=post
onSubmit=\"return confirm('Anda yakin hendak mengembalikan data cadangan? Data saat ini akan dihapus dan diganti dengan data cadangan.')\">
<input type=hidden name=pilihan value='$pilihan'>
<table  class=form>
<tr>
	<td  class=juduldata>
		Nama File Cadangan
	</td>
	<td>
		<input class=masukan type=file size=40 name=sql_file >
	</td>
</tr>
<tr>
	<td  colspan=2>
		<input type=submit class=tombol name=aksi value='Kembalikan Data'>
		<input class=tombol type=reset>
	</td>
</tr>
</table>

</form>

";



?>