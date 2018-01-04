<?php
	//include "db_conn.php";
	foreach ($_POST as $key => $value) {
    $$key = addslashes(trim($value));
	}

	//check if a parameter exists - if not then we don't have to go to the database
		
		$host="localhost"; // Host name
		$username="iso17025"; // Mysql username
		$password="rahasia"; // Mysql password
		$db_name="iso17025"; // Database name
		
		// Connect to server and select databse.
		$conn = mysql_connect("$host", "$username", "$password")or die("cannot connect");
		
		$tbl_name="minta"; // Table name
		mysql_select_db("$db_name")or die("cannot select DB");
		$id = "agie";
		$id = stripslashes($id);
		$query = 'SELECT m.ID as ID, m.IDKLIEN as KLIEN, m.CONTOH as CONTOH, pm.JENISANALISIS as JENISANALISIS, m.TANGGALDATANG as TGLDTG, 		pm.TANGGALSELESAI as TGLFINISH, pm.STATUS as STATUS FROM minta m LEFT JOIN permintaan pm ON m.ID = pm.IDTRANS WHERE m.IDKLIEN = \''.$id.'\';';
		
		//$rs=$conn->execute($query);
		$rs = mysql_query($query);
		
		//return an error in XML format if there is an error
		if (!$rs){	exit("<results status=\"error\"><message>Error in SQL</message></results>");}

		//loop thru the recordset and make up the results in XML format
		 $num = 0;
		while ($row = mysql_fetch_assoc($rs)){
			  $aid = $row['ID'];
			  $klien = $row['KLIEN'];
			  $tgldtg = $row['TANGGALDATANG'];
			  $tglfin = $row['TANGGALSELESAI'];
			  $stat = $row['STATUS'];
			  if($stat = '99'){$status = "Ada di Man. Teknis";}
if($stat = '1'){$status="Ada di Supervisor";}
if($stat = '2'){$status="Ada di Analis";}
if($stat = '3'){$status="Sedang Dianalisis";}
if($stat = '4'){$status="Diperiksa Supervisor";}
if($stat = '5'){$status="Diperiksa Manager Teknis";}
if($stat = '6'){$status="Analisa Ulang";}
if($stat = '7'){$status="Administrasi Akhir";}
if($stat = '8'){$status="Pelanggan Komplain";}
if($stat = '0'){$status="Selesai";}
else{$status="";}
			  $contoh = $row['CONTOH'];
			  $jenis = $row['JENIS']; 

			  /*
			  $results .= "<result><uid>$aid</uid><idklien>$klien</idklien><tgldtg>$tgldtg</tgldtg><tglfin>$ts</tglfin><status>$status</status><contoh>$contoh</contoh><jenis>$jenis</jenis></result>";
			  */
			  
			   $results .= "<result><uid>".$aid."</uid><idklien>".$klien."</idklien><status>".$status."</status><contoh>".$contoh."</contoh><jenis>".$jenis."</jenis></result>";

			  $num++;
		} 
		
		/*$num = 0;
		 while (!$rs->EOF){
				 $id = $rs->Fields("ID")->value;
				 $c = $rs->Fields("KLIEN")->value;
				 $n = $rs->Fields("STATUS")->value;
				 $results .= "<result><id>$id</id><klien>$c</klien><status>$n</status></result>";
				 $rs->MoveNext();
				 $num++;
		 }*/
	//Wrap the results in a XML parent
		  $retstr = "<results status=\"success\" count=\"$num\">";
		 $retstr .= $results;
		 $retstr .= "</results>"; 

		 /*$rs->Close();    $rs = null;
		 $conn->Close(); $conn = null;    */   
	 
		 //return the XML data!
		 echo str_replace("&", "en" ,$retstr);

		/* echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		echo ($retstr);
		echo '<xml>';
		echo '</xml>'; */

?>