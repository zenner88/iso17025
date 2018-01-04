<?php
/* $Id: lib.inc.php,v 1.62 2000/07/20 11:15:11 tobias Exp $ */

require("config.inc.php");

function show_table_navigation($pos_next, $pos_prev, $dt_result)
{
    global $pos, $cfgMaxRows, $server, $db, $table, $sql_query, $sql_order, $sessionMaxRows, $SelectNumRows, $goto;
    global $strPos1, $strPrevious, $strShow, $strRowsFrom, $strEnd;

    ?>
     <!--  beginning of table navigation bar -->
     <table border=0><tr>
        <td>
        <form method=post
          onsubmit ="return <?php  echo ( $pos >= $cfgMaxRows ? "true" : "false" ); ?>"
          action=<?php echo
          "\"sql.php?server=$server&db=$db&table=$table&sql_query=".urlencode($sql_query)."&sql_order=".urlencode($sql_order)."&pos=0&sessionMaxRows=$sessionMaxRows\"";?>
        ><input type=submit value="<?php echo $strPos1 . " &lt;&lt;" ; ?>" >
        </form>
        </td>
        <td>
        <form method=post onsubmit="return <?php  echo ( $pos >= $cfgMaxRows ? "true" : "false" ); ?>"
          action=<?php echo
          "\"sql.php?server=$server&db=$db&table=$table&sql_query=".urlencode($sql_query)."&sql_order=".urlencode($sql_order)."&pos=$pos_prev&sessionMaxRows=$sessionMaxRows\"";?>
        ><input type=submit value="<?php echo $strPrevious ." &lt;" ; ?>"  >
        </form>
        </td>
    <td>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    <td>
        <table><tr><td>
          <form method=post onsubmit="return isFormElementInRange;"
            action=<?php echo
                "\"sql.php?server=$server&db=$db&table=$table&sql_query=".urlencode($sql_query)."&sql_order=".urlencode($sql_order)."&pos=$pos&sessionMaxRows=$sessionMaxRows\"";?>
          >
              <input type=submit value="<?php echo "&gt; ". $strShow ; ?>"
                 onclick="checkFormElementInRange( this.form, 'pos', 0, <?php echo ( $SelectNumRows - 1 ); ?> )"
              >
              <input type="text" name="sessionMaxRows" size="3" value="<?php echo $sessionMaxRows ; ?>">
              <?php echo $strRowsFrom ?> <input name="pos" type="text" size="3"
                      value="<?php echo ( $pos_next >= $SelectNumRows ? '' : $pos_next )  ; ?>">
          </form>
        </td></tr></table>
    </td>
    <td>
        <form method=post
          onsubmit="return <?php  echo
          ( isset($SelectNumRows) && $pos + $sessionMaxRows < $SelectNumRows && mysql_num_rows($dt_result) >= $sessionMaxRows  ?
                    "true" : "false" ); ?>"
          action=<?php printf (
          "\"sql.php?server=$server&db=$db&table=$table&sql_query=%s&sql_order=%s&pos=%d&sessionMaxRows=%d&goto=%s\"", urlencode($sql_query),urlencode($sql_order),$SelectNumRows - $sessionMaxRows, $sessionMaxRows, $goto);?>
        ><input type=submit value="<?php echo "&gt;&gt; " . $strEnd  ; ?>"  >
        </form>
        </td>
    </tr></table>
    <!--  end of table navigation bar -->
    <?php
}

function load_javascript ()
{
    echo "\n<script language=\"javascript\" src=\"functions.js\" > </script>";
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

function auth()
{
    global $cfgServer;
    #$PHP_AUTH_USER = ""; No need to do this since err 401 allready clears that var
    Header("status: 401 Unauthorized");
    Header("HTTP/1.0 401 Unauthorized");
    Header("WWW-authenticate: basic realm=\"phpMySQLAdmin on " . $cfgServer['host'] . "\"");
    echo "<HTML><HEAD><TITLE>" . $GLOBALS["strAccessDenied"] . "</TITLE></HEAD>\n";
    echo "<BODY BGCOLOR=#FFFFFF><BR><BR><CENTER><H1>" . $GLOBALS["strWrongUser"] . "</H1>\n";
    echo "</CENTER></BODY></HTML>";
    exit;
}

// Use mysql_connect() or mysql_pconnect()?
$connect_func = ($cfgPersistentConnections) ? "mysql_pconnect" : "mysql_connect";
$dblist = array();

reset($cfgServers);
while(list($key, $val) = each($cfgServers))
{
    // Don't use servers with no hostname
    if (empty($val['host']))
        unset($cfgServers[$key]);
}

if(empty($server) || !isset($cfgServers[$server]) || !is_array($cfgServers[$server]))
   $server = $cfgServerDefault;

if($server == 0)
{
    // If no server is selected, make sure that $cfgServer is empty
    // (so that nothing will work), and skip server authentication.
    // We do NOT exit here, but continue on without logging into
    // any server.  This way, the welcome page will still come up
    // (with no server info) and present a choice of servers in the
    // case that there are multiple servers and '$cfgServerDefault = 0'
    // is set.
    $cfgServer = array();
}
else
{
    // Otherwise, set up $cfgServer and do the usual login stuff.
    $cfgServer = $cfgServers[$server];

    if(isset($cfgServer['only_db']) && !empty($cfgServer['only_db']))
        $dblist[] = $cfgServer['only_db'];

    if($cfgServer['adv_auth'])
    {
        if (empty($PHP_AUTH_USER) && isset($REMOTE_USER))
            $PHP_AUTH_USER=$REMOTE_USER;
        if(empty($PHP_AUTH_PW) && isset($REMOTE_PASSWORD))
            $PHP_AUTH_PW=$REMOTE_PASSWORD;

        if(!isset($old_usr))
        {
            if(empty($PHP_AUTH_USER))
            {
                $AUTH=TRUE;
            }
            else
            {
                $AUTH=FALSE;
            }
        }
        else
        {
            if($old_usr==$PHP_AUTH_USER)
            {
                $AUTH=TRUE;
                unset($old_usr);
            }
            else
            {
                $AUTH=FALSE;
            }
        }

        if($AUTH)
        {
            auth();
        }
        else
        {
            if(empty($cfgServer['port']))
                $dbh = $connect_func($cfgServer['host'],$cfgServer['stduser'],$cfgServer['stdpass']) or mysql_die();
            else
                $dbh = $connect_func($cfgServer['host'].":".$cfgServer['port'],$cfgServer['stduser'],$cfgServer['stdpass']) or mysql_die();
            $PHP_AUTH_USER = addslashes($PHP_AUTH_USER);
            $PHP_AUTH_PW = addslashes($PHP_AUTH_PW);
            $rs = mysql_db_query("mysql", "SELECT User, Password, Select_priv FROM user where User = '$PHP_AUTH_USER' AND Password = PASSWORD('$PHP_AUTH_PW')", $dbh) or mysql_die();
            if(@mysql_numrows($rs) <= 0)
            {
                auth();
            }
            else
            {
                $row = mysql_fetch_array($rs);
                if ($row["Select_priv"] != "Y")
                {
                    //correction uva 19991215 ---------------------------
                    //previous code assumed database "mysql" admin table "db" column "db" contains
                    //literal name of user database, and works if so.  mysql usage generally (and
                    //uva usage specifically) allows this column to contain regular expressions.
                    //(we have all databases owned by a given student/faculty/staff beginning with
                    //user i.d. and governed by default by a single set of privileges with regular
                    //expression as key.  this breaks previous code.  this maintenance is to fix code
                    //to work correctly for regular expressions.
                    //begin correction uva 19991215 pt. 1 ---------------------------
                    //add "DISTINCT" to next line:  need single row only
                    $rs = mysql_db_query("mysql", "SELECT DISTINCT Db FROM db WHERE Select_priv = 'Y' AND User = '$PHP_AUTH_USER'") or mysql_die();
                    //end correction uva 19991215 pt. 1 -----------------------------
                    if (@mysql_numrows($rs) <= 0)
                    {
                        $rs = mysql_db_query("mysql", "SELECT Db FROM tables_priv WHERE Table_priv like '%Select%' AND User = '$PHP_AUTH_USER'") or mysql_die();
                        if (@mysql_numrows($rs) <= 0) {
                            auth();
                        }
                        else
                        {
                            while ($row = mysql_fetch_array($rs))
                                $dblist[] = $row["Db"];
                        }
                    }
                    else
                    {
                        //begin correction uva 19991215 pt. 2 ---------------------------
                        //see pt. 1, above, for description of change
                        $uva_mydbs = array(); // will use as associative array
                        //of the following 2 code lines,
                        //    the 1st is the only line intact from before correction, pt. 2
                        //    the 2nd replaces $dblist[] = $row["Db"];
                        //code following those 2 lines in correction, pt. 2, continues
                        //populating $dblist[], as previous code did.  but it is now populated with
                        //actual database names instead of with regular expressions.
                        while($row = mysql_fetch_array($rs))
                            $uva_mydbs[ $row["Db"] ] = 1;
                        $uva_alldbs = mysql_list_dbs();
                        while($uva_row = mysql_fetch_array($uva_alldbs))
                        {
                            $uva_db = $uva_row[0];
                            if (isset($uva_mydbs[$uva_db]) && 1 == $uva_mydbs[$uva_db])
                            {
                                $dblist[] = $uva_db;
                                $uva_mydbs[$uva_db] = 0;
                            }
                            else
                            {
                                reset($uva_mydbs);
                                while (list($uva_matchpattern,$uva_value) = each($uva_mydbs))
                                {
                                    $uva_regex = ereg_replace("%",".+",$uva_matchpattern);
                                    if(ereg($uva_regex,$uva_db))
                                    {
                                        $dblist[] = $uva_db;
                                        break;
                                    }
                                }
                            }
                        }
                        //end correction uva 19991215 pt. 2 -----------------------------
                    }
                }
            }
        }
        $cfgServer['user']=$PHP_AUTH_USER;
        $cfgServer['password']=$PHP_AUTH_PW;
    }

    if (empty($cfgServer['port']))
        $link = $connect_func($cfgServer['host'], $cfgServer['user'], $cfgServer['password']) or mysql_die();
    else
        $link = $connect_func($cfgServer['host'].":".$cfgServer['port'], $cfgServer['user'], $cfgServer['password']) or mysql_die();

    $result = mysql_query("SELECT VERSION() AS version") or mysql_die();
    $row = mysql_fetch_array($result);
    define("MYSQL_MAJOR_VERSION", substr($row["version"], 0, 4));
}

// -----------------------------------------------------------------

function display_table ($dt_result)
{
    global $cfgBorder, $cfgBgcolorOne, $cfgBgcolorTwo, $cfgMaxRows, $pos, $server, $db, $table, $sql_query, $sql_order, $cfgOrder, $cfgShowBlob, $goto;
    global $strShowingRecords,$strSelectNumRows,$SelectNumRows,$strTotal,$strEdit,$strPrevious,$strNext,$strDelete,$strDeleted,$strPos1,$strEnd;
    global $sessionMaxRows, $strGo, $strShow, $strRowsFrom;

    $cfgMaxRows = isset($sessionMaxRows) ? $sessionMaxRows : $cfgMaxRows;
    $sessionMaxRows = isset($sessionMaxRows) ? $sessionMaxRows : $cfgMaxRows;

    load_javascript();

    $primary = false;
    if(!empty($table) && !empty($db))
    {
        $result = mysql_db_query($db, "SELECT COUNT(*) as total FROM $table") or mysql_die();
        $row = mysql_fetch_array($result);
        $total = $row["total"];
    }

    if(!isset($pos))
        $pos = 0;
    $pos_next = $pos + $cfgMaxRows;
    $pos_prev = $pos - $cfgMaxRows;

    if(isset($total) && $total>1)
    {
        if(isset($SelectNumRows) && $SelectNumRows!=$total)
            $selectstring = ", $SelectNumRows $strSelectNumRows";
        else
            $selectstring = "";
    $se = isset($se) ? $se : "";
    $lastShownRec = $pos_next  - 1;
    show_message("$strShowingRecords $pos - $lastShownRec  ($se$total $strTotal$selectstring)");
    }
    else
    {
        show_message($GLOBALS["strSQLQuery"]);
    }
    ?>
    </td>
    <?php

    $field = mysql_fetch_field($dt_result);
    $table = $field->table;
    mysql_field_seek($dt_result, 0);
    show_table_navigation($pos_next, $pos_prev, $dt_result);
    ?>

    <table border="<?php echo $cfgBorder;?>">

    <tr>
    <?php
    while($field = mysql_fetch_field($dt_result))
    {
        if(@mysql_num_rows($dt_result)>1)
        {
            $sort_order=urlencode(" order by $field->name $cfgOrder");
            echo "<th>";
            if(!eregi("SHOW VARIABLES|SHOW PROCESSLIST|SHOW STATUS", $sql_query))
                echo "<A HREF=\"sql.php?server=$server&db=$db&pos=$pos&sql_query=".urlencode($sql_query)."&sql_order=$sort_order&table=$table\">";
            echo $field->name;
            if(!eregi("SHOW VARIABLES|SHOW PROCESSLIST|SHOW STATUS", $sql_query))
                echo "</a>";
            echo "</th>\n";
        }
        else
        {
            echo "<th>$field->name</th>";
        }
        $table = $field->table;
    }
    echo "</tr>\n";
    $foo = 0;

    while($row = mysql_fetch_row($dt_result))
    {
        $primary_key = "";
        //begin correction uva 19991216 ---------------------------
        //previous code assumed that all tables have keys, specifically
        //that only the phpMyAdmin GUI should support row delete/edit
        //only for such tables.  although always using keys is arguably
        //the prescribed way of defining a relational table, it is not
        //required.  this will in particular be violated by the novice.  we
        //want to encourage phpMyAdmin usage by such novices.  so the code
        //below has been changed to conditionally work as before when the
        //table being displayed has one or more keys; but to display delete/edit
        //options correctly for tables without keys.
        //begin correction uva 19991216 pt. 1 ---------------------------
        $uva_nonprimary_condition = "";
        //end correction uva 19991216 pt. 1 -----------------------------
        $bgcolor = $cfgBgcolorOne;
        $foo % 2  ? 0: $bgcolor = $cfgBgcolorTwo;
        echo "<tr bgcolor=$bgcolor>";
        for($i=0; $i<mysql_num_fields($dt_result); $i++)
        {
            if(!isset($row[$i])) $row[$i] = '';
                $primary = mysql_fetch_field($dt_result,$i);
            if($primary->numeric == 1)
            {
                echo "<td align=right>&nbsp;$row[$i]&nbsp;</td>\n";
                if($sql_query == "SHOW PROCESSLIST")
                    $Id = $row[$i];
            }
            elseif($cfgShowBlob == false && eregi("BLOB", $primary->type))
            {
                echo "<td align=right>&nbsp;[BLOB]&nbsp;</td>\n";
            }
            else
            {
                echo "<td>&nbsp;".htmlspecialchars($row[$i])."&nbsp;</td>\n";
            }
            if($primary->primary_key > 0)
                $primary_key .= " $primary->name = '".addslashes($row[$i])."' AND";
            //begin correction uva 19991216 pt. 2 ---------------------------
            //see pt. 1, above, for description of change
            $uva_nonprimary_condition .= " $primary->name = '".addslashes($row[$i])."' AND";
            //end correction uva 19991216 pt. 2 -----------------------------
        }
        //begin correction uva 19991216 pt. 3 ---------------------------
        //see pt. 1, above, for description of change
        //prefer primary keys for condition, but use conjunction of all values if no primary key
        if($primary_key) //use differently and include else
            $uva_condition = $primary_key;
        else
            $uva_condition = $uva_nonprimary_condition;

        //   { code no longer conditional on $primary_key
        //   $primary_key replaced with $uva_condition below
        $uva_condition = urlencode(ereg_replace("AND$", "", $uva_condition));
        $query = "server=$server&db=$db&table=$table&pos=$pos";
        $goto = (isset($goto) && !empty($goto) && empty($GLOBALS["QUERY_STRING"])) ? $goto : "sql.php";
        echo "<td><a href=\"tbl_change.php?primary_key=$uva_condition&$query&sql_query=".urlencode($sql_query)."&goto=$goto\">".$strEdit."</a></td>";
        echo "<td><a href=\"sql.php?sql_query=".urlencode("DELETE FROM $table WHERE ").$uva_condition."&$query&goto=sql.php".urlencode("?$query&sql_query=$sql_query")."zero_rows=".urlencode($strDeleted)."&goto=db_details.php\">".$strDelete."</a></td>";
        //   } code no longer condition on $primary_key
        //end correction uva 19991216 pt. 3 -----------------------------

        if($sql_query == "SHOW PROCESSLIST")
            echo "<td align=right><a href='sql.php?db=mysql&sql_query=".urlencode("KILL $Id")."&goto=main.php'>KILL</a></td>\n";
        echo "</tr>\n";
        $foo++;
    }
    echo "</table>\n";

    show_table_navigation($pos_next, $pos_prev, $dt_result);
}//display_table

// Return $table's CREATE definition
// Returns a string containing the CREATE statement on success
function get_table_def($db, $table, $crlf)
{
    global $drop;

    $schema_create = "";
    if(!empty($drop))
        $schema_create .= "DROP TABLE IF EXISTS $table;$crlf";

    $schema_create .= "CREATE TABLE $table ($crlf";

    $result = mysql_db_query($db, "SHOW FIELDS FROM $table") or mysql_die();
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

// Get the content of $table as a series of INSERT statements.
// After every row, a custom callback function $handler gets called.
// $handler must accept one parameter ($sql_insert);
function get_table_content($db, $table, $handler)
{
    $result = mysql_db_query($db, "SELECT * FROM $table") or mysql_die();
    $i = 0;
    while($row = mysql_fetch_row($result))
    {
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
        $handler(trim($schema_insert));
        $i++;
    }
    return (true);
}

function count_records ($db,$table)
{
    $result = mysql_db_query($db, "select count(*) as num from $table");
    $num = mysql_result($result,0,"num");
    echo $num;
}

// Get the content of $table as a CSV output.
// $sep contains the separation string.
// After every row, a custom callback function $handler gets called.
// $handler must accept one parameter ($sql_insert);
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

function show_docu($link)
{
    global $cfgManualBase, $strDocu;

    if(!empty($cfgManualBase))
        return("[<a href=\"$cfgManualBase/$link\">$strDocu</a>]");
}

function show_message($message)
{
    if(!empty($GLOBALS['reload']) && ($GLOBALS['reload'] == "true"))
    {
        // Reload the navigation frame via JavaScript
        ?>
        <script language="JavaScript1.2">
        parent.frames.nav.location.reload();
        </script>
        <?php
    }
    ?>
    <div align="left">
     <table border="<?php echo $GLOBALS['cfgBorder'];?>">
      <tr>
       <td bgcolor="<?php echo $GLOBALS['cfgThBgcolor'];?>">
       <b><?php echo $message;?><b><br>
       </td>
      </tr>
    <?php
    if($GLOBALS['cfgShowSQL'] == true && !empty($GLOBALS['sql_query']))
    {
        ?>
        <tr>
        <td bgcolor="<?php echo $GLOBALS['cfgBgcolorOne'];?>">
        <?php echo $GLOBALS['strSQLQuery'].":\n<br>", nl2br($GLOBALS['sql_query']);
        if (isset($GLOBALS["sql_order"])) echo " $GLOBALS[sql_order]";
        if (isset($GLOBALS["pos"])) echo " LIMIT $GLOBALS[pos], $GLOBALS[cfgMaxRows]";?>
        </td>
        </tr>
        <?php
    }
    ?>
    </table>
    </div>
    <?php
}

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

// -----------------------------------------------------------------
?>