<?



echo "
<table border=0 width=640>
<tr  class=judulsm>
<td align=center><b>
</td>
</tr>
</table>";

printmesg($mesg);

if ($aksi=="Buat Cadangan") {

		include "fungsi.php";
		$what="data";
		$crlf="\r\n";	
		$tables[0] = "rutin";
		$tables[1] = "nonrutin";
		
		    $i = 0;
		    $f=fopen("file/$nama.sql","w");
		//echo "<textarea cols=70 rows=20>";
	
		 	fwrite($f,"# Nama Basis Data : $basisdatasql $crlf");
			fwrite($f,"# Tanggal Pembuatan : $waktu[mday]-$waktu[mon]-$waktu[year]$crlf");
			fwrite($f,"# Jam Pembuatan : $waktu[hours]:$waktu[minutes]:$waktu[seconds]$crlf");
		 	fwrite($f,"# ID Pembuat : $users $crlf");
	
		    while($i < count($tables))
		    { 
		    
		        $table = $tables[$i];

		  		fwrite($f,$crlf);
		  		fwrite($f,"# --------------------------------------------------------$crlf");
		  		fwrite($f,"#$crlf");
		  		fwrite($f,"#$crlf");
		  		fwrite($f,$crlf);
		
		        //fwrite($f,get_table_def($basisdatasql, $table, $crlf).";$crlf$crlf");
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
		fclose($f);
		$mesg="Cadangan data Pembayaran dengan nama $nama.txt berhasil dibuat.
		Klik <a target=_blank href='file/$nama.sql'>di sini</a> untuk mengambil file data";
		//echo "</textarea>";
		$aksi="";
//	}
}

if ($aksi=="") {

	printmesg($mesg);

echo "
<form ENCTYPE=\"MULTIPART/FORM-DATA\" action=index.php method=post>
<input type=hidden name=pilihan value='$pilihan'>
<table   border=1 width=400 class=isian>
<tr>
	<td align=center class=isianjudul colspan=2>
		<b>Buat Cadangan Data Status Pembayaran Anggota
	</td>
</tr>
<tr>
	<td  align=right class=isianjudul>
		Nama File
	</td>
	<td>
		<input type=text size=40 name=nama value='$nama'>.sql 
	</td>
</tr>
</table>
<br>
<br>
		<input type=submit name=aksi value='Buat Cadangan'>
		<input type=reset>

</form>

";


}
?>