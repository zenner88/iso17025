<?php
periksaroot();
$sql_file="install/data.sql";
 		if (1) {
 		  /*
 			$tables = mysql_list_tables($_SESSION["basisdata"]);
			
			$i = 0;
			$num_tables = @mysql_numrows($tables);
		    while($i < $num_tables)
		    { 
		        $table = mysql_tablename($tables, $i);
				doquery("DROP TABLE $table",$koneksi);
				$i++;
		    }
		  */
			include "install/fungsidb.php";
			if(!empty($sql_file) && $sql_file != "" /*&& ereg("^php[0-9A-Za-z_.-]+$", basename($sql_file))*/ )
			{
			    $sql_query = addslashes(fread(fopen($sql_file, "r"), filesize($sql_file)));
			} else {
        echo "G ada apa2";
      }
			
			$pieces  = split_sql($sql_query);
			
			if (count($pieces) == 1 && !empty($pieces[0]))
			   {
			   $sql_query = trim($pieces[0]);
			   //include ("sql.php");
			   //exit;
			   }
			
	//		include("header.inc.php");
	   $berhasil=0;
			for ($i=0; $i<count($pieces); $i++)
			{
			    $pieces[$i] = stripslashes(trim($pieces[$i]));
			    if(!empty($pieces[$i]) && $pieces[$i] != "#")
			    {
			    		//echo htmlspecialchars($pieces[$i])."<br>";
			    		if (!eregi("(drop)|(truncate)",htmlspecialchars($pieces[$i]))) {
  			        $result = mysql_db_query ($_SESSION["basisdata"], htmlspecialchars($pieces[$i]));
  			        if (sqlaffectedrows($koneksi)>0) {
                  $berhasil++;
                }
              }
			    }
			}
			
			$sql_query = stripslashes($sql_query);
			if ($berhasil>0) {
  			$mesgbasisdata .= " Data berhasil diinstall";
      } else {
  			$mesgbasisdata .= " Data tidak berhasil diinstall";
  		}
			$aksi="";
		}  
?>
