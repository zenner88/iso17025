<?php
	$hostsql = 'localhost';
	$usersql = 'iso17025';
	$passsql = 'rahasia';
	$dbsql = 'iso17025';
	
	$con = mysql_connect($hostsql,$usersql,$passsql);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($dbsql,$con);
	
	//$query = "SELECT NAMA,TINGKAT FROM toko WHERE ID='$iduser' AND PASSWORD=md5('$password')";
	$query = "SELECT * FROM toko";
	//$hasil=doquery($query,$con);
	
	$hasil = mysql_query($query);
	while($row = mysql_fetch_array($hasil))
	{
		echo $row["NAMA"]." 123 ".$row["KONTAK"]."<br />";
		//echo $row[0]."<br />";
	}
	 
	 
?>