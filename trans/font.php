<?php

$root="../";
//include $root."sesiuser.php";
include $root."db.php";
 
include $root."header.php";
include "initkop.php";

 
echo "<html>\n";

echo "<head>
<style>";

include $root."css/indexc.css";


echo "
</style><title>Daftar Font</title>\n";

echo "<link rel=stylesheet type='text/css' href='$css'>\n";

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

echo "<td>\n";

     echo "<table width='100%' $borderdata class=data>\n";

     echo "<tr class='juduldata' align=center>\n";

     echo "<td class=judul2  style='font-size:16pt;><a href='listmakul.php?tab=$tab&pfld=".$pfld."&pfltr=".$pfltr."&pnama=$pnama&porder=N'>Nama Font</a></td>\n";

 
     echo "</tr>\n";
$i=0;
     foreach ($arrayfont as $k=>$v) {
			$kelas=kelas($i);

         $pval = $k;
         $pval = $row["kode_pengguna"].",".$k;

         echo "<tr $kelas>\n";

         echo "<td class=isi2 style='font-family:$k;font-size:16pt;'>
          <a style='font-family:$k;' href=\"javascript:pick('".$pfld."','".$pval."')\">".$k."
         </td>\n";

  
 
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



