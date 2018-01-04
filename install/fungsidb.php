<?
periksaroot();

function split_string($sql, $delimiter)
{
    $sql = trim($sql);
    $buffer = array();
    $ret = array();
    $in_string = false;

    for($i=0; $i<strlen($sql); $i++)
    {
        if($sql[$i] == $delimiter && !$in_string)
        {
            $ret[] = substr($sql, 0, $i);
            $sql = substr($sql, $i + 1);
            $i = 0;
        }

        if($in_string && ($sql[$i] == $in_string) && $buffer[0] != "\\")
        {
             $in_string = false;
        }
        elseif(!$in_string && ($sql[$i] == "\"" || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\"))
        {
             $in_string = $sql[$i];
        }
        if(isset($buffer[1]))
            $buffer[0] = $buffer[1];
        $buffer[1] = $sql[$i];
     }

    if (!empty($sql))
    {
        $ret[] = $sql;
    }

    return($ret);
}

function get_table_csv($db, $table, $sep, $handler)
{
    $result = mysql_db_query($db, "SELECT * FROM $table") or mysql_die();
    $i = 0;
    while($row = mysql_fetch_row($result))
    {
        set_time_limit(60); // HaRa
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $handler(trim($schema_insert));
        $i++;
    }
    return (true);
}

function get_table_content($db, $table)
{	
	global $crlf, $asfile,$f,$strfile;
    $result = mysql_db_query($db, "SELECT * FROM $table") or mysql_die();
    $i = 0;
    while($row = mysql_fetch_row($result))
    {
    	$schema_insert="";
        set_time_limit(60); // HaRa
        $table_list = "(";

        for($j=0; $j<mysql_num_fields($result);$j++)
            $table_list .= mysql_field_name($result,$j).", ";

        $table_list = substr($table_list,0,-2);
        $table_list .= ")";

        if(isset($GLOBALS["showcolumns"]))
            $schema_insert = "INSERT INTO $table $table_list VALUES (";
        else
            $schema_insert = "INSERT INTO $table VALUES (";

        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= " NULL,";
            elseif($row[$j] != "")
                $schema_insert .= " '".addslashes($row[$j])."',";
            else
                $schema_insert .= " '',";
        }
        $schema_insert = ereg_replace(",$", "", $schema_insert);
       	$schema_insert .= ")";
	      // fwrite($f,"$schema_insert;$crlf");
	       $strfile.="$schema_insert;$crlf";
	      //echo htmlspecialchars("$schema_insert;$crlf");
        $i++;
    }
    return (true);
}

function get_table_def($db, $table, $crlf)
{
    global $drop;

    $schema_create = "";
    if(!empty($drop))
        $schema_create .= "DROP TABLE IF EXISTS $table;$crlf";

    $schema_create .= "CREATE TABLE $table ($crlf";

    $result = mysql_db_query($db, "SHOW FIELDS FROM $table") 
    or mysql_die();
    while($row = mysql_fetch_array($result))
    {
        $schema_create .= "   $row[Field] $row[Type]";

        if(isset($row["Default"]) && (!empty($row["Default"]) || $row["Default"] == "0"))
            $schema_create .= " DEFAULT '$row[Default]'";
        if($row["Null"] != "YES")
            $schema_create .= " NOT NULL";
        if($row["Extra"] != "")
            $schema_create .= " $row[Extra]";
        $schema_create .= ",$crlf";
    }
    $schema_create = ereg_replace(",".$crlf."$", "", $schema_create);
    $result = mysql_db_query($db, "SHOW KEYS FROM $table") or mysql_die();
    while($row = mysql_fetch_array($result))
    {
        $kname=$row['Key_name'];
        if(($kname != "PRIMARY") && ($row['Non_unique'] == 0))
            $kname="UNIQUE|$kname";
         if(!isset($index[$kname]))
             $index[$kname] = array();
         $index[$kname][] = $row['Column_name'];
    }

    while(list($x, $columns) = @each($index))
    {
         $schema_create .= ",$crlf";
         if($x == "PRIMARY")
             $schema_create .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
         elseif (substr($x,0,6) == "UNIQUE")
            $schema_create .= "   UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
         else
            $schema_create .= "   KEY $x (" . implode($columns, ", ") . ")";
    }

    $schema_create .= "$crlf)";
    return (stripslashes($schema_create));
}

function mysql_die($error = "")
{
    global $strError,$strSQLQuery, $strMySQLSaid, $strBack, $sql_query;

    echo "<b> $strError </b><p>";
    if(isset($sql_query) && !empty($sql_query))
    {
        echo "$strSQLQuery: <pre>$sql_query</pre><p>";
    }
    if(empty($error))
        echo $strMySQLSaid.mysql_error();
    else
        echo $strMySQLSaid.$error;
    echo "<br><a href=\"javascript:history.go(-1)\">$strBack</a>";
    include("footer.inc.php");
    exit;
}

function my_handler($sql_insert)
{
    global $crlf, $asfile,$teksfile;
    
    if(empty($asfile)) 
    {
        $teksfile.= htmlspecialchars("$sql_insert;$crlf");
    }
    else
    {
        $teksfile.= "$sql_insert;$crlf";
    }
}

function split_sql($sql)
{
    $sql = trim($sql);
    $sql = ereg_replace("#[^\n]*\n$", "", $sql);
    $buffer = array();
    $ret = array();
    $in_string = false;

    for($i=0; $i<strlen($sql)-1; $i++)
    {
         if($sql[$i] == ";" && !$in_string)
        {
            $ret[] = substr($sql, 0, $i);
            $sql = substr($sql, $i + 1);
            $i = 0;
        }

        if($in_string && ($sql[$i] == $in_string) && $buffer[0] != "\\")
        {
             $in_string = false;
        }
        elseif(!$in_string && ($sql[$i] == "\"" || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\"))
        {
             $in_string = $sql[$i];
        }
        if(isset($buffer[1]))
        {
            $buffer[0] = $buffer[1];
        }
        $buffer[1] = $sql[$i];
     }

    if(!empty($sql))
    {
        $ret[] = $sql;
    }

    return($ret);
}


?>
