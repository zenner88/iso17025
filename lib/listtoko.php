<?php

$root="../";
include "../db.php";
include "../style.inc";
include "../header.php";

$db = mysql_connect($hostsql, $loginsql,$passwordsql);

mysql_select_db($basisdatasql, $db);

$punit = split(",",$pfltr);

$sqltext = "Select ID as username, NAMA as nama_pengguna, KONTAK,TELEPON
	
	from toko";

$sqltext = $sqltext." where 
 			NAMA like '$pnama%' ";
	



if ($porder == "U") {

    $sqltext = $sqltext."order by NAMA";

} else if ($porder == "J") {

    $sqltext = $sqltext."order by KONTAK";

} else {

    $sqltext = $sqltext."order by TELEPON";

}


//echo "$sqltext<br>\n";



$pengguna = mysql_query($sqltext, $db);

echo mysql_error();

echo "<html>\n";

echo "<head>$style\n";

echo "<title>Daftar Klien</title>\n";

echo "<link rel=stylesheet type='text/css' href='../style.css'>\n";

echo "<meta http-equiv='Content-Style-Type' content='text/css'>\n";

echo "<SCRIPT LANGUAGE=\"JavaScript\">\n";

echo "<!--\n";

echo "function pick(pfld,pval) {\n";

echo "    fld = pfld.split(',');\n";

echo "    val = pval.split(','); \n";

echo "    var wod = window.opener.document;\n";

echo "    if (window.opener && !window.opener.closed) {\n";

echo "        for (var i=0; i<wod.forms.length; i++) {\n";

echo "            if (wod.forms[i].name == fld[0]) {\n";

echo "                for (var j=0; j<wod.forms[i].elements.length; j++) {\n";

echo "                    if (wod.forms[i].elements[j].name == fld[1]) {\n";

echo "                        wod.forms[i].elements[j].value = val[0];\n";

echo "                    }\n";

echo "                    if (wod.forms[i].elements[j].name == fld[2]) {\n";

echo "                        wod.forms[i].elements[j].value = val[1];\n";

echo "                    }\n";

echo "                } \n";

echo "            }\n";

echo "        }\n";

echo "    } \n";

echo "    window.close();\n";

echo "};\n";

echo "// -->  \n";

echo "</SCRIPT>  \n";

echo "</head>\n";

echo "<body>\n";



echo "<table width='100%' border='0' class=menu>\n";

echo "<tr>\n";

echo "<td class='judul1' align=center>Daftar Klien</td>\n";

echo "</tr>\n";

echo "<tr>\n";

echo "<td>\n";

     echo "<table width='100%' $borderdata class=data>\n";

     echo "<tr valign=middle class=judulkolom>\n";

     echo "<td ><a href='listtoko.php?pfld=".$pfld."&pfltr=".$pfltr."'>Semua</a></td>\n";
     echo "<td valign=middle align=center>";
     for ($i=0; $i<26; $i++) {

         echo "
         	<a href='listtoko.php?pfld=".$pfld."&pfltr=".$pfltr."&pnama=".chr($i+65)."'>".chr($i+65)."
         	</a>\n";

     }

     echo "</td></tr>\n";

     echo "</table>\n";

echo "</td>\n";

echo "</tr>\n";

echo "<tr>\n";

echo "<td>\n";

     echo "<form name='caripengguna' method='post'>\n";

     echo "<table>\n";

     echo "<tr>\n";

     echo "<td width='20%'>Cari :</td>\n";

     echo "<td width='60%'><input type=text size=20 name=katakunci></td>\n";

     echo "<td width='20%'><input type=button value='Cari!' onClick=window.open('listtoko.php?pfld='+'$pfld'+'&pfltr='+'$pfltr'+'&pnama='+katakunci.value,'_self')></td>\n";

     echo "</tr>\n";

     echo "</table>\n";

     echo "</form>\n";

echo "</td>\n";

echo "</tr>\n";

echo "<tr>\n";

echo "<td>\n";

     echo "<table width='100%' $borderdata class=data>\n";

     echo "<tr class='judulkolom' align=center>\n";

     echo "<td class=judul2 width='10'><a href='listtoko.php?pfld=".$pfld."&pfltr=".$pfltr."&pnama=$pnama&porder=N'>ID</a></td>\n";

     echo "<td class=judul2 ><a href='listtoko.php?pfld=".$pfld."&pfltr=".$pfltr."&pnama=$pnama&porder=U'>Nama</a></td>\n";
     echo "<td class=judul2 ><a href='listtoko.php?pfld=".$pfld."&pfltr=".$pfltr."&pnama=$pnama&porder=J'>Kontak</a></td>\n";
     echo "<td class=judul2 >Telepon</a></td>\n";

     echo "</tr>\n";
$i=0;
     while ($row = mysql_fetch_array($pengguna)) {
			$kelas=kelas($i);

         $pval = $row["kode_pengguna"].",".$row["username"];

         echo "<tr $kelas>\n";

         echo "<td class=isi2 ><a href=\"javascript:pick('".$pfld."','".$pval."')\">".$row["username"]."</td>\n";

         echo "<td class=isi2 >".$row["nama_pengguna"]."</td>\n";

         echo "<td class=isi2 >".$row[KONTAK]."</td>\n";
         echo "<td class=isi2 >".$row[TELEPON]."</td>\n";

         echo "</tr>\n";

     }

     echo "</table>\n";

echo "</td>\n";

echo "</tr>\n";

echo "<tr>\n";

echo "<td>&nbsp;</td>\n";

echo "</tr>\n";

echo "</table>\n";

echo "</body>\n";

echo "</html>\n";



