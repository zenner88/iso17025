<?
printjudulmenu("Buat Cadangan Data Manual");

if ($aksi=="Buat Cadangan") {

	if (trim($nama)=="") {
		$mesg="Nama File harus diisi";
		$aksi="";
	} else {
		include "fungsi.php";
		$what="data";
		$crlf="\r\n";	
		$tables = mysql_list_tables($basisdatasql);
		
		$num_tables = @mysql_numrows($tables);
		if($num_tables == 0)
		{
		    echo $strNoTablesFound;
		}
		else
		{
		    $i = 0;
		    $f=fopen("file/$nama.sql","w");
		//echo "<textarea cols=70 rows=20>";
	
		 	fwrite($f,"# Nama Basis Data : $basisdatasql $crlf");
			fwrite($f,"# Tanggal Pembuatan : $waktu[mday]-$waktu[mon]-$waktu[year]$crlf");
			fwrite($f,"# Jam Pembuatan : $waktu[hours]:$waktu[minutes]:$waktu[seconds]$crlf");
		 	fwrite($f,"# ID Pembuat : $users $crlf");
	
		    while($i < $num_tables)
		    { 
		    
		        $table = mysql_tablename($tables, $i);

		  		fwrite($f,$crlf);
		  		fwrite($f,"# --------------------------------------------------------$crlf");
		  		fwrite($f,"#$crlf");
		  		fwrite($f,"#$crlf");
		  		fwrite($f,$crlf);
		
		        fwrite($f,get_table_def($basisdatasql, $table, $crlf).";$crlf$crlf");
		        if($what == "data")
		        {
		  			fwrite($f,"#$crlf");
		  			fwrite($f,"# $strDumpingData '$table'$crlf");
		  			fwrite($f,"#$crlf");
		  			fwrite($f,$crlf);
		            get_table_content($basisdatasql, $table);
		        }
		        $i++;
		    }
		}
		fclose($f);
		$mesg="Cadangan data dengan nama $nama.txt berhasil dibuat.
		Klik <a target=_blank href='file/$nama.sql'>di sini</a> untuk mengambil file data";
		//echo "</textarea>";
		$aksi="";
	}
}

printmesg($mesg);

echo "
<form ENCTYPE=\"MULTIPART/FORM-DATA\" action=index.php method=post>
<input type=hidden name=pilihan value='$pilihan'>
<table class=form>
<tr>
	<td  class=judulform>
		Nama File
	</td>
	<td>
		<input type=text class=masukan size=40 name=nama value='$nama'>.sql 
	</td>
</tr>
<tr>
	<td  colspan=2><br>
		<input type=submit class=tombol name=aksi value='Buat Cadangan'>
		<input type=reset class=tombol >
	</td>
</tr>
</table>


</form>

";



?>