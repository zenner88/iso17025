<?
$waktu=getdate(time());
$w=getdate(time());

$konfigc=file($root."cadangan/konfig");
$dirc=trim($konfigc[0]);
if (trim($konfigc[1])=="M") {
	$idhari=trim($konfigc[2]);
} else {
	$idhari=$w[wday];
}

$cwd=getcwd();
if ($w[wday]==$idhari) {
	if (isset($WINDIR)) {
		$dirc=str_replace("\\\\","\\",$dirc)."\\";
		if (!file_exists($dirc)) {
			@exec("mkdir $dirc ");
		}
		$filebackup=$dirc.$w[mday].$w[mon].$w[year].".sql";

		if (!file_exists($filebackup)) {

			include $root."cadangan/fungsi.php";
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
			    if ($f=fopen("$filebackup","w")) {
			    //echo "tes";
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
					fclose($f);
				}
			}
		}
		


	}
}


?>